<!-- <?php

$mydb->setQuery("SELECT COUNT(*) AS TOTAL FROM tblapplicants WHERE MONTH(DATEADD) = MONTH(CURRENT_DATE()) AND STATE = 0");
$total = $mydb->loadSingleResult();

$mydb->setQuery("SELECT COUNT(*) AS TOTAL
FROM tblapplicants a
INNER JOIN tblevaluaciones e ON a.APPLICANTID = e.APPLICANTID
WHERE MONTH(DATEADD) = MONTH(CURRENT_DATE()) AND e.RESPUESTA IS NULL;
");
$pent = $mydb->loadSingleResult();

$mydb->setQuery("SELECT COUNT(*) AS TOTAL 
FROM tblapplicants a 
INNER JOIN tblevaluaciones e ON a.APPLICANTID = e.APPLICANTID 
WHERE MONTH(DATEADD) = MONTH(CURRENT_DATE()) AND e.RESPUESTA IS NOT NULL AND e.RESPUESTA <> ''");
$rev = $mydb->loadSingleResult();



$mydb->setQuery("SELECT COUNT(*) AS TOTAL FROM tbljob WHERE JOBSTATUS = 0");
$totalVacantesActivas = $mydb->loadSingleResult();


$mydb->setQuery("SELECT COUNT(*) AS TOTAL FROM tblemployees WHERE ESTADO = 1 AND MONTH(DATEHIRED) = MONTH(CURRENT_DATE())");
$totalempleados = $mydb->loadSingleResult();

$mydb->setQuery("SELECT COUNT(*) AS TOTAL FROM tblusers");
$totalusers = $mydb->loadSingleResult();

$mydb->setQuery("SELECT COUNT(*) AS TOTAL FROM tblapplicants");
$totalaplicantes = $mydb->loadSingleResult();


$mydb->setQuery("SELECT COUNT(*) AS TOTAL FROM tblareas WHERE ESTADO = 1");
$areas = $mydb->loadSingleResult();

$mydb->setQuery("SELECT COUNT(*) AS TOTAL FROM tblocupaciones WHERE OCUPACIONSTATUS = 1");
$ocupaciones = $mydb->loadSingleResult();

$mydb->setQuery("SELECT COUNT(*) AS TOTAL FROM tblcreaevaluaciones WHERE ESTADO = 1");
$evaluaciones = $mydb->loadSingleResult();

$mydb->setQuery("SELECT COUNT(*) AS TOTAL FROM tblkeywords");
$keywords = $mydb->loadSingleResult();

?>


<div class="container">
    <div class=" page-heading">
        <h3><b>PANEL DE MANTENIMIENTO</b></h3>
    </div>
    <div class="page-content">
        <div class="col-12 col-lg-12">
            <div class="row">
                <div class="col-md-3">
                    <div class="card" style="box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;">
                        <div class="card-body px-3 py-4" ondblclick="window.location.href = '<?= web_root ?>admin/vacancy/';">
                            <div class="row">
                                <div class="d-flex justify-content-start">
                                    <div class="stats-icon purple mb-2" style="margin-right: 6px;">
                                        <i class="bi-people-fill"></i>
                                    </div>
                                    <div class="start" style="margin-left: 3px;">
                                        <h6>CORREOS</h6>
                                        <h6 class="font-extrabold mb-0">0</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card" style="box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;">
                        <div class="card-body px-3 py-4" ondblclick="window.location.href = '<?= web_root ?>admin/vacancy/';">
                            <div class="row">
                                <div class="d-flex justify-content-start">
                                        <div class="stats-icon red mb-2" style="margin-right: 6px;">
                                                <i class="bi-person-dash-fill"></i>
                                    </div>
                                    <div class="start" style="margin-left: 3px;">
                                    <h6>CONTRATOS</h6>
                                        <h6 class="font-extrabold mb-0">0</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-md-3">
                    <div class="card" style="box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;">
                        <div class="card-body px-3 py-4" ondblclick="window.location.href = '<?= web_root ?>admin/vacancy/';">
                            <div class="row">
                                <div class="d-flex justify-content-start">
                                        <div class="stats-icon red mb-2" style="margin-right: 6px;">
                                        <i class="bi-person"></i>
                                    </div>
                                    <div class="start" style="margin-left: 3px;">
                                    <h6>SEDES</h6>
                                        <h6 class="font-extrabold mb-0">0</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card" style="box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;">
                        <div class="card-body px-3 py-4" ondblclick="window.location.href = '<?= web_root ?>admin/vacancy/';">
                            <div class="row">
                                <div class="d-flex justify-content-start">
                                       
                                    <div class="stats-icon blue mb-2" style="margin-right: 6px;">
                                        <i class="bi-person-check-fill"></i>
                                    </div>

                                    <div class="start" style="margin-left: 3px;">
                                    <h6>AREAS</h6>
                                        <h6 class="font-extrabold mb-0">0</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <p><b>Para la creaciòn de vacantes</b></p>

        <div class="col-12 col-lg-12">
            <div class="row">
                <div class="col-md-3">
                    <div class="card" style="box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;">
                        <div class="card-body px-3 py-4" ondblclick="window.location.href = '<?= web_root ?>admin/areas/';">
                            <div class="row">
                                <div class="d-flex justify-content-start">
                                    <div class="stats-icon purple mb-2" style="margin-right: 6px;">
                                        <i class="bi-people-fill"></i>
                                    </div>
                                    <div class="start" style="margin-left: 3px;">
                                    <div class="start" style="margin-left: 3px;">
                                    <h6>AREAS</h6>
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

                <div class="col-md-3">
                    <div class="card" style="box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;">
                        <div class="card-body px-3 py-4" ondblclick="window.location.href = '<?= web_root ?>admin/ocupaciones/';">
                            <div class="row">
                                <div class="d-flex justify-content-start">
                                        <div class="stats-icon red mb-2" style="margin-right: 6px;">
                                                <i class="bi-person-dash-fill"></i>
                                    </div>
                                    <div class="start" style="margin-left: 3px;">
                                    <h6>OCUPACIONES</h6>
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


                <div class="col-md-3">
                    <div class="card" style="box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;">
                        <div class="card-body px-3 py-4" ondblclick="window.location.href = '<?= web_root ?>admin/evaluaciones/evaluacioncrea/';">
                            <div class="row">
                                <div class="d-flex justify-content-start">
                                        <div class="stats-icon red mb-2" style="margin-right: 6px;">
                                        <i class="bi-person"></i>
                                    </div>
                                    <div class="start" style="margin-left: 3px;">
                                    <h6>EVALUACIONES</h6>
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

                <div class="col-md-3">
                    <div class="card" style="box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;">
                        <div class="card-body px-3 py-4" ondblclick="window.location.href = '<?= web_root ?>admin/keywords/';">
                            <div class="row">
                                <div class="d-flex justify-content-start">
                                       
                                    <div class="stats-icon blue mb-2" style="margin-right: 6px;">
                                        <i class="bi-person-check-fill"></i>
                                    </div>

                                    <div class="start" style="margin-left: 3px;">
                                    <h6>PALABRAS CLAVES</h6>
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
            </div>
        </div>


        <p><b>Para el filtro de Cvs</b></p>


        <div class="col-12 col-lg-12">
            <div class="row">
            <div class="col-md-3">
                    <div class="card" style="box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;">
                        <div class="card-body px-3 py-4" ondblclick="window.location.href = '<?= web_root ?>admin/keywords/';">
                            <div class="row">
                                <div class="d-flex justify-content-start">
                                       
                                    <div class="stats-icon blue mb-2" style="margin-right: 6px;">
                                        <i class="bi-person-check-fill"></i>
                                    </div>

                                    <div class="start" style="margin-left: 3px;">
                                    <h6>PALABRAS CLAVES</h6>
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
            </div>
        </div>
    </div>

</div> -->
