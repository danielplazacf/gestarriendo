<?php
/*-------------------------
    Autor: Jesus Caballero
    Web: propiedadesdng.com
    Mail: jesus@propiedadesdng.com
    ---------------------------*/

ob_start();

require_once '../gt-config/conexion.php';
require_once '../model/functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//$prueba = 'prueba';

//if ($prueba) {
    // buscar datos de la empresa
    $selEmpresa = $con->prepare("SELECT * FROM tbl_datos_empresa");
    $selEmpresa->execute();
    $rowEmpresa = $selEmpresa->fetch(PDO::FETCH_ASSOC);

    // ruta logo empresa
    $logo = $rowEmpresa['ruta_logo_empresa'];
    $telefono = $rowEmpresa['telefono_empresa'];

    $id_property = $_POST['id_property'];

    // constante nombre de aplicacion
    $gest_url = NAME_APP;

    // nombre y correo arrendatario
    $nameTo = $_POST['nameLeaser'];
    $emailTo = $_POST['emailLeaser'];
    // nombre servicio
    $servicio = $_POST['selServices'];

    if (isset($id_property)) {
        $selProperty = $con->prepare("SELECT address_property FROM tbl_property_system WHERE id_property = '$id_property'");
        $selProperty->execute();
        $rowProperty = $selProperty->fetch(PDO::FETCH_ASSOC);

        $direccion = $rowProperty['address_property'];
    }

    //echo $logo . '<br>' . $id_property . '<br>' . $nameTo . '<br>' . $servicio . '<br>' . $direccion . '<br>';
}

