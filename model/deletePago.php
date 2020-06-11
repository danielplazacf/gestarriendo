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
        $id_pago = filter_var($_POST['id_pago_property'], FILTER_SANITIZE_NUMBER_INT);
        
        $query = $con->prepare("DELETE FROM tbl_pagos_property WHERE id_pago_property = '$id_pago'");
         
        // bindParam('valor_input', $variable_input);
		$query->bindParam('id_pago_property', $id_pago, PDO::PARAM_INT);

		if ($query->execute()) {
				echo 'ok';
			}else{
                echo 'error';
                //die($query);
			}
	}

