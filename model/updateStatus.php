<?php
	require_once('../gt-config/conexion.php');

	$id = $_POST['id'];
	$status = $_POST['status'];
	$source = $_POST['source'];

	if($source == "pago"){
		$table = "tbl_pagos_property";
		$column_id = "id_pago_property";
	}else{
		$table = "tbl_cobros_property";
		$column_id = "id_cobro_property";
	}

	$query = $con->prepare("UPDATE ".$table." set estatus = :status WHERE ".$column_id." = :id");

	$query->bindParam('id', $id);
	$query->bindParam('status',$status);

	if($query->execute()){
		echo 'ok';
	}else{
		die($query);
	}