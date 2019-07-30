<?php

include("adminpanel.php");

for($x=1;$x<=40;$x++) {
	$password = hash("md5",$x);
	$password = substr($password,0,4);
	echo "{$x} : {$password}<br>";
}



?>