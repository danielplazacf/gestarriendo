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
        $id_property = filter_var($_POST['id_property'], FILTER_SANITIZE_NUMBER_INT);

		$agent = filter_var($_POST['agent_edit'], FILTER_SANITIZE_STRING);
		$date = filter_var($_POST['date_edit'], FILTER_SANITIZE_STRING);

		$type = filter_var($_POST['type_edit'], FILTER_SANITIZE_STRING);
		$date_init = filter_var($_POST['date_admin_edit'], FILTER_SANITIZE_STRING);
		$address = filter_var($_POST['address_edit'], FILTER_SANITIZE_STRING);
        //
		$client_agua = filter_var($_POST['agua_edit'], FILTER_SANITIZE_STRING);
		$client_luz = filter_var($_POST['luz_edit'], FILTER_SANITIZE_STRING);
		$client_gas = filter_var($_POST['gas_edit'], FILTER_SANITIZE_STRING);

		// $query = $con->prepare("INSERT INTO tbl_owner_system (agent_designated, date_register, name_owner, rut_owner, email_owner, phone_owner, last_date)
        //  VALUES (:agent_designated,:date_register,:name_owner,:rut_owner,:mail_owner,:phone_owner,:date_register)");

        $query = $con->prepare("UPDATE tbl_property_system 
        SET agent_designated = '$agent', type_property = '$type', date_administracion = '$date_init', address_property = '$address', n_client_agua = '$client_agua', n_client_luz = '$client_luz', n_client_gas = '$client_gas', last_date = '$date'
        WHERE id_property = '$id_property'");
         
        // bindParam('valor_input', $variable_input);
		$query->bindParam('agent_designated', $agent);
		$query->bindParam('date_register', $date);

		$query->bindParam('type_property', $type);
		$query->bindParam('date_administracion', $date_init);
		$query->bindParam('address_property', $address);

		$query->bindParam('n_client_agua', $client_agua);
		$query->bindParam('n_client_luz', $client_luz);
		$query->bindParam('n_client_gas', $client_gas);

		if ($query->execute()) {
				echo 'ok';
			}else{
                echo 'error';
                die($query);
			}
	}

