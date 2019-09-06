<?php

$bc = array("Peter", "Griffiasdasdn" ,"Oslo", "Norway");
$bc1 = array("Glenn", "Quaasdasdasdasdasdasgmire", "Oslo", "Norway");
 $list = array (
   $bc,$bc1
 );

$file = fopen("contacts.csv","w");
var_dump($list);
foreach ($list as $line) {
  fputcsv($file, $line);
}

fclose($file);
?>