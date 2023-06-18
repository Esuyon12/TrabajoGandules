<?php

$sql = "SELECT * 
FROM `tblcompany` c,
`tblocupaciones` o, 
`tbltipocontrato` t, 
`tbljob` j, 
`tblareas` a 
WHERE c.`COMPANYID`=j.`COMPANYID` 
AND j.`AREAID`=a.`AREAID` 
AND JOBSTATUS = 0 
AND j.`OCUPACIONID`=o.`OCUPACIONID` 
AND  j.`TCONTRATOID`=t.`TCONTRATOID` 
AND c.`COMPANYSTATUS` = 1 
ORDER BY DATEPOSTED DESC";

$mydb->setQuery($sql);
$cur = $mydb->loadResultList();

$sql2 = "SELECT * FROM 
`tblcompany` c,
`tblocupaciones` o, 
`tbltipocontrato` t, 
`tbljob` j, 
`tblareas` a 
WHERE c.`COMPANYID`=j.`COMPANYID` 
AND j.`AREAID`=a.`AREAID` 
AND JOBSTATUS = 0 
AND j.`OCUPACIONID`=o.`OCUPACIONID` 
AND  j.`TCONTRATOID`=t.`TCONTRATOID` 
AND c.`COMPANYSTATUS` = 1";


if (isset($_GET['area'])) {
    // Aplicar la condición correspondiente a la opción de área seleccionada
}

if (isset($_GET['ubicacion'])) {
    $sql2 .= "AND COMPANYNAME LIKE '%" . $_GET['ubicacion'] . "%'";
}

if (isset($_GET['contrato'])) {
    // Aplicar la condición correspondiente a la opción de tipo de contrato seleccionada
}

// Agregar condiciones del filtro
if (isset($_GET['fecha'])) {
    $orderBy = ($_GET['fecha'] == "ASC") ? "ASC" : "DESC";
    $sql2 .= " ORDER BY DATEPOSTED " . $orderBy;
}

$mydb->setQuery($sql2);
$cur2 = $mydb->loadResultList();

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

// Obtener los tipos de contrato únicos de los resultados obtenidos
$tiposContrato = array();
foreach ($cur as $result) {
    $tiposContrato[] = $result->TIPOCONTRATO;
}
$tiposContrato = array_unique($tiposContrato);

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

        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="card-title">Filtro</h5>
                        <div class="d-flex fil">
                            <ion-icon name="filter-circle-outline"></ion-icon>
                        </div>
                    </div>
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#fecha" aria-expanded="true" aria-controls="fecha">
                                    <div class="d-flex listicon align-items-center gap-2">
                                        <ion-icon name="calendar-outline"></ion-icon>
                                        <p class="card-title">Fecha</p>
                                    </div>
                                </button>
                            </h2> 
                            <div id="fecha" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <a href="index.php?q=trabajos&fecha=DESC" class="d-flex justify-content-between">
                                        <p for="ant">Los más recientes</p>
                                        <input type="radio" class="form-check-input" id="ant" <?php if (isset($_GET['fecha']) && $_GET['fecha'] == 'DESC') echo 'checked'; ?> disabled />
                                    </a>
                                    <a href="index.php?q=trabajos&fecha=ASC" class="d-flex justify-content-between">
                                        <p for="ant">Los más antiguos</p>
                                        <input type="radio" class="form-check-input" id="ant" <?php if (isset($_GET['fecha']) && $_GET['fecha'] == 'ASC') echo 'checked'; ?> disabled />
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#area" aria-expanded="false" aria-controls="area">
                                    <div class="d-flex listicon align-items-center gap-2">
                                        <ion-icon name="cube-outline"></ion-icon>
                                        <p class="card-title">Area</p>
                                    </div>
                                </button>
                            </h2>
                            <div id="area" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <?php
                                    foreach ($areas as $area) { ?>
                                        <a href="?are=<?php echo $area ?>" class="d-flex justify-content-between">
                                            <p for="ant"><?php echo $area ?></p>
                                        </a>
                                    <?php }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#location" aria-expanded="false" aria-controls="location">
                                    <div class="d-flex listicon align-items-center gap-2">
                                        <ion-icon name="map-outline"></ion-icon>
                                        <p class="card-title">Ubicacion</p>
                                    </div>
                                </button>
                            </h2>
                            <div id="location" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <?php
                                    foreach ($companys as $company) { ?>
                                        <a href="#" class="d-flex justify-content-between">
                                            <p for="ant"><?php echo $company ?></p>
                                            <input type="radio" id="ant" disabled />
                                        </a>
                                    <?php }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#contrato" aria-expanded="false" aria-controls="contrato">
                                    <div class="d-flex listicon align-items-center gap-2">
                                        <ion-icon name="file-tray-outline"></ion-icon>
                                        <p class="card-title">Tipo de contrato</p>
                                    </div>
                                </button>
                            </h2>
                            <div id="contrato" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <?php

                                    foreach ($tiposContrato as $tipoContrato) { ?>
                                        <a href="#" class="d-flex justify-content-between">
                                            <label for="ant"><?php echo $tipoContrato ?></label>
                                            <input type="radio" id="ant" disabled />
                                        </a>
                                    <?php }
                                    ?>
                                </div>
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
                    <?php foreach ($cur2 as $result) { ?>
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