<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Studio</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="/landing/favicon.ico" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="/assets/css/landing.css" rel="stylesheet" />
    <!-- jquery -->
    <script src="/assets/js/jquery.min.js"></script>
</head>

<body id="page-top">
    <!-- Navigation-->
    <div class="navbar-brand fixed-top" style="margin-left: 10vw; z-index: 1031; width: fit-content;"><img src="/image/<?= $logo ?>" width="100" class="img-fluid" alt="..." /></div>
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
        <div class="container">

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars ms-1"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                    <li class="nav-item"><a class="nav-link <?= ($nav_active == 'home') ? 'active' : '' ?>" href="/">Home</a></li>
                    <!-- <li class="nav-item"><a class="nav-link" href="#fasilitas">Fasilitas</a></li> -->
                    <li class="nav-item"><a class="nav-link" href="/#portfolio">Portfolio</a></li>
                    <li class="nav-item"><a class="nav-link" href="/#about">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="/#sejarah">Sejarah</a></li>
                    <li class="nav-item"><a class="nav-link <?= ($nav_active == 'paket') ? 'active' : '' ?>" href="/landingpage/paket"><?= icon('camera') ?> Shop</a></li>
                    <li class="nav-item"><a class="nav-link <?= ($nav_active == 'cart') ? 'active' : '' ?>" href="/landingpage/cart"><?= icon('cart4') ?> <span class="badge bg-primary" id="badge-cart">0</span> </a></li>
                    <li class="nav-item"><a class="nav-link " href="/dashboard" target="_blank"><?= icon('box-arrow-in-right') ?> Login</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Content -->
    <?= $this->renderSection('landing_content') ?>

    <section class="page-section" id="bio">
        <div class="container">
            <div class="text-center">
                <img src="/image/<?= $logo ?>" width="100" class="img-fluid" alt="..." />
                <h2 class="section-heading text-uppercase">SaveTime Studio</h2>
            </div>
            <div class="row">
                <div class="col text-center">
                    <b class="text-primary"><?= icon('geo-alt-fill', 18, 18) ?> </b> <?= $alamat ?>
                    <b class="text-primary"><?= icon('telephone-fill', 18, 18) ?> </b> <?= $phone ?>
                    <b class="text-primary"><?= icon('envelope-fill', 18, 18) ?> </b> <?= $email ?>
                </div>
            </div>
        </div>
    </section>
    <!-- Footer-->
    <footer class="footer py-4">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-4 text-lg-start">Copyright &copy; Simerawana <?= date('Y') ?></div>
                <div class="col-lg-4 my-3 my-lg-0">
                    <a class="btn btn-dark btn-social mx-2" target="_blank" href="<?= $instagram ?>" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                    <a class="btn btn-dark btn-social mx-2" target="_blank" href="<?= $facebook ?>" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                    <!-- <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a> -->
                </div>
                <div class="col-lg-4 text-lg-end">
                    <a class="link-dark text-decoration-none me-3" href="#!">Privacy Policy</a>
                    <a class="link-dark text-decoration-none" href="#!">Terms of Use</a>
                </div>
            </div>
        </div>
    </footer>


    <!-- Bootstrap core JS-->
    <script src="/assets/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="/assets/js/scriptsLanding.js"></script>
    <script>
        setBadgeCartQty();

        function setBadgeCartQty() {
            const badge = $('#badge-cart');
            const carts = JSON.parse(window.localStorage.getItem('carts'));
            if (carts) {
                badge.text(carts.length);
            } else {
                badge.text(0);
            }
        }
    </script>
</body>

</html>