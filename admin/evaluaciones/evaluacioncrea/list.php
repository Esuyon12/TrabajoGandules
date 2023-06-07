<?php
require_once("../../../include/initialize.php");

if (!isset($_SESSION['ADMIN_USERID'])) {
    redirect(web_root . "admin/index.php");
}
?>

<div class="page-title">
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h1>Evaluaciones</h1>
        </div>
    </div>
</div>

<div class="col-lg-12">
    <div class="d-flex justify-content-between align-items-center w-100">
        <div class="d-flex align-items-center">
            <a href="#" onclick="addEvaluacionCrea(event)"><i class="bi bi-plus-lg"></i> Nueva evaluacion </a>
        </div>
        <div class="d-flex">
            <div class="form-floating mb-4">
                <input type="text" id="tableSearch" class="form-control shadow-sm" placeholder="Escriba su búsqueda aquí...">
                <label for="tableSearch">Buscar registros</label>
            </div>
        </div>
    </div>
</div>

<?php $mydb->setQuery("SELECT * FROM  `tblcreaevaluaciones` c, `tblocupaciones` a WHERE a.`OCUPACIONID` = c.`OCUPACIONID` ");
$cur = $mydb->loadResultList(); ?>
<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <table id="myTable" class="table table-striped table-bordered">
                <thead>

                    <tr>
                        <th>Ocupación</th>
                        <th>Titulo</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($cur as $result) { ?>
                        <tr>
                            <td><?= $result->OCUPACION ?></td>
                            <td><?= $result->TITULO ?></td>
                            <td style="width: 7%;">
                                <div class="badges text-center"><span style="cursor:pointer;" ondblclick="state(<?php echo $result->ESTADO ?>, <?php echo $result->IDEVALUACIONCREA  ?>)" class="badge bg-<?= ($result->ESTADO == 1) ? 'success' : 'danger' ?>"><?= ($result->ESTADO == 1) ? 'Activo' : 'Inactivo' ?></span></div>


                            </td>

                            <td style="width: 5%;">
                                <a title="View" href="#" class="btn bg-success btn-outline-light btn-xs" onclick='editEvaluacion(<?= json_encode($result) ?>)'>
                                    <i class="bi bi-eye"></i></a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            </form>
        </div>
    </div>
</div>

<script>
    const myModal = new bootstrap.Modal(document.getElementById('modal'))
    const content = document.getElementById("content")
    const head = document.getElementById("headTitle")
    const foot = document.getElementById("footer")


    async function state(a, b) {
        let response = await fetch(`<?php echo web_root ?>admin/evaluaciones/evaluacioncrea/controller.php?action=state&id=${b}&code=${a == 1 ? 0 : 1}`, {
            method: 'POST'
        })

        let text = await response.json()
        if (text.status == "success") {
            location.href = text.location
        }
        console.log(text);
    }

    function addEvaluacionCrea() {
        // MHead.classList.add("bg-success");
        // head.classList.add("white");
        head.innerHTML = "Agregar nueva evaluación";
        content.innerHTML = `
        <form id="addEvaluacionCrea">
    <div class="row g-2">
        <div class="col-md">
            <div class="form-floating mb-4">
                <select class="form-control" id="AREAID" name="AREAID" onchange="ocup(this)">
                    <option value="">Seleccionar Área</option>
                    <?php
                    $mydb->setQuery("SELECT * FROM tblareas WHERE ESTADO = 1");
                    $areas = $mydb->loadResultList();

                    foreach ($areas as $area) {
                        echo '<option value="' . $area->AREAID . '">' . $area->AREA . '</option>';
                    }
                    ?>
                </select>
                <label for="floatingSelect"> Área</label>
            </div>
        </div>
        <div class="col-md">
            <div class="form-floating mb-4">
                <select class="form-control" id="OCUPACIONID" name="OCUPACIONID">
                </select>
                <label for="floatingSelect"> Titulo de ocupación</label>
            </div>
        </div>
    </div>

    <div class="form-floating mb-4">
        <div class="card-body">
            <div class="form-group with-title mb-3">
                <input class="form-control" type="text" name="TITULO" id="TITULO" placeholder="..." autocomplete="off">
                <label>TITULO</label>
            </div>
        </div>
    </div>

    <div class="form-floating mb-4">
        <div class="card border">
            <div id="full" style="border: 1px solid #ced4da; border-radius: 0.25rem;">
                <p>...</p>
            </div>
        </div>
    </div>

    <input type="hidden" name="TAREA" id="TAREA">


    <div class="form-floating mb-4">
        <div class="card-body">
            <div class="form-group with-title mb-3">
                <textarea class="form-control" name="INDICACIONES" id="INDICACIONES" placeholder="..." rows="3"></textarea>
                <label>Indicaciones</label>
            </div>
        </div>
    </div>
</form>
    `;

        foot.innerHTML = `
    <button form="addEvaluacionCrea" class="btn bg-success ml-1">
        <span class="d-none d-sm-block text-white">Guardar</span>
    </button>
    `;

        var quill = new Quill('#full', {
            theme: 'snow'
        });

        // Update hidden input with Quill editor content on form submit
        document.getElementById('addEvaluacionCrea').addEventListener('submit', function() {
            var tareaContent = quill.root.innerHTML;
            document.getElementById('TAREA').value = tareaContent;
        });


        myModal.show();
        var modalDialog = document.querySelector(".modal-dialog");
        modalDialog.classList.add("modal-lg");




        const form = document.getElementById("addEvaluacionCrea");
        const formFields = [
            document.getElementById("TITULO"),

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
                let response = await fetch("<?php echo web_root ?>admin/evaluaciones/evaluacioncrea/controller.php?action=add", {
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




    function editEvaluacion(result) {
        head.innerHTML = "Detalles de evaluación";
        content.innerHTML = `
        <form id="editEvaluacion">
    <input type="hidden" name="IDEVALUACIONCREA" value="${result.IDEVALUACIONCREA}">
    <div class="form-group">
        <label for="ocupacion">Ocupación</label>
        <input type="text" id="ocupacion" name="OCUPACIONID" class="form-control" value="${result.OCUPACION}">
    </div>

    <div class="form-group">
        <label for="titulo">Título</label>
        <input type="text" id="titulo" name="TITULO" class="form-control" value="${result.TITULO}">
    </div>


    <div class="form-floating mb-4">
        <div class="card border">
            <div id="full" style="border: 1px solid #ced4da; border-radius: 0.25rem;">
                <p>${result.TAREA}</p>
            </div>
        </div>
    </div>
    <input type="hidden" name="TAREA" id="TAREA">

    <div class="form-group">
        <label for="TAREA">INDICACIONES</label>
        <textarea id="TAREA" name="TAREA" class="form-control">${result.INDICACIONES}</textarea>
    </div>

</form>


`;
        foot.innerHTML = `
<button form="editEvaluacion" class="btn bg-success text-white ml-1">
    <span class="d-none d-sm-block">Guardar</span>
</button>
`;


        var quill = new Quill('#full', {
            theme: 'snow'
        });

        // Update hidden input with Quill editor content on form submit
        document.getElementById('editEvaluacion').addEventListener('submit', function() {
            var tareaContent = quill.root.innerHTML;
            document.getElementById('TAREA').value = tareaContent;
        });

        myModal.show();



        var modalDialog = document.querySelector(".modal-dialog");
        modalDialog.classList.add("modal-lg");

        const viewForm = document.getElementById("editEvaluacion");

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



    async function ocup(e) {
        let response = await fetch(`<?php echo URL_WEB . web_root ?>admin/evaluaciones/evaluacioncrea/controller.php?action=select&AREAID=${e.value}`)
        let data = await response.json()
        if (data.data != null && data.data.length != 0) {
            let content = `<option value="">Seleccionar ocupación</option>`
            data.data.forEach(function(key) {
                content += `<option value="${key.OCUPACIONID}">${key.OCUPACION}</option>`
            });
            document.getElementById("OCUPACIONID").innerHTML = content
        } else {
            let content = `<option value="">Seleccionar ocupación</option>`
            document.getElementById("OCUPACIONID").innerHTML = content
        }
    }
</script>