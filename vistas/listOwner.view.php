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
          <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#modalAddOwner">
            <i class="fa fa-plus-circle"></i> Agregar Propietario
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
                <table id="tableOwner" class="table table-striped" style="font-size: 1.2rem">
                  <thead>
                    <tr>
                      <th>DATOS INTERNOS</th>
                      <th>NOMBRE PROPIETARIO</th>
                      <th>RUT PROPIETARIO</th>
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
    <div class="modal fade" id="modalAddOwner" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            <h4 class="modal-title text-center" id="myModalLabel">REGISTRO DE PROPIETARIO</h4>
          </div>
          <div class="modal-body" style="background-color: #efefef;">
            <form id="addOwner" method="POST">
              <input type="hidden" id="agent_designated" name="agent_designated" value="<?php nameUser($_SESSION['user_system']); ?>">
              <input type="hidden" id="date_register" name="date_register" value="2020-03-22">
              <div class="row">
                <div class="col-xs-12">
                  <!-- Custom Tabs -->
                  <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                      <li class="active"><a href="#info" data-toggle="tab" aria-expanded="true">INFORMACIÓN BÁSICA</a></li>
                      <li class=""><a href="#details" data-toggle="tab" aria-expanded="false">DETALLES BANCARIOS</a></li>
                    </ul>
                    <div class="tab-content">
                      <div class="tab-pane active" id="info">

                        <div class="row">
                          <div class="col-xs-6">
                            <div class="form-group">
                              <label>Ingresar nombre completo:</label>
                              <div class="input-group">
                                <div class="input-group-addon">
                                  <i class="fas fa-user" aria-hidden="true"></i>
                                </div>
                                <input type="text" name="name_owner" id="name_owner" class="form-control" placeholder="Ej: Víctor Lidio Jara Martínez" autocomplete="none" required="">
                              </div>
                              <!-- /.input group -->
                            </div>
                          </div>

                          <div class="col-xs-6">
                            <div class="form-group">
                              <label>Ingresar R.U.T.:</label>
                              <div class="input-group">
                                <div class="input-group-addon">
                                  <i class="fas fa-id-card" aria-hidden="true"></i>
                                </div>
                                <input type="text" name="rut_owner" id="rut_owner" class="form-control rut" placeholder="Ej: 18.123.456-7" autocomplete="none" required="">
                              </div>
                              <!-- /.input group -->
                            </div>
                          </div>

                          <div class="col-xs-6">
                            <div class="form-group">
                              <label>Correo Electrónico:</label>
                              <div class="input-group">
                                <div class="input-group-addon">
                                  <i class="fas fa-envelope" aria-hidden="true"></i>
                                </div>
                                <input type="email" name="mail_owner" id="mail_owner" class="form-control" placeholder="Ej: mail@correodelcliente.cl" autocomplete="none" required="">
                              </div>
                              <!-- /.input group -->
                            </div>
                          </div>

                          <div class="col-xs-6">
                            <div class="form-group">
                              <label>N° de Contacto:</label>
                              <div class="input-group">
                                <div class="input-group-addon">
                                  +56
                                </div>
                                <input type="text" name="phone_owner" id="phone_owner" class="form-control" placeholder="Ej: 948992070" autocomplete="none" maxlength="9" required="">
                              </div>
                              <!-- /.input group -->
                            </div>
                          </div>
                        </div>
                        <!-- Button -->
                        <div class="row">
                          <div class="col-xs-12">
                            <a class="btn btn-primary pull-right btnNext">
                              Siguiente <i class="fas fa-chevron-circle-right"></i>
                            </a>
                          </div>
                        </div>
                      </div>
                      <!-- /.tab-pane -->
                      <div class="tab-pane" id="details">

                        <div class="row">

                          <div class="col-xs-6">
                            <div class="form-group">
                              <label>Titular:</label>
                              <div class="input-group">
                                <div class="input-group-addon">
                                  <i class="fas fa-user" aria-hidden="true"></i>
                                </div>
                                <input type="text" name="titular_account" id="titular_account" class="form-control" placeholder="Ej: Víctor Lidio Jara Martínez" autocomplete="none" required="">
                              </div>
                              <!-- /.input group -->
                            </div>
                          </div>

                          <div class="col-xs-6">
                            <div class="form-group">
                              <label>R.U.T.:</label>
                              <div class="input-group">
                                <div class="input-group-addon">
                                  <i class="fas fa-id-card" aria-hidden="true"></i>
                                </div>
                                <input type="text" name="rut_account" id="rut_account" class="form-control rut" placeholder="Ej: 18.123.456-7" autocomplete="none" required="">
                              </div>
                              <!-- /.input group -->
                            </div>
                          </div>

                          <div class="col-xs-6">
                            <div class="form-group">
                              <label>Selecciona el banco:</label>
                              <div class="input-group">
                                <div class="input-group-addon">
                                  <i class="fas fa-filter" aria-hidden="true"></i>
                                </div>
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
                              <!-- /.input group -->
                            </div>
                          </div>

                          <div class="col-xs-6">
                            <div class="form-group">
                              <label>Selecciona el tipo de cuenta:</label>
                              <div class="input-group">
                                <div class="input-group-addon">
                                  <i class="fas fa-filter" aria-hidden="true"></i>
                                </div>
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
                              <!-- /.input group -->
                            </div>
                          </div>

                          <div class="col-xs-6">
                            <div class="form-group">
                              <label>N° de cuenta:</label>
                              <div class="input-group">
                                <div class="input-group-addon">
                                  <i class="fas fa-asterisk" aria-hidden="true"></i>
                                </div>
                                <input type="text" name="number_account" id="number_account" class="form-control" placeholder="Ingrese el número de cuenta" autocomplete="none" required="">
                              </div>
                              <!-- /.input group -->
                            </div>
                          </div>

                          <div class="col-xs-6">
                            <div class="form-group">
                              <label>Email confirmación:</label>
                              <div class="input-group">
                                <div class="input-group-addon">
                                  <i class="fas fa-envelope" aria-hidden="true"></i>
                                </div>
                                <input type="email" name="email_account" id="email_account" class="form-control" placeholder="Ej: correo@correo.com" autocomplete="none" required="">
                              </div>
                              <!-- /.input group -->
                            </div>
                          </div>

                        </div>
                        <!-- button -->
                        <div class="row">
                          <div class="col-xs-12">
                            <div class="btn-group pull-right">

                              <a class="btn btn-primary btnPrevious">
                                <i class="fa fa-chevron-circle-left"></i> Anterior
                              </a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- /.tab-content -->
                  </div>
                  <!-- nav-tabs-custom -->
                </div>
              </div>
              <div class="modal-footer bg-white">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                <button id="btnSave" type="submit" class="btn btn-success"></button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- EDIT OWNER SYSTEM MODAL -->
    <div class="modal fade" id="modalEditOwner" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            <h4 class="modal-title text-center" id="myModalLabel">REGISTRO DE PROPIETARIO</h4>
          </div>
          <div class="modal-body" style="background-color: #efefef;">
            <form id="editOwner" method="POST">
              <input type="hidden" id="agent_edit" name="agent_edit" value="<?php nameUser($_SESSION['user_system']); ?>">
              <input type="hidden" id="date_edit" name="date_edit" value="2020-03-22">
              <input type="hidden" id="id_owner_system" name="id_owner_system">
              <div class="row">
                <div class="col-xs-12">
                  <!-- Custom Tabs -->
                  <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                      <li class="active"><a href="#info_edit" data-toggle="tab" aria-expanded="true">INFORMACIÓN BÁSICA</a></li>
                      <li class=""><a href="#details_edit" data-toggle="tab" aria-expanded="false">DETALLES BANCARIOS</a></li>
                    </ul>
                    <div class="tab-content">
                      <div class="tab-pane active" id="info_edit">

                        <div class="row">
                          <div class="col-xs-6">
                            <div class="form-group">
                              <label>Ingresar nombre completo:</label>
                              <div class="input-group">
                                <div class="input-group-addon">
                                  <i class="fas fa-user" aria-hidden="true"></i>
                                </div>
                                <input type="text" name="name_edit" id="name_edit" class="form-control" placeholder="Ej: Víctor Lidio Jara Martínez" autocomplete="none" required="">
                              </div>
                              <!-- /.input group -->
                            </div>
                          </div>

                          <div class="col-xs-6">
                            <div class="form-group">
                              <label>Ingresar R.U.T.:</label>
                              <div class="input-group">
                                <div class="input-group-addon">
                                  <i class="fas fa-id-card" aria-hidden="true"></i>
                                </div>
                                <input type="text" name="rut_edit" id="rut_edit" class="form-control rut" placeholder="Ej: 18.123.456-7" autocomplete="none" required="">
                              </div>
                              <!-- /.input group -->
                            </div>
                          </div>

                          <div class="col-xs-6">
                            <div class="form-group">
                              <label>Correo Electrónico:</label>
                              <div class="input-group">
                                <div class="input-group-addon">
                                  <i class="fas fa-envelope" aria-hidden="true"></i>
                                </div>
                                <input type="email" name="mail_edit" id="mail_edit" class="form-control" placeholder="Ej: mail@correodelcliente.cl" autocomplete="none" required="">
                              </div>
                              <!-- /.input group -->
                            </div>
                          </div>

                          <div class="col-xs-6">
                            <div class="form-group">
                              <label>N° de Contacto:</label>
                              <div class="input-group">
                                <div class="input-group-addon">
                                  +56
                                </div>
                                <input type="text" name="phone_edit" id="phone_edit" class="form-control" placeholder="Ej: 948992070" autocomplete="none" maxlength="9" required="">
                              </div>
                              <!-- /.input group -->
                            </div>
                          </div>
                        </div>
                        <!-- Button -->
                        <div class="row">
                          <div class="col-xs-12">
                            <a class="btn btn-primary pull-right btnNext">
                              Siguiente <i class="fas fa-chevron-circle-right"></i>
                            </a>
                          </div>
                        </div>
                      </div>
                      <!-- /.tab-pane -->
                      <div class="tab-pane" id="details_edit">

                        <div class="row">

                          <div class="col-xs-6">
                            <div class="form-group">
                              <label>Titular:</label>
                              <div class="input-group">
                                <div class="input-group-addon">
                                  <i class="fas fa-user" aria-hidden="true"></i>
                                </div>
                                <input type="text" name="titular_edit" id="titular_edit" class="form-control" placeholder="Ej: Víctor Lidio Jara Martínez" autocomplete="none" required="">
                              </div>
                              <!-- /.input group -->
                            </div>
                          </div>

                          <div class="col-xs-6">
                            <div class="form-group">
                              <label>R.U.T.:</label>
                              <div class="input-group">
                                <div class="input-group-addon">
                                  <i class="fas fa-id-card" aria-hidden="true"></i>
                                </div>
                                <input type="text" name="rut_account_edit" id="rut_account_edit" class="form-control rut" placeholder="Ej: 18.123.456-7" autocomplete="none" required="">
                              </div>
                              <!-- /.input group -->
                            </div>
                          </div>

                          <div class="col-xs-6">
                            <div class="form-group">
                              <label>Selecciona el banco:</label>
                              <div class="input-group">
                                <div class="input-group-addon">
                                  <i class="fas fa-filter" aria-hidden="true"></i>
                                </div>
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
                              <!-- /.input group -->
                            </div>
                          </div>

                          <div class="col-xs-6">
                            <div class="form-group">
                              <label>Selecciona el tipo de cuenta:</label>
                              <div class="input-group">
                                <div class="input-group-addon">
                                  <i class="fas fa-filter" aria-hidden="true"></i>
                                </div>
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
                              <!-- /.input group -->
                            </div>
                          </div>

                          <div class="col-xs-6">
                            <div class="form-group">
                              <label>N° de cuenta:</label>
                              <div class="input-group">
                                <div class="input-group-addon">
                                  <i class="fas fa-asterisk" aria-hidden="true"></i>
                                </div>
                                <input type="text" name="number_edit" id="number_edit" class="form-control" placeholder="Ingrese el número de cuenta" autocomplete="none" required="">
                              </div>
                              <!-- /.input group -->
                            </div>
                          </div>

                          <div class="col-xs-6">
                            <div class="form-group">
                              <label>Email confirmación:</label>
                              <div class="input-group">
                                <div class="input-group-addon">
                                  <i class="fas fa-envelope" aria-hidden="true"></i>
                                </div>
                                <input type="email" name="email_account_edit" id="email_account_edit" class="form-control" placeholder="Ej: correo@correo.com" autocomplete="none" required="">
                              </div>
                              <!-- /.input group -->
                            </div>
                          </div>

                        </div>
                        <!-- button -->
                        <div class="row">
                          <div class="col-xs-12">
                            <div class="btn-group pull-right">

                              <a class="btn btn-primary btnPrevious">
                                <i class="fa fa-chevron-circle-left"></i> Anterior
                              </a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- /.tab-content -->
                  </div>
                  <!-- nav-tabs-custom -->
                </div>
              </div>
              <div class="modal-footer bg-white">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                <button id="btnEdit" type="submit" class="btn btn-success"></button>
              </div>
            </form>
          </div>
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
      // definimos el texto del boton btnSave
      $('#btnSave').html('<i class="fa fa-check-circle"></i> Guardar');
      // definimos el texto del boton btnEdit
      $('#btnEdit').html('<i class="fa fa-check-circle"></i> Editar');

      cargarOwner();
      addOwner();
      editOwner();
    });
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

    // Cargamos la lista de propiedades en relación al propietario
    cargarOwner = function() {
      // Obtenemos el valor por el id
      // id_property = document.getElementById("id_owner_property").value;


      $("#tableOwner").dataTable({
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
          "url": "model/listOwnerModel.php",
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
              return data.name_owner;
            }
          },
          //3
          {
            "mData": function(data, type, dataToSet) {
              return data.rut_owner;
            }
          },
          //4
          {
            "mData": function(data, type, dataToSet) {
              return data.email_owner;
            }
          },
          //5
          {
            "mData": function(data, type, dataToSet) {
              return '+56 ' + data.phone_owner;
            }
          },
          //6
          // { "mData": function (data, type, dataToSet) {
          //  return "DNG-"+ data.bank;}
          // },
          {
            "mData": function(data, type, dataToSet) {
              // return "<div class='btn-group'><button button='button' onclick='mostrarProperty(" + data + ");' class='btn bg-olive' data-toggle='modal' data-target='#modalEditProperty'><i class='fa fa-edit'></i></button><a href='fichaProperty.php?property="+ data +"' class='btn btn-default'><i class='fa fa-eye'></i></a><button type='button' onclick='deleteProperty(" + data + ");' class='btn btn-danger'><i class='fa fa-trash'></i></button></div>"

              return "<!-- Single button --><div class='ocultar-elemento btn-group'><button type='button' class='btn btn-primary dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>Mostrar <span class='caret'></span></button><ul class='dropdown-menu'><li><a href='' onclick='mostrarOwner(" + data.id_owner_system + ");' data-toggle='modal' data-target='#modalEditOwner'><i class='fa fa-edit'></i>Editar</a></li><li><a herf='' onclick='deleteOwner(" + data.id_owner_system + ");'><i class='fa fa-trash'></i> Eliminar</a></li></ul></div>"
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

    var mostrarOwner = function(id_owner_system) {

      if (!/^([0-9])*$/.test(id_owner_system)) {
        return false
      } else {
        $.ajax({
          url: "model/searchOwner.php",
          method: "POST",
          dataType: "json",
          data: {
            id_owner_system: id_owner_system
          },
          success: function(datos) {
            $('#id_owner_system').val(datos.id_owner_system);
            $('#name_edit').val(datos.name_owner);
            $('#rut_edit').val(datos.rut_owner);
            $('#mail_edit').val(datos.email_owner);
            $('#phone_edit').val(datos.phone_owner);
            //
            $('#titular_edit').val(datos.titular_account);
            $('#rut_account_edit').val(datos.rut_account);
            $('#bank_edit').val(datos.bank_account);
            $('#type_edit').val(datos.type_account);
            $('#number_edit').val(datos.number_account);
            $('#email_account_edit').val(datos.email_account);

          }
        });
      }
    }

    var deleteOwner = function(id_owner_system) {

      if (!/^([0-9])*$/.test(id_owner_system)) {
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
                url: "model/deleteOwner.php",
                method: "POST",
                data: {
                  id_owner_system: id_owner_system
                },
                success: function(data) {
                  if (data == 'ok') {
                    swal("Eliminado! El registro fue eliminado.", {
                      icon: "success",
                    });
                    cargarOwner();
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

    var editOwner = function(id_owner_property) {
      $('#editOwner').submit(function(e) {
        var datos = $(this).serialize();
        e.preventDefault();

        $.ajax({
          type: "POST",
          url: "model/editOwnerModel.php",
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
              cargarOwner();
              $('#editOwner')[0].reset();
              $('#modalEditOwner').modal('hide');
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
              $('#editOwner')[0].reset();
              $('#modalEditOwner').modal('hide');
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
    var addOwner = function() {
      $('#addOwner').submit(function(e) {
        e.preventDefault();
        var datos = $(this).serialize();
        //console.log(datos);
        $.ajax({
          type: "POST",
          url: "model/addOwnerModel.php",
          data: datos,
          beforeSend: function(){
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
              cargarOwner();
              $('#addOwner')[0].reset();
              $('#modalAddOwner').modal('hide');
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
              $('#addOwner')[0].reset();
              $('#modalAddOwner').modal('hide');
              $('#btnSave').removeAttr('disabled');
              $('#btnSave').html('<i class="fa fa-check-circle"></i> Guardar');
            } else {
              console.log(data);
            }
          }
        });
      });
    }

    //Llamamos a la función para formatear RUT Chileno
    $(".rut").rut();

    $('.btnNext').click(function() {
      $('.nav-tabs > .active').next('li').find('a').trigger('click');
    });

    $('.btnPrevious').click(function() {
      $('.nav-tabs > .active').prev('li').find('a').trigger('click');
    });
  </script>

</body>

</html>