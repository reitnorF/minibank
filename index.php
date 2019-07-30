<?php

ob_start();
session_start();

if (isset($_SESSION['username'])) {
	if ($_SESSION['username'] == 'admin') {
		header("Location:admin.php");
	}	
	else {
		header("Location:user.php");
	} 
}


function checkCredentials($uname,$pw){
	$intrep = (int)$uname;
	if (($intrep>=1) && ($intrep <=40)){
		$password = hash("md5",$uname);
		$password = substr($password,0,4);
		if($pw == $password){
			return true;
		}
		else{
			return false;
		}

	}
	else{
		return false;
	}
}

if (isset($_POST['login']) && !empty($_POST['username']) && !empty($_POST['password'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];
	if ($username == 'anita' && $password == 'admin'){
		$_SESSION['valid'] = true;
		$_SESSION['timeout'] = time();
		$_SESSION['username'] = 'admin';
		header("Location:admin.php");
		die();
	}
	elseif (checkCredentials($username,$password)) {
		$_SESSION['username'] = $username;
		header("Location:user.php");
	}
	else{
		echo "Wrong!";
	}
}




?>





<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post">
<input type="text" name="username" required autofocus>
<br>
<input type="password" name="password" required>
<button type="submit" name="login">Login</button>
</form>