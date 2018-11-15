<div class="content-wrapper">
    <div class="box box-primary">
        <div class="box-body">
            <?php $resultado = json_decode($resultado); ?>
            <?php foreach ($resultado->data->bookings as $res) { ?>
                <strong>product_name: </strong><?= $res->product_name ?><br>
                <strong>name: </strong><?=$res->client_data->name?><br>
                <strong>currency: </strong><?=$res->currency?><br>
                <strong>total_price: </strong><?=$res->total_price?><br>
                <strong>date_event: </strong><?=date("d/m/Y H:i:s", $res->date_event)?><br>
                <br>
            <?php } ?>

        </div>
    </div>
    <pre>
        <?php //print_r($resultado); ?>
    </pre>
</div>