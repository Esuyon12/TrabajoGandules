<style>
    .card {
        background-color: #f3f7f8;
        width: 100%;
        box-sizing: border-box;
        padding: 16px 0;
        border-radius: 12px;
        position: relative;
    }
</style>

<?php
if (isset($_GET['search'])) {
    # code...
    $jobid = $_GET['search'];
} else {
    $jobid = '';
}
$sql = "SELECT * FROM `tblcompany` c,`tbljob` j WHERE c.`COMPANYID`=j.`COMPANYID` AND JOBID LIKE '%" . $jobid . "%' ORDER BY DATEPOSTED DESC";
$mydb->setQuery($sql);
$cur = $mydb->loadResultList();

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

?>

<div class="contact_section layout_padding">
    <div class="container">
        <?php foreach ($cur as $result) {
        } ?>
        <div class="row">
            <h1 class="contact_taital text-left">DETALLES DEL TRABAJO</h1>
            <div class="col-md-7">
                <h1 class="font-weight-bold"><?= $result->OCCUPATIONTITLE; ?></h1>
                <div class="d-flex mb-3">
                    <ul>
                        <li>Numero requerido de empleados: <?= $result->REQ_NO_EMPLOYEES ?></li>
                        <li>Salario: <?= number_format($result->SALARIES, 2) ?></li>
                        <li>Duracion del empleo: <?= $result->DURATION_EMPLOYEMENT ?></li>
                        <li>Sector de vacante: <?= $result->SECTOR_VACANCY ?></li>
                    </ul>
                </div>
                <div class="d-flex flex-column mb-3">
                    <h5 class="font-weight-bold">Calificacion/Experiencia Laboral</h5>
                    <p class="text-muted text-left" style="margin: 0px;"><?= $result->QUALIFICATION_WORKEXPERIENCE ?></p>
                </div>
                <div class="d-flex flex-column mb-3">
                    <h5 class="font-weight-bold">Descripcion del trabajo</h5>
                    <p class="tex-muted" style="margin:0;"><?= $result->JOBDESCRIPTION ?></p>
                </div>
                <div class="d-flex flex-column mb-3">
                    <h5 class="font-weight-bold">Sede</h5>
                    <p class="tex-muted" style="margin:0;"><?= $result->COMPANYNAME ?></p>
                </div>
                <div class="d-flex flex-column mb-3">
                    <h5 class="font-weight-bold">Centro de trabajo</h5>
                    <p class="tex-muted" style="margin:0;"><?= $result->COMPANYADDRESS ?></p>
                </div>
                <div class="d-flex justify-content-end">
                    <p class="text-muted"><?= time_ago($result->DATEPOSTED) ?></p>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card">
                    <form action="process.php?action=submitapplication&JOBID=<?= $result->JOBID; ?>" method="POST">
                        <h4 class="contact_taital">Postula Ya</h4>
                        <div class="card-body">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="LNAME" name="LNAME" placeholder="...">
                                <label for="LNAME">Apellido Paterno</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="MNAME" name="MNAME" placeholder="...">
                                <label for="MNAME">Apellido Materno</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="FNAME" name="FNAME" placeholder="...">
                                <label for="FNAME">Nombres</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="ADDRESS" name="ADDRESS" placeholder="...">
                                <label for="ADDRESS">Direccion</label>
                            </div>
                            <div class="d-flex mb-3 flex-column">
                                <label for="">Sexo</label>
                                <div class="d-flex">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="Female">
                                        <label class="form-check-label" for="inlineRadio1">Mujer</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="Male">
                                        <label class="form-check-label" for="inlineRadio2">Hombre</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="number" class="form-control" id="TELNO" name="TELNO">
                                <label for="TELNO">Numero de contacto</label>
                            </div>
                            <div class="d-flex mb-3">
                                <label for="">Estado civil</label>
                                <input class="form-control" list="datalistOptions" id="exampleDataList" name="CIVILSTATUS">
                                <datalist id="datalistOptions">
                                    <option value="Casado">
                                    <option value="Soltero">
                                    <option value="Viudo">
                                    <option value="Otro">
                                </datalist>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="EMAILADDRESS" name="EMAILADDRESS" placeholder="...">
                                <label for="EMAILADDRESS">Correo electronico</label>
                            </div>
                            <div class="form-floating mb-3">
                                <textarea class="form-control" name="DEGREE" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
                                <label for="floatingTextarea2">Observacion</label>
                            </div>
                            <button class="btn btn-primary" name="submit">Postular</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>