<?php

include('PasswordHash.php');
require_once('PasswordHash.php' );
$hasher  = new PasswordHash(8,false);
    	$correct = 'test12345';
		$hash 	 = $hasher->HashPassword($correct);
var_dump($hash);
?>