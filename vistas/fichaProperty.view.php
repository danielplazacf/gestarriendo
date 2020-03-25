<!DOCTYPE html>
<html lang="es">

<head>
  <?php include 'head.php'; ?>
  <!-- DataTables css -->
  <link rel="stylesheet" href="resources/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- Button Toggle -->
  <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

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
                <p class="widget-user-desc"><?php echo $row['address_property']; ?></p>
              </div>
              <div class="widget-user-image">
                <img class="img-circle" src="resources/dist/img/img_property.png" alt="User Avatar" width="215">
              </div>
              <div class="box-footer">
                <div class="row mb-4">
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <span class="description-text">TIPO:</span>
                      <h5 class="description-header text-uppercase"><?php echo $row['type_property']; ?></h5>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <span class="description-text">CANON:</span>
                      <?php
                      $concepto = 'Canon de arriendo';
                      $canon_stmt = $con->prepare("SELECT * FROM tbl_cobros_property WHERE concepto_csimple = '$concepto' AND id_property = '$id_property'");
                      $canon_stmt->execute();
                      $row = $canon_stmt->fetch(PDO::FETCH_ASSOC);
                      @$concepto_rw = $row['concepto_csimple'];
                      @$amount = $row['amount_csimple'];
                      $res_concepto = '';

                      if ($concepto_rw === 'Canon de arriendo') {
                        $res_concepto .= '<h5 class="description-header">$' . number_format($amount, 0, '', '.') . '</h5>';
                      } else {
                        $res_concepto .= '<h5 class="description-header">SIN DEFINIR</h5>';
                      }
                      echo $res_concepto;
                      ?>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4">
                    <div class="description-block">
                      <span class="description-text">UTILIDAD:</span>
                      <?php
                      $concepto = 'Comisión por Administración';
                      $comision_stmt = $con->prepare("SELECT * FROM tbl_cobros_property WHERE concepto_csimple = '$concepto' AND id_property = '$id_property'");
                      $comision_stmt->execute();
                      $row = $comision_stmt->fetch(PDO::FETCH_ASSOC);
                      @$concepto_row = $row['concepto_csimple'];
                      @$amount = $row['amount_csimple'];
                      $res_concepto = '';

                      if ($concepto_row === 'Comisión por Administración') {
                        $res_concepto .= '<h5 class="description-header">$' . number_format($amount, 0, '', '.') . '</h5>';
                      } else {
                        $res_concepto .= '<h5 class="description-header">SIN DEFINIR</h5>';
                      }
                      echo $res_concepto;
                      ?>
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
                    <a class="btn btn-app" data-toggle="modal" data-target="#modalAddMovimiento">
                      <i class="fa fa-refresh"></i> Movimiento
                    </a>
                    <?php
                    if ($pago === '1') {
                      $html .= '
                    <button type="button" class="btn btn-app" data-toggle="modal" data-target="#modalPagoCompleto">
                      <i class="fa fa-file-invoice-dollar"></i> Pagos
                    </button>
                    <button type="button" class="btn btn-app" data-toggle="modal" data-target="#modalCobroCompleto">
                      <i class="fa fa-file-invoice"></i> Cobros
                    </button>';
                    } else if ($pago === '0') {
                      $html .= '
                    <!--<button type="button" class="disabled btn btn-app" data-toggle="modal" data-target="#modalPagoSimple">
                      <i class="fa fa-file-invoice-dollar"></i> Pagos
                    </button>-->
                    <button type="button" class="btn btn-app" data-toggle="modal" data-target="#modalCobroSimple">
                      <i class="fa fa-file-invoice"></i> Cobros
                    </button>';
                    }
                    echo $html;
                    ?>
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
            <div class="small">
              <u>Terminologías:</u>
              <ul class="list-inline mt-3">
                <li><b>I:</b> Fecha inicio</li>
                <li><b>F:</b> Fecha termino</li>
                <li><b>P:</b> Propietario</li>
                <li><b>A:</b> Arrendatario</li>
              </ul>
            </div>
            <div class="nav-tabs-custom">
              <ul class="nav nav-tabs">
                <li class="active"><a href="#contratos" data-toggle="tab" aria-expanded="true">Contratos</a></li>
                <li class=""><a href="#movimientos" data-toggle="tab" aria-expanded="false">Movimientos</a></li>
                <?php if ($pago === '1') { ?>
                  <li class=""><a href="#pagos" data-toggle="tab" aria-expanded="false">Pagos</a></li>
                <?php } ?>
                <li class=""><a href="#cobros" data-toggle="tab" aria-expanded="false">Cobros</a></li>

                <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane active" id="contratos">
                  <div class="row">
                    <div class="col-xs-12">
                      <table id="tableOwner" class="table table-striped" style="font-size: 1.1rem">
                        <thead>
                          <tr>
                            <th>N° CONTRATO</th>
                            <th>INDIVIDUALIZACIÓN</th>
                            <th>GARANTIAS</th>
                            <th>TIPO CONTRATO</th>
                            <th>ESTADO</th>
                            <th width="150px">OPCIONES</th>
                          </tr>
                        </thead>
                      </table>
                    </div>
                  </div>
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
                <?php if ($pago === '1') { ?>
                  <div class="tab-pane" id="pagos">
                    <div class="row">
                      <div class="col-xs-12">
                        <table id="tablePagosP" class="table table-striped" style="font-size: 1.1rem; width:100%">
                          <thead>
                            <tr>
                              <th>DESDE</th>
                              <th>HACIA</th>
                              <th>CONCEPTO</th>
                              <th>COBRO RECURRENTE</th>
                              <th>MONTO</th>
                              <th width="150px">OPCIONES</th>
                            </tr>
                          </thead>
                        </table>
                      </div>
                    </div>
                  </div>
                <?php } ?>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="cobros">
                  <div class="row">
                    <div class="col-xs-12">
                      <table id="tableCobrosP" class="table table-striped" style="font-size: 1.1rem; width:100%">
                        <thead>
                          <tr>
                            <th>DESDE</th>
                            <th>HACIA</th>
                            <th>CONCEPTO</th>
                            <th>COBRO RECURRENTE</th>
                            <th>MONTO</th>
                            <th width="150px">OPCIONES</th>
                          </tr>
                        </thead>
                      </table>
                    </div>
                  </div>
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
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title text-center" id="myModalLabel">CREAR CONTRATO DE ADMINISTRACIÓN</h4>
          </div>
          <div class="modal-body" style="background: #f4f4f4">
            <form id="addContrato" method="POST">
              <input type="hidden" id="id_property" name="id_property" value="<?php echo $_GET['id_property']; ?>">
              <input type="hidden" id="status_contrato" name="status_contrato" value="1">
              <input type="hidden" id="agent_designated" name="agent_designated" value="<?php nameUser($_SESSION['user_system']); ?>">
              <input type="hidden" id="date_register" name="date_register" value="<?php echo date('Y-m-d'); ?>">
              <div class="row">
                <div class="col-xs-12">
                  <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs nave-tabs">
                      <li class="active"><a href="#step_1" data-toggle="tab" aria-expanded="true">Individualización</a></li>
                      <li class=""><a href="#step_2" data-toggle="tab" aria-expanded="false">Garantias</a></li>

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
                                <select style="text-transform: capitalize;" name="name_owner" id="name_owner" class="form-control select2" required>
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
                                <select style="text-transform: capitalize;" name="name_leaser" id="name_leaser" class="form-control select2" required>
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
                                <input name="fecha_inicio" id="fecha_inicio" type="date" class="form-control" required>
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
                                <input name="fecha_termino" id="fecha_termino" type="date" class="form-control" required>
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
                                <input name="garantia_contrato" id="garantia_contrato" type="text" class="form-control" placeholder="Ej: 200000" autocomplete="none" required>
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
                                <select name="receptor_garantia" id="receptor_garantia" class="form-control select2" required>
                                  <option></option>
                                  <option value="Propietario">Propietario</option>
                                  <option value="GestArriendo">GestArriendo</option>
                                </select>
                              </div>
                              <!-- /.input group -->
                            </div>
                          </div>

                          <div class="col-xs-6">
                            <div class="form-group">
                              <label>Seleccione el tipo de contrato:</label>
                              <div class="input-group">
                                <div class="input-group-addon">
                                  <i class="fas fa-filter"></i>
                                </div>
                                <select name="tipo_contrato" id="tipo_contrato" class="form-control select2 tipo_contrato" required>
                                  <option></option>
                                  <option value="0">Administración Simple</option>
                                  <option value="1">Administración Completa</option>
                                </select>
                              </div>
                              <!-- /.input group -->
                            </div>
                          </div>

                          <div class="col-xs-12">
                            <p id="desc_contrato" class="alert alert-warning">
                              Acá se indican los <u>flujos de pago</u>, de acuerdo al tipo de contrato.
                            </p>
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
            <button id="btnSubmit" type="submit" class="btn btn-success"><i class="fa fa-check-circle"></i> Guardar</button>
          </div>
          </form>
        </div>
      </div>
    </div>

    <!-- EDIT CONTRATO ADMINISTRACIÓN -->
    <div class="modal fade" id="modalEditContrato" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title text-center" id="myModalLabel">EDITAR CONTRATO DE ADMINISTRACIÓN</h4>
          </div>
          <div class="modal-body" style="background: #f4f4f4">
            <form id="editContrato" method="POST">
              <input type="hidden" id="id_contrato" name="id_contrato">
              <input type="hidden" id="id_property_edit" name="id_property_edit" value="<?php echo $_GET['id_property']; ?>">
              <input type="hidden" id="agent_edit" name="agent_edit" value="<?php nameUser($_SESSION['user_system']); ?>">
              <input type="hidden" id="date_edit" name="date_edit" value="<?php echo date('Y-m-d'); ?>">
              <div class="row">
                <div class="col-xs-12">
                  <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs nave-tabs">
                      <li class="active"><a href="#step_1_edit" data-toggle="tab" aria-expanded="true">Individualización</a></li>
                      <li class=""><a href="#step_2_edit" data-toggle="tab" aria-expanded="false">Garantias</a></li>

                    </ul>
                    <div class="tab-content">
                      <div class="tab-pane active" id="step_1_edit">
                        <div class="row">
                          <div class="col-xs-6">
                            <div class="form-group">
                              <label>Selecciona al propietario:</label>
                              <div class="input-group">
                                <div class="input-group-addon">
                                  <i class="fas fa-user"></i>
                                </div>
                                <select style="text-transform: capitalize;" name="name_edit" id="name_edit" class="form-control">
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
                                <select style="text-transform: capitalize;" name="leaser_edit" id="leaser_edit" class="form-control">
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
                                <input name="inicio_edit" id="inicio_edit" type="date" class="form-control">
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
                                <input name="termino_edit" id="termino_edit" type="date" class="form-control">
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
                      <div class="tab-pane" id="step_2_edit">
                        <div class="row">
                          <div class="col-xs-6">
                            <div class="form-group">
                              <label>Garantía:</label>
                              <div class="input-group">
                                <div class="input-group-addon">
                                  <i class="fas fa-usd"></i>
                                </div>
                                <input name="garantia_edit" id="garantia_edit" type="text" class="form-control" placeholder="Ej: 200000" autocomplete="none" required>
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
                                <select name="receptor_edit" id="receptor_edit" class="form-control" required>
                                  <option value="Propietario">Propietario</option>
                                  <option value="GestArriendo">GestArriendo</option>
                                </select>
                              </div>
                              <!-- /.input group -->
                            </div>
                          </div>

                          <div class="col-xs-6">
                            <div class="form-group">
                              <label>Seleccione el tipo de contrato:</label>
                              <div class="input-group">
                                <div class="input-group-addon">
                                  <i class="fas fa-filter"></i>
                                </div>
                                <select name="tipo_edit" id="tipo_edit" class="form-control tipo_contrato" required>
                                  <option value="0">Administración Simple</option>
                                  <option value="1">Administración Completa</option>
                                </select>
                              </div>
                              <!-- /.input group -->
                            </div>
                          </div>

                          <div class="col-xs-6">
                            <div class="form-group">
                              <label>Estado:</label>
                              <input name="status_edit" id="status_edit" type="checkbox" class="form-control" checked data-toggle="toggle">
                            </div>
                            <input type="hidden" name="hidden_status" id="hidden_status" value="0">
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

    <!-- PAGO ADMINISTRACIÓN SIMPLE -->
    <div class="modal fade" id="modalPagoSimple" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span></button>
            <h4 class="modal-title">Generar Cobro a Arrendatario - Administración Simple</h4>
          </div>
          <div class="modal-body">

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
    </div>

    <!-- COBRO ADMINISTRACIÓN SIMPLE -->
    <div class="modal fade" id="modalCobroSimple" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span></button>
            <h4 class="modal-title">Generar Cobro - Administración Simple</h4>
          </div>
          <div class="modal-body pb-0">
            <form id="addCobroSimple" method="POST">
              <?php
              $id_property = $_GET['id_property'];
              $contrato = "SELECT * FROM tbl_contrato_system WHERE id_property = '$id_property'";
              $q = $con->query($contrato);
              // While para repetir todos los campos dentro de la base de datos
              $contrato_rw = $q->fetch(PDO::FETCH_ASSOC);
              ?>
              <input type="hidden" id="cSimple" name="cSimple" value="cSimple">
              <input type="hidden" id="id_property_c" name="id_property_c" value="<?php echo $contrato_rw['id_property']; ?>">
              <input type="hidden" id="agent_designated" name="agent_designated" value="<?php nameUser($_SESSION['user_system']); ?>">
              <input type="hidden" id="date_register" name="date_register" value="<?php echo date('Y-m-d'); ?>">
              <div class="row">

                <div class="col-xs-6">
                  <div class="form-group">
                    <label>Pago desde:</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fas fa-user-friends"></i>
                      </div>
                      <select id="desde_cobro" name="desde_cobro" class="form-control select2" required>
                        <option></option>
                        <option value="Arrendatario">Arrendatario</option>
                        <option value="Propietario">Propietario</option>
                      </select>
                    </div>
                    <!-- /.input group -->
                  </div>
                </div>

                <div class="col-xs-6">
                  <div class="form-group">
                    <label>Hacia:</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fas fa-user"></i>
                      </div>
                      <select id="hacia_cobro" name="hacia_cobro" class="form-control select2" required>
                        <option></option>
                        <option value="Propietario">Propietario</option>
                        <option value="Gestarriendo">Gestarriendo</option>
                      </select>
                    </div>
                    <!-- /.input group -->
                  </div>
                </div>

                <div class="col-xs-6">
                  <div class="form-group">
                    <label>Concepto del cobro:</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fas fa-file"></i>
                      </div>
                      <select style="text-transform: capitalize;" name="concepto_csimple" id="concepto_csimple" class="form-control select2" required>
                        <option></option>
                        <?php
                        $selconcepto = 'SELECT * FROM tbl_concepto_cobro';
                        $q = $con->query($selconcepto);
                        // While para repetir todos los campos dentro de la base de datos
                        while ($concepto = $q->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                          <option value="<?php echo $concepto['concepto_cobro']; ?>"><?php echo $concepto['concepto_cobro']; ?></option>
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
                    <label>Cobro Recurrente:</label>
                    <input name="pay_recurrent" id="pay_recurrent" type="checkbox" class="form-control" checked data-toggle="toggle">
                  </div>
                  <input type="hidden" name="hidden_recurrent" id="hidden_recurrent" value="1">
                </div>

                <div class="col-xs-6">
                  <div class="form-group">
                    <label>Monto a cobrar:</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fas fa-usd"></i>
                      </div>
                      <input type="number" name="amount_csimple" id="amount_csimple" class="form-control" placeholder="Ej: 350000" required>
                    </div>
                    <!-- /.input group -->
                  </div>
                </div>

                <div class="col-xs-6">
                  <div class="form-group">
                    <label>Día vencimiento:</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fas fa-calendar"></i>
                      </div>
                      <input type="number" name="venc_csimple" id="venc_csimple" class="form-control" placeholder="Día vencimiento" required>
                      <div class="input-group-addon no-border">
                        del mes
                      </div>
                    </div>
                    <!-- /.input group -->
                  </div>
                </div>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                <button type="submit" id="btnLoad" class="btn btn-primary">Guardar</button>
              </div>
            </form>
          </div>

        </div>
        <!-- /.modal-content -->
      </div>
    </div>

    <!-- PAGO ADMINISTRACIÓN COMPLETA -->
    <div class="modal fade" id="modalPagoCompleto" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span></button>
            <h4 class="modal-title">Generar Cobro - Completa</h4>
          </div>
          <div class="modal-body">
            <p>One fine body…</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
    </div>

    <!-- COBRO ADMINISTRACIÓN COMPLETA -->
    <div class="modal fade" id="modalCobroCompleto" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span></button>
            <h4 class="modal-title">Generar Pago - Completa</h4>
          </div>
          <div class="modal-body">
            <p>One fine body…</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
    </div>

    <!-- MOVIMIENTOS INMUEBLE -->
    <div class="modal fade" id="modalAddMovimiento" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span></button>
            <h4 class="modal-title">Movimientos</h4>
          </div>
          <div class="modal-body">
            <form id="addLeaser" method="POST">
              <!-- <input type="hidden" id="agent_designated" name="agent_designated" value="<?php nameUser($_SESSION['user_system']); ?>"> -->
              <!-- <input type="hidden" id="date_register" name="date_register" value="<?php echo date('Y-m-d'); ?>"> -->

              <div class="row">
                <div class="col-xs-12">
                  <div class="form-group">
                    <label>Ingresar por:</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-user"></i>
                      </div>
                      <input type="text" name="agent_designated" id="agent_designated" class="form-control" value="<?php nameUser($_SESSION['user_system']); ?>" readonly>
                    </div>
                    <!-- /.input group -->
                  </div>
                </div>

                <div class="col-xs-6">
                  <div class="form-group">
                    <label>Fecha de Registro:</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="date" id="date_register" name="date_register" value="<?php echo date('Y-m-d'); ?>" class="form-control">
                    </div>
                    <!-- /.input group -->
                  </div>
                </div>

                <div class="col-xs-6">
                  <div class="form-group">
                    <label>Tipo movimiento:</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fas fa-refresh"></i>
                      </div>
                      <select id="tipo_movimiento" name="tipo_movimiento" class="form-control select2" required>
                        <option></option>
                        <option value="Informativo">Informativo</option>
                        <option value="Solicitud">Solicitud</option>
                        <option value="Reunión">Reunión</option>
                        <option value="Evento">Evento</option>
                        <option value="Otro">Otro</option>
                      </select>
                    </div>
                    <!-- /.input group -->
                  </div>
                </div>

                <div class="col-xs-12">
                  <div class="form-group">
                    <label>Describa el movimiento:</label>
                      <textarea name="txt_movimiento" id="txt_movimiento" class="form-control" placeholder="Describa aquí el movimiento que tuvo la propiedad..."></textarea>
                    <!-- /.input group -->
                  </div>
                </div>

              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            <button id="btnSave" type="submit" class="btn btn-success"><i class="fa fa-check-circle"></i> Guardar</button>
          </div>
          </form>
        </div>
      </div>
      <!-- /.modal-content -->
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

  <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

  <script>
    // button status contrato
    $('#status_edit').bootstrapToggle({
      on: 'Activado',
      off: 'Desactivado',
      width: '45%',
      onstyle: 'success input-group',
      offstyle: 'danger input-group'
    })

    // funcion que cambia el valor del checkbox
    $('#status_edit').change(function() {
      if ($(this).prop('checked')) {
        $('#hidden_status').val('1');
      } else {
        $('#hidden_status').val('0');
      }
    });

    // button pay_recurrent cobro
    $('#pay_recurrent').bootstrapToggle({
      on: 'Si',
      off: 'No',
      onstyle: 'success input-group',
      offstyle: 'danger input-group'
    })

    $('#pay_recurrent').change(function() {
      if ($(this).prop('checked')) {
        $('#hidden_recurrent').val('1');
      } else {
        $('#hidden_recurrent').val('0');
      }
    })

    // Reemplaza texto de parrafo luego de on.(change)
    $(function() {
      var texto = ['<strong>Contrato de Administración Simple</strong>____ El contrato de <u>administración simple</u> indica que los abonos del mismo, tienen el siguiente flujo: <ul><li>Arrendatario <i class="fas fa-angle-double-right"></i> Propietario // Propietario <i class="fas fa-angle-double-right"></i> GestArriendo</li></ul>', '<strong> Contrato de Administración Completa</strong>____ El contrato de <u>administración completa</u> indica que los abonos del mismo, tienen el siguiente flujo: <ul><li>Arrendatario <i class="fas fa-angle-double-right"></i> Gestarriendo // Gestarriendo <i class="fas fa-angle-double-right"></i> Propietario</li></ul>'];

      $('.tipo_contrato').on('change', function() {
        var index = $(this).val();
        $("#desc_contrato").html(texto[index]);
      })
    })

    $(document).ready(function() {
      cargarContratos();
      cargarCobrosP();
      addContrato();
      addCobroSimple();
      editContrato();
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
    cargarContratos = function() {
      // Obtenemos el valor por el id
      id_property = document.getElementById("id_property").value;


      $("#tableOwner").dataTable({
        "destroy": true,
        "order": [], //[[ 0, "desc" ]],
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": false,
        "info": true,
        "ajax": {
          "url": "model/listContratoModel.php?id_property=" + id_property,
          "method": "POST"
        },
        "aoColumns": [

          //1
          {
            "mData": function(data, type, dataToSet) {
              return '<b>I: </b>' + moment(data.fecha_inicio).format('D/M/Y') + '<br><b>T: </b>' + moment(data.fecha_termino).format('D/M/Y');
            }
          },
          //2
          {
            "mData": function(data, type, dataToSet) {
              return '<b>P: </b>' + data.name_owner + '<br><b>A: </b>' + data.name_leaser;
            }
          },
          //3
          {
            "mData": function(data, type, dataToSet) {
              return '$' + data.garantia_contrato;
            }
          },
          //4
          {
            "mData": function(data, type, dataToSet) {
              if (data.tipo_contrato === '0') {
                return '<b>Administración Simple</b>';
              } else {
                return '<b>Administración Completa</b>';
              }
            }
          },
          //5
          {
            "mData": function(data, type, dataToSet) {
              if (data.status_contrato === '1') {
                return '<span class="label label-success">Activo</span>';
              } else {
                return '<span class="label label-danger">Desactivado</span>';
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

              return "<!-- Single button --><div class='ocultar-elemento btn-group'><button type='button' class='btn btn-primary dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>Mostrar <span class='caret'></span></button><ul class='dropdown-menu'><li><a href='' onclick='mostrarContrato(" + data.id_contrato + ");' data-toggle='modal' data-target='#modalEditContrato'><i class='fa fa-edit'></i>Editar</a></li><li><a herf='' onclick='deleteContrato(" + data.id_contrato + ");'><i class='fa fa-trash'></i> Eliminar</a></li></ul></div>"
            }
          }

        ],
        "language": idioma_spanol
      });

    }

    // Cargamos la lista de propiedades en relación al propietario
    cargarCobrosP = function() {
      // Obtenemos el valor por el id
      id_property = document.getElementById("id_property").value;

      var table = $("#tableCobrosP").dataTable({
        "destroy": true,
        "order": [], //[[ 0, "desc" ]],
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": false,
        "info": true,
        "autoWidth": true,
        "ajax": {
          "url": "model/listCobrosPropertyModel.php?id_property=" + id_property,
          "method": "POST"
        },
        "aoColumns": [

          //1
          {
            "mData": function(data, type, dataToSet) {
              return data.desde_cobro;
            }
          },
          //2
          {
            "mData": function(data, type, dataToSet) {
              return data.hacia_cobro;
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
              if (data.hidden_recurrent === '1') {
                return '<label class="label label-success">Cobro recurrente</label>'
              } else if (data.hidden_recurrent === '0') {
                return '<label class="label label-danger">Cobro especifico</label>'
              }
            }
          },
          //5
          {
            "mData": function(data, type, dataToSet) {
              return '$' + data.amount_csimple;
            }
          },
          //6
          // { "mData": function (data, type, dataToSet) {
          //  return "DNG-"+ data.bank;}
          // },
          {
            "mData": function(data, type, dataToSet) {
              // return "<div class='btn-group'><button button='button' onclick='mostrarProperty(" + data + ");' class='btn bg-olive' data-toggle='modal' data-target='#modalEditProperty'><i class='fa fa-edit'></i></button><a href='fichaProperty.php?property="+ data +"' class='btn btn-default'><i class='fa fa-eye'></i></a><button type='button' onclick='deleteProperty(" + data + ");' class='btn btn-danger'><i class='fa fa-trash'></i></button></div>"

              return "<!-- Single button --><div class='ocultar-elemento btn-group'><button type='button' class='btn btn-primary dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>Mostrar <span class='caret'></span></button><ul class='dropdown-menu'><li><a href='' onclick='mostrarContrato(" + data.id_contrato + ");' data-toggle='modal' data-target='#modalEditContrato'><i class='fa fa-edit'></i>Editar</a></li><li><a herf='' onclick='deleteContrato(" + data.id_contrato + ");'><i class='fa fa-trash'></i> Eliminar</a></li></ul></div>"
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



    var mostrarContrato = function(id_contrato) {

      if (!/^([0-9])*$/.test(id_contrato)) {
        return false
      } else {
        $.ajax({
          url: "model/searchContrato.php",
          method: "POST",
          dataType: "json",
          data: {
            id_contrato: id_contrato
          },
          success: function(datos) {
            $('#id_contrato').val(datos.id_contrato);

            $('#hidden_status').val(datos.status_contrato);
            if (datos.status_contrato === '1') {
              $('#status_edit').bootstrapToggle('on');
            } else if (datos.status_contrato === '0') {
              $('#status_edit').bootstrapToggle('off');
            }

            $('#name_edit').val(datos.name_owner);
            $('#leaser_edit').val(datos.name_leaser);
            $('#inicio_edit').val(datos.fecha_inicio);
            $('#termino_edit').val(datos.fecha_termino);
            //
            $('#garantia_edit').val(datos.garantia_contrato);
            $('#receptor_edit').val(datos.receptor_garantia);
            $('#tipo_edit').val(datos.tipo_contrato);
            // $('#type_edit').val(datos.type_account);
            // $('#number_edit').val(datos.number_account);
            // $('#email_account_edit').val(datos.email_account);

          }
        });
      }
    }

    var deleteContrato = function(id_contrato) {

      if (!/^([0-9])*$/.test(id_contrato)) {
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
                url: "model/deleteContrato.php",
                method: "POST",
                data: {
                  id_contrato: id_contrato
                },
                success: function(data) {
                  if (data == 'ok') {
                    swal("Eliminado! El registro fue eliminado.", {
                      icon: "success",
                    });
                    cargarContratos();
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

    var editContrato = function(id_contrato) {
      $('#editContrato').submit(function(e) {
        var datos = $(this).serialize();
        e.preventDefault();
        // console.log(datos);

        $.ajax({
          type: "POST",
          url: "model/editContratoModel.php",
          data: datos,
          success: function(data) {
            if (data == 'ok') {
              swal({
                title: "Actualizado!",
                text: "El registro fue actualizado satisfactoriamente.",
                icon: "success",
                button: "Ok",
              });
              cargarContratos();
              $('#editContrato')[0].reset();
              $('#modalEditContrato').modal('hide');
              location.reload();
              //$('#modalAddCobro').modal('show');
              // console.log('Exitazooooooo');
            } else if (data == 'vacio') {
              swal({
                title: "Algo salio mal!",
                text: "Intentalo nuevamente, no puedes incluir campos vacios, ni caracteres extraños.",
                icon: "error",
                button: "Cerrar",
              });
              $('#editContrato')[0].reset();
              $('#modalEditContrato').modal('hide');
            } else {
              console.log(data);
            }
          }
        });
      });
    }

    //Script para añadir registro
    var addContrato = function() {
      $('#addContrato').submit(function(e) {
        e.preventDefault();
        var datos = $(this).serialize();
        //console.log(datos);
        $.ajax({
          type: "POST",
          url: "model/addContratoModel.php",
          data: datos,
          beforeSend: function(data) {
            $('#btnSubmit').prop('disabled', true);
          },
          success: function(data) {
            if (data == 'ok') {
              swal({
                title: "Buen Trabajo!",
                text: "El registro fue ingresado satisfactoriamente.",
                icon: "success",
                button: "Ok",
              });
              cargarContratos();
              $('#addContrato')[0].reset();
              $('#modalAddContrato').modal('hide');
              // console.log('Exitazooooooo');
            } else if (data == 'vacio') {
              swal({
                title: "Algo salio mal!",
                text: "Un campo esta vacío, recuerda registrar todos los datos.",
                icon: "error",
                button: "Cerrar",
              });
              $('#addContrato')[0].reset();
              $('#modalAddContrato').modal('hide');
            } else {
              console.log(data);
            }
          }
        });
      });
    }

    var addCobroSimple = function() {
      $('#addCobroSimple').submit(function(e) {
        e.preventDefault();
        var datos = $(this).serialize();
        //console.log(datos);

        $.ajax({
          type: "POST",
          url: "model/addCobroPropertyModel.php",
          data: datos,
          success: function(data) {
            if (data == 'ok') {
              swal({
                title: "Buen Trabajo!",
                text: "El registro fue ingresado satisfactoriamente.",
                icon: "success",
                button: "Ok",
              });

              cargarCobrosP();
              $('#addCobroSimple')[0].reset();
              $('#modalCobroSimple').modal('hide');
              // console.log('Exitazooooooo');
            } else if (data == 'vacio') {
              swal({
                title: "Algo salio mal!",
                text: "Un campo esta vacío, recuerda registrar todos los datos.",
                icon: "error",
                button: "Cerrar",
              });
              $('#addCobroSimple')[0].reset();
              $('#modalCobroSimple').modal('hide');
            } else {
              console.log(data);
            }
          }
        });
      });
    }

    // Botones tabs
    $('.btnNext').click(function() {
      $('.nave-tabs > .active').next('li').find('a').trigger('click');
    });

    $('.btnPrevious').click(function() {
      $('.nave-tabs > .active').prev('li').find('a').trigger('click');
    });
  </script>
</body>

</html>