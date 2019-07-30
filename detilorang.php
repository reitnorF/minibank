<?php

session_start();


if ($_SESSION['username'] !== 'admin'){
	header("Location:index.php");
	die();
}
include("adminpanel.php");



$userdb = file_get_contents('user.db');
$userdb_exp = explode("\n",$userdb);
$master_user = array();
foreach($userdb_exp as $line){
	$key_value = explode(":",$line);
	$master_user[@strtoupper($key_value[1])] = $key_value[0] ;
}

$userkey = $_GET['k'];
$userkey = rtrim($userkey);
echo "Detil rekening ".$userkey."<br>";


$total_amount =0;
$files = array_slice(scandir('record'),2);
$master_account = array();


$sortedfiles = array();
foreach($files as $filename){
	$a = preg_split("/\./",$filename);
	//echo $a[0];
	$sortedfiles[$a[0]] = $filename;
}
krsort($sortedfiles);


foreach($sortedfiles as $filename){
	$filecontent = file_get_contents('record/'.$filename);
	$pattern = "/\b".$userkey.":/i";
	if(preg_match($pattern,$filecontent)){
		$filecontent_exp = explode("\n",$filecontent);
		$date = array_shift($filecontent_exp);
		//echo $date."<br>";
		foreach($filecontent_exp as $line){
			if(preg_match("/^{$userkey}\s*:/i",$line)){
				//echo "&nbsp;&nbsp&nbsp"."$line"."<br>";
				$trans_line = explode(":",$line);
				$total_amount = $total_amount + (int)$trans_line[1];
			}
		}	
	}
}

echo "Saldo Rekening : Rp {$total_amount}000<br><br>";


foreach($sortedfiles as $filename){
	$filecontent = file_get_contents('record/'.$filename);
	$pattern = "/\b".$userkey.":/i";
	if(preg_match($pattern,$filecontent)){
		$filecontent_exp = explode("\n",$filecontent);
		$date = array_shift($filecontent_exp);
		#echo $date."<br>";
		foreach($filecontent_exp as $line){
			if(preg_match("/^{$userkey}\s*:/i",$line)){
				#echo "&nbsp;&nbsp&nbsp"."$line"."000<br>";
				$trans_line = explode(":",$line);
				$trans_line[1] = rtrim($trans_line[1]);
				echo $trans_line[1]."000  ({$date})<br>";
			}
		}	
	}
}



?>





