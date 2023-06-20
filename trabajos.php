<style>
    .fixed-col {
        top: 90px !important;
    }

    a.badge ion-icon {
        font-size: 25px;
    }
</style>

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
    AND j.`TCONTRATOID`=t.`TCONTRATOID` 
    AND c.`COMPANYSTATUS` = 1";

if (isset($_GET['area'])) {
    $area = $mydb->escape_value($_GET['area']);
    $sql2 .= " AND AREA LIKE '%" . $area . "%'";
}

if (isset($_GET['ubicacion'])) {
    $ubicacion = $mydb->escape_value($_GET['ubicacion']);
    $sql2 .= " AND COMPANYADDRESS LIKE '%" . $ubicacion . "%'";
}

if (isset($_GET['contrato'])) {
    $contrato = $mydb->escape_value($_GET['contrato']);
    $sql2 .= " AND TIPOCONTRATO LIKE '%" . $contrato . "%'";
}

if (isset($_GET['fecha'])) {
    $fecha = $mydb->escape_value($_GET['fecha']);
    $sql2 .= " ORDER BY DATE_INT " . $fecha;
}

$mydb->setQuery($sql2);
$cur2 = $mydb->loadResultList();

$page = isset($_GET['page']) ? intval($_GET['page']) : 1; // Página actual
$perPage = 10; // Número de elementos por página
$totalPages = ceil(count($cur2) / $perPage); // Total de páginas

$offset = ($page - 1) * $perPage;
$sql2 .= " LIMIT $offset, $perPage";

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

function replacetxt($cadena, $patron, $reemplazo)
{
    if (strpos($cadena, $patron) !== false) {
        $patron = "/" . $patron . ".*?&/";
        $nueva_cadena = preg_replace($patron, $reemplazo, $cadena);
    } else {
        $nueva_cadena = $cadena . $reemplazo;
    }

    $nueva_cadena = preg_replace('/&page=[^&]*/', '&', $nueva_cadena);
    $nueva_cadena = preg_replace('/&+/', '&', $nueva_cadena);
    // $nueva_cadena = rtrim($nueva_cadena, '&'); // Eliminar el carácter & al final de la URL

    return $nueva_cadena;
}



function generatePageUrl($page)
{
    $url = $_SERVER['REQUEST_URI'];
    $url = preg_replace('/(\?|&)page=\d+/', '', $url); // Eliminar parámetro 'page' actual
    $url .= (strpos($url, '?') !== false ? '&' : '?') . 'page=' . $page;
    return $url;
}

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

