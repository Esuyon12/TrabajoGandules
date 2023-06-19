    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-light footer mt-5 py-5 wow fadeIn" data-wow-delay="0.1s">
      <div class="container py-5">
        <div class="row g-5">

          <div class="col-lg-2 col-md-3">
            <img class="img-fluid w-90 h-90" src="assets/images/hero/logo-blanco.png" alt="">
          </div>

          <div class="col-lg-4 col-md-3">
            <h4 class="text-white mb-4">Nuestra ubicación</h4>
            <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>Predio Sono Nro. S/N Fundo La Viña Jayanca</p>
            <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>(+511) 627 0300</p>
            <p class="mb-2"><i class="fa fa-envelope me-3"></i>info@gandules.com.pe</p>
            <div class="d-flex pt-2">
              <a class="btn btn-square btn-outline-light rounded-circle me-2" href="https://www.instagram.com/gandulesinc/" target="_blank"><i class="fab fa-instagram"></i></a>
              <a class="btn btn-square btn-outline-light rounded-circle me-2" href="https://web.facebook.com/GandulesInc" target="_blank"><i class="fab fa-facebook-f"></i></a>
              <a class="btn btn-square btn-outline-light rounded-circle me-2" href="https://www.youtube.com/@gandulesinc3797" target="_blank"><i class="fab fa-youtube"></i></a>
              <a class="btn btn-square btn-outline-light rounded-circle me-2" href="https://www.tiktok.com/@gandulesjayanca" target="_blank"><i class="fab fa-tiktok"></i></a>
            </div>

          </div>
          <div class="col-lg-3 col-md-3">
            <h4 class="text-white mb-4">Sedes</h4>
            <?php
            $sql = "SELECT * FROM `tblcompany` WHERE `COMPANYSTATUS` = 1 LIMIT 3";
            $mydb->setQuery($sql);
            $comp = $mydb->loadResultList();
            ?>
            <?php foreach ($comp as $company) {
              $companyUrl = web_root . 'index.php?q=hiring&search=' . $company->COMPANYNAME;
            ?>
              <div class="single-grid wow fadeInUp w-100">
                <a class="btn btn-link" href="<?php echo $companyUrl; ?>"><?php echo $company->COMPANYNAME; ?></a>
              </div>
            <?php } ?>
            <a href="<?php echo web_root; ?>index.php?q=company" class="btn btn-link">Más detalles</a>
          </div>




          <div class="col-lg-3 col-md-6">
    <h4 class="text-white mb-4">Áreas</h4>
    <?php
    $sql = "SELECT *
        FROM `tblareas`
        WHERE `ESTADO` = 1 AND `AREAID` IN (SELECT DISTINCT `AREAID` FROM `tbljob` WHERE `JOBSTATUS` = 'Disponible')
        LIMIT 3";
    $mydb->setQuery($sql);
    $areas = $mydb->loadResultList();

    foreach ($areas as $area) {
        $areaUrl = URL_WEB . web_root . 'index.php?q=trabajos&area=' . urlencode($area->AREA);
    ?>
        <div class="single-grid wow fadeInUp w-100">
            <a class="btn btn-link" href="<?php echo $areaUrl; ?>">
                <?php echo $area->AREA; ?>
            </a>
        </div>
    <?php
    }
    ?>
    <a href="<?php echo URL_WEB . web_root; ?>index.php?q=area" class="btn btn-link">Más detalles</a>
</div>



        </div>
      </div>
    </div>
    <!-- Footer End -->





    <!-- Copyright Start -->
    <div class="container-fluid copyright py-4">
      <div class="container">
        <div class="row">
          <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
            &copy; <a class="border-bottom" href="Index.php">Trabaja con nosotros Gandules</a>, todos los derechos son reservados.
          </div>
          <div class="col-md-6 text-center text-md-end">
          </div>
        </div>
      </div>
    </div>
    <!-- Copyright End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i class="bi bi-arrow-up"></i></a>

    <script src="assets/dist/js.00a46daa.js"></script>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/lib/wow/wow.min.js"></script>
    <script src="assets/lib/easing/easing.min.js"></script>
    <script src="assets/lib/waypoints/waypoints.min.js"></script>
    <script src="assets/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="assets/lib/counterup/counterup.min.js"></script>
    <script src="assets/lib/parallax/parallax.min.js"></script>
    <script src="assets/lib/isotope/isotope.pkgd.min.js"></script>
    <script src="assets/lib/lightbox/js/lightbox.min.js"></script>

    <script src="assets/js/main.js"></script>
    </body>

    </html>