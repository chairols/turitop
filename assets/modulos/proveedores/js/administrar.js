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