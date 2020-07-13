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
        $id = filter_var($_POST['id_concepto_gasto'], FILTER_SANITIZE_NUMBER_INT);

		$name = filter_var($_POST['name_edit'], FILTER_SANITIZE_STRING);

		$query = $con->prepare("UPDATE tbl_concepto_gasto 
        SET name = '$name'
        WHERE id = '$id'");
         
        // bindParam('valor_input', $variable_input);
		$query->bindParam('name', $name);

		if ($query->execute()) {
				echo 'ok';
			}else{
                echo 'error';
                die($query);
			}
	}

