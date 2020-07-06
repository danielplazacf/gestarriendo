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
			print "Hola";
			if($day == $row['venc_psimple']){
				$stmt2 = $con->prepare('SELECT COUNT(*) as qty FROM tbl_pagos_property WHERE unique_id = '.$unique_id);
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
				$stmt2 = $con->prepare('SELECT COUNT(*) as qty FROM tbl_cobros_property WHERE unique_id = '.$unique_id);
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
		require 'resources/PHPMailer/src/Exception.php';
		require 'resources/PHPMailer/src/PHPMailer.php';
		require 'resources/PHPMailer/src/SMTP.php';

		$mail = new PHPMailer(true);
		$mail->IsSMTP(); // habilita SMTP
		$mail->SMTPDebug = 0; // debugging: 1 = errores y mensajes, 2 = sólo mensajes
		$mail->SMTPAuth = true; // auth habilitada
		$mail->SMTPSecure = 'TLS'; // transferencia segura REQUERIDA para Gmail
		$mail->Host = "smtp.mailtrap.io";
		$mail->Port = 465; // or 587
		$mail->IsHTML(true);
		$mail->Username = "2627ae47e05902";
		$mail->Password = "e68ac6687909d7";
		$mail->SetFrom($data['emailFrom']);
		$mail->Subject = $data['subject'];
		$mail->Body = $data['body'];
		$mail->AddAddress($data['emailTo']);

		$send = false;

		 if(!$mail->Send()) {
		 	$send = false;
		    //echo "Mailer Error: " . $mail->ErrorInfo;
		 } else {
		 	$send = true;
		    //echo "Message has been sent";
		 }

		 return $send;
	}

?>