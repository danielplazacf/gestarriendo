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

		$type = filter_var($_POST['type_property'], FILTER_SANITIZE_STRING);
		$date_init = filter_var($_POST['date_administracion'], FILTER_SANITIZE_STRING);
		$address = filter_var($_POST['address_property'], FILTER_SANITIZE_STRING);
		/**
		 * cambio id por string en region
		 */
		$region = filter_var($_POST['region_property'], FILTER_SANITIZE_STRING);
		$region_sel = "SELECT name_region FROM tbl_regiones_system WHERE id_region = '$region'";
		$region_res = $con->query($region_sel);
		$row_region = $region_res->fetch(PDO::FETCH_ASSOC);
		$region_filter = filter_var($row_region['name_region'], FILTER_SANITIZE_STRING);

		$comuna = filter_var($_POST['comuna_property'], FILTER_SANITIZE_STRING);

		$client_agua = filter_var($_POST['n_cliente_agua'], FILTER_SANITIZE_STRING);
		$proveedor_agua = filter_var($_POST['proveedor_agua'], FILTER_SANITIZE_STRING);

		$client_luz = filter_var($_POST['n_cliente_luz'], FILTER_SANITIZE_STRING);
		$proveedor_luz = filter_var($_POST['proveedor_luz'], FILTER_SANITIZE_STRING);

		$client_gas = filter_var($_POST['n_cliente_gas'], FILTER_SANITIZE_STRING);
		$proveedor_gas = filter_var($_POST['proveedor_gas'], FILTER_SANITIZE_STRING);

		$hasParking = filter_var($_POST['hasParking'], FILTER_SANITIZE_STRING);
		$numberParking = filter_var($_POST['numberParking'], FILTER_SANITIZE_STRING);

		$hasWarehouse = filter_var($_POST['hasWarehouse'], FILTER_SANITIZE_STRING);
		$numberWarehouse = filter_var($_POST['numberWarehouse'], FILTER_SANITIZE_STRING);

		$query = $con->prepare("INSERT INTO tbl_property_system (agent_designated, date_register, type_property, date_administracion, address_property, region_property, comuna_property, n_client_agua, n_client_luz, n_client_gas, last_date, proveedor_agua, proveedor_luz, proveedor_gas, hasParking, numberParking, hasWarehouse, numberWarehouse)
		 VALUES (:agent_designated,:date_register,:type_property,:date_administracion,:address_property,:name_region,:comuna_property,:n_client_agua,:n_client_luz,:n_client_gas,:date_register, :proveedor_agua, :proveedor_luz, :proveedor_gas, :hasParking, :numberParking, :hasWarehouse, :numberWarehouse)");

		$query->bindParam('agent_designated', $agent);
		$query->bindParam('date_register', $date);

		$query->bindParam('type_property', $type);
		$query->bindParam('date_administracion', $date_init);
		$query->bindParam('address_property', $address);
		$query->bindParam('name_region', $region_filter);
		$query->bindParam('comuna_property', $comuna);

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
			}
	}

