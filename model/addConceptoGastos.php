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

		$name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);

		$query = $con->prepare("INSERT INTO tbl_concepto_gasto (name, description)
         VALUES (:name, :description)");
         
        // bindParam('nombre_campo_database', $variable_input);
		$query->bindParam('name', $name);
		$query->bindParam('description', $name);

		if ($query->execute()) {
				echo 'ok';
			}else{
                echo 'error';
                die($query);
			}
	}

