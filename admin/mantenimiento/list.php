<?php
$mydb->setQuery("SELECT COUNT(*) AS TOTAL FROM tbljob WHERE JOBSTATUS = 0");
$totalvacantes = $mydb->loadSingleResult();
$mydb->setQuery("SELECT COUNT(*) AS TOTAL FROM tblapplicants");
$totalaplicantes = $mydb->loadSingleResult();
$mydb->setQuery("SELECT COUNT(*) AS TOTAL FROM tblemployees WHERE ESTADO = 0");
$totalempleados = $mydb->loadSingleResult();
$mydb->setQuery("SELECT COUNT(*) AS TOTAL FROM tblcorreo WHERE ESTADO = 1");
$correo = $mydb->loadSingleResult();
$mydb->setQuery("SELECT COUNT(*) AS TOTAL FROM tblindicacioneseva WHERE ESTADO = 1");
$indicaciones = $mydb->loadSingleResult();
$mydb->setQuery("SELECT COUNT(*) AS TOTAL FROM tblcreaevaluaciones WHERE ESTADO = 1");
$evaluaciones = $mydb->loadSingleResult();

$mydb->setQuery("SELECT COUNT(*) AS TOTAL FROM tblusers");
$totalusers = $mydb->loadSingleResult();


$mydb->setQuery("SELECT COUNT(*) AS TOTAL FROM tblareas WHERE ESTADO = 1");
$areas = $mydb->loadSingleResult();

$mydb->setQuery("SELECT COUNT(*) AS TOTAL FROM tblocupaciones WHERE OCUPACIONSTATUS = 1");
$ocupaciones = $mydb->loadSingleResult();

$mydb->setQuery("SELECT COUNT(*) AS TOTAL FROM tbltipocontrato WHERE ESTADO = 1");
$contrato = $mydb->loadSingleResult();

$mydb->setQuery("SELECT COUNT(*) AS TOTAL FROM tblkeywords");
$keywords = $mydb->loadSingleResult();

?>


