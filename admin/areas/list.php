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
                <h1>Áreas</h1>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="d-flex justify-content-between align-items-center w-100">
            <div class="d-flex align-items-center">
                <a href="#" onclick="addArea(event);"><i class="bi bi-plus-lg"></i> Nueva área</a>
            </div>
            <div class="d-flex">
                <div class="form-floating shadow mb-4">
                    <input type=" text" id="tableSearch" class="form-control" placeholder="Escriba su búsqueda aquí...">
                    <label for="tableSearch"> <i class="bi bi-search"></i> Buscar registros</label>
                </div>
            </div>

        </div>
    </div>



    <?php $mydb->setQuery("SELECT * FROM  `tblareas`");
    $cur = $mydb->loadResultList(); ?>
    <div class="col-lg-12">
        <div class="card shadow-sm  ">
            <div class="card-body">
                <table id="myTable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Área</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>


                    <tbody>
                        <?php foreach ($cur as $result) { ?>
                            <tr>
                                <td><?= $result->AREA ?></td>
                                <td style="width: 7%;">
                                    <div class="badges text-center"><span style="cursor:pointer;" ondblclick="state(<?php echo $result->ESTADO ?>, <?php echo $result->AREAID ?>)" class="badge bg-<?= ($result->ESTADO == 1) ? 'success' : 'danger' ?>"><?= ($result->ESTADO == 1) ? 'Activo' : 'Inactivo' ?></span></div>
                                </td>

                                <td style="width: 5%;">
                                    <a title="Edit" href="#" class="btn bg-success btn-outline-light btn-xs" onclick='editArea(<?= json_encode($result) ?>)'><i class="bi bi-pencil-square"></i></a>
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
            let response = await fetch(`<?php echo web_root ?>admin/areas/controller.php?action=state&id=${b}&code=${a == 1 ? 0 : 1}`, {
                method: 'POST'
            })

            let text = await response.json()
            if (text.status == "success") {
                location.href = text.location
            }
            console.log(text);
        }

        function addArea() {
            head.innerHTML = "AGREGAR NUEVA ÁREA";
            content.innerHTML = `
			<form id="addArea">
            
				<div class="form-floating mb-3">
					<input type="text" name="AREA" id="AREA" class="form-control" placeholder="..." autocomplete="off">
					<label for="area">Nombre de área </label>
				</div>
			</form>
			`;
            foot.innerHTML = `
			<button form="addArea" class="btn bg-success text-white ml-1">
				<span class="d-none d-sm-block">Guardar</span>
			</button>
			`;
            myModal.show();

            const form = document.getElementById("addArea");
            const formFields = [
                document.getElementById("AREA"),
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
                    let response = await fetch("<?php echo web_root ?>admin/areas/controller.php?action=add", {
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


        function editArea(a) {
            MHead.classList.add("bg-success")
            head.classList.add("white")
            head.innerHTML = "EDITAR ÁREA"
            content.innerHTML = `
        <form action="controller.php?action=edit&id=${a['AREAID']}" method="POST" id="editArea">
            <div class="form-floating mb-3">
                <input type="text" name="AREA" id="AREA" class="form-control" value="${a['AREA']}" autocomplete="off" required>
                <label for="AREA">Nombre</label>
            </div>
                   </form>
        `
            foot.innerHTML = `
            <button form="editArea" class="btn bg-success ml-1" name="save" onclick="updateArea()">                    
                <span class="d-none d-sm-block text-white">Actualizar</span>
            </button>
        `
            myModal.show();
        }


        function updateArea() {
            document.getElementById("editArea").submit();

            Swal.fire({
                title: "Área actualizada",
                text: "Área ha sido actualizada con éxito",
                icon: "success",
                confirmButtonText: "Aceptar",
                timer: 5000,
                timerProgressBar: true,
            });
        }
    </script>