<h1><?= $title ?></h1>
<?php breadcrumb() ?>

<div class="container">
    <form action="/paket/add" method="post" onsubmit="showLoader()" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="" class="form-label ">Title</label>
                    <input type="text" name="title" id="title" class="form-control rounded-0" placeholder="Title" required>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Kategori</label>
                    <select name="category_id" id="category_id" class="form-select" required>
                        <?php foreach ($kategori as $k) { ?>
                            <option value="<?= $k->id ?>"><?= $k->category ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="mb-3">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="" class="form-label">Harga</label>
                            <div class="input-group">
                                <span class="input-group-text rounded-0">Rp.</span>
                                <input type="number" name="price" id="price" class="form-control rounded-0" placeholder="00.000" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-label">Harga Diskon</label>
                            <div class="input-group ">
                                <span class="input-group-text rounded-0">Rp.</span>
                                <input type="number" name="price_disc" id="price_disc" class="form-control rounded-0" placeholder="00.000">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Gambar</label>
                    <div class="row">
                        <div class="col-md-6">
                            <input type="file" name="image" id="image" class="form-control rounded-0" accept="image/*" required>
                        </div>
                        <div class="col-md-6">
                            <img src="" class="img-thumbnail" alt="Image Preview" id="image-preview" width="200px">
                        </div>
                    </div>
                </div>
                <script>
                    $('#image').change(function(event) {
                        $('#image-preview').attr('src', URL.createObjectURL(event.target.files[0]));
                    })
                </script>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="" class="form-label">Deskripsi</label>
                    <textarea name="description" id="description"></textarea>
                </div>
            </div>

        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-success rounded-0"><?= icon('save') ?> Simpan</button>
        </div>
    </form>
</div>

<script>
    $('#description').summernote({
        height: 250,
        toolbar: [
            // [groupName, [list of button]]
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font'],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']]
        ],
    });
</script>