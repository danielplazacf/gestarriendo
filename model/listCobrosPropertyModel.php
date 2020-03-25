<?php
	/*-------------------------
	Autor: Jesús Caballero P.
	Web: integramosweb.pro
	Correo: web@integramosweb.pro
    ---------------------------*/

	//Solicitamos Conexion
	require_once('../gt-config/conexion.php');

	$datos['data'] = [];

	$key = $_GET['id_property'];

	//$query = "SELECT * FROM tbl_property_system ORDER BY name_owner ASC";
	$statement = $con->prepare("SELECT * FROM tbl_cobros_property WHERE id_property = '$key' ORDER BY id_cobro_property ASC");
	$statement->execute();
	while ($row = $statement->fetch()){
		$datos['data'][] = $row;
	}

	echo json_encode($datos);

?>