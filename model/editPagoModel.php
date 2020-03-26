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
    if ($_POST['cSimpleEditP'] === 'cSimple') {

        $id_pago = filter_var($_POST['id_pago_property'], FILTER_SANITIZE_NUMBER_INT);
        //
        $desde = filter_var($_POST['desde_edit_p'], FILTER_SANITIZE_STRING);
        $hacia = filter_var($_POST['hacia_edit_p'], FILTER_SANITIZE_STRING);
        $concepto = filter_var($_POST['concepto_edit_p'], FILTER_SANITIZE_STRING);
        $hidden = filter_var($_POST['hidden_recurrent_edit_p'], FILTER_SANITIZE_STRING);
        $amount = filter_var($_POST['amount_edit_p'], FILTER_SANITIZE_STRING);
        $venc = filter_var($_POST['venc_edit_p'], FILTER_SANITIZE_STRING);

        // echo $id_property .'<br>'. $status .'<br>'. $agent .'<br>'. $date .'<br>'. $name_owner .'<br>'. $name_leaser .'<br>'. $f_init .'<br>'. $f_termino .'<br>'. $garantia .'<br>'. $r_garantia .'<br>'. $type_contrato;        

        $query = $con->prepare("UPDATE tbl_pagos_property
        SET desde_pago = '$desde', hacia_pago = '$hacia', concepto_csimple = '$concepto', hidden_recurrent = '$hidden', amount_csimple = '$amount', venc_csimple = '$venc'
        WHERE id_pago_property = '$id_pago'");

        // bindParam('valor_input', $variable_input);
        $query->bindParam('id_cobro_property', $id_cobro);

        $query->bindParam('desde_edit_p', $desde);
        $query->bindParam('hacia_edit_p', $hacia);
        $query->bindParam('concepto_edit_p', $concepto);
        $query->bindParam('hidden_recurrent_edit_p', $hidden);
        $query->bindParam('amount_edit_p', $amount);
        $query->bindParam('venc_edit_p', $venc);

        if ($query->execute()) {
            echo 'ok';
        } else {
            echo 'error ';
            die($query);
        }
    }
}
