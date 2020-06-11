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
          <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#modalAddLeaser">
            <i class="fa fa-plus-circle"></i> Agregar Arrendatario
          </button>

        </h1>
      </section>

      <!-- Main content -->
      <section class="content container-fluid">

        <div class="row">
          <div class="col-xs-12">

            <div class="box no-border">
              <!-- /.box-header -->
              <div class="box-body ">
                <table id="tableLeaser" class="table table-striped" style="font-size: 1.2rem">
                  <thead>
                    <tr>
                      <th>DATOS INTERNOS</th>
                      <th>NOMBRE ARRENDATARIO</th>
                      <th>RUT ARRENDATARIO</th>
                      <th>CORREO ELECTRÓNICO</th>
                      <th>TELÉFONO CONTACTO</th>
                      <th width="150px">OPCIONES</th>
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

    <!-- ADD OWNER SYSTEM MODAL -->
    <div class="modal fade" id="modalAddLeaser" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title text-center" id="myModalLabel">AÑADIR ARRENDATARIOS</h4>
          </div>
          <div class="modal-body">
            <form id="addLeaser" method="POST">
              <input type="hidden" id="agent_designated" name="agent_designated" value="<?php nameUser($_SESSION['user_system']); ?>">
              <input type="hidden" id="date_register" name="date_register" value="<?php echo date('Y-m-d'); ?>">

              <div class="row">
                <div class="col-xs-12">
                  <div class="form-group">
                    <label>Ingresar nombre completo:</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-user"></i>
                      </div>
                      <input type="text" name="name_leaser" id="name_leaser" class="form-control" placeholder="Ej: Víctor Lidio Jara Martínez" autocomplete="none" required>
                    </div>
                    <!-- /.input group -->
                  </div>
                </div>

                <div class="col-xs-6">
                  <div class="form-group">
                    <label>Ingresar R.U.T.:</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-id-card"></i>
                      </div>
                      <input type="text" name="rut_leaser" id="rut_leaser" class="form-control rut" placeholder="Ej: 18.123.456-7" autocomplete="none" required>
                    </div>
                    <!-- /.input group -->
                  </div>
                </div>

                <div class="col-xs-6">
                  <div class="form-group">
                    <label>Correo Electrónico:</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-envelope"></i>
                      </div>
                      <input type="email" name="mail_leaser" id="mail_leaser" class="form-control" placeholder="Ej: mail@correodelcliente.cl" autocomplete="none" required>
                    </div>
                    <!-- /.input group -->
                  </div>
                </div>

                <div class="col-xs-6">
                  <div class="form-group">
                    <label>N° de Whatsapp:</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        +56
                      </div>
                      <input type="text" name="phone_leaser" id="phone_leaser" class="form-control" placeholder="Ej: 948992070" autocomplete="none" maxlength="9" required>
                    </div>
                    <!-- /.input group -->
                  </div>
                </div>

                <div class="col-xs-6">
                  <div class="form-group">
                    <label>N° de Contacto 2:</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        +56
                      </div>
                      <input type="text" name="phone_leaser_two" id="phone_leaser_two" class="form-control" placeholder="Ej: 948992070" autocomplete="none" maxlength="9">
                    </div>
                    <!-- /.input group -->
                  </div>
                </div>
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            <button id="btnSave" type="submit" class="btn btn-success"></button>
          </div>
          </form>
        </div>
      </div>
    </div>

    <!-- EDIT OWNER SYSTEM MODAL -->
    <div class="modal fade" id="modalEditLeaser" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title text-center" id="myModalLabel">EDITAR PROPIETARIOS</h4>
          </div>
          <div class="modal-body">
            <form id="editLeaser" method="POST">
              <input type="hidden" id="agent_edit" name="agent_edit" value="<?php nameUser($_SESSION['user_system']); ?>">
              <input type="hidden" id="date_edit" name="date_edit" value="<?php echo date('Y-m-d'); ?>">
              <input type="hidden" id="id_leaser_system" name="id_leaser_system">

              <div class="row">
                <div class="col-xs-12">
                  <div class="form-group">
                    <label>Ingresar nombre completo:</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-user"></i>
                      </div>
                      <input type="text" name="name_edit" id="name_edit" class="form-control" placeholder="Ej: Víctor Lidio Jara Martínez" autocomplete="none" required>
                    </div>
                    <!-- /.input group -->
                  </div>
                </div>

                <div class="col-xs-6">
                  <div class="form-group">
                    <label>Ingresar R.U.T.:</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-id-card"></i>
                      </div>
                      <input type="text" name="rut_edit" id="rut_edit" class="form-control rut" placeholder="Ej: 18.123.456-7" autocomplete="none" required>
                    </div>
                    <!-- /.input group -->
                  </div>
                </div>

                <div class="col-xs-6">
                  <div class="form-group">
                    <label>Correo Electrónico:</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-envelope"></i>
                      </div>
                      <input type="email" name="mail_edit" id="mail_edit" class="form-control" placeholder="Ej: mail@correodelcliente.cl" autocomplete="none" required>
                    </div>
                    <!-- /.input group -->
                  </div>
                </div>

                <div class="col-xs-6">
                  <div class="form-group">
                    <label>N° de Whatsapp:</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        +56
                      </div>
                      <input type="text" name="phone_one_edit" id="phone_one_edit" class="form-control" placeholder="Ej: 948992070" autocomplete="none" maxlength="9" required>
                    </div>
                    <!-- /.input group -->
                  </div>
                </div>

                <div class="col-xs-6">
                  <div class="form-group">
                    <label>N° de Contacto 2:</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        +56
                      </div>
                      <input type="text" name="phone_two_edit" id="phone_two_edit" class="form-control" placeholder="Ej: 948992070" autocomplete="none" maxlength="9" required>
                    </div>
                    <!-- /.input group -->
                  </div>
                </div>
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            <button id="btnEdit" type="submit" class="btn btn-success"></button>
          </div>
          </form>
        </div>
      </div>
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
    $(document).ready(function() {
      <?php if($_SESSION['type_user'] == 'observador') {?>
          $(".btn").attr('disabled', true);
      <?php }?>
      // definimos el texto del boton btnSave
      $('#btnSave').html('<i class="fa fa-check-circle"></i> Guardar');
      // definimos el texto del boton btnEdit
      $('#btnEdit').html('<i class="fa fa-check-circle"></i> Editar');
      cargarLeaser();
      addLeaser();
      editLeaser();
    });
    $('.rut').rut();

    // Cargamos la lista de propiedades en relación al propietario
    cargarLeaser = function() {
      // Obtenemos el valor por el id
      // id_property = document.getElementById("id_owner_property").value;

      $("#tableLeaser").dataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf','print'
        ],
        "destroy": true,
        "processing": true,
        "order": [], //[[ 0, "desc" ]],
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true,
        "ajax": {
          "url": "model/listLeaserModel.php",
          "method": "POST"
        },
        "aoColumns": [

          //1
          {
            "mData": function(data, type, dataToSet) {
              return '<b>Registrado por:</b><br>' + data.agent_designated + "<br>" + moment(data.date_register).format('D/M/Y');
            }
          },
          //2
          {
            "mData": function(data, type, dataToSet) {
              return data.name_leaser;
            }
          },
          //3
          {
            "mData": function(data, type, dataToSet) {
              return data.rut_leaser;
            }
          },
          //4
          {
            "mData": function(data, type, dataToSet) {
              return data.email_leaser;
            }
          },
          //5
          {
            "mData": function(data, type, dataToSet) {
              if (data.phone_two_leaser == '') {
                return '+56 ' + data.phone_one_leaser;
              } else {
                return '+56 ' + data.phone_one_leaser + '<br>+56 ' + data.phone_two_leaser;
              }
            }
          },
          //6
          // { "mData": function (data, type, dataToSet) {
          //  return "DNG-"+ data.bank;}
          // },
          {
            "mData": function(data, type, dataToSet) {
              // return "<div class='btn-group'><button button='button' onclick='mostrarProperty(" + data + ");' class='btn bg-olive' data-toggle='modal' data-target='#modalEditProperty'><i class='fa fa-edit'></i></button><a href='fichaProperty.php?property="+ data +"' class='btn btn-default'><i class='fa fa-eye'></i></a><button type='button' onclick='deleteProperty(" + data + ");' class='btn btn-danger'><i class='fa fa-trash'></i></button></div>"
              let disable = '';
              <?php if($_SESSION['type_user'] == 'observador') {?>
                disable = 'disabled';
              <?php }?>

              return "<!-- Single button --><div class='ocultar-elemento btn-group'><button type='button' disabled='"+disable+"' class='btn btn-primary dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>Mostrar <span class='caret'></span></button><ul class='dropdown-menu'><li><a href='' onclick='mostrarLeaser(" + data.id_leaser_system + ");' data-toggle='modal' data-target='#modalEditLeaser'><i class='fa fa-edit'></i>Editar</a></li><li><a herf='' onclick='deleteLeaser(" + data.id_leaser_system + ");'><i class='fa fa-trash'></i> Eliminar</a></li></ul></div>"
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

    var mostrarLeaser = function(id_leaser_system) {

      if (!/^([0-9])*$/.test(id_leaser_system)) {
        return false
      } else {
        $.ajax({
          url: "model/searchLeaser.php",
          method: "POST",
          dataType: "json",
          data: {
            id_leaser_system: id_leaser_system
          },
          success: function(datos) {
            $('#id_leaser_system').val(datos.id_leaser_system);

            $('#name_edit').val(datos.name_leaser);
            $('#rut_edit').val(datos.rut_leaser);
            $('#mail_edit').val(datos.email_leaser);
            $('#phone_one_edit').val(datos.phone_one_leaser);
            $('#phone_two_edit').val(datos.phone_two_leaser);
            //
          }
        });
      }
    }

    var deleteLeaser = function(id_leaser_system) {

      if (!/^([0-9])*$/.test(id_leaser_system)) {
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
                url: "model/deleteLeaser.php",
                method: "POST",
                data: {
                  id_leaser_system: id_leaser_system
                },
                success: function(data) {
                  if (data == 'ok') {
                    swal("Eliminado! El registro fue eliminado.", {
                      icon: "success",
                    });
                    cargarLeaser();
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

    var editLeaser = function(id_leaser_property) {
      $('#editLeaser').submit(function(e) {
        var datos = $(this).serialize();
        e.preventDefault();

        //console.log(datos);

        $.ajax({
          type: "POST",
          url: "model/editLeaserModel.php",
          data: datos,
          beforeSend: function(){
            $('#btnEdit').attr('disabled', true);
            $('#btnEdit').html('<i class="fas fa-spin fa-spinner"></i>');
          },
          success: function(data) {
            if (data == 'ok') {
              swal({
                title: "Actualizado!",
                text: "El registro fue actualizado satisfactoriamente.",
                icon: "success",
                button: "Ok",
              });
              cargarLeaser();
              $('#editLeaser')[0].reset();
              $('#modalEditLeaser').modal('hide');
              $('#btnEdit').removeAttr('disabled');
              $('#btnEdit').html('<i class="fa fa-check-circle"></i> Editar');
              // console.log('Exitazooooooo');
            } else if (data == 'error') {
              swal({
                title: "Algo salio mal!",
                text: "Intentalo nuevamente, no puedes incluir campos vacios, ni caracteres extraños.",
                icon: "error",
                button: "Cerrar",
              });
              $('#editLeaser')[0].reset();
              $('#modalEditLeaser').modal('hide');
              $('#btnEdit').removeAttr('disabled');
              $('#btnEdit').html('<i class="fa fa-check-circle"></i> Editar');
            } else {
              console.log(data);
            }
          }
        });
      });
    }

    //Script para añadir registro
    var addLeaser = function() {
      $('#addLeaser').submit(function(e) {
        e.preventDefault();
        var datos = $(this).serialize();
        //console.log(datos);
        $.ajax({
          type: "POST",
          url: "model/addLeaserModel.php",
          data: datos,
          beforeSend: function() {
            $('#btnSave').attr('disabled', true);
            $('#btnSave').html('<i class="fas fa-spin fa-spinner"></i>');
          },
          success: function(data) {
            if (data == 'ok') {
              swal({
                title: "Buen Trabajo!",
                text: "El registro fue ingresado satisfactoriamente.",
                icon: "success",
                button: "Ok",
              });

              cargarLeaser();
              $('#addLeaser')[0].reset();
              $('#modalAddLeaser').modal('hide');
              $('#btnSave').removeAttr('disabled');
              $('#btnSave').html('<i class="fa fa-check-circle"></i> Guardar');
              // console.log('Exitazooooooo');
            } else if (data == 'error') {
              swal({
                title: "Algo salio mal!",
                text: "Un campo esta vacío, recuerda registrar todos los datos.",
                icon: "error",
                button: "Cerrar",
              });
              $('#addLeaser')[0].reset();
              $('#modalAddLeaser').modal('hide');
              $('#btnSave').removeAttr('disabled');
              $('#btnSave').html('<i class="fa fa-check-circle"></i> Guardar');
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