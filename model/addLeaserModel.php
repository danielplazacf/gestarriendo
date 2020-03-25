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
        
		$name = filter_var($_POST['name_leaser'], FILTER_SANITIZE_STRING);
		$rut = filter_var($_POST['rut_leaser'], FILTER_SANITIZE_STRING);
		$email = filter_var($_POST['mail_leaser'], FILTER_SANITIZE_STRING);
        $phone = filter_var($_POST['phone_leaser'], FILTER_SANITIZE_STRING);
        $phone_two = filter_var($_POST['phone_leaser_two'], FILTER_SANITIZE_STRING);
        
		$query = $con->prepare("INSERT INTO tbl_leaser_system (agent_designated, date_register, name_leaser, rut_leaser, email_leaser, phone_one_leaser, phone_two_leaser, last_date)
         VALUES (:agent_designated,:date_register,:name_leaser,:rut_leaser,:mail_leaser,:phone_leaser,:phone_leaser_two,:date_register)");
         
        // bindParam('valor_input', $variable_input);
		$query->bindParam('agent_designated', $agent);
		$query->bindParam('date_register', $date);

		$query->bindParam('name_leaser', $name);
		$query->bindParam('rut_leaser', $rut);
		$query->bindParam('mail_leaser', $email);
        $query->bindParam('phone_leaser', $phone);
        $query->bindParam('phone_leaser_two', $phone_two);

		if ($query->execute()) {
				echo 'ok';
			}else{
				echo 'error';
                die($query);
			}
	}

