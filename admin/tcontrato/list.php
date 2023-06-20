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
                <a href="#" onclick="addContrato();"><i class="bi bi-plus-lg"></i> Nuevo Registro</a>
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
                                    <a title="View" href="#" class="btn bg-success btn-outline-light btn-xs" onclick='editContrato(<?= json_encode($result) ?>)'>
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


        async function addContrato() {
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
    
      <div class="form-floating mb-4">
        <div class="card border">
            <div id="full" style="border: 1px solid #ced4da; border-radius: 0.25rem;">
                <p>...</p>
            </div>
        </div>
    </div>

    <input type="hidden" name="CONTENIDO" id="CONTENIDO">


    </form>
  `;
            foot.innerHTML = `
    <button form="addContrato" class="btn bg-success text-white ml-1">
      <span class="d-none d-sm-block">Guardar</span>
    </button>
  `;

            var quill = new Quill('#full', {
                theme: 'snow'
            });

            document.getElementById('addContrato').addEventListener('submit', function() {
                var tareaContent = quill.root.innerHTML;
                document.getElementById('CONTENIDO').value = tareaContent;
            });


            myModal.show();

            var modalDialog = document.querySelector(".modal-dialog");
            modalDialog.classList.add("modal-xl");

            var quillOptions = document.querySelector('.ql-toolbar');
            var quillContainer = document.querySelector('.ql-container');
            quillContainer.appendChild(quillOptions);


            const form = document.getElementById("addContrato");
            const formFields = [
                document.getElementById("TIPOCONTRATO"),
                document.getElementById("CONTENIDO"),
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
                // const formData = new FormData(form);

                if (!validateForm()) {
                    Swal.fire({
                        icon: "error",
                        title: "Todos los campos son obligatorios.",
                        showConfirmButton: false,
                        timer: 1000,
                    });
                    return;
                }

                const formData = new URLSearchParams(new FormData(form));



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





        function editContrato(a) {
            head.innerHTML = "Detalles de contrato";
            content.innerHTML = `
            <form action="controller.php?action=edit" method="POST" id="editContrato">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                        <span class="input-group-text">TITULO</span>
                        </div>
                        <input type="hidden" name="TCONTRATOID" value="${a['TCONTRATOID']}">
                        <input type="text" id="TIPOCONTRATO" name="TIPOCONTRATO" class="form-control" value="${a['TIPOCONTRATO']}">
                    </div>
                    
                 <div class="form-floating mb-4">
                        <div class="card border">
                            <div id="full" style="border: 1px solid #ced4da; border-radius: 0.25rem;"></div>
                        </div>
                    </div>
                    <input type="hidden" name="CONTENIDO" id="CONTENIDO">

                </form>
            `;
            foot.innerHTML = `
                <button form="editContrato" class="btn bg-success text-white ml-1" onclick="updateContrato()">
                <span class="d-none d-sm-block">Guardar</span>
                </button>
            `;

            var quill = new Quill('#full', {
                theme: 'snow'
            });

            // Set the existing content in the editor
            quill.clipboard.dangerouslyPasteHTML(a['CONTENIDO']);

            // Update hidden input with Quill editor content on form submit
            document.getElementById('editContrato').addEventListener('submit', function() {
                var ContratoContent = quill.root.innerHTML;
                document.getElementById('CONTENIDO').value = ContratoContent;
            });

            myModal.show();

            // Mover las opciones del editor Quill a la parte inferior
            var quillOptions = document.querySelector('.ql-toolbar');
            var quillContainer = document.querySelector('.ql-container');
            quillContainer.appendChild(quillOptions);

        }


        function updateContrato() {
            document.getElementById("editContrato").submit();

            Swal.fire({
                title: "Registro actualizado",
                text: "El registro ha sido actualizado con éxito",
                icon: "success",
                confirmButtonText: "Aceptar",
                timer: 5000,
                timerProgressBar: true,
            });
        }
    </script>