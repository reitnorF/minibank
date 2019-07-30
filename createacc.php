<?php
session_start();

if ($_SESSION['username'] !== 'admin'){
	header("Location:index.php");
	die();
}




if (!empty($_POST['acc'])){
	$path = "user.db";
	$filehandle = fopen($path,'w');
	fwrite($filehandle,$_POST['acc']);
	fclose($filehandle);
}


include("adminpanel.php");
?>


<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post">
<textarea name="acc"  required autofocus><?php	$config = file_get_contents('user.db');echo $config;?>
</textarea>
<br>

<button type="submit" name="login">Simpan</button>
</form>


<script src="autosize.js"></script>
<script>
	var textarea = document.querySelectorAll("textarea")
	autosize(textarea)
</script>