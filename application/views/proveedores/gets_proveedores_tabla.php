<table id="datatable" class="table table-bordered table-striped dataTable">
    <thead>
        <tr>
            <th>Proveedor</th>
            <th>Email</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($proveedores as $proveedor) { ?>
            <tr>
                <td><?= $proveedor['proveedor'] ?></td>
                <td><?= $proveedor['email'] ?></td>
                <td>
                    <button class="btn btn-primary btn-xs hint--top hint--bounce hint--info" type="button" data-toggle="modal" data-target="#modal-modificar" aria-label="Modificar" onclick="get_proveedor(<?=$proveedor['idproveedor']?>);">
                        <i class="fa fa-edit"></i>
                    </button>
                    <button class="btn btn-danger btn-xs hint--top hint--bounce hint--error" aria-label="Eliminar" onclick="borrar(<?= $proveedor['idproveedor'] ?>, '<?= $proveedor['proveedor'] ?>');">
                        <i class="fa fa-trash-o"></i>
                    </button>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<script type="text/javascript">
    $(document).ready(function () {
        $("#datatable").DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
            }
        });
    })
</script>