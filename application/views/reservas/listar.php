<div class="content-wrapper">
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
                        <th>short_id</th>
                        <th>product_name</th>
                        <th>name</th>
                        <th>currency</th>
                        <th>total_price</th>
                        <th>date_event</th>
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
                                <a href="/reservar/modificar/<?=$res['short_id']?>/" class="hint--top-left hint--bounce hint--info" aria-label="Modificar">
                                    <button class="btn btn-primary btn-xs" type="button">
                                        <i class="fa fa-edit"></i>
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
    <pre>
        <?php //print_r($resultado); ?>
    </pre>
</div>