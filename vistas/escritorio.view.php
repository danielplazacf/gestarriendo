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
          <div class="alert alert-warning">
            <?php
              if(NAME_APP === 'gestarriendo-master'){
                echo 'El nombre de tu app es' . NAME_APP . ', para cambiarlo debes ir a <code>model/functions.php</code>';
              }
            ?>
          </div>
        </div>

          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
              <span class="info-box-icon bg-aqua"><i class="fas fa-building"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Propiedades</span>
                <span class="info-box-number" id="countProperty"><?php echo $rowProperty;?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
              <span class="info-box-icon bg-green"><i class="fas fa-user"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Propietarios</span>
                <span class="info-box-number"><?php echo $rowOwner;?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix visible-sm-block"></div>

          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
              <span class="info-box-icon bg-red"><i class="fas fa-user-friends"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Arrendatarios</span>
                <span class="info-box-number"><?php echo $rowLeaser;?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
              <span class="info-box-icon bg-yellow"><i class="fas fa-usd"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">UTILIDADES</span>
                <span class="info-box-number"><small>$</small>0</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title">Ingresos vs Utilidades</h3>

                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
              </div>
              <div class="box-body">
                <div class="chart">
                  <canvas id="barChart" style="height: 230px; width: 510px;" height="230" width="510"></canvas>
                </div>
              </div>
              <!-- /.box-body -->
            </div>
          </div>

          <div class="col-md-4">
            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title">Indicadores Económicos</h3>

                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus" aria-hidden="true"></i>
                  </button>
                  <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times" aria-hidden="true"></i></button>
                </div>
              </div>
              <div class="box-body">
                <div class="row">
                  <div class="col-md-6">
                    <p class=""><b>UF:</b> <?php echo '$' . number_format($dailyIndicators->uf->valor, 0, '', '.'); ?></p>
                    <p class=""><b>UTM:</b> <?php echo '$' . number_format($dailyIndicators->utm->valor, 0, '', '.'); ?></p>
                    <p class=""><b>DOLAR:</b> <?php echo '$' . number_format($dailyIndicators->dolar->valor, 0, '', '.'); ?></p>
                    <p class=""><b>EURO:</b> <?php echo '$' . number_format($dailyIndicators->euro->valor, 0, '', '.'); ?></p>
                  </div>
                  <div class="col-md-6">
                    <p class=""><b>IPC:</b> <?php echo $dailyIndicators->ipc->valor; ?></p>
                    <p class=""><b>IVP:</b> <?php echo '$' . number_format($dailyIndicators->ivp->valor, 0, '', '.'); ?></p>
                    <p class=""><b>IMACEC:</b> <?php echo $dailyIndicators->imacec->valor; ?></p>
                  </div>
                </div>
              </div>
              <!-- /.box-body -->
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

  <script src="resources/bower_components/chart.js/Chart.js"></script>

  <script type="text/javascript">

    // definimos el tipo de moneda con api de JS
    const formatter = new Intl.NumberFormat('es-CL', {
      style: 'currency',
      currency: 'CLP',
      minimumFractionDigits: 0
    })

    $(function() {
      /* ChartJS
       * -------
       * Here we will create a few charts using ChartJS
       */

      var areaChartData = {
        labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio'],
        datasets: [{
            label: 'Ingresos',
            fillColor: 'rgba(210, 214, 222, 1)',
            strokeColor: 'rgba(210, 214, 222, 1)',
            pointColor: 'rgba(210, 214, 222, 1)',
            pointStrokeColor: '#c1c7d1',
            pointHighlightFill: '#fff',
            pointHighlightStroke: 'rgba(220,220,220,1)',
            data: [1200000, 1400000, 1600000, 1800000, 1200000, 1400000, 1600000]
          },
          {
            label: 'Utilidades',
            fillColor: 'rgba(60,141,188,0.9)',
            strokeColor: 'rgba(60,141,188,0.8)',
            pointColor: '#3b8bba',
            pointStrokeColor: 'rgba(60,141,188,1)',
            pointHighlightFill: '#fff',
            pointHighlightStroke: 'rgba(60,141,188,1)',
            data: [1100000, 1300000, 1500000, 1700000, 1300000, 1500000, 1700000]
          }
        ]
      }

      //-------------
      //- BAR CHART -
      //-------------
      var barChartCanvas = $('#barChart').get(0).getContext('2d')
      var barChart = new Chart(barChartCanvas)
      var barChartData = areaChartData
      barChartData.datasets[1].fillColor = '#00a65a'
      barChartData.datasets[1].strokeColor = '#00a65a'
      barChartData.datasets[1].pointColor = '#00a65a'
      var barChartOptions = {
        //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
        scaleBeginAtZero: true,
        //Boolean - Whether grid lines are shown across the chart
        scaleShowGridLines: true,
        //String - Colour of the grid lines
        scaleGridLineColor: 'rgba(0,0,0,.05)',
        //Number - Width of the grid lines
        scaleGridLineWidth: 1,
        //Boolean - Whether to show horizontal lines (except X axis)
        scaleShowHorizontalLines: true,
        //Boolean - Whether to show vertical lines (except Y axis)
        scaleShowVerticalLines: true,
        //Boolean - If there is a stroke on each bar
        barShowStroke: true,
        //Number - Pixel width of the bar stroke
        barStrokeWidth: 2,
        //Number - Spacing between each of the X value sets
        barValueSpacing: 5,
        //Number - Spacing between data sets within X values
        barDatasetSpacing: 1,
        //String - A legend template
        legendTemplate: '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
        //Boolean - whether to make the chart responsive
        responsive: true,
        maintainAspectRatio: true
      }

      barChartOptions.datasetFill = false
      barChart.Bar(barChartData, barChartOptions)
    })

  </script>

</body>

</html>