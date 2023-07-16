<!-- Masthead-->
<header class="masthead py-3">
    <div class="container">
        <div class="masthead-heading text-uppercase"></div>
    </div>
</header>

<style>
    #card-img {
        height: 150px;
        width: 100%;
        object-fit: cover;
    }
</style>

<div class="container-lg mt-5">
    <div class="row ">
        <div class="col-md-8 border-top border-bottom py-3">
            <h4>Product</h4>

        </div>
        <div class="col-md-4 border-top border-bottom py-3 text-center">
            <h4>Subtotal</h4>



        </div>
    </div>
    <div class="row">
        <div class="col-md-8 py-3">
            <div id="list-product"></div>
        </div>
        <div class="col-md-4 py-3 text-center">
            <h1 id="subtotal">
            </h1>
            <form action="/landingpage/checkout" method="post" onsubmit="clearCart()">
                <input type="hidden" id="paket" name="paket">
                <button type="submit" class="btn btn-success btn-lg rounded-0 form-control">Checkout</button>
            </form>
        </div>
    </div>
</div>


<script src="/assets/js/index.js"></script>
<script>
    let carts = JSON.parse(window.localStorage.getItem('carts'))
    let paket = <?= $paket ?>;
    var subTotal = 0;
    let html = ``;
    carts.forEach(cart => {
        pak = paket.find(p => p.id == cart.id_paket);
        price = pak.price;
        if (pak.price_disc > 0) {
            price = pak.price_disc;
        }
        total = price * cart.qty;
        subTotal = subTotal + total;
        html += `<div class="row mb-3">
                    <div class="col-md-4">
                        <img id="card-img" class="img-fluid" src="/paket/` + pak.image + `" alt="">
                    </div>
                    <div class="col-md-8">
                        <h5>` + pak.title + `</h5>
                        <p>Rp. ` + thousands_separators(price) + ` x ` + cart.qty + ` = Rp. ` + thousands_separators(total) + `</p>
                    </div>
                </div>`;
    });
    $('#list-product').html(html);
    $('#subtotal').text('Rp. ' + thousands_separators(subTotal));
    $('#paket').val(JSON.stringify(carts));

    function clearCart() {
        window.localStorage.removeItem('carts');
    }
</script>