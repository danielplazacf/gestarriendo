<?php
	/*-------------------------
		Autor: Jesús Caballero P.
		Web: integramosweb.pro
		Correo: web@integramosweb.pro
		---------------------------*/

	//Solicitamos Conexion
	require_once('../gt-config/conexion.php');

	// arreglo vacio
	$datos['data'] = [];

	$key = $_POST['id_property'];
	//$key = '2';

	// $query = "SELECT * FROM tbl_property_system ORDER BY name_owner ASC";
	$statement = $con->prepare("SELECT * FROM tbl_contrato_system WHERE id_contrato = '$key'");
	$statement->execute();
	$row = $statement->fetch(PDO::FETCH_ASSOC);
	
	if (empty($row)) {
		$data = ['error' => 'vacio'];
		echo json_encode($data);
	} else {
		$name = $row['name_leaser'];
		$stmt = $con->prepare("SELECT * FROM tbl_leaser_system WHERE name_leaser = '$name'");
		$stmt->execute();
		$data = $stmt->fetch(PDO::FETCH_ASSOC);
		$datos['data'][] = $data;

		echo json_encode($data);
	}

	// $name = $row['name_leaser'];

	// if(empty($name)){
	// 	$data['data'] = [];
	// 	echo json_encode($data);
	// }else if($name){
	// 	$stmt = $con->prepare("SELECT * FROM tbl_leaser_system WHERE name_leaser = '$name'");
	// 	$stmt->execute();
	// 	$data = $stmt->fetch(PDO::FETCH_ASSOC);
	// 	$datos['data'][] = $data;

	// 	echo json_encode($data);
	// }

	// if ($stmt->execute()) {
	// 	$data = $stmt->fetch(PDO::FETCH_ASSOC);
	// 	$datos['data'][] = $data;
	// 	echo json_encode($data);
    // } else {
    //     echo 'vacio';
    //     die($query);
    // }
    
    // if(empty($stmt)){
	// 	echo 'vacio';
	// }else{
	// 	$datos['data'][] = $data;
	// 	echo json_encode($data);
	// }
