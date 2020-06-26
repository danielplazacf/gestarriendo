<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	// Requerimos conexion a la DDBB
	require_once('../gt-config/conexion.php');

	require '../lib/PHPMailer/src/Exception.php';
	require '../lib/PHPMailer/src/PHPMailer.php';
	require '../lib/PHPMailer/src/SMTP.php';

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

		  	/*if ($query->execute()) {
				$mail = new PHPMailer(true);

				try {
				    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
				    $mail->isSMTP();
				    $mail->Host       = 'mail.frontuari.net';
				    $mail->SMTPAuth   = true;
				    $mail->Username   = 'cvargas@frontuari.net';
				    $mail->Password   = 'Car2244los*';
				    //$mail->SMTPSecure = 'ssl';
				    $mail->Port       = 26;
				    //Recipients
				    $mail->setFrom('cvargas@frontuari.net', 'Eduardo Tovar');
				    $mail->addAddress('jquerysencillo@gmail.com', 'Carlos Vargas');
				    //$mail->addAddress('ellen@example.com'); 
				    //$mail->addReplyTo('info@example.com', 'Information');
				    //$mail->addCC('cc@example.com');
				    //$mail->addBCC('bcc@example.com');
				    // Attachments
				    $mail->addAttachment($dest_path);
				    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');
				    // Content
				    $mail->isHTML(true);                                  // Set email format to HTML
				    $mail->Subject = 'Mensaje de Prueba!!';
				    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
				    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
				    $mail->send();
				} catch (Exception $e) {
				    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
				}*/
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