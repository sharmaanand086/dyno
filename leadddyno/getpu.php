<?php
$url = 'https://api.leaddyno.com/v1/leads';
 $req = array('key' => 'e3eeb534b6ac8b4bbc914913b23b598353dc7087',
 'email' => 'siddhi@arfeenkhan.com',
              
              
              );
 $fields_string =http_build_query($req);
 $ch = curl_init();
 curl_setopt($ch,CURLOPT_URL,$url);
 curl_setopt($ch,CURLOPT_GET,1);
 curl_setopt($ch,CURLOPT_POSTFIELDS,$fields_string);
 curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
 $afResult = curl_exec($ch);
 curl_close($ch);
 $afJson = json_decode($afResult);
 var_dump($afJson);
