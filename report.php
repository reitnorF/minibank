<?php
session_start();

if ($_SESSION['username'] !== 'admin'){
	header("Location:index.php");
	die();
}

include("adminpanel.php");


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
	$filecontent_exp = explode("\n",$filecontent);
	$date = array_shift($filecontent_exp);
	echo $date."<br>";
	foreach($filecontent_exp as $line){
		echo "&nbsp;&nbsp&nbsp"."$line"."<br>";
		$trans_line = explode(":",$line);
		$account_name = strtoupper($trans_line[0]);
		if(!isset($master_account[$account_name])){
			$master_account[$account_name] = 0;
		}
			$master_account[$account_name] = $master_account[$account_name] + (int)$trans_line[1];
	}

}


echo "<br>";
$grandtotal = 0;
foreach($master_account as $k=>$v){
	echo "{$k} : Rp {$v}000 <br>";
	$grandtotal = $grandtotal + $v;
}

echo "<br>Total Saldo Bank : Rp {$grandtotal}000<br>";



?>
