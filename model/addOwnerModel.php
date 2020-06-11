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
		$agent = filter_var($_POST['agent_designated'], FILTER_SANITIZE_STRING);
		$date = filter_var($_POST['date_register'], FILTER_SANITIZE_STRING);

		//tab 1
		$name = filter_var($_POST['name_owner'], FILTER_SANITIZE_STRING);
		$rut = filter_var($_POST['rut_owner'], FILTER_SANITIZE_STRING);
		$mail = filter_var($_POST['mail_owner'], FILTER_SANITIZE_STRING);
		$phone = filter_var($_POST['phone_owner'], FILTER_SANITIZE_STRING);

		// tab 2
		$titular = filter_var($_POST['titular_account'], FILTER_SANITIZE_STRING);
		$rut_titular = filter_var($_POST['rut_account'], FILTER_SANITIZE_STRING);
		$bank = filter_var($_POST['bank_account'], FILTER_SANITIZE_STRING);
		$type = filter_var($_POST['type_account'], FILTER_SANITIZE_STRING);
		$number = filter_var($_POST['number_account'], FILTER_SANITIZE_STRING);
		$mail_confirmation = filter_var($_POST['email_account'], FILTER_SANITIZE_STRING);

		$query = $con->prepare("INSERT INTO tbl_owner_system (agent_designated, date_register, name_owner, rut_owner, email_owner, phone_owner, last_date, titular_account, rut_account, bank_account, type_account, number_account, email_account)
         VALUES (:agent_designated,:date_register,:name_owner,:rut_owner,:mail_owner,:phone_owner,:date_register,:titular_account,:rut_account,:bank_account,:type_account,:number_account,:email_account)");
         
        // bindParam('valor_input', $variable_input);
		$query->bindParam('agent_designated', $agent);
		$query->bindParam('date_register', $date);

		//tab 1
		$query->bindParam('name_owner', $name);
		$query->bindParam('rut_owner', $rut);
		$query->bindParam('mail_owner', $mail);
		$query->bindParam('phone_owner', $phone);

		//tab 2
		$query->bindParam('titular_account', $titular);
		$query->bindParam('rut_account', $rut_titular);
		$query->bindParam('bank_account', $bank);
		$query->bindParam('type_account', $type);
		$query->bindParam('number_account', $number);
		$query->bindParam('email_account', $mail_confirmation);

		if ($query->execute()) {
				echo 'ok';
			}else{
                echo 'error';
                die($query);
			}
	}

