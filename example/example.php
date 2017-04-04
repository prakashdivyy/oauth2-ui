<?php

require "vendor/autoload.php";

$provider = new Q5Studio\OAuth2\Client\Provider\UI([
    'clientId' => 'CLIENT_ID',
    'clientSecret' => 'CLIENT_SECRET',
    'redirectUri' => 'REDIRECT_URL'
]);

$accessToken = $provider->getAccessToken('password', [
    'username' => 'USERNAME',
    'password' => 'PASSWORD'
]);

// Access Token
echo "Access Token : " . $accessToken . "<br>";

$user = $provider->getResourceOwner($accessToken);

// Get User ID
echo "ID SIAK : " . $user->getId() . "<br>";

// Get Nama
echo "Nama : " . $user->getNama() . "<br>";

// Get NPM
echo "NPM : " . $user->getNPM() . "<br>";

// Get Kode Organisasi
echo "Kode Organisasi : " . $user->getKdOrg() . "<br>";
