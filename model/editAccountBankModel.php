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
        $id_account_bank = filter_var($_POST['id_account_bank'], FILTER_SANITIZE_NUMBER_INT);

		$titular_account = filter_var($_POST['titular_edit'], FILTER_SANITIZE_STRING);
		$rut_account = filter_var($_POST['rut_edit'], FILTER_SANITIZE_STRING);
		$bank_account = filter_var($_POST['bank_edit'], FILTER_SANITIZE_STRING);
		$type_account = filter_var($_POST['type_edit'], FILTER_SANITIZE_STRING);
		$number_account = filter_var($_POST['number_edit'], FILTER_SANITIZE_STRING);
		$email_account = filter_var($_POST['email_edit'], FILTER_SANITIZE_STRING);

		$query = $con->prepare("UPDATE tbl_account_bank 
        SET titular_account = '$titular_account', rut_account = '$rut_account', bank_account = '$bank_account', type_account = '$type_account', number_account = '$number_account', email_account = '$email_account'
        WHERE id_account_bank = '$id_account_bank'");
         
        // bindParam('valor_input', $variable_input);
		$query->bindParam('titular_edit', $titular_account);
		$query->bindParam('rut_edit', $rut_account);

		$query->bindParam('bank_edit', $bank_account);
		$query->bindParam('type_edit', $type_account);
		$query->bindParam('number_edit', $number_account);
		$query->bindParam('email_edit', $email_account);

		if ($query->execute()) {
				echo 'ok';
			}else{
                echo 'error';
                die($query);
			}
	}

