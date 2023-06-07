<?php

require_once __DIR__ . "/connectDB.php";
require_once __DIR__ . '/vendor/autoload.php';

use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;
use Facebook\Facebook;

if(isset($_GET['state'])){
    $_SESSION['FBRLH_state'] = $_GET['state'];
}

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

if(empty($access_token)){
    echo"<a href = '{$fb->getRedirectLoginHelper()->getLoginUrl("https://8556-113-22-113-75.ngrok-free.app/PHP_Server/Layout_Web/index.php?number=login")}'>Login with Facebook</a>";
}

$access_token = $fb->getRedirectLoginHelper()->getAccessToken();

if(isset($access_token)){
    try {
        $responseUser = $fb -> get('/me?fields=id, name, email, gender, link', $access_token);
        $responseImage = $fb -> get('/me/picture?redirect=false&width=250&height=250', $access_token);
        $fb_user = $responseUser -> getGraphUser();
        $fb_img = $responseImage -> getGraphUser();

        echo "<center><h1>", $fb_user["name"],"</h1><br>";
        echo "<center><h1>", $fb_user["id"], "</h1><br>";
        $iurl = $fb_img["url"];
        echo "<img src='$iurl' /></center>";
    }
    catch (\Facebook\Exceptions\FacebookResponseException $e){
        echo 'Graph returned an error: ' .$e->getMessage();
    } catch(\Facebook\Exceptions\FacebookSDKException){
        echo 'Facebook SDK returned an error'.$e->getMessage();
    }
}