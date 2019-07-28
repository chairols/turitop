$(document).ready(function () {

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