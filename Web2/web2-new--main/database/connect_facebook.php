<?php

require_once __DIR__ . "/connectDB.php";
require_once __DIR__ . '/vendor/autoload.php';

use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;
use Facebook\Facebook;

// set app id and app secret
$app_id = '911682840125712';
$app_secret = 'f57250c1e2338ad273bfc16db30b2765';

// set the redirect uri
$redirect_uri = 'https://8556-113-22-113-75.ngrok-free.app/PHP_Server/Layout_Web/index.php?number=login';

// create the Facebook object with app credentials
$fb = new Facebook([
  'app_id' => $app_id,
  'app_secret' => $app_secret,
  'default_graph_version' => 'v12.0',
]);

// get the access token from Facebook
$helper = $fb->getRedirectLoginHelper();
try {
  $accessToken = $helper->getAccessToken();
} catch (FacebookResponseException $e) {
  // Handle the error
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch (FacebookSDKException $e) {
  // Handle other errors
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

// if the access token is not set or has expired
if (!$accessToken) {
  // get the login URL
  $loginUrl = $helper->getLoginUrl($redirect_uri);
  // redirect the user to the login URL
  header('Location: ' . $loginUrl);
  exit;
}

// set the access token in the Facebook object
$fb->setDefaultAccessToken($accessToken);

try {
  // use the access token to get the user's information
  $response = $fb->get('/me?fields=name,email');
  $user = $response->getGraphUser();

  // print the user's information
  echo 'Name: ' . $user->getName() . PHP_EOL;
  echo 'Email: ' . $user->getEmail() . PHP_EOL;
  echo 'ID: ' . $user->getId() . PHP_EOL;
} catch (FacebookResponseException $e) {
  // Handle the error
  echo 'Graph returned an error: ' . $e->getMessage();
} catch (FacebookSDKException $e) {
  // Handle other errors
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
}