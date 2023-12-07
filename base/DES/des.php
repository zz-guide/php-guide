<?php

ini_set("display_errors", "On");
error_reporting(E_ALL);
ini_set('date.timezone','Asia/Shanghai');


$text = 'xl123456?';
$key = pack('H*', md5('123456'));  //md5('123456')
$iv   = pack('H*', '1234567890abcdef1234567890abcdef');

$encrypted = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key, $text, MCRYPT_MODE_CBC, $iv);
$encrypted = base64_encode($encrypted);
var_dump("加密：", $encrypted);

$dncrypted = base64_decode($encrypted);
$dncrypted = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $key, $dncrypted, MCRYPT_MODE_CBC, $iv);
$dncrypted = trim($dncrypted);
var_dump("解密：", $dncrypted);


