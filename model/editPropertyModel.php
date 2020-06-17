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
		$client_agua = filter_var($_POST['n_cliente_agua_edit'], FILTER_SANITIZE_STRING);
		$proveedor_agua = filter_var($_POST['proveedor_agua_edit'], FILTER_SANITIZE_STRING);

		$client_luz = filter_var($_POST['n_cliente_luz_edit'], FILTER_SANITIZE_STRING);
		$proveedor_luz = filter_var($_POST['proveedor_luz_edit'], FILTER_SANITIZE_STRING);

		$client_gas = filter_var($_POST['n_cliente_gas_edit'], FILTER_SANITIZE_STRING);
		$proveedor_gas = filter_var($_POST['proveedor_gas_edit'], FILTER_SANITIZE_STRING);

		$hasParking = filter_var(@$_POST['hasParkingEdit'], FILTER_SANITIZE_STRING);
		$numberParking = filter_var($_POST['numberParkingEdit'], FILTER_SANITIZE_STRING);

		if($numberParking == ''){
			$numberParking = "NULL";
		}

		if(!$hasParking){
			$hasParking = 'N';
		}

		$hasWarehouse = filter_var(@$_POST['hasWarehouseEdit'], FILTER_SANITIZE_STRING);
		$numberWarehouse = filter_var($_POST['numberWarehouseEdit'], FILTER_SANITIZE_STRING);

		if($numberWarehouse == ''){
			$numberWarehouse = "NULL";
		}

		if(!$hasWarehouse){
			$hasWarehouse = 'N';
		}

		// $query = $con->prepare("INSERT INTO tbl_owner_system (agent_designated, date_register, name_owner, rut_owner, email_owner, phone_owner, last_date)
        //  VALUES (:agent_designated,:date_register,:name_owner,:rut_owner,:mail_owner,:phone_owner,:date_register)");""

        $query = $con->prepare("UPDATE tbl_property_system 
        SET agent_designated = '$agent', type_property = '$type', date_administracion = '$date_init', address_property = '$address', n_client_agua = '$client_agua', n_client_luz = '$client_luz', n_client_gas = '$client_gas', last_date = '$date', proveedor_agua = '$proveedor_agua', proveedor_luz = '$proveedor_luz', proveedor_gas = '$proveedor_gas', hasParking = '$hasParking', numberParking = ".$numberParking.", hasWarehouse = '$hasWarehouse', numberWarehouse = ".$numberWarehouse."
        WHERE id_property = ".$id_property);
         
        // bindParam('valor_input', $variable_input);
		$query->bindParam('agent_designated', $agent);
		$query->bindParam('date_register', $date);

		$query->bindParam('type_property', $type);
		$query->bindParam('date_administracion', $date_init);
		$query->bindParam('address_property', $address);

		$query->bindParam('n_client_agua', $client_agua);
		$query->bindParam('proveedor_agua', $proveedor_agua);

		$query->bindParam('n_client_luz', $client_luz);
		$query->bindParam('proveedor_luz', $proveedor_luz);

		$query->bindParam('n_client_gas', $client_gas);
		$query->bindParam('proveedor_gas', $proveedor_gas);

		$query->bindParam('hasParking', $hasParking);
		$query->bindParam('numberParking', $numberParking);

		$query->bindParam('hasWarehouse', $hasWarehouse);
		$query->bindParam('numberWarehouse', $numberWarehouse);

		if ($query->execute()) {
				echo 'ok';
			}else{
                echo 'error';
                die($query);
			}
	}

