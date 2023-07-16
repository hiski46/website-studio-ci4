<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .b-example-divider {
            height: 3rem;
            background-color: rgba(0, 0, 0, .1);
            border: solid rgba(0, 0, 0, .15);
            border-width: 1px 0;
            box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
        }

        .b-example-vr {
            flex-shrink: 0;
            width: 1.5rem;
            height: 100vh;
        }

        .bi {
            vertical-align: -.125em;
            fill: currentColor;
        }

        .nav-scroller {
            position: relative;
            z-index: 2;
            height: 2.75rem;
            overflow-y: hidden;
        }

        .nav-scroller .nav {
            display: flex;
            flex-wrap: nowrap;
            padding-bottom: 1rem;
            margin-top: -1px;
            overflow-x: auto;
            text-align: center;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
        }
    </style>
    <link rel="stylesheet" href="/assets/css/dashboard.css">
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/iziToast.min.css">
    <link rel="stylesheet" href="/assets/css/dataTables.bootstrap5.min.css">
    <!-- jquery -->
    <script src="/assets/js/jquery.min.js"></script>
    <!-- summernote -->
    <link rel="stylesheet" href="/summernote/summernote-lite.min.css">
    <script src="/summernote/summernote-lite.min.js"></script>
</head>

<body>

    <body>
        <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
            <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6" href="#">Dashboard Admin</a>
            <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- <input class="form-control form-control-dark w-100 rounded-0 border-0" type="text" placeholder="Search" aria-label="Search"> -->
            <div class="navbar-nav">
                <div class="nav-item text-nowrap">
                    <a class="nav-link px-3" href="<?= base_url('auth/logout') ?>">Sign out <span class="align-text-bottom"><?= icon('box-arrow-right'); ?></span></i></a>
                </div>
            </div>
        </header>

        <div class="container-fluid">
            <div class="row">
                <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                    <div class="position-sticky pt-3 sidebar-sticky">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link <?= isAktif('dashboard'); ?>" href="/dashboard">
                                    <span class="">
                                        <?= icon('house-door'); ?>
                                    </span>
                                    Dashboard
                                </a>
                            </li>
                        </ul>
                        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted text-uppercase">
                            <span>Shop</span>
                            <a class="link-secondary" href="#" aria-label="Add a new report">
                                <span data-feather="plus-circle" class="align-text-bottom"></span>
                            </a>
                        </h6>
                        <ul class="nav flex-column mb-2">
                            <li class="nav-item">
                                <a class="nav-link <?= isAktif('paket'); ?>" href="/paket/list">
                                    <span class="">
                                        <?= icon('camera') ?>
                                    </span>
                                    Daftar Shop
                                </a>
                            </li>
                        </ul>

                        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted text-uppercase">
                            <span>Management Content</span>
                            <a class="link-secondary" href="#" aria-label="Add a new report">
                                <span data-feather="plus-circle" class="align-text-bottom"></span>
                            </a>
                        </h6>
                        <ul class="nav flex-column mb-2">
                            <li class="nav-item">
                                <a class="nav-link <?= isAktif('portofolio', 3); ?>" href="/content/portofolio">
                                    <span>
                                        <?= icon('journal-album') ?>
                                    </span>
                                    Portofolio
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?= isAktif('biodata', 3); ?>" href="/content/biodata">
                                    <span>
                                        <?= icon('buildings') ?>
                                    </span>
                                    Biodata
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?= isAktif('carousel', 3); ?>" href="/content/carousel">
                                    <span>
                                        <?= icon('images') ?>
                                    </span>
                                    Carousel
                                </a>
                            </li>
                        </ul>
                        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted text-uppercase">
                            <span></i> <?= lang('Auth.settings') ?></span>
                            <a class="link-secondary" href="#" aria-label="Add a new report">
                                <span data-feather="plus-circle" class="align-text-bottom"></span>
                            </a>
                        </h6>
                        <ul class="nav flex-column mb-2">
                            <li class="nav-item">
                                <a class="nav-link <?= isAktif('auth'); ?>" href="/auth">
                                    <span class="">
                                        <?= icon('people') ?>
                                    </span>
                                    <?= lang('auth.index_heading') ?>
                                </a>
                            </li>
                        </ul>

                    </div>
                </nav>

                <main class="col-md-9 ms-sm-auto ps-0 col-lg-10 ">
                    <div id='loader' class="box">
                        <div class="con">
                            <span class="circle"></span>
                            <span class="circle"></span>
                            <span class="circle"></span>
                            <span class="circle"></span>
                        </div>
                    </div>
                    <div class="ps-4 mt-3">
                        <div class="container">
                            <?= $this->renderSection('content') ?>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <div id="modal"></div>

        <script src="/assets/js/iziToast.min.js" type="text/javascript"></script>
        <script src="/assets/js/index.js"></script>
        <script src="/assets/js/jquery.dataTables.min.js"></script>
        <script src="/assets/js/dataTables.bootstrap-5.min.js"></script>
        <script src="/assets/js/bootstrap.bundle.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#loader').fadeOut('slow')
                $('.nav-link').click(function() {
                    $('#loader').show();
                })
                $('a.breadcrumb').click(function() {
                    $('#loader').show();
                })

                $('.errors').addClass('alert alert-danger pb-0 mb-2');
            })
        </script>
        <?= $this->renderSection('javascript') ?>
    </body>

</html>