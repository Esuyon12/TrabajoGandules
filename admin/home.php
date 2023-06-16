<?php

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
?>



<style>
    .btn-gris {
        background-image: linear-gradient(to right,
                #606c88 0%,
                #3f4c6b 51%,
                #606c88 100%);
        margin: 10px;
        padding: 9px 45px;
        text-align: center;
        text-transform: uppercase;
        transition: 0.5s;
        background-size: 200% auto;
        color: white;
        box-shadow: 0 0 20px #eee;
        border-radius: 10px;
        display: block;
    }

    .btn-gris:hover {
        background-position: right center;
        /* change the direction of the change here */
        color: #fff;
        text-decoration: none;
    }
</style>



<div class="container">
    <div class=" page-heading">
        <h3><b>PANEL DE ADMINISTRACIÓN</b></h3>
    </div>
    <div class="page-content">
        <div class="col-12 col-lg-12">
            <div class="row">
                <div class="col-md-3">
                    <div class="card" style="box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;">
                        <div class="card-body px-3 py-4" ondblclick="window.location.href = '<?= web_root ?>admin/vacancy/';">
                            <div class="row">
                                <div class="d-flex justify-content-start">
                                    <div class="stats-icon purple mb-2">
                                        <i class="bi-people-fill"></i>
                                    </div>
                                </div>
                                <div class="">
                                    <h6 class="text-muted font-semibold">Vacantes Activas</h6>
                                    <?php if (isset($totalVacantesActivas->TOTAL)) : ?>
                                        <h6 class="font-extrabold mb-0"><?php echo $totalVacantesActivas->TOTAL; ?></h6>
                                    <?php else : ?>
                                        <h6 class="font-extrabold mb-0">0</h6>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card" style="box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;">
                        <div class="card-body px-3 py-4" ondblclick="window.location.href = '<?= web_root ?>admin/applicants/';">
                            <div class="row">
                                <div class="d-flex justify-content-start">
                                    <div class="stats-icon red mb-2">
                                        <i class="bi-person-dash-fill"></i>
                                    </div>
                                </div>
                                <div class="">
                                    <h6 class="text-muted font-semibold">Aplicantes</h6>
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

                <div class="col-md-3">
                    <div class="card" style="box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;">
                        <div class="card-body px-3 py-4" ondblclick="window.location.href = '<?= web_root ?>admin/employee/';">
                            <div class="row">
                                <div class="d-flex justify-content-start">
                                    <div class="stats-icon red mb-2">
                                        <i class="bi-person"></i>
                                    </div>
                                </div>
                                <div class="">
                                    <h6 class="text-muted font-semibold">Empleados</h6>
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

                <div class="col-md-3">
                    <div class="card" style="box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;">
                        <div class="card-body px-3 py-4" ondblclick="window.location.href = '<?= web_root ?>admin/user/';">
                            <div class="row">
                                <div class="d-flex justify-content-start">
                                    <div class="stats-icon blue mb-2">
                                        <i class="bi-person-check-fill"></i>
                                    </div>
                                </div>
                                <div class="">
                                    <h6 class="text-muted font-semibold">Usuarios</h6>
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
        </div>

        <div class="col-12 col-lg-12">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div id="chart"></div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <p><b>OCUPACIONES CON VACANTES </b></p>
                            <br>
                            <div class="row g-4">
                                <?php
                                $sql = "SELECT DISTINCT a.OCUPACIONID, a.OCUPACION
                                    FROM `tblocupaciones` a
                                    INNER JOIN `tbljob` j ON a.OCUPACIONID = j.OCUPACIONID
                                    WHERE a.OCUPACIONSTATUS = 1 AND j.JOBSTATUS = 'Activa'";
                                $mydb->setQuery($sql);
                                $cur = $mydb->loadResultList();
                                $counter = 0;

                                foreach ($cur as $result) {
                                    $counter++;
                                    if ($counter <= 6) {
                                ?>
                                        <div class="col-lg-12">
                                            <div class="btn-gris">
                                                <a href="<?= web_root ?>admin/ocupaciones/">
                                                    <p style="color:#fff"><?php echo $result->OCUPACION ?></p>
                                                </a>
                                            </div>
                                        </div>

                                <?php
                                    }
                                }
                                ?>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>


    </div>

</div>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    var count = <?php echo $total->TOTAL ?>;

    // Configurar los datos para el gráfico
    var options = {
        chart: {
            type: 'bar',
            height: 350
        },
        series: [{
                name: 'Pendiente',
                data: [<?php echo $pent->TOTAL ?>]
            },
            {
                name: 'Total',
                data: [<?php echo $total->TOTAL ?>]
            },
            {
                name: 'Revision',
                data: [<?php echo $rev->TOTAL ?>]
            }
        ],
        xaxis: {
            categories: ['Conteo de registros']
        }
    };

    var chart = new ApexCharts(document.querySelector("#chart"), options);
    chart.render();
</script>