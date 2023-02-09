<?php
//config.php

//Include Google Client Library for PHP autoload file
require_once 'vendor/autoload.php';

//Make object of Google API Client for call Google API
$google_client = new Google_Client();

//Set the OAuth 2.0 Client ID
$google_client->setClientId('547018059758-t5lrlp2i4207bfk7mmrbpv5ane3j7ab4.apps.googleusercontent.com');

//Set the OAuth 2.0 Client Secret key
$google_client->setClientSecret('ZwOR9PNGQaEFGSu-GgW96-9S');

//Set the OAuth 2.0 Redirect URI
$google_client->setRedirectUri('https://motortraderbd.com/rashik/gmail-callback.php');

//
$google_client->addScope('email');

$google_client->addScope('profile');

//start session on web page
session_start();

