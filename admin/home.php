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


<!-- 
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
                                    if ($counter <= 5) {
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

</div> -->








<div class="page-heading">
    <h3><b>PANEL DE ADMINISTRACIÓN</b></h3>
</div>
<div class="page-content">
    <section class="row">
        <div class="col-12 col-lg-9">
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

            <div class="row">
                <div class="col-12 col-xl-8">
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
                                            <td class="col-3">
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar avatar-md">
                                                        <img src="./assets/compiled/jpg/5.jpg" />
                                                    </div>
                                                    <p class="font-bold ms-3 mb-0">Si Cantik</p>
                                                </div>
                                            </td>
                                            <td class="col-auto">
                                                <p class="mb-0">
                                                    Congratulations on your graduation!
                                                </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="col-3">
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar avatar-md">
                                                        <img src="./assets/compiled/jpg/2.jpg" />
                                                    </div>
                                                    <p class="font-bold ms-3 mb-0">Si Ganteng</p>
                                                </div>
                                            </td>
                                            <td class="col-auto">
                                                <p class="mb-0">
                                                    Wow amazing design! Can you make another
                                                    tutorial for this design?
                                                </p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-3">
            <div class="card">
                <div class="card-body py-4 px-4">
                    <div class="d-flex align-items-center">
                        <div class="avatar avatar-xl">
                            <img src="<?= web_root ?>admin/user/photos/<?php echo $_SESSION['ADMIN_FOTO'] ?>" />
                        </div>
                        <div class="ms-3 name">
                            <h5 class="font-bold"><?= $_SESSION['ADMIN_USERNAME'] ?></h5>
                            <h6 class="text-muted mb-0">@<?= $_SESSION['ADMIN_ROLE'] ?></h6>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h4>Aplicantes recientes</h4>
                </div>
                <div class="card-content pb-4">
                    <?php
                    $sql = "SELECT FNAME, LNAME, JOBID FROM `tblapplicants` ORDER BY APPLICANTID DESC LIMIT 3";
                    $mydb->setQuery($sql);
                    $applicants = $mydb->loadResultList();

                    foreach ($applicants as $applicant) {
                    ?>
                        <div class="recent-message d-flex px-4 py-3">
                            <div class="name ms-4 ">
                                <h6 class="mb-1"><?php echo $applicant->FNAME . ' ' . $applicant->LNAME; ?></h6>
                                <!-- <h6 class="text-muted mb-0">@<?php echo $applicant->JOBID; ?></h6> -->
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                    <div class="px-4">
                        <a href="<?= web_root ?>admin/applicants/">
                            <button class="btn btn-block btn-xl btn-outline-primary font-bold mt-3">
                                Ver todos
                            </button>
                        </a>
                    </div>
                </div>
            </div>

            <!-- <div class="card">
                <div class="card-header">
                    <h4>Visitors Profile</h4>
                </div>
                <div class="card-body">
                    <div id="chart-visitors-profile"></div>
                </div>
            </div> -->
        </div>

        <!-- <div class="col-md-6">
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
                            if ($counter <= 5) {
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
        </div> -->

    </section>
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