<div class="container-fluid mt-5">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-lg-3 col-xl-3 position-relative">
            <div class="card fixed-col border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="card-title">Filtro</h5>
                        <div class="d-flex fil">
                            <ion-icon name="filter-circle-outline"></ion-icon>
                        </div>
                    </div>
                    <div class="row mb-3 d-lg-inline-flex d-none d-xl-inline-flex delete_GET">
                        <?php $i = 0;
                        foreach ($_GET as $key => $value) {
                            $i++;
                            if ($i == 1 || $key == "page") {
                                continue;
                            } ?>
                            <div class="col-auto mb-1">
                                <a href="<?php echo replacetxt($_SERVER['REQUEST_URI'], "&" . $key . "=", "&") ?>" class="text-start d-flex justify-content-between align-items-center badge text-bg-success">
                                    <p class="text-wrap text-left"><?php echo ($value == "DESC" ? "Recientes" : ($value == "ASC" ? "Antiguos" : $value)) ?></p>
                                    <ion-icon name="close-outline"></ion-icon>
                                </a>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="accordion d-lg-block d-none d-xl-block" id="accordionExample">
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
                                    <a href="<?php echo replacetxt($_SERVER['REQUEST_URI'], "&fecha=", "&fecha=DESC&") ?>" class="d-flex justify-content-between">
                                        <p>Los más recientes</p>
                                        <input type="radio" class="form-check-input" id="ant" <?php if (isset($_GET['fecha']) && $_GET['fecha'] == 'DESC') echo 'checked'; ?> disabled />
                                    </a>
                                    <a href="<?php echo replacetxt($_SERVER['REQUEST_URI'], "&fecha=", "&fecha=ASC&") ?>" class="d-flex justify-content-between">
                                        <p>Los más antiguos</p>
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
                                <div class="accordion-body" style="max-height: 230px; overflow-y: overlay;">
                                    <?php
                                    foreach ($areas as $area) { ?>
                                        <a href="<?php echo replacetxt($_SERVER['REQUEST_URI'], "&area=", "&area=" . $area . "&") ?>" class="d-flex justify-content-between position-relative">
                                            <p><?php echo $area ?></p>
                                            <input type="radio" class="form-check-input position-absolute intra" <?php if (isset($_GET['area']) && $_GET['area'] == $area) echo 'checked'; ?> disabled>
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
                                <div class="accordion-body" style="max-height: 230px; overflow-y: overlay;">
                                    <?php
                                    foreach ($companys as $company) { ?>
                                        <a href="<?php echo replacetxt($_SERVER['REQUEST_URI'], "&ubicacion=", "&ubicacion=" . $company . "&") ?>" class="d-flex justify-content-between">
                                            <p><?php echo $company ?></p>
                                            <input type="radio" class="form-check-input" disabled <?php if (isset($_GET['ubicacion']) && $_GET['ubicacion'] == $company) echo 'checked'; ?> />
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
                                <div class="accordion-body" style="max-height: 230px; overflow-y: overlay;">
                                    <?php
                                    foreach ($tiposContrato as $tipoContrato) { ?>
                                        <a href="<?php echo replacetxt($_SERVER['REQUEST_URI'], "&contrato=", "&contrato=" . $tipoContrato . "&") ?>" class="d-flex justify-content-between position-relative">
                                            <p><?php echo $tipoContrato; ?></p>
                                            <input type="radio" class="form-check-input position-absolute intra" <?php if (isset($_GET['contrato']) && $_GET['contrato'] == $tipoContrato) echo 'checked'; ?> disabled />
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

        <div class="col-md-12 col-sm-12 col-lg-9 col-xl-9 mb-5">
            <?php
            $countVacantes = count(array_filter($cur2, function ($result) {
                return $result->COMPANYSTATUS == 1;
            }));
            ?>
            <div class="d-flex align-items-center justify-content-end w-100 mb-3">
                <p class="text-right"><b><?php echo count($cur2); ?></b> vacantes mostradas de <b><?php echo $countVacantes; ?></b> disponibles</p>
            </div>
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
                                                    <p class="text-muted"><?php echo substr($result->INFOJOB, 0, 205) . "..." ?> <span class="text-success">(Seguir leyendo)</span> </p>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <div class="d-flex justify-content-betwwen align-items-center w-100 gap-3">
                                                            <div class="d-flex align-items-center gap-2 text-muted w-100 item-des">
                                                                <ion-icon name="business-outline"></ion-icon>
                                                                <p><?php echo $result->COMPANYNAME ?></p>
                                                            </div>
                                                            <div class="d-flex align-items-center gap-2 text-muted justify-content-end w-100 item-des">
                                                                <p><?php echo $result->COMPANYADDRESS ?></p>
                                                                <ion-icon name="map-outline"></ion-icon>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <div class="d-flex justify-content-end align-items-center gap-2 item-des text-muted">
                                                            <ion-icon name="calendar-outline"></ion-icon>
                                                            <p><?php echo time_ago($result->DATE_INT) ?></p>
                                                        </div>
                                                    </div>
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

            <div class="col-lg-12">
                <?php if ($totalPages > 1) : ?>
                    <div class="d-flex justify-content-center align-items-center gap-2">
                        <?php if ($page > 1) : ?>
                            <a href="<?php echo generatePageUrl(1) ?>" class="pag-item">&laquo;</a>
                        <?php endif; ?>
                        <?php
                        $maxVisiblePages = 3;
                        $startPage = max(1, $page - floor($maxVisiblePages / 2));
                        $endPage = min($startPage + $maxVisiblePages - 1, $totalPages);

                        if ($endPage - $startPage + 1 < $maxVisiblePages) {
                            $startPage = max(1, $endPage - $maxVisiblePages + 1);
                        }

                        for ($i = $startPage; $i <= $endPage; $i++) :
                            if ($i == $page) : ?>
                                <span class="current pag-item"><?php echo $i ?></span>
                            <?php else : ?>
                                <a href="<?php echo generatePageUrl($i) ?>" class="pag-item"><?php echo $i ?></a>
                        <?php endif;
                        endfor; ?>

                        <?php if ($page < $totalPages) : ?>
                            <a href="<?php echo generatePageUrl($totalPages) ?>" class="pag-item">&raquo;</a>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>

    </div>
</div>