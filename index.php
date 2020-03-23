<?php session_start();

	/*-------------------------
	  Autor: Jesús Caballero P.
	  Web: www.betahost.cl
	  Correo: uebeats@gmail.com
	  ---------------------------*/

	if($_SESSION['user_system']){
	    header('Location: escritorio.php');
	}else{
		header('Location: login.php');
	}
?>