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


$mydb->setQuery("SELECT COUNT(*) AS TOTAL FROM tblemployees WHERE ESTADO = 0 AND MONTH(DATEHIRED) = MONTH(CURRENT_DATE())");
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


<div class="page-heading">
    <h3><b>PANEL DE ADMINISTRACIÓN</b></h3>
</div>
<div class="page-content">
    <section class="row">
        <div class="col-12 col-lg-8">
            <div class="row">
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5" ondblclick="window.location.href = '<?= web_root ?>admin/vacancy/';">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                    <div class="stats-icon red mb-2">
                                        <i class="iconly-boldBookmark"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Vacantes</h6>
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
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5" ondblclick="window.location.href = '<?= web_root ?>admin/vacancy/';">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                    <div class="stats-icon blue mb-2">
                                        <i class="bi-people-fill"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
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
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5" ondblclick="window.location.href = '<?= web_root ?>admin/vacancy/';">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                    <div class="stats-icon green mb-2">
                                        <i class="bi-person"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
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
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5" ondblclick="window.location.href = '<?= web_root ?>admin/vacancy/';">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                    <div class="stats-icon blue mb-2">
                                        <i class="bi-person-check-fill"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
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

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Estado de evaluaciones</h4>
                        </div>
                        <div class="card-body">
                            <div id="chart"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h4>Aplicantes recientes</h4>
                </div>
                <div class="card-content pb-4">
                    <?php
                    $sql = "SELECT A.FNAME, A.LNAME, O.OCUPACION, A.CVFILE
                FROM `tblapplicants` AS A
                INNER JOIN `tbljob` AS J ON A.JOBID = J.JOBID
                INNER JOIN `tblocupaciones` AS O ON J.OCUPACIONID = O.OCUPACIONID
                ORDER BY A.APPLICANTID DESC
                LIMIT 3";
                    $mydb->setQuery($sql);
                    $applicants = $mydb->loadResultList();

                    foreach ($applicants as $applicant) {
                    ?>
                        <div class="px-4">
                            <div class="card border">
                                <div class="recent-message d-flex px-4 py-3">
                                    <div class="name ms-4">
                                        <h6 class="mb-1"><?php echo $applicant->FNAME . ' ' . $applicant->LNAME; ?></h6>
                                        <h6 class="text-muted mb-0"><?php echo $applicant->OCUPACION; ?></h6>
                                        <p>
                                            <img src="assets/images/icon/pdf.png" alt="Icono PDF" class="pdf-icon"> <?php echo $applicant->CVFILE; ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>

                    <div class="px-4">
                        <a href="<?= web_root ?>admin/applicants/">
                            <button class="btn btn-block btn-xl btn-success font-bold mt-2">
                                Ver todos
                            </button>
                        </a>
                    </div>
                </div>
            </div>

        </div>

    </section>

    <!-- <section class="row">

        <div class="col-12 col-lg-6">
            <div class="row">
                <div class="card">
                    <div class="card-header">
                        <h4>Aplicantes recientes</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-lg">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Ocupación</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="col-4">
                                            <p>Hola</p>
                                        </td>
                                        <td class="col-auto">
                                            <p class="mb-0">
                                                Congratulations on your graduation!

                                            </p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="px-4">
                                <a href="<?= web_root ?>admin/applicants/">
                                    <button class="btn btn-block btn-xl btn-outline-primary font-bold mt-3">
                                        Ver todos
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4>Aplicantes recientes</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-lg">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Ocupación</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="col-4">
                                        <p>Hola</p>
                                    </td>
                                    <td class="col-auto">
                                        <p class="mb-0">
                                            Congratulations on your graduation!

                                        </p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="px-4">
                            <a href="<?= web_root ?>admin/applicants/">
                                <button class="btn btn-block btn-xl btn-outline-primary font-bold mt-3">
                                    Ver todos
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> -->
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