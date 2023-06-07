<?php
require_once("../../include/initialize.php");

if (!isset($_SESSION['ADMIN_USERID'])) {
    redirect(web_root . "admin/index.php");
}

?>


<style>
    .card.user-card {
        border-top: none;
        -webkit-box-shadow: 0 0 1px 2px rgba(0, 0, 0, 0.05), 0 -2px 1px -2px rgba(0, 0, 0, 0.04), 0 0 0 -1px rgba(0, 0, 0, 0.05);
        box-shadow: 0 0 1px 2px rgba(0, 0, 0, 0.05), 0 -2px 1px -2px rgba(0, 0, 0, 0.04), 0 0 0 -1px rgba(0, 0, 0, 0.05);
        -webkit-transition: all 150ms linear;
        transition: all 150ms linear;
    }

    .card {
        border-radius: 5px;
        -webkit-box-shadow: 0 1px 2.94px 0.06px rgba(4, 26, 55, 0.16);
        box-shadow: 0 1px 2.94px 0.06px rgba(4, 26, 55, 0.16);
        border: none;
        margin-bottom: 30px;
        -webkit-transition: all 0.3s ease-in-out;
        transition: all 0.3s ease-in-out;
    }

    .card .card-header {
        background-color: transparent;
        border-bottom: none;
        padding: 25px;
    }

    .card .card-header h5 {
        margin-bottom: 0;
        color: #222;
        font-size: 14px;
        font-weight: 600;
        display: inline-block;
        margin-right: 10px;
        line-height: 1.4;
    }

    .card .card-header+.card-block,
    .card .card-header+.card-block-big {
        padding-top: 0;
    }

    .user-card .card-block {
        text-align: center;
    }

    .card .card-block {
        padding: 25px;
    }

    .user-card .card-block .user-image {
        position: relative;
        margin: 0 auto;
        display: inline-block;
        padding: 5px;
        width: 110px;
        height: 110px;
    }

    .user-card .card-block .user-image img {
        z-index: 20;
        position: absolute;
        top: 5px;
        left: 5px;
        width: 100px;
        height: 100px;
    }

    .img-radius {
        border-radius: 50%;
    }

    .f-w-600 {
        font-weight: 600;
    }

    .m-b-10 {
        margin-bottom: 10px;
    }

    .m-t-25 {
        margin-top: 25px;
    }

    .m-t-15 {
        margin-top: 15px;
    }

    .card .card-block p {
        line-height: 1.4;
    }

    .text-muted {
        color: #919aa3 !important;
    }

    .user-card .card-block .activity-leval li.active {
        background-color: #2ed8b6;
    }

    .user-card .card-block .activity-leval li {
        display: inline-block;
        width: 15%;
        height: 4px;
        margin: 0 3px;
        background-color: #ccc;
    }

    .user-card .card-block .counter-block {
        color: #fff;
    }

    .bg-c-blue {
        background: linear-gradient(45deg, #4099ff, #73b4ff);
    }

    .bg-c-green {
        background: linear-gradient(45deg, #2ed8b6, #59e0c5);
    }

    .bg-c-yellow {
        background: linear-gradient(45deg, #FFB64D, #ffcb80);
    }

    .bg-c-pink {
        background: linear-gradient(45deg, #FF5370, #ff869a);
    }

    .m-t-10 {
        margin-top: 10px;
    }

    .p-20 {
        padding: 20px;
    }

    .user-card .card-block .user-social-link i {
        font-size: 30px;
    }

    .text-facebook {
        color: #3B5997;
    }

    .text-twitter {
        color: #42C0FB;
    }

    .text-dribbble {
        color: #EC4A89;
    }

    .user-card .card-block .user-image:before {
        bottom: 0;
        border-bottom-left-radius: 50px;
        border-bottom-right-radius: 50px;
    }

    .user-card .card-block .user-image:after,
    .user-card .card-block .user-image:before {
        content: "";
        width: 100%;
        height: 48%;
        border: 2px solid #4099ff;
        position: absolute;
        left: 0;
        z-index: 10;
    }

    .user-card .card-block .user-image:after {
        top: 0;
        border-top-left-radius: 50px;
        border-top-right-radius: 50px;
    }

    .user-card .card-block .user-image:after,
    .user-card .card-block .user-image:before {
        content: "";
        width: 100%;
        height: 48%;
        border: 2px solid #4099ff;
        position: absolute;
        left: 0;
        z-index: 10;
    }
</style>

<section class="section">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Estado de solicitantes</h5>
                </div>
                <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Aceptados</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">En proceso</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Rechazados</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">


                            <div class="col-md-4 mt-5">
                                <div class="card user-card">
                                    <div class="card-header">
                                        <h5>Perfil de postulante</h5>
                                    </div>
                                    <div class="card-block">
                                        <div class="user-image">
                                            <img src="https://bootdey.com/img/Content/avatar/avatar7.png" class="img-radius" alt="User-Profile-Image">
                                        </div>
                                        <h6 class="f-w-600 m-t-25 m-b-10">Alessa Robert</h6>
                                        <p class="text-muted">Diseñador Grafico | Hombre</p>
                                        <hr>
                                        <p class="text-muted m-t-15">Proceso de contratacion: 100%</p>
                                        <ul class="list-unstyled activity-leval">
                                            <li class="active"></li>
                                            <li class="active"></li>
                                            <li class="active"></li>
                                            <li></li>
                                            <li></li>
                                        </ul>
                                        <div class="bg-c-blue counter-block m-t-10 p-20">
                                            <div class="row">
                                                <div class="col-4">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <div class="col-md-4 mt-5">
                                <div class="card user-card">
                                    <div class="card-header">
                                        <h5>Profile</h5>
                                    </div>
                                    <div class="card-block">
                                        <div class="user-image">
                                            <img src="https://bootdey.com/img/Content/avatar/avatar1.png" class="img-radius" alt="User-Profile-Image">
                                        </div>
                                        <h6 class="f-w-600 m-t-25 m-b-10">Alessa Robert</h6>
                                        <p class="text-muted">Active | Male | Born 23.05.1992</p>
                                        <hr>
                                        <p class="text-muted m-t-15">Activity Level: 87%</p>
                                        <ul class="list-unstyled activity-leval">
                                            <li class="active"></li>
                                            <li class="active"></li>
                                            <li class="active"></li>
                                            <li></li>
                                            <li></li>
                                        </ul>
                                        <div class="bg-c-yellow counter-block m-t-10 p-20">
                                            <div class="row">
                                                <div class="col-4">
                                                    <i class="fa fa-comment"></i>
                                                    <p>1256</p>
                                                </div>
                                                <div class="col-4">
                                                    <i class="fa fa-user"></i>
                                                    <p>8562</p>
                                                </div>
                                                <div class="col-4">
                                                    <i class="fa fa-suitcase"></i>
                                                    <p>189</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                            <div class="col-md-4 mt-5">
                                <div class="card user-card">
                                    <div class="card-header">
                                        <h5>Profile</h5>
                                    </div>
                                    <div class="card-block">
                                        <div class="user-image">
                                            <img src="https://bootdey.com/img/Content/avatar/avatar6.png" class="img-radius" alt="User-Profile-Image">
                                        </div>
                                        <h6 class="f-w-600 m-t-25 m-b-10">Alessa Robert</h6>
                                        <p class="text-muted">Active | Male | Born 23.05.1992</p>
                                        <hr>
                                        <p class="text-muted m-t-15">Activity Level: 17%</p>
                                        <ul class="list-unstyled activity-leval">
                                            <li class="bg-danger active"></li>
                                            <li></li>
                                            <li></li>
                                            <li></li>
                                            <li></li>
                                        </ul>
                                        <div class="bg-danger counter-block m-t-10 p-20">
                                            <div class="row">

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>