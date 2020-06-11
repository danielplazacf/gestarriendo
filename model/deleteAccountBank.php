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
        $id_account = filter_var($_POST['id_account_bank'], FILTER_SANITIZE_NUMBER_INT);
        
        $query = $con->prepare("DELETE FROM tbl_account_bank WHERE id_account_bank = '$id_account'");
         
        // bindParam('valor_input', $variable_input);
		$query->bindParam('id_account_bank', $id_account, PDO::PARAM_INT);

		if ($query->execute()) {
				echo 'ok';
			}else{
                echo 'error';
                //die($query);
			}
	}

