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
        $id_contrato = filter_var($_POST['id_contrato'], FILTER_SANITIZE_NUMBER_INT);
        
        $query = $con->prepare("DELETE FROM tbl_contrato_system WHERE id_contrato = '$id_contrato'");
         
        // bindParam('valor_input', $variable_input);
		$query->bindParam('id_contrato', $id_contrato, PDO::PARAM_INT);

		if ($query->execute()) {
				echo 'ok';
			}else{
                echo 'error';
                //die($query);
			}
	}

