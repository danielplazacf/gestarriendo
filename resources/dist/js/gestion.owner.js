$(document).ready(function () {
        cargarOwner();
        addOwner();
        editOwner();
    });

    cargarOwner = function () {
        $("#tableOwner").dataTable({
            "order": [[ 0, "desc" ]],
            "destroy": true,
            "ajax": {
                "method": "POST",
                "url": "model/listOwnerModel.php"
            },
            "columns": [
                {"data": "id_owner_property"},
                {"data": "name_owner"},
                {"data": "rut_owner"},
                {"data": "phone_owner"},
                {"data": "email_owner"},
                {"data": "obs_owner"},
                {
                    "data": "id_owner_property",
                    render: function (data, type, row) {
                        return "<div class='btn-group'><button button='button' onclick='mostrarOwner(" + data + ");' class='btn btn-default' data-toggle='modal' data-target='#modalEditOwner' ><i class='fa fa-pencil-square-o'></i></button><button type='button' onclick='deleteOwner(" + data + ");' class='btn btn-danger'><i class='fa fa-trash'></i></button></div>"
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

    var mostrarOwner = function (id_owner_property) {

        if (!/^([0-9])*$/.test(id_owner_property)) {
            return false
        } else {
            $.ajax({
                url: "model/searchOwner.php",
                method: "POST",
                dataType: "json",
                data: {id_owner_property: id_owner_property},
                success: function (datos) {
                    $('#id_owner').val(datos.id_owner_property);
                    $('#name_edit').val(datos.name_owner);
                    $('#rut_edit').val(datos.rut_owner);
                    $('#phone_edit').val(datos.phone_owner);
                    $('#email_edit').val(datos.email_owner);
                    $('#obs_edit').val(datos.obs_owner);
                }
            });
        }
    }

    var deleteOwner = function (id_owner_property) {

        if (!/^([0-9])*$/.test(id_owner_property)) {
            return false
        } else {

            swal({
              title: "¿Quieres eliminar el Registro?",
              text: "Una vez eliminado, no podras recuperarlo!",
              icon: "warning",
              buttons: ['Cancelar','Eliminar'],
              dangerMode: true,
            })

            .then((willDelete) => {
              if (willDelete) {
                $.ajax({
                    url: "model/deleteOwner.php",
                    method: "POST",
                    data: {id_owner_property: id_owner_property},
                    success: function (data) {
                        if (data == 'ok') {
                            swal("Eliminado! El registro fue eliminado.", {
                              icon: "success",
                            });
                            cargarOwner();
                        }
                    }
                });
                
              } else {
                swal("Que bien, no se ha eliminado el registro!");
              }
            });
        }
    }

    var editOwner = function (id_owner_property) {
        $('#editOwner').submit(function (e) {
            var datos = $(this).serialize();
            e.preventDefault();

            $.ajax({
                type: "POST",
                url: "model/editOwnerModel.php",
                data: datos,
                success: function (data) {
                    if (data == 'ok') {
                        swal({
                          title: "Actualizado!",
                          text: "El registro fue actualizado.",
                          icon: "success",
                          button: "Ok",
                        });
                        cargarOwner();
                        $('#editOwner')[0].reset();
                        $('#modalEditOwner').modal('hide');
                        // console.log('Exitazooooooo');
                    } else if (data == 'vacio') {
                        swal({
                          title: "Algo salio mal!",
                          text: "Intentalo nuevamente, no puedes incluir campos vacios, ni caracteres extraños.",
                          icon: "error",
                          button: "Cerrar",
                        });
                        $('#editOwner')[0].reset();
                        $('#modalEditOwner').modal('hide');
                    } else {
                        console.log(data);
                    }
                }
            });
        });
    }
    
    var addOwner = function () {
        $('#addOwner').submit(function (e) {
            e.preventDefault();
            var datos = $(this).serialize();
            $.ajax({
                type: "POST",
                url: "model/addOwner.php",
                data: datos,
                success: function (data) {
                    if (data == 'ok') {
                        swal({
                          title: "Registrado!",
                          text: "El propietario fue registrado.",
                          icon: "success",
                          button: "Ok",
                        });
                        cargarOwner();
                        $('#addOwner')[0].reset();
                        $('#modalAddOwner').modal('hide');
                        // console.log('Exitazooooooo');
                    } else if (data == 'vacio') {
                        swal({
                          title: "Algo salio mal!",
                          text: "Un campo esta vacio, recuerda registrar todos los datos.",
                          icon: "error",
                          button: "Cerrar",
                        });
                        $('#addOwner')[0].reset();
                        $('#modalAddOwner').modal('hide');
                    } else {
                        console.log(data);
                    }
                }
            });
        });
    }

    $(function() {
        $("#rut_owner").rut();
    })