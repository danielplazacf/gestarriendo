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
                    <div class="col-md-12">
                        <div class="box">
                            <div class="box-body">
                                <form class="mb-5" id="form" method="post">
                                    <div class="row">
                                        <div class="col-md-3">
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
                                        </div>
                                        <div class="col-md-3">
                                            <label>N° Cliente agua:</label>
                                            <p id="agua_edit">Cargando...</p>
                                            <!-- <p id="resultado">Cargando...</p> -->
                                        </div>
                                        <div class="col-md-3">
                                            <label>N° Cliente luz:</label>
                                            <p id="luz_edit">Cargando...</p>
                                        </div>
                                        <div class="col-md-3">
                                            <label>N° Cliente gas:</label>
                                            <p id="gas_edit">Cargando...</p>
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

        $('#address_property').on('change', function() {
            $('#address_property option:selected').each(function() {

                var direccion = $(this).val();

                $.ajax({
                    url: "model/searchClient.php",
                    method: "POST",
                    dataType: "json",
                    data: direccion,
                    success: function(datos) {
                        $('#agua_edit').html(datos.n_client_agua);
                        $('#luz_edit').html(datos.n_client_luz);
                        $('#gas_edit').html(datos.n_client_gas);
                    },
                    error: function(xhr, textStatus, errorMessage) {

                        console.log("ERROR" + errorMessage + textStatus + xhr);

                    }
                });
            })
        })

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