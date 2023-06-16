    <?php

    $mydb->setQuery("SELECT COUNT(*) AS total FROM tblapplicants WHERE STATE = 0");
    $count = $mydb->loadSingleResult();

    // print_r($count); die();
    ?>

    <div id="sidebar" class="active">
      <div class="sidebar-wrapper active">
        <div class="sidebar-header position-relative d-flex justify-content-center">
          <img src="../assets/images/logo/gandules.png"></a>
          <div class="sidebar-toggler x">
            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
          </div>
        </div>

        <div class="sidebar-menu">
          <ul class="menu">
            <li class="sidebar-title">Menu</li>

            <li class="sidebar-item">
              <a href="<?= web_root ?>admin/" class="sidebar-link">
                <i class="bi bi-grid-fill"></i>
                <span>Dashboard</span>
              </a>
            </li>

            <li class="sidebar-item">
              <a href="<?= web_root ?>admin/mantenimiento/" class="sidebar-link">
                <i class="bi bi-grid-fill"></i>
                <span>Mantenimiento</span>
              </a>
            </li>



            <li class="sidebar-item">
              <a href="<?= web_root ?>admin/user/" class="sidebar-link">
                <i class="bi bi-person-fill"></i> <span>Usuarios</span>
              </a>
            </li>

            <li class="sidebar-item">
              <a href="<?= web_root ?>admin/vacancy/" class="sidebar-link">
                <i class="bi bi-briefcase-fill"></i>
                <span>Vacantes</span>
              </a>
            </li>

            <li class="sidebar-item">
              <a href="<?= web_root ?>admin/applicants/" class="sidebar-link d-flex w-100">
                <i class="bi bi-chat-left-fill"></i>
                <span>Solicitudes</span>
                <?php if ($count->total > 0) { ?>
                  <span class="badge bg-success"><?php echo $count->total; ?></span>
                <?php } ?>
              </a>
            </li>

            <li class="sidebar-item">
              <a href="<?= web_root ?>admin/employee/" class="sidebar-link d-flex w-100">
                <i class="bi bi-person-check-fill"></i>
                <span>Empleados</span>
              </a>
            </li>

        </div>

        <div class="sidebar-menu">
          <ul class="menu">
            <li class="sidebar-title">Mantenimiento </li>

            <li class="sidebar-item">
              <a href="<?= web_root ?>admin/correo/" class="sidebar-link">
                <ion-icon name="send"></ion-icon>
                <span>Correos</span>
              </a>
            </li>

            <li class="sidebar-item">
              <a href="<?= web_root ?>admin/modalidad/" class="sidebar-link">
                <ion-icon name="send"></ion-icon>
                <span>Modalidad</span>
              </a>
            </li>


            <li class="sidebar-item">
              <a href="<?= web_root ?>admin/indicaciones/" class="sidebar-link">
                <ion-icon name="document-attach"></ion-icon>
                <span>Indicaciones</span>
              </a>
            </li>

            <li class="sidebar-item">
              <a href="<?= web_root ?>admin/company/" class="sidebar-link">
                <i class="bi bi-bookmark-fill"></i>
                <span>Sedes</span>
              </a>
            </li>

            <li class="sidebar-item">
              <a href="<?= web_root ?>admin/areas/" class="sidebar-link">
                <i class="bi bi-stack"></i> <span>Áreas</span>
              </a>
            </li>

            <li class="sidebar-item">
              <a href="<?= web_root ?>admin/ocupaciones/" class="sidebar-link">
                <i class="bi bi-bar-chart-line-fill"></i>
                <span>Ocupaciones</span>
              </a>
            </li>

            <li class="sidebar-item">
              <a href="<?= web_root ?>admin/evaluaciones/evaluacioncrea" class="sidebar-link">
                <i class="bi bi-file-earmark-code-fill"></i>
                <span>Evaluaciones</span>
              </a>
            </li>

            <li class="sidebar-item">
              <a href="<?= web_root ?>admin/tcontrato/" class="sidebar-link">
                <i class="bi bi-file-check-fill"></i><span>Contrato</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a href="<?= web_root ?>admin/keywords/" class="sidebar-link">
                <i class="bi bi-key-fill"></i>
                <span>Palabras claves</span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>