// Template mail services
?>
<table width="600" align="center" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff" style="border:1px solid #a0a1a2">
    <tbody>
        <tr>
            <td>

                <table width="600" align="center" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff" style="border-bottom:1px solid #a0a1a2">
                    <tbody>
                        <tr>
                            <td height="14"></td>
                        </tr>
                        <tr>
                            <td height="53" bgcolor="#ffffff" align="left" style="padding-left:50px"><img src="<?php echo $gest_url . '/' . $logo; ?>" alt="Gestarriendo" width="220" border="0" style="display:block" class="CToWUd"></td>
                        </tr>
                        <tr>
                            <td height="10"></td>
                        </tr>
                    </tbody>
                </table>


                <table width="600" height="32" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#ffffff">
                    <tbody>
                        <tr>
                            <td height="30" colspan="3"></td>
                        </tr>
                        <tr>
                            <td width="5%"></td>
                            <td width="90%" height="10" style="font-family:Helvetica,arial,sans-serif;font-size:20px;text-align:center;color:#555759">
                                <span><strong>Recordatorio de pago de cuentas</strong></span></td>
                            <td width="5%"></td>
                        </tr>
                    </tbody>
                </table>


                <table width="500" height="auto" border="0" align="center" cellpadding="0" cellspacing="0" style="background-color:#ffffff">
                    <tbody>
                        <tr>
                            <td height="20"></td>
                        </tr>
                        <tr>
                            <td style="font-family:Helvetica,arial,sans-serif;font-size:14px;text-align:left;color:#555759">Estimado (a), <span><strong> <u><?php echo $nameTo; ?></u></strong></span></td>
                        </tr>
                        <tr>
                            <td height="10"></td>
                        </tr>
                        <tr>
                            <td style="font-family:Helvetica,arial,sans-serif;font-size:14px;text-align:justify;color:#555759">
                                <p>Junto con desearle un excelente día, le recordamos que su <strong><em>cuenta de <?php echo $servicio; ?></em></strong> asociada a la propiedad en arrendamiento ubicada en <strong><em><?php echo $direccion; ?></em></strong>, se encuentra en mora rogamos cancelar la deuda.<br><br>
                                    Este es un recordatorio, a fin de evitar problemas con la continuidad de su contrato de arriendo.
                                    Quedamos atentos ante cualquier consulta o solicitud adicional, respondiendo este mismo correo.</p>
                            </td>
                        </tr>
                    </tbody>
                </table>


                <!-- <table width="500" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#ffffff">
                    <tbody>
                        <tr>
                            <td width="248" align="center">
                                <table width="500" border="0" cellspacing="0" cellpadding="5" style="font-family:Helvetica,arial,sans-serif;text-align:left;font-size:12px;border-top:1px solid #555759;border-bottom:1px solid #555759;border-left:1px solid #555759;border-right:1px solid #555759">
                                    <tbody>
                                        <tr bgcolor="#555759" style="color:#ffffff">
                                            <td height="20" style="border-bottom:1px solid #555759"><span><strong>Detalle de transferencia</strong></span></td>
                                        </tr>
                                        <tr bgcolor="#ffffff" style="color:#555759">
                                            <td>Banco de destino: <span><strong>Banco Ripley</strong></span> </td>
                                        </tr>
                                        <tr bgcolor="#ffffff" style="color:#555759">
                                            <td>Cuenta de destino: <span><strong> 4041057324</strong></span></td>
                                        </tr>
                                        <tr bgcolor="#ffffff" style="color:#555759">
                                            <td>Rut destinatario: <span><strong>18.827.816-7</strong></span></td>
                                        </tr>
                                        <tr bgcolor="#ffffff" style="color:#555759">
                                            <td>Asunto: <span><strong>trabajo productos quimicos segunda parte</strong></span></td>
                                        </tr>
                                        <tr bgcolor="#ffffff" style="color:#555759">
                                            <td>Monto transferencia: <span><strong>
                                                        $15.000
                                                    </strong></span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <table width="500" border="0" cellspacing="0" cellpadding="0" style="margin-top:5px" align="center" bgcolor="#ffffff">
                    <tbody>
                        <tr>
                            <td width="248" align="center">
                                <table width="500" border="0" cellspacing="0" cellpadding="5" style="font-family:Helvetica,arial,sans-serif;text-align:left;font-size:12px;border-top:1px solid #555759;border-bottom:1px solid #555759;border-left:1px solid #555759;border-right:1px solid #555759">
                                    <tbody>
                                        <tr bgcolor="#555759" style="color:#ffffff">
                                            <td height="20" style="border-bottom:1px solid #555759"><span><strong>Datos transacción</strong></span></td>
                                        </tr>
                                        <tr bgcolor="#ffffff" style="color:#555759">
                                            <td>Fecha: <span><strong>07-03-2020</strong></span> </td>
                                        </tr>
                                        <tr bgcolor="#ffffff" style="color:#555759">
                                            <td>Hora: <span><strong>20:22</strong></span></td>
                                        </tr>
                                        <tr bgcolor="#ffffff" style="color:#555759">
                                            <td>Nº de operación: <span><strong>000126020058</strong></span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
                -->

                <table width="500" height="auto" border="0" align="center" cellpadding="0" cellspacing="0" style="background-color:#ffffff">
                    <tbody>
                        <tr>
                            <td colspan="3" height="50"></td>
                        </tr>
                        <tr>
                            <th style="font-family:Helvetica,arial,sans-serif;color:#555759;line-height:1.3;" align="left">
                                <span>
                                    <strong>Atentamente,<br></strong>
                                    <?php
                                    $firma = '
                                        <span style="color:#555759;font-size:1rem;">'. $rowEmpresa['name_empresa'] .'</span><br>
                                        <span style="font-weight:300;color:#555759;font-size:.8rem;">'. $rowEmpresa['rut_empresa'] .'</span><br>
                                        <span style="font-weight:300;color:#555759;font-size:.8rem;">'. $rowEmpresa['giro_empresa'] .'<br>
                                        <span style="font-weight:300;color:#555759;font-size:.8rem;">'. $rowEmpresa['address_empresa'] .'<br>
                                        <span style="font-weight:300;color:#555759;font-size:.8rem;">'. $rowEmpresa['telefono_empresa'] .'<br>
                                        <span style="font-weight:300;color:#555759;font-size:.8rem;">'. $rowEmpresa['correo_empresa'] .'<br>
                                        ';
                                    echo $firma;
                                    ?>
                                </span>
                            </th>
                            <th height="30"></th>
                            <th width="83">
                                <!-- <table align="center" width="83">
                                    <tbody>
                                        <tr>
                                            <td width="83"><img src="https://ci6.googleusercontent.com/proxy/oHbXbq2Z8S9DK9d8vK3rXdbB620-t7F8kp2PfFIdmNWItiRCY3CV8fj3y--6z5HA-Bq6_4-2jvgv47lnrjhJdwGKwZMIx0nUdVEXGh4XUYpD82oyS4DrbbNoShkWcQ=s0-d-e1-ft#http://image.corp.bancofalabella.com/lib/fea012737562047d75/m/1/timbre2.png" alt="Servicios Internet" width="83" height="83" style="display:block" align="right" class="CToWUd"></td>
                                        </tr>
                                    </tbody>
                                </table> -->
                            </th>
                        </tr>
                        <tr>
                            <td colspan="3" height="50"></td>
                        </tr>
                    </tbody>
                </table>

                <table width="600" height="50" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#555759">
                    <tbody>
                        <tr>
                            <td colspan="2" height="6" width="100%"></td>
                        </tr>
                        <tr>
                            <th width="300" height="38" align="center">
                                <table border="0" cellspacing="0" cellpadding="0">
                                    <tbody>
                                        <tr>
                                            <td align="center" width="150" height="38"><a href="tel:<?php echo $telefono; ?>" target="_blank"> <span><img src="https://ci3.googleusercontent.com/proxy/l9hpNdsI5_dXofJveDHScB1ufNZZ9AUG3DFRtSvcsvuASuOhie_2qKMU2Eojol37iSXzF46a8Y3DXNLy5ZWUVmyVNIEyUC1Jogi8Iq5BQiNSfj8f5bMcj2XyL_Nngk2MPQ=s0-d-e1-ft#http://image.corp.bancofalabella.com/lib/fea012737562047d75/m/1/btn-llamar.png" width="88" height="38" border="0" alt="Llamar a Banco Falabella" style="display:block" class="CToWUd"></span> </a></td>
                                            <td width="150" align="center">
                                                <!--<img src="https://ci3.googleusercontent.com/proxy/7R7AKCjWYObS5x2psW1BWDT3911xW8jyx-d2abaFYmO3JTIBNjJQ-B3wI8WqAgZBzJVW1O9j5-n97m4_th0Dif9QjNdkA-ByNcry_ExiSfH48eCf3gDob0b6yUQ=s0-d-e1-ft#http://image.corp.bancofalabella.com/lib/fea012737562047d75/m/1/linea.png" width="1px" height="38" style="display:block" class="CToWUd">-->
                                            </td>
                                            <!-- <td align="center" width="149" height="38"><span><img src="https://ci4.googleusercontent.com/proxy/6EuJU63E18DlnqEwvoXJ6zAJadOIV-dvriRIHA25b3QJyU72PrD8mRUa51Hxt_YRM9l53udP9fr0PoefNdn-38KwW4Qm46j3L82lppmfSwvYEy2Otqk5VyMtE3RdgfMV2kTyiACXaA=s0-d-e1-ft#http://image.corp.bancofalabella.com/lib/fea012737562047d75/m/1/btn-llamar-fijo2.png" alt="Llamar a Banco Falabella" width="149" height="38" border="0" title="Llamar a Banco Falabella" style="display:block" class="CToWUd"></span></td> -->
                                            <!-- <td width="1" align="center"><img src="https://ci3.googleusercontent.com/proxy/7R7AKCjWYObS5x2psW1BWDT3911xW8jyx-d2abaFYmO3JTIBNjJQ-B3wI8WqAgZBzJVW1O9j5-n97m4_th0Dif9QjNdkA-ByNcry_ExiSfH48eCf3gDob0b6yUQ=s0-d-e1-ft#http://image.corp.bancofalabella.com/lib/fea012737562047d75/m/1/linea.png" width="1px" height="38" style="display:block" class="CToWUd"></td> -->
                                        </tr>
                                    </tbody>
                                </table>
                            </th>
                            <th width="300" height="38" align="center">
                                <table border="0" cellspacing="0" cellpadding="0">
                                    <tbody>
                                        <tr>
                                            <td width="97"></td>
                                            <!-- <td height="38" align="center"><img src="https://ci5.googleusercontent.com/proxy/61TSFUj54-goYLIdsu12L11K4HLDDieJpuh9gdY6rOebbpSbmmbD4E3CtfoIedwp0uJdF9Kc3YyzhMDIy25pEC56FdujEkyFsNMnNsI4KGaihwJl9bYT7enfCEk=s0-d-e1-ft#http://image.corp.bancofalabella.com/lib/fea012737562047d75/m/1/bbfcl.png" alt="http://www.bancofalabella.cl/" border="0" width="240" height="38" style="display:block" class="CToWUd"></td> -->
                                            <td width="97"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </th>
                        </tr>
                        <tr>
                            <td colspan="2" height="6" width="100%"></td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>
