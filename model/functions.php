<?php
	/*-------------------------
	Autor: Jesús Caballero P.
	Web: integramosweb.pro
	Correo: web@integramosweb.pro
	---------------------------*/

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	
	define('NAME_APP', 'https://gestarriendo.clicfactor.com');

	function nameUser($usuario){

		global $con;

		$fecha = date_default_timezone_set('America/Santiago');

		global $fecha;
		
		$user_name = $usuario;
		
		$query = "SELECT * FROM tbl_users_system WHERE user_system = '$user_name'";
        $resultado = $con->query($query);
        $row = $resultado->fetch(PDO::FETCH_ASSOC);

        $html = $row['name_user_system'];

        echo $html;
	}

	function frasesFooter(){
		// Completamos el vector con frases
		$vector = array(
		1 => "La motivación nos impulsa a comenzar y el hábito nos permite continuar.",
		2 => "El fracaso es la oportunidad de empezar de nuevo con más Inteligencia.",
		3 => "La suerte es lo que ocurre cuando la preparación coincide con la oportunidad.",
		4 => "Si ya sabes lo que tienes que hacer y no lo haces entonces estás peor que antes",
		);

		// Obtenemos un número aleatorio
		$numero = rand(1,4);

		// Imprimimos la frase
		echo $vector[$numero];
	}

	function verifyDocProperty($id_property = NULL){
		global $con;
		$stmt = $con->prepare("SELECT COUNT(*) as qty FROM tbl_contrato_system WHERE id_property = ".$id_property);
		$stmt->execute();
		$rs = $stmt->fetch();
		if($rs['qty'] > 0){
			return true;
		}else{
			return false;
		}
	}

	function registerPago($id_property = NULL){
		global $con;

		$stmt = $con->prepare("SELECT * FROM tbl_pagos_property WHERE hidden_recurrent = 1 and id_property = ".$id_property);
		$stmt->execute();
		$real_date = date('Y-m-d',strtotime('+3 day', strtotime(date('Y-m-d'))));
		$day = date('j', strtotime($real_date));

		$unique_id = date('Ymd');

		while($row = $stmt->fetch()){
			if($day == $row['venc_psimple']){
				$stmt2 = $con->prepare('SELECT COUNT(*) as qty FROM tbl_pagos_property WHERE unique_id = '.$unique_id.' AND id_property = '.$id_property);
				$stmt2->execute();
				$row2 = $stmt2->fetch();
				if($row2['qty'] <= 0){
					$query = $con->prepare("INSERT INTO tbl_pagos_property (id_property, date_register, desde_pago, hacia_pago, concepto_csimple, hidden_recurrent, amount_psimple, estatus, unique_id) 
						VALUES (:id_property, current_date, :desde_pago, :hacia_pago, :concepto_csimple, 0, :amount_psimple, 'pendiente', :unique_id)");

					$query->bindParam('id_property', $row['id_property']);
					$query->bindParam('desde_pago', $row['desde_pago']);
					$query->bindParam('hacia_pago', $row['hacia_pago']);
					$query->bindParam('concepto_csimple', $row['concepto_csimple']);
					$query->bindParam('amount_psimple', $row['amount_psimple']);
					$query->bindParam('unique_id', $unique_id);

					if ($query->execute()) {

					}else{
						die($query);
					}
				}	
			}

		}
	}

	function registerCobro($id_property = NULL){
		global $con;

		$stmt = $con->prepare("SELECT * FROM tbl_cobros_property WHERE hidden_recurrent = 1 and id_property = ".$id_property);
		$stmt->execute();
		$real_date = date('Y-m-d',strtotime('+3 day', strtotime(date('Y-m-d'))));
		$day = date('j', strtotime($real_date));

		$unique_id = date('Ymd');

		while($row = $stmt->fetch()){
			if($day == $row['venc_csimple']){
				$stmt2 = $con->prepare('SELECT COUNT(*) as qty FROM tbl_cobros_property WHERE unique_id = '.$unique_id.' AND id_property = '.$id_property);
				$stmt2->execute();
				$row2 = $stmt2->fetch();
				if($row2['qty'] <= 0){
					$query = $con->prepare("INSERT INTO tbl_cobros_property (id_property, date_register, desde_cobro, hacia_cobro, concepto_csimple, hidden_recurrent, amount_csimple, estatus, unique_id) 
						VALUES (:id_property, current_date, :desde_cobro, :hacia_cobro, :concepto_csimple, 0, :amount_csimple, 'pendiente', :unique_id)");

					$query->bindParam('id_property', $row['id_property']);
					$query->bindParam('desde_cobro', $row['desde_cobro']);
					$query->bindParam('hacia_cobro', $row['hacia_cobro']);
					$query->bindParam('concepto_csimple', $row['concepto_csimple']);
					$query->bindParam('amount_csimple', $row['amount_csimple']);
					$query->bindParam('unique_id', $unique_id);

					if ($query->execute()) {

					}else{
						die($query);
					}
				}	
			}

		}

	}

	function sendEmail($data){
		$send = true;

		require '../resources/PHPMailer/src/Exception.php';
		require '../resources/PHPMailer/src/PHPMailer.php';
		require '../resources/PHPMailer/src/SMTP.php';

		/*use PHPMailer\PHPMailer\PHPMailer;
		use PHPMailer\PHPMailer\Exception;
		use PHPMailer\PHPMailer\SMTP;*/

		$mail = new PHPMailer(true);
		try {
		    //Server settings
		    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
		    $mail->isSMTP();                                            // Send using SMTP
		    $mail->Host       = 'clicfactor.com';                       // Set the SMTP server to send through
		    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
		    $mail->Username   = 'gest@clicfactor.com';                  // SMTP username
		    $mail->Password   = 'MMA0S7BCFVPH';                         // SMTP password
		    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
		    $mail->CharSet    = 'UTF-8';                                // Activa la condificacción utf-8
		    $mail->Port       = 465;                                    // TCP port to connect to

		    $mail->setFrom('gest@clicfactor.com', 'Gestarriendo | Servicios Inmobiliarios');
		    $mail->addAddress($data['emailTo'], $data['nameTo']);                       // Add a recipient
		    $mail->addReplyTo('gest@clicfactor.com', 'Gestarriendo | Servicios Inmobiliarios');
		    $mail->addCC('uebeats@gmail.com');

		    $services = $_POST['selServices'];
		    $asunto = 'IMPORTANTE | Recordatorio de pago ' . $services . ' para ' . $nameTo;

		    $mail->isHTML(true);                                        // Set email format to HTML
		    $mail->Subject = $asunto;
		    $mail->Body = ob_get_clean();

		    if(!$mail->send()){
		        $send = false;
		    }
		} catch (Exception $e) {
		    $send = false;
		}

		return $send;
	}

?>