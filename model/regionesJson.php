<?php
	/*-------------------------
	Autor: Jesús Caballero P.
	Web: integramosweb.pro
	Correo: web@integramosweb.pro
    ---------------------------*/

	//Solicitamos Conexion
    require_once('../gt-config/conexion.php');
    
    $region_id = filter_var($_POST['region'], FILTER_SANITIZE_STRING);

	$query = "SELECT * FROM tbl_comunas_system WHERE region_id = '$region_id'";
    $resultado = $con->query($query);
    
    $html = '';
    while($rows = $resultado->fetch(PDO::FETCH_ASSOC))
    {
        $html.= "<option value='".$rows['name_comuna']."'>".$rows['name_comuna']."</option>";
    }
    echo $html;
?>