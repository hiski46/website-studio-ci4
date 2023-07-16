<h1><?= $title ?></h1>
<?= breadcrumb() ?>

<div class="container-lg mt-3">
    <h3>Daftar Foto</h3>
    <div class="row border row-cols-6 p-2 align-items-end mb-3 ">
        <?php if (json_decode($portofolio->portofolio)) { ?>
            <?php foreach (json_decode($portofolio->portofolio) as $porto) { ?>
                <div class="col">
                    <img src="/portofolio/<?= $porto ?>" height="100" alt="" class="img-fluid" style="object-fit: cover; ">
                    <div class="text-center mt-1">
                        <button type="button" class="btn btn-sm btn-outline-danger rounded-0 border-0" modal="delete-alert" target-url="<?= base_url('content/portofolio/delete-foto/' . $portofolio->id . '?foto=' . $porto); ?>" data="Foto"><?= icon('trash') ?></button>
                    </div>
                </div>
            <?php } ?>
        <?php } else { ?>
            <div class="col-12 text-center">
                <h3 class="text-muted">Tidak ada foto</h3>
            </div>
        <?php } ?>
    </div>
    <h3>Tambah Foto</h3>
    <div class=" row border p-2">
        <form action="/content/portofolio/edit/<?= $portofolio->id ?>" method="post" onsubmit="showLoader()" enctype="multipart/form-data">
            <label for="" class="form-label">Pilih beberapa foto untuk di tambah dalam portofolio</label>
            <div class="row mb-2">
                <div class="col-10" id="bungkus">
                    <div class="row mb-3">
                        <div class="col-10">
                            <input type="file" class="form-control rounded-0" name="portofolio[]" id="portofolio" accept="image/*" required>
                        </div>
                        <div class="col-2"></div>
                    </div>
                </div>
                <div class="col-2">
                    <button type="button" onclick="addInput()" class="btn btn-outline-success btn-sm rounded-0"><?= icon('plus') ?></button type="button">
                </div>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary rounded-0"><?= icon('save') ?> Tambah</button>
            </div>
        </form>

    </div>
</div>

<?= $this->section('javascript') ?>
<script>
    function addInput() {
        var bungkus = $('#bungkus');
        var input = bungkus.children('.row').first().clone();
        input.children().children('input#portofolio').val('').prop('required', false);
        var htmlButton = `<button type="button" class="btn btn-outline-danger rounded-0 border-0" onclick="deleteInput(this)"><?= icon("trash") ?></button>`;
        input.children('.col-2').html(htmlButton);
        bungkus.append(input);
    }

    function deleteInput(btn) {
        $(btn).parentsUntil('#bungkus').remove();
    }
</script>
<?= $this->endSection() ?>