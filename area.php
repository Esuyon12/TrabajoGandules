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

<div class="container-xxl py-5">
    <div class="container-md mt-5">
        <?php
        $sql = "SELECT a.AREA, COUNT(*) AS total_occupations
            FROM tblareas a
            INNER JOIN tblocupaciones o ON a.AREAID = o.AREAID
            INNER JOIN tbljob j ON a.AREAID = j.AREAID AND o.OCUPACIONID = j.OCUPACIONID
            WHERE a.ESTADO = 1
            GROUP BY a.AREA";
        $mydb->setQuery($sql);
        $occupations = $mydb->loadResultList();
        $countAreas = count($occupations);
        $areasPerPage = 12;
        $totalPages = ceil($countAreas / $areasPerPage);
        $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
        $start = ($currentPage - 1) * $areasPerPage;
        $areasToShow = array_slice($occupations, $start, $areasPerPage);
        ?>
        <div class="row">
            <?php
            foreach ($areasToShow as $area) {
            ?>
                <div class="col-md-4 mb-5">
                    <a href="<?php echo web_root . 'index.php?q=trabajos&area=' . $area->AREA; ?>" class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-6">
                                <div class="d-flex flex-column w-100">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <div class="d-flex align-items-center gap-4">
                                            <img src="<?php echo web_root ?>assets/images/logo-gandules.png" alt="Logo" class="img-fluid rounded-start" style="width:90px; height: 90px;">
                                            <div class="d-flex flex-column">
                                                <h5 class="text-uppercase"><?php echo $area->AREA ?></h5>
                                                <p><span class="text-success"> <?php echo $area->total_occupations; ?> Ocupaciones activas</span></p>
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

        <p class="p mb-3"><b><?php echo count($areasToShow); ?></b> áreas mostradas de <b><?php echo $countAreas; ?></b> áreas disponibles</p>

        <?php if ($totalPages > 1) : ?>
            <div class="d-flex justify-content-center align-items-center gap-2">
                <?php if ($currentPage > 1) : ?>
                    <a class="pag-item" href="?q=area&page=<?php echo ($currentPage - 1); ?>">&laquo;</a>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                    <a class="pag-item <?php if ($i == $currentPage) echo 'current'; ?>" href="?q=area&page=<?php echo $i; ?>"><?php echo $i; ?></a>
                <?php endfor; ?>

                <?php if ($currentPage < $totalPages) : ?>
                    <a class="pag-item" href="?q=area&page=<?php echo ($currentPage + 1); ?>">&raquo;</a>
                <?php endif; ?>
            </div>
        <?php endif; ?>

    </div>

</div>