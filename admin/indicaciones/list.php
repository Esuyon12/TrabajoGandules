<?php
require_once("../../include/initialize.php");

if (!isset($_SESSION['ADMIN_USERID'])) {
    redirect(web_root . "admin/index.php");
}

$mydb->setQuery("SELECT * FROM  `tblocupaciones`");
$search = $mydb->loadResultList(); ?>

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h1 class="page-header">Inidicaciones</h1>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="d-flex justify-content-between align-items-center w-100">
            <div class="d-flex align-items-center">
                <a href="#" onclick="addIndicacion()"><i class="bi bi-plus-lg"></i> Nueva indicación</a>
            </div>
            <div class="d-flex">
                <div class="form-floating mb-4">
                    <input type="text" id="tableSearch" class="form-control shadow" placeholder="Escriba su búsqueda aquí...">
                    <label for="tableSearch">Buscar registros</label>
                </div>
            </div>
        </div>
    </div>

    <?php
    $mydb->setQuery("SELECT * FROM `tblindicacioneseva`");
    $cur = $mydb->loadResultList();
    ?>

    <div class="col-lg-12">
        <div class="card shadow">
            <div class="card-body">
                <table id="myTable" class="table table-striped table-bordered">
                    <thead>

                        <tr>
                            <th>Contenido de correo</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        foreach ($cur as $result) { ?>
                            <tr>
                                <td><?= substr($result->DESCRIPCION, 0, 150) . '...' ?></td>
                                <td style="width: 7%;">
                                    <div class="badges text-center"><span style="cursor:pointer;" ondblclick="state(<?php echo $result->ESTADO ?>, <?php echo $result->INDICACIONID  ?>)" class="badge bg-<?= ($result->ESTADO == 1) ? 'success' : 'danger' ?>"><?= ($result->ESTADO == 1) ? 'Activo' : 'Inactivo' ?></span></div>
                                </td>
                                <td style="width: 5%;">
                                    <a title="Edit" href="#" class="btn bg-success btn-outline-light btn-xs" onclick='editIndicacion(<?= json_encode($result) ?>)'><i class="bi bi-pencil-fill"></i></a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>

<script>
    const myModal = new bootstrap.Modal(document.getElementById('modal'))
    const content = document.getElementById("content")
    const head = document.getElementById("headTitle")
    const foot = document.getElementById("footer")

    async function state(a, b) {
        let response = await fetch(`<?php echo web_root ?>admin/indicaciones/controller.php?action=state&id=${b}&code=${a == 1 ? 0 : 1}`, {
            method: 'POST'
        })

        let text = await response.json()
        if (text.status == "success") {
            location.href = text.location
        }
        console.log(text);
    }


    function addIndicacion() {
        head.innerHTML = "Nueva indicación";
        content.innerHTML = `
			
                <form id="addIndicacion">
                       
                    <div class="form-floating mb-4">
                        <div class="card border">
                            <div id="full" style="border: 1px solid #ced4da; border-radius: 0.25rem;">
                                <p></p>
                            </div>
                        </div>
        </div>

        <input type="hidden" name="DESCRIPCION" id="DESCRIPCION">
        
                                  </form>
			`;
        foot.innerHTML = `
		<button form="addIndicacion" class="btn bg-success ml-1">
			<span class="d-none d-sm-block text-white">Guardar</span>
		</button>
			`;

        var quill = new Quill('#full', {
            theme: 'snow'
        });

        // Update hidden input with Quill editor content on form submit
        document.getElementById('addIndicacion').addEventListener('submit', function() {
            var descripContent = quill.root.innerHTML;
            document.getElementById('DESCRIPCION').value = descripContent;
        });

        myModal.show();

        // Mover las opciones del editor Quill a la parte inferior
        var quillOptions = document.querySelector('.ql-toolbar');
        var quillContainer = document.querySelector('.ql-container');
        quillContainer.appendChild(quillOptions);



        const form = document.getElementById("addIndicacion");
        const formFields = [
            document.getElementById("DESCRIPCION"),
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
                let response = await fetch("<?php echo web_root ?>admin/indicaciones/controller.php?action=add", {
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


    function editIndicacion(a) {
        head.innerHTML = "Modificar indicación";
        content.innerHTML = `
        <form action="controller.php?action=edit&id=${a['INDICACIONID']}" method="POST" id="editIndicacion">
            <div class="form-floating mb-4">
                <div class="card border">
                    <div id="full" style="border: 1px solid #ced4da; border-radius: 0.25rem;"></div>
                </div>
            </div>
            <input type="hidden" name="DESCRIPCION" id="DESCRIPCION">
        </form>
    `;
        foot.innerHTML = `
        <button form="editIndicacion" class="btn btn-success ml-1" name="save" onclick="updateIndicacion()">                    
            <span class="d-none d-sm-block">Actualizar</span>
        </button>
    `;

        var quill = new Quill('#full', {
            theme: 'snow'
        });

        // Set the existing content in the editor
        quill.clipboard.dangerouslyPasteHTML(a['DESCRIPCION']);

        // Update hidden input with Quill editor content on form submit
        document.getElementById('editIndicacion').addEventListener('submit', function() {
            var descripContent = quill.root.innerHTML;
            document.getElementById('DESCRIPCION').value = descripContent;
        });

        myModal.show();

        // Mover las opciones del editor Quill a la parte inferior
        var quillOptions = document.querySelector('.ql-toolbar');
        var quillContainer = document.querySelector('.ql-container');
        quillContainer.appendChild(quillOptions);

    }


    function updateIndicacion() {
        document.getElementById("editIndicacion").submit();

        Swal.fire({
            title: "Registro actualizado",
            text: "El registro ha sido actualizada con éxito",
            icon: "success",
            confirmButtonText: "Aceptar",
            timer: 5000,
            timerProgressBar: true,
        });
    }
</script>