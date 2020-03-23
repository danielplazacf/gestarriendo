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
        $id_owner = filter_var($_POST['id_owner_system'], FILTER_SANITIZE_NUMBER_INT);

		$agent = filter_var($_POST['agent_edit'], FILTER_SANITIZE_STRING);
		$date = filter_var($_POST['date_edit'], FILTER_SANITIZE_STRING);

		//tab 1
		$name = filter_var($_POST['name_edit'], FILTER_SANITIZE_STRING);
		$rut = filter_var($_POST['rut_edit'], FILTER_SANITIZE_STRING);
		$mail = filter_var($_POST['mail_edit'], FILTER_SANITIZE_STRING);
		$phone = filter_var($_POST['phone_edit'], FILTER_SANITIZE_STRING);

		// tab 2
		$titular = filter_var($_POST['titular_edit'], FILTER_SANITIZE_STRING);
		$rut_titular = filter_var($_POST['rut_account_edit'], FILTER_SANITIZE_STRING);
		$bank = filter_var($_POST['bank_edit'], FILTER_SANITIZE_STRING);
		$type = filter_var($_POST['type_edit'], FILTER_SANITIZE_STRING);
		$number = filter_var($_POST['number_edit'], FILTER_SANITIZE_STRING);
		$mail_confirmation = filter_var($_POST['email_account_edit'], FILTER_SANITIZE_STRING);

		// $query = $con->prepare("INSERT INTO tbl_owner_system (agent_designated, date_register, name_owner, rut_owner, email_owner, phone_owner, last_date)
        //  VALUES (:agent_designated,:date_register,:name_owner,:rut_owner,:mail_owner,:phone_owner,:date_register)");

        $query = $con->prepare("UPDATE tbl_owner_system 
        SET agent_designated = '$agent', name_owner = '$name', rut_owner = '$rut', email_owner = '$mail', phone_owner = '$phone', last_date = '$date', titular_account = '$titular', rut_account = '$rut_titular', bank_account = '$bank', type_account = '$type', number_account = '$number', email_account = '$mail_confirmation' 
        WHERE id_owner_system = '$id_owner'");
         
        // bindParam('valor_input', $variable_input);
		$query->bindParam('agent_edit', $agent);
		$query->bindParam('date_edit', $date);

		//tab 1
		$query->bindParam('name_edit', $name);
		$query->bindParam('rut_edit', $rut);
		$query->bindParam('mail_edit', $mail);
		$query->bindParam('phone_edit', $phone);

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

