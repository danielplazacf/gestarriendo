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
        $id_property = filter_var($_POST['id_property'], FILTER_SANITIZE_NUMBER_INT);
        $status = filter_var($_POST['status_contrato'], FILTER_SANITIZE_NUMBER_INT);
        $agent = filter_var($_POST['agent_designated'], FILTER_SANITIZE_STRING);
        $date = filter_var($_POST['date_register'], FILTER_SANITIZE_STRING);
        //
		$name_owner = filter_var($_POST['name_owner'], FILTER_SANITIZE_STRING);
		$name_leaser = filter_var($_POST['name_leaser'], FILTER_SANITIZE_STRING);
		$f_init = filter_var($_POST['fecha_inicio'], FILTER_SANITIZE_STRING);
        $f_termino = filter_var($_POST['fecha_termino'], FILTER_SANITIZE_STRING);
        $garantia = filter_var($_POST['garantia_contrato'], FILTER_SANITIZE_STRING);
        $r_garantia = filter_var($_POST['receptor_garantia'], FILTER_SANITIZE_STRING);
        $type_contrato = filter_var($_POST['tipo_contrato'], FILTER_SANITIZE_NUMBER_INT);

        // echo $id_property .'<br>'. $status .'<br>'. $agent .'<br>'. $date .'<br>'. $name_owner .'<br>'. $name_leaser .'<br>'. $f_init .'<br>'. $f_termino .'<br>'. $garantia .'<br>'. $r_garantia .'<br>'. $type_contrato;        

		$query = $con->prepare("INSERT INTO tbl_contrato_system 
        (id_property, status_contrato, agent_designated, date_register, name_owner, name_leaser, fecha_inicio, fecha_termino, garantia_contrato, receptor_garantia, tipo_contrato)
        VALUES (:id_property,:status_contrato,:agent_designated,:date_register,:name_owner,:name_leaser,:fecha_inicio,:fecha_termino,:garantia_contrato,:receptor_garantia,:tipo_contrato)");
        
        // bindParam('valor_input', $variable_input);
        $query->bindParam('id_property', $id_property);
        $query->bindValue('status_contrato', $status);

		$query->bindParam('agent_designated', $agent);
		$query->bindParam('date_register', $date);

		$query->bindParam('name_owner', $name_owner);
		$query->bindParam('name_leaser', $name_leaser);
		$query->bindParam('fecha_inicio', $f_init);
        $query->bindParam('fecha_termino', $f_termino);
        $query->bindParam('garantia_contrato', $garantia);
        $query->bindParam('receptor_garantia', $r_garantia);
        $query->bindParam('tipo_contrato', $type_contrato);


		if ($query->execute()) {
				echo 'ok';
			}else{
				echo 'error ';
                die($query);
			}
	}

