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
        .profile-user-img {
            margin: 0 auto;
            width: 214px;
            padding: 3px;
            border: 3px solid #d2d6de;
            height: 75px;
        }
    </style>
</head>

<body class="hold-transition skin-black sidebar-mini <?php echo $sidebar; ?>">
    <div class="loader"></div>
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
                    <div class="col-md-5 col-md-offset-1 mb-3">
                        <div class="box box-primary mb-3">
                            <div class="box-body box-profile">
                                <?php

                                $query = $con->prepare("SELECT * FROM tbl_datos_empresa");
                                $query->execute();
                                $row = $query->fetch(PDO::FETCH_ASSOC);

                                //echo $row['name_empresa'];

                                if (empty($row['name_empresa'])) {
                                    echo 'No hay datos empresa registrados actualmente en la base de datos';
                                } else {

                                    $html = '
                                        <img class="mb-5 profile-user-img img-responsive" src="' . $row['ruta_logo_empresa'] . '">

                                        <h3 class="profile-username text-center">
                                        ' . $row['name_empresa'] . '
                                        </h3>
        
                                        <p class="text-muted text-center">' . $row['giro_empresa'] . '</p>
        
                                        <ul class="list-group list-group-unbordered">
                                            <li class="list-group-item">
                                                <b>RUT:</b> ' . $row['rut_empresa'] . '
                                            </li>
                                            <li class="list-group-item">
                                                <b>Dirección:</b> ' . $row['address_empresa'] . '
                                            </li>
                                            <li class="list-group-item">
                                                <b>Teléfono:</b> ' . $row['telefono_empresa'] . '
                                            </li>
                                            <li class="list-group-item">
                                                <b>Correo:</b> <a href="mailto:' . $row['correo_empresa'] . '">' . $row['correo_empresa'] . '</a>
                                            </li>
                                        </ul>';

                                    echo $html;
                                }
                                ?>

                            </div>
                            <!-- /.box-body -->
                        </div>
                        <div class="alert alert-warning mb-3">
                            <strong>Información:</strong> para cambiar los datos de la empresa, debes vaciar los datos guardados anteriormente con el botón que esta abajo.
                        </div>
                        <button type="button" onclick="deleteDato(<?php echo $row['id_dempresa']; ?>)" class="btn btn-danger"><i class="fas fa-trash"></i> Vaciar datos</button>
                    </div>

                    <div class="col-md-5">
                        <div class="box box-default collapsed-box">
                            <div class="box-header with-border">
                                <h3 class="box-title">Ingresar información de la Empresa</h3>

                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                    </button>
                                </div>
                                <!-- /.box-tools -->
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body" style="display: none;">
                                <form id="datosEmpresa" method="POST" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-xs-12 col-lg-12">
                                            <div class="form-group">
                                                <label>Nombre o razón social:</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-university" aria-hidden="true"></i>
                                                    </div>
                                                    <input name="name_empresa" id="name_empresa" type="text" class="form-control" autocomplete="none" placeholder="Ej: Empresas de servicios LTDA" required="">
                                                </div>
                                                <!-- /.input group -->
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-lg-12">
                                            <div class="form-group">
                                                <label>R.U.T.:</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <i class="fas fa-id-card" aria-hidden="true"></i>
                                                    </div>
                                                    <input name="rut_empresa" id="rut_empresa" type="text" class="rut form-control" autocomplete="none" placeholder="Ej: 76.111.111-1" required="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-lg-12">
                                            <div class="form-group">
                                                <label>Giro:</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <i class="fas fa-arrow-right" aria-hidden="true"></i>
                                                    </div>
                                                    <input name="giro_empresa" id="giro_empresa" type="text" class="form-control" autocomplete="none" placeholder="Ej: Empresa de servicios inmobiliarios, propiedades, etc" required="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-xs-12 col-lg-12">
                                            <div class="form-group">
                                                <label>Dirección Comercial:</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-map-marker" aria-hidden="true"></i>
                                                    </div>
                                                    <input name="address_empresa" id="address_empresa" type="text" class="form-control" autocomplete="none" placeholder="Ej: Calle Nueva Providencia #123" required="">
                                                </div>
                                                <!-- /.input group -->
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-lg-12">
                                            <div class="form-group">
                                                <label>Teléfono:</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <i class="fas fa-phone" aria-hidden="true"></i>
                                                    </div>
                                                    <input name="telefono_empresa" id="telefono_empresa" type="text" class="form-control" autocomplete="none" placeholder="Ej: 9 1234 5678" required="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-lg-12">
                                            <div class="form-group">
                                                <label>Correo Electrónico:</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <i class="fas fa-envelope" aria-hidden="true"></i>
                                                    </div>
                                                    <input name="correo_empresa" id="correo_empresa" type="text" class="form-control" autocomplete="none" placeholder="Ej: mail@empresa.com" required="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-xs-4 col-lg-12">
                                            <div class="form-group">
                                                <div class="btn btn-default btn-file">
                                                    <i class="fa fa-paperclip"></i> Logotipo
                                                    <input type="file" name="logo_empresa" id="logo_empresa">
                                                </div>
                                                <p class="help-block">Max. 2MB</p>
                                            </div>
                                        </div>

                                        <div class="col-xs-4 col-lg-12">
                                            <article id="logo_load" class="thumbnail mb-0" style="height: 75px; width:214px">

                                            </article>
                                            <span class="mt-0"><small>medidas 214x75 pixeles | Formato .png</small></span>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-xs-12" id="CuentaAtras">

                                        </div>
                                    </div>
                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-success">Guardar</button>
                                    </div>
                                </form>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->
                        </div>
            </section>

            <!-- /.content -->

        </div>
        <!-- /.content-wrapper -->

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
    <!-- Rut Chileno -->
    <script src="resources/dist/js/jquery.rut.js"></script>

    <script src="resources/bower_components/chart.js/Chart.js"></script>

    <script type="text/javascript">
        $('.rut').rut();
        $(document).ready(function() {
            newEmpresa();
        })
        // definimos el tipo de moneda con api de JS
        const formatter = new Intl.NumberFormat('es-CL', {
            style: 'currency',
            currency: 'CLP',
            minimumFractionDigits: 0
        })

        var deleteDato = function(id_dempresa) {

            if (!/^([0-9])*$/.test(id_dempresa)) {
                return false
            } else {

                swal({
                        title: "¿Quieres eliminar el Registro?",
                        text: "Una vez eliminado, no podras recuperarlo!",
                        icon: "warning",
                        buttons: ['Cancelar', 'Eliminar'],
                        dangerMode: true,
                    })

                    .then((willDelete) => {
                        if (willDelete) {
                            $.ajax({
                                url: "model/deleteDatoEmpresa.php",
                                method: "POST",
                                data: {
                                    id_dempresa: id_dempresa
                                },
                                success: function(data) {
                                    if (data == 'ok') {
                                        location.reload();
                                    } else {
                                        console.log(data);
                                    }
                                }
                            });

                        } else {
                            swal("Que bien, no se ha eliminado el registro!");
                        }
                    });
            }
        }

        var newEmpresa = function() {
            $("#datosEmpresa").on("submit", function(e) {
                e.preventDefault();

                var f = $(this);
                var formData = new FormData(document.getElementById("datosEmpresa"));
                //formData.append("dato", "valor");
                //formData.append(f.attr("name"), $(this)[0].files[0]);
                $.ajax({
                        url: "model/addDatosEmpresa.php",
                        type: "post",
                        dataType: "html",
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false
                    })
                    .done(function(res) {
                        swal({
                            title: "Buen Trabajo!",
                            text: "El registro fue ingresado satisfactoriamente.",
                            icon: "success",
                            button: "Ok",
                        });
                        $('#logo_load').html('<img src="' + res + '">');

                        $('#CuentaAtras').html('<div class="alert alert-success my-3">Recargando en 3 segundos...</div>')
                        setTimeout(function() {
                        location.reload();
                        }, 3000);
                        
                        //$('#logo_load').html('<small>' + res + '</small>');
                    });
            });
        }
    </script>

</body>

</html>