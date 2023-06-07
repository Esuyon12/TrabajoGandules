<?php
if (isset($_GET['search'])) {
    # code...
    $COMPANYNAME = $_GET['search'];
} else {
    $COMPANYNAME = '';
}

$sql = "SELECT * FROM `tblcompany` c,`tblocupaciones` o,`tbljob` j, `tblareas` a WHERE c.`COMPANYID`=j.`COMPANYID` AND j.`AREAID`=a.`AREAID` AND JOBSTATUS = 0 AND j.`OCUPACIONID`=o.`OCUPACIONID` AND COMPANYNAME LIKE '%" . $COMPANYNAME . "%' ORDER BY DATEPOSTED DESC";
$mydb->setQuery($sql);
$cur = $mydb->loadResultList();
?>

<div class="container-md mt-5">
    <div class="row">
        <!-- <div class="col-md-3 position-relative">
            <div class="card fixed-col">
                <div class="card-body">
                    <div class="container-fluid">
                        <div class="d-flex flex-column mb-2">
                            <p class="text-muted"><b>Filtros</b></p>
                        </div>

                        <div id="filtro">
                            <div class="form-floating mb-3">
                                <div class="form-control bg-light text-left" style="min-height: 30px;">
                                    <i class="bi bi-calendar2-week" style="color: green;"></i> <a href="#">Volver</a>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div> -->
        <div class="col-md-12 mb-5">
            <div class="col-lg-12">
                <?php if (!empty($cur)) { ?>
                    <?php foreach ($cur as $result) { ?>
                        <div class="col-md-12 mb-4">
                            <a href="<?php echo web_root . 'index.php?q=viewjob&search=' . $result->JOBID; ?>" class="card">
                                <div class=" card-body">
                                    <div class="d-flex align-items-center mb-6">
                                        <div class="d-flex flex-column w-100">
                                            <div class="d-flex justify-content-between align-items-center mb-3">
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

                                            <div class="d-flex mb-4">
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
                            </a>
                        </div>

                    <?php } ?>
                <?php } else { ?>
                    <h2 class="text-center text-muted">No hay vacantes</h2>
                <?php } ?>
            </div>
        </div>
    </div>
</div>