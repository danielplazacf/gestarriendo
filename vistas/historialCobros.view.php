<!DOCTYPE html>
<html lang="es">

<head>
    <?php include 'head.php'; ?>
    <!-- DataTables -->
    <link rel="stylesheet" href="resources/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="resources/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">

    <style type="text/css">
        .cke_textarea_inline {
            border: 1px solid #ccc;
            padding: 10px;
            min-height: 300px;
            background: #fff;
            color: #000;
        }
    </style>

</head>

<body class="hold-transition skin-black sidebar-mini <?php echo $sidebar; ?>">
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
                    <!-- Button trigger modal -->
                    <a href="javascript:history.back(1)" class="btn btn-primary pull-right"><i class="fa fa-mail-reply" aria-hidden="true"></i> Volver atrás</a>

                </h1>
            </section>

            <!-- Main content -->
            <section class="content container-fluid">

                <div class="row">
                    <div class="col-xs-12">

                        <div class="box no-border">
                            <!-- /.box-header -->
                            <div class="box-body ">
                                <div class="form-group">
                                    <label>Filtro por Estado:</label>
                                    <select class="form-control" id="status_filter" style="width: 150px !important;">
                                        <option value="">Todos</option>
                                        <option value="pendiente">Pendiente</option>
                                        <option value="vencido">Vencido</option>
                                        <option value="pagado">Pagado</option>
                                        <option value="cancelado">Cancelado</option>
                                    </select>
                                </div>
                                <table id="tableCobros" class="table table-striped" style="font-size: 1.1rem; width:100%">
                                    <thead>
                                        <tr>
                                            <th>DIRECCION PROPIEDAD</th>
                                            <th>DESDE</th>
                                            <th>HACIA</th>
                                            <th>CONCEPTO</th>
                                            <th>ESTADO</th>
                                            <th>MONTO</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
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
    <!-- Bootstrap 3.3.7 -->
    <script src="resources/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Select 2 -->
    <script src="resources/bower_components/select2/dist/js/select2.full.js"></script>
    <!-- Datepicker -->
    <script src="resources/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="resources/bower_components/bootstrap-datepicker/js/locales/bootstrap-datepicker.es.js"></script>
    <!-- DataTables -->
    <script src="resources/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="resources/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
        <!--Export Buttons-->
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.flash.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>
    <!-- Sweet Alert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- Rut Chileno -->
    <script src="resources/dist/js/jquery.rut.js"></script>
    <!-- AdminLTE App -->
    <script src="resources/dist/js/adminlte.min.js"></script>
    <!-- Moment.js -->
    <script src="resources/dist/js/moment.min.js"></script>
    <script type="text/javascript">
        // definimos el tipo de moneda con api de JS
        const formatter = new Intl.NumberFormat('es-CL', {
            style: 'currency',
            currency: 'CLP',
            minimumFractionDigits: 0
        })
        $(document).ready(function() {

            $("#status_filter").change(function(){
               if ( table.column(4).search() !== this.value ) {
                    table
                        .column(4)
                        .search( this.value )
                        .draw();
                }
            });
            
            var table = $("#tableCobros").DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf','print'
                ],
                "destroy": true,
                "order": [], //[[ 0, "desc" ]],
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": false,
                "info": true,
                "autoWidth": true,
                "ajax": {
                    "url": "model/listFinanceModel.php?get=cobros",
                    "method": "POST"
                },
                "aoColumns": [

                    {
                        "mData": function(data, type, dataToSet) {
                            return data.address_property+"<br>("+data.comuna_property+")";
                        }
                    },
                    {
                        "mData": function(data, type, dataToSet) {
                            return data.desde_cobro+"<br>("+data.name_desde_cobro+")";
                        }
                    },
                    //2
                    {
                        "mData": function(data, type, dataToSet) {
                            return data.hacia_cobro+"<br>("+data.name_hacia_cobro+")";
                        }
                    },
                    //3
                    {
                        "mData": function(data, type, dataToSet) {
                            return data.concepto_csimple;
                        }
                    },
                     //4
                    {
                        "mData": function(data, type, dataToSet) {
                            if (data.estatus === 'pendiente') {
                                return '<label class="label label-info">Pendiente</label>'
                            } else if (data.estatus === 'vencido') {
                                return '<label class="label label-warning">Vencido</label>'
                            } else if (data.estatus === 'pagado') {
                                return '<label class="label label-success">Pagado</label>'
                            } else if (data.estatus === 'cancelado') {
                                return '<label class="label label-danger">Cancelado</label>'
                            }
                        }
                    },
                    //5
                    {
                        "mData": function(data, type, dataToSet) {
                            return formatter.format(data.amount_csimple);
                        }
                    }

                ],
                "language": idioma_spanol
            });

        });

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
    </script>

</body>

</html>