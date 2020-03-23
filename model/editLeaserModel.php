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
        $id_leaser = filter_var($_POST['id_leaser_system'], FILTER_SANITIZE_NUMBER_INT);

		$agent = filter_var($_POST['agent_edit'], FILTER_SANITIZE_STRING);
        $date = filter_var($_POST['date_edit'], FILTER_SANITIZE_STRING);
        
		$name = filter_var($_POST['name_edit'], FILTER_SANITIZE_STRING);
		$rut = filter_var($_POST['rut_edit'], FILTER_SANITIZE_STRING);
		$email = filter_var($_POST['mail_edit'], FILTER_SANITIZE_STRING);
        $phone = filter_var($_POST['phone_one_edit'], FILTER_SANITIZE_STRING);
        $phone_two = filter_var($_POST['phone_two_edit'], FILTER_SANITIZE_STRING);
        
		$query = $con->prepare("UPDATE tbl_leaser_system
        SET agent_designated = '$agent', name_leaser = '$name', rut_leaser = '$rut', email_leaser = '$email', phone_one_leaser = '$phone', phone_two_leaser = '$phone_two', last_date = '$date'
        WHERE id_leaser_system = '$id_leaser'");

        // bindParam('valor_input', $variable_input);
		$query->bindParam('agent_edit', $agent);
		$query->bindParam('date_edit', $date);

		$query->bindParam('name_edit', $name);
		$query->bindParam('rut_edit', $rut);
		$query->bindParam('mail_edit', $email);
        $query->bindParam('phone_one_edit', $phone);
        $query->bindParam('phone_two_edit', $phone_two);

		if ($query->execute()) {
				echo 'ok';
			}else{
				echo 'error';
                die($query);
			}
	}

