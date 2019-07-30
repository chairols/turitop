<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Proveedores
        </h1>
        <ol class="breadcrumb">
            <li><a href="/proveedores/administrar/"><i class="fa fa-users"></i> Proveedores</a></li>
        </ol>
    </section>

    <section class="content">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">Agregar Proveedor</button>
        <hr>
        <div class="box box-primary box-solid">
            <div class="box-body">
                <div id="proveedores-loading" style="display: none;">
                    <h1 class="text-center">
                        <i class="fa fa-refresh fa-spin"></i>
                    </h1>
                </div>
                <div id="proveedores"></div>
            </div>
        </div>

    </section>
</div>


<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Agregar Proveedor</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Proveedor</label>
                    <input type="text" class="form-control" id="proveedor">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" class="form-control" id="email">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="agregar">Agregar</button>
                <button type="button" class="btn btn-primary" id="agregar_loading" style="display: none;">
                    <i class="fa fa-refresh fa-spin"></i>
                </button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

