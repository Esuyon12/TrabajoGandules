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
				<h1>Sedes</h1>
			</div>
		</div>
	</div>

	<div class="col-lg-12">
		<div class="d-flex justify-content-between align-items-center w-100">
			<div class="d-flex align-items-center">
				<a href="#" onclick="addCompany()"><i class="bi bi-plus-lg"></i></a>
			</div>
			<div class="d-flex">
				<div class="form-floating mb-4">
					<input type="text" id="tableSearch" class="form-control shadow" placeholder="Escriba su búsqueda aquí...">
					<label for="tableSearch">Buscar registros</label>
				</div>
			</div>
		</div>
	</div>



	<?php $mydb->setQuery("SELECT * FROM  `tblcompany`");
	$cur = $mydb->loadResultList(); ?>
	<div class="col-lg-12">
		<div class="card shadow-sm" style="border-radius: 15px;">
			<div class="card-body">
				<table id="myTable" class="table table-striped table-bordered">
					<thead>
						<tr>
							<!-- <th>No.</th> -->
							<th>Nombre</th>
							<th>Dirección</th>
							<th>Descripción</th>
							<th>Estado</th>
							<th></th>
						</tr>
					</thead>

					<tbody>
						<?php foreach ($cur as $result) { ?>
							<tr>
								<td><?= $result->COMPANYNAME ?></td>
								<td><?= $result->COMPANYADDRESS ?></td>
								<td style="width: 40%;"><?= substr($result->DESCRIPCION, 0, 100) . '...' ?></td>
								<td style="width: 10%;">
									<div class="badges text-center"><span style="cursor:pointer;" ondblclick="state(<?php echo $result->COMPANYSTATUS ?>, <?php echo $result->COMPANYID ?>)" class="badge bg-<?= ($result->COMPANYSTATUS == 1) ? 'success' : 'danger' ?>"><?= ($result->COMPANYSTATUS == 1) ? 'Activo' : 'Inactivo' ?></span></div>
								</td>
								<td style="width: 5%;">
									<a title="Edit" href="#" class="btn bg-success btn-outline-light btn-xs" onclick='editCompany(<?= json_encode($result) ?>)'><i class="bi bi-pencil-square"></i></a>
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
			let response = await fetch(`<?php echo web_root ?>admin/company/controller.php?action=state&id=${b}&code=${a == 1 ? 0 : 1}`, {
				method: 'POST'
			})

			let text = await response.json()
			if (text.status == "success") {
				location.href = text.location
			}
			console.log(text);
		}

		function addCompany() {
			head.innerHTML = "AGREGAR NUEVA SEDE";
			content.innerHTML = `
			<form id="addCompany">
         <div class="form-floating mb-4">
        <input type="text" name="COMPANYNAME" id="COMPANYNAME" class="form-control" placeholder="..." autocomplete="off">
        <label for="COMPANYNAME"> Nombre sede</label>
      </div>
      <div class="form-floating mb-4">
        <input type="text" name="COMPANYADDRESS" id="COMPANYADDRESS" class="form-control" placeholder="..." autocomplete="off">
        <label for="COMPANYADDRESS"> Dirección sede</label>
      </div>
   
	  <div class="form-floating mb-4">
					<div class="card-body">
						<div class="form-group with-title mb-3">
							<textarea class="form-control" name="DESCRIPCION" id="DESCRIPCION" placeholder="..." rows="3"></textarea>
							<label>Descripción de sede </label>
						</div>
					</div>
				</div>

    </form>
  `;
			foot.innerHTML = `
    <button form="addCompany" class="alert bg-success ml-1">
      <span class="d-none d-sm-block text-white">Registrar</span>
    </button>
  `;
			myModal.show();


			const form = document.getElementById("addCompany");
			const formFields = [
				document.getElementById("COMPANYNAME"),
				document.getElementById("COMPANYADDRESS"),
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
					let response = await fetch("<?php echo web_root ?>admin/company/controller.php?action=add", {
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


		function editCompany(a) {
			head.innerHTML = "EDITAR SEDE"
			content.innerHTML = `
        <form action="controller.php?action=edit&id=${a['COMPANYID']}" method="POST" id="editCompany" >

		<div class="form-floating mb-4">
				<input type="text" name="COMPANYNAME" id="COMPANYNAME" class="form-control" value="${a['COMPANYNAME']}" autocomplete="off" required>
				<label for="COMPANYNAME"><i class="fas fa-building" "></i> Sede</label>
			</div>
			<div class="form-floating mb-4">
				<input type="text" name="COMPANYADDRESS" id="COMPANYADDRESS" class="form-control" value="${a['COMPANYADDRESS']}" autocomplete="off" required>
				<label for="COMPANYADDRESS"><i class="fas fa-map-marker-alt" "></i> Dirección de sede</label>
			</div>
		
			<div class="form-floating mb-4">
				<div class="card-body">
					<div class="form-group with-title mb-3">
						<textarea class="form-control" name="DESCRIPCION" id="DESCRIPCION" id="DESCRIPCION"> ${a['DESCRIPCION']}></textarea>
						<label> Descripción de sede  </label>
					</div>
				</div>
			</div>

			</form>
    `
			foot.innerHTML = `
        <button form="editCompany" class="btn btn-outline-success ml-1" name="save" onclick="updateCompany()">                    
            <span class="d-none d-sm-block">Actualizar</span>
        </button>
    `
			myModal.show();
		}

		function updateCompany() {
			document.getElementById("editCompany").submit();

			Swal.fire({
				title: "Sede actualizada",
				text: "La sede ha sido actualizada con éxito",
				icon: "success",
				confirmButtonText: "Aceptar",
				timer: 5000,
				timerProgressBar: true,
			});
		}
	</script>