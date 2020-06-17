<?php
	/*-------------------------
	Autor: Jesús Caballero P.
	Web: integramosweb.pro
	Correo: web@integramosweb.pro
	---------------------------*/
	
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

?>