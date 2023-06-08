<style>
    .single-grid {
        transition: all .5s ease !important;
    }

    .single-grid:hover {
        box-shadow: inset 0 10px 30px rgba(35, 38, 45, 0.14) !important;
    }

    .bg-danger {
        background-color: #fff7dc !important;
    }
</style>


<!-- Page Header Start -->
<div class="container-fluid py-2S mb-3">
    <div class="container text-left py-5" style="text-align: center;">
        <h1 class="text-uppercase" style="color: black;">TODAS NUESTRAS SEDES</h1>
    </div>
</div>
<!-- Page Header End -->


<div class="container-xxl py-5">
    <div class="container">
        <!-- <div class="text-center mx-auto wow fadeInUp mb-4" data-wow-delay="0.1s" style="max-width: 900px;">
            <h1 class="display-5 mb-5">CONOCE NUESTRAS SEDES</h1>
        </div> -->

        <div class="row g-4">

            <?php
            $sql = "SELECT * FROM `tblcompany`";
            $mydb->setQuery($sql);
            $comp = $mydb->loadResultList();
            ?>

            <?php foreach ($comp as $company) {
                $companyUrl = web_root . 'index.php?q=hiring&search=' . $company->COMPANYNAME;

                $status = $company->COMPANYSTATUS;
                if ($status == '0') {
                    continue; // Si la sede está inactiva, salta a la siguiente iteración del bucle
                }

                $cardClass = ($status == '0') ? 'bg-danger' : '';
                $hasActiveVacancies = false;

                // Verificar si la compañía tiene vacantes activas
                $vacancySql = "SELECT * FROM `tbljob` WHERE `COMPANYID` = " . $company->COMPANYID;
                $mydb->setQuery($vacancySql);
                $vacancies = $mydb->loadResultList();

                foreach ($vacancies as $vacancy) {
                    if ($vacancy->JOBSTATUS == '0') {
                        $hasActiveVacancies = true;
                        break;
                    }
                }
            ?>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-item rounded d-flex flex-column h-100">
                        <div class="service-img rounded flex-grow-1">
                            <img class="img-fluid w-100 h-100" src="assets/images/hero/1.PNG" alt="">
                        </div>
                        <div class="service-text rounded p-5">
                            <?php if ($hasActiveVacancies) { ?>
                                <a href="<?php echo ($status == '1') ? $companyUrl : '#'; ?>" class="single-grid wow fadeInUp w-100 <?php echo $cardClass; ?>">
                                    <div class="btn-square rounded-circle mx-auto mb-3">
                                        <img class="img-fluid" src="assets/img/icon/icon-3.png" alt="Icon">
                                    </div>
                                    <h4 class="mb-3"><?php echo $company->COMPANYNAME; ?></h4>
                                    <p class="mb-4"><?php echo $company->COMPANYADDRESS; ?></p>
                                    <p class="mb-0 badge btn-grad">Vacantes disponibles</p>
                                </a>
                            <?php } else { ?>
                                <div class="single-grid wow fadeInUp w-100 <?php echo $cardClass; ?>">
                                    <div class="btn-square rounded-circle mx-auto mb-3">
                                        <img class="img-fluid" src="assets/img/icon/icon-3.png" alt="Icon">
                                    </div>
                                    <h4 class="mb-3"><?php echo $company->COMPANYNAME; ?></h4>
                                    <p class="mb-4"><?php echo $company->COMPANYADDRESS; ?></p>
                                    <p class="mb-0 badge btn-red">No hay vacantes disponibles</p>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>

            <?php } ?>

        </div>
    </div>
</div>