<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Trabaja con nosotros | Gandules.</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/logo-gandules.png" />

    <link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <!-- Template Stylesheet -->
    <link href="assets/css/style.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-...Tu-valor-de-integridad-aquí..." crossorigin="anonymous">
    <style>
        .navbar .dropstart .dropdown-menu[data-bs-popper] {
            top: 100% !important;
        }
    </style>

</head>


<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;"></div>
    </div>
    <!-- Spinner End -->


    <!-- Navbar Start -->
    <nav class="navbar bg-white navbar-expand-lg navbar-light sticky-top p-0">
        <a href="index.php" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
            <img src="assets/images/logo/gandules.png" alt="Logo" class="img-fluid rounded-start" style="width:150px; height: 50px;">
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav ms-auto p-4 p-lg-0">
                <li class="nav-item">
                    <a href="<?php echo web_root; ?>index.php" class="nav-link active">Inicio</a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo web_root; ?>index.php?q=company" class="nav-link">Sedes</a>
                </li>
                <li class="btn-group dropstart">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                        Areas
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-lg-start">
                        <?php
                        $sql = "SELECT * FROM `tbljob` j, tblareas a WHERE j.AREAID = a.AREAID AND j.JOBSTATUS = 0 LIMIT 10";
                        $mydb->setQuery($sql);
                        $cur = $mydb->loadResultList();
                        foreach ($cur as $result) {
                            $area = $result->AREA;
                            $searchParam = isset($_GET['search']) ? $_GET['search'] : '';
                            $isActive = $searchParam === $area ? 'active' : '';
                            $link = web_root . "index.php?q=searcharea&search=$area";

                            // Check if the area is active
                            $areaIsActive = $result->ESTADO == 1;

                            // Only display active areas
                            if ($areaIsActive) {
                        ?>
                                <li>
                                    <a href="<?= $link ?>" class="dropdown-item text-truncate <?= $isActive ?>"><?= $area ?></a>
                                </li>
                        <?php
                            }
                        }
                        ?>
                    </ul>
                </li>


                <li class="nav-item">
                    <a href="<?php echo web_root; ?>index.php?q=trabajos" class="nav-link">Trabajos</a>
                </li>

                <li class="nav-item">
                    <a href="<?php echo web_root; ?>index.php?q=about" class="nav-link">Nosotros</a>
                </li>
            </ul>
        </div>
    </nav>