<?php

/* Connect To Database*/
//require_once ('../gt-config/conexion.php');//Contiene funcion que conecta a la base de datos

require '../resources/PHPMailer/src/Exception.php';
require '../resources/PHPMailer/src/PHPMailer.php';
require '../resources/PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

// Instantiation and passing `true` enables exceptions
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

    //$emailTo = 'rhythmicalgg@gmail.com';
    //$nameTo = 'Alberto Plaza';

    //Recipients
    $mail->setFrom('gest@clicfactor.com', 'Gestarriendo | Servicios Inmobiliarios');
    $mail->addAddress($emailTo, $nameTo);                       // Add a recipient
    $mail->addReplyTo('gest@clicfactor.com', 'Gestarriendo | Servicios Inmobiliarios');
    $mail->addCC('uebeats@gmail.com');
    // $mail->addBCC('bcc@example.com');

    // Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');            // Add attachments
    // $mail->addAttachment($filename, 'Nota de Pago');            // Optional name

    // Content
    // $number = $_GET['number'];
    // $q = "SELECT name_owner FROM tbl_paynote_system WHERE number_paynote = '$number'";
    // $res = $con->query($q);
    // $row = $res->fetch_assoc();
    // $name_owner = $row['name_owner'];
    
    // $tipo = 'Notificacion por mora en';
    $services = $_POST['selServices'];
    // $services = 'gas';

    $asunto = 'IMPORTANTE | Recordatorio de pago ' . $services . ' para ' . $nameTo;

    $mail->isHTML(true);                                        // Set email format to HTML
    $mail->Subject = $asunto;
    // $mail->Body = file_get_contents('template_mail/mailservices.php');
    $mail->Body = ob_get_clean();
    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    if($mail->send()){
        echo 'ok';
    }else{
        echo 'error';
    }
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>