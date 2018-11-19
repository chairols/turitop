<div class="content-wrapper">
    <section class="content">
        <div class="box box-primary">
            <div class="box-header">
                <!--<form method="GET" action="/retenciones/listar/" class="input-group input-group-sm col-md-5">
                    <input class="form-control pull-left" name="proveedor" id="proveedor" placeholder="Buscar ..." type="text">
                    <div class="input-group-btn">
                        <button class="btn btn-default" type="submit">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </form>-->
                <div class="box-tools">
                    <ul class="pagination pagination-sm no-margin pull-right">
                        <?= $links ?>
                    </ul>
                </div>
            </div>
            <div class="box-body">
                <table class="table table-responsive table-striped table-condensed table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Código de Reserva</th>
                            <th>Servicio Contratado</th>
                            <th>Nombre Cliente</th>
                            <th>Moneda</th>
                            <th>Monto Total</th>
                            <th>Fecha</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($resultado as $res) { ?>
                            <tr>
                                <td><?= $res['short_id'] ?></td>
                                <td><?= $res['product_name'] ?></td>
                                <td><?= $res['client_data']['name']; ?></td>
                                <td><?= $res['currency'] ?></td>
                                <td><?= $res['total_price'] ?></td>
                                <td><?= $res['date_event'] ?></td>
                                <td>
                                    <a href="/reservas/modificar/<?= $res['short_id'] ?>/" class="hint--top-left hint--bounce hint--info" aria-label="Modificar">
                                        <button class="btn btn-primary btn-xs" type="button">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                    </a>
                                    <a href="/reservas/pdf/<?= $res['short_id'] ?>/" target="_blank" class="hint--top-left hint--bounce hint--error" aria-label="Ver PDF">
                                        <button class="btn btn-danger btn-xs" type="button">
                                            <i class="fa fa-file-pdf-o"></i>
                                        </button>
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="box-footer clearfix">
                <div class="pull-left">
                    <strong>Total <?= $total_rows ?> registros.</strong>
                </div>
                <div class="box-tools">
                    <ul class="pagination pagination-sm no-margin pull-right">
                        <?= $links ?>
                    </ul>
                </div>
            </div>
        </div>
    </section>
</div>