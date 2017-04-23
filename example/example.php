<?php

require "vendor/autoload.php";

$provider = new PrakashDivy\OAuth2\Client\Provider\UI([
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

// Get Angkatan
echo "Angkatan : " . $user->getAngkatan() . "<br>";

// Get Kode Organisasi
echo "Kode Organisasi : " . $user->getKdOrg() . "<br>";

// Get Fakultas
echo "Fakultas : " . $user->getFakultas() . "<br>";

// Get Prodi
echo "Prodi : " . $user->getProdi() . "<br>";

// Get Jenjang
echo "Jenjang : " . $user->getJenjang() . "<br>";
