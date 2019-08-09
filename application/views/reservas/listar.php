<div class="content-wrapper">
    <section class="content">
        <div class="box box-primary">
            <div class="box-header">
                
            </div>
            <div class="box-body">
                <table class="table table-responsive table-striped table-condensed table-bordered table-hover" id="example">
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
                                    <a href="/reservas/modificar/<?= $res['short_id'] ?>/" class="hint--top hint--bounce hint--info" aria-label="Modificar">
                                        <button class="btn btn-primary btn-xs" type="button">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                    </a>
                                    <a href="/reservas/pdf/<?= $res['short_id'] ?>/" target="_blank" class="hint--top hint--bounce hint--error" aria-label="Ver PDF">
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
        </div>
    </section>
</div>
