<?php

$body = array(
    "full_name" => "mazhar",
    "email" => "mazhar@arfeenkhan.com",
    "amount" => "40000",
    "phone" => "9876543210",
    "state" => "masdas",
    "currency"=>"INR"
);
$token = 'QW234FREUYTGFDE54F';
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://coachtofortune.com/coachinghub/api/user/v1/payment.php/update");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HEADER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Api-Key: ' . $token));  

$output = curl_exec($ch);
var_dump($output);
curl_close($ch);