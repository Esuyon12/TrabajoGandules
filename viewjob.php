<?php
if (isset($_GET['search'])) {
    # code...
    $jobid = $_GET['search'];
} else {
    $jobid = '';
}

$sql = "SELECT * FROM `tblcompany` c,`tbltipocontrato` t, `tblocupaciones`o,`tbljob` j WHERE c.`COMPANYID`=j.`COMPANYID` AND o.`OCUPACIONID`=j.`OCUPACIONID` AND j.`JOBID` =" . $jobid . " ORDER BY DATEPOSTED DESC";


$mydb->setQuery($sql);
$cur = $mydb->loadResultList();

// print_r($cur[0]);
$_SESSION['COMPANYID'] = $cur[0]->COMPANYID;
$_SESSION['JOBID'] = $cur[0]->JOBID;
$_SESSION['OCUPACIONID'] = $cur[0]->OCUPACIONID;

foreach ($cur as $result) {
}

?>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap');

    .card {
        border-radius: 12px !important;
        overflow: hidden !important;
        font-family: 'Poppins', sans-serif !important;
    }

    .col-md-8 .card-body {
        position: relative !important;
        overflow: hidden !important;
        padding-top: 215px;
    }

    .desing {
        position: absolute;
        left: 0;
        top: 0;
        height: 130px !important;
    }

    .logo {
        position: absolute;
        bottom: -50px;
        width: 100px;
        height: 100px;
        background: #fff;
        border: 5px solid #2cc14e;
        border-radius: 20px;
    }

    .d-flex p {
        margin-bottom: 0 !important;
    }

    .title-sub {
        font-weight: 500 !important;
        letter-spacing: 0.6px;
        font-size: 24px;
    }

    body>.container-md {
        position: relative;
    }

    .form-floating input {
        border-radius: 20px;
        border: 1px solid #cce3cd;
        transition: all .5s ease !important;
    }

    .form-floating input:focus {
        border: 0px solid #cce3cd !important;

    }

    .form-floating input~label,
    .filepond--drop-label label {
        color: #00000059 !important;
        font-weight: 700 !important;
    }

    input[type="number"]::-webkit-inner-spin-button,
    input[type="number"]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        appearance: none;
        margin: 0;
    }


    .fixed-col {
        transition: all .5s ease;
        position: sticky;
        top: 70px;
    }

    .filepond {
        width: 100%;
        height: 80px;
        border: 1px solid #cce3cd;
        border-radius: 20px;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        /* font-family: Arial, sans-serif; */
        position: relative;
        overflow: hidden;
    }

    .filepond-text {
        /* margin-top: 10px; */
        color: #00000059 !important;
    }

    .filepond-text span {
        font-weight: bold;
    }

    .filepond-input {
        display: none;
    }

    .filepond-file-container {
        display: flex;
        align-items: center;
        position: absolute;
        top: 140%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 90%;
        background-color: #2cc14e;
        border-radius: 4px;
        padding: 10px;
        text-align: center;
        transition: all .5s ease;
    }

    .filepond-file-container.show {
        /* bottom: 0 !important; */
        top: 50% !important;
        /* display: flex;
        justify-content: space-between;
        align-items: center; */
    }


    .filepond-file-container.invalid {
        background-color: #ff6060;
        /* Fondo rojo */
        color: #ff0000;
        /* Texto rojo */
    }

    .filepond-file-name,
    .filepond-file-ext {
        font-size: 12px;
        color: #fff;
        font-weight: 800;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        letter-spacing: 0.1px;
    }


    .filepond-file-remove {
        display: flex;
        justify-content: center;
        align-items: center;
        background: #333;
        border-radius: 50%;
        font-size: 16px;
        border: 1px solid #fff;
        color: #999;
        font-size: 20px;
        width: 30px;
        height: 30px;
        cursor: pointer;
        transition: all .5s ease;
    }

    .filepond-file-remove:hover {
        color: #fff !important;
        font-size: 23px !important;
        border: 2px solid #fff;
    }
</style>

