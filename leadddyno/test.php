<?php
$cSession1 = curl_init(); 
curl_setopt($cSession1,CURLOPT_URL,"https://api.leaddyno.com/v1/affiliates/bhavesh@arfeenkhan.com?key=e3eeb534b6ac8b4bbc914913b23b598353dc7087");
curl_setopt($cSession1,CURLOPT_RETURNTRANSFER,true);
curl_setopt($cSession1,CURLOPT_HEADER, false); 
$result1=curl_exec($cSession1);
curl_close($cSession1);
$getid = json_decode($result1, true);
$id =  $getid['id'];



$cSession = curl_init(); 
curl_setopt($cSession,CURLOPT_URL,"https://api.leaddyno.com/v1/affiliates/".$id."/commissions?key=e3eeb534b6ac8b4bbc914913b23b598353dc7087");
curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
curl_setopt($cSession,CURLOPT_HEADER, false); 
$result=curl_exec($cSession);
curl_close($cSession);
echo $result;

?>