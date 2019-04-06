<?php

$email = "cyrusmasseycook@gmail.com";

// reCaptcha info
$secret = "6LcwZJwUAAAAAGcPpCiM0NVOOnqrZIxwoyXEiYzQ";
// Development Site Key, will allow all requests
//$secret = "6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe";
$remoteip = $_SERVER["REMOTE_ADDR"];
$url = "https://www.google.com/recaptcha/api/siteverify";

// Form info
$response = $_GET["captcha"];

// Curl Request
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_POSTFIELDS, array(
	'secret' => $secret,
	'response' => $response,
	'remoteip' => $remoteip
	));
$curlData = curl_exec($curl);
curl_close($curl);

// Parse data
$response = json_decode($curlData, true);

if ($response["success"])
{
	die($email);
}
else
{
	die("Failure");
}
?>