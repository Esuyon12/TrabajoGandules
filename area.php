<?php

$sql = "SELECT * 
FROM `tblcompany` c, 
`tblocupaciones` o, 
`tbljob` j, 
`tblareas` a 
WHERE c.`COMPANYID`=j.`COMPANYID` 
AND j.`AREAID`=a.`AREAID` 
AND JOBSTATUS = 0 
AND j.`OCUPACIONID`=o.`OCUPACIONID` "
    . (!isset($_GET['namecomp']) ? "" : "AND COMPANYNAME LIKE '%" . $_GET['namecomp'] . "%'") .
    "AND c.`COMPANYSTATUS` = 1 
ORDER BY DATEPOSTED DESC ";


$mydb->setQuery($sql);
$cur = $mydb->loadResultList();
?>

<div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container text-left py-5">
        <h1 class="text-uppercase" style="color: white;">Todos las áreas</h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb justify-content-left mb-0">
                <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
                <li class="breadcrumb-item active" aria-current="page">Todas las áreas</li>
            </ol>
        </nav>
    </div>
</div>


<!-- <div class="container-md mt-5">
    <div class="row">
        <div class="col-md-12 mb-5">
            <?php
            $sql = "SELECT DISTINCT AREA FROM tblareas a, tbljob j WHERE a.ESTADO = 1 AND a.AREAID = j.AREAID";
            $mydb->setQuery($sql);
            $cur = $mydb->loadResultList();
            $countAreas = count($cur);
            $areasPerPage = 12;
            $totalPages = ceil($countAreas / $areasPerPage);
            $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
            $start = ($currentPage - 1) * $areasPerPage;
            $areasToShow = array_slice($cur, $start, $areasPerPage);
            ?>
            <div class="row">
                <?php
                $i = 0;
                foreach ($areasToShow as $area) {
                    $i++;
                ?>
                    <div class="col-md-4 mb-4">
                        <a href="<?php echo web_root . 'index.php?q=searcharea&search=' . $area->AREA; ?>" class="card" style="border: none;">
                            <div class="card-body shadow-sm">
                                <div class="d-flex align-items-center mb-6">
                                    <div class="d-flex flex-column w-100">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <div class="d-flex align-items-center gap-4">
                                                <div class="d-flex flex-column">
                                                    <h5 class="card-title text-left"><?php echo $area->AREA ?></h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php
                }
                ?>
            </div>
            <p><b><?php echo $i; ?></b> áreas mostradas de <b><?php echo $countAreas; ?></b> áreas disponibles</p>

            <?php if ($totalPages > 1) : ?>
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <?php if ($currentPage > 1) : ?>
                            <li class="page-item"><a class="page-link" href="?q=area&page=<?php echo ($currentPage - 1); ?>">Anterior</a></li>
                        <?php endif; ?>

                        <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                            <li class="page-item <?php if ($i == $currentPage) echo 'active'; ?>"><a class="page-link" href="?q=area&page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                        <?php endfor; ?>

                        <?php if ($currentPage < $totalPages) : ?>
                            <li class="page-item"><a class="page-link" href="?q=area&page=<?php echo ($currentPage + 1); ?>"><i class="fas fa-arrow-right"></i></a></li>
                        <?php endif; ?>
                    </ul>
                </nav>
            <?php endif; ?>
        </div>
    </div>
</div> -->



<!-- Service Start -->
<div class="container-xxl py-5">
    <div class="container">
        <?php
        $sql = "SELECT DISTINCT AREA FROM tblareas a, tbljob j WHERE a.ESTADO = 1 AND a.AREAID = j.AREAID";
        $mydb->setQuery($sql);
        $cur = $mydb->loadResultList();
        $countAreas = count($cur);
        $areasPerPage = 12;
        $totalPages = ceil($countAreas / $areasPerPage);
        $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
        $start = ($currentPage - 1) * $areasPerPage;
        $areasToShow = array_slice($cur, $start, $areasPerPage);
        ?>
        <div class="row g-4">
            <?php
            $i = 0;
            foreach ($areasToShow as $area) {
                $i++;
            ?>

                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-item rounded d-flex flex-column h-100">
                        <div class="service-img rounded flex-grow-1">
                            <img class="img-fluid w-100 h-100" src="assets/images/hero/gren.png" alt="">
                        </div>
                        <div class="service-text rounded p-5">
                            <div class="btn-square rounded-circle mx-auto mb-3">
                                <img class="img-fluid" src="assets/images/logo-gandules.png" alt="Icon">
                            </div>
                            <h4 class="mb-3"><?php echo $area->AREA ?></h4>
                            <a class="btn btn-sm" href=""><i class="fa fa-plus text-primary me-2"></i>Ver vacantes</a>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
        <p><b><?php echo $i; ?></b> áreas mostradas de <b><?php echo $countAreas; ?></b> áreas disponibles</p>

        <?php if ($totalPages > 1) : ?>
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <?php if ($currentPage > 1) : ?>
                        <li class="page-item"><a class="page-link" href="?q=area&page=<?php echo ($currentPage - 1); ?>">Anterior</a></li>
                    <?php endif; ?>

                    <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                        <li class="page-item <?php if ($i == $currentPage) echo 'active'; ?>"><a class="page-link" href="?q=area&page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                    <?php endfor; ?>

                    <?php if ($currentPage < $totalPages) : ?>
                        <li class="page-item"><a class="page-link" href="?q=area&page=<?php echo ($currentPage + 1); ?>"><i class="fas fa-arrow-right"></i></a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        <?php endif; ?>
    </div>
</div>
</div>
<!-- Service End -->