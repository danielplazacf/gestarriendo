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
          <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#modalAddProperty">
            <i class="fa fa-plus-circle"></i> Nueva Administración
          </button>

        </h1>
      </section>

      <!-- Main content -->
      <section class="content container-fluid">

        

        <div class="row">
        <?php
          $statement = $con->prepare("SELECT * FROM tbl_property_system ORDER BY date_register ASC");
          $statement->execute();
          while ($rowProperty = $statement->fetch()){
        ?>
          <div class="col-md-4 col-xs-12">
            <div class="box box-widget widget-user">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header bg-blue-active">
              
                <div class="row">
                  <div class="col-md-4">
                    <img src="resources/dist/img/img_property.png" width="100%">
                  </div>
                  <div class="col-md-8">
                    <h3 class="widget-user-username">
                      <a href="fichaProperty.php?id_property=<?php echo $rowProperty['id_property'];?>" class="text-white">
                        <?php echo $rowProperty['address_property'];?>
                      </a>
                    </h3>
                    <h5 class="widget-user-desc"><?php echo $rowProperty['type_property'];?></h5>
                    <a href="fichaProperty.php?id_property=<?php echo $rowProperty['id_property'];?>" class="btn btn-sm btn-primary">Ingresar</a>
                    <a onclick="deleteProperty(<?php echo $rowProperty['id_property'];?>)" class="btn btn-sm btn-danger pull-right"><i class="fas fa-trash"></i></a>
                  </div>
                </div>
              </div>
              <div class="box-footer pt-0">
                <?php if(isset($rowProperty['id_property'])): ?>
                <?php
                  $key = $rowProperty['id_property'];
                  $stmt = $con->prepare("SELECT * FROM tbl_contrato_system WHERE id_property = '$key'");
                  $stmt->execute();
                  $rowContrato= $stmt->fetch();
                ?>
                <div class="row">
                  <div class="col-md-12">
                    <div class="description-block bg-yellowlight">
                      <h5 class="description-header py-3 px-3 text-left">
                      <?php 
                        @$originalDate = $rowContrato['fecha_inicio'];
                        @$arrendatario = $rowContrato['name_leaser'];
                        if(empty($arrendatario) AND empty($originalDate)){
                          $leaser = 'Sin Arrendatario';
                          $newDate = 'Sin contrato de arriendo';
                        }else{
                          $leaser = $rowContrato['name_leaser'];
                          $newDate = date("d/m/Y", strtotime($originalDate));
                        }
                      ?>
                        <b>Arrendatario:</b> <?php echo $leaser;?> <br>
                        <b>En arriendo desde:</b> <?php echo $newDate;?>
                      </h5>
                      
                    </div>
                  </div>
                </div>
                <?php endif; ?>
                <!-- /.row -->
              </div>
            </div>
          </div>
        <?php } ?>
        </div>
        <!-- /.row -->
      </section>
      <!-- /.content -->

    </div>
    <!-- /.content-wrapper -->

    <!-- ADD PROPERTY SYSTEM MODAL -->
    <div class="modal fade" id="modalAddProperty" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title text-center" id="myModalLabel">REGISTRO DE PROPIEDAD</h4>
          </div>
          <div class="modal-body">
            <form id="addProperty" method="POST">
              <input type="hidden" id="agent_designated" name="agent_designated" value="<?php nameUser($_SESSION['user_system']); ?>">
              <input type="hidden" id="date_register" name="date_register" value="<?php echo date('Y-m-d'); ?>">
              <div class="row">
                <div class="col-xs-6 col-lg-6">
                  <div class="form-group">
                    <label>Selecciona tipo de propiedad:</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-home"></i>
                      </div>
                      <select style="text-transform: capitalize;" name="type_property" id="type_property" class="form-control select2" required>
                        <option></option>
                        <option value="Casa">Casa</option>
                        <option value="Departamento">Departamento</option>
                        <option value="Oficina">Oficina</option>
                        <option value="Local">Local</option>
                        <option value="Terreno">Terreno</option>
                        <option value="Bodega">Bodega</option>
                        <option value="Estacionamiento">Estacionamiento</option>
                        <option value="Bodega y Estacionamiento">Bodega y Estacionamiento</option>
                        <option value="Otro">Otro</option>
                      </select>
                    </div>
                    <!-- /.input group -->
                  </div>
                </div>
                <div class="col-xs-6 col-lg-6">
                  <div class="form-group">
                    <label>Fecha Inicio Administración:</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fas fa-calendar"></i>
                      </div>
                      <input id="date_administracion" name="date_administracion" type="date" class="form-control" required>
                    </div>
                  </div>
                </div>
                <div class="col-xs-12 col-lg-6">
                  <div class="form-group">
                    <label>Indique la dirección del inmueble:</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-map-marker"></i>
                      </div>
                      <input name="address_property" id="address_property" type="text" class="form-control" autocomplete="none" placeholder="Ej: Avenida Providencia #111" required>
                    </div>
                    <!-- /.input group -->
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-6">
                  <div class="form-group">
                    <label>Seleccione la región:</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-filter"></i>
                      </div>
                      <select style="text-transform: capitalize;" name="region_property" id="region_property" class="form-control select2" required>
                        <option></option>
                        <?php
                        $selregion = 'SELECT * FROM tbl_regiones_system';
                        $q = $con->query($selregion);
                        // While para repetir todos los campos dentro de la base de datos
                        while ($region = $q->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                          <option value="<?php echo $region['id_region']; ?>"><?php echo $region['name_region']; ?></option>
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
                    <label>Seleccione la comuna:</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-filter"></i>
                      </div>
                      <select style="text-transform: capitalize;" name="comuna_property" id="comuna_property" class="form-control select2" required disabled>
                      </select>
                    </div>
                    <!-- /.input group -->
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-xs-12">
                  <div class="alert alert-warning" role="alert">
                    <strong>Cuidado!</strong> La información de <b>región</b> y <b>comuna</b>, no se puede editar <u>posteriormente</u>.
                  </div>
                </div>
              </div>

              <hr>

              <div class="row">
                <div class="col-xs-4">
                  <div class="form-group">
                    <label>N° Aguas Andinas</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-tint"></i>
                      </div>
                      <input name="n_cliente_agua" id="n_cliente_agua" type="text" class="form-control" autocomplete="none" placeholder="N° de cliente" required>
                    </div>
                    <!-- /.input group -->
                  </div>
                </div>

                <div class="col-xs-4">
                  <div class="form-group">
                    <label>N° Enel</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-bolt"></i>
                      </div>
                      <input name="n_cliente_luz" id="n_cliente_luz" type="text" class="form-control" autocomplete="none" placeholder="N° de cliente" required>
                    </div>
                    <!-- /.input group -->
                  </div>
                </div>

                <div class="col-xs-4">
                  <div class="form-group">
                    <label>N° MetroGas</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-fire"></i>
                      </div>
                      <input name="n_cliente_gas" id="n_cliente_gas" type="text" class="form-control" autocomplete="none" placeholder="N° de cliente" required>
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

    <!-- EDIT PROPERTY SYSTEM MODAL -->
    <div class="modal fade" id="modalEditProperty" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title text-center" id="myModalLabel">EDITAR PROPIEDAD</h4>
          </div>
          <div class="modal-body">
            <form id="editProperty" method="POST">
              <input type="hidden" id="agent_edit" name="agent_edit" value="<?php nameUser($_SESSION['user_system']); ?>">
              <input type="hidden" id="date_edit" name="date_edit" value="<?php echo date('Y-m-d'); ?>">
              <input type="hidden" id="id_property" name="id_property">

              <div class="row">
                <div class="col-xs-6 col-lg-6">
                  <div class="form-group">
                    <label>Selecciona tipo de propiedad:</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-home"></i>
                      </div>
                      <select style="text-transform: capitalize;" name="type_edit" id="type_edit" class="form-control" required>
                        <option value="Casa">Casa</option>
                        <option value="Departamento">Departamento</option>
                        <option value="Oficina">Oficina</option>
                        <option value="Local">Local</option>
                        <option value="Terreno">Terreno</option>
                        <option value="Bodega">Bodega</option>
                        <option value="Estacionamiento">Estacionamiento</option>
                        <option value="Bodega y Estacionamiento">Bodega y Estacionamiento</option>
                        <option value="Otro">Otro</option>
                      </select>
                    </div>
                    <!-- /.input group -->
                  </div>
                </div>
                <div class="col-xs-6 col-lg-6">
                  <div class="form-group">
                    <label>Fecha Inicio Administración:</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fas fa-calendar"></i>
                      </div>
                      <input id="date_admin_edit" name="date_admin_edit" type="date" class="form-control">
                    </div>
                  </div>
                </div>
                <div class="col-xs-12">
                  <div class="form-group">
                    <label>Indique la dirección del inmueble:</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-map-marker"></i>
                      </div>
                      <input type="text" name="address_edit" id="address_edit" class="form-control" autocomplete="none" placeholder="Ej: Avenida Providencia #111" required>
                    </div>
                    <!-- /.input group -->
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-6">
                  <div class="form-group">
                    <label>Seleccione la región:</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-filter"></i>
                      </div>
                        <input name="region_edit" id="region_edit" class="form-control" readonly>
                    </div>
                    <!-- /.input group -->
                  </div>
                </div>

                <div class="col-xs-6">
                  <div class="form-group">
                    <label>Seleccione la comuna:</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-filter"></i>
                      </div>
                      <input name="comuna_edit" id="comuna_edit" class="form-control" readonly>
                    </div>
                    <!-- /.input group -->
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-xs-12">
                  <div class="alert alert-warning" role="alert">
                    <strong>Lo siento!</strong> te recordamos que la información de <b>región</b> y <b>comuna</b>, no se puede editar.
                  </div>
                </div>
              </div>

              <hr>

              <div class="row">
                <div class="col-xs-4">
                  <div class="form-group">
                    <label>N° Aguas Andinas</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-tint"></i>
                      </div>
                      <input type="text" name="agua_edit" id="agua_edit" class="form-control" autocomplete="none" placeholder="N° de cliente" required>
                    </div>
                    <!-- /.input group -->
                  </div>
                </div>

                <div class="col-xs-4">
                  <div class="form-group">
                    <label>N° Enel</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-bolt"></i>
                      </div>
                      <input type="text" name="luz_edit" id="luz_edit" class="form-control" autocomplete="none" placeholder="N° de cliente" required>
                    </div>
                    <!-- /.input group -->
                  </div>
                </div>

                <div class="col-xs-4">
                  <div class="form-group">
                    <label>N° MetroGas</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-fire"></i>
                      </div>
                      <input type="text" name="gas_edit" id="gas_edit" class="form-control" autocomplete="none" placeholder="N° de cliente" required>
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
      cargarProperty();
      addProperty();
      editProperty();

      // Cargamos comunas al seleccionar region
      $(function() {

        var comuna = $('#comuna_property');
        //Ejecutamos la funcion change()
        $('#region_property').change(function() {
          var region_id = $(this).val();
          //console.log(region_id);

          if (region_id != '') {
            $.ajax({
              data: {
                region: region_id
              },
              dataType: 'html',
              type: 'POST',
              url: 'model/regionesJson.php'
            }).done(function(data) {
              comuna.html(data);
              comuna.prop('disabled', false); //habilitar el select
            });

          } else {
            comuna.val('');
            comuna.prop('disabled', true); //deshabilitar el select
          }

        })
      })

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
    cargarProperty = function() {
      // Obtenemos el valor por el id
      // id_property = document.getElementById("id_owner_property").value;

      $("#tableProperty").dataTable({
        "destroy": true,
        "processing": true,
        "order": [], //[[ 0, "desc" ]],
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": false,
        "info": true,
        "autoWidth": true,
        "ajax": {
          "url": "model/listPropertyModel.php",
          "method": "POST"
        },
        "aoColumns": [

          //1
          {
            "mData": function(data, type, dataToSet) {
              return '<a class="text-bold" href="fichaProperty.php?id_property='+ data.id_property +'"><i class="fas fa-eye"></i> Ver Ficha</a><br><b>ID:' + data.id_property + '</b><br>' + data.agent_designated + "<br>" + moment(data.date_register).format('D/M/Y');
            }
          },
          //2
          {
            "mData": function(data, type, dataToSet) {
              return data.type_property;
            }
          },
          //3
          {
            "mData": function(data, type, dataToSet) {
              return data.address_property;
            }
          },
          //4
          {
            "mData": function(data, type, dataToSet) {
              return data.comuna_property + '<br>' + data.region_property;
            }
          },
          //5
          {
            "mData": function(data, type, dataToSet) {
              return "<b>N° Agua:</b> " + data.n_client_agua + "<br><b>N° Luz:</b> " + data.n_client_luz + " <br><b>N° Gas:</b> " + data.n_client_gas;
            }
          },
          //6
          // { "mData": function (data, type, dataToSet) {
          //  return "DNG-"+ data.bank;}
          // },
          {
            "mData": function(data, type, dataToSet) {
              // return "<div class='btn-group'><button button='button' onclick='mostrarProperty(" + data + ");' class='btn bg-olive' data-toggle='modal' data-target='#modalEditProperty'><i class='fa fa-edit'></i></button><a href='fichaProperty.php?property="+ data +"' class='btn btn-default'><i class='fa fa-eye'></i></a><button type='button' onclick='deleteProperty(" + data + ");' class='btn btn-danger'><i class='fa fa-trash'></i></button></div>"

              return "<!-- Single button --><div class='ocultar-elemento btn-group'><button type='button' class='btn btn-primary dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>Mostrar <span class='caret'></span></button><ul class='dropdown-menu'><li><a href='' onclick='mostrarProperty(" + data.id_property + ");' data-toggle='modal' data-target='#modalEditProperty'><i class='fa fa-edit'></i>Editar</a></li><li><a herf='' onclick='deleteProperty(" + data.id_property + ");'><i class='fa fa-trash'></i> Eliminar</a></li></ul></div>"
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


    var mostrarProperty = function(id_property) {

      if (!/^([0-9])*$/.test(id_property)) {
        return false
      } else {
        //console.log(id_property);
        $.ajax({
          url: "model/searchProperty.php",
          method: "POST",
          dataType: "json",
          data: {
            id_property: id_property
          },
          success: function(datos) {
            $('#id_property').val(datos.id_property);

            $('#type_edit').val(datos.type_property);
            $('#date_admin_edit').val(datos.date_administracion);
            $('#address_edit').val(datos.address_property);
            $('#region_edit').val(datos.region_property);
            $('#comuna_edit').val(datos.comuna_property);
            //
            $('#agua_edit').val(datos.n_client_agua);
            $('#luz_edit').val(datos.n_client_luz);
            $('#gas_edit').val(datos.n_client_gas);
            //
          },
          error: function (xhr, textStatus, errorMessage) {

            console.log("ERROR" + errorMessage + textStatus + xhr);

          }
        });
      }
    }

    var deleteProperty = function(id_property) {

      if (!/^([0-9])*$/.test(id_property)) {
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
                url: "model/deleteProperty.php",
                method: "POST",
                data: {
                  id_property: id_property
                },
                success: function(data) {
                  if (data == 'ok') {
                    swal("Eliminado! El registro fue eliminado.", {
                      icon: "success",
                    });
                    cargarProperty();
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

    var editProperty = function(id_property) {
      $('#editProperty').submit(function(e) {
        var datos = $(this).serialize();
        e.preventDefault();

        $.ajax({
          type: "POST",
          url: "model/editPropertyModel.php",
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
              cargarProperty();
              $('#editProperty')[0].reset();
              $('#modalEditProperty').modal('hide');
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
              $('#editProperty')[0].reset();
              $('#modalEditProperty').modal('hide');
              $('#btnEdit').removeAttr('disabled');
              $('#btnEdit').html('<i class="fa fa-check-circle"></i> Editar');
            } else {
              console.log(data);
            }
          }
        });
      });
    }

    //Script para añadir propiedad al registro
    var addProperty = function() {
      $('#addProperty').submit(function(e) {
        e.preventDefault();
        var datos = $(this).serialize();
        //console.log(datos);
        $.ajax({
          type: "POST",
          url: "model/addPropertyModel.php",
          data: datos,
          beforeSend: function(){
            $('#btnSave').attr('disabled', true);
            $('#btnSave').html('<i class="fas fa-spin fa-spinner"></i>');
          },
          success: function(data) {
            if (data == 'ok') {
              swal({
                title: "Buen Trabajo!",
                text: "El inmueble fue registrado.",
                icon: "success",
                button: "Ok",
              });
              cargarProperty();
              $('#addProperty')[0].reset();
              $('#modalAddProperty').modal('hide');
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
              $('#addProperty')[0].reset();
              $('#modalAddProperty').modal('hide');
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