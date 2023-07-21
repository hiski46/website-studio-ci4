<div class="contaner-lg p-2 mt-3">
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 mb-3 align-items-end">
        <div class="col ">
            <div class="card">
                <div class="card-header text-bg-primary"></div>
                <div class="card-body">
                    <h5>Total Transaksi</h5>
                    <b>
                        <h2><?= icon('cart4', 32, 32) ?> <span><?= count($transaksi) ?></span></h2>
                    </b>
                </div>
            </div>
        </div>
        <div class="col ">
            <div class="card ">
                <div class="card-header text-bg-success"></div>
                <div class="card-body">
                    <h5>Transaksi Selesai</h5>
                    <b>
                        <h2><?= icon('check2-circle', 32, 32) ?><span id="done"> <?= $transaksiDone ?></span></h2>
                    </b>
                </div>
            </div>
        </div>
        <div class="col ">
            <div class="card">
                <div class="card-header text-bg-danger"></div>
                <div class="card-body">
                    <h5>Transaksi Belum Selesai</h5>
                    <b>
                        <h2><?= icon('hourglass-split', 32, 32) ?> <span id="wait"><?= $transaksiWait ?></span></h2>
                    </b>
                </div>
            </div>
        </div>
        <div class="col ">
            <div class="card">
                <div class="card-header text-bg-warning"></div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <th>Pengunjung Hari Ini</th>
                                    <td>: <?= $pengunjunghariini ?></td>

                                </tr>
                                <tr>
                                    <th>Total Pengunjung</th>
                                    <td>: <?= $totalpengunjung ?></td>
                                </tr>
                                <tr>
                                    <th>Pengunjung Online</th>
                                    <td>: <?= $pengunjungonline ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <h3>Daftar Transaksi</h3>
            <div class="table-responsive">
                <table class="table table-hover w-100" id="table-transaksi">
                    <thead>

                        <th>Kode Transaksi</th>
                        <th>Tanggal Checkout</th>
                        <th>Shop</th>
                        <th>Sub Total</th>
                        <th>Sudah Dibayar</th>

                    </thead>
                    <tbody>
                        <?php foreach ($transaksi as $tr) { ?>
                            <tr>
                                <td><?= $tr->kode_transaksi ?></td>
                                <td><?= $tr->created_at ?></td>
                                <td>
                                    <ol>
                                        <?php $totalPrice = 0 ?>
                                        <?php foreach (json_decode($tr->paket) as $paket) { ?>
                                            <?php
                                            $pkt = findById($pakets, $paket->id_paket)[0];
                                            $price =  ($pkt->price_disc == 0) ? $pkt->price : $pkt->price_disc;
                                            $totalPrice = $totalPrice + $price;
                                            ?>
                                            <li><?= $pkt->title ?> <b> <?= $paket->qty ?> x <?= nilaiUang($price) ?>= <?= nilaiUang($paket->qty * $price) ?></b> </li>
                                        <?php } ?>
                                    </ol>
                                </td>
                                <td>Rp. <?= nilaiUang($totalPrice) ?></td>
                                <td data-order="<?= $tr->is_paid ?>">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" style="cursor: pointer;" type="checkbox" role="switch" onclick="status(this, '<?= $tr->id ?>' )" id="flexSwitchCheckChecked" <?= $tr->is_paid ? 'checked' : '' ?>>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <?= $this->section('javascript') ?>
                <script>
                    var tableTransaksi = $('#table-transaksi').DataTable({
                        scrollY: 300,
                        scrollX: true,
                        order: [1, 'desc'],
                    });

                    let transaksiDone = <?= $transaksiDone ?>;
                    let transaksiWait = <?= $transaksiWait ?>;

                    function status(data, id) {
                        var is_check = $(data).prop('checked');
                        var status = 1;

                        if (!is_check) {
                            status = 0;

                        }
                        var url = "<?= base_url('transaksi/status') ?>"
                        $.ajax({
                            url: url,
                            type: 'GET',
                            data: {
                                id: id,
                                is_paid: status
                            },
                            beforeSend: function() {
                                $(data).prop('disabled', true);
                            },
                            success: function(result) {
                                result = JSON.parse(result);
                                $(data).prop('disabled', false);
                                var color = "blue";
                                if (result.status == 200) {
                                    if (is_check) {
                                        $(data).prop('checked', true);
                                        transaksiDone = transaksiDone + 1;
                                        transaksiWait = transaksiWait - 1;

                                    } else {
                                        $(data).prop('checked', false);
                                        transaksiDone = transaksiDone - 1;
                                        transaksiWait = transaksiWait + 1;
                                    }
                                    var cell = $(data).parent().parent('td');
                                    console.log(cell);
                                    cell.attr('data-order', status);
                                    tableTransaksi.cells(cell).invalidate();

                                    $('#done').text(transaksiDone);
                                    $('#wait').text(transaksiWait);
                                } else {
                                    color = "red";
                                }
                                iziToast.show({
                                    title: result.message,
                                    balloon: false,
                                    position: 'topCenter',
                                    theme: "light",
                                    color: color
                                });
                            }
                        })
                    }
                </script>
                <?= $this->endSection() ?>
            </div>
        </div>
    </div>
</div>