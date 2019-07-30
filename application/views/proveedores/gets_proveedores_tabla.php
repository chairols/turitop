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
                <td>&nbsp;</td>
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