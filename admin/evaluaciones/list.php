<?php
require_once("../../include/initialize.php");

if (!isset($_SESSION['ADMIN_USERID'])) {
    redirect(web_root . "admin/index.php");
}

?>
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h1>Asignar Evaluacion</h1>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="<?= URL_WEB ?>admin/"><b> Dashboard</b></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Evaluciones</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>