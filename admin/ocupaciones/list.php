<?php
require_once("../../include/initialize.php");

if (!isset($_SESSION['ADMIN_USERID'])) {
    redirect(web_root . "admin/index.php");
}

$mydb->setQuery("SELECT * FROM  `tblareas`");
$search = $mydb->loadResultList(); ?>


<div class="page-title">
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h1>Ocupaciones</h1>
        </div>
    </div>
</div>


<div class="row d-flex align-items-center">
    <div class="col-md-6">
        <div class="d-flex  align-items-center w-100">
            <a href="#" onclick="addOcupacion(event);"><i class="bi bi-plus-lg"></i></a>
        </div>
    </div>
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-6">
                <div class="form-floating shadow mb-3">
                    <select class="form-select" id="floatingSelect" onchange="valuechange(this)" aria-label="Floating label select example">
                        <option selected value="">Todos</option>
                        <?php foreach ($search as $key) { ?>
                            <option value="<?php echo $key->AREA ?>"><?php echo $key->AREA ?></option>
                        <?php } ?>
                    </select>
                    <label for="floatingSelect"> <i class="bi bi-search"></i> Seleccione las areas</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating shadow mb-3">
                    <input type="text" id="tableSearch" class="form-control" placeholder="Escriba su búsqueda aquí...">
                    <label for="tableSearch"><i class="bi bi-search"></i> Buscar registros</label>
                </div>
            </div>

        </div>
    </div>
</div>

<?php $mydb->setQuery("SELECT *FROM `tblocupaciones` o, `tblareas` a WHERE o.`AREAID` = a.`AREAID`");
$cur = $mydb->loadResultList(); ?>
<div class="col-lg-12">
    <div class="card shadow-sm mb-5" style="border-radius: 15px;">
        <div class="card-body">
            <table id="myTable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Ocupaciones</th>
                        <th>Area</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cur as $result) { ?>
                        <tr>
                            <td><?= $result->OCUPACION ?></td>
                            <td><?= $result->AREA ?></td>
                            <td>
                                <div class="badges text-center"><span style="cursor:pointer;" ondblclick="state(<?php echo $result->OCUPACIONSTATUS ?>, <?php echo $result->OCUPACIONID  ?>)" class="badge bg-<?= ($result->OCUPACIONSTATUS == 1) ? 'success' : 'danger' ?>"><?= ($result->OCUPACIONSTATUS == 1) ? 'Activo' : 'Inactivo' ?></span></div>
                            </td>
                            <td>
                                <a title="Edit" href="#" class="btn btn-grads btn-outline-light btn-xs" onclick='editOcupacion(<?= json_encode($result) ?>)'><i class="bi bi-pencil-fill"></i></a>
                            </td>
                            <!-- <td class="center">
                                <a title="Delete" onclick='deleteOcupacion(<?= json_encode($result) ?>)' class="btn btn-danger btn-xs"><i class="bi bi-trash-fill"></i></a>
                            </td> -->
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
        let response = await fetch(`<?php echo web_root ?>admin/ocupaciones/controller.php?action=state&id=${b}&code=${a == 1 ? 0 : 1}`, {
            method: 'POST'
        })

        let text = await response.json()
        if (text.status == "success") {
            location.href = text.location
        }
        console.log(text);
    }

    //FILTRO DE AREAS
    function valuechange(e) {
        var table = $('#myTable').DataTable();
        // console.log(e);
        table.column(1).search(e.value).draw();
    }

    function addOcupacion() {
        head.innerHTML = "AGREGAR OCUPACIÓN";
        content.innerHTML = `
			
                <form id="addOcupacion">
                                            <div class="form-floating mb-3">
                        <input type="text" name="OCUPACION" id="OCUPACION" class="form-control" placeholder="..." autocomplete="off">
                        <label for="OCUPACION">Agregar ocupación</label>
                    </div>
                    <div class="form-floating mb-4">
                        <select class="form-control" id="AREAID" name="AREAID">
                            <option value="">Seleccionar área</option>
                            <?php
                            $mydb->setQuery("SELECT * FROM tblareas WHERE ESTADO = 1"); // Solo áreas activas
                            $areas = $mydb->loadResultList();

                            foreach ($areas as $area) {
                                echo '<option value="' . $area->AREAID . '">' . $area->AREA . '</option>';
                            }
                            ?>
                        </select>
                        <label for="floatingSelect">Área</label>
                    </div>
                </form>
			`;
        foot.innerHTML = `
		<button form="addOcupacion" class="btn bg-success ml-1">
			<span class="d-none d-sm-block text-white">Guardar</span>
		</button>
			`;
        myModal.show();

        const form = document.getElementById("addOcupacion");
        const formFields = [
            document.getElementById("OCUPACION"),
            document.getElementById("AREAID"),

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
                let response = await fetch("<?php echo web_root ?>admin/ocupaciones/controller.php?action=add", {
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

    function editOcupacion(a) {
        head.innerHTML = "EDITAR OCUPACIÓN"
        content.innerHTML = `
        <form action="controller.php?action=edit&id=${a['OCUPACIONID']}" method="POST" id="editOcupacion">
            <div class="form-floating mb-3">
                <input type="text" name="OCUPACION" id="U_NAME" class="form-control" value="${a['OCUPACION']}" autocomplete="off" required>
                <label for="OCUPACION">Nombre</label>
            </div>

            <div class="form-floating mb-4">
                        <select class="form-control" id="AREAID" name="AREAID">
                        <option value="${a['AREAID']}">${a['AREA']}</option>
                            <?php
                            $mydb->setQuery("SELECT * FROM tblareas");
                            $areas = $mydb->loadResultList();
                            foreach ($areas as $area) {
                                echo '<option value="' . $area->AREAID . '">' . $area->AREA . '</option>';
                            }
                            ?>
                        </select>
                        <label for="floatingSelect">Área</label>
                    </div>

        </form>
    `
        foot.innerHTML = `
        <button form="editOcupacion" class="btn btn-success ml-1" name="save" onclick="updateOcupacion()">                    
            <span class="d-none d-sm-block">Actualizar</span>
        </button>
    `
        myModal.show();
    }

    function updateOcupacion() {
        document.getElementById("editOcupacion").submit();

        Swal.fire({
            title: "Ocupación actualizada",
            text: "La ocupación ha sido actualizada con éxito",
            icon: "success",
            confirmButtonText: "Aceptar",
            timer: 5000,
            timerProgressBar: true,
        });
    }
</script>