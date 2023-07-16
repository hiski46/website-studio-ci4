<h1><?= $title ?></h1>
<?php breadcrumb() ?>

<div class="text-end mb-3">
    <a href="/paket/add" class="btn btn-success btn-sm rounded-0" onclick="showLoader()"><?= icon('plus') ?>Tambah Shop</a>
</div>
<div class="table-responsive pb-5">
    <table class="table table-hover" id="table-paket">
        <thead>
            <tr>
                <th></th>
                <th>Nama Shop</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Harga Diskon</th>
                <th>Aktif</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($paket) { ?>
                <?php foreach ($paket as $val) { ?>
                    <tr>
                        <td>
                            <img id="" width="100px" height="100px" src="<?= $val->image ? '/paket//' . $val->image : '/image/sm/default.png' ?>" class="img-fluid img-thumbnail" alt="...">
                        </td>
                        <td class="align-middle"><?= $val->title ?></td>
                        <td class="align-middle"><?= findById($kategori, $val->category_id)[0]->category ?></td>
                        <td class="align-middle">Rp. <?= nilaiUang($val->price) ?></td>
                        <td class="align-middle">Rp. <?= nilaiUang($val->price_disc) ?></td>
                        <td class="align-middle" data-order="<?= $val->is_active ?>">
                            <div class="form-check form-switch">
                                <input class="form-check-input" style="cursor: pointer;" type="checkbox" role="switch" onclick="status(this, <?= $val->id ?>)" id="flexSwitchCheckChecked" <?= $val->is_active ? 'checked' : '' ?>>
                            </div>
                        </td>
                        <td class="align-middle">
                            <a class="btn btn-outline-primary btn-sm border-0 rounded-0" href="/paket/edit/<?= $val->id ?>" onclick="showLoader()"><?= icon('pencil-square') ?></a>
                            <button class="btn btn-sm btn-outline-danger border-0 rounded-0" modal="delete-alert" target-url="<?= base_url('paket/delete/' . $val->id); ?>" data="<?= $val->title; ?>"> <?= icon('trash3-fill') ?></button>
                        </td>
                    </tr>
                <?php } ?>
            <?php } ?>
        </tbody>
    </table>
    <?= $this->section('javascript') ?>
    <script>
        $('#table-paket').DataTable()

        function status(data, id) {
            var is_check = $(data).prop('checked');
            var status = 1;
            if (!is_check) {
                status = 0;
            }
            var url = "<?= base_url('paket/status-paket') ?>"
            $.ajax({
                url: url,
                type: 'GET',
                data: {
                    id: id,
                    status: status
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
                        } else {
                            $(data).prop('checked', false);
                        }
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