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
                <h1>Tipo de contrato</h1>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="d-flex justify-content-between align-items-center w-100">
            <div class="d-flex align-items-center">
                <a href="#" onclick="addContrato(event);"><i class="bi bi-plus-lg"></i> Nuevo Registro</a>
            </div>
            <div class="d-flex">
                <div class="form-floating shadow mb-4">
                    <input type="text" id="tableSearch" class="form-control" placeholder="Escriba su búsqueda aquí...">
                    <label for="tableSearch"><i class="bi bi-search"></i> Buscar</label>
                </div>
            </div>
        </div>
    </div>

    <?php
    $mydb->setQuery("SELECT * FROM `tbltipocontrato`");
    $cur = $mydb->loadResultList();
    ?>
    <div class="col-lg-12">
        <div class="card shadow-sm">
            <div class="card-body">
                <table id="myTable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Tipo de contrato</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($cur as $result) { ?>
                            <tr>
                                <td><?= $result->TIPOCONTRATO ?></td>
                                <td style="width: 7%;">
                                    <div class="badges text-center">
                                        <span style="cursor:pointer;" ondblclick="state(<?php echo $result->ESTADO ?>, <?php echo $result->TCONTRATOID ?>)" class="badge bg-<?= ($result->ESTADO == 1) ? 'success' : 'danger' ?>">
                                            <?= ($result->ESTADO == 1) ? 'Activo' : 'Inactivo' ?>
                                        </span>
                                    </div>
                                </td>
                                <td style="width: 5%;">
                                    <a title="View" href="#" class="btn bg-success btn-outline-light btn-xs" onclick='viewContrato(<?= json_encode($result) ?>)'>
                                        <i class="bi bi-eye-fill"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <style>
        .error-message {
            color: red;
            font-size: 12px;
            margin-top: 4px;
        }
    </style>
    <script>
        const myModal = new bootstrap.Modal(document.getElementById('modal'))
        const content = document.getElementById("content")
        const head = document.getElementById("headTitle")
        const foot = document.getElementById("footer")


        async function state(a, b) {
            let response = await fetch(`<?php echo web_root ?>admin/tcontrato/controller.php?action=state&id=${b}&code=${a == 1 ? 0 : 1}`, {
                method: 'POST'
            })

            let text = await response.json()
            if (text.status == "success") {
                location.href = text.location
            }
            console.log(text);
        }


        async function addContrato(event) {
            event.preventDefault();

            head.innerHTML = "NUEVO CONTRATO";
            content.innerHTML = `
    <form id="addContrato">

      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text">TITULO</span>
        </div>
        <input type="text" id="TIPOCONTRATO" name="TIPOCONTRATO" class="form-control" placeholder="..." autocomplete="off">
      </div>
      <div class="form-floating mb-3">
        <textarea id="summernoteEditor" name="CONTENIDO"></textarea>
      </div>
    </form>
  `;
            foot.innerHTML = `
    <button form="addContrato" class="btn bg-success text-white ml-1">
      <span class="d-none d-sm-block">Guardar</span>
    </button>
  `;

            var options = {
                toolbar: [
                    ['style', ['bold', 'italic', 'underline']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['forecolor', 'backcolor']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link', 'picture', 'video']],
                    ['height', ['height']]
                ],
                placeholder: 'Escribe aquí tu mensaje...',
                tabsize: 2,
                height: 200,
                fontSizes: ['8', '10', '12', '14', '18', '24', '36'] // Agrega los tamaños de fuente deseados
            };

            var editor = $('#summernoteEditor');
            editor.summernote(options);

            myModal.show();

            var modalDialog = document.querySelector(".modal-dialog");
            modalDialog.classList.add("modal-xl");

            const form = document.getElementById("addContrato");
            const formFields = [
                document.getElementById("TIPOCONTRATO"),
            ];

            function validateForm() {
                let isFieldsEmpty = false;
                formFields.forEach((field) => {
                    if (field.value.trim() === "") {
                        isFieldsEmpty = true;
                        field.style.borderColor = "red";
                    } else {
                        field.style.borderColor = "";
                    }
                });
                return !isFieldsEmpty;
            }

            form.addEventListener("submit", async function(e) {
                e.preventDefault();

                if (!validateForm()) {
                    const errorElement = document.createElement("div");
                    errorElement.classList.add("error-message");
                    errorElement.innerText = "Todos los campos son obligatorios.";

                    const existingErrorMessage = form.querySelector(".error-message");
                    if (existingErrorMessage) {
                        form.removeChild(existingErrorMessage);
                    }

                    form.appendChild(errorElement);

                    return;
                }

                const formData = new FormData(form);

                // Obtener el contenido del editor de texto
                const contenidoContrato = editor.summernote("code");

                // Asignar el contenido al campo "CONTENIDO" en el formulario
                formData.append("CONTENIDO", contenidoContrato);

                try {
                    let response = await fetch("<?php echo web_root ?>admin/tcontrato/controller.php?action=add", {
                        method: 'POST',
                        body: formData
                    });

                    const data = await response.json();

                    if (response.ok && data.status === "success") {
                        Swal.fire({
                            title: "Éxito!",
                            text: data.message,
                            icon: "success",
                            showConfirmButton: false,
                        });
                        setTimeout(() => {
                            location.reload();
                        }, 1000);
                    } else {
                        Swal.fire({
                            title: "Error!",
                            text: data.message || response.statusText,
                            icon: "error",
                            showConfirmButton: true,
                        });
                    }
                } catch (error) {
                    Swal.fire({
                        title: "Error!",
                        text: error.message,
                        icon: "error",
                        showConfirmButton: true,
                    });
                }
            });
        }

        addContrato(event);



        function viewContrato(result) {
            head.innerHTML = "Detalles de contrato";
            content.innerHTML = `
                <form id="viewContrato">
                    <input type="hidden" name="TCONTRATOID" value="${result.TCONTRATOID}">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                        <span class="input-group-text">TITULO</span>
                        </div>
                        <input type="text" id="asunto" name="TIPOCONTRATO" class="form-control" value="${result.TIPOCONTRATO}">
                    </div>
                    <div class="form-floating mb-3">
                        <div id="summernoteEditor">${result.CONTENIDO}</div>
                    </div>
                </form>
            `;
            foot.innerHTML = `
                <button form="viewContrato" class="btn bg-success text-white ml-1">
                <span class="d-none d-sm-block">Guardar</span>
                </button>
            `;

            var options = {
                toolbar: [
                    ['style', ['bold', 'italic', 'underline']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['forecolor', 'backcolor']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link', 'picture', 'video']],
                    ['height', ['height']]
                ],
                placeholder: 'Escribe aquí tu mensaje...',
                tabsize: 2,
                height: 200
            };

            var editor = $('#summernoteEditor');
            editor.summernote(options);

            myModal.show();

            var modalDialog = document.querySelector(".modal-dialog");
            modalDialog.classList.add("modal-xl");

            const viewForm = document.getElementById("viewContrato");

            viewForm.addEventListener("submit", async function(e) {
                e.preventDefault();

                const formData = new FormData(viewForm);

                const nuevoContenidoContrato = editor.summernote("code");

                formData.set("CONTENIDO", nuevoContenidoContrato);

                try {
                    let response = await fetch("<?php echo URL_WEB . web_root ?>admin/tcontrato/controller.php?action=update", {
                        method: 'POST',
                        body: formData
                    });

                    let data = await response.json()
                    console.log(data);

                    if (response.ok) {
                        Swal.fire({
                            title: "Éxito!",
                            text: "Se actualizó correctamente.",
                            icon: "success",
                            showConfirmButton: true,
                        });
                        setTimeout(() => {
                            location.reload();
                        }, 1000);
                    } else {
                        Swal.fire({
                            title: "Error!",
                            text: "Error de actualización.",
                            icon: "error",
                            showConfirmButton: true,
                        });
                    }
                } catch (error) {
                    Swal.fire({
                        title: "Error!",
                        text: error.message,
                        icon: "error",
                        showConfirmButton: true,
                    });
                }
            });
        }
    </script>