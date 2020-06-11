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
        $id_cobro = filter_var($_POST['id_cobro_property'], FILTER_SANITIZE_NUMBER_INT);
        
        $query = $con->prepare("DELETE FROM tbl_cobros_property WHERE id_cobro_property = '$id_cobro'");
         
        // bindParam('valor_input', $variable_input);
		$query->bindParam('id_cobro_property', $id_cobro, PDO::PARAM_INT);

		if ($query->execute()) {
				echo 'ok';
			}else{
                echo 'error';
                //die($query);
			}
	}

