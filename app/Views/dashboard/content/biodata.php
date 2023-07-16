<h1><?= $title ?></h1>
<?= breadcrumb() ?>

<div class="container-lg mb-5">
    <form action="/content/biodata/simpan" method="post" onsubmit="showLoader()" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="" class="form-label">Logo</label>
                    <div class="row align-items-center">
                        <div class="col-md-7 text-center">
                            <img src="/image/<?= $logo ?>" class="img-fluid" alt="Image Preview" id="image-preview" width="200px">
                        </div>
                        <div class="col-md-5">
                            <small>Pilih gambar untuk mengubah logo</small>
                            <input type="file" name="new-image" id="new-image" class="form-control rounded-0" accept="image/*">
                        </div>
                        <input type="hidden" name="logo" value="<?= $logo ?>">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Alamat</label>
                    <textarea name="alamat" id="alamat" class="form-control rounded-0" required><?= $alamat ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control rounded-0" value="<?= $email ?>" required>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Telepon</label>
                    <input type="phone" name="phone" id="phone" class="form-control rounded-0" value="<?= $phone ?>" required>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Facebook</label>
                    <input type="text" name="facebook" id="facebook" class="form-control rounded-0" value="<?= $facebook ?>" required>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Instagram</label>
                    <input type="text" name="instagram" id="instagram" class="form-control rounded-0" value="<?= $instagram ?>" required>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Nomor Rekening</label>
                    <input type="text" name="no_rek" id="no_rek" class="form-control rounded-0" value="<?= $no_rek ?>" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="" class="form-label">Tentang Perusahaan</label>
                    <textarea name="tentang" id="tentang" class="form-control rounded-0" required><?= $tentang ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Sejarah</label>
                    <textarea name="sejarah" id="sejarah" class="form-control rounded-0" required><?= $sejarah ?></textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <button type="submit" class="btn btn-primary form-control rounded-0"> <?= icon('save') ?> Simpan Perubahan</button>
            </div>
        </div>
    </form>
</div>


<script>
    $('#tentang').summernote({
        height: 150,
        toolbar: [
            // [groupName, [list of button]]
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font'],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']]
        ]
    });
    $('#sejarah').summernote({
        height: 150,
        toolbar: [
            // [groupName, [list of button]]
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font'],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']]
        ]
    });
    $('#new-image').change(function(event) {
        $('#image-preview').attr('src', URL.createObjectURL(event.target.files[0]));
    })
</script>