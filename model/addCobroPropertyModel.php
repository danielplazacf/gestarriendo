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
    if ($_POST['cSimple'] === 'cSimple') {
        $id_property = filter_var($_POST['id_property_c'], FILTER_SANITIZE_NUMBER_INT);
        $agent = filter_var($_POST['agent_designated'], FILTER_SANITIZE_STRING);
        $date = filter_var($_POST['date_register'], FILTER_SANITIZE_STRING);
        //
        $desde = filter_var($_POST['desde_cobro'], FILTER_SANITIZE_STRING);
        $hacia = filter_var($_POST['hacia_cobro'], FILTER_SANITIZE_STRING);
        $concepto = filter_var($_POST['concepto_csimple'], FILTER_SANITIZE_STRING);
        $hidden = filter_var($_POST['hidden_recurrent'], FILTER_SANITIZE_STRING);
        $amount = filter_var($_POST['amount_csimple'], FILTER_SANITIZE_STRING);
        $venc = filter_var($_POST['venc_csimple'], FILTER_SANITIZE_STRING);

        // echo $id_property .'<br>'. $status .'<br>'. $agent .'<br>'. $date .'<br>'. $name_owner .'<br>'. $name_leaser .'<br>'. $f_init .'<br>'. $f_termino .'<br>'. $garantia .'<br>'. $r_garantia .'<br>'. $type_contrato;        

        $query = $con->prepare("INSERT INTO tbl_cobros_property
        (id_property, agent_designated, date_register, desde_cobro, hacia_cobro, concepto_csimple, hidden_recurrent, amount_csimple, venc_csimple)
        VALUES (:id_property,:agent_designated,:date_register,:desde_cobro,:hacia_cobro,:concepto_csimple,:hidden_recurrent,:amount_csimple,:venc_csimple)");

        // bindParam('valor_input', $variable_input);
        $query->bindParam('id_property', $id_property);
        $query->bindParam('agent_designated', $agent);
        $query->bindParam('date_register', $date);

        $query->bindParam('desde_cobro', $desde);
        $query->bindParam('hacia_cobro', $hacia);
        $query->bindParam('concepto_csimple', $concepto);
        $query->bindParam('hidden_recurrent', $hidden);
        $query->bindParam('amount_csimple', $amount);
        $query->bindParam('venc_csimple', $venc);

        if ($query->execute()) {
            echo 'ok';
        } else {
            echo 'error ';
            die($query);
        }
    }
}
