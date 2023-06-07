<?php
global $mydb;
$red_id = isset($_GET['id']) ? $_GET['id'] : '';

$jobregistration = new JobRegistration();
$jobreg = $jobregistration->single_jobregistration($red_id);
// `COMPANYID`, `JOBID`, `APPLICANTID`, `APPLICANT`, `REGISTRATIONDATE`, `REMARKS`, `FILEID`, `PENDINGAPPLICATION`


$applicant = new Applicants();
$appl = $applicant->single_applicant($jobreg->APPLICANTID);
// `FNAME`, `LNAME`, `MNAME`, `ADDRESS`, `SEX`, `CIVILSTATUS`, `BIRTHDATE`, `BIRTHPLACE`, `AGE`, `USERNAME`, `PASS`, `EMAILADDRESS`,CONTACTNO

$jobvacancy = new Jobs();
$job = $jobvacancy->single_job($jobreg->JOBID);
// `COMPANYID`, `CATEGORY`, `OCCUPATIONTITLE`, `REQ_NO_EMPLOYEES`, `SALARIES`, `DURATION_EMPLOYEMENT`, `QUALIFICATION_WORKEXPERIENCE`, `JOBDESCRIPTION`, `PREFEREDSEX`, `SECTOR_VACANCY`, `JOBSTATUS`, `DATEPOSTED`

$company = new Company();
$comp = $company->single_company($jobreg->COMPANYID);
// `COMPANYNAME`, `COMPANYADDRESS`, `COMPANYCONTACTNO`

$sql = "SELECT * FROM `tblattachmentfile` WHERE `FILEID`=" . $jobreg->FILEID;
$mydb->setQuery($sql);
$attachmentfile = $mydb->loadSingleResult();


?>
<style type="text/css">
    .content-header {
        min-height: 50px;
        border-bottom: 1px solid #ddd;
        font-size: 15px;
        font-weight: bold;
    }

    .content-body {
        min-height: 350px;
        /*border-bottom: 1px solid #ddd;*/
    }

    .content-body>p {
        padding: 10px;
        font-size: 12px;
        font-weight: bold;
        border-bottom: 1px solid #ddd;
    }

    .content-footer {
        min-height: 100px;
        border-top: 1px solid #ddd;

    }

    .content-footer>p {
        padding: 5px;
        font-size: 15px;
        font-weight: bold;
    }

    .content-footer textarea {
        width: 100%;
        height: 200px;
    }

    .content-footer .submitbutton {
        margin-top: 20px;
        /*padding: 0;*/

    }
</style>
<form action="controller.php?action=approve" method="POST">
    <div class="row">
        <h2 class="text-uppercase mb-3">Detalles de <?= $appl->FNAME . ' ' . $appl->LNAME . ' ' . $appl->MNAME; ?></h2>
        <div class="card d-none">
            <div class="card-body">
                <input type="hidden" name="JOBREGID" value="<?php echo $jobreg->REGISTRATIONID; ?>">
                <input type="hidden" name="APPLICANTID" value="<?php echo $appl->APPLICANTID; ?>">
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <p class="text-muted">Detalles de trabajo</p>
                    <h3><?php echo $job->OCCUPATIONTITLE; ?></h3>
                </div>
                <div class="card-body">
                    <ul>
                        <li><i class="fp-ht-bed"></i>Numero de trabajadores requeridos: <?php echo $job->REQ_NO_EMPLOYEES; ?></li>
                        <li><i class="fp-ht-food"></i>Sueldo : <?php echo number_format($job->SALARIES, 2);  ?></li>
                        <li><i class="fa fa-sun-"></i>Duración de empleo : <?php echo $job->DURATION_EMPLOYEMENT; ?></li>
                    </ul>
                    <ul>
                        <li><i class="fp-ht-tv"></i>Genero de preferencia : <?php echo $job->PREFEREDSEX; ?></li>
                        <li><i class="fp-ht-computer"></i>Lugar de trabajo : <?php echo $job->SECTOR_VACANCY; ?></li>
                    </ul>
                    <?php if (!empty($job->JOBDESCRIPTION)) { ?>
                        <div class="d-flex flex-column">
                            <p>DESCRIPCIÓN DE FUNCIONES</p>
                            <p style="margin-left: 15px;"><?php echo $job->JOBDESCRIPTION; ?></p>
                        </div>
                    <?php } ?>

                    <?php if (!empty($job->QUALIFICATION_WORKEXPERIENCE)) { ?>
                        <div class="d-flex flex-column">
                            <p>EXPERIENCIA LABORAL</p>
                            <p style="margin-left: 15px;"><?php echo $job->QUALIFICATION_WORKEXPERIENCE; ?></p>
                        </div>
                    <?php } ?>
                    <?php if (!empty($comp->COMPANYNAME)) { ?>
                        <div class="d-flex flex-column">
                            <p>SEDE CONTRATANTE : </p>
                            <p style="margin-left: 15px;">Nombre de sede: <?php echo $comp->COMPANYNAME; ?></p>
                            <?php if (!empty($comp->COMPANYADDRESS)) { ?>
                                <p style="margin-left: 15px;">Dirección de trabajo: @<?php echo $comp->COMPANYADDRESS; ?></p>
                            <?php } ?>
                        </div>
                    <?php } ?>

                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <p class="text-muted">Informacion del aplicante</p>
                    <h3 class="text-uppercase"> <?php echo $appl->FNAME . ' ' . $appl->LNAME . ' ' . $appl->MNAME; ?></h3>
                </div>
                <div class="card-body">
                    <ul>
                        <li>Dirección : <?php echo $appl->ADDRESS; ?></li>
                        <li>Número de contacto : <?php echo $appl->CONTACTNO; ?></li>
                        <li>Correo electronico : <?php echo $appl->EMAILADDRESS; ?></li>
                        <li>Genero: <?php echo $appl->SEX; ?></li>
                        <li>Edad : <?php echo $appl->AGE; ?></li>
                    </ul>
                    <div class="d-flex flex-column">
                        <p>ALGUNA OBSERVACIÓN: </p>
                        <p style="margin-left: 15px;"><?php echo $appl->DEGREE; ?></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <p class="text-muted"><i class="fa fa-paperclip"></i> Archivos adjuntos</p>
                    <h3>Descargar Resumen <a href="<?php echo web_root . 'applicant/' . $attachmentfile->FILE_LOCATION; ?>">Aqui</a></h3>
                </div>
                <div class="card-body">
                    <div class="form-floating mb-3">
                        <textarea class="form-control" name="REMARKS" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"><?php echo isset($jobreg->REMARKS) ? $jobreg->REMARKS : ""; ?></textarea>
                        <label for="floatingTextarea2">Comentario</label>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" name="submit" class="btn btn-primary">Enviar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>