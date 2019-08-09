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
                        <strong>Idioma: </strong><?=$client_data['language']?><br>
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
                    Número de Vuelo de llegada:
                    <address>
                        <strong><?=$client_data['customtext']?></strong>
                    </address>
                </div>
                <div class="col-sm-4 invoice-col">
                    Fecha y Número de Vuelo de partida:
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
            <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                    Hora de Pickup:
                    <address>
                        <input type="text" class="form-control" placeholder="Hora de Pickup">
                    </address>
                </div>
                <div class="col-sm-4 invoice-col">
                    Origen de la Reserva:
                    <address>
                        <input type="text" class="form-control" placeholder="Hora de Pickup">
                    </address>
                </div>
            </div>
            <hr>
            <h3 class="text-center">
                Proveedor
            </h3>
            <div class="row">
                <div class="col-sm-4">
                    Proveedor:
                    <select class="form-control chosen">
                        <?php foreach($proveedores as $proveedor) { ?>
                        <option value="<?=$proveedor['idproveedor']?>"><?=$proveedor['proveedor']?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-sm-4">
                    Costo del Proveedor:
                    <input type="text" class="form-control" placeholder="Costo del Proveedor">
                </div>
                <div class="col-sm-4">
                    Número de Factura:
                    <input type="text" class="form-control" placeholder="Número de Factura">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-sm-4">
                    Proveedor:
                    <select class="form-control chosen">
                        <?php foreach($proveedores as $proveedor) { ?>
                        <option value="<?=$proveedor['idproveedor']?>"><?=$proveedor['proveedor']?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-sm-4">
                    Costo del Proveedor:
                    <input type="text" class="form-control" placeholder="Costo del Proveedor">
                </div>
                <div class="col-sm-4">
                    Número de Factura:
                    <input type="text" class="form-control" placeholder="Número de Factura">
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
        </section>
    </section>

</div>