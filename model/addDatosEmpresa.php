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

    $nombre = filter_var($_POST['name_empresa'], FILTER_SANITIZE_STRING);
    $rut = filter_var($_POST['rut_empresa'], FILTER_SANITIZE_STRING);
    $giro = filter_var($_POST['giro_empresa'], FILTER_SANITIZE_STRING);
    $address = filter_var($_POST['address_empresa'], FILTER_SANITIZE_STRING);
    $phone = filter_var($_POST['telefono_empresa'], FILTER_SANITIZE_STRING);
    $mail = filter_var($_POST['correo_empresa'], FILTER_SANITIZE_STRING);

    $type = 'png';
    $rlogo = $_FILES['logo_empresa']['tmp_name'];
    $minus = strtolower($nombre);
    $minus = str_replace(' ', '-', $minus);
    $name_final = 'logo-' . $minus . '.' . $type;

    if (is_uploaded_file($rlogo)) {
        $destino = 'images/' . $name_final;
        $nombrea = $name_final;
        copy($rlogo, $destino);
    } else {
        $nombrea = $rlogo;
    }

    $destino_url = 'model/' . $destino;
    $destino_url_final = filter_var($destino_url, FILTER_SANITIZE_STRING);

    if ($destino_url_final) {
        $query = $con->prepare("INSERT INTO tbl_datos_empresa (name_empresa, rut_empresa, giro_empresa, address_empresa, telefono_empresa, correo_empresa, ruta_logo_empresa)
            VALUES ('$nombre','$rut','$giro','$address','$phone','$mail','$destino_url_final')");

        if ($query->execute()) {
            echo $destino_url_final;
        }else{
            echo 'error';
        }
    }
}
