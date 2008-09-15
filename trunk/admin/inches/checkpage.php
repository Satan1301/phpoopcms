<?php
	session_start();
	if(isset($_POST['btnLogin'])){
		$loginUsername = $_POST["txtUsername"];
		$loginPassword = $_POST["txtPassword"];
		$loginOk = false;
		if ((md5($loginPassword) == PASSWORD)&&($loginUsername == USERNAME)) {
			$loginOk = true;
			$_SESSION["username"] = $loginUsername;
			$host  = $_SERVER['HTTP_HOST'];
			$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
			$extra = 'index.php';
			header("Location: http://$host$uri/$extra");
			$login = true;
			exit;
		}else{
			$host  = $_SERVER['HTTP_HOST'];
			$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
			$extra = 'index.php';
			//header("Location: http://$host$uri/$extra");
			$login = false;
			$loginOk = false;
		}
	}
	if (isset($_SESSION["username"])){
		$loginOk = true;
		$username = $_SESSION["username"];
	}else{
		$loginOk = false;
		$host  = $_SERVER['HTTP_HOST'];
		$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		$extra = 'index.php';
		//header("Location: http://$host$uri/$extra");
	}
?>