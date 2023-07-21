<h1><?= $title ?></h1>
<?php breadcrumb() ?>

<?php
$last_month = date("Y-m-d H:i:s", strtotime("midnight 1 month ago", time()));
$last_week = date("Y-m-d H:i:s", strtotime("midnight -7 days", time()));
$today_start = date("Y-m-d H:i:s", strtotime("midnight", time()));
$today_end = date("Y-m-d H:i:s", strtotime("tomorrow", time()) - 1);
?>

<div class="card">
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-lg-3 col-md-4 col-12">
                <h3>Daftar Transaksi</h3>
            </div>
            <div class="col-lg-9 col-md-8 col-12 text-end">
                <h6 class="d-inline">Filter :</h6>
                <a class="btn btn-primary btn-sm rounded-0" href="/laporan-transaksi?start=<?= $today_start ?>&end=<?= $today_end ?>">Hari Ini</a>
                <a class="btn btn-primary btn-sm rounded-0" href="/laporan-transaksi?start=<?= $last_week ?>&end=<?= $today_end ?>&title=minggu">Minggu Ini</a>
                <a class="btn btn-primary btn-sm rounded-0" href="/laporan-transaksi?start=<?= $last_month ?>&end=<?= $today_end ?>&title=bulan">Bulan Ini</a>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-hover w-100" id="table-transaksi">
                <thead>

                    <th>Kode Transaksi</th>
                    <th>Tanggal Checkout</th>
                    <th>Shop</th>
                    <th>Sub Total</th>
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
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <?= $this->section('javascript') ?>
            <script>
                var title = "<?= $title ?>";
                var tableTransaksi = $('#table-transaksi').DataTable({
                    scrollY: 300,
                    scrollX: true,
                    order: [1, 'desc'],
                    dom: 'Bfrtip',
                    buttons: {
                        dom: {
                            button: {
                                className: ''
                            }
                        },
                        buttons: [{
                                extend: 'excel',
                                text: 'Export Excel',
                                className: 'btn btn-success btn-sm rounded-0',
                                title: title
                            },
                            {
                                extend: 'pdf',
                                text: 'Export PDF',
                                className: 'btn btn-success btn-sm rounded-0',
                                title: title
                            },
                            {
                                extend: 'print',
                                text: ' Print',
                                className: 'btn btn-success btn-sm rounded-0',
                                title: title
                            }
                        ]
                    }


                });
            </script>
            <?= $this->endSection() ?>
        </div>
    </div>
</div>