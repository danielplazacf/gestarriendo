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
    if ($_POST['cSimpleEdit'] === 'cSimple') {

        $id_cobro = filter_var($_POST['id_cobro_property'], FILTER_SANITIZE_NUMBER_INT);
        //
        $desde = filter_var($_POST['desde_edit'], FILTER_SANITIZE_STRING);
        $hacia = filter_var($_POST['hacia_edit'], FILTER_SANITIZE_STRING);
        $concepto = filter_var($_POST['concepto_edit'], FILTER_SANITIZE_STRING);
        $hidden = filter_var($_POST['hidden_recurrent_edit'], FILTER_SANITIZE_STRING);
        $amount = filter_var($_POST['amount_edit'], FILTER_SANITIZE_STRING);
        $venc = filter_var($_POST['venc_edit'], FILTER_SANITIZE_STRING);

        // echo $id_property .'<br>'. $status .'<br>'. $agent .'<br>'. $date .'<br>'. $name_owner .'<br>'. $name_leaser .'<br>'. $f_init .'<br>'. $f_termino .'<br>'. $garantia .'<br>'. $r_garantia .'<br>'. $type_contrato;        

        $query = $con->prepare("UPDATE tbl_cobros_property
        SET desde_cobro = '$desde', hacia_cobro = '$hacia', concepto_csimple = '$concepto', hidden_recurrent = '$hidden', amount_csimple = '$amount', venc_csimple = '$venc'
        WHERE id_cobro_property = '$id_cobro'");

        // bindParam('valor_input', $variable_input);
        $query->bindParam('id_cobro_property', $id_cobro);

        $query->bindParam('desde_edit', $desde);
        $query->bindParam('hacia_edit', $hacia);
        $query->bindParam('concepto_edit', $concepto);
        $query->bindParam('hidden_recurrent_edit', $hidden);
        $query->bindParam('amount_edit', $amount);
        $query->bindParam('venc_edit', $venc);

        if ($query->execute()) {
            echo 'ok';
        } else {
            echo 'error ';
            die($query);
        }
    }
}
