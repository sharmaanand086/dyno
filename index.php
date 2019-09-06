<?php
session_start();
include("isdk.php");
date_default_timezone_set('America/New_York');
$app = new iSDK;
if ($app->cfgCon("connectionName")) 
{
                $returnFields=array('Id','FirstName','LastName','Email','Password','Groups','Phone1','DateCreated');

				$contacts = $app->dsFind("Contact",1000,0,'Groups','17399', $returnFields);
				
				$countdata = count($contacts);
                
                $monc = date("m") . "<br>";
                $datec =  date("d", strtotime('-1 days')) . "<br>";
				$abc = 1;
				$sublist=array();
				while($abc < $countdata){
				    $iftime = $contacts[$abc]['DateCreated'];
				    $moni =  substr($iftime,4,2)."<br>";
				    $datei = substr($iftime,6,2)."<br>";
				    if($monc == $moni && $datec == $datei){
				        $sublist1 =array($contacts[$abc]['FirstName'],$contacts[$abc]['Email'],$contacts[$abc]['Phone1']);
				        array_push($sublist,$sublist1);
				    }
				    $abc++;
				    
				}
					$list = array ($sublist);
					$file = fopen("contacts1.csv","w");
                    foreach ($sublist as $line) {
                      fputcsv($file, $line);
                    }

                fclose($file);
}

?>
<!DOCTYPE html>
<html>
<head>
<style>
.button {
  background-color: #4CAF50;
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
}
</style>
</head>
<body>

<h2>CSS Buttons</h2>
<a href="https://www.arfeenkhan.com/monish/contacts1.csv" class="button">Download</a>


</body>
</html>