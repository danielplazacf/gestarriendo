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
        $id_owner = filter_var($_POST['id_owner_system'], FILTER_SANITIZE_NUMBER_INT);
        
        $query = $con->prepare("DELETE FROM tbl_owner_system WHERE id_owner_system = '$id_owner'");
         
        // bindParam('valor_input', $variable_input);
		$query->bindParam('id_owner_system', $id_owner, PDO::PARAM_INT);

		if ($query->execute()) {
				echo 'ok';
			}else{
                echo 'error';
                //die($query);
			}
	}

