<?php
require_once("../../include/initialize.php");

if (!isset($_SESSION['ADMIN_USERID'])) {
	redirect(web_root . "admin/index.php");
}

$autonum = new Autonumber();
$res = $autonum->set_autonumber('userid');

?>

<div class="page-heading">
	<div class="page-title">
		<div class="row">
			<div class="col-12 col-md-6 order-md-1 order-last">
				<h1>Usuarios</h1>
			</div>
			<div class="col-12 col-md-6 order-md-2 order-first">
				<nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
					<ol class="breadcrumb">
						<li class="breadcrumb-item">
							<a href="<?= web_root ?>admin/"><b> Dashboard</b></a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">Usuarios</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>


	<div class="col-lg-12">
		<div class="d-flex justify-content-between align-items-center w-100">
			<div class="d-flex align-items-center">
				<!-- <h1 class="page-header">Usuarios</h1> -->
				<a href="#" onclick="addUser()"><i class="bi bi-plus-lg"></i></a>
			</div>
			<div class="d-flex">
				<div class="form-floating mb-3">
					<input type="text" id="tableSearch" class="form-control" placeholder="Escriba su búsqueda aquí...">
					<label for="tableSearch">Buscar registros</label>
				</div>
			</div>
		</div>
		<!-- </br><a href="index.php?view=add" class="btn btn-primary btn-xs  "> <i class="bi bi-plus-circle"></i> AGREGAR USUARIO</a> -->
	</div>

	<?php $mydb->setQuery("SELECT * FROM  `tblusers`");
	$cur = $mydb->loadResultList(); ?>
	<div class="col-lg-12">
		<div class="card shadow-sm p-3 mb-5" style="border-radius: 15px;">
			<div class="card-body">
				<table id="myTable" class="table table-striped table-bordered">
					<thead>

						<tr>
							<th>Nombre</th>
							<th>Usuario</th>
							<th>Correo</th>
							<th>Dni</th>
							<th>telefono</th>
							<th>Rol</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($cur as $result) { ?>
							<tr>
								<td><?= $result->FULLNAME ?></td>
								<td><?= $result->USERNAME ?></td>
								<td><?= $result->CORREO ?></td>
								<td><?= $result->DNI ?></td>
								<td><?= $result->TELEFONO ?></td>
								<td style="width: 7%;">
									<span class="badge <?= ($result->ROLE == 'Administrador') ? 'bg-blue' : 'bg-success'; ?>"><?= $result->ROLE ?></span>
								</td>
								<!-- 
								<td style="width: 5%;">
									<a title="edit" href="#" class="btn bg-success btn-outline-light btn-xs" onclick='editUser(<?= json_encode($result) ?>)'>
										<i class="bi bi-arrow-right"></i>
									</a>
								</td> -->

							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<!-- <script>
		const myModal = new bootstrap.Modal(document.getElementById('modal'))
		const content = document.getElementById("content")
		const head = document.getElementById("headTitle")
		const foot = document.getElementById("footer")
		const MHead = document.getElementById("MHead")

		function addUser() {
					head.innerHTML = "AGREGAR NUEVO USUARIO"
			content.innerHTML = `
        <form action="controller.php?action=add" method="POST" id="addUser">
            <input id="user_id" name="user_id" type="hidden" value="<?php echo $res->AUTO; ?>">

			<div class="alert alert-info d-flex align-items-center  mb-4" role="alert">
					<i class="bi bi-info-circle-fill me-2"></i>
					<div>
						Todos los campos con <span class="text-danger fw-bold">*</span> son obligatorios.
					</div>
				</div>
            <div class="form-floating mb-4">
                <input type="text" name="U_NAME" id="U_NAME" class="form-control" placeholder="..." required>
                <label for="U_NAME"><i class="bi bi-person-fill"></i> Nombre *</label>
            </div>

            <div class="form-floating mb-4">
                <input type="text" name="U_USERNAME" id="U_USERNAME" class="form-control" placeholder="..." required>
                <label for="U_USERNAME"><i class="bi bi-person-badge-fill"></i> Nombre de usuario *</label>
            </div>

            <div class="form-floating mb-4">
                <input type="password" name="U_PASS" id="U_PASS" min="3" class="form-control" placeholder="..." required>
                <label for="U_PASS"><i class="bi bi-lock-fill"></i> Contraseña *</label>
            </div>

            <div class="form-floating mb-5">
                <select class="form-select" name="U_ROLE" id="U_ROLE" required>
                    <option selected disabled></option>
                    <option value="1">Administrator</option>
                    <option value="2">Reclutamiento</option>
                </select>
                <label for="U_ROLE"><i class="bi bi-people-fill"></i> Rol *</label>
            </div>                   
        </form>
    `;
			foot.innerHTML = ` 
        <button form="addUser" class="btn btn-outline-success ml-1">                    
            <span class="d-none d-sm-block">Guardar</span>
            <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cancelar</button>
        </button>
    `;
			myModal.show();

			// Agrega un evento de escucha de envío de formulario
			const form = document.getElementById("addUser");
			form.addEventListener("submit", function(event) {
				// Detiene el envío del formulario por defecto
				event.preventDefault();

				// Realiza la validación
				const name = document.getElementById("U_NAME").value;
				const username = document.getElementById("U_USERNAME").value;
				const password = document.getElementById("U_PASS").value;
				const role = document.getElementById("U_ROLE").value;

				if (!name || !username || !password || !role) {
					// Muestra una alerta de SweetAlert si algún campo obligatorio no está lleno
					Swal.fire({
						icon: "warning",
						title: "Campos vacíos",
						text: "Por favor, complete todos los campos obligatorios.",
						confirmButtonColor: "#d33",
						confirmButtonText: "Entendido",
					});
				} else {
					// Enviar el formulario
					form.submit();
				}
			});

			return false;
		}


		function deleteUser(id, name) {
			MHead.classList.add("bg-danger")
			head.classList.add("white")
			head.innerHTML = "Eliminar Usuario"
			content.innerHTML = `
			<form action="controller.php?action=delete&id=${id}" method="POST" id="deleteUser">
				<p class="text-uppercase">¿ESTAS SEGURO QUE DESEAS ELIMINAR A ${name}?</p>
			</form>
		`
			foot.innerHTML = ` 
			<button form="deleteUser" class="btn btn-danger ml-1">                    
				<span class="d-none d-sm-block">Eliminar</span>
			</button>
			`
			myModal.show();
		}



		function editUser(id, username, role) {
			role = (role == "Administrator") ? "Recursos humanos" : "Administrator";

			MHead.classList.add("bg-warning")
			head.classList.add("white")
			head.innerHTML = "EDITAR USUARIO"
			content.innerHTML = `
        <form action="controller.php?action=edit&id=${id}" method="POST" id="editUser">			
            <input id="U_ROLE" name="U_ROLE" type="hidden" value="${role}">
            <input id="U_USERNAME" name="U_USERNAME" type="hidden" value="${username}">
			<p class="text-uppercase">¿ESTAS SEGURO QUE DESEAS QUE ${username} PASE A ${role}?</p>
        </form>
    `
			foot.innerHTML = `
        <button form="editUser" class="btn btn-primary ml-1">                    
            <span class="d-none d-sm-block">Actualizar</span>
        </button>
    `
			myModal.show();
		}

		myModal._element.addEventListener('hidden.bs.modal', function(event) {
			switch (true) {
				case MHead.classList.contains("bg-danger"):
					MHead.classList.remove("bg-danger");
					break;
				case MHead.classList.contains("bg-warning"):
					MHead.classList.remove("bg-warning");
					break;
				case MHead.classList.contains("bg-primary"):
					MHead.classList.remove("bg-primary");
					break;
				default:
			}
		});
	</script> -->