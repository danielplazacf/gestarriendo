<?php

	// Requerimos conexion a la DDBB
	require_once('../gt-config/conexion.php');

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$id_contrato = $_POST['id_contrato'];

		$fileTmpPath = $_FILES['file']['tmp_name'];
		$fileName = $_FILES['file']['name'];
		$fileSize = $_FILES['file']['size'];
		$fileType = $_FILES['file']['type'];

		$fileNameCmps = explode(".", $fileName);
		$fileExtension = strtolower(end($fileNameCmps));

		$newFileName = md5(time() . $fileName) . '.' . $fileExtension;

		// directory in which the uploaded file will be moved
		$uploadFileDir = '../uploads/contratos/';
		$dest_path = $uploadFileDir . $newFileName;

		if(move_uploaded_file($fileTmpPath, $dest_path)){
			$query = $con->prepare("UPDATE tbl_contrato_system SET url_pdf = '".$newFileName."' WHERE id_contrato = ".$id_contrato);
			if($query->execute()){
	         	echo 'ok';
	        } else {
	            echo 'error ';
	            die($query);
	        }
		}else{
			echo 'error ';
		}
	}