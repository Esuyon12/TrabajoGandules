<div class=single-inner><?php
                        if (isset($_GET['search'])) {
                            # code...
                            $jobid = $_GET['search'];
                        } else {
                            $jobid = '';
                        }

                        $sql = "SELECT * FROM `tblcompany` c,`tbljob` j WHERE c.`COMPANYID`=j.`COMPANYID` AND JOBID LIKE '%" . $jobid . "%' ORDER BY DATEPOSTED DESC";
                        $mydb->setQuery($sql);
                        $cur = $mydb->loadResultList();

                        $_SESSION['COMPANYID'] = $cur[0]->COMPANYID;
                        $_SESSION['JOBID'] = $cur[0]->JOBID;

                        function fechaespañol($fecha)
                        {

                            $meses = array(
                                'January' => 'Enero',
                                'February' => 'Febrero',
                                'March' => 'Marzo',
                                'April' => 'Abril',
                                'May' => 'Mayo',
                                'June' => 'Junio',
                                'July' => 'Julio',
                                'August' => 'Agosto',
                                'September' => 'Septiembre',
                                'October' => 'Octubre',
                                'November' => 'Noviembre',
                                'December' => 'Diciembre'
                            );

                            $dias_semana = array(
                                'Sunday' => 'Domingo',
                                'Monday' => 'Lunes',
                                'Tuesday' => 'Mmartes',
                                'Wednesday' => 'Miércoles',
                                'Thursday' => 'Jueves',
                                'Friday' => 'Viernes',
                                'Saturday' => 'Sábado'
                            );

                            // Obtener los nombress de los días de la semana y del mes en español
                            $fecha_formateada = $dias_semana[date('l', strtotime($fecha))] . ', ' . date('d', strtotime($fecha)) . ' de ' . $meses[date('F', strtotime($fecha))] . ' de ' . date('Y', strtotime($fecha));

                            echo $fecha_formateada;
                        }

                        function time_ago($timestamp)
                        {
                            $time_ago = strtotime($timestamp);
                            $current_time = time();
                            $time_difference = $current_time - $time_ago;
                            $seconds = $time_difference;
                            $minutes = round($seconds / 60);
                            $hours = round($seconds / 3600);
                            $days = round($seconds / 86400);
                            $weeks = round($seconds / 604800);
                            $months = round($seconds / 2629440);
                            $years = round($seconds / 31553280);

                            if ($seconds <= 60) {
                                return "just now";
                            } else if ($minutes <= 60) {
                                if ($minutes == 1) {
                                    return "Publicado hace un minuto";
                                } else {
                                    return "Hace $minutes minutos";
                                }
                            } else if ($hours <= 24) {
                                if ($hours == 1) {
                                    return "Publicado hace una hora";
                                } else {
                                    return "Publicado hace $hours horas";
                                }
                            } else if ($days <= 7) {
                                if ($days == 1) {
                                    return "Publicado ayer";
                                } else {
                                    return "Publicado hace $days dias";
                                }
                            } else if ($weeks <= 4.3) {
                                if ($weeks == 1) {
                                    return "Hace una semana";
                                } else {
                                    return "Hace $weeks semanas";
                                }
                            } else if ($months <= 12) {
                                if ($months == 1) {
                                    return "Hace un mes";
                                } else {
                                    return "Hace $months meses";
                                }
                            } else {
                                if ($years == 1) {
                                    return "Hace un año";
                                } else {
                                    return "Hace $years años";
                                }
                            }
                        };

                        setlocale(LC_TIME, 'es_ES.utf-8');
                        ?>

    <div class=post-details>
        <div class=detail-inner>
            <h2 class=post-title>
                <h1 class="font-weight-bold"><?= $result->OCCUPATION; ?></h1>
            </h2>
            <ul class="custom-flex post-meta">
                <li>
                    <a href="javascript:void(0)">
                        <i class="lni lni-calendar"></i>
                        <!-- <?php echo $result->DATEPOSTED ?> -->
                        <?php echo fechaespañol($result->DATEPOSTED); ?>
                    </a>
                </li>

                <li>
                    <a href="javascript:void(0)">
                        <i class="bi bi-building"></i> <?= $result->COMPANYNAME ?>
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0)">
                        <i class="bi bi-geo-alt"></i>
                        <?= $result->COMPANYADDRESS ?>
                    </a>
                </li>
            </ul>
            <ul class=list>
                <li><i class="lni lni-chevron-right"></i>Numero requerido de empleados: <?= $result->REQ_EMPLOYEES ?></li>
                <li><i class="lni lni-chevron-right"></i> Salario: <?= number_format($result->SUELDO, 2) ?></li>
                <li><i class="lni lni-chevron-right"></i>Preferencia de genero: <?= $result->GENERO ?></li>

            </ul>

            <h3>Requisitos</h3>
            <p class="text-muted text-left" style="margin: 0px;"><?= $result->WORKEXPERIENCE ?></p>

            <h3>Funciones</h3>
            <p class="tex-muted" style="margin:0;"><?= $result->JOBDESCRIPTION ?></p>

            <h3>Beneficios</h3>
            <p class="tex-muted" style="margin:0;"><?= $result->BENEFICIOS ?></p>

            <h3>Centro de trabajo</h3>
            <p class="tex-muted" style="margin:0;"><?= $result->COMPANYADDRESS ?></p>

            <div class="d-flex justify-content-between align-items-center">

                <p class="text-muted"> <?php echo fechaespañol($result->DATEPOSTED); ?>
                </p>
            </div>
        </div>
    </div>
</div>

<script>
    window.print();
    window.close();
</script>