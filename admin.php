<?php
session_start();

if ($_SESSION['username'] !== 'admin'){
	header("Location:index.php");
	die();
}




if (!empty($_POST['transaction'])){
	$config = file_get_contents('config.inf');
	$counter_pointer = (int)$config;
	$path = 'record/'.$counter_pointer.'.txt';
	$filehandle = fopen($path,'w');
	fwrite($filehandle,$_POST['transaction']);
	fclose($filehandle);
	$counter_pointer = (int)$counter_pointer + 1;
	file_put_contents('config.inf', $counter_pointer);

}

include("adminpanel.php");
?>


<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post">
<textarea name="transaction"  required autofocus></textarea>
<br>

<button type="submit" name="login">Simpan</button>
</form>


<script src="autosize.js"></script>
<script>
	var textarea = document.querySelectorAll("textarea")
	autosize(textarea)
</script>