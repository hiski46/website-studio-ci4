<style>
    #card-img {
        height: 150px;
        object-fit: cover;
    }

    #card-paket {
        z-index: 10;
        transition: transform .2s;
    }

    #card-paket:hover {
        z-index: 11;
        transform: scale(1.3);
        cursor: pointer;
    }

    #a-paket {
        color: inherit;
        /* blue colors for links too */
        text-decoration: inherit;
        /* no underline */
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
        <div class="col-md-3 col-5">
            <div class="h5">Categories</div>
            <div class="list-group rounded-0">
                <a href="/landingpage/paket" class="list-group-item list-group-item-action <?= ($active == 'category-all') ? 'active' : '' ?>" aria-current="true">
                    All
                </a>
                <a href="/landingpage/paket?category=promo" class="list-group-item list-group-item-action <?= ($active == 'category-promo') ? 'active' : '' ?>" aria-current="true">
                    Promo
                </a>
                <?php foreach ($category as $c) { ?>
                    <a href="/landingpage/paket?category=<?= $c->id ?>" class="list-group-item list-group-item-action <?= ($active == 'category-' . $c->id) ? 'active' : '' ?>"><?= $c->category ?></a>
                <?php } ?>
            </div>
        </div>
        <div class="col-md-9 col-7">
            <div class="h5">Daftar Shop</div>
            <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 border g-2 p-3">
                <?php foreach ($paket as $p) { ?>
                    <div class="col">
                        <a href="/landingpage/detail-paket/<?= $p->id ?>" id="a-paket">
                            <div class="card h-100" id="card-paket">
                                <img id="card-img" src="/paket/<?= $p->image ?>" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $p->title ?></h5>
                                </div>
                                <div class="card-footer">
                                    <?php if ($p->price_disc > 0) { ?>
                                        <del><small class="card-text text-muted">Rp. <?= nilaiUang($p->price) ?></small></del>
                                        <h6>Rp. <?= nilaiUang($p->price_disc) ?></h6>
                                    <?php } else { ?>
                                        <h6>Rp. <?= nilaiUang($p->price) ?></h6>
                                    <?php } ?>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php } ?>
            </div>

        </div>
    </div>
</div>