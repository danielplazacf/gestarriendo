<!DOCTYPE html>
<html lang="es">

<head>
  <?php include 'head.php'; ?>
  <!-- DataTables css -->
  <link rel="stylesheet" href="resources/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- Timeline css -->
  <link rel="stylesheet" href="resources/bower_components/timeline/dist/css/timeline.min.css">
  <!-- Button Toggle -->
  <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

  <style type="text/css">
    .swal-text {
      text-align: center !important;
    }

    .text-muted {
      color: #797979;
      font-weight: 400;
    }

    .box-totales-pr {
      border-bottom: 1px solid #ccc;
      height: 55px;
      margin-bottom: 0;
      margin-top: 1em
    }

    .dl-horizontal dt {
      float: left;
      width: 170px;
      clear: left;
      text-align: right;
      overflow: hidden;
      text-overflow: ellipsis;
      white-space: nowrap;
    }

    #visualizador_pdf{
      display: none;
      height: 700px !important;
    }

    #frame_visualizador{
      height: 600px !important;
    }


    <?php if($_SESSION['type_user'] == 'observador') {?>
      div.ocultar-elemento{
        display:none !important;
      }
    <?php } ?>
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
          <?php echo $titulo;
          $key = $_GET['id_property']; 
          registerPago($key);
          registerCobro($key);
          ?>

          <?php
              $stmt = $con->prepare("SELECT id_contrato, fecha_inicio, name_leaser FROM tbl_contrato_system WHERE id_property = ".$key." ORDER BY id_contrato DESC LIMIT 1");
              $stmt->execute();
              $rs = $stmt->fetch();
          ?>

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
                      $canon_stmt = $con->prepare("SELECT * FROM tbl_cobros_property WHERE concepto_csimple = '$concepto' AND id_property = '$id_property' LIMIT 1");
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
                <div class="row mb-4">
                  <?php
                    $dproperty_stmt = $con->prepare("SELECT * FROM tbl_property_system WHERE id_property='$id_property'");
                    $dproperty_stmt->execute();
                    $rowdp = $dproperty_stmt->fetch(PDO::FETCH_ASSOC);
                  ?>
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <span class="description-text">Agua:</span>
                      <br />
                      <span class="description-text">"<?php echo $rowdp['proveedor_agua']; ?>"</span>
                      <h5 class="description-header text-uppercase"><?php echo $rowdp['n_client_agua']; ?></h5>
                    </div>
                  </div>
                  <div class="col-sm-4 border-right">
                  <div class="description-block">
                      <span class="description-text">Luz:</span>
                      <br />
                      <span class="description-text">"<?php echo $rowdp['proveedor_luz']; ?>"</span>
                      <h5 class="description-header text-uppercase"><?php echo $rowdp['n_client_luz']; ?></h5>
                    </div>
                  </div>
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <span class="description-text">Gas:</span>
                      <br />
                      <span class="description-text">"<?php echo $rowdp['proveedor_gas']; ?>"</span>
                      <h5 class="description-header text-uppercase"><?php echo $rowdp['n_client_gas']; ?></h5>
                    </div>
                  </div>
                </div>
                <!-- /.row -->
                <div class="row mb-4">

                  <div class="col-sm-6 border-right">
                    <div class="description-block">
                      <span class="description-text">Estacionamiento</span>
                      <br />
                      <span class="description-text"><?php if($rowdp['hasParking'] == 'Y'){ $display=''; echo "Si"; }else{ $display='style="display:none";'; echo "No"; } ?></span>
                      <h5 <?php echo $display; ?> class="description-header text-uppercase"><b>Nro:</b> <?php echo $rowdp['numberParking']; ?></h5>
                    </div>
                  </div>

                  <div class="col-sm-6 border-right">
                    <div class="description-block">
                      <span class="description-text">Bodega</span>
                      <br />
                      <span class="description-text"><?php if($rowdp['hasWarehouse'] == 'Y'){ $display=''; echo "Si"; }else{ $display='style="display:none";'; echo "No"; } ?></span>
                      <h5 <?php echo $display; ?> class="description-header text-uppercase"><b>Nro:</b> <?php echo $rowdp['numberWarehouse']; ?></h5>
                    </div>
                  </div>


                </div>
              </div>
            </div>
            <!-- /.widget-user -->

            <div class="box">
              <div class="box-body">
                <div class="row">
                  <div class="col-sm-12">

                    <a class="btn btn-app" data-toggle="modal" data-target="#modalAddMoveProperty">
                      <i class="fa fa-refresh"></i> Bitácora
                    </a>
                    <a class="btn btn-app" data-toggle="modal" data-target="#modalDatosPropietario">
                      <i class="fa fa-user"></i> Datos Propietario
                    </a>
                    <?php if(isset($rs['id_contrato']) and !empty($rs['id_contrato'])){ ?>
                     <a class="btn btn-app" data-toggle="modal" data-target="#modalDatosArrendatario">
                      <i class="fa fa-user"></i> Datos Arrendatario
                    </a>
                    <a class="btn btn-app" data-toggle="modal" data-target="#modalGestorArchivos">
                      <i class="fa fa-file"></i> Gestor de Archivos
                    </a>
                  <?php } ?>
                  </div>
                </div>
              </div>
            </div>

            <div class="box">
              <div class="box-body">
                <div class="row">
                  <div class="col-sm-12">
                    <a class="btn btn-app" data-toggle="modal" data-target="#modalAddContrato">
                      <i class="fas fa-file-signature"></i> Contrato
                    </a>
                    <?php
                    if ($pago === '1') {
                      $html .= '
                              <button type="button" class="btn btn-app" data-toggle="modal" data-target="#modalPagos">
                                <i class="fa fa-file-invoice-dollar"></i>Pago Recurrente
                              </button>
                              <button type="button" class="btn btn-app" data-toggle="modal" data-target="#modalCobroSimple">
                                <i class="fa fa-file-invoice"></i>Cobro Recurrente
                              </button>';
                    } else if ($pago === '0') {
                      $html .= '
                              <button type="button" class="btn btn-app" data-toggle="modal" data-target="#modalCobroSimple">
                                <i class="fa fa-file-invoice"></i> Acción de Cobro Recurrente
                              </button>';
                    }
                    echo $html;
                    
                    ?>
                    <a class="btn btn-app" id="ipcButton" data-toggle="modal" data-target="#modalDatosIpc">
                      <i class="fa fa-file"></i> IPC
                    </a> 

                    <a class="btn btn-app" id="gastosButton" data-toggle="modal" data-target="#modalDatosGatos">
                      <i class="fa fa-file"></i> Registrar Gasto
                    </a>  
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-md-8" id="visualizador_pdf">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3>Visualizador de Documentos</h3>
              </div>
              <div class="panel-body">
                <a class="btn btn-success volver-ficha" href="#">Volver a Ficha</a>
                <br />
                <br />
                <iframe id="frame_visualizador" scrolling="no" width="100%" frameborder="no"></iframe>
              </div>
            </div>
          </div>

          <div class="col-md-8" id="contenedor_inicial">
            <div class="alert" id="alertIPC" style="display: none;"></div>
            <!-- Custom Tabs -->
            <?php //echo $key; ?>
            <div class="row">
              <?php
              //echo $key;
              // $selContrato = $con->prepare("
              //   SELECT Tcob.id_property, Tcob.amount_csimple, Tcob.venc_csimple, Tpag.id_property, Tpag.amount_psimple, Tpag.venc_psimple
              //   FROM tbl_contrato_system Tc
              //   INNER JOIN tbl_cobros_property Tcob
              //   INNER JOIN tbl_pagos_property Tpag
              //   ON Tpag.id_property = Tcob.id_property
              //   ");
              // $selContrato->execute();
              // $rowContrato = $selContrato->fetch(PDO::FETCH_ASSOC);
              
              ?>
              <?php if ($pago == '1') : // La variable pago 1 es igual a tipo contrato completo
              ?>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <div class="info-box">
                    <span class="info-box-icon bg-yellow">1</span>

                    <div class="info-box-content">
                      <span class="info-box-number">$
                        <?php
                        $stmtIngresos = $con->prepare("SELECT *
                        FROM tbl_cobros_property
                        WHERE id_property = '$key'
                        ");
                        $stmtIngresos->execute();
                        $rowstmt = $stmtIngresos->fetch();
          
                        @$amountIngreso = $rowstmt['amount_csimple'];
                        @$vencIngreso = $rowstmt['venc_csimple'];
                        if(empty($amountIngreso) && empty($vencIngreso)){
                          echo '0';
                          $vencIngreso = '0';
                        }else{
                          echo number_format($amountIngreso, 0, '', '.');
                        }
                        ?>
                        </span>

                      <span class="info-box-number text-pay-owner">PAGO DE ARRENDATARIO</span>
                      <span class="info-box-text info-box-finanza">
                        <i class="fas fa-calendar-alt"></i> Venc. <?php echo @$vencIngreso; ?> de cada mes
                      </span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <div class="info-box">
                    <span class="info-box-icon bg-red">2</span>

                    <div class="info-box-content">
                      <span class="info-box-number">$<?php
                        $stmtEgresos = $con->prepare("SELECT *
                        FROM tbl_pagos_property
                        WHERE id_property = '$key'
                        ");
                        $stmtEgresos->execute();
                        $rowstmt = $stmtEgresos->fetch();
          
                        @$amountEgresos = $rowstmt['amount_psimple'];
                        @$vencEgreso = $rowstmt['venc_psimple'];
                        if(empty($amountEgresos) && empty($vencEgreso)){
                          echo '0';
                          $vencEgreso = '0';
                        }else{
                          echo number_format($amountEgresos, 0, '', '.');
                        }
                        ?>
                        </span>

                      <span class="info-box-number text-pay-owner">PAGO A PROPIETARIO</span>
                      <span class="info-box-text info-box-finanza">
                        <i class="fas fa-calendar-alt"></i> Venc. <?php echo @$vencEgreso; ?> de cada mes
                      </span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <div class="info-box">
                    <span class="info-box-icon bg-olive"><i class="fas fa-money"></i></span>

                    <div class="info-box-content">
                      <span class="info-box-text info-box-finanza">
                        CONTRATO DE ADMINISTRACIÓN COMPLETA
                      </span>
                      <?php
                      @$monto1 = $amountIngreso;
                      @$monto2 = $amountEgresos;
                      $montofinal = $monto1 - $monto2;

                      ?>
                      <span class="info-box-number">$<?php echo number_format($montofinal, 0, '', '.'); ?></span>
                      <span class="info-box-number text-pay-owner">UTILIDAD MENSUAL</span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <div class="box box-solid">
                    <?php
                    $montoIngreso = 0;
                    $montoEgreso = 0;
                    $selMontoIngresos = $con->prepare("
                  SELECT SUM(amount_csimple) AS totalIngreso 
                  FROM tbl_cobros_property 
                  WHERE id_property = '$key' AND hidden_recurrent = 0 AND estatus = 'pagado'");
                    $selMontoIngresos->execute();
                    $rowMontoI = $selMontoIngresos->fetch();

                    $selMontoEgresos = $con->prepare("
                  SELECT SUM(amount_psimple) AS totalEgreso
                  FROM tbl_pagos_property 
                  WHERE id_property = '$key' AND hidden_recurrent = 0 AND estatus = 'pagado'");
                    $selMontoEgresos->execute();
                    $rowMontoE = $selMontoEgresos->fetch();

                    //UTILIDAD INGRESO - EGRESO
                    $montoIngreso = $rowMontoI['totalIngreso'];
                    $montoEgreso = $rowMontoE['totalEgreso'];
                    $utilidad = $montoIngreso - $montoEgreso;

                    ?>

                    <!-- /.box-header -->
                    <div class="box-body" style="padding:0;border-radius:5px;">
                      <dl class="dl-horizontal" style="margin-bottom: 0; border-bottom: 1px solid #ccc;height:55px; padding:10px">
                        <dt class="text-left">Ingresos Totales<br><small class="text-muted">Desde la adquisición</small></dt>
                        <dd class="text-right text-success" style="font-size: 2rem; font-weight:600;">$<?php echo number_format($rowMontoI['totalIngreso'], 0, '', '.'); ?></dd>
                      </dl>
                      <dl class="dl-horizontal" style="margin-bottom: 0; border-bottom: 1px solid #ccc;height:55px; padding:10px">
                        <dt class="text-left">Egresos Totales<br><small class="text-muted">Desde la adquisición</small></dt>
                        <dd class="text-right text-red" style="font-size: 2rem; font-weight:600;">$<?php echo number_format($rowMontoE['totalEgreso'], 0, '', '.'); ?></dd>
                      </dl>
                      <dl class="dl-horizontal" style="margin-bottom: 0;height:55px; padding:10px">
                        <dt class="text-left">Total Utilidades<br><small class="text-muted">Desde la adquisición a la fecha</small></dt>
                        <dd class="text-right text-warning" style="font-size: 2rem; font-weight:600;">$<?php echo number_format($utilidad, 0, '', '.'); ?></dd>
                      </dl>
                    </div>
                    <!-- /.box-body -->
                  </div>
                </div>
              <?php endif; ?>
              <?php
              $selCobro = $con->prepare("
              SELECT *
              FROM tbl_cobros_property
              WHERE id_property = '$key'
              AND desde_cobro = 'Arrendatario'
              ");
              $selCobro->execute();
              $rowCobro = $selCobro->fetch(PDO::FETCH_ASSOC);
              ?>
              <?php if ($pago == '0') : //si su valor es 0 es tipo contrato simple 
              ?>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <div class="info-box">
                    <span class="info-box-icon bg-yellow">1</span>

                    <div class="info-box-content">
                      <span class="info-box-number">$<?php echo @number_format($rowCobro['amount_csimple'], 0, '', '.'); ?></span>

                      <span class="info-box-number text-pay-owner">ARRENDATARIO A PROPIETARIO</span>
                      <span class="info-box-text info-box-finanza">
                        <i class="fas fa-calendar-alt"></i> Venc. <?php echo @$rowCobro['venc_csimple']; ?> de cada mes
                      </span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->
                </div>
                <?php
                $propietario = 'Propietario';
                $selPago = $con->prepare("SELECT * FROM tbl_cobros_property WHERE id_property = '$key' AND desde_cobro = '$propietario'");
                $selPago->execute();
                $rowPago = $selPago->fetch(PDO::FETCH_ASSOC);
                ?>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <div class="info-box">
                    <span class="info-box-icon bg-red">2</span>

                    <div class="info-box-content">

                      <span class="info-box-number">$<?php echo @number_format($rowPago['amount_csimple'], 0, '', '.'); ?></span>

                      <span class="info-box-number text-pay-owner">PROPIETARIO A GESTARRIENDO</span>
                      <span class="info-box-text info-box-finanza">
                        <i class="fas fa-calendar-alt"></i> Venc. <?php echo @$rowPago['venc_csimple']; ?> de cada mes
                      </span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->
                </div>

                <div class="col-md-6 col-sm-6 col-xs-12">
                  <div class="info-box">
                    <span class="info-box-icon bg-olive"><i class="fas fa-money"></i></span>

                    <div class="info-box-content">
                      <span class="info-box-text info-box-finanza">
                        CONTRATO DE ADMINISTRACIÓN SIMPLE
                      </span>
                      <span class="info-box-number">$<?php echo @number_format($rowPago['amount_csimple'], 0, '', '.'); ?></span>
                      <span class="info-box-number text-pay-owner">UTILIDAD MENSUAL</span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->
                </div>

                <div class="col-md-6 col-sm-6 col-xs-12">
                  <div class="box box-solid">
                    <?php
                    $selMontoIngresos = $con->prepare("
                    SELECT SUM(amount_csimple) AS totalIngreso 
                    FROM tbl_cobros_property 
                    WHERE id_property = '$key'
                    AND desde_cobro = '$propietario' AND hidden_recurrent = 0 AND estatus = 'pagado'");
                    $selMontoIngresos->execute();
                    $rowMontoI = $selMontoIngresos->fetch();

                    //UTILIDAD INGRESO - EGRESO
                    $montoIngreso = $rowMontoI['totalIngreso'];
                    $utilidad = $montoIngreso;

                    ?>

                    <!-- /.box-header -->
                    <div class="box-body" style="padding:0;border-radius:5px;">
                      <dl class="dl-horizontal" style="margin-bottom: 0; border-bottom: 1px solid #ccc;height:55px; padding:10px">
                        <dt class="text-left">Ingresos Totales<br><small class="text-muted">Desde la adquisición</small></dt>
                        <dd class="text-right text-success" style="font-size: 2rem; font-weight:600;">$<?php echo number_format($rowMontoI['totalIngreso'], 0, '', '.'); ?></dd>
                      </dl>
                      <dl class="dl-horizontal" style="margin-bottom: 0;height:55px; padding:10px">
                        <dt class="text-left">Total Utilidades<br><small class="text-muted">Desde la adquisición a la fecha</small></dt>
                        <dd class="text-right text-warning" style="font-size: 2rem; font-weight:600;">$<?php echo number_format($utilidad, 0, '', '.'); ?></dd>
                      </dl>
                    </div>
                    <!-- /.box-body -->
                  </div>
                </div>
              <?php endif; ?>

            </div>

            <div class="row">
              <div class="col-lg-12">
                <div class="nav-tabs-custom">
                  <ul class="nav nav-tabs">
                    <li class="active"><a href="#contratos" data-toggle="tab" aria-expanded="true">Contratos</a></li>
                    <li class=""><a href="#movimientos" data-toggle="tab" aria-expanded="false">Bitácora</a></li>
                  </ul>
                  <div class="tab-content">

                    <div class="tab-pane active" id="contratos">
                      <div class="row">
                        <div class="col-xs-12">
                          <div class="small">
                            <ul class="list-inline mt-3">
                              <li><b>I:</b> Fecha inicio</li>
                              <li><b>T:</b> Fecha termino</li>
                              <li><b>P:</b> Propietario</li>
                              <li><b>A:</b> Arrendatario</li>
                              <li><b>RG:</b> Receptor Garantía</li>
                            </ul>
                          </div>
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
                    <div class="tab-pane" id="movimientos" style="overflow-x: hidden;overflow-y:auto; height:27rem">
                      <div class="row">
                        <div class="col-md-12">
                          <!-- The time line -->
                          <?php

                          $statement = $con->prepare("SELECT * 
                          FROM tbl_movement_property 
                          WHERE id_property = '$key' 
                          ORDER BY date_movement 
                          DESC");
                          $statement->execute();
                          $result = $statement->fetchAll();

                          if (!empty($result)) {
                          ?>
                            <div class="timeline">
                              <div class="timeline__wrap">
                                <div class="timeline__items">
                                  <?php foreach ($result as $row) { ?>
                                    <div class="timeline__item">
                                      <div class="timeline__content">
                                        <p class="time" style="font-size: 1rem;color: #063a7e;">

                                          <span class="text-black" style="font-size: 1.5rem; font-weight:600">
                                            <?php
                                            switch ($row['type_movement']) {
                                              case '1':
                                                echo 'Informativo';
                                                break;

                                              case '2':
                                                echo 'Solicitud';
                                                break;

                                              case '3':
                                                echo 'Reunión';
                                                break;

                                              case '4':
                                                echo 'Evento';
                                                break;

                                              case '5':
                                                echo 'Otro';
                                                break;

                                              default:
                                                echo 'Sin registro';
                                                break;
                                            }
                                            ?>
                                          </span>

                                          <i class="fas fa-calendar"></i>
                                          <?php
                                          $originalDate = $row['date_movement'];
                                          $newDate = date("d/m/Y", strtotime($originalDate));
                                          echo $newDate;
                                          ?>
                                          </span>

                                        </p>

                                        <div class="row">
                                          <div class="col-md-10">
                                            <p style="font-size: 1.3rem;"><?php echo $row['txt_movement']; ?></p>
                                          </div>
                                          <div class="col-md-2">
                                            <a onclick="deleteMovement(<?php echo $row['id_mov_property']; ?>);" class="text-red"><i class="fas fa-trash" style="font-size:1.5rem;"></i></a>
                                          </div>
                                        </div>


                                        <div class="btn-group">
                                        </div>
                                      </div>
                                    </div>
                                  <?php } ?>
                                </div>
                              </div>
                            </div>
                          <?php
                          } else {
                            echo '<div class="alert alert-warning" role="alert"><strong>Lo sentimos!</strong> no hay movimientos registrados. Para ingresar un movimiento puedes hacer clic a este <a href="" class="text-black" data-toggle="modal" data-target="#modalAddMoveProperty">link</a> o al botón Movimiento.</div>';
                          }
                          ?>


                        </div>
                        <!-- /.col -->
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-lg-12">
                 <div class="nav-tabs-custom">
                  <ul class="nav nav-tabs">
                    <li class="active"><a href="#pagosu" data-toggle="tab" aria-expanded="false">Pagos</a></li>
                    <li class=""><a href="#cobrosu" data-toggle="tab" aria-expanded="false">Cobros</a></li>
                  </ul>
                  <div class="tab-content">
                    <div class="tab-pane active" id="pagosu">
                      <table id="tablePagosU" class="table table-striped" style="font-size: 1.1rem; width:100%">
                        <thead>
                          <tr>
                            <th>DESDE</th>
                            <th>HACIA</th>
                            <th>CONCEPTO</th>
                            <th>MONTO</th>
                            <th>VER ABONOS</th>
                            <th>Estatus</th>
                            <th width="150px">OPCIONES</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php 
                            $stmt_pagos = $con->query("SELECT *,  
CASE WHEN desde_pago = 'Propietario' THEN (SELECT tcs.name_owner FROM tbl_contrato_system tcs WHERE tpp.id_property = tcs.id_property order by tcs.id_contrato DESC limit 1) WHEN desde_pago = 'Arrendatario' THEN (SELECT tcs.name_leaser FROM tbl_contrato_system tcs WHERE tpp.id_property = tcs.id_property order by tcs.id_contrato DESC limit 1)
  ELSE 'Gestarriendo'
  END AS name_desde_pago, 
CASE WHEN hacia_pago = 'Propietario' THEN (SELECT tcs.name_owner FROM tbl_contrato_system tcs WHERE tpp.id_property = tcs.id_property order by tcs.id_contrato DESC limit 1)
  WHEN hacia_pago = 'Arrendatario' THEN (SELECT tcs.name_leaser FROM tbl_contrato_system tcs WHERE tpp.id_property = tcs.id_property order by tcs.id_contrato DESC limit 1)
  ELSE 'Gestarriendo' END AS name_hacia_pago
FROM tbl_pagos_property as tpp WHERE tpp.id_property = ".$key." AND tpp.unique_id <> 0");
                            while($row = $stmt_pagos->fetch()){

                          ?>
                          <tr>
                            <td><?=$row['desde_pago']?><br>(<?=$row['name_desde_pago']?>)</td>
                            <td><?=$row['hacia_pago']?><br>(<?=$row['name_hacia_pago']?>)</td>
                            <td><?=$row['concepto_csimple']?></td>
                            <td>$<?=number_format($row['amount_psimple'], 0, '', '.')?></td>
                                                        <td>
                              <button type="button" class="btn btn-info" data-toggle="modal" data-target="#pagoModal_<?=$row['id_pago_property']?>">VER</button>
                              <!-- Modal -->
                              <div id="pagoModal_<?=$row['id_pago_property']?>" class="modal fade" role="dialog">
                                <div class="modal-dialog">

                                  <!-- Modal content-->
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                                      <h4 class="modal-title">Lista de Abonos</h4>
                                    </div>
                                    <div class="modal-body">
                                      <table class="table table-bordered table-striped">
                                        <thead>
                                          <th>ID</th>
                                          <th>DESCRIPCION</th>
                                          <th>MONTO</th>
                                          <th>FECHA</th>
                                        </thead>
                                        <tbody>
                                          <?php
                                            $rsc = $con->query("SELECT * FROM tbl_abonos WHERE id_element = ".$row['id_pago_property']);
                                            while($rwc = $rsc->fetch()){
                                          ?>
                                            <tr>
                                              <td><?=$rwc['id']?></td>
                                              <td><?=$rwc['descripcion']?></td>
                                              <td><?=number_format($rwc['monto'], 0, '', '.')?></td>
                                              <td><?=date('d-m-Y',strtotime($rwc['fecha']))?></td>
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                      </table>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                    </div>
                                  </div>

                                </div>
                              </div>
                            </td>
                            <td>
                              <?php
                                if($row['estatus'] == "pendiente"){
                                  $label = "info";
                                }else if ($row['estatus'] == "pagado"){
                                  $label = "success";
                                }else if ($row['estatus'] == "atrasado"){
                                  $label = "warning";
                                }else{
                                  $label = "danger";
                                }
                              ?>
                              <label class="label label-<?=$label?>"><?=$row['estatus']?></label>

                            </td>
                            <td>
                              <div class="ocultar-elemento btn-group">
                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Cambiar Estado: <span class="caret"></span></button>
                                <ul class="dropdown-menu">

                                  <li><a href="#" class="change-status" data-amount="<?=$row['amount_psimple']?>" data-source="pago" data-value="<?=$row['id_pago_property']?>" data-status="abonar"><i class="fa fa-credit-card" aria-hidden="true"></i>Abonar</a></li>

                                    <li><a href="#" class="change-status" data-source="pago" data-value="<?=$row['id_pago_property']?>" data-status="pagado"><i class="fa fa-check" aria-hidden="true"></i>Pagado</a></li>
                                    <li><a herf="#" class="change-status" data-source="pago" data-value="<?=$row['id_pago_property']?>" data-status="cancelado"><i class="fa fa-times"></i> Cancelado</a></li>
                                </ul>
                              </div>
                            </td>
                          </tr>
                        <?php } ?>
                        </tbody>
                      </table>
                    </div>
                    <div class="tab-pane" id="cobrosu">
                      <table id="tableCobrosU" class="table table-striped" style="font-size: 1.1rem; width:100%">
                        <thead>
                          <tr>
                            <th>DESDE</th>
                            <th>HACIA</th>
                            <th>CONCEPTO</th>
                            <th>MONTO</th>
                            <th>VER ABONOS</th>
                            <th>Estatus</th>
                            <th width="150px">OPCIONES</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php 
                            $stmt_pagos = $con->query("SELECT *,
CASE WHEN desde_cobro = 'Propietario' THEN (SELECT tcs.name_owner FROM tbl_contrato_system tcs WHERE tcp.id_property = tcs.id_property order by tcs.id_contrato DESC limit 1) WHEN desde_cobro = 'Arrendatario' THEN (SELECT tcs.name_leaser FROM tbl_contrato_system tcs WHERE tcp.id_property = tcs.id_property order by tcs.id_contrato DESC limit 1)
  ELSE 'Gestarriendo'
  END AS name_desde_cobro, 
CASE WHEN hacia_cobro = 'Propietario' THEN (SELECT tcs.name_owner FROM tbl_contrato_system tcs WHERE tcp.id_property = tcs.id_property order by tcs.id_contrato DESC limit 1)
  WHEN hacia_cobro = 'Arrendatario' THEN (SELECT tcs.name_leaser FROM tbl_contrato_system tcs WHERE tcp.id_property = tcs.id_property order by tcs.id_contrato DESC limit 1)
  ELSE 'Gestarriendo' END AS name_hacia_cobro
                             FROM tbl_cobros_property as tcp WHERE tcp.id_property = ".$key." AND tcp.unique_id <> 0");
                            while($row = $stmt_pagos->fetch()){

                          ?>
                          <tr>
                            <td><?=$row['desde_cobro']?><br>(<?=$row['name_desde_cobro']?>)</td>
                            <td><?=$row['hacia_cobro']?><br>(<?=$row['name_hacia_cobro']?>)</td>
                            <td><?=$row['concepto_csimple']?></td>
                            <td>$<?=number_format($row['amount_csimple'], 0, '', '.')?></td>
                            <td>
                              <button type="button" class="btn btn-info" data-toggle="modal" data-target="#cobroModal_<?=$row['id_cobro_property']?>">VER</button>
                              <!-- Modal -->
                              <div id="cobroModal_<?=$row['id_cobro_property']?>" class="modal fade" role="dialog">
                                <div class="modal-dialog">

                                  <!-- Modal content-->
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                                      <h4 class="modal-title">Lista de Abonos</h4>
                                    </div>
                                    <div class="modal-body">
                                      <table class="table table-bordered table-striped">
                                        <thead>
                                          <th>ID</th>
                                          <th>DESCRIPCION</th>
                                          <th>MONTO</th>
                                          <th>FECHA</th>
                                        </thead>
                                        <tbody>
                                          <?php
                                            $rsc = $con->query("SELECT * FROM tbl_abonos WHERE id_element = ".$row['id_cobro_property']);
                                            while($rwc = $rsc->fetch()){
                                          ?>
                                            <tr>
                                              <td><?=$rwc['id']?></td>
                                              <td><?=$rwc['descripcion']?></td>
                                              <td><?=number_format($rwc['monto'], 0, '', '.')?></td>
                                              <td><?=date('d-m-Y',strtotime($rwc['fecha']))?></td>
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                      </table>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                    </div>
                                  </div>

                                </div>
                              </div>
                            </td>
                            <td>
                              <?php
                                if($row['estatus'] == "pendiente"){
                                  $label = "info";
                                }else if ($row['estatus'] == "pagado"){
                                  $label = "success";
                                }else if ($row['estatus'] == "atrasado"){
                                  $label = "warning";
                                }else{
                                  $label = "danger";
                                }
                              ?>
                              <label class="label label-<?=$label?>"><?=$row['estatus']?></label>

                            </td>
                            <td>
                              <div class="ocultar-elemento btn-group">
                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Cambiar Estado: <span class="caret"></span></button>
                                <ul class="dropdown-menu">

                                  <li><a href="#" class="change-status" data-amount="<?=$row['amount_csimple']?>" data-source="cobro" data-value="<?=$row['id_cobro_property']?>" data-status="abonar"><i class="fa fa-credit-card" aria-hidden="true"></i>Abonar</a></li>

                                    <li><a href="#" class="change-status" data-source="cobro" data-value="<?=$row['id_cobro_property']?>" data-status="pagado"><i class="fa fa-check" aria-hidden="true"></i>Pagado</a></li>
                                    <li><a herf="#" class="change-status" data-source="cobro" data-value="<?=$row['id_cobro_property']?>" data-status="cancelado"><i class="fa fa-times"></i> Cancelado</a></li>
                                </ul>
                              </div>
                            </td>
                          </tr>
                        <?php } ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-lg-12">
                <div class="nav-tabs-custom">
                  <ul class="nav nav-tabs">
                    <li class="active"><a href="#gastos" data-toggle="tab" aria-expanded="false">Gastos</a></li>
                  </ul>
                  <div class="tab-content">
                    <div class="tab-pane active" id="gastos">
                      <table class="table table-striped" style="font-size: 1.1rem; width:100%">
                        <thead>
                          <th>ID</th>
                          <th>NRO</th>
                          <th>CARGO A</th>
                          <th>CONCEPTO</th>
                          <th>MONTO</th>
                          <th>DESCRIPCION</th>
                          <th>DOCUMENTO</th>
                        </thead>
                        <tbody>
                          <?php
                            $qgastos = "SELECT gt.id, gt.documentno, gt.charge_to, cg.name AS concepto_gasto, gt.amount, gt.description, gt.url_file_doc FROM tbl_gastos as gt INNER JOIN tbl_concepto_gasto AS cg ON (cg.id = gt.concepto_gasto_id) WHERE gt.contrato_id = ".$rs['id_contrato']." ORDER BY gt.created_at DESC";
                            $r = $con->query($qgastos);
                            if(isset($rs['id_contrato']) and !empty($rs['id_contrato'])){
                            while($row = $r->fetch()){
                          ?>
                          <tr>
                              <td><?=$row['id']?></td>
                              <td><?=$row['documentno']?></td>
                              <td><?=$row['charge_to']?></td>
                              <td><?=$row['concepto_gasto']?></td>
                              <td>$<?=number_format($row['amount'], 0, '', '.')?></td>
                              <td><?=$row['description']?></td>
                              <td><a class="btn btn-info ver-archivo" href="#" data-url="uploads/gastos/<?=$row['url_file_doc']?>">Ver Archvo</a></td>
                            </tr>
                        <?php }
                          }
                        ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-lg-12">
                <div class="nav-tabs-custom">
                  <ul class="nav nav-tabs">
                    <?php if ($pago == '1') { ?>
                      <li class="active"><a href="#pagos" data-toggle="tab" aria-expanded="false">Pagos Recurrentes</a></li>
                      <li class=""><a href="#cobros" data-toggle="tab" aria-expanded="false">Cobros Recurrentes</a></li>
                    <?php } else if ($pago == '0') { ?>
                      <li class="active"><a href="#cobros" data-toggle="tab" aria-expanded="false">Cobros Recurrentes</a></li>
                    <?php } ?>
                  </ul>
                  <div class="tab-content">
                    <!-- /.tab-pane -->
                    <?php if ($pago === '1') { ?>
                      <div class="tab-pane active" id="pagos">
                        <div class="row">
                          <div class="col-xs-12">
                            <table id="tablePagosP" class="table table-striped" style="font-size: 1.1rem; width:100%">
                              <thead>
                                <tr>
                                  <th>DESDE</th>
                                  <th>HACIA</th>
                                  <th>CONCEPTO</th>
                                  <th>PAGOS RECURRENTE</th>
                                  <th>MONTO</th>
                                  <th>VENCIMIENTO</th>
                                  <th width="150px">OPCIONES</th>
                                </tr>
                              </thead>
                            </table>
                          </div>
                        </div>
                      </div>
                      <div class="tab-pane" id="cobros">
                        <div class="row">
                          <div class="col-xs-12">
                            <div class="small">
                              <ul class="list-inline mt-3">
                                <li class="text-success"><b>Cobro recurrente:</b> Cobrado y pagado mensualmente.</li>
                                <li class="text-warning"><b>Cobro único:</b> Cobrado y pagado solo una vez.</li>
                              </ul>
                            </div>
                            <table id="tableCobrosP" class="table table-striped" style="font-size: 1.1rem; width:100%">
                              <thead>
                                <tr>
                                  <th>DESDE</th>
                                  <th>HACIA</th>
                                  <th>CONCEPTO</th>
                                  <th>COBRO RECURRENTE</th>
                                  <th>MONTO</th>
                                  <th>VENCIMIENTO</th>
                                  <th width="150px">OPCIONES</th>
                                </tr>
                              </thead>
                            </table>
                          </div>
                        </div>
                      </div>
                    <?php } else if ($pago == '0') { ?>
                      <!-- /.tab-pane -->
                      <div class="tab-pane active" id="cobros">
                        <div class="row">
                          <div class="col-xs-12">
                            <div class="small">
                              <ul class="list-inline mt-3">
                                <li class="text-success"><b>Cobro recurrente:</b> Cobrado y pagado mensualmente.</li>
                                <li class="text-warning"><b>Cobro único:</b> Cobrado y pagado solo una vez.</li>
                              </ul>
                            </div>
                            <table id="tableCobrosP" class="table table-striped" style="font-size: 1.1rem; width:100%">
                              <thead>
                                <tr>
                                  <th>DESDE</th>
                                  <th>HACIA</th>
                                  <th>CONCEPTO</th>
                                  <th>COBRO RECURRENTE</th>
                                  <th>MONTO</th>
                                  <th>VENCIMIENTO</th>
                                  <th width="150px">OPCIONES</th>
                                </tr>
                              </thead>
                            </table>
                          </div>
                        </div>
                      </div>
                      <!-- /.tab-pane -->
                    <?php } ?>
                  </div>
                  <!-- /.tab-content -->
                </div>
              </div>
            </div>
            <!-- nav-tabs-custom -->
          </div>
          <!-- /.col -->
        </div>
      </section>
      <!-- /.content -->

    </div>
    <!-- /.content-wrapper -->

    <!-- ADD CONTRATO ARRENDAMIENTO  -->
    <div class="modal fade" id="modalAddContrato" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title text-center" id="myModalLabel">CREAR CONTRATO DE ARRENDAMIENTO</h4>
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
                      <li class=""><a href="#step_2" data-toggle="tab" aria-expanded="false">Garantias y Contrato</a></li>

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
            <button id="btnSaveContrato" type="submit" class="btn btn-success"><i class="fa fa-check-circle"></i> Guardar</button>
          </div>
          </form>
        </div>
      </div>
    </div>

    <!-- EDIT CONTRATO ARRENDAMIENTO -->
    <div class="modal fade" id="modalEditContrato" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title text-center" id="myModalLabel">EDITAR CONTRATO DE ARRENDAMIENTO</h4>
          </div>
          <div class="modal-body" style="background: #f4f4f4">
            <form id="editContrato" method="POST">
              <input type="hidden" id="id_contrato" name="id_contrato">
              <input type="hidden" id="id_property_edit" name="id_property_edit" value="<?php echo $_GET['id_property']; ?>">
              <div class="row">
                <div class="col-xs-12">
                  <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs nave-tabs">
                      <li class="active"><a href="#step_1_edit" data-toggle="tab" aria-expanded="true">Individualización</a></li>
                      <li class=""><a href="#step_2_edit" data-toggle="tab" aria-expanded="false">Garantias y Contrato</a></li>

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
            <button id="btnEditContrato" type="submit" class="btn btn-success"><i class="fa fa-check-circle"></i> Guardar</button>
          </div>
          </form>
        </div>
      </div>
    </div>

    <!-- PAGOS ADMINISTRACIÓN -->
    <div class="modal fade" id="modalPagos" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span></button>
            <h4 class="modal-title">Generar nuevo pago</h4>
          </div>
          <div class="modal-body pb-0">
            <form id="addPagos" method="POST">
              <input type="hidden" id="cSimpleP" name="cSimpleP" value="cSimple">
              <input type="hidden" id="id_property_p" name="id_property_p" value="<?php echo $_GET['id_property']; ?>">
              <input type="hidden" id="agent_designated_p" name="agent_designated_p" value="<?php nameUser($_SESSION['user_system']); ?>">
              <input type="hidden" id="date_register_p" name="date_register_p" value="<?php echo date('Y-m-d'); ?>">
              <div class="row">

                <div class="col-xs-6">
                  <div class="form-group">
                    <label>Pago desde:</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fas fa-user-friends"></i>
                      </div>
                      <!-- <select id="desde_pago" name="desde_pago" class="form-control select2" required>
                        <option></option>
                        <option value="Arrendatario">Arrendatario</option>
                        <option value="Gestarriendo">Gestarriendo</option>
                      </select> -->
                      <input type="text" id="desde_pago" name="desde_pago" class="form-control" value="Gestarriendo" readonly>
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
                      <!-- <select id="hacia_pago" name="hacia_pago" class="form-control select2" required>
                        <option></option>
                        <option value="Propietario">Propietario</option>
                        <option value="Gestarriendo">Gestarriendo</option>
                      </select> -->
                      <input type="text" id="hacia_pago" name="hacia_pago" class="form-control" value="Propietario" readonly>
                    </div>
                    <!-- /.input group -->
                  </div>
                </div>

                <div class="col-xs-6">
                  <div class="form-group">
                    <label>Concepto del Pago:</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fas fa-file"></i>
                      </div>
                      <select style="text-transform: capitalize;" name="concepto_psimple" id="concepto_psimple" class="form-control select2" required>
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
                    <label>¿Es recurrente?</label>
                    <input name="pay_recurrent_p" id="pay_recurrent_p" type="checkbox" class="form-control" checked data-toggle="toggle">
                  </div>
                  <input type="hidden" name="hidden_recurrent_p" id="hidden_recurrent_p" value="1">
                </div>

                <div id="account_bank" class="col-xs-8">
                  <div class="form-group">
                    <label>Cuenta Bancaria:</label>
                    <select name="account_id_p" id="account_id_p" class="form-control select2">
                      <option></option>
                      <?php
                      $query = $con->prepare("SELECT * FROM tbl_account_bank");
                      $query->execute();
                      $cuentas = $query->fetchAll(PDO::FETCH_ASSOC);
                      ?>
                      <?php foreach ($cuentas as $cuenta) { ?>
                        <option value="<?php echo $cuenta['id_account_bank']; ?>"><?php echo $cuenta['titular_account'] . ' - ' . $cuenta['bank_account'] . ' - ' . $cuenta['number_account']; ?></option>
                      <?php } ?>
                      <option></option>
                    </select>
                  </div>

                </div>

                <div class="col-xs-6">
                  <div class="form-group">
                    <label>Monto a Pagar:</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fas fa-usd"></i>
                      </div>
                      <input type="number" name="amount_csimple_p" id="amount_csimple_p" class="form-control" placeholder="Ej: 350000" required>
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
                      <input type="number" name="venc_csimple_p" id="venc_csimple_p" class="form-control" placeholder="Día vencimiento" required>
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
                <button type="submit" id="btnSavePagos" class="btn btn-primary"></button>
              </div>
            </form>
          </div>

        </div>
        <!-- /.modal-content -->
      </div>
    </div>

    <!-- COBRO ADMINISTRACIÓN -->
    <div class="modal fade" id="modalCobroSimple" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span></button>
            <h4 class="modal-title">Generar nuevo cobro</h4>
          </div>
          <div class="modal-body pb-0">
            <form id="addCobroSimple" method="POST">
              <input type="hidden" id="cSimple" name="cSimple" value="cSimple">
              <input type="hidden" id="id_property_c" name="id_property_c" value="<?php echo $_GET['id_property']; ?>">
              <input type="hidden" id="agent_designated_c" name="agent_designated_c" value="<?php nameUser($_SESSION['user_system']); ?>">
              <input type="hidden" id="date_register_c" name="date_register_c" value="<?php echo date('Y-m-d'); ?>">
              <div class="row">

                <div class="col-xs-6">
                  <div class="form-group">
                    <label>Cobro desde:</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fas fa-user-friends"></i>
                      </div>
                      <select id="desde_cobro" name="desde_cobro" class="form-control select2" required>
                        <option></option>
                        <option value="Arrendatario">Arrendatario</option>
                        <option value="Propietario">Propietario</option>
                        <option value="Gestarriendo">Gestarriendo</option>
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
                        <option value="Arrendatario">Arrendatario</option>
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
                    <label>¿Es recurrente?</label>
                    <input name="pay_recurrent" id="pay_recurrent" type="checkbox" class="form-control" checked data-toggle="toggle">
                  </div>
                  <input type="hidden" name="hidden_recurrent" id="hidden_recurrent" value="1">
                </div>

                <div id="c_account_bank" class="col-xs-8">
                  <div class="form-group">
                    <label>Cuenta Bancaria:</label>
                    <select name="c_account_id" id="c_account_id" class="form-control select2">
                      <option></option>
                      <?php
                      $query = $con->prepare("SELECT * FROM tbl_account_bank");
                      $query->execute();
                      $cuentas = $query->fetchAll(PDO::FETCH_ASSOC);
                      ?>
                      <?php foreach ($cuentas as $cuenta) { ?>
                        <option value="<?php echo $cuenta['id_account_bank']; ?>"><?php echo $cuenta['titular_account'] . ' - ' . $cuenta['bank_account'] . ' - ' . $cuenta['number_account']; ?></option>
                      <?php } ?>
                      <option></option>
                    </select>
                  </div>

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
                <button type="submit" id="btnSaveCobros" class="btn btn-primary"></button>
              </div>
            </form>
          </div>

        </div>
        <!-- /.modal-content -->
      </div>
    </div>

    <!-- EDIT COBRO ADMINISTRACIÓN -->
    <div class="modal fade" id="modalEditCobro" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span></button>
            <h4 class="modal-title">Generar nuevo cobro</h4>
          </div>
          <div class="modal-body pb-0">
            <form id="editCobro" method="POST">
              <input type="hidden" id="cSimpleEdit" name="cSimpleEdit" value="cSimple">
              <input type="hidden" id="id_cobro_property" name="id_cobro_property">
              <div class="row">

                <div class="col-xs-6">
                  <div class="form-group">
                    <label>Pago desde:</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fas fa-user-friends"></i>
                      </div>
                      <select id="desde_edit" name="desde_edit" class="form-control" required>
                        <option value="Arrendatario">Arrendatario</option>
                        <option value="Propietario">Propietario</option>
                        <option value="Gestarriendo">Gestarriendo</option>
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
                      <select id="hacia_edit" name="hacia_edit" class="form-control" required>
                        <option value="Arrendatario">Arrendatario</option>
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
                      <select style="text-transform: capitalize;" name="concepto_edit" id="concepto_edit" class="form-control" required>
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
                    <label>¿Es recurrente?</label>
                    <input name="pay_edit" id="pay_edit" type="checkbox" class="form-control" checked data-toggle="toggle">
                  </div>
                  <input type="hidden" name="hidden_recurrent_edit" id="hidden_recurrent_edit" value="1">
                </div>

                <div id="c_account_bank" class="col-xs-8">
                  <div class="form-group">
                    <label>Cuenta Bancaria:</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fas fa-university"></i>
                      </div>
                      <select name="account_edit_c" id="account_edit_c" class="form-control">
                        <?php
                        $query = $con->prepare("SELECT * FROM tbl_account_bank");
                        $query->execute();
                        while ($cuentas = $query->fetchAll(PDO::FETCH_ASSOC)) { ?>
                          <option value="<?php echo $cuenta['id_account_bank']; ?>"><?php echo $cuenta['titular_account'] . ' - ' . $cuenta['bank_account'] . ' - ' . $cuenta['number_account']; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-xs-6">
                  <div class="form-group">
                    <label>Monto a cobrar:</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fas fa-usd"></i>
                      </div>
                      <input type="number" name="amount_edit" id="amount_edit" class="form-control" placeholder="Ej: 350000" required>
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
                      <input type="number" name="venc_edit" id="venc_edit" class="form-control" placeholder="Día vencimiento" required>
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
                <button type="submit" id="btnEditCobros" class="btn btn-primary"></button>
              </div>
            </form>
          </div>

        </div>
        <!-- /.modal-content -->
      </div>
    </div>

    <!-- EDIT PAGO ADMINISTRACIÓN -->
    <div class="modal fade" id="modalEditPago" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span></button>
            <h4 class="modal-title">Editar pago</h4>
          </div>
          <div class="modal-body pb-0">
            <form id="editPago" method="POST">
              <input type="hidden" id="cSimpleEditP" name="cSimpleEditP" value="cSimple">
              <input type="hidden" id="id_pago_property" name="id_pago_property">
              <div class="row">

                <div class="col-xs-6">
                  <div class="form-group">
                    <label>Pago desde:</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fas fa-user-friends"></i>
                      </div>
                      <select id="desde_edit_p" name="desde_edit_p" class="form-control" required>
                        <option value="Arrendatario">Arrendatario</option>
                        <option value="Propietario">Propietario</option>
                        <option value="Gestarriendo">Gestarriendo</option>
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
                      <select id="hacia_edit_p" name="hacia_edit_p" class="form-control" required>
                        <option value="Arrendatario">Arrendatario</option>
                        <option value="Propietario">Propietario</option>
                        <option value="Gestarriendo">Gestarriendo</option>
                      </select>
                    </div>
                    <!-- /.input group -->
                  </div>
                </div>

                <div class="col-xs-6">
                  <div class="form-group">
                    <label>Concepto del Pago:</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fas fa-file"></i>
                      </div>
                      <select style="text-transform: capitalize;" name="concepto_edit_p" id="concepto_edit_p" class="form-control" required>
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
                    <label>¿Es recurrente?</label>
                    <input name="pay_edit_p" id="pay_edit_p" type="checkbox" class="form-control" checked data-toggle="toggle">
                  </div>
                  <input type="hidden" name="hidden_recurrent_edit_p" id="hidden_recurrent_edit_p" value="1">
                </div>

                <div class="col-xs-8">
                  <div class="form-group">
                    <label>Cuenta Bancaria:</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fas fa-university"></i>
                      </div>
                      <select name="account_edit_p" id="account_edit_p" class="form-control">
                        <?php
                        $query = $con->prepare("SELECT * FROM tbl_account_bank");
                        $query->execute();
                        while ($cuentas = $query->fetchAll(PDO::FETCH_ASSOC)) { ?>
                          <option value="<?php echo $cuenta['id_account_bank']; ?>"><?php echo $cuenta['titular_account'] . ' - ' . $cuenta['bank_account'] . ' - ' . $cuenta['number_account']; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-xs-6">
                  <div class="form-group">
                    <label>Monto a Pagar:</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fas fa-usd"></i>
                      </div>
                      <input type="number" name="amount_edit_p" id="amount_edit_p" class="form-control" placeholder="Ej: 350000" required>
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
                      <input type="number" name="venc_edit_p" id="venc_edit_p" class="form-control" placeholder="Día vencimiento" required>
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
                <button type="submit" id="btnEditPagos" class="btn btn-primary"></button>
              </div>
            </form>
          </div>

        </div>
        <!-- /.modal-content -->
      </div>
    </div>

    <!-- MOVIMIENTOS INMUEBLE -->
    <div class="modal fade" id="modalAddMoveProperty" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span></button>
            <h4 class="modal-title">Movimientos</h4>
          </div>
          <div class="modal-body">
            <div class="alert alert-warning mb-4" role="alert">
              <p>Te recordamos que estos movimientos no pueden ser editados con <u>posterioridad</u>.</p>
            </div>
            <form id="addMoveProperty" method="POST">
              <input type="hidden" name="id_property_m" id="id_property_m" value="<?php echo $_GET['id_property']; ?>">
              <input type="hidden" name="hour_movement" id="hour_movement">
              <div class="row">
                <div class="col-xs-12">
                  <div class="form-group">
                    <label>Ingresar por:</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-user"></i>
                      </div>
                      <input type="text" name="agent_movement" id="agent_movement" class="form-control" value="<?php nameUser($_SESSION['user_system']); ?>" readonly>
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
                      <input type="date" id="date_movement" name="date_movement" value="<?php echo date('Y-m-d'); ?>" class="form-control">
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
                      <select id="type_movement" name="type_movement" class="form-control select2" required>
                        <option></option>
                        <option value="1">Informativo</option>
                        <option value="2">Solicitud</option>
                        <option value="3">Reunión</option>
                        <option value="4">Evento</option>
                        <option value="5">Otro</option>
                      </select>
                    </div>
                    <!-- /.input group -->
                  </div>
                </div>

                <div class="col-xs-12">
                  <div class="form-group">
                    <label>Describa el movimiento:</label>
                    <textarea name="txt_movement" id="txt_movement" class="form-control" placeholder="Describa aquí el movimiento que tuvo la propiedad..."></textarea>
                    <!-- /.input group -->
                  </div>
                </div>

              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            <button id="btnSaveMove" type="submit" class="btn btn-success"></button>
          </div>
          </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>

    <div class="modal fade" id="modalDatosArrendatario" role="dialog">
      <div class="modal-dialog modal-lg">
        <div class="modal-content ">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span></button>
            <h4 class="modal-title">Datos Arrendatario</h4>
          </div>
          <div class="modal-body">
            <div class="modal-footer">
              <table class="table table-striped table-bordered">
                <thead>
                  <th><center>Nombre</center></th>
                  <th><center>Rut</center></th>
                  <th><center>Email</center></th>
                  <th><center>Telefono</center></th>
                  <th><center>Telefono 2</center></th>
                </thead>
                <tbody>
                  <?php
                    $query = $con->prepare("SELECT * FROM tbl_leaser_system WHERE name_leaser = '".$rs['name_leaser']."'");
                    $query->execute();
                    $row = $query->fetch();

                  ?>
                  <tr>
                    <td align="center"><?=$row['name_leaser']?></td>
                    <td align="center"><?=$row['rut_leaser']?></td>
                    <td align="center"><?=$row['email_leaser']?></td>
                    <td align="center"><?=$row['phone_one_leaser']?></td>
                    <td align="center"><?=$row['phone_two_leaser']?></td>
                  </tr>
                </tbody>
              </table>
              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="modalDatosPropietario" role="dialog">
      <div class="modal-dialog modal-lg">
        <div class="modal-content ">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span></button>
            <h4 class="modal-title">Datos Bancarios Propietario</h4>
          </div>
          <div class="modal-body">
            

            <?php
              $selContrato = $con->prepare("
              SELECT * FROM tbl_contrato_system
              WHERE id_property = '$key'
              ");
              $selContrato->execute();
              $rowContrato = $selContrato->fetch(PDO::FETCH_ASSOC);

              $propietario = $rowContrato['name_owner'];

              if(!empty($propietario)){
                $select = $con->prepare("
                SELECT * 
                FROM tbl_owner_system
                WHERE name_owner = '$propietario'
                ");
                $select->execute();
                $rowPropietario= $select->fetch(PDO::FETCH_ASSOC);
              }else{
                $alert = '
              <div class="alert alert-warning mb-4" role="alert">
                <p>No hay datos bancarios almacenados para este propietario.</p>
              </div>';
              echo $alert;
              }
            ?>
            <table class="table table-bordered">
              <tr>
                <th>Titular Cuenta</th>
                <th>RUT Titular</th>
                <th>Banco Cuenta</th>
                <th>Tipo Cuenta</th>
                <th>N° Cuenta</th>
                <th>Email Confirmación</th>
              </tr>
              <tr>
                <td>
                  <?php echo @$rowPropietario['titular_account'];?>
                </td>
                <td>
                  <?php echo @$rowPropietario['rut_account'];?>
                </td>
                <td>
                  <?php echo @$rowPropietario['bank_account'];?>
                </td>
                <td>
                  <?php echo @$rowPropietario['type_account'];?>
                </td>
                <td>
                  <?php echo @$rowPropietario['number_account'];?>
                </td>
                <td>
                  <?php echo @$rowPropietario['email_account'];?>
                </td>
              </tr>
            </table>
            
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>

  </div>

  <div class="modal fade" id="modalDatosIpc" role="dialog">
        <div class="modal-dialog modal-md">
            <div class="modal-content ">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Regular IPC</h4>
              </div>
              <div class="modal-body">
                <form id="ipcForm">
                  <input type="hidden" name="ipcContrato_ID" value="<?php echo $rs['id_contrato']; ?>" id="ipcContrato_ID">
                  <input type="hidden" name="ipcFechaInicio" value="<?php echo $rs['fecha_inicio']; ?>" id="ipcFechaInicio">
                  <div class="form-group">
                    <label>Regular IPC Cada: </label>
                    <select class="form-control" id="ipcRecurrencia" name="ipcRecurrencia">
                      <option value="3">3 Meses</option>
                      <option value="6">6 Meses</option>
                      <option value="12">12 Meses</option>
                      <option value="0">Nunca</option>
                    </select>
                  </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-success">Registrar</button>
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
              </form>
            </div>
          </div>
          <!-- /.modal-content -->
      </div>
  </div>

  <div class="modal fade" id="modalDatosAbono" role="dialog">
      <div class="modal-dialog modal-md">
        <div class="modal-content ">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Registrar Abono</h4>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <label>Description: </label>
                  <input type="text" name="abono_description" class="form-control" id="abono_description" />
                </div> 
                <div class="form-group">
                  <label>Monto: </label>
                  <input type="text" name="abono_amount" class="form-control" id="abono_amount" />
                </div> 
                <input type="hidden" name="abono_type" id="abono_type" /> 
                <input type="hidden" name="abono_type_id" id="abono_type_id" />
                <input type="hidden" name="max_amount" id="max_amount" />
              </div>
              <div class="modal-footer">
                <button type="submit" id="btnAbono" class="btn btn-success">Guardar</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
              </div>
        </div>
      </div>
  </div>

  <!--Modal Gestor de Archivos-->
  <div class="modal fade" id="modalGestorArchivos" role="dialog">
      <div class="modal-dialog modal-lg">
        <div class="modal-content ">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Gestor de Archivos</h4>
              </div>
              <div class="modal-body">
                <a class="btn btn-success" href="#" id="reload-iframe-file-manager"><i class="fa fa-home"></i></a><br />
                <iframe src="uploads/index.php" id="iframe-file-manager" width="100%" height="500px" frameborder="0"></iframe>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
              </div>
        </div>
      </div>
  </div>

    <!--Modal de Gastos-->
  <div class="modal fade" id="modalDatosGatos" role="dialog">
      <div class="modal-dialog modal-md">
          <div class="modal-content ">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Registrar Gasto</h4>
              </div>
              <div class="modal-body">
                <form id="formGastos" method="POST" enctype="multipart/form-data">
                  <div class="form-group">
                    <label>Numero de Cobro u Orden:</label>
                    <input type="text" name="documentno" id="documentno" class="form-control" />
                  </div>
                  <div class="form-group">
                    <label>Con Cargo a:</label>
                    <select class="form-control" name="chargeTo" id="chargeTo">
                      <option value="GA">Gest Arriendo</option>
                      <option value="Propietario">Propietario</option>
                      <option value="Arrendatario">Arrendatario</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Concepto:</label>
                    <select class="form-control" name="concepto_gasto_id" id="concepto_gasto_id">
                      <?php 
                        $qr = "SELECT id, name FROM tbl_concepto_gasto ORDER BY name ASC";
                        $q = $con->query($qr);
                        while ($row = $q->fetch(PDO::FETCH_ASSOC)) {
                      ?>
                        <option value="<?=$row['id']?>"><?=$row['name']?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Monto:</label>
                    <input type="text" name="amountGasto" id="amountGasto" class="form-control" />
                  </div>
                  <div class="form-group">
                    <label>Descripcion:</label>
                    <textarea class="form-control" name="descriptionGasto" id="descriptionGasto"></textarea>
                  </div>
                  <div class="form-group">
                    <label>Archivo Adjunto:</label>
                    <input type="file" name="url_file_doc" id="url_file_doc" class="form-control" />
                  </div>
                  <div class="form-group">
                    <label>Enviar Correo?</label>
                    <input type="checkbox" id="sendEmail" name="sendEmail" class="form-control" data-toggle="toggle" />
                  </div>
              <div class="modal-footer">
                <button type="submit" id="btnGastos" class="btn btn-success">Guardar</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
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
  <input type="hidden" id="only-read" value="N" />
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
  <!-- Button Toggle -->
  <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
  <!-- Timeline -->
  <script src="resources/bower_components/timeline/dist/js/timeline.min.js"></script>
  <script src="resources/dist/js/fichaProperty.js"></script>
  <script type="text/javascript">
    $(document).ready(function(){
      <?php if($_SESSION['type_user'] == 'observador') {?>
          $(".btn-app").attr('disabled', true);
          $(".btn-app").attr('data-target','');
          $("#only-read").val('Y');
      <?php }?>

      $(".toggle-on").text("Si")
      $(".toggle-off").text("No")
      
      $("#ipcForm").submit(function(e){
        e.preventDefault();
        let datos = $(this).serialize();

        $.ajax({
          type : 'POST',
          url : 'model/addIpcModel.php',
          data: datos,
          success : function(data){
            console.log(data);
            let title = "";
            let text = "";
            let icon = "";

            if(data == "ok"){
              title = "Exito";
              text = "El registro fue insertado satisfactoriamente."
              icon = "success";
            }else{
              title = "Error";
              text = "Ocurrio un error al tratar de realizar la insercion."
              icon = "error";
            }

            swal({
              title: title,
              text: text,
              icon: icon,
              button: "Ok",
            });

            location.reload();
          },
        })

      });

      $("#formGastos").submit(function(e){
        e.preventDefault();
        var datos = new FormData();

        var file = $("#url_file_doc")[0].files[0];

        datos.append('url_file_doc', file);
        datos.append('documentno',$("#documentno").val());
        datos.append('chargeTo',$("#chargeTo").val());
        datos.append('concepto_gasto_id', $("#concepto_gasto_id").val());
        datos.append('amountGasto',$("#amountGasto").val());
        datos.append('descriptionGasto',$("#descriptionGasto").val());
        datos.append('contrato_id',<?=$rs['id_contrato']?>);

        $("#btnGastos").text("Cargando...").prop('disabled', true);

        $.ajax({
          type: 'post',
          url: 'model/addGastos.php',
          data: datos,
          contentType: false,
          processData: false,
          success: function (data){
            console.log(data);
            let title = "";
            let text = "";
            let icon = "";

            if(data == "ok"){
              title = "Exito";
              text = "El registro fue insertado satisfactoriamente."
              icon = "success";
            }else{
              title = "Error";
              text = "Ocurrio un error al tratar de realizar la insercion."
              icon = "error";
            }

            swal({
              title: title,
              text: text,
              icon: icon,
              button: "Ok",
            });

            location.reload();
          }
        });

      });

      <?php
          if($rs['id_contrato']){
            $stmt = $con->prepare("SELECT recurrencia, fecha_inicio FROM tbl_ipc_config WHERE id_contrato = ".$rs['id_contrato']);
            $stmt->execute();
            $rss = $stmt->fetch();
            if($rss['recurrencia'] >= 0 and !empty($rss['recurrencia'])){

              print "$('#ipcRecurrencia').val(".$rss['recurrencia'].");\n";

              if($rss['recurrencia'] == 0){
                $r = "Nunca";
              }else{
                $r = "Cada ".$rss['recurrencia']." Meses";
              }
              print "$('#alertIPC').show().html('<strong>La regulación de su IPC se ha configurado a ".$r.", la cual esta programada para la fecha ".date('d-m-Y',strtotime($rss['fecha_inicio']))."</strong>').addClass('alert-info');";
            }else{
              print "$('#alertIPC').show().html('<strong>Aún no ha configurado la regulación de su IPC</strong>').addClass('alert-warning');";
              print "$('#alertIPC').css('margin-bottom','15px');";
            }
          }else{
            print "$('#ipcButton').attr('disabled',true).attr('data-target','');";
          }
      ?>

      $("a.change-status").click(function(e){
        e.preventDefault();

        var new_status = $(this).attr("data-status");

        if(new_status != 'abonar'){
            if(confirm("Esta seguro de cambiar el estado?")){

              let id = $(this).attr("data-value");
              let source = $(this).attr("data-source");

              $.post('model/updateStatus.php', { id: id, status: new_status, source: source }, function(data){
                console.log(data);
                if(data == "ok"){
                  swal({
                    title: "Exito",
                    text: "Estado Cambiado con Exito!!",
                    icon: "success",
                    button: "Ok",
                  });
                }

               location.reload();
              });
            }
        }else{
            $("#modalDatosAbono").modal('show');
            $("#abono_type_id").val($(this).attr("data-value"));
            $("#abono_type").val($(this).attr("data-source"));
            $("#max_amount").val($(this).attr("data-amount"));
        }

      });

      $("a.ver-archivo").click(function(e){
        e.preventDefault();
        let url = $(this).attr("data-url");
        $("#contenedor_inicial").hide();
        $("#visualizador_pdf").show();
        $("#frame_visualizador").attr("src",url);

      });

      $("a.volver-ficha").click(function(){
        $("#contenedor_inicial").show();
        $("#visualizador_pdf").hide();
      });

      $("#btnAbono").click(function(){
        var id = $("#abono_type_id").val();
        var type = $("#abono_type").val();
        var description = $("#abono_description").val();
        var amount = $("#abono_amount").val();
        var max_amount = $("#max_amount").val();
        if(amount > max_amount){
            swal({
              title: "Error",
              text: "El monto del Abono Supera al del Pago o Cobro",
              icon: "error",
              button: "Ok",
            });
        }else{
          $.post('model/updateStatus.php', { id: id, status: 'abonar', source: type, abono_description: description, abono_amount: amount }, function(data){
              console.log(data);
              if(data == "ok"){
                swal({
                  title: "Exito",
                  text: "Abono Cargado con Exito!!",
                  icon: "success",
                  button: "Ok",
                });
              }

             location.reload();
          });
        }
      });

      $("#reload-iframe-file-manager").click(function(){
        $("#iframe-file-manager").attr("src","uploads/index.php");
      });

    });
  </script>
</body>

</html>