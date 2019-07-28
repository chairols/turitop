<div class="content-wrapper">
    <section class="content">
        <section class="invoice">
            <div class="row">
                <div class="col-xs-12">
                    <h2 class="page-header">
                        Reserva N° <?=$booking['short_id']?>
                    </h2>
                </div>
            </div>
            <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                    <address>
                        <strong>Cliente: </strong><?=$client_data['name']?><br>
                        <strong>Email: </strong><?=$client_data['email']?><br>
                        <strong>Teléfono: </strong><?=$client_data['phone']?><br>
                        <strong>Nacionalidad: </strong><?=$client_data['country']?><br>
                        <strong>Hotel: </strong><?=$client_data['hotel']?>
                    </address>
                </div>
                <div class="col-sm-4 invoice-col">
                    Fecha:
                    <address>
                        <strong><?=$booking['date_event']?></strong>
                    </address>
                </div>
                <div class="col-sm-4 invoice-col">
                    Servicio Contratado:
                    <address>
                        <strong><?=$booking['product_name']?></strong>
                    </address>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Cantidad</th>
                                <th>Descripción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($ticket_type_count as $t) { ?>
                            <tr>
                                <td><?=$t['count']?></td>
                                <td><?=$t['name']?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6 col-xs-offset-6">
                    <p class="lead text-right">Monto Total</p>
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <td class="text-right">
                                    <strong><?=$booking['currency']?> <?=$booking['total_price']?></strong>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <hr>
            <h3 class="text-center">
                Forma de Pago
            </h3>
            <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                    Estado del Pago:
                    <address>
                        <strong><?=$booking['status']?></strong>
                    </address>
                </div>
                <div class="col-sm-4 invoice-col">
                    Medio de Pago:
                    <address>
                        <strong><?=$booking['payment_gateway']?></strong>
                    </address>
                </div>
                <div class="col-sm-4 invoice-col">
                    Notas:
                    <address>
                        <strong><?=$booking['notes']?></strong>
                    </address>
                </div>
            </div>
            <hr>
            <h3 class="text-center">
                Información Adicional
            </h3>
            <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                    Texto:
                    <address>
                        <strong><?=$client_data['customtext']?></strong>
                    </address>
                </div>
                <div class="col-sm-4 invoice-col">
                    Texto:
                    <address>
                        <strong><?=$client_data['customtext2']?></strong>
                    </address>
                </div>
                <div class="col-sm-4 invoice-col">
                    Texto:
                    <address>
                        <strong><?=$client_data['customtextarea']?></strong>
                    </address>
                </div>
            </div>
            <hr>
            <h3 class="text-center">
                Agregar Información
            </h3>
            <div class="row">
                <div class="col-sm-4">
                    <input type="text" class="form-control" placeholder="Texto 1">
                </div>
                <div class="col-sm-4">
                    <input type="text" class="form-control" placeholder="Texto 2">
                </div>
                <div class="col-sm-4">
                    <input type="text" class="form-control" placeholder="Texto 3">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-sm-4">
                    <input type="text" class="form-control" placeholder="Texto 4">
                </div>
                <div class="col-sm-4">
                    <input type="text" class="form-control" placeholder="Texto 5">
                </div>
                <div class="col-sm-4">
                    <input type="text" class="form-control" placeholder="Texto 6">
                </div>
            </div>
            <br>
            <div class="row no-print">
                <div class="col-xs-12">
                    <button type="button" class="btn btn-success">
                        <i class="fa fa-save"></i> Guardar Datos
                    </button> 
                    <a href="/reservas/pdf/<?=$booking['short_id']?>/" target="_blank">
                        <button type="button" class="btn btn-danger pull-right">
                            <i class="fa fa-file-pdf-o"></i> Generar PDF
                        </button>
                    </a>
                </div>
            </div>
            <pre>
                <?php print_r($booking); ?>
            </pre>
        </section>
    </section>

</div>