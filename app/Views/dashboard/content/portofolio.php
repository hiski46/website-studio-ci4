<h1><?= $title ?></h1>
<?= breadcrumb() ?>

<div class="container">
    <div class="text-end">
        <a href="/content/portofolio/add" class="btn btn-success btn-sm rounded-0"><?= icon('plus') ?> Tambah Portofolio</a>
    </div>
    <div class="table-responsive mt-3">
        <table class="table table-hover" id="table-porto">
            <thead>
                <tr>
                    <th>Portofolio</th>
                    <th>Jumlah File</th>
                    <th>Tanggal</th>
                    <th>Aktif</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($portofolio as $porto) { ?>
                    <?php $imgs = json_decode($porto->portofolio) ?>
                    <tr style="vertical-align: middle;">
                        <?php if (count($imgs) > 0) { ?>
                            <td><img class="img-fluid" width="100" src="/portofolio/<?= $imgs[0] ?>" alt=""></td>
                        <?php } else { ?>
                            <td>Tidak ada Foto</td>
                        <?php } ?>
                        <td><?= count($imgs) ?></td>
                        <td><?= $porto->created_at ?></td>
                        <td>
                            <div class="form-check form-switch">
                                <input class="form-check-input" style="cursor: pointer;" type="checkbox" role="switch" onclick="status(this, '<?= $porto->id ?>' )" id="flexSwitchCheckChecked" <?= $porto->is_active ? 'checked' : '' ?>>
                            </div>
                        </td>
                        <td>
                            <a class="btn btn-outline-primary btn-sm border-0 rounded-0" href="/content/portofolio/edit/<?= $porto->id ?>" onclick="showLoader()"><?= icon('pencil-square') ?></a>
                            <button class="btn btn-sm btn-outline-danger border-0 rounded-0" modal="delete-alert" target-url="<?= base_url('content/portofolio/delete/' . $porto->id); ?>" data="Portofolio"> <?= icon('trash3-fill') ?></button>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->section('javascript') ?>
<script>
    function status(data, id) {
        var is_check = $(data).prop('checked');
        var status = 1;
        if (!is_check) {
            status = 0;
        }
        var url = "<?= base_url('content/portofolio/status') ?>"
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