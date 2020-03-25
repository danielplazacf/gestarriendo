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
    if ($_POST['cSimpleP'] === 'cSimple') {
        $id_property = filter_var($_POST['id_property_p'], FILTER_SANITIZE_NUMBER_INT);
        $agent = filter_var($_POST['agent_designated_p'], FILTER_SANITIZE_STRING);
        $date = filter_var($_POST['date_register_p'], FILTER_SANITIZE_STRING);
        //
        $desde = filter_var($_POST['desde_pago'], FILTER_SANITIZE_STRING);
        $hacia = filter_var($_POST['hacia_pago'], FILTER_SANITIZE_STRING);
        $concepto = filter_var($_POST['concepto_psimple'], FILTER_SANITIZE_STRING);
        $hidden = filter_var($_POST['hidden_recurrent_p'], FILTER_SANITIZE_STRING);
        $amount = filter_var($_POST['amount_csimple_p'], FILTER_SANITIZE_STRING);
        $venc = filter_var($_POST['venc_csimple_p'], FILTER_SANITIZE_STRING);

        // echo $id_property .'<br>'. $status .'<br>'. $agent .'<br>'. $date .'<br>'. $name_owner .'<br>'. $name_leaser .'<br>'. $f_init .'<br>'. $f_termino .'<br>'. $garantia .'<br>'. $r_garantia .'<br>'. $type_contrato;        

        $query = $con->prepare("INSERT INTO tbl_pagos_property
        (id_property, agent_designated, date_register, desde_pago, hacia_pago, concepto_csimple, hidden_recurrent, amount_csimple, venc_csimple)
        VALUES (:id_property_p,:agent_designated_p,:date_register_p,:desde_pago,:hacia_pago,:concepto_psimple,:hidden_recurrent_p,:amount_csimple_p,:venc_csimple_p)");

        // bindParam('valor_input', $variable_input);
        $query->bindParam('id_property_p', $id_property);
        $query->bindParam('agent_designated_p', $agent);
        $query->bindParam('date_register_p', $date);

        $query->bindParam('desde_pago', $desde);
        $query->bindParam('hacia_pago', $hacia);
        $query->bindParam('concepto_psimple', $concepto);
        $query->bindParam('hidden_recurrent_p', $hidden);
        $query->bindParam('amount_csimple_p', $amount);
        $query->bindParam('venc_csimple_p', $venc);

        if ($query->execute()) {
            echo 'ok';
        } else {
            echo 'error ';
            die($query);
        }
    }
}
