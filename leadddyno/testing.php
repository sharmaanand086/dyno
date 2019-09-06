<?php
$full_name = ;
$email = ;
$amount = 40000;
$phone = ;

$plan='p1';
$url = 'https://api.leaddyno.com/v1/purchases';
 $req = array('key' => 'e3eeb534b6ac8b4bbc914913b23b598353dc7087',
              'email' => $email,
              'plan' => $plan,
              'purchase_amount'=>$amount
              );
 $fields_string =http_build_query($req);
 $ch = curl_init();
 curl_setopt($ch,CURLOPT_URL,$url);
 curl_setopt($ch,CURLOPT_POST,1);
 curl_setopt($ch,CURLOPT_POSTFIELDS,$fields_string);
 curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
 $afResult = curl_exec($ch);
 curl_close($ch);
 $afJson = json_decode($afResult);
 var_dump($afJson);


$body = array(
    "full_name" => $full_name,
    "email" => $email,
    "amount" => $amount,
    "phone" => $phone,
    "state" => "Maharastra",
    "currency"=>"INR"
);
$token = 'QW234FREUYTGFDE54F';
$ch2 = curl_init();
curl_setopt($ch2, CURLOPT_URL, "http://coachtofortune.com/coachinghub/api/user/v1/payment.php/update");
curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch2, CURLOPT_HEADER, 1);
curl_setopt($ch2, CURLOPT_POSTFIELDS, $body);
curl_setopt($ch2, CURLOPT_HTTPHEADER, array('Api-Key: ' . $token));  

$output = curl_exec($ch2);
var_dump($output);
curl_close($ch2);