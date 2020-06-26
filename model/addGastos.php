<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	
	// Requerimos conexion a la DDBB
	require_once('../gt-config/conexion.php');

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$documentno = filter_var($_POST['documentno'], FILTER_SANITIZE_STRING);
		$chargeTo = filter_var($_POST['chargeTo'], FILTER_SANITIZE_STRING);
		$concepto_gasto_id = filter_var($_POST['concepto_gasto_id'], FILTER_SANITIZE_STRING);
		$amountGasto = filter_var($_POST['amountGasto'], FILTER_SANITIZE_STRING);
		$descriptionGasto = filter_var($_POST['descriptionGasto'], FILTER_SANITIZE_STRING);
		$id_contrato = filter_var($_POST['contrato_id'], FILTER_SANITIZE_STRING);

		$fileTmpPath = $_FILES['url_file_doc']['tmp_name'];
		$fileName = $_FILES['url_file_doc']['name'];
		$fileSize = $_FILES['url_file_doc']['size'];
		$fileType = $_FILES['url_file_doc']['type'];
		$fileNameCmps = explode(".", $fileName);
		$fileExtension = strtolower(end($fileNameCmps));

		$newFileName = md5(time() . $fileName) . '.' . $fileExtension;

		// directory in which the uploaded file will be moved
		$uploadFileDir = '../uploads/gastos/';
		$dest_path = $uploadFileDir . $newFileName;

		if(move_uploaded_file($fileTmpPath, $dest_path))
		{
			$query = $con->prepare("INSERT INTO tbl_gastos (documentno, charge_to, concepto_gasto_id, amount, description, url_file_doc, contrato_id, created_at)
			VALUES (:documentno, :charge_to, :concepto_gasto_id, :amount, :description, :url_file_doc, :id_contrato, current_date)");

			$query->bindParam('documentno', $documentno);
			$query->bindParam('charge_to', $chargeTo);
			$query->bindParam('concepto_gasto_id', $concepto_gasto_id);
			$query->bindParam('amount', $amountGasto);
			$query->bindParam('description', $descriptionGasto);
			$query->bindParam('url_file_doc', $newFileName);
			$query->bindParam('id_contrato', $id_contrato);

		  	if ($query->execute()) {
	            echo 'ok';
	        } else {
	            echo 'error ';
	            die($query);
	        }
		}
		else
		{
		  $message = 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
		  die($message);
		}
	}