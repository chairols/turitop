$(document).ready(function () {
    gets_proveedores();
});

$("#agregar").click(function () {
    datos = {
        'proveedor': $("#proveedor").val(),
        'email': $("#email").val()
    };
    $.ajax({
        type: 'POST',
        url: '/proveedores/agregar_ajax/',
        data: datos,
        beforeSend: function () {
            $("#agregar").hide();
            $("#agregar_loading").show();
        },
        success: function (data) {
            $("#agregar_loading").hide();
            $("#agregar").show();

            resultado = $.parseJSON(data);
            if (resultado['status'] == 'error') {
                $.notify('<strong>' + resultado['data'] + '</strong>',
                        {
                            type: 'danger',
                            z_index: 2000
                        });
            } else if (resultado['status'] == 'ok') {
                $.notify('<strong>' + resultado['data'] + '</strong>',
                        {
                            type: 'success',
                            z_index: 2000
                        });
                $("#proveedor").val("");
                $("#email").val("");
                gets_proveedores();
            }
        },
        error: function (xhr) { // if error occured
            $("#agregar_loading").hide();
            $("#agregar").show();

            $.notify('<strong>Ha ocurrido el siguiente error:</strong><br>' + xhr.statusText,
                    {
                        type: 'danger',
                        z_index: 2000
                    });
        }
    });
});

function gets_proveedores() {
    $.ajax({
        type: 'POST',
        url: '/proveedores/gets_proveedores_tabla/',
        beforeSend: function () {
            $("#proveedores").hide();
            $("#proveedores-loading").show();
        },
        success: function (data) {
            $("#proveedores").html(data);
            $("#proveedores-loading").hide();
            $("#proveedores").show();
        },
        error: function (xhr) { // if error occured
            $("#proveedores-loading").hide();
            $("#proveedores").show();

            $.notify('<strong>Ha ocurrido el siguiente error:</strong><br>' + xhr.statusText,
                    {
                        type: 'danger',
                        z_index: 2000
                    });
        }
    });
}

function borrar(idproveedor, proveedor) {
    swal({
        title: "¿Está seguro?",
        text: "No podrá recuperar el proveedor " + proveedor + " si lo elimina",
        type: "warning",
        showCancelButton: true,
        cancelButtonText: "Cancelar",
        confirmButtonColor: "#dc3545",
        confirmButtonText: "Si, ¡Eliminar!",
        closeOnConfirm: false,
        showLoaderOnConfirm: true,
    }, function () {
        datos = {
            'idproveedor': idproveedor
        };

        $.ajax({
            type: 'POST',
            url: '/proveedores/borrar_ajax/',
            data: datos,
            beforeSend: function () {

            },
            success: function (data) {
                resultado = $.parseJSON(data);
                if (resultado['status'] == 'error') {
                    $.notify('<strong>Ha ocurrido el siguiente error:</strong><br>' + resultado['data'],
                            {
                                type: 'danger',
                                z_index: 2000
                            });
                } else if (resultado['status'] == 'ok') {
                    swal("¡Eliminado!", "El proveedor " + proveedor + " se ha eliminado correctamente.", "success");
                    gets_proveedores();
                }
            },
            error: function (xhr) { // if error occured
                $.notify('<strong>Ha ocurrido el siguiente error:</strong><br>' + xhr.statusText,
                        {
                            type: 'danger',
                            z_index: 2000
                        });
            }
        });
    });
}

function get_proveedor(idproveedor) {
    datos = {
        'idproveedor': idproveedor
    };
    $.ajax({
        type: 'POST',
        url: '/proveedores/get_where_json/',
        data: datos,
        beforeSend: function () {
            $("#idproveedor-modificar-modal").val("");
            $("#proveedor-modificar-modal").val("");
            $("#email-modificar-modal").val("");
            $("#proveedor-modificar-modal").attr("disabled", "");
            $("#email-modificar-modal").attr("disabled", "");
        },
        success: function (data) {
            $("#proveedor-modificar-modal").removeAttr("disabled");
            $("#email-modificar-modal").removeAttr("disabled");

            resultado = $.parseJSON(data);
            if (resultado['status'] == 'error') {
                $.notify('<strong>' + resultado['data'] + '</strong>',
                        {
                            type: 'danger',
                            z_index: 2000
                        });
            } else if (resultado['status'] == 'ok') {
                $("#idproveedor-modificar-modal").val(resultado['data']['idproveedor']);
                $("#proveedor-modificar-modal").val(resultado['data']['proveedor']);
                $("#email-modificar-modal").val(resultado['data']['email']);
            }
        },
        error: function (xhr) { // if error occured
            $.notify('<strong>Ha ocurrido el siguiente error:</strong><br>' + xhr.statusText,
                    {
                        type: 'danger',
                        z_index: 2000
                    });
        }
    });
}

$("#modificar").click(function () {
    datos = {
        'idproveedor': $("#idproveedor-modificar-modal").val(),
        'proveedor': $("#proveedor-modificar-modal").val(),
        'email': $("#email-modificar-modal").val()
    };
    $.ajax({
        type: 'POST',
        url: '/proveedores/modificar_ajax/',
        data: datos,
        beforeSend: function () {
            $("#modificar").hide();
            $("#modificar_loading").show();
        },
        success: function (data) {
            $("#modificar_loading").hide();
            $("#modificar").show();

            resultado = $.parseJSON(data);
            if (resultado['status'] == 'error') {
                $.notify('<strong>' + resultado['data'] + '</strong>',
                        {
                            type: 'danger',
                            z_index: 2000
                        });
            } else if (resultado['status'] == 'ok') {
                $.notify('<strong>' + resultado['data'] + '</strong>',
                        {
                            type: 'success',
                            z_index: 2000
                        });
                gets_proveedores();
            }
        },
        error: function (xhr) { // if error occured
            $("#modificar_loading").hide();
            $("#modificar").show();
            $.notify('<strong>Ha ocurrido el siguiente error:</strong><br>' + xhr.statusText,
                    {
                        type: 'danger',
                        z_index: 2000
                    });
        }
    });
});