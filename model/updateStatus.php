<?php
	require_once('../gt-config/conexion.php');

	$id = $_POST['id'];
	$status = $_POST['status'];
	$source = $_POST['source'];
	$abono_description = $_POST['abono_description'];
	$abono_amount = $_POST['abono_amount'];

	if($source == "pago"){
		$table = "tbl_pagos_property";
		$column_id = "id_pago_property";
		$columna_amount = "amount_psimple";
		$type = "pago";
	}else{
		$table = "tbl_cobros_property";
		$column_id = "id_cobro_property";
		$columna_amount = "amount_csimple";
		$type = "cobro";
	}


	if($status != 'abonar'){

		$query = $con->prepare("UPDATE ".$table." set estatus = :status WHERE ".$column_id." = :id");

		$query->bindParam('id', $id);
		$query->bindParam('status',$status);

		if($query->execute()){
			echo 'ok';
		}else{
			die($query);
		}
	}else{
		$con->beginTransaction();
		$errors = 0;
		$rs = $con->query("SELECT ".$columna_amount." as amount FROM ".$table." WHERE ".$column_id." = ".$id);
		$row = $rs->fetch();
		$amount = $row['amount'];
		$amount_real = ($row['amount'] - $abono_amount);

		$query = $con->prepare("INSERT INTO tbl_abonos (tipo, descripcion, monto, fecha, id_element) VALUES (:tipo, :descripcion, :monto, current_date, :id_element)");

		$query->bindParam('tipo', $type);
		$query->bindParam('descripcion', $abono_description);
		$query->bindParam('monto', $abono_amount);
		$query->bindParam('id_element', $id);
		
		if($query->execute()){

			if($amount_real == 0){
				$query2 = $con->prepare("UPDATE ".$table." set ".$columna_amount." = ".$amount_real. ", estatus = 'pagado' WHERE ".$column_id." = ".$id);
			}else{
				$query2 = $con->prepare("UPDATE ".$table." set ".$columna_amount." = ".$amount_real. " WHERE ".$column_id." = ".$id);
			}
			
			if(!$query2->execute()){
				$errors++;
			}
		}else{
			$errors++;
		}

		if($errors == 0){
			$con->commit();
			echo 'ok';
		}else{
			$con->rollBack();
			die($query." ".$query2);
		}
	}

	