<?php

$sql = "SELECT * FROM `tblcompany` c, `tblocupaciones` o, `tbljob` j, `tblareas` a WHERE c.`COMPANYID`=j.`COMPANYID` AND j.`AREAID`=a.`AREAID` AND JOBSTATUS = 0 AND j.`OCUPACIONID`=o.`OCUPACIONID` " . (!isset($_GET['namecomp']) ? "" : "AND COMPANYNAME LIKE '%" . $_GET['namecomp'] . "%'") . " AND c.`COMPANYSTATUS` = 1 ORDER BY DATEPOSTED DESC ";


$mydb->setQuery($sql);
$cur = $mydb->loadResultList();
?>


<!-- Page Header Start -->
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
<!-- Page Header End -->
<div class="container-md mt-5">
    <div class="row">
        <div class="col-md-3 position-relative">
            <div class="card fixed-col">
                <div class="card-body">
                    <div class="container-fluid">
                        <div class="d-flex flex-column mb-2">
                            <p class="text-muted"><b>Filtros</b></p>
                        </div>

                        <div id="filtro">
                            <div class="form-floating mb-3">
                                <div class="form-control bg-light text-left" style="min-height: 30px;">
                                    <i class="bi bi-calendar2-week" style="color: green;"></i> <a href="#">Fecha de publicación</a>
                                </div>
                            </div>
                            <div class="form-floating mb-3">
                                <div class="form-control bg-light text-left" style="min-height: 30px;">
                                    <i class="bi bi-box" style="color: green;"></i> <a href="#">Area</a>
                                </div>
                            </div>
                            <div class="form-floating mb-3">
                                <div class="form-control bg-light text-left" style="min-height: 30px;">
                                    <i class="bi bi-geo-fill" style="color: green;"></i> <a href="#">Ubicación</a>
                                </div>
                            </div>
                            <div class="form-floating mb-3">
                                <div class="form-control bg-light text-left" style="min-height: 30px;">
                                    <i class="bi bi-briefcase" style="color: green;"></i> <a href="#"> Tipo de contrato</a>
                                </div>
                            </div>
                            <div class="form-floating mb-3">
                                <div class="form-control bg-light text-left" style="min-height: 30px;">
                                    <i class="bi bi-stopwatch" style="color: green;"></i> <a href="#">Modalidad de trabajo</a>
                                </div>
                            </div>
                            <div class="form-floating mb-3">
                                <div class="form-control bg-light text-left" style="min-height: 30px;">
                                    <i class="bi bi-gender-ambiguous" style="color: green;"></i> <a href="#">Genero</a>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-9 mb-5">
            <?php
            $countAreas = count(array_filter($cur, function ($result) {
                return $result->ESTADO == 1;
            }));
            ?>
            <p><b><?php echo $countAreas; ?></b> áreas disponibles </p>

            <div class="row">
                <?php
                foreach ($cur as $area) {
                ?>
                    <div class="col-md-4 mb-4">
                        <a href="<?php echo web_root . 'index.php?q=searcharea&search=' . $area->AREA; ?>" class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-6">
                                    <div class="d-flex flex-column w-100">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <div class="d-flex align-items-center gap-4">
                                                <div class="d-flex flex-column">
                                                    <p class="text-muted"><?php echo $area->AREA ?></p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex">
                                                <p class="text-muted me-4">
                                                    <i class="bi bi-building"></i> <?php echo $area->COMPANYNAME ?>
                                                </p>
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
        </div>
    </div>
</div>