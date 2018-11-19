<div class="content-wrapper">
    <div class="box box-primary">
        <div class="box-body">
            <?php $resultado = json_decode($resultado); ?>
            <table class="table table-responsive table-striped table-condensed table-bordered table-hover">
                <thead>
                    <tr>
                        <th>short_id</th>
                        <th>product_name</th>
                        <th>name</th>
                        <th>currency</th>
                        <th>total_price</th>
                        <th>date_event</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($resultado->data->bookings as $res) { ?>
                    <tr>
                        <td><?=$res->short_id?></td>
                        <td><?=$res->product_name?></td>
                        <td><?=$res->client_data->name?></td>
                        <td><?=$res->currency?></td>
                        <td><?=$res->total_price?></td>
                        <td><?=date("d/m/Y H:i:s", $res->date_event)?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <pre>
        <?php var_dump(count($resultado->data->bookings)); ?>
        <?php print_r($resultado); ?>
    </pre>
</div>