<div class="container">
    <div class=" page-heading">
        <h3><b>PANEL DE ACCESO DIRECTO</b></h3>
    </div>
    <div class="page-content">

        <div class="col-12 col-lg-12">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body px-3 py-4" ondblclick="window.location.href = '<?= web_root ?>admin/vacancy/';">
                            <div class="row">
                                <div class="d-flex justify-content-start">
                                    <div class="stats-icon purple mb-2" style="margin-right: 6px;">
                                        <i class="bi-people-fill"></i>
                                    </div>
                                    <div class="start" style="margin-left: 3px;">
                                        <h6 class="text-muted font-semibold">VACANTES</h6>
                                        <?php if (isset($totalvacantes->TOTAL)) : ?>
                                            <h6 class="font-extrabold mb-0"><?php echo $totalvacantes->TOTAL; ?></h6>
                                        <?php else : ?>
                                            <h6 class="font-extrabold mb-0">0</h6>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body px-3 py-4" ondblclick="window.location.href = '<?= web_root ?>admin/applicants/';">
                            <div class="row">
                                <div class="d-flex justify-content-start">
                                    <div class="stats-icon red mb-2" style="margin-right: 6px;">
                                        <i class="bi-person-dash-fill"></i>
                                    </div>
                                    <div class="start" style="margin-left: 3px;">
                                        <h6 class="text-muted font-semibold">SOLICITUDES</h6>
                                        <?php if (isset($totalaplicantes->TOTAL)) : ?>
                                            <h6 class="font-extrabold mb-0"><?php echo $totalaplicantes->TOTAL; ?></h6>
                                        <?php else : ?>
                                            <h6 class="font-extrabold mb-0">0</h6>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body px-3 py-4" ondblclick="window.location.href = '<?= web_root ?>admin/employee/';">
                            <div class="row">
                                <div class="d-flex justify-content-start">
                                    <div class="stats-icon red mb-2" style="margin-right: 6px;">
                                        <i class="bi-person"></i>
                                    </div>
                                    <div class="start" style="margin-left: 3px;">
                                        <h6 class="text-muted font-semibold">EMPLEADOS</h6>
                                        <?php if (isset($totalempleados->TOTAL)) : ?>
                                            <h6 class="font-extrabold mb-0"><?php echo $totalempleados->TOTAL; ?></h6>
                                        <?php else : ?>
                                            <h6 class="font-extrabold mb-0">0</h6>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-12 col-lg-12">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body px-3 py-4" ondblclick="window.location.href = '<?= web_root ?>admin/correo/';">
                                <div class="row">
                                    <div class="d-flex justify-content-start">
                                        <div class="stats-icon purple mb-2" style="margin-right: 6px;">
                                            <i class="bi-people-fill"></i>
                                        </div>
                                        <div class="start" style="margin-left: 3px;">
                                            <h6 class="text-muted font-semibold">CORREOS</h6>
                                            <?php if (isset($correo->TOTAL)) : ?>
                                                <h6 class="font-extrabold mb-0"><?php echo $correo->TOTAL; ?></h6>
                                            <?php else : ?>
                                                <h6 class="font-extrabold mb-0">0</h6>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body px-3 py-4" ondblclick="window.location.href = '<?= web_root ?>admin/indicaciones/';">
                                <div class="row">
                                    <div class="d-flex justify-content-start">
                                        <div class="stats-icon red mb-2" style="margin-right: 6px;">
                                            <i class="bi-person-dash-fill"></i>
                                        </div>
                                        <div class="start" style="margin-left: 3px;">
                                            <h6 class="text-muted font-semibold">INDICACIONES</h6>
                                            <?php if (isset($indicaciones->TOTAL)) : ?>
                                                <h6 class="font-extrabold mb-0"><?php echo $indicaciones->TOTAL; ?></h6>
                                            <?php else : ?>
                                                <h6 class="font-extrabold mb-0">0</h6>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body px-3 py-4" ondblclick="window.location.href = '<?= web_root ?>admin/vacancy/';">
                                <div class="row">
                                    <div class="d-flex justify-content-start">

                                        <div class="stats-icon blue mb-2" style="margin-right: 6px;">
                                            <i class="bi-person-check-fill"></i>
                                        </div>

                                        <div class="start" style="margin-left: 3px;">
                                            <h6 class="text-muted font-semibold">EVALUACIONES</h6>
                                            <?php if (isset($evaluaciones->TOTAL)) : ?>
                                                <h6 class="font-extrabold mb-0"><?php echo $evaluaciones->TOTAL; ?></h6>
                                            <?php else : ?>
                                                <h6 class="font-extrabold mb-0">0</h6>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- <div class="col-md-3">
                    <div class="card">
                        <div class="card-body px-3 py-4" ondblclick="window.location.href = '<?= web_root ?>admin/vacancy/';">
                            <div class="row">
                                <div class="d-flex justify-content-start">

                                    <div class="stats-icon blue mb-2" style="margin-right: 6px;">
                                        <i class="bi-person-check-fill"></i>
                                    </div>

                                    <div class="start" style="margin-left: 3px;">
                                        <h6 class="text-muted font-semibold">EVALUACIONES</h6>
                                        <h6 class="font-extrabold mb-0">6</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
                </div>
            </div>

            <!-- <p><b>PARA LA CREACION DE VACANTES</b></p> -->

            <div class="col-12 col-lg-12">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body px-3 py-4" ondblclick="window.location.href = '<?= web_root ?>admin/areas/';">
                                <div class="row">
                                    <div class="d-flex justify-content-start">
                                        <div class="stats-icon purple mb-2" style="margin-right: 6px;">
                                            <i class="bi-people-fill"></i>
                                        </div>
                                        <div class="start" style="margin-left: 3px;">
                                            <div class="start" style="margin-left: 3px;">
                                                <h6 class="text-muted font-semibold">SEDES</h6>
                                                <?php if (isset($areas->TOTAL)) : ?>
                                                    <h6 class="font-extrabold mb-0"><?php echo $areas->TOTAL; ?></h6>
                                                <?php else : ?>
                                                    <h6 class="font-extrabold mb-0">0</h6>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body px-3 py-4" ondblclick="window.location.href = '<?= web_root ?>admin/ocupaciones/';">
                                <div class="row">
                                    <div class="d-flex justify-content-start">
                                        <div class="stats-icon red mb-2" style="margin-right: 6px;">
                                            <i class="bi-person-dash-fill"></i>
                                        </div>
                                        <div class="start" style="margin-left: 3px;">
                                            <h6 class="text-muted font-semibold">AREAS</h6>
                                            <?php if (isset($ocupaciones->TOTAL)) : ?>
                                                <h6 class="font-extrabold mb-0"><?php echo $ocupaciones->TOTAL; ?></h6>
                                            <?php else : ?>
                                                <h6 class="font-extrabold mb-0">0</h6>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body px-3 py-4" ondblclick="window.location.href = '<?= web_root ?>admin/evaluaciones/evaluacioncrea/';">
                                <div class="row">
                                    <div class="d-flex justify-content-start">
                                        <div class="stats-icon red mb-2" style="margin-right: 6px;">
                                            <i class="bi-person"></i>
                                        </div>
                                        <div class="start" style="margin-left: 3px;">
                                            <h6 class="text-muted font-semibold">OCUPACIONES</h6>
                                            <?php if (isset($evaluaciones->TOTAL)) : ?>
                                                <h6 class="font-extrabold mb-0"><?php echo $evaluaciones->TOTAL; ?></h6>
                                            <?php else : ?>
                                                <h6 class="font-extrabold mb-0">0</h6>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- <p><b>PARA EL FILTRADO DE CV</b></p> -->


            <div class="col-12 col-lg-12">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body px-3 py-4" ondblclick="window.location.href = '<?= web_root ?>admin/keywords/';">
                                <div class="row">
                                    <div class="d-flex justify-content-start">

                                        <div class="stats-icon blue mb-2" style="margin-right: 6px;">
                                            <i class="bi-person-check-fill"></i>
                                        </div>

                                        <div class="start" style="margin-left: 3px;">
                                            <h6 class="text-muted font-semibold">PALABRAS CLAVES</h6>
                                            <?php if (isset($keywords->TOTAL)) : ?>
                                                <h6 class="font-extrabold mb-0"><?php echo $keywords->TOTAL; ?></h6>
                                            <?php else : ?>
                                                <h6 class="font-extrabold mb-0">0</h6>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body px-3 py-4" ondblclick="window.location.href = '<?= web_root ?>admin/vacancy/';">
                                <div class="row">
                                    <div class="d-flex justify-content-start">

                                        <div class="stats-icon blue mb-2" style="margin-right: 6px;">
                                            <i class="bi-person-check-fill"></i>
                                        </div>

                                        <div class="start" style="margin-left: 3px;">
                                            <h6 class="text-muted font-semibold">USUARIOS</h6>
                                            <?php if (isset($totalusers->TOTAL)) : ?>
                                                <h6 class="font-extrabold mb-0"><?php echo $totalusers->TOTAL; ?></h6>
                                            <?php else : ?>
                                                <h6 class="font-extrabold mb-0">0</h6>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body px-3 py-4" ondblclick="window.location.href = '<?= web_root ?>admin/keywords/';">
                                <div class="row">
                                    <div class="d-flex justify-content-start">

                                        <div class="stats-icon blue mb-2" style="margin-right: 6px;">
                                            <i class="bi-person-check-fill"></i>
                                        </div>

                                        <div class="start" style="margin-left: 3px;">
                                            <h6 class="text-muted font-semibold">CONTRATO</h6>
                                            <?php if (isset($contrato->TOTAL)) : ?>
                                                <h6 class="font-extrabold mb-0"><?php echo $contrato->TOTAL; ?></h6>
                                            <?php else : ?>
                                                <h6 class="font-extrabold mb-0">0</h6>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>