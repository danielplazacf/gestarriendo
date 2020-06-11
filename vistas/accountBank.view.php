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
                                <h3 class="box-title">Gestor de Cuentas Bancarias</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <form class="form-horizontal" id="addAccountBank" method="POST">
                                    <div class="box-body">
                                        <!-- titular -->
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Titular:</label>
                                            <div class="col-sm-10">
                                                <input name="titular_account" id="titular_account" type="text" class="form-control" placeholder="Ingrese titular de la cuenta" autocomplete="none">
                                            </div>
                                        </div>
                                        <!-- rut -->
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">R.U.T.:</label>
                                            <div class="col-sm-10">
                                                <input name="rut_account" id="rut_account" type="text" class="form-control" placeholder="Ingrese rut del titular" autocomplete="none">
                                            </div>
                                        </div>
                                        <!-- banco -->
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Banco:</label>
                                            <div class="col-sm-10">
                                                <select name="bank_account" id="bank_account" class="form-control select2">
                                                    <option></option>
                                                    <?php
                                                    $selbank = 'SELECT * FROM tbl_bank_system';
                                                    $q = $con->query($selbank);
                                                    // While para repetir todos los campos dentro de la base de datos
                                                    while ($bank = $q->fetch(PDO::FETCH_ASSOC)) {
                                                    ?>
                                                        <option value="<?php echo $bank['name_bank']; ?>"><?php echo $bank['name_bank']; ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <!-- tipo cuenta -->
                                        <div class="form-group">
                                            <label class="col-sm-2 text-left pt-0 control-label">Tipo cuenta:</label>
                                            <div class="col-sm-10">
                                                <select name="type_account" id="type_account" class="form-control select2">
                                                    <option></option>
                                                    <?php
                                                    $seltype = 'SELECT * FROM tbl_type_bank';
                                                    $q = $con->query($seltype);
                                                    // While para repetir todos los campos dentro de la base de datos
                                                    while ($type = $q->fetch(PDO::FETCH_ASSOC)) {
                                                    ?>
                                                        <option value="<?php echo $type['type_bank']; ?>"><?php echo $type['type_bank']; ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <!-- n° cuenta -->
                                        <div class="form-group">
                                            <label class="col-sm-2 text-left pt-0 control-label">N° de cuenta:</label>
                                            <div class="col-sm-10">
                                                <input name="number_account" id="number_account" type="text" class="form-control" placeholder="Ingrese n° de cuenta" autocomplete="none">
                                            </div>
                                        </div>
                                        <!-- email cuenta -->
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Email:</label>
                                            <div class="col-sm-10">
                                                <input name="email_account" id="email_account" type="text" class="form-control" placeholder="Ingrese e-mail de confirmación" autocomplete="none">
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
                                            <th>DATOS TITULAR</th>
                                            <th>BANCO</th>
                                            <th width="115px">DATOS DE CUENTA</th>
                                            <th width="140px">CORREO ELECTRÓNICO</th>
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
                        <h4 class="modal-title">Editar Cuentas Bancarias</h4>
                    </div>
                    <div class="modal-body pb-0">
                        <form class="form-horizontal" id="editAccountBank" method="POST">
                            <input type="hidden" name="id_account_bank" id="id_account_bank">
                            <div class="row px-4">
                                <div class="col-md-12">
                                    <!-- titular -->
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Titular:</label>
                                        <div class="col-sm-10">
                                            <input name="titular_edit" id="titular_edit" type="text" class="form-control" placeholder="Ingrese titular de la cuenta" autocomplete="none">
                                        </div>
                                    </div>
                                    <!-- rut -->
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">R.U.T.:</label>
                                        <div class="col-sm-10">
                                            <input name="rut_edit" id="rut_edit" type="text" class="form-control" placeholder="Ingrese rut del titular" autocomplete="none">
                                        </div>
                                    </div>
                                    <!-- banco -->
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Banco:</label>
                                        <div class="col-sm-10">
                                            <select name="bank_edit" id="bank_edit" class="form-control">
                                                <?php
                                                $selbank = 'SELECT * FROM tbl_bank_system';
                                                $q = $con->query($selbank);
                                                // While para repetir todos los campos dentro de la base de datos
                                                while ($bank = $q->fetch(PDO::FETCH_ASSOC)) {
                                                ?>
                                                    <option value="<?php echo $bank['name_bank']; ?>"><?php echo $bank['name_bank']; ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- tipo cuenta -->
                                    <div class="form-group">
                                        <label class="col-sm-2 text-left pt-3 pr-0 pl-0 control-label">Tipo cuenta:</label>
                                        <div class="col-sm-10">
                                            <select name="type_edit" id="type_edit" class="form-control">
                                                <?php
                                                $seltype = 'SELECT * FROM tbl_type_bank';
                                                $q = $con->query($seltype);
                                                // While para repetir todos los campos dentro de la base de datos
                                                while ($type = $q->fetch(PDO::FETCH_ASSOC)) {
                                                ?>
                                                    <option value="<?php echo $type['type_bank']; ?>"><?php echo $type['type_bank']; ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- n° cuenta -->
                                    <div class="form-group">
                                        <label class="col-sm-2 text-left pt-3 pr-0 pl-0 control-label">N° de cuenta:</label>
                                        <div class="col-sm-10">
                                            <input name="number_edit" id="number_edit" type="text" class="form-control" placeholder="Ingrese n° de cuenta" autocomplete="none">
                                        </div>
                                    </div>
                                    <!-- email cuenta -->
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Email:</label>
                                        <div class="col-sm-10">
                                            <input name="email_edit" id="email_edit" type="text" class="form-control" placeholder="Ingrese e-mail de confirmación" autocomplete="none">
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
                    "url": "model/listAccountBankModel.php",
                    "method": "POST"
                },
                "aoColumns": [

                    //1
                    {
                        "mData": function(data, type, dataToSet) {
                            return '<b>Titular:</b><br>' + data.titular_account + "<br><b>Rut:</b><br>" + data.rut_account;
                        }
                    },
                    //2
                    {
                        "mData": function(data, type, dataToSet) {
                            return data.bank_account;
                        }
                    },
                    //3
                    {
                        "mData": function(data, type, dataToSet) {
                            return '<b>Tipo:</b><br>' + data.type_account + "<br><b>N° de cuenta:</b><br>" + data.number_account;
                        }
                    },
                    //4
                    {
                        "mData": function(data, type, dataToSet) {
                            return data.email_account;
                        }
                    },
                    //5
                    // { "mData": function (data, type, dataToSet) {
                    //  return "DNG-"+ data.bank;}
                    // },
                    {
                        "mData": function(data, type, dataToSet) {
                            // return "<div class='btn-group'><button button='button' onclick='mostrarProperty(" + data + ");' class='btn bg-olive' data-toggle='modal' data-target='#modalEditProperty'><i class='fa fa-edit'></i></button><a href='fichaProperty.php?property="+ data +"' class='btn btn-default'><i class='fa fa-eye'></i></a><button type='button' onclick='deleteProperty(" + data + ");' class='btn btn-danger'><i class='fa fa-trash'></i></button></div>"
                            //return "<div class='ocultar-elemento btn-group'><button type='button' class='btn btn-primary dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>Mostrar <span class='caret'></span></button><ul class='dropdown-menu'><li><a href='' onclick='mostrarOwner(" + data.id_account_bank + ");' data-toggle='modal' data-target='#modalEditOwner'><i class='fa fa-edit'></i>Editar</a></li><li><a herf='' onclick='deleteOwner(" + data.id_account_bank + ");'><i class='fa fa-trash'></i> Eliminar</a></li></ul></div>"
                            let disable = '';
                              <?php if($_SESSION['type_user'] == 'observador') {?>
                                disable = 'disabled';
                              <?php }?>
                            return '<div class="btn-group"><button button="button" disabled="'+disable+'" onclick="mostrarAccount(' + data.id_account_bank + ')" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modalEditAccountBank"><i class="fas fa-edit"></i></button><button button="button" disabled="'+disable+'" onclick="deleteAccountBank(' + data.id_account_bank + ')" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button></div>';
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

        var mostrarAccount = function(id_account_bank) {

            if (!/^([0-9])*$/.test(id_account_bank)) {
                return false
            } else {
                $.ajax({
                    url: "model/searchAccountBank.php",
                    method: "POST",
                    dataType: "json",
                    data: {
                        id_account_bank: id_account_bank
                    },
                    success: function(datos) {
                        $('#id_account_bank').val(datos.id_account_bank);

                        $('#titular_edit').val(datos.titular_account);
                        $('#rut_edit').val(datos.rut_account);
                        $('#bank_edit').val(datos.bank_account);
                        $('#type_edit').val(datos.type_account);
                        $('#number_edit').val(datos.number_account);
                        $('#email_edit').val(datos.email_account);
                        //
                    }
                });
            }
        }

        var deleteAccountBank = function(id_account_bank) {

            if (!/^([0-9])*$/.test(id_account_bank)) {
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
                                url: "model/deleteAccountBank.php",
                                method: "POST",
                                data: {
                                    id_account_bank: id_account_bank
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
        }

        var editAccountBank = function(id_account_bank) {
            $('#editAccountBank').submit(function(e) {
                var datos = $(this).serialize();
                e.preventDefault();

                $.ajax({
                    type: "POST",
                    url: "model/editAccountBankModel.php",
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
                    url: "model/addAccountBankModel.php",
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