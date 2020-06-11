<?php
	/*-------------------------
	Autor: Jesús Caballero P.
	Web: integramosweb.pro
	Correo: web@integramosweb.pro
    ---------------------------*/

	//Solicitamos Conexion
	require_once('../gt-config/conexion.php');

	$datos['data'] = [];

	$key = $_POST['id_contrato'];

	//$query = "SELECT * FROM tbl_property_system ORDER BY name_owner ASC";
	$statement = $con->prepare("SELECT * FROM tbl_contrato_system WHERE id_contrato = '$key'");
	$statement->execute();
    $data = $statement->fetch(PDO::FETCH_ASSOC);
    
    $datos['data'][] = $data;

	echo json_encode($data);

?>