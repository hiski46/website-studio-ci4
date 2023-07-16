<h1><?= $title ?></h1>
<?= breadcrumb() ?>

<div class="container-lg">
    <form action="/content/portofolio/add" method="post" onsubmit="showLoader()" enctype="multipart/form-data">
        <label for="" class="form-label">Pilih beberapa foto untuk di upload</label>
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
            <button type="submit" class="btn btn-primary rounded-0"><?= icon('save') ?> Simpan</button>
        </div>
    </form>
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