<!DOCTYPE html>
<html lang="es">

<head>
  <?php include 'head.php'; ?>
  <!-- DataTables css -->
  <link rel="stylesheet" href="resources/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

  <style type="text/css">
    .swal-text {
      text-align: center !important;
    }
  </style>
</head>

<body class="hold-transition skin-black sidebar-mini <?php echo $sidebar; ?>">
  <div class="load-email" style="display: none;"></div>
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
          <!-- <button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#modalAddMove">
          <i class="fa fa-plus-circle"></i> Nuevo Movimiento
        </button> -->
          <a href="javascript:history.back(1)" class="btn btn-primary pull-right"><i class="fa fa-mail-reply"></i> Volver atrás</a>
        </h1>
      </section>
      <!-- Main content -->
      <section class="content container-fluid">
        <div class="row">
          <!-- /.col -->
          <div class="col-md-4">
            <!-- Widget: user widget style 1 -->
            <div class="box box-widget widget-user">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header bg-blue-active">
                <h3 class="widget-user-username">Ficha del Inmueble</h3>
                <p class="widget-user-desc"><?php echo $row['address_property'];?></p>
              </div>
              <div class="widget-user-image">
                <img class="img-circle" src="https://gestarriendo.clicfactor.com/resources/dist/img/descarga.png" alt="User Avatar" width="215">
              </div>
              <div class="box-footer">
                <div class="row mb-4">
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <span class="description-text">TIPO:</span>
                      <h5 class="description-header text-uppercase"><?php echo $row['type_property'];?></h5>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <span class="description-text">CANON:</span>
                      <h5 class="description-header">SIN DEFINIR</h5>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4">
                    <div class="description-block">
                      <span class="description-text">UTILIDAD:</span>
                      <h5 class="description-header">$0</h5>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                </div>

                <div class="row">
                  <div class="col-sm-12">
                    <p><u>Módulos Especiales:</u></p>
                    <a class="btn btn-app" data-toggle="modal" data-target="#modalAddContrato">
                      <i class="fas fa-file-signature"></i> Contrato
                    </a>
                    <a class="btn btn-app" data-toggle="modal" data-target="#modalAddMove">
                      <i class="fa fa-refresh"></i> Movimiento
                    </a>
                    <a href="listPayNote.php?property=1" class="btn btn-app">
                      <i class="fa fa-file-invoice-dollar"></i> Pagos
                    </a>
                    <a href="listChargeNote.php?property=1" class="btn btn-app">
                      <i class="fa fa-file-invoice"></i> Cobros
                    </a>

                  </div>
                </div>
                <!-- /.row -->
              </div>
            </div>
            <!-- /.widget-user -->
          </div>
          <!-- /.col -->
          <div class="col-md-8">
            <!-- Custom Tabs -->
            <div class="nav-tabs-custom">
              <ul class="nav nav-tabs">
                <li class="active"><a href="#contratos" data-toggle="tab" aria-expanded="true">Contratos</a></li>
                <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">Movimientos</a></li>
                <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false"></a></li>

                <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane active" id="contratos">
                  <b>How to use:</b>

                  <p>Exactly like the original bootstrap tabs except you should use
                    the custom wrapper <code>.nav-tabs-custom</code> to achieve this style.</p>
                  A wonderful serenity has taken possession of my entire soul,
                  like these sweet mornings of spring which I enjoy with my whole heart.
                  I am alone, and feel the charm of existence in this spot,
                  which was created for the bliss of souls like mine. I am so happy,
                  my dear friend, so absorbed in the exquisite sense of mere tranquil existence,
                  that I neglect my talents. I should be incapable of drawing a single stroke
                  at the present moment; and yet I feel that I never was a greater artist than now.
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="movimientos">
                  The European languages are members of the same family. Their separate existence is a myth.
                  For science, music, sport, etc, Europe uses the same vocabulary. The languages only differ
                  in their grammar, their pronunciation and their most common words. Everyone realizes why a
                  new common language would be desirable: one could refuse to pay expensive translators. To
                  achieve this, it would be necessary to have uniform grammar, pronunciation and more common
                  words. If several languages coalesce, the grammar of the resulting language is more simple
                  and regular than that of the individual languages.
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="tab_3">
                  Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                  Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                  when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                  It has survived not only five centuries, but also the leap into electronic typesetting,
                  remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset
                  sheets containing Lorem Ipsum passages, and more recently with desktop publishing software
                  like Aldus PageMaker including versions of Lorem Ipsum.
                </div>
                <!-- /.tab-pane -->
              </div>
              <!-- /.tab-content -->
            </div>
            <!-- nav-tabs-custom -->
          </div>
          <!-- /.col -->
        </div>
      </section>
      <!-- /.content -->

    </div>
    <!-- /.content-wrapper -->

    <!-- ADD CONTRATO ADMINSTRACIÓN  -->
    <div class="modal fade" id="modalAddContrato" role="dialog">
      <div class="modal-dialog" role="document" style="width: 60%">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title text-center" id="myModalLabel">CREAR CONTRATO DE ADMINISTRACIÓN</h4>
          </div>
          <div class="modal-body" style="background: #f4f4f4">
            <form id="editProperty" method="POST">
              <input type="hidden" id="agent_designated" name="agent_designated" value="<?php nameUser($_SESSION['user_system']); ?>">
              <input type="hidden" id="date_register" name="date_register" value="<?php echo date('Y-m-d'); ?>">
              <input type="hidden" id="id_property" name="id_property" value="<?php echo $_GET['id_property']; ?>">
              <div class="row">
                <div class="col-xs-12">
                  <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                      <li class="active"><a href="#step_1" data-toggle="tab" aria-expanded="true">Individualización</a></li>
                      <li class=""><a href="#step_2" data-toggle="tab" aria-expanded="false">Garantias</a></li>
                      <li><a href="#step_3" data-toggle="tab">Administración</a></li>

                    </ul>
                    <div class="tab-content">
                      <div class="tab-pane active" id="step_1">
                        <div class="row">
                          <div class="col-xs-6">
                            <div class="form-group">
                              <label>Selecciona al propietario:</label>
                              <div class="input-group">
                                <div class="input-group-addon">
                                  <i class="fas fa-user"></i>
                                </div>
                                <select style="text-transform: capitalize;" name="name_owner" id="name_owner" class="form-control select2">
                                  <option></option>
                                  <?php
                                  $selowner = 'SELECT * FROM tbl_owner_system';
                                  $q = $con->query($selowner);
                                  // While para repetir todos los campos dentro de la base de datos
                                  while ($owner = $q->fetch(PDO::FETCH_ASSOC)) {
                                  ?>
                                    <option value="<?php echo $owner['name_owner']; ?>"><?php echo $owner['name_owner']; ?></option>
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
                              <label>Selecciona al arrendatario:</label>
                              <div class="input-group">
                                <div class="input-group-addon">
                                  <i class="fas fa-user-friends"></i>
                                </div>
                                <select style="text-transform: capitalize;" name="name_leaser" id="name_leaser" class="form-control select2">
                                  <option></option>
                                  <?php
                                  $selleaser = 'SELECT * FROM tbl_leaser_system';
                                  $q = $con->query($selleaser);
                                  // While para repetir todos los campos dentro de la base de datos
                                  while ($leaser = $q->fetch(PDO::FETCH_ASSOC)) {
                                  ?>
                                    <option value="<?php echo $leaser['name_leaser']; ?>"><?php echo $leaser['name_leaser']; ?></option>
                                  <?php
                                  }
                                  ?>
                                </select>
                              </div>
                              <!-- /.input group -->
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-xs-6">
                            <div class="form-group">
                              <label>Fecha inicio contrato:</label>
                              <div class="input-group">
                                <div class="input-group-addon">
                                  <i class="fas fa-calendar"></i>
                                </div>
                                <input name="fecha_inicio" id="fecha_inicio" type="date" class="form-control">
                              </div>
                              <!-- /.input group -->
                            </div>
                          </div>

                          <div class="col-xs-6">
                            <div class="form-group">
                              <label>Fecha término contrato:</label>
                              <div class="input-group">
                                <div class="input-group-addon">
                                  <i class="fas fa-calendar"></i>
                                </div>
                                <input name="fecha_termino" id="fecha_termino" type="date" class="form-control">
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
                      <div class="tab-pane" id="step_2">
                        <div class="row">
                          <div class="col-xs-6">
                            <div class="form-group">
                              <label>Garantía:</label>
                              <div class="input-group">
                                <div class="input-group-addon">
                                  <i class="fas fa-usd"></i>
                                </div>
                                <input name="garantia_contrato" id="garantia_contrato" type="text" class="form-control" placeholder="Ej: 200000" autocomplete="none">
                              </div>
                              <!-- /.input group -->
                            </div>
                          </div>

                          <div class="col-xs-6">
                            <div class="form-group">
                              <label>Receptor garantía:</label>
                              <div class="input-group">
                                <div class="input-group-addon">
                                  <i class="fas fa-filter"></i>
                                </div>
                                <select name="receptor_garantia" id="receptor_garantia" class="form-control select2">
                                  <option></option>
                                  <option value="Propietario">Propietario</option>
                                  <option value="GestArriendo">GestArriendo</option>
                                </select>
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
                      <div class="tab-pane" id="step_3">
                        <div class="row">
                          <div class="col-xs-6">
                            <div class="form-group">
                              <label>Seleccione tipo de contrato:</label>
                              <div class="input-group">
                                <div class="input-group-addon">
                                  <i class="fas fa-funnel-dollar"></i>
                                </div>
                                <select name="type_contrato" id="type_contrato" class="form-control select2">
                                  <option></option>
                                  <option value="1">Administración Simple</option>
                                  <option value="2">Administración Completa</option>
                                </select>
                              </div>
                              <!-- /.input group -->
                            </div>
                          </div>

                          <div class="col-xs-6">
                            <div class="form-group">
                              <label>Hacia la cuenta:</label>
                              <div class="input-group">
                                <div class="input-group-addon">
                                  <i class="fas fa-sign-in-alt"></i>
                                </div>
                                <select name="account_bank" id="account_bank" class="form-control select2">
                                  <option></option>
                                  <?php
                                  $selaccount = 'SELECT * FROM tbl_account_bank';
                                  $q = $con->query($selaccount);
                                  // While para repetir todos los campos dentro de la base de datos
                                  while ($account = $q->fetch(PDO::FETCH_ASSOC)) {
                                  ?>
                                    <option value="<?php echo $account['id_account_bank']; ?>"><?php echo $account['titular_account'] .' - '. $account['bank_account'] ;?></option>
                                  <?php
                                  }
                                  ?>
                                </select>
                              </div>
                              <!-- /.input group -->
                            </div>
                          </div>
                        </div>

                        <!-- Informacion -->
                        <div class="row">
                          <div class="col-xs-12">
                            <div class="alert alert-warning" role="alert">
                              <p id="desc_contrato">
                                <strong>Información</strong>___ Aquí se indicara las caracteristicas de cada contrato.
                              </p>
                            </div>
                          </div>
                        </div>

                        <div class="row mt-4">
                          <div class="col-xs-4">
                            <div class="form-group">
                              <label>Canon de arriendo:</label>
                              <div class="input-group">
                                <div class="input-group-addon">
                                  <i class="fas fa-usd"></i>
                                </div>
                                <input name="canon_contrato" id="canon_contrato" type="number" class="form-control" placeholder="Ej: 400000">
                              </div>
                              <!-- /.input group -->
                            </div>
                          </div>

                          <div class="col-xs-4">
                            <div class="form-group">
                              <label>Comisión por administración:</label>
                              <div class="input-group">
                                <div class="input-group-addon">
                                  <i class="fas fa-usd"></i>
                                </div>
                                <input name="comision_contrato" id="comision_contrato" type="number" class="form-control" placeholder="Ej: 100000">
                              </div>
                              <!-- /.input group -->
                            </div>
                          </div>

                          <div class="col-xs-4">
                            <div class="form-group">
                              <label>Día de vencimiento:</label>
                              <div class="input-group">
                                <div class="input-group-addon">
                                  <i class="fas fa-calendar"></i>
                                </div>
                                <input name="ciclo_pago" id="ciclo_pago" class="form-control">
                              </div>
                              <!-- /.input group -->
                            </div>
                          </div>
                        </div>

                        <!-- button -->
                        <div class="row mt-4">
                          <div class="col-xs-12">
                            <div class="btn-group pull-right">

                              <a class="btn btn-primary btnPrevious">
                                <i class="fa fa-chevron-circle-left"></i> Anterior
                              </a>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                  </div>
                </div>
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            <button id="btnEdit" type="submit" class="btn btn-success"><i class="fa fa-check-circle"></i> Guardar</button>
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
  <!-- DataTables -->
  <script src="resources/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="resources/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
  <!-- AdminLTE App -->
  <script src="resources/dist/js/adminlte.min.js"></script>
  <!-- Sweet Alert -->
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <!-- Moment.js -->
  <script type="text/javascript" src="resources/dist/js/moment.min.js"></script>
  <!-- Ventana Centrada JS -->
  <script type="text/javascript" src="resources/dist/js/VentanaCentrada.js"></script>

  <script>
    $(function() {
      var texto = ["", '<strong> Contrato de Administración Simple</strong>____ El contrato de <u>administración simple</u> indica que los abonos del mismo, tienen el siguiente flujo: <ul><li>Arrendatario <i class="fas fa-angle-double-right"></i> Propietario // Propietario <i class="fas fa-angle-double-right"></i> GestArriendo</li></ul>','<strong> Contrato de Administración Completa</strong>____ El contrato de <u>administración completa</u> indica que los abonos del mismo, tienen el siguiente flujo: <ul><li>Arrendatario <i class="fas fa-angle-double-right"></i> Gestarriendo // Gestarriendo <i class="fas fa-angle-double-right"></i> Propietario</li></ul>'];

      $('#type_contrato').on('change', function() {
        var index = $(this).val();
        $("#desc_contrato").html(texto[index]);
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

    $('.btnNext').click(function() {
      $('.nav-tabs > .active').next('li').find('a').trigger('click');
    });

    $('.btnPrevious').click(function() {
      $('.nav-tabs > .active').prev('li').find('a').trigger('click');
    });
  </script>
</body>

</html>