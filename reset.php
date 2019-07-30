<?php

ob_start();
session_start();

if ($_SESSION['username'] !== 'admin'){
	header("Location:index.php");
	die();
}

if (!empty($_POST['password'])) {
	$password = $_POST['password'];
	if ($password == 'hapus'){
		$files = glob('record/*');
		foreach($files as $file){
			if(is_file($file)) unlink($file);
		}
		$counter_pointer = 1;
		file_put_contents('config.inf', $counter_pointer);
		echo "Bank reset success!";
	}
	else{
		echo "Wrong password!";
	}
}




?>





<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post">
<h3>Input secret password to reset all</h3>
<input type="password" name="password" required>
<button type="submit" name="login">Login</button>
</form>