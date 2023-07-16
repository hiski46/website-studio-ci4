<style>
    #detail-img {
        height: 70vh;
        object-fit: cover;
    }
</style>

<!-- Masthead-->
<header class="masthead py-3">
    <div class="container">
        <div class="masthead-heading text-uppercase"></div>
    </div>
</header>

<div class="container-lg mt-3">
    <div class="row">
        <div class="col-md-5">
            <img src="/paket/<?= $paket->image ?>" class="img-fluid" alt="" id="detail-img">
        </div>
        <div class="col-md-7">
            <h1><?= $paket->title ?></h1>
            <?php if ($paket->price_disc > 0) { ?>
                <del><small class="card-text text-muted">Rp. <?= nilaiUang($paket->price) ?></small></del>
                <br>
                <span class="badge bg-success rounded-0">
                    <h6 class="mb-0">Rp. <?= nilaiUang($paket->price_disc) ?></h6>
                </span>

            <?php } else { ?>
                <span class="badge bg-success rounded-0">
                    <h6 class="mb-0">Rp. <?= nilaiUang($paket->price) ?></h6>
                </span>
            <?php } ?>
            <p><?= $paket->description ?></p>
            <div class="border-top p-3">
                <input type="number" id="qty" class="form-control form-control-lg rounded-0 w-25 mb-3" value="1">
                <button class="btn btn-primary btn-lg rounded-0" onclick="addCart()"> Add to Cart <span><?= icon('cart4', 18, 18) ?></span></button>
            </div>
        </div>
    </div>
</div>

<script>
    const idPaket = "<?= $paket->id ?>";

    function addCart() {
        let carts = window.localStorage.getItem('carts');
        let qty = $('#qty').val();

        if (carts) {
            carts = JSON.parse(carts);
            cart = {
                id_paket: idPaket,
                qty: qty
            };
            carts.push(cart);
        } else {
            carts = [{
                id_paket: idPaket,
                qty: qty
            }]
        }
        window.localStorage.setItem("carts", JSON.stringify(carts));
        window.location.href = "<?= base_url('/landingpage/cart') ?>";

    }
</script>