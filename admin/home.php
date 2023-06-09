<?php

$mydb->setQuery("SELECT COUNT(*) AS TOTAL FROM tblapplicants WHERE MONTH(DATEADD) = 6 AND STATE = 0");
$total = $mydb->loadSingleResult();

$mydb->setQuery("SELECT COUNT(*) AS TOTAL
FROM tblapplicants a
INNER JOIN tblevaluaciones e ON a.APPLICANTID = e.APPLICANTID
WHERE MONTH(DATEADD) = 6 AND e.RESPUESTA IS NULL;
");
$pent = $mydb->loadSingleResult();

$mydb->setQuery("SELECT COUNT(*) AS TOTAL 
FROM tblapplicants a 
INNER JOIN tblevaluaciones e ON a.APPLICANTID = e.APPLICANTID 
WHERE MONTH(DATEADD) = 6 AND e.RESPUESTA IS NOT NULL AND e.RESPUESTA <> ''");
$rev = $mydb->loadSingleResult();
?>

<div class="container">
    <div class=" page-heading">
        <h3><b>PANEL DE ADMINISTRACIÓN</b></h3>

    </div>
    <div class="page-content">
        <div class="col-12 col-lg-12">
            <div class="row">
                <div class="col-md-3">
                    <div class="card" style="box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;">
                        <div class="card-body px-3 py-4">
                            <div class="row">
                                <div class="d-flex justify-content-start ">
                                    <div class="stats-icon purple mb-2">
                                        <i class="bi-people-fill"></i>
                                    </div>
                                </div>
                                <div class="">
                                    <h6 class="text-muted font-semibold">Vacantes disponibles</h6>
                                    <h6 class="font-extrabold mb-0">112</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card" style="box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;">
                        <div class="card-body px-4 py-4">
                            <div class="row">
                                <div class="d-flex justify-content-start ">
                                    <div class="stats-icon red mb-2">
                                        <i class="bi-person"></i>
                                    </div>
                                </div>
                                <div class="">
                                    <h6 class="text-muted font-semibold">Vacantes ocupadas</h6>
                                    <h6 class="font-extrabold mb-0">80</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card" style="box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;">
                        <div class="card-body px-3 py-4">
                            <div class="row">
                                <div class="d-flex">
                                    <div class="stats-icon blue mb-2">
                                        <i class="bi-person-check-fill"></i>
                                    </div>
                                </div>
                                <div class="">
                                    <h6 class="text-muted font-semibold">Postulantes contratados</h6>
                                    <h6 class="font-extrabold mb-0">183</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card" style="box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;">
                        <div class="card-body px-4 py-4">
                            <div class="row">
                                <div class="d-flex justify-content-start ">
                                    <div class="stats-icon red mb-2">
                                        <i class="bi-person-dash-fill"></i>
                                    </div>
                                </div>
                                <div class="">
                                    <h6 class="text-muted font-semibold">Postulantes rechazados</h6>
                                    <h6 class="font-extrabold mb-0">112</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div id="chart"></div>
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