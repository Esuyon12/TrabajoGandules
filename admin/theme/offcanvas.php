<?php
// if (!isset($_SESSION['ADMIN_USERID'])) {
//     redirect(web_root . "admin/index.php");
// }
// if (!$_SESSION['ADMIN_ROLE'] == 'Administrator') {
//     redirect(web_root . "admin/index.php");
// }
// @$USERID = $_SESSION['ADMIN_USERID'];
// if ($USERID == '') {
//     redirect("index.php");
// }

// $user = new User();
// $singleuser = $user->single_user($USERID);

$mydb->setQuery("SELECT * FROM tblusers");
$users = $mydb->loadResultList();

// echo json_encode($_SESSION); die;

$materialDesignColors = array(
    "#F44336", "#E91E63", "#9C27B0", "#673AB7", "#3F51B5", "#2196F3",
    "#03A9F4", "#00BCD4", "#009688", "#4CAF50", "#8BC34A", "#CDDC39",
    "#FFEB3B", "#FFC107", "#FF9800", "#FF5722", "#795548", "#9E9E9E",
    "#607D8B"
);

function generarColorMaterialDesign($materialDesignColors)
{
    $indiceColor = array_rand($materialDesignColors);
    echo $materialDesignColors[$indiceColor];
}

function fecha_en_texto($fecha_actual)
{
    $dias_semana = array('Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado');
    $meses = array(
        'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio',
        'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
    );

    $timestamp = strtotime($fecha_actual);
    $dia_semana = $dias_semana[date('w', $timestamp)];
    $mes = $meses[date('n', $timestamp) - 1];
    $dia = date('d', $timestamp);
    $anio = date('Y', $timestamp);

    $texto_fecha = $dia_semana . ', ' . $dia . ' de ' . $mes . ' de ' . $anio;
    return $texto_fecha;
}

?>


<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
    <div class="nav d-flex flex-column">
        <div class="nav-tabs d-flex">
            <li class="nav-item">
                <a class="nav-link active tablinks" onclick="openTab(event, 'tab1')">
                    <h4>PERFIL</h4>
                </a>
            </li>
            <?php if ($_SESSION['ADMIN_ROLE'] == "Administrador") { ?>
                <li class="nav-item">
                    <a class="nav-link tablinks d-flex justify-content-between gap-3" onclick="openTab(event, 'tab2')">
                        <h4>USUARIOS</h4>
                        <button class="justify-content-center align-items-center" id="addbtn">
                            <ion-icon name="add-outline"></ion-icon>
                        </button>
                    </a>
                </li>
            <?php } ?>
        </div>
        <div class="container">
            <div id="tab1" class="tabcontent">
                <?php
                ?>
                <div class="container-fluid">
                    <div class="card-content">
                        <div class="card-color mt-3" style="background: <?php generarColorMaterialDesign($materialDesignColors) ?>;">
                            <div class="avatar">
                                <img src="<?php echo web_root . "admin/user/photos/" . $_SESSION['ADMIN_FOTO'] ?>" class="avatar-img">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <h4 class="text-center"><?php echo $_SESSION['ADMIN_FULLNAME'] ?></h4>
                    </div>
                    <div class="row">
                        <p class="text-muted text-center"><?php echo $_SESSION['ADMIN_ROLE'] ?></p>
                    </div>
                    <div class="card-info">
                        <div class="icon-detail">
                            <ion-icon name="at-circle-outline"></ion-icon>
                            <p class="text-muted"><?php echo $_SESSION['ADMIN_CORREO'] ?></p>
                        </div>
                        <div class="icon-detail">
                            <ion-icon name="card-outline"></ion-icon>
                            <p class="text-muted"><?php echo $_SESSION['ADMIN_DNI'] ?></p>
                        </div>
                        <div class="icon-detail">
                            <ion-icon name="call-outline"></ion-icon>
                            <p class="text-muted"><?php echo $_SESSION['ADMIN_TELF'] ?></p>
                        </div>
                        <div class="icon-detail">
                            <ion-icon name="time-outline"></ion-icon>
                            <p class="text-muted"><?php echo $texto_fecha = fecha_en_texto($_SESSION['ADMIN_DATE']) ?></p>
                        </div>
                        <div class="d-flex justify-content-between align-items-center accion">
                            <a href="<?= web_root ?>admin/logout.php" class="icon-detail btn-accion red">
                                <ion-icon name="power-outline"></ion-icon>
                            </a>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="theme-toggle d-flex gap-2 align-items-center mt-2">
                                    <ion-icon name="sunny-outline"></ion-icon>
                                    <div class="form-check form-switch fs-6">
                                        <input class="form-check-input me-0" type="checkbox" id="toggle-dark" />
                                        <label class="form-check-label"></label>
                                    </div>
                                    <ion-icon name="moon-outline"></ion-icon>
                                </div>
                            </div>
                            <a class="icon-detail btn-accion blue" onclick='editUser(<?php echo json_encode($_SESSION) ?>)'>
                                <ion-icon name="chevron-forward-outline"></ion-icon>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php if ($_SESSION['ADMIN_ROLE'] == "Administrador") { ?>
                <div id="tab2" class="tabcontent" style="display: none;">
                    <?php foreach ($users as $user) {
                        if ($user->USERID === $_SESSION['ADMIN_USERID']) {
                            continue;
                        } ?>
                        <div class="user-card bg-body rounded-5 mt-4">
                            <img src="<?php echo web_root . "admin/user/photos/"  . $user->FOTO ?>" class="img-user" alt="">
                            <div class="user-list d-flex flex-column">
                                <h5 class="text-truncate"><?php echo $user->FULLNAME ?></h5>
                                <p class="text-muted text-truncate"><?php echo $user->ROLE ?></p>
                            </div>
                            <a href="#offcanvasmulti" onclick='detailsUser(<?php echo json_encode($user) ?>)' class="btndetails bg-black d-flex justify-content-center align-items-center">
                                <ion-icon name="information-circle-outline"></ion-icon>
                            </a>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
</div>


<div class="offcanvas offcanvas-end" data-bs-backdrop="static" tabindex="-1" id="offcanvasmulti" aria-labelledby="staticBackdropLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title titleCanvas" id="staticBackdropLabel">Detalles</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body" id="bodyCanvas">

        <div>
        </div>
    </div>
</div>
</div>

<style>
    .error {
        border-color: red !important;
    }

    .error::placeholder {
        color: red;
    }

    .error-message {
        color: red;
        font-size: 12px;
        margin-top: 5px;
    }
</style>

<script>
    var myOffcanvas = document.getElementById('offcanvasmulti')
    var bsOffcanvas = new bootstrap.Offcanvas(myOffcanvas)
    const btnadd = document.getElementById('addbtn')
    let canvas = document.getElementById('bodyCanvas')
    let canvasTitle = document.querySelector('.titleCanvas')

    /**************************************
     * TABS
     * **************************************/

    function openTab(evt, tabName) {
        var i, tabcontent, tablinks
        tabcontent = document.getElementsByClassName('tabcontent')

        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = 'none'
        }

        tablinks = document.getElementsByClassName('tablinks')
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(' active', '')
        }

        document.getElementById(tabName).style.display = 'block'
        evt.currentTarget.className += ' active'
    }

    /**************************************
     * TABS
     * **************************************/

    function cargarImagen(event) {
        const inputFile = document.getElementById('imgBackup');
        const imagenPreview = document.getElementById('imagenPreview');

        const archivos = event.target.files;

        if (archivos.length > 0) {
            const archivo = archivos[0];

            if (archivo.type && archivo.type.match('image.*')) {
                const lector = new FileReader();

                lector.onload = function(event) {
                    const imagen = document.createElement('img');
                    imagen.style.width = '100%';
                    imagen.style.height = '255px';
                    imagen.style.objectFit = 'fill';
                    imagen.src = event.target.result;

                    imagenPreview.innerHTML = ''; // Limpiar contenido
                    imagenPreview.appendChild(imagen);
                    imagenPreview.appendChild(inputFile);
                };

                lector.readAsDataURL(archivo);
            } else {
                console.error('El archivo seleccionado no es una imagen.');
            }
        } else {
            imagenPreview.innerHTML = '<span class="button-file-label">Seleccionar imagen</span>'; // Limpiar contenido
            imagenPreview.appendChild(inputFile);
            console.log('No se seleccionó ningún archivo.');
        }
    }




    /**************************************
     * TABS
     * **************************************/

    function timeago(dateTime) {
        const daysOfWeek = [
            "Domingo",
            "Lunes",
            "Martes",
            "Miércoles",
            "Jueves",
            "Viernes",
            "Sábado"
        ];

        const months = [
            "Enero",
            "Febrero",
            "Marzo",
            "Abril",
            "Mayo",
            "Junio",
            "Julio",
            "Agosto",
            "Septiembre",
            "Octubre",
            "Noviembre",
            "Diciembre"
        ];

        const dateObj = new Date(dateTime);
        const dayOfWeek = daysOfWeek[dateObj.getDay()];
        const day = dateObj.getDate();
        const month = dateObj.getMonth();
        const year = dateObj.getFullYear();

        const formattedDate = `${dayOfWeek}, ${day} de ${months[month]} ${year}`;

        return formattedDate;
    }

    const detailsUser = async (user) => {
        bsOffcanvas.hide()
        const materialDesignColors = [
            '#F44336',
            '#E91E63',
            '#9C27B0',
            '#673AB7',
            '#3F51B5',
            '#2196F3',
            '#03A9F4',
            '#00BCD4',
            '#009688',
            '#4CAF50',
            '#8BC34A',
            '#CDDC39',
            '#FFEB3B',
            '#FFC107',
            '#FF9800',
            '#FF5722',
            '#795548',
            '#9E9E9E',
            '#607D8B',
        ]

        function generarColorMaterialDesign() {
            const indiceColor = Math.floor(Math.random() * materialDesignColors.length)
            return materialDesignColors[indiceColor]
        }
        canvasTitle.innerHTML = 'Detalles de usuario'
        canvas.innerHTML = `
            <div class="container">
                <div class="card-content">
                    <div class="card-color mt-3" style="background: ${generarColorMaterialDesign()};">
                        <div class="avatar">
                            <img src="<?php echo web_root ?>admin/user/photos/${user.FOTO}" class="avatar-img">
                        </div>                                    
                    </div>
                </div>
                <div class="row">
                    <h4 class="text-center">${user.FULLNAME}</h4>
                </div>
                <div class="row">
                    <p class="text-muted text-center">${user.ROLE}</p>
                </div>
                <div class="card-info">
                    <div class="icon-detail">
                        <ion-icon name="at-circle-outline"></ion-icon>
                        <p class="text-muted">${user.CORREO}</p>
                    </div>
                    <div class="icon-detail">
                        <ion-icon name="card-outline"></ion-icon>
                        <p class="text-muted">${user.DNI}</p>
                    </div>
                    <div class="icon-detail">
                        <ion-icon name="call-outline"></ion-icon>
                        <p class="text-muted">${user.TELEFONO}</p>
                    </div>
                    <div class="icon-detail">
                        <ion-icon name="time-outline"></ion-icon>
                        <p class="text-muted">${timeago(user.CREATEAT)}</p>
                        </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex justify-content-around align-items-center gap-3">
                            <a class="icon-detail btn-up" href="#1">
                                <ion-icon name="arrow-up-circle-outline"></ion-icon>
                            </a>
                            <a class="icon-detail btn-delete" href="#2">
                                <ion-icon name="arrow-down-circle-outline"></ion-icon>
                            </a>
                        </div>
                        <a class="icon-detail d-flex justify-content-end btn-delete" onclick='deleteUser("${user.USERID}","${user.FULLNAME}")'>
                            <i class="bi bi-trash3"></i>
                        </a>
                    </div>
                </div>
            </div>
            `

        bsOffcanvas.toggle()
    }

    const editUser = async (user) => {
        bsOffcanvas.hide()

        canvasTitle.innerHTML = 'Editar'

        console.log(user)
        canvas.innerHTML = `
            <form  id="editUser" enctype="multipart/form-data">
                <input type="hidden" name="USERID" value="${user.ADMIN_USERID}">
                <div class="d-flex align-items-center justify-content-center mb-3">
                    <label class="button-file" id="imagenPreview" style="background-image: url(<?php echo web_root ?>admin/user/photos/${user.ADMIN_FOTO}); 
                    background-position: center; background-size: cover;">
                        <span class="button-file-label">Seleccionar imagen</span>
                        <input type="file" onchange="cargarImagen(event)" name="FOTO" id="imgBackup">
                    </label>
                </div>

                <div class="form-floating mb-3">
                    <input
                        type="text"
                        name="fullname"
                        id="name"
                        class="form-control"
                        placeholder="Nombre"
                        value="${user['ADMIN_USERNAME']}"
                    />
                    <label for="name">Nombre de Usuario</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" disabled name="dni" placeholder="DNI" class="form-control" value="${user['ADMIN_FULLNAME']}">
                    <label for="dni">Nombres Completos</label>
                </div>
                <div class="form-floating mb-3">
                    <input disabled type="number" name="dni" placeholder="DNI" class="form-control" value="${user['ADMIN_DNI']}">
                    <label for="dni">DNI</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" placeholder="Email" id="email" name="email" value="${user['ADMIN_CORREO']}">
                    <label for="email">Email</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="number" class="form-control" placeholder="Number" id="TELEFONO" name="TELEFONO" value="${user['ADMIN_TELF']}">
                    <label for="number">Telefono</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" placeholder="password" id="password" name="PASS">
                    <label for="password">Contraseña</label>
                </div>        
                <button class="btn btn-success w-100">Guardar</button>
            </form>`

        let formUser = document.getElementById('editUser')
        formUser.onsubmit = async (e) => {
            e.preventDefault()
            const form = new FormData(formUser)
            const response = await fetch('<?php echo URL_WEB . web_root ?>admin/user/controller.php?action=edit', {
                method: 'POST',
                body: form,
            })

            let data = await response.text()
            console.log(data)
            // showSweetAlert(response, 'aÃ±adido con exito')
        }

        bsOffcanvas.toggle()
    }

    btnadd.addEventListener('click', () => {
        // Cerrar Offcanvas
        bsOffcanvas.hide()

        canvasTitle.innerHTML = 'Agregar Usuario'

        canvas.innerHTML = `
    <form  id="addUser" enctype='multipart/form-data'>
      <div class="d-flex align-items-center justify-content-center mb-3">
        <label class="button-file bg-body" id="imagenPreview">
          <span class="button-file-label">Seleccionar imagen</span>
          <input type="file" onchange="cargarImagen(event)" name="FOTO" id="imgBackup">
        </label>
      </div>
      <div class="form-floating mb-3">
        <input
          type="text"
          name="USERNAME"
          id="USERNAME"
          class="form-control"
          placeholder="Nombre"
        />
        <label for="name">Nombre de Usuario</label>
      </div>
      <div class="form-floating mb-3">
        <input type="number" name="DNI" placeholder="DNI" class="form-control">
        <label for="dni">DNI</label>
      </div>
      <div class="form-floating mb-3">
        <input type="email" class="form-control" placeholder="CORREO" id="CORREO" name="CORREO">
        <label for="email">Email</label>
      </div>
      <div class="form-floating mb-3">
        <select class="form-select" id="floatingSelect" name="ROLE" aria-label="Floating label select example">
          <option selected disabled></option>
          <option value="Administrador">Administrador</option>
          <option value="Usuario">Usuario</option>
        </select>
        <label for="floatingSelect">Tipo de usuario</label>
      </div>

      <button class="btn btn-success w-100">Agregar</button>
    </form>
  `;

        const form = document.getElementById("addUser");
        const formFields = Array.from(form.querySelectorAll("input, select"));

        form.addEventListener("submit", async function(e) {
            e.preventDefault();

            // Validar campos del formulario
            let isFieldsEmpty = false;
            formFields.forEach((field) => {
                if (field.value.trim() === "") {
                    isFieldsEmpty = true;
                    field.classList.add("error");

                    // Mostrar mensaje de validación debajo del campo
                    const errorText = document.createElement("span");
                    errorText.classList.add("error-message");
                    errorText.textContent = "Este campo es obligatorio";
                    field.parentNode.appendChild(errorText);
                } else {
                    field.classList.remove("error");

                    // Eliminar mensaje de validación si existe
                    const errorText = field.parentNode.querySelector(".error-message");
                    if (errorText) {
                        errorText.remove();
                    }
                }
            });

            if (isFieldsEmpty) {
                console.log("Por favor, complete todos los campos obligatorios.");
                return;
            }

            // Enviar el formulario
            let response = await fetch('<?php echo URL_WEB . web_root ?>admin/user/controller.php?action=add', {
                method: 'POST',
                body: new FormData(e.target),
            });

            let data = await response.json();
            console.log(data);

            if (data.status === "success") {
                // Mostrar alerta de confirmación
                Swal.fire({
                    title: "Registro exitoso",
                    text: "El usuario se ha registrado correctamente.",
                    icon: "success",
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    location.reload();
                });
            } else {
                // Mostrar alerta de error
                Swal.fire({
                    title: "Error",
                    text: data.message || "Hubo un error en el registro.",
                    icon: "error",
                    showConfirmButton: true
                });
            }
        });


        // Abrir Offcanvas
        bsOffcanvas.toggle();
    });


    function deleteUser(code, name) {
        let controller = new DeleteController('#detailsmodal')

        controller.set_modal_content = () => {
            controller.form_id = 'deleteuser'

            controller.modal_body_element.innerHTML = `
        <form id="deleteuser">
        <input type="number" class="d-none" value="${code}" name="cod_proye">
        <h6>Â¿Estas seguro que deseas eliminar <span class="text-muted">${name}</span> del sistema?</h6>
        </form>
        `
        }
        controller.execute('/api/users/delete/' + code)
    }
</script>