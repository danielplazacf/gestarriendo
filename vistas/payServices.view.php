<!DOCTYPE html>
<html>

<head>
    <?php include 'head.php'; ?>
    <!-- DataTables css -->
    <link rel="stylesheet" href="resources/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <style type="text/css">
        .form-date {
            margin-bottom: 20px;
        }

        .font-weight-light {
            font-weight: 300;
        }
    </style>
</head>

<body class="hold-transition skin-black sidebar-mini <?php echo $sidebar; ?>">
    <div class="loader"></div>
    <div class="load-email"></div>
    <div class="wrapper">

        <!-- Main Header -->
        <header class="main-header">

            <?php include 'header.php'; ?>

        </header>
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">

            <?php include 'menu_nav.php'; ?>

        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    <?php echo $titulo; ?>
                    <small>Sistema de Gestión Inmobiliaria</small>
                </h1>
            </section>

            <!-- Main content -->
            <section class="content container-fluid">

                <div class="row">
                    <?php
                    $selEmpresa = $con->prepare("SELECT * FROM tbl_datos_empresa");
                    $selEmpresa->execute();
                    $rowEmpresa = $selEmpresa->fetch(PDO::FETCH_ASSOC);

                    if(empty($rowEmpresa['name_empresa'])){
                        $html = '<div class="col-md-12"><div class="alert alert-warning alert-dismissible mb-3"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Al parecer aún no completas los datos de la empresa en el sistema, para hacerlo debes seguir este <a class="text-black" href="optionSystem.php">enlace</a>. Si no lo haces, tendras problemas en el envio de correos.</div></div>';
                        echo $html;
                    }
                    ?>
                    <div class="col-md-12">
                        <div class="box">
                            <div class="box-body">
                                <form class="form-inline mb-5" id="form" method="post">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>La dirección de la propiedad:</label>
                                                <select name="address_property" id="address_property" class="form-control select2">
                                                    <option></option>
                                                    <?php
                                                    $seladdress = 'SELECT id_property, address_property FROM tbl_property_system';
                                                    $q = $con->query($seladdress);
                                                    // While para repetir todos los campos dentro de la base de datos
                                                    while ($address = $q->fetch(PDO::FETCH_ASSOC)) {
                                                    ?>
                                                        <option value="<?php echo $address['id_property']; ?>"><?php echo $address['address_property']; ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                                <button id="btnMora" type="button" data-toggle="modal" data-target="#modalMora" class="mt-3 btn btn-warning" disabled><i class="fas fa-info-circle"></i> Notificar Mora</button>
                                            </div>

                                        </div>
                                        <div class="col-md-3">
                                            <label>Agua:</label>
                                            <p id="proveedor_agua"></p>
                                            <p id="agua_edit">Sin registros</p>
                                            <!-- <p id="resultado">Cargando...</p> -->
                                        </div>
                                        <div class="col-md-3">
                                            <label>Luz:</label>
                                            <p id="proveedor_luz"></p>
                                            <p id="luz_edit">Sin registros</p>
                                        </div>
                                        <div class="col-md-3">
                                            <label>Gas:</label>
                                            <p id="proveedor_gas"></p>
                                            <p id="gas_edit">Sin registros</p>
                                        </div>
                                    </div>
                                </form>

                                <iframe src="https://www.sencillito.com/pago#sencillitoCartApp" width="100%" height="450" scrolling="yes"></iframe>
                            </div>
                        </div>
                    </div>
                </div>

            </section>

            <!-- /.content -->

        </div>
        <!-- /.content-wrapper -->
        <div class="modal fade" id="modalMora" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span></button>
                        <h4 class="modal-title">Notificar de mora en servicios</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <label id="statusForm"></label>
                                <form id="notificaMora" method="post" class="form-inline">
                                    <input type="hidden" name="id_property" id="id_property">
                                    <input type="hidden" name="nameLeaser" id="nameLeaser">

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input name="emailLeaser" id="emailLeaser" type="text" class="form-control" placeholder="enviar@notificacioncliente.com">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <select name="selServices" id="selServices" class="form-control select2 w-100">
                                                <option></option>
                                                <option value="agua">Notificar Agua</option>
                                                <option value="luz">Notificar Luz</option>
                                                <option value="gas">Notificar Gas</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group w-100">
                                            <button type="submit" id="btnEmail" class="btn btn-success w-100"><i class="fas fa-envelope"></i> Si, enviar </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>

        <!-- Main Footer -->
        <footer class="main-footer">
            <?php include 'footer.php'; ?>
        </footer>


    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED JS SCRIPTS -->

    <!-- jQuery 3 -->
    <script src="resources/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script> -->
    <!-- Bootstrap 3.3.7 -->
    <script src="resources/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Select 2 -->
    <script src="resources/bower_components/select2/dist/js/select2.full.js"></script>
    <!-- Toastr 2.1.4 -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <!-- AdminLTE App -->
    <script src="resources/dist/js/adminlte.min.js"></script>
    <!-- DataTables -->
    <script src="resources/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="resources/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <!-- Sweet Alert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- Moment.js -->
    <script type="text/javascript" src="resources/dist/js/moment.min.js"></script>
    <!-- Ventana Centrada JS -->
    <script type="text/javascript" src="resources/dist/js/VentanaCentrada.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            sendMail();
            // ejecucion de on(change) al cambiar la opcion
            $('#address_property').on('change', function() {

                // deshabilitamos button 'btnMora'
                $('#btnMora').attr('disabled', 'disabled');

                // toma la opcion seleccionada
                $('#address_property option:selected').each(function() {

                    // la variable direccion guarda el valor de la seleccion anterior
                    var direccion = $(this).val();
                    //console.log(direccion);
                    // se ejecuta un ajax para buscar los numeros de clientes
                    $.ajax({
                        url: "model/searchNumberClient.php",
                        method: "POST",
                        dataType: "json",
                        // data es igual al valor de var direccion
                        data: {
                            id_property: direccion
                        },
                        beforeSend: function() {
                            // mostramos un load en los siguientes id's
                            $('#agua_edit').html('Sin registros');
                            $('#luz_edit').html('Sin registros');
                            $('#gas_edit').html('Sin registros');
                        },
                        success: function(datos) {
                            // mostramos los datos obtenidos de la busqueda en los siguientes id's
                            $('#agua_edit').html(datos.n_client_agua);
                            $('#proveedor_agua').html(datos.proveedor_agua);

                            $('#luz_edit').html(datos.n_client_luz);
                            $('#proveedor_luz').html(datos.proveedor_luz);

                            $('#gas_edit').html(datos.n_client_gas);
                            $('#proveedor_gas').html(datos.proveedor_gas);

                            $('#id_property').val(datos.id_property);
                            // al obtener los numeros de clientes, habilitamos el 'btnMora'
                            $('#btnMora').attr('disabled', false);
                        },
                        error: function(xhr, textStatus, errorMessage) {

                            console.log("ERROR:" + errorMessage + textStatus + xhr);

                        }

                    });

                })
            })

            // ejecucion on(click) al clickear sobre el boton
            $('#btnMora').on('click', function() {
                // obtenemos el valor del campo con id 'id_property'
                var id_property = $('#id_property').val();
                // ejecutamos ajax para obtener los correos de cada arrendatario
                $.ajax({
                    url: "model/searchEmailClient.php",
                    method: "POST",
                    dataType: "json",
                    // data es igual a el id_property
                    data: {
                        id_property: id_property
                    },
                    success: function(datos) {
                        //console.log(datos);
                        if (datos.error == 'vacio') {
                            $('#statusForm').html('<div class="mb-3 ml-4 px-2 alert alert-warning" role="alert"><strong>Lo siento!</strong> <span class="font-weight-light">Al parecer aun no hay un arrendatario en esta <u>propiedad.</u> Intenta agregar uno.</span></div>');
                            $('#nameLeaser').val('');
                            $('#selServices').attr('disabled', true);
                            $('#emailLeaser').attr('disabled', true);
                            $('#btnEmail').attr('disabled', true);
                            $('#notificaMora')[0].reset();
                        } else {
                            $('#statusForm').html('¿Quieres enviar la notificación a <u>' + datos.name_leaser + '</u> de su mora?');
                            $('#nameLeaser').val(datos.name_leaser);
                            $('#emailLeaser').val(datos.email_leaser);
                            $('#selServices').attr('disabled', false);
                            $('#emailLeaser').attr('disabled', false);
                            $('#btnEmail').attr('disabled', false);   
                        }

                    },
                    error: function(xhr, textStatus, errorMessage) {
                        console.log("ERROR" + errorMessage + textStatus + xhr);
                    }

                });
            })

        })

        $('.load-email').hide();
        var sendMail = function() {
            $('#notificaMora').submit(function(e) {
                e.preventDefault();
                var datos = $(this).serialize();
                //console.log(datos);
                
                $.ajax({
                    type: "POST",
                    url: "model/sendMailServices.php",
                    data: datos,
                    beforeSend: function(){
                        $('.load-email').show();
                        $('#modalMora').modal('hide');
                    },
                    success: function(data) {
                        $('.load-email').hide();
                        swal({
                                title: "Enviado!",
                                text: "El correo fue enviado satisfactoriamente.",
                                icon: "success",
                                button: "Ok",
                            });
                    },
                    error: function(xhr, textStatus, errorMessage) {
                        console.log("ERROR: " + errorMessage + textStatus + xhr);
                    }
                });
            })
        }

        // Select 2
        $(function() {
            //Initialize Select2 Elements
            $('.select2').select2({
                width: '100%',
                language: {

                    noResults: function() {

                        return "No hay resultado";
                    },
                    searching: function() {

                        return "Buscando..";
                    }
                },
                placeholder: "Seleccionar opción",
                allowClear: true
            })
        });
    </script>

</body>

</html>