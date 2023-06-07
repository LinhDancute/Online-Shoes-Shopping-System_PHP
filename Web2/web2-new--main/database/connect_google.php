<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . "/connectDB.php";

session_start();

use Google\Client as Google_Client;
use Google\Service\Oauth2 as Google_Service_Oauth2;

// init configuration
$clientID = '419923561862-4rdeicbjlsgs134vllojpdodscrv2no9.apps.googleusercontent.com';
$clientSecret = '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';
$redirectUri = 'http://localhost:8012/web2-new--main/web2-new--main/page/FormLogin.php';

// create Client Request to access Google API
$client = new Google_Client();
$client->setClientId($clientID);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUri);
$client->addScope("email");
$client->addScope("profile");

// authenticate code from Google OAuth Flow
if (isset($_GET['code'])) {
  try {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
  } catch (Exception $e) {
    echo "Failed to retrieve access token: " . $e->getMessage();
    die();
  }

  if (isset($token['access_token'])) {
    $client->setAccessToken($token['access_token']);

    // get profile info
    $google_oauth = new Google_Service_Oauth2($client);
    $google_account_info = $google_oauth->userinfo->get();

    $userinfo = [
      'email' => $google_account_info['email'],
      'username' => $google_account_info['name'],
      'picture' => $google_account_info['picture'],
      'token' => $google_account_info['id'],
    ];
    // checking if user is already exists in database
    $sql = "SELECT * FROM clients WHERE email ='{$userinfo['email']}'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
      // user is exists
      $userinfo = mysqli_fetch_assoc($result);
      $token = $userinfo['token'];
      $userID=$userinfo['id'];

      // update user information
      $sql = "UPDATE clients SET  username='{$userinfo['username']}', picture='{$userinfo['picture']}' WHERE email='{$userinfo['email']}'";
      $result = mysqli_query($conn, $sql);
      if (!$result) {
        echo "Failed to update user information";
        die();
      }
    } else {
      // user is not exists
      $sql = "INSERT INTO clients (email, username, picture, token) VALUES ('{$userinfo['email']}', '{$userinfo['username']}', '{$userinfo['picture']}', '{$userinfo['token']}')";
      $result = mysqli_query($conn, $sql);
      if ($result) {
        $token = $userinfo['token'];
      } else {
        echo "User is not created";
        die();
      }
    }

    // save user data into session
    $_SESSION['user_token'] = $token;
    $_SESSION['userinfo'] = $userinfo;
    $_SESSION['id'] = $userID;

    // redirect to showAccount.php
    header("Location: ./../index.php");
    exit();
  } else {
    if (!isset($_SESSION['user_token'])) {
      echo `header("Location: index.php")`;
      die();
    }

    // checking if user is already exists in database
    $sql = "SELECT * FROM clients WHERE token ='{$_SESSION['user_token']}'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
      // user is exists
      $userinfo = mysqli_fetch_assoc($result);
    }
  }
}
