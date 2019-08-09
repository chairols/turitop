$(document).ready(function () {
    var buttonCommon = {
        exportOptions: {
            format: {
                body: function (data, row, column, node) {
                    // Strip $ from salary column to make it numeric
                    return column === 5 ?
                            data.replace(/[$,]/g, '') :
                            data;
                }
            }
        }
    };
    $("#example").DataTable({
        "language": {
            "url": "/assets/plugins/DataTables-1.10.18/spanish.json"
        },
        dom: 'Bfrtip',
        "order": [[ 0, "desc" ]],
        buttons: [
            $.extend(true, {}, buttonCommon, {
                extend: 'copyHtml5',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5 ]
                }
            }),
            $.extend(true, {}, buttonCommon, {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5 ]
                }
            }),
            $.extend(true, {}, buttonCommon, {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5 ]
                }
            })
        ]
    });

});

