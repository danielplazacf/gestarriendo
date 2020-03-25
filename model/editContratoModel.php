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
		$id_property = filter_var($_POST['id_property_edit'], FILTER_SANITIZE_NUMBER_INT);
        
        // $agent = filter_var($_POST['agent_edit'], FILTER_SANITIZE_STRING);
		// $date = filter_var($_POST['date_edit'], FILTER_SANITIZE_STRING);
		$status = filter_var($_POST['hidden_status'], FILTER_SANITIZE_NUMBER_INT);
        //
		$name_owner = filter_var($_POST['name_edit'], FILTER_SANITIZE_STRING);
		$name_leaser = filter_var($_POST['leaser_edit'], FILTER_SANITIZE_STRING);
		$f_init = filter_var($_POST['inicio_edit'], FILTER_SANITIZE_STRING);
        $f_termino = filter_var($_POST['termino_edit'], FILTER_SANITIZE_STRING);
        $garantia = filter_var($_POST['garantia_edit'], FILTER_SANITIZE_STRING);
        $r_garantia = filter_var($_POST['receptor_edit'], FILTER_SANITIZE_STRING);
		$type_contrato = filter_var($_POST['tipo_edit'], FILTER_SANITIZE_NUMBER_INT);

		$query = $con->prepare("UPDATE tbl_contrato_system 
        SET status_contrato = '$status', name_owner = '$name_owner', name_leaser = '$name_leaser', fecha_inicio = '$f_init', fecha_termino = '$f_termino', garantia_contrato = '$garantia', receptor_garantia = '$r_garantia', tipo_contrato = '$type_contrato'
        WHERE id_property = '$id_property'");
         
        // bindParam('valor_input', $variable_input);
		$query->bindParam('id_property_edit', $id_property);
		$query->bindParam('hidden_status', $status);

		$query->bindParam('name_edit', $name_owner);
		$query->bindParam('leaser_edit', $name_leaser);
		$query->bindParam('inicio_edit', $f_init);
        $query->bindParam('termino_edit', $f_termino);
        $query->bindParam('garantia_edit', $garantia);
        $query->bindParam('receptor_edit', $r_garantia);
        $query->bindParam('tipo_edit', $type_contrato);

		if ($query->execute()) {
				echo 'ok';
			}else{
                echo 'error';
                die($query);
			}
	}

