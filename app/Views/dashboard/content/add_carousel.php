<h1><?= $title ?></h1>
<?= breadcrumb() ?>

<div class="container-lg">
    <div class="border p-3">
        <form action="/content/carousel/tambah" onsubmit="sohowLoader()" method="post" enctype="multipart/form-data">
            <label for="" class="form-label">Masukkan Foto</label>
            <div class="row">
                <div class="col-md-6">
                    <input type="file" name="img" id="img" class="form-control rounded-0" accept="image/*" required>
                </div>
                <div class="col-md-6">
                    <img src="" class="img-thumbnail" alt="Image Preview" id="image-preview" width="200px">
                </div>
            </div>
            <div class="text-center mt-3">
                <button type="submit" class="btn btn-primary rounded-0"><?= icon('save') ?> Simpan</button>
            </div>
        </form>
    </div>
</div>

<script>
    $('#img').change(function(event) {
        $('#image-preview').attr('src', URL.createObjectURL(event.target.files[0]));
    })
</script>