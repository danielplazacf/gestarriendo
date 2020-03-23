<?php
	/*-------------------------
    Autor: Jesús Caballero P.
    Web: integramosweb.pro
    Correo: web@integramosweb.pro
	---------------------------*/
	
	// Requerimos conexion a la DDBB
	require_once('../gt-config/conexion.php');

	// REQUEST METHOD POST
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {

		$titular_account = filter_var($_POST['titular_account'], FILTER_SANITIZE_STRING);
		$rut_account = filter_var($_POST['rut_account'], FILTER_SANITIZE_STRING);
		$bank_account = filter_var($_POST['bank_account'], FILTER_SANITIZE_STRING);
		$type_account = filter_var($_POST['type_account'], FILTER_SANITIZE_STRING);
		$number_account = filter_var($_POST['number_account'], FILTER_SANITIZE_STRING);
		$email_account = filter_var($_POST['email_account'], FILTER_SANITIZE_STRING);

		$query = $con->prepare("INSERT INTO tbl_account_bank (titular_account, rut_account, bank_account, type_account, number_account, email_account)
         VALUES (:titular_account,:rut_account,:bank_account,:type_account,:number_account,:email_account)");
         
        // bindParam('valor_input', $variable_input);
		$query->bindParam('titular_account', $titular_account);
		$query->bindParam('rut_account', $rut_account);

		$query->bindParam('bank_account', $bank_account);
		$query->bindParam('type_account', $type_account);
		$query->bindParam('number_account', $number_account);
		$query->bindParam('email_account', $email_account);

		if ($query->execute()) {
				echo 'ok';
			}else{
                echo 'error';
                die($query);
			}
	}

