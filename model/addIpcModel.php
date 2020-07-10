<?php
	require_once('../gt-config/conexion.php');

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$id_contrato = filter_var($_POST['ipcContrato_ID'], FILTER_SANITIZE_STRING);
	    $recurrencia = filter_var($_POST['ipcRecurrencia'], FILTER_SANITIZE_STRING);
	    $fecha_inicio = filter_var($_POST['ipcFechaInicio'], FILTER_SANITIZE_STRING);

	    $dateTo = date('Y-m-d',strtotime('+'.$recurrencia.' month', strtotime($fecha_inicio)));

	    $stmt = $con->prepare("SELECT COUNT(*) as cantidad FROM tbl_ipc_config WHERE id_contrato = ".$id_contrato);
	    $stmt->execute();
	    $rs = $stmt->fetch();

	    if(!$rs['cantidad']){
	    	$query = $con->prepare("INSERT INTO tbl_ipc_config (id_contrato, recurrencia, fecha_inicio) VALUES ($id_contrato, $recurrencia, '".$dateTo."')");
		    if($query->execute()){
		    	echo "ok";
		    }else{
		    	echo "error";
		    }
	    }else{
	    	$query = $con->prepare("UPDATE tbl_ipc_config SET recurrencia = $recurrencia, fecha_inicio = '".$dateTo."' WHERE id_contrato = ".$id_contrato);
		    if($query->execute()){
		    	echo "ok";
		    }else{
		    	echo "error";
		    }
	    }

	}