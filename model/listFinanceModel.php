<?php
	/*-------------------------
	Autor: Jesús Caballero P.
	Web: integramosweb.pro
	Correo: web@integramosweb.pro
    ---------------------------*/

	//Solicitamos Conexion
	require_once('../gt-config/conexion.php');

	if($_GET['get'] === 'pagos'){
		$datos['data'] = [];
		//$key = $_GET['id_property'];
		//$query = "SELECT * FROM tbl_property_system ORDER BY name_owner ASC";
		$statement = $con->prepare("SELECT *,  
		CASE WHEN desde_pago = 'Propietario' THEN (SELECT tcs.name_owner FROM tbl_contrato_system tcs WHERE tpp.id_property = tcs.id_property order by tcs.id_contrato DESC limit 1) WHEN desde_pago = 'Arrendatario' THEN (SELECT tcs.name_leaser FROM tbl_contrato_system tcs WHERE tpp.id_property = tcs.id_property order by tcs.id_contrato DESC limit 1)
  ELSE 'Gestarriendo'
  END AS name_desde_pago, 
		CASE WHEN hacia_pago = 'Propietario' THEN (SELECT tcs.name_owner FROM tbl_contrato_system tcs WHERE tpp.id_property = tcs.id_property order by tcs.id_contrato DESC limit 1)
  WHEN hacia_pago = 'Arrendatario' THEN (SELECT tcs.name_leaser FROM tbl_contrato_system tcs WHERE tpp.id_property = tcs.id_property order by tcs.id_contrato DESC limit 1)
  ELSE 'Gestarriendo' END AS name_hacia_pago,
  tps.address_property,
  tps.comuna_property
  FROM tbl_pagos_property as tpp 
  inner join tbl_property_system as tps on (tps.id_property = tpp.id_property)
  WHERE tpp.hidden_recurrent = 0 ORDER BY tpp.id_pago_property ASC");
		$statement->execute();
		while ($row = $statement->fetch()){
			$datos['data'][] = $row;
		}

		echo json_encode($datos);

	}else if($_GET['get'] === 'cobros'){
		$datos['data'] = [];
		//$key = $_GET['id_property'];
		//$query = "SELECT * FROM tbl_property_system ORDER BY name_owner ASC";
		$statement = $con->prepare("SELECT *,
		CASE WHEN desde_cobro = 'Propietario' THEN (SELECT tcs.name_owner FROM tbl_contrato_system tcs WHERE tcp.id_property = tcs.id_property order by tcs.id_contrato DESC limit 1) WHEN desde_cobro = 'Arrendatario' THEN (SELECT tcs.name_leaser FROM tbl_contrato_system tcs WHERE tcp.id_property = tcs.id_property order by tcs.id_contrato DESC limit 1)
  ELSE 'Gestarriendo'
  END AS name_desde_cobro, 
		CASE WHEN hacia_cobro = 'Propietario' THEN (SELECT tcs.name_owner FROM tbl_contrato_system tcs WHERE tcp.id_property = tcs.id_property order by tcs.id_contrato DESC limit 1)
  WHEN hacia_cobro = 'Arrendatario' THEN (SELECT tcs.name_leaser FROM tbl_contrato_system tcs WHERE tcp.id_property = tcs.id_property order by tcs.id_contrato DESC limit 1)
  ELSE 'Gestarriendo' END AS name_hacia_cobro,
  tps.address_property,
  tps.comuna_property
  FROM tbl_cobros_property as tcp 
  inner join tbl_property_system as tps on (tps.id_property = tcp.id_property)
  WHERE tcp.hidden_recurrent = 0 ORDER BY tcp.id_cobro_property ASC");
		$statement->execute();
		while ($row = $statement->fetch()){
			$datos['data'][] = $row;
		}
		
		echo json_encode($datos);
	}

?>