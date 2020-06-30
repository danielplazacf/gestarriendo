// definimos el texto del boton btnSave
$('#btnSaveContrato').html('<i class="fa fa-check-circle"></i> Guardar');
$('#btnSavePagos').html('<i class="fa fa-check-circle"></i> Guardar');
$('#btnSaveCobros').html('<i class="fa fa-check-circle"></i> Guardar');

// definimos el texto del boton btnEdit
$('#btnEditContrato').html('<i class="fa fa-check-circle"></i> Editar');
$('#btnEditPagos').html('<i class="fa fa-check-circle"></i> Editar');
$('#btnEditCobros').html('<i class="fa fa-check-circle"></i> Editar');

// definimos el texto para saveMovimiento
$('#btnSaveMove').html('<i class="fa fa-check-circle"></i> Guardar');
// definimos el tipo de moneda con api de JS
const formatter = new Intl.NumberFormat('es-CL', {
  style: 'currency',
  currency: 'CLP',
  minimumFractionDigits: 0
})
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

// button status contrato
$('#pay_edit').bootstrapToggle({
  on: 'Activado',
  off: 'Desactivado',
  width: '45%',
  onstyle: 'success input-group',
  offstyle: 'danger input-group'
})

// funcion que cambia el valor del checkbox
$('#pay_edit').change(function() {
  if ($(this).prop('checked')) {
    $('#hidden_recurrent_edit').val('1');
  } else {
    $('#hidden_recurrent_edit').val('0');
  }
});

// button pay_recurrent pago
$('#pay_recurrent_p').bootstrapToggle({
  on: 'Si',
  off: 'No',
  onstyle: 'success input-group',
  offstyle: 'danger input-group'
})

$('#pay_recurrent_p').change(function() {
  if ($(this).prop('checked')) {
    $('#hidden_recurrent_p').val('1');
  } else {
    $('#hidden_recurrent_p').val('0');
  }
})

// button status contrato
$('#pay_edit_p').bootstrapToggle({
  on: 'Activado',
  off: 'Desactivado',
  width: '45%',
  onstyle: 'success input-group',
  offstyle: 'danger input-group'
})

// funcion que cambia el valor del checkbox
$('#pay_edit_p').change(function() {
  if ($(this).prop('checked')) {
    $('#hidden_recurrent_edit_p').val('1');
  } else {
    $('#hidden_recurrent_edit_p').val('0');
  }
});

// Reemplaza texto de parrafo luego de on.(change)
$(function() {
  var texto = ['<strong>Contrato de Administración Simple</strong>____ El contrato de <u>administración simple</u> indica que los abonos del mismo, tienen el siguiente flujo: <ul><li>Arrendatario <i class="fas fa-angle-double-right"></i> Propietario // Propietario <i class="fas fa-angle-double-right"></i> GestArriendo</li></ul>', '<strong> Contrato de Administración Completa</strong>____ El contrato de <u>administración completa</u> indica que los abonos del mismo, tienen el siguiente flujo: <ul><li>Arrendatario <i class="fas fa-angle-double-right"></i> Gestarriendo // Gestarriendo <i class="fas fa-angle-double-right"></i> Propietario</li></ul>'];

  $('.tipo_contrato').on('change', function() {
    var index = $(this).val();
    $("#desc_contrato").html(texto[index]);
  })
})

$(document).ready(function() {
  //timeline
  $('.timeline').timeline({
    verticalStartPosition: 'right',
  });

  cargarContratos();
  cargarCobrosP();
  cargarPagosP();
  addContrato();
  addCobroSimple();
  addPagos();
  addMoveProperty();
  editContrato();
  editCobro();
  editPago();
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
          return '<b>RG:</b> ' + data.receptor_garantia + '<br>' + formatter.format(data.garantia_contrato);
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
            return '<label class="label label-warning">Cobro único</label>'
          }
        }
      },
      //5
      {
        "mData": function(data, type, dataToSet) {
          return formatter.format(data.amount_csimple);
        }
      },

      {
        "mData": function(data, type, dataToSet) {
            return data.venc_csimple + ' de cada mes';
        }
      },
    
      {
        "mData": function(data, type, dataToSet) {
          // return "<div class='btn-group'><button button='button' onclick='mostrarProperty(" + data + ");' class='btn bg-olive' data-toggle='modal' data-target='#modalEditProperty'><i class='fa fa-edit'></i></button><a href='fichaProperty.php?property="+ data +"' class='btn btn-default'><i class='fa fa-eye'></i></a><button type='button' onclick='deleteProperty(" + data + ");' class='btn btn-danger'><i class='fa fa-trash'></i></button></div>"

          return "<!-- Single button --><div class='ocultar-elemento btn-group'><button type='button' class='btn btn-primary dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>Mostrar <span class='caret'></span></button><ul class='dropdown-menu'><li><a href='' onclick='mostrarCobro(" + data.id_cobro_property + ");' data-toggle='modal' data-target='#modalEditCobro'><i class='fa fa-edit'></i>Editar</a></li><li><a herf='' onclick='deleteCobro(" + data.id_cobro_property + ");'><i class='fa fa-trash'></i> Eliminar</a></li></ul></div>"
        }
      }

    ],
    "language": idioma_spanol
  });

}

// Cargamos la lista de propiedades en relación al propietario
cargarPagosP = function() {
  // Obtenemos el valor por el id
  id_property = document.getElementById("id_property").value;
  //console.log(id_property);

  var table = $("#tablePagosP").dataTable({
    "destroy": true,
    "order": [], //[[ 0, "desc" ]],
    "paging": true,
    "lengthChange": false,
    "searching": false,
    "ordering": false,
    "info": true,
    "autoWidth": true,
    "ajax": {
      "url": "model/listPagosPropertyModel.php?id_property=" + id_property,
      "method": "POST"
    },
    "aoColumns": [

      //1
      {
        "mData": function(data, type, dataToSet) {
          return data.desde_pago;
        }
      },
      //2
      {
        "mData": function(data, type, dataToSet) {
          return data.hacia_pago;
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
            return '<label class="label label-success">Pago recurrente</label>'
          } else if (data.hidden_recurrent === '0') {
            return '<label class="label label-warning">Pago único</label>'
          }
        }
      },
      //5
      {
        "mData": function(data, type, dataToSet) {
          return formatter.format(data.amount_psimple);
        }
      },

      {
        "mData": function(data, type, dataToSet) {
            return data.venc_psimple + ' de cada mes';
        }
      },

      {
        "mData": function(data, type, dataToSet) {
          // return "<div class='btn-group'><button button='button' onclick='mostrarProperty(" + data + ");' class='btn bg-olive' data-toggle='modal' data-target='#modalEditProperty'><i class='fa fa-edit'></i></button><a href='fichaProperty.php?property="+ data +"' class='btn btn-default'><i class='fa fa-eye'></i></a><button type='button' onclick='deleteProperty(" + data + ");' class='btn btn-danger'><i class='fa fa-trash'></i></button></div>"

          return "<!-- Single button --><div class='ocultar-elemento btn-group'><button type='button' class='btn btn-primary dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>Mostrar <span class='caret'></span></button><ul class='dropdown-menu'><li><a href='' onclick='mostrarPago(" + data.id_pago_property + ");' data-toggle='modal' data-target='#modalEditPago'><i class='fa fa-edit'></i>Editar</a></li><li><a herf='' onclick='deletePago(" + data.id_pago_property + ");'><i class='fa fa-trash'></i> Eliminar</a></li></ul></div>"
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

var mostrarCobro = function(id_cobro_property) {

  if (!/^([0-9])*$/.test(id_cobro_property)) {
    return false
  } else {
    $.ajax({
      url: "model/searchCobro.php",
      method: "POST",
      dataType: "json",
      data: {
        id_cobro_property: id_cobro_property
      },
      success: function(datos) {
        $('#id_cobro_property').val(datos.id_cobro_property);
        $('#desde_edit').val(datos.desde_cobro);
        $('#hacia_edit').val(datos.hacia_cobro);
        $('#account_bank_edit').val(datos.account_bank);
        $('#concepto_edit').val(datos.concepto_csimple);

        $('#hidden_recurrent_edit').val(datos.hidden_recurrent);
        if (datos.hidden_recurrent === '1') {
          $('#pay_edit').bootstrapToggle('on');
        } else if (datos.hidden_recurrent === '0') {
          $('#pay_edit').bootstrapToggle('off');
        }

        $('#account_edit_c').val(datos.account_edit_c);
        $('#amount_edit').val(datos.amount_csimple);
        $('#venc_edit').val(datos.venc_csimple);
      }
    });
  }
}

var mostrarPago = function(id_pago_property) {

  if (!/^([0-9])*$/.test(id_pago_property)) {
    return false
  } else {
    $.ajax({
      url: "model/searchPago.php",
      method: "POST",
      dataType: "json",
      data: {
        id_pago_property: id_pago_property
      },
      success: function(datos) {
        $('#id_pago_property').val(datos.id_pago_property);
        $('#desde_edit_p').val(datos.desde_pago);
        $('#hacia_edit_p').val(datos.hacia_pago);
        $('#concepto_edit_p').val(datos.concepto_csimple);
        $("#account_edit_p").val(datos.bankaccount);
        $('#hidden_recurrent_edit_p').val(datos.hidden_recurrent);
        if (datos.hidden_recurrent === '1') {
          $('#pay_edit_p').bootstrapToggle('on');
        } else if (datos.hidden_recurrent === '0') {
          $('#pay_edit_p').bootstrapToggle('off');
        }

        $('#amount_edit_p').val(datos.amount_psimple);
        $('#venc_edit_p').val(datos.venc_psimple);
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

var deleteCobro = function(id_cobro_property) {

  if (!/^([0-9])*$/.test(id_cobro_property)) {
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
            url: "model/deleteCobro.php",
            method: "POST",
            data: {
              id_cobro_property: id_cobro_property
            },
            success: function(data) {
              if (data == 'ok') {
                location.reload();
                cargarCobrosP();
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

var deletePago = function(id_pago_property) {

  if (!/^([0-9])*$/.test(id_pago_property)) {
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
            url: "model/deletePago.php",
            method: "POST",
            data: {
              id_pago_property: id_pago_property
            },
            success: function(data) {
              if (data == 'ok') {
                swal("Eliminado! El registro fue eliminado.", {
                  icon: "success",
                });
                cargarPagosP();
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

var deleteMovement = function(id_mov_property) {

  if (!/^([0-9])*$/.test(id_mov_property)) {
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
            url: "model/deleteMovProperty.php",
            method: "POST",
            data: {
              id_mov_property: id_mov_property
            },
            success: function(data) {
              if (data == 'ok') {
                location.reload();
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
      beforeSend: function() {
        $('#btnEditContrato').attr('disabled', true);
        $('#btnEditContrato').html('<i class="fas fa-spin fa-spinner"></i>');
      },
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
          $('#btnEditContrato').removeAttr('disabled');
          $('#btnEditContrato').html('<i class="fa fa-check-circle"></i> Editar');
          location.reload();
          //$('#modalAddCobro').modal('show');
          // console.log('Exitazooooooo');
        } else if (data == 'error') {
          swal({
            title: "Algo salio mal!",
            text: "Intentalo nuevamente, no puedes incluir campos vacios, ni caracteres extraños.",
            icon: "error",
            button: "Cerrar",
          });
          $('#editContrato')[0].reset();
          $('#modalEditContrato').modal('hide');
          $('#btnEditContrato').removeAttr('disabled');
          $('#btnEditContrato').html('<i class="fa fa-check-circle"></i> Editar');
        } else {
          console.log(data);
        }
      }
    });
  });
}

var editCobro = function(id_cobro_property) {
  $('#editCobro').submit(function(e) {
    var datos = $(this).serialize();
    e.preventDefault();
    //console.log(datos);

    $.ajax({
      type: "POST",
      url: "model/editCobroModel.php",
      data: datos,
      beforeSend: function() {
        $('#btnEditCobros').attr('disabled', true);
        $('#btnEditCobros').html('<i class="fas fa-spin fa-spinner"></i>');
      },
      success: function(data) {
        if (data == 'ok') {
          swal({
            title: "Actualizado!",
            text: "El registro fue actualizado satisfactoriamente.",
            icon: "success",
            button: "Ok",
          });
          cargarCobrosP();
          $('#editCobro')[0].reset();
          $('#modalEditCobro').modal('hide');
          location.reload();
          //$('#modalAddCobro').modal('show');
          // console.log('Exitazooooooo');
        } else if (data == 'error') {
          swal({
            title: "Algo salio mal!",
            text: "Intentalo nuevamente, no puedes incluir campos vacios, ni caracteres extraños.",
            icon: "error",
            button: "Cerrar",
          });
          $('#editCobro')[0].reset();
          $('#modalEditCobro').modal('hide');
          $('#btnSaveContrato').removeAttr('disabled');
          $('#btnSaveContrato').html('<i class="fa fa-check-circle"></i> Guardar');
        } else {
          console.log(data);
        }
      }
    });
  });
}

var editPago = function(id_pago_property) {
  $('#editPago').submit(function(e) {
    var datos = $(this).serialize();
    e.preventDefault();
    //console.log(datos);

    $.ajax({
      type: "POST",
      url: "model/editPagoModel.php",
      data: datos,
      beforeSend: function() {
        $('#btnEditPagos').attr('disabled', true);
        $('#btnEditPagos').html('<i class="fas fa-spin fa-spinner"></i>');
      },
      success: function(data) {
        if (data.trim() == 'ok') {
          swal({
            title: "Actualizado!",
            text: "El registro fue actualizado satisfactoriamente.",
            icon: "success",
            button: "Ok",
          });
          cargarPagosP();
          $('#editPago')[0].reset();
          $('#modalEditPago').modal('hide');
          location.reload();
          //$('#modalAddCobro').modal('show');
          // console.log('Exitazooooooo');
        } else if (data == 'error') {
          swal({
            title: "Algo salio mal!",
            text: "Intentalo nuevamente, no puedes incluir campos vacios, ni caracteres extraños.",
            icon: "error",
            button: "Cerrar",
          });
          $('#editPago')[0].reset();
          $('#modalEditPago').modal('hide');
          $('#btnSaveContrato').removeAttr('disabled');
          $('#btnSaveContrato').html('<i class="fa fa-check-circle"></i> Guardar');
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
      beforeSend: function() {
        $('#btnSaveContrato').attr('disabled', true);
        $('#btnSaveContrato').html('<i class="fas fa-spin fa-spinner"></i>');
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
          location.reload();
          // console.log('Exitazooooooo');
        } else if (data == 'error') {
          swal({
            title: "Algo salio mal!",
            text: "Un campo esta vacío, recuerda registrar todos los datos.",
            icon: "error",
            button: "Cerrar",
          });
          $('#addContrato')[0].reset();
          $('#modalAddContrato').modal('hide');
          $('#btnSaveContrato').removeAttr('disabled');
          $('#btnSaveContrato').html('<i class="fa fa-check-circle"></i> Guardar');
        } else {
          console.log(data);
        }
      }
    });
  });
}

var addMoveProperty = function() {
  $('#addMoveProperty').submit(function(e) {
    e.preventDefault();
    var datos = $(this).serialize();
    //console.log(datos);
    $.ajax({
      type: "POST",
      url: "model/addMovePropertyModel.php",
      data: datos,
      beforeSend: function() {
        $('#btnSaveMove').attr('disabled', true);
        $('#btnSaveMove').html('<i class="fas fa-spin fa-spinner"></i>');
      },
      success: function(data) {
        if (data == 'ok') {
          location.reload();
          // console.log('Exitazooooooo');
        } else if (data == 'error') {
          swal({
            title: "Algo salio mal!",
            text: "Un campo esta vacío, recuerda registrar todos los datos.",
            icon: "error",
            button: "Cerrar",
          });
          $('#addMoveProperty')[0].reset();
          $('#modalAddMoveProperty').modal('hide');
          $('#btnSaveMove').removeAttr('disabled');
          $('#btnSaveMove').html('<i class="fa fa-check-circle"></i> Guardar');
        } else {
          console.log(data);
        }
      }
    });
  })
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
      beforeSend: function() {
        $('#btnSaveCobros').attr('disabled', true);
        $('#btnSaveCobros').html('<i class="fas fa-spin fa-spinner"></i>');
      },
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
          location.reload();
          // console.log('Exitazooooooo');
        } else if (data == 'error') {
          swal({
            title: "Algo salio mal!",
            text: "Un campo esta vacío, recuerda registrar todos los datos.",
            icon: "error",
            button: "Cerrar",
          });
          $('#addCobroSimple')[0].reset();
          $('#modalCobroSimple').modal('hide');
          $('#btnSaveCobros').removeAttr('disabled');
          $('#btnSaveCobros').html('<i class="fa fa-check-circle"></i> Guardar');
        } else {
          console.log(data);
        }
      }
    });
  });
}

var addPagos = function() {
  $('#addPagos').submit(function(e) {
    e.preventDefault();
    var datos = $(this).serialize();
    //console.log(datos);

    $.ajax({
      type: "POST",
      url: "model/addPagosPropertyModel.php",
      data: datos,
      beforeSend: function() {
        $('#btnSavePagos').attr('disabled', true);
        $('#btnSavePagos').html('<i class="fas fa-spin fa-spinner"></i>');
      },
      success: function(data) {
        if (data == 'ok') {
          swal({
            title: "Buen Trabajo!",
            text: "El registro fue ingresado satisfactoriamente.",
            icon: "success",
            button: "Ok",
          });
          cargarPagosP();
          $('#addPagos')[0].reset();
          $('#modalPagos').modal('hide');
          location.reload();
          // console.log('Exitazooooooo');
        } else if (data == 'error') {
          swal({
            title: "Algo salio mal!",
            text: "Un campo esta vacío, recuerda registrar todos los datos.",
            icon: "error",
            button: "Cerrar",
          });
          $('#addPagos')[0].reset();
          $('#modalPagos').modal('hide');
          $('#btnSavePagos').removeAttr('disabled');
          $('#btnSavePagos').html('<i class="fa fa-check-circle"></i> Guardar');
          //location.reload();
        } else {
          console.log(data);
        }
      }
    });
  });
}

// mostrar cuenta cobro desde
$(function() {
  $('#c_account_bank').hide();

  $('#desde_cobro').change(function() {
    if ($('#desde_cobro').val() == 'Gestarriendo') {
      $('#c_account_bank').show();
    } else {
      $('#c_account_bank').hide();
    }
  });

  $('#hacia_cobro').change(function() {
    if ($('#hacia_cobro').val() == 'Gestarriendo') {
      $('#c_account_bank').show();
    } else {
      $('#c_account_bank').hide();
    }
  });
});

// Botones tabs
$('.btnNext').click(function() {
  $('.nave-tabs > .active').next('li').find('a').trigger('click');
});

$('.btnPrevious').click(function() {
  $('.nave-tabs > .active').prev('li').find('a').trigger('click');
});