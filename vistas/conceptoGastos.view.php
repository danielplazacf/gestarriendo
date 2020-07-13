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
                    <div class="col-md-5">
                        <div class="box box-solid">
                            <div class="box-header with-border">
                                <h3 class="box-title">Gestor de Conceptos de Gastos</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <form class="form-horizontal" id="addAccountBank" method="POST">
                                    <div class="box-body">
                                        <!-- titular -->
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Nombre:</label>
                                            <div class="col-sm-10">
                                                <input name="name" id="name" type="text" class="form-control" placeholder="Ingrese el Nombre del Concepto" autocomplete="none">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.box-body -->
                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-success pull-right"><i class="fas fa-plus-circle"></i> Crear</button>
                                    </div>
                                    <!-- /.box-footer -->
                                </form>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </div>

                    <div class="col-md-7">
                        <div class="box no-border">
                            <!-- /.box-header -->
                            <div class="box-body ">
                                <table id="tableAccountBank" class="table table-striped" style="font-size: 1.2rem">
                                    <thead>
                                        <tr>
                                            <th>DESCRIPCION DEL CONCEPTO</th>
                                            <th width="75px">OPCIONES</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </div>
                </div>

            </section>

            <!-- /.content -->

        </div>
        <!-- /.content-wrapper -->

        <!-- EDIT ACCOUNT BANK -->
        <div class="modal fade" id="modalEditAccountBank" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span></button>
                        <h4 class="modal-title">Editar Concepto de Gasto</h4>
                    </div>
                    <div class="modal-body pb-0">
                        <form class="form-horizontal" id="editAccountBank" method="POST">
                            <input type="hidden" name="id_concepto_gasto" id="id_concepto_gasto">
                            <div class="row px-4">
                                <div class="col-md-12">
                                    <!-- titular -->
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Nombre:</label>
                                        <div class="col-sm-10">
                                            <input name="name_edit" id="name_edit" type="text" class="form-control" placeholder="Ingrese el Nombre del Concepto" autocomplete="none">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer py-3">
                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-primary">Actualizar</button>
                            </div>
                    </div>

                    </form>
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
    <!-- Rut Chileno -->
    <script src="resources/dist/js/jquery.rut.js"></script>

    <script>
        $(document).ready(function() {
            <?php if($_SESSION['type_user'] == 'observador') {?>
                $(".btn").attr('disabled', true);
            <?php }?>
            cargarAccountBank();
            addAccountBank();
            editAccountBank();
        });

        //Llamamos a la función para formatear RUT Chileno
        $("#rut_account").rut();
        $("#rut_edit").rut();

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

        // Cargamos la lista de cuentas bancarias
        cargarAccountBank = function() {
            // Obtenemos el valor por el id
            // id_property = document.getElementById("id_owner_property").value;

            $("#tableAccountBank").dataTable({
                "destroy": true,
                "order": [], //[[ 0, "desc" ]],
                "paging": false,
                "lengthChange": false,
                "searching": false,
                "ordering": false,
                "info": true,
                //"autoWidth": true,
                "dom": "<'row'<'form-inline' <'col-sm-6'B><'col-sm-6'f>>>" +
                    "<rt>" +
                    "<'row'<'form-inline'" +
                    "<'col-sm-6 col-md-6 col-lg-6'l>" +
                    "<'col-sm-6 col-md-6 col-lg-6'p>>>", //'Bfrtip'
                "buttons": [
                    //Btn Imprimir
                    {
                        extend: 'alert',
                        text: '<i class="fa fa-print"></i> Imprimir',
                        className: 'btn btn-default',
                    },
                ],
                "ajax": {
                    "url": "model/listConceptoGastos.php",
                    "method": "POST"
                },
                "aoColumns": [

                    //1
                    {
                        "mData": function(data, type, dataToSet) {
                            return data.name;
                        }
                    },
                    {
                        "mData": function(data, type, dataToSet) {
                            let disable = '';
                              <?php if($_SESSION['type_user'] == 'observador') {?>
                                disable = 'disabled';
                              <?php }?>
                            return '<div class="btn-group"><button button="button" onclick="mostrarAccount(' + data.id + ')" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modalEditAccountBank"><i class="fas fa-edit"></i></button><button button="button" onclick="deleteAccountBank(' + data.id + ')" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button></div>';
                        }
                    }

                ],
                "language": idioma_spanol
            });

        }
        idioma_spanol = {
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ningún dato disponible en esta tabla",
            "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix": "",
            "sSearch": "Buscar:",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        }

        var mostrarAccount = function(id) {
            $.ajax({
                url: "model/searchConceptoGastos.php",
                method: "POST",
                dataType: "json",
                data: {
                    id_concepto_gasto: id
                },
                success: function(datos) {
                    $('#id_concepto_gasto').val(datos.id);

                    $('#name_edit').val(datos.name);
                    //
                }
            });
        }

        var deleteAccountBank = function(id) {
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
                        url: "model/deleteConceptoGastos.php",
                        method: "POST",
                        data: {
                            id_concepto_gasto: id
                        },
                        success: function(data) {
                            if (data == 'ok') {
                                swal("Eliminado! El registro fue eliminado.", {
                                    icon: "success",
                                });
                                cargarAccountBank();
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

        var editAccountBank = function(id) {
            $('#editAccountBank').submit(function(e) {
                var datos = $(this).serialize();
                e.preventDefault();

                $.ajax({
                    type: "POST",
                    url: "model/editConceptoGastos.php",
                    data: datos,
                    success: function(data) {
                        if (data == 'ok') {
                            swal({
                                title: "Actualizado!",
                                text: "El registro fue actualizado satisfactoriamente.",
                                icon: "success",
                                button: "Ok",
                            });
                            cargarAccountBank();
                            $('#editAccountBank')[0].reset();
                            $('#modalEditAccountBank').modal('hide');
                            // console.log('Exitazooooooo');
                        } else if (data == 'vacio') {
                            swal({
                                title: "Algo salio mal!",
                                text: "Intentalo nuevamente, no puedes incluir campos vacios, ni caracteres extraños.",
                                icon: "error",
                                button: "Cerrar",
                            });
                            $('#editAccountBank')[0].reset();
                            $('#modalEditAccountBank').modal('hide');
                        } else {
                            console.log(data);
                        }
                    }
                });
            });
        }

        var addAccountBank = function() {
            $('#addAccountBank').submit(function(e) {
                e.preventDefault();
                var datos = $(this).serialize();
                //console.log(datos);
                $.ajax({
                    type: "POST",
                    url: "model/addConceptoGastos.php",
                    data: datos,
                    success: function(data) {
                        if (data == 'ok') {
                            swal({
                                title: "Buen Trabajo!",
                                text: "El registro fue ingresado satisfactoriamente.",
                                icon: "success",
                                button: "Ok",
                            });
                            cargarAccountBank();
                            $('#addAccountBank')[0].reset();

                            // console.log('Exitazooooooo');
                        } else if (data == 'vacio') {
                            swal({
                                title: "Algo salio mal!",
                                text: "Un campo esta vacío, recuerda registrar todos los datos.",
                                icon: "error",
                                button: "Cerrar",
                            });
                            cargarAccountBank();
                            $('#addAccountBank')[0].reset();

                        } else {
                            console.log(data);
                        }
                    }
                });
            });
        }
    </script>

</body>

</html>