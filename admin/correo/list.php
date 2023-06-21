<?php
require_once("../../include/initialize.php");

if (!isset($_SESSION['ADMIN_USERID'])) {
    redirect(web_root . "admin/index.php");
}

?>


<div class="page-title">
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h1>Correos</h1>
        </div>
    </div>
</div>


<div class="col-lg-12">
    <div class="d-flex justify-content-between align-items-center w-100">
        <div class="d-flex align-items-center">
            <a href="#" onclick="addCorreo()"><i class="bi bi-plus-lg"></i> Nuevo correo </a>
        </div>
        <div class="d-flex">
            <div class="form-floating mb-4">
                <input type="text" id="tableSearch" class="form-control shadow-sm" placeholder="Escriba su búsqueda aquí...">
                <label for="tableSearch">Buscar registros</label>
            </div>
        </div>
    </div>
</div>



<?php $mydb->setQuery("SELECT * FROM  `tblcorreo`");
$cur = $mydb->loadResultList(); ?>
<div class="col-lg-12">
    <div class="card shadow-sm mb-5" style="border-radius: 15px;">
        <div class="card-body">
            <table id="myTable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Asunto</th>
                        <th>Contenido</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cur as $result) { ?>
                        <tr>

                            <td><?= $result->ASUNTO ?></td>
                            <td><?= substr($result->CONTENIDO, 0, 150) . '...' ?></td>
                            <td style="width: 7%;">
                                <div class="badges text-center"><span style="cursor:pointer;" ondblclick="state(<?php echo $result->ESTADO ?>, <?php echo $result->CORREOID  ?>)" class="badge bg-<?= ($result->ESTADO == 1) ? 'success' : 'danger' ?>"><?= ($result->ESTADO == 1) ? 'Activo' : 'Inactivo' ?></span></div>
                            </td>
                            <td style="width: 5%;">
                                <a title="Edit" href="#" class="btn bg-success btn-outline-light btn-xs" onclick='editCorreo(<?= json_encode($result) ?>)'><i class="bi bi-pencil-fill"></i></a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    const myModal = new bootstrap.Modal(document.getElementById('modal'))
    const content = document.getElementById("content")
    const head = document.getElementById("headTitle")
    const foot = document.getElementById("footer")

    async function state(a, b) {
        let response = await fetch(`<?php echo web_root ?>admin/correo/controller.php?action=state&id=${b}&code=${a == 1 ? 0 : 1}`, {
            method: 'POST'
        })

        let text = await response.json()
        if (text.status == "success") {
            location.href = text.location
        }
        console.log(text);
    }

    function addCorreo() {
        head.innerHTML = "Nuevo correo";
        content.innerHTML = `
        <form id="addCorreo">

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">ASUNTO</span>
                </div>
                <input type="text" id="ASUNTO" name="ASUNTO" class="form-control" placeholder="..." autocomplete="off">
            </div>
        </div>

        <div class="form-floating mb-4">
            <div class="card border">
                <div id="full" style="border: 1px solid #ced4da; border-radius: 0.25rem;">
                    <p></p>
                </div>
            </div>
        </div>

        <input type="hidden" name="CONTENIDO" id="CONTENIDO">

    </form>
    `;
        foot.innerHTML = `
    <button form="addCorreo" class="btn bg-success ml-1">
        <span class="d-none d-sm-block text-white">Guardar</span>
    </button>
    `;

        var quill = new Quill('#full', {
            theme: 'snow'
        });

        document.getElementById('addCorreo').addEventListener('submit', function() {
            var CorreoContent = quill.root.innerHTML;
            document.getElementById('CONTENIDO').value = CorreoContent;
        });

        myModal.show();

        var quillOptions = document.querySelector('.ql-toolbar');
        var quillContainer = document.querySelector('.ql-container');
        quillContainer.appendChild(quillOptions);


        const form = document.getElementById("addCorreo");
        const formFields = [
            document.getElementById("ASUNTO"),
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
                let response = await fetch("<?php echo web_root ?>admin/correo/controller.php?action=add", {
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


    function editCorreo(a) {
        head.innerHTML = "Modificar correo";
        content.innerHTML = `
    <form action="controller.php?action=edit&id=${a['CORREOID']}" method="POST" id="editCorreo">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">ASUNTO</span>
            </div>
            <input type="text" id="ASUNTO" name="ASUNTO" class="form-control" value="${a['ASUNTO']}">
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
    <button form="editCorreo" class="btn btn-success ml-1" name="save" onclick="updateCorreo()">                    
        <span class="d-none d-sm-block">Actualizar</span>
    </button>
    `;

        var quill = new Quill('#full', {
            theme: 'snow'
        });

        // Set the existing content in the editor
        quill.clipboard.dangerouslyPasteHTML(a['CONTENIDO']);

        // Update hidden input with Quill editor content on form submit
        document.getElementById('editCorreo').addEventListener('submit', function() {
            var correoContent = quill.root.innerHTML;
            document.getElementById('CONTENIDO').value = correoContent;
        });

        myModal.show();
        // Mover las opciones del editor Quill a la parte inferior
        var quillOptions = document.querySelector('.ql-toolbar');
        var quillContainer = document.querySelector('.ql-container');
        quillContainer.appendChild(quillOptions);

    }


    function updateCorreo() {
        document.getElementById("editCorreo").submit();

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