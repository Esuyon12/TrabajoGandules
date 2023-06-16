<?php
if (isset($_GET['search'])) {
    $COMPANYNAME = $_GET['search'];
} else {
    $COMPANYNAME = '';
}

$sql = "SELECT * FROM `tblcompany` c,`tblocupaciones` o, `tbltipocontrato` t, `tbljob` j, `tblareas` a WHERE c.`COMPANYID`=j.`COMPANYID` AND j.`AREAID`=a.`AREAID` AND JOBSTATUS = 0 AND j.`OCUPACIONID`=o.`OCUPACIONID` AND  j.`TCONTRATOID`=t.`TCONTRATOID` AND COMPANYNAME LIKE '%" . $COMPANYNAME . "%' AND c.`COMPANYSTATUS` = 1 ORDER BY DATEPOSTED DESC ";

$mydb->setQuery($sql);
$cur = $mydb->loadResultList();


// Obtener las áreas
$areas = array();
foreach ($cur as $result) {
    $areas[] = $result->AREA;
}
$areas = array_unique($areas);

// Obtener las ubicaciones
$companys = array();
foreach ($cur as $result) {
    $companys[] = $result->COMPANYADDRESS;
}
$companys = array_unique($companys);

?>


<!-- Page Header Start -->
<div class="container-fluid page-header py-5 mb-5">
    <div class="container text-left py-5">
        <h1 class="text-uppercase" style="color: white;">Todos los trabajos</h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb justify-content-left mb-0">
                <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
                <li class="breadcrumb-item active" aria-current="page">Todas las vacantes</li>
            </ol>
        </nav>
    </div>
</div>
<!-- Page Header End -->


<div class="container-md mt-5">
    <div class="row">
        <div class="col-md-3 position-relative">
            <div class="card border-0 shadow-sm fixed-col">
                <div class="card-body">
                    <div class="d-flex flex-column mb-2">
                        <p class="text-muted"><b>Filtros</b></p>
                    </div>

                    <div id="filtro" class="">
                      <a href="#collapsePubli" class="bg-light d-flex gap-2 mt-3 align-items-center p-2 rounded-pill" data-bs-toggle="collapse" role="button">
                        <i class="bi bi-calendar2-week" style="color: green;"></i>
                          <p style="margin-bottom: 0 !important;">Fecha de publicación</p>
                        </a>

                        <div class="collapse" id="collapsePubli">
    <div class="card card-body border-0">
            <?php
            $fechasPublicacion = array();
            foreach ($cur as $result) {
                $fechasPublicacion[] = $result->DATEPOSTED;
            }
            $fechasPublicacion = array_unique($fechasPublicacion);

            foreach ($fechasPublicacion as $fechaPublicacion) {
                echo '<p class="bg-light d-flex gap-2 mt-1 align-items-center p-1 rounded-pill"><a href="#" class="fecha.publicacion-filter">' . $fechaPublicacion . '</a></p>';
            }
            ?>
    </div>
</div>



                        <a href="#collapseArea" data-bs-toggle="collapse" role="button" class="bg-light d-flex gap-2 mt-3 align-items-center p-2 rounded-pill">
            <i class="bi bi-box" style="color: green;"></i>
            <p style="margin-bottom: 0 !important;">Área</p>
        </a>

        <div class="collapse" id="collapseArea">
    <div class="card card-body border-0">
        <ul class="list-unstyled">
            <?php
            foreach ($areas as $area) {
                echo '<p class="bg-light d-flex gap-2 mt-3 align-items-center p-2 rounded-pill"><a href="#" class="area-filter">' . $area . '</a></p>';
            }
            ?>
        </ul>
    </div>
</div>


                        <a href="#collapseUbi" data-bs-toggle="collapse" role="button" class="bg-light d-flex gap-2 mt-3 align-items-center p-2 rounded-pill">
                            <i class="bi bi-geo-fill" style="color: green;"></i>
                            <p style="margin-bottom: 0 !important;">Ubicación</p>
                        </a>

                        <div class="collapse" id="collapseUbi">
                            <div class="card card-body  border-0">
                            <?php
            foreach ($companys as $company) {
                echo '<p class="bg-light d-flex gap-2 mt-1 align-items-center p-1 rounded-pill"><a href="#" class="ubi-filter">' . $company . '</a></p>';
            }
            ?>                            </div>
                        </div>

                        <a href="#collapseCon" class="bg-light d-flex gap-2 mt-3 align-items-center p-2 rounded-pill" data-bs-toggle="collapse" role="button">
                            <i class="bi bi-briefcase" style="color: green;"></i>
                            <p style="margin-bottom: 0 !important;">Tipo de contrato</p>
                        </a>

                        <div class="collapse" id="collapseCon">
    <div class="card card-body border-0">
            <?php
            // Obtener los tipos de contrato únicos de los resultados obtenidos
            $tiposContrato = array();
            foreach ($cur as $result) {
                $tiposContrato[] = $result->TIPOCONTRATO;
            }
            $tiposContrato = array_unique($tiposContrato);

            foreach ($tiposContrato as $tipoContrato) {
                echo '<p class="bg-light d-flex gap-2 mt-1 align-items-center p-1 rounded-pill">' . $tipoContrato . '</a></p>';
            }
            ?>
    </div>
</div>

                    </div>


                </div>


            </div>
        </div>

        

        <div class="col-md-9 mb-5">
            <?php
            $countVacantes = count(array_filter($cur, function ($result) {
                return $result->COMPANYSTATUS == 1;
            }));
            ?>
            <p><b><?php echo $countVacantes; ?></b> vacantes disponibles</p>
            <div class="col-lg-12">
                <?php if (!empty($cur)) { ?>
                    <?php foreach ($cur as $result) { ?>
                        <?php if ($result->COMPANYSTATUS == 1) { ?>
                            <a class="card mb-3 border-0 shadow-sm mb-4" href="<?php echo web_root . 'index.php?q=viewjob&search=' . $result->JOBID; ?>">
                                <div class="col-md-12 mb-4">
                                    <div class=" card-body ">
                                        <div class="d-flex align-items-center mt-1">
                                            <div class="d-flex flex-column w-100">
                                                <div class="d-flex justify-content-between align-items-center mb-1">
                                                    <div class="d-flex align-items-center gap-4">
                                                        <img src="<?php echo web_root ?>assets/images/logo-gandules.png" alt="Logo" class="img-fluid rounded-start" style="width:90px; height: 90px;">
                                                        <div class="d-flex flex-column">
                                                            <h4 class="text-uppercase"><?= $result->OCUPACION; ?></h4>
                                                            <p class="text-muted"><?php echo $result->AREA ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex">
                                                        <span class="badge bg-success"><?php echo $result->REQ_EMPLOYEES; ?> vacantes</span>
                                                    </div>
                                                </div>

                                                <div class="d-flex mb-2">
                                                    <!-- <p> Descripcion</p> -->
                                                    <p class="text-muted"><?php echo substr($result->INFOJOB, 0, 205) . '...'; ?></p>

                                                </div>

                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="d-flex">
                                                        <p class="text-muted me-4">
                                                            <i class="bi bi-building"></i> <?php echo $result->COMPANYNAME ?>
                                                        </p>
                                                        <p class="text-muted">
                                                            <i class="bi bi-geo-alt-fill"></i> <?php echo $result->COMPANYADDRESS ?>
                                                        </p>
                                                    </div>
                                                    <p class="text-muted">
                                                        <i class="bi bi-calendar3"></i> <?php echo time_ago($result->DATEPOSTED) ?>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        <?php } ?>
                    <?php } ?>
                <?php } else { ?>
                    <h2 class="text-center text-muted">No hay vacantes disponibles</h2>
                <?php } ?>
            </div>
        </div>
    </div>
</div>






                    <!--<a href="#collapseMod" class="bg-light d-flex gap-2 mt-3 align-items-center p-2 rounded-pill" data-bs-toggle="collapse" role="button">
                            <i class="bi bi-briefcase" style="color: green;"></i>
                            <p style="margin-bottom: 0 !important;">Modalidad de trabajo</p>
                        </a>
                                            
                        <div class="collapse" id="collapseMod">
                            <div class="card card-body border-0">
                                <p class="bg-light d-flex gap-2 mt-1 align-items-center p-1 rounded-pill">Presencial</p>
                            </div>
                        </div>

                        <a href="#" class="bg-light d-flex gap-2 mt-3 align-items-center p-2 rounded-pill">
                            <i class="bi bi-gender-ambiguous" style="color: green;"></i>
                            <p style="margin-bottom: 0 !important;">Genero</p>
                        </a> -->