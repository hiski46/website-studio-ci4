<h1><?= $title ?></h1>
<?= breadcrumb() ?>

<div class="mb-3 text-end">
    <a href="/content/carousel/tambah" class="btn btn-sm btn-success"><?= icon('plus') ?> Tambah Carousel</a>
</div>
<div class="container">
    <div class="table-responsive">
        <table class="table table-hover" style="vertical-align: middle;">
            <thead>
                <tr>
                    <th>Gambar</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($carousel as $car) { ?>
                    <tr>
                        <td><img src="/carousel/<?= $car->img ?>" width="300" class="img-fluid" alt=""></td>
                        <td class="text-center"><button class="btn btn-sm btn-outline-danger border-0 rounded-0" modal="delete-alert" target-url="<?= base_url('content/carousel/delete/' . $car->id); ?>" data="Gambar"> <?= icon('trash3-fill') ?></button></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>