<!-- Masthead-->
<header class="masthead py-0">
    <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <?php if (count($carousel) > 0) { ?>
                <?php foreach ($carousel as $key => $car) { ?>
                    <div class="carousel-item <?= $key == 0 ? 'active' : '' ?>">
                        <img src="/carousel/<?= $car->img ?>" class="vh-100 vw-100" alt="..." style="object-fit: cover;">
                    </div>
                <?php } ?>
            <?php } ?>

        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</header>
<!-- Portfolio Grid-->
<section class="page-section bg-light" id="portfolio">
    <div class="container">
        <div class="text-center">
            <h2 class="section-heading text-uppercase">Portfolio</h2>

        </div>
        <div class="row">
            <?php if (count($porto) > 0) { ?>
                <?php foreach ($porto as $key => $por) { ?>
                    <?php $imgs = json_decode($por->portofolio) ?>
                    <div class="col-lg-4 col-sm-6 mb-4">
                        <!-- Portfolio item 1-->
                        <div class="portfolio-item">
                            <a class="portfolio-link" data-bs-toggle="modal" href="#portfolioModal<?= $key ?>">
                                <div class="portfolio-hover">
                                    <div class="portfolio-hover-content text-center"><i class="fas fa-eye fa-3x"></i> <br> <b class="text-center"><?= count($imgs) ?> Foto</b></div>
                                </div>
                                <img class="w-100 " style="object-fit: cover; height: 40vh;" src="/portofolio/<?= $imgs[0] ?>" alt="..." />
                            </a>

                        </div>
                    </div>
                    <!-- Portfolio item 1 modal popup-->
                    <div class="portfolio-modal modal fade" id="portfolioModal<?= $key ?>" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content py-0">
                                <div class="close-modal" data-bs-dismiss="modal"><img src="/landing/img/close-icon.svg" alt="Close modal" /></div>
                                <div class="p-0">
                                    <div class="row justify-content-center">
                                        <div class="col-lg-8">
                                            <div class="modal-body">
                                                <div id="carouselPorto<?= $key ?>" class="carousel slide">
                                                    <div class="carousel-inner">
                                                        <?php foreach ($imgs as $id => $img) { ?>
                                                            <div class="carousel-item <?= $id == 0 ? 'active' : '' ?>">
                                                                <img src="portofolio/<?= $img ?>" class="w-100" style="object-fit: contain; height:80vh;" alt="...">
                                                            </div>

                                                        <?php } ?>
                                                    </div>
                                                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselPorto<?= $key ?>" data-bs-slide="prev">
                                                        <span class="carousel-control-prev-icon bg-black" aria-hidden="true"></span>
                                                        <span class="visually-hidden">Previous</span>
                                                    </button>
                                                    <button class="carousel-control-next" type="button" data-bs-target="#carouselPorto<?= $key ?>" data-bs-slide="next">
                                                        <span class="carousel-control-next-icon bg-black" aria-hidden="true"></span>
                                                        <span class="visually-hidden">Next</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            <?php } else { ?>
                <div class="col text-center">
                    <h3 class="section-subheading text-muted my-auto">Belum ada portofolio yang ditambahkan</h3>
                </div>
            <?php } ?>

        </div>
    </div>
</section>
<!-- About-->
<section class="page-section" id="about">
    <div class="container">
        <div class="text-center">
            <h2 class="section-heading text-uppercase">About</h2>
        </div>
        <?= $tentang ?>
    </div>
</section>
<!-- Sejarah-->
<section class="page-section bg-light" id="sejarah">
    <div class="container">
        <div class="text-center">
            <h2 class="section-heading text-uppercase">Sejarah</h2>
        </div>
        <?= $sejarah ?>
    </div>
</section>