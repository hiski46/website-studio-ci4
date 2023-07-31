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
        <div class="col-md-4 py-3 ">
            <div class="mb-3 text-center">
                <h1 id="subtotal"></h1>

            </div>
            <div class="mb-3" id="checkout">
                <div class="mb-3">
                    <label for="" class="form-label">Nama</label>
                    <input type="text" class="form-control rounded-0" placeholder="Nama" name="nama" id="nama">
                    <div class="invalid-feedback">
                        Nama harus diisi.
                    </div>

                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Email</label>
                    <input type="email" class="form-control rounded-0" placeholder="Email" name="email" id="email">
                    <div class="invalid-feedback">
                        Email harus diisi.
                    </div>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">No. Telepon</label>
                    <input type="text" class="form-control rounded-0" placeholder="Telepon" name="telepon" id="telepon">
                    <div class="invalid-feedback">
                        Telepon harus diisi.
                    </div>
                </div>
                <div class="mb-3 text-center">
                    <button type="button" onclick="checkout(this)" class="btn btn-success btn-lg rounded-0 form-control">Checkout</button>
                </div>
            </div>
            <div class="text-center" style="display:none" id="transaksi">
                Kode transaksi:<h3 id="kode_transaksi"></h3>
                Batas waktu pembayaran : <h6 id="masa_kode_transaksi"></h6> <br>
                Silahkan melakukan pembayaran melalui no rekening: <br>
                <h5><?= $no_rek ?></h5> <br>
                Kirim bukti pembayaran melauli Whatsap: <br>
                <h5><?= $phone ?></h5>

                <button class="btn btn-success form-control rounded-0" onclick="clearCartTrans()"> Sudah Mengirimkan Bukti Pembayaran</button>
            </div>
        </div>
    </div>
</div>


<script src="/assets/js/index.js"></script>
<script>
    drawCart();

    function drawCart() {
        let carts = JSON.parse(window.localStorage.getItem('carts'))
        let paket = <?= $paket ?>;
        var subTotal = 0;
        let html = ``;
        if (carts) {
            if (carts.length > 0) {
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

                $('#subtotal').text('Rp. ' + thousands_separators(subTotal));
            }
        }
        $('#list-product').html(html);

    }

    function checkout(btn) {
        var url = '<?= base_url("/landingpage/checkout") ?>';
        let carts = JSON.parse(window.localStorage.getItem('carts'));
        const req = ['nama', 'email', 'telepon'];
        let validated = true;
        req.forEach(id => {
            let field = $('#' + id);
            console.log(field.val());
            if (field.val() == '') {
                validated = false;
                field.addClass('is-invalid');
                field.removeClass('is-valid');
            } else {
                field.addClass('is-valid');
                field.removeClass('is-invalid');
            }
        });
        if (validated) {
            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    paket: JSON.stringify(carts),
                    nama: $('#nama').val(),
                    email: $('#email').val(),
                    telepon: $('#telepon').val()
                },
                beforeSend: function(data) {
                    $(btn).prop('disabled', true);
                },
                success: function(data) {
                    data = JSON.parse(data);
                    $(btn).prop('disabled', false);
                    if (data.code == 200) {
                        color = 'blue';
                        dataTransaksi = {
                            kode_transaksi: data.kode_transaksi,
                            waktu_checkout: new Date()
                        };
                        window.localStorage.setItem('transaksi', JSON.stringify(dataTransaksi));
                        cekCheckout();
                    } else {
                        color = 'red';
                    }
                    iziToast.show({
                        title: data.message,
                        // message: 'What would you like to add?',
                        balloon: false,
                        position: 'topCenter',
                        theme: "light",
                        color: color
                    });
                }
            })
        }

    }
</script>