<!-- Features Start -->
<div class="container-xxl py-4">
    <div class="container-md">
        <div class="row">
            <div class="col-md-8 mb-5">
                <div class="card border-0">
                    <div class="card-body">
                        <div class="desing d-flex justify-content-center align-items-center w-100 mb-5 bg-success">
                            <img src="assets/images/logo/logo-gandules.png" class="logo" alt="...">
                        </div>
                        <div class="d-flex justify-content-center align-items-center mb-4">
                            <h2 class="text-uppercase text-center"><?= $result->OCUPACION; ?></h2>
                        </div>
                        <div class="row d-flex justify-content-center mb-5">
                            <div class="col-6 col-md-3 col-lg-3 col-xl-3 col-sm-4 col-lg-3 mb-3">
                                <div class="d-flex flex-column justify-content-center align-items-center">
                                    <div class="d-flex align-items-center gap-1">
                                        <ion-icon name="pin-outline"></ion-icon>
                                        <p class="text-start text-muted"><small>Localidad</small></p>
                                    </div>
                                    <p><strong><small><?= $result->COMPANYADDRESS ?></small></strong></p>
                                </div>
                            </div>
                            <div class="col-6 col-md-3 col-lg-3 col-xl-3 col-sm-4 col-lg-3 mb-3">
                                <div class="d-flex flex-column justify-content-center align-items-center">
                                    <div class="d-flex align-items-center gap-1">
                                        <ion-icon name="briefcase-outline"></ion-icon>
                                        <p class="text-start text-muted"><small>Modalidad</small></p>
                                    </div>
                                    <p><strong><small><?php echo $result->MODALIDAD ?></small></strong></p>
                                </div>
                            </div>
                            <div class="col-6 col-md-3 col-lg-3 col-xl-3 col-sm-4 col-lg-3 mb-3">
                                <div class="d-flex flex-column justify-content-center align-items-center">
                                    <div class="d-flex align-items-center gap-1">
                                        <ion-icon name="time-outline"></ion-icon>
                                        <p class="text-start text-muted"><small>Tipo</small></p>
                                    </div>
                                    <p><strong><small><?php echo $result->TIEMPO ?></small></strong></p>
                                </div>
                            </div>
                            <div class="col-6 col-md-3 col-lg-3 col-xl-3 col-sm-4 col-lg-3 mb-3">
                                <div class="d-flex flex-column justify-content-center align-items-center">
                                    <div class="d-flex align-items-center gap-1">
                                        <ion-icon name="cash-outline"></ion-icon>
                                        <p class="text-start text-muted"><small>Salario</small></p>
                                    </div>
                                    <p><strong><small>S/. <?php echo number_format($result->SUELDO, 2) ?></small></strong></p>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="container-fluid">
                            <div class="d-flex align-items-center justify-content-between mb-3 mt-5 title-a">
                                <h4 class="title-sub"><small> Descripcion Del Trabajo</small></h4>
                                <h6>Publicado <span class="text-muted"><?php echo time_ago($result->DATEPOSTED) ?></span></h6>
                            </div>
                            <div class="d-flex mb-4">
                                <p class="text-left text-muted">
                                    <?php echo $result->INFOJOB ?>
                                </p>
                            </div>
                            <div class="d-flex flex-column mb-4">
                                <h4 class="title-sub">Requisitos</h4>
                                <p class="text-muted"><?php echo nl2br($result->WORKEXPERIENCE) ?></p>
                            </div>
                            <div class="d-flex flex-column mb-4">
                                <h4 class="title-sub">Funciones</h4>
                                <p class="text-muted"><?php echo $result->JOBDESCRIPTION ?></p>
                            </div>
                            <div class="d-flex flex-column mb-4">
                                <h4 class="title-sub">Beneficios</h4>
                                <p class="text-muted"><?php echo $result->BENEFICIOS ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 position-relative">
                <div class="card border-0 fixed-col">
                    <div class="card-body">
                        <div class="container-fluid">
                            <div class="d-flex flex-column mb-3">
                                <h5>Únete</h5>
                                <p class="text-muted">Solicitar empleo de <?= $result->OCUPACION; ?> - <?= $result->COMPANYADDRESS ?> en <?php echo $result->COMPANYNAME ?></p>
                            </div>
                            <form action="postul.php" method="POST" id="aplicant" enctype="multipart/form-data" onsubmit="return validateForm()">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control bg-light" id="DNI" name="DNI" placeholder="...">
                                    <label for="DNI">DNI</label>
                                    <div class="invalid-feedback" id="dni-error"></div>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="number" class="form-control bg-light" id="CONTACTNO" name="CONTACTNO" placeholder="...">
                                    <label for="CONTACTNO">Telefono</label>
                                    <div class="invalid-feedback" id="contactno-error"></div>
                                </div>

                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control bg-light" id="EMAILADDRESS" name="EMAILADDRESS" placeholder="...">
                                    <label for="EMAILADDRESS">Correo electrónico</label>
                                    <div class="invalid-feedback" id="email-error"></div>
                                </div>

                                <label for="filepond" class="bg-light filepond mb-3">
                                    <div class="filepond-text">
                                        <span>Escoja el CV </span>
                                    </div>
                                    <input type="file" id="filepond" class="filepond-input" name="CVFILE" required>
                                    <div class="filepond-file-container gap-3">
                                        <div class="filepond-file-remove">&times;</div>
                                        <div class="d-flex flex-column align-items-baseline">
                                            <div class="filepond-file-name"></div>
                                            <div class="filepond-file-ext text-uppercase"></div>
                                        </div>
                                    </div>
                                </label>

                                <button class="w-100 btn btn-primary text-uppercase">Enviar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- Features End -->

<script>
    const fileInput = document.getElementById('filepond');
    const fileContainer = document.querySelector('.filepond-file-container');
    const fileNameElement = document.querySelector('.filepond-file-name');
    const fileExtElement = document.querySelector('.filepond-file-ext');
    const fileRemoveButton = document.querySelector('.filepond-file-remove');
    const submitButton = document.querySelector('.btn.btn-primary');

    fileInput.addEventListener('change', handleFileUpload);
    fileRemoveButton.addEventListener('click', handleFileRemove);

    function handleFileUpload(event) {
        event.preventDefault()
        const file = event.target.files[0];

        if (file) {
            const fileName = file.name;
            const fileNameParts = fileName.split(".");
            const name = fileNameParts[0]; // Nombre del archivo
            const ext = fileNameParts[1]; // Extensión del archivo

            if (ext.toLowerCase() === 'pdf') {
                fileContainer.classList.remove('invalid');
                fileContainer.classList.add('show');
                fileNameElement.textContent = name;
                fileExtElement.textContent = ext;
                submitButton.disabled = false;
            } else {
                fileContainer.classList.add('show');
                fileContainer.classList.add('invalid');
                fileNameElement.textContent = 'SE REQUIERE PDF';
                fileExtElement.textContent = '';
                submitButton.disabled = true;
            }
        }
    }

    function handleFileRemove(event) {
        event.preventDefault();
        fileInput.value = '';
        fileContainer.classList.remove('show', 'invalid');
        fileNameElement.textContent = '';
        fileExtElement.textContent = '';
        submitButton.disabled = true;
    }
</script>

<script>
    function validateForm() {
        var dni = document.getElementById("DNI");
        var contactno = document.getElementById("CONTACTNO");
        var email = document.getElementById("EMAILADDRESS");

        // Limpiar los estilos de validación previos
        clearValidationStyles();

        // Verificar los campos obligatorios
        if (dni.value === "") {
            showErrorFeedback("dni-error", "Ingrese su DNI");
            dni.classList.add("is-invalid");
            return false;
        }

        if (contactno.value === "") {
            showErrorFeedback("contactno-error", "Ingrese su número de contacto");
            contactno.classList.add("is-invalid");
            return false;
        }

        // Verificar la longitud del número de contacto
        if (contactno.value.length !== 9) {
            showErrorFeedback("contactno-error", "El número de teléfono debe tener 9 dígitos");
            contactno.classList.add("is-invalid");
            return false;
        }

        if (email.value === "") {
            showErrorFeedback("email-error", "Ingrese su correo electrónico");
            email.classList.add("is-invalid");
            return false;
        }

        // Verificar el formato y longitud del DNI
        var numbersOnlyPattern = /^\d+$/;
        if (!numbersOnlyPattern.test(dni.value)) {
            showErrorFeedback("dni-error", "El DNI solo debe contener números");
            dni.classList.add("is-invalid");
            return false;
        }

        if (dni.value.length !== 8) {
            showErrorFeedback("dni-error", "El DNI debe tener 8 dígitos");
            dni.classList.add("is-invalid");
            return false;
        }

        // Mostrar mensaje de éxito
        showSuccessMessage("El formulario ha sido enviado correctamente");
        return true;
    }

    function clearValidationStyles() {
        var inputs = document.querySelectorAll("input");
        inputs.forEach(function(input) {
            input.classList.remove("is-invalid");
        });

        var errorElements = document.querySelectorAll(".invalid-feedback");
        errorElements.forEach(function(errorElement) {
            errorElement.textContent = "";
        });
    }

    function showErrorFeedback(id, message) {
        var errorElement = document.getElementById(id);
        errorElement.textContent = message;
    }

    function showSuccessMessage(message) {
        var successMessage = document.createElement("div");
        successMessage.className = "alert alert-success mt-3";
        successMessage.textContent = message;

        var form = document.getElementById("aplicant");
        form.appendChild(successMessage);
    }
</script>