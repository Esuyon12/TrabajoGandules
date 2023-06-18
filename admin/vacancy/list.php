<?php
if (!isset($_SESSION['ADMIN_USERID'])) {
	redirect(web_root . "admin/index.php");
}
?>

<div class="page-title">
	<div class="row">
		<div class="col-12 col-md-6 order-md-1 order-last">
			<h1>Vacantes</h1>
		</div>
	</div>
</div>

<div class="col-lg-12">
	<div class="d-flex justify-content-between align-items-center w-100">
		<div class="d-flex align-items-center">
			<a href="#" onclick="addVacancy()"><i class="bi bi-plus-lg"></i> Nueva vacante</a>
		</div>
		<div class="d-flex">
			<div class="form-floating mb-4">
				<input type="text" id="tableSearch" class="form-control shadow-sm" placeholder="Escriba su búsqueda aquí...">
				<label for="tableSearch">Buscar registros</label>
			</div>
		</div>
	</div>
</div>

<?php $mydb->setQuery("SELECT * FROM  `tbljob`");
$cur = $mydb->loadResultList(); ?>
<div class="col-lg-12">
	<div class="card shadow-sm">
		<div class="card-body">
			<table id="myTable" class="table table-striped table-bordered">
				<thead>
					<tr>
						<th>Sede</th>
						<th>Área</th>
						<th>Ocupación</th>
						<th>Creación</th>
						<th>F.Inicio</th>
						<th>F.Fin</th>
						<th></th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php

					$mydb->setQuery("SELECT j.*, p.*, c.`TIPOCONTRATO`, o.*, a.* FROM `tbljob` j, `tblocupaciones` p, `tbltipocontrato` c, `tblcompany` o, `tblareas` a WHERE j.`AREAID` = a.`AREAID` AND o.`COMPANYID` = j.`COMPANYID` AND c.`TCONTRATOID` = j.`TCONTRATOID` AND p.`OCUPACIONID` = j.`OCUPACIONID`");;
					$cur = $mydb->loadResultList();

					foreach ($cur as $result) {

					?>
						<tr>
							<td><?= $result->COMPANYNAME  ?></td>
							<td style="width: 20%;"><?= substr($result->AREA, 0, 25) . '...' ?></td>
							<td style="width: 20%;"><?= substr($result->OCUPACION, 0, 25) . '...' ?></td>
							<!-- <td><?= $result->OCUPACION ?></td> -->
							<td><?= $result->DATEPOSTED ?></td>
							<td><?= $result->DATE_INT ?></td>
							<td><?= $result->DATE_END ?></td>
							<td style="width: 7%;">
								<div class="badges text-center"><span style="cursor:pointer;" ondblclick="state(<?php echo $result->JOBSTATUS ?>, <?php echo $result->JOBID ?>)" class="badge bg-<?= ($result->JOBSTATUS == 1) ? 'danger' : 'success' ?>"><?= ($result->JOBSTATUS == 1) ? 'Inactivo' : 'Activo' ?></span></div>
							</td>

							<td>
								<a title="Edit" href="#" class="btn bg-success btn-outline-light btn-xs" onclick='editVacancy(<?php echo json_encode($result) ?>)'>
									<i class="bi bi-pencil-square text-white"></i>
								</a>
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
		let response = await fetch(`<?php echo web_root ?>admin/vacancy/controller.php?action=state&id=${b}&code=${a == 1 ? 0 : 1}`, {
			method: 'POST'
		})

		let text = await response.json()
		if (text.status == "success") {
			location.href = text.location
		}
		console.log(text);
	}

	function addVacancy() {

		head.innerHTML = "NUEVA VACANTE"
		content.innerHTML = `
	
		<form id="addVacancy" class="container-fluid">
						<div class="form-floating mb-4">
					<select class="form-control" id="COMPANYID" name="COMPANYID">
						<option value="">Seleccionar sede</option>
						<?php
						$mydb->setQuery("SELECT * FROM tblcompany WHERE COMPANYSTATUS = 1");
						$companies = $mydb->loadResultList();
						foreach ($companies as $company) {
							echo '<option value="' . $company->COMPANYID . '">' . $company->COMPANYNAME . '</option>';
						}
						?>
					</select>
					<label for="floatingSelect"> Sede</label>
				</div>



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

				<div class="row g-2">
					<div class="col-md">
						<div class="form-floating mb-4">
							<input type="number" name="REQ_EMPLOYEES" id="REQ_EMPLOYEES" class="form-control" placeholder="..." autocomplete="off">
							<label for="REQ_EMPLOYEES">Disponibilidad de vacantes</label>
						</div>
					</div>

					<div class="col-md">
						<div class="form-floating mb-4">
							<input type="text" name="SUELDO" id="SUELDO" class="form-control" placeholder="..." autocomplete="off">
							<label for="SUELDO"> Sueldo</label>
						</div>
					</div>
				</div>


				<div class="form-floating mb-4">
					<div class="card-body">
						<div class="form-group with-title mb-3">
							<textarea class="form-control" name="INFOJOB" id="INFOJOB" placeholder="..." rows="3"></textarea>
							<label>Descripción de vacante</label>
						</div>
					</div>
				</div>

				<div class="form-floating mb-4">
					<div class="card-body">
						<div class="form-group with-title mb-3">
							<textarea class="form-control" name="WORKEXPERIENCE" id="WORKEXPERIENCE" placeholder="..." rows="3"></textarea>
							<label>Experiencia/ Requisitos</label>
						</div>
					</div>
				</div>


				<div class="form-floating mb-4">
					<div class="card-body">
						<div class="form-group with-title mb-3">
							<textarea class="form-control" name="JOBDESCRIPTION" id="JOBDESCRIPTION" placeholder="..." rows="3"></textarea>
							<label> Descripción/Funciones de trabajo </label>
						</div>
					</div>
				</div>



				<div class="form-floating mb-4">
					<div class="card-body">
						<div class="form-group with-title mb-3">
							<textarea class="form-control" name="BENEFICIOS" id="BENEFICIOS" placeholder="..." rows="3"></textarea>
							<label>Beneficios </label>
						</div>
					</div>
				</div>

				<div class="row g-2">
					<div class="col-md">
						<div class="form-floating mb-4">
							<select class="form-control" id="GENERO" name="GENERO">
								<option value="">Selecionar</option>
								<option value="Masculino">Masculino</option>
								<option value="Femenino">Femenino</option>
								<option value="Maculino/Femenino">Maculino/Femenino</option>
								<option value="Genero no definido">Genero no definido</option>
							</select>
							<label for="floatingSelect">Genero</label>
						</div>
					</div>

					<div class="col-md">
						<div class="form-floating mb-4">
							<select class="form-control" id="TCONTRATOID" name="TCONTRATOID">
								<option value="">Seleccionar</option>
								<?php
								$mydb->setQuery("SELECT * FROM tbltipocontrato");
								$tcontratos = $mydb->loadResultList();

								foreach ($tcontratos as $tcontrato) {
									echo '<option value="' . $tcontrato->TCONTRATOID . '">' . $tcontrato->TIPOCONTRATO . '</option>';
								}
								?>
							</select>
							<label for="floatingSelect">Tipo de contrato</label>
						</div>
					</div>
				</div>

				<div class="row g-2">
					<div class="col-md">
						<div class="form-floating mb-4">
							<select class="form-control" id="MODALIDAD" name="MODALIDAD">
								<option value="">Seleccionar</option>
								<option value="Presencial">Presencial</option>
								<option value="Remoto">Remoto</option>
								<option value="Presencial/Remoto">Presencial/Remoto</option>
							</select>
							<label for="floatingSelect">Modalidad de trabajo</label>
						</div>
					</div>

					<div class="col-md">
						<div class="form-floating mb-4">
							<select class="form-control" id="TIEMPO" name="TIEMPO">
								<option value="">Seleccionar</option>
								<option value="Tiempo completo">Tiempo completo</option>
								<option value="Medio tiempo">Medio tiempo</option>
								<option value="Tiempo coordinado">Tiempo coordinado</option>
							</select>
							<label for="floatingSelect">Tiempo</label>
						</div>
					</div>
				</div>

				<div class="row g-2">
					<div class="col-md">
						<div class="form-floating mb-4">
							<div class="card-body">
								<div class="form-group with-title mb-3">
									<input type="datetime-local" name="DATE_INT" id="DATE_INT" class="form-control" placeholder="..." autocomplete="off">
									<label>DATE_INT</label>
								</div>
							</div>
						</div>
					</div>

					<div class="col-md">
						<div class="form-floating mb-4">
							<div class="card-body">
								<div class="form-group with-title mb-3">
									<input type="datetime-local" name="DATE_END" id="DATE_END" class="form-control" placeholder="..." autocomplete="off">
									<label>DATE_END </label>
								</div>
							</div>
						</div>
					</div>
				</div>

			</form>
	
		`
		foot.innerHTML = `
		<button form="addVacancy" class="alert bg-success ml-1" name="save">
			<span class="d-none d-sm-block text-white">Registrar</span>
		</button>
		`
		myModal.show();

		var modalDialog = document.querySelector(".modal-dialog");
		modalDialog.classList.add("modal-lg");

		const form = document.getElementById("addVacancy");

		const formFields = [
			document.getElementById("COMPANYID"),
			document.getElementById("AREAID"),
			document.getElementById("OCUPACIONID"),
			document.getElementById("REQ_EMPLOYEES"),
			document.getElementById("SUELDO"),
			document.getElementById("INFOJOB"),
			document.getElementById("WORKEXPERIENCE"),
			document.getElementById("JOBDESCRIPTION"),
			document.getElementById("BENEFICIOS"),
			document.getElementById("GENERO"),
			document.getElementById("TCONTRATOID"),
			document.getElementById("MODALIDAD"),
			document.getElementById("TIEMPO"),
			document.getElementById("DATE_INT"),
			document.getElementById("DATE_END"),
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
				let response = await fetch("<?php echo web_root ?>admin/vacancy/controller.php?action=add", {
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

	function editVacancy(a) {
		head.innerHTML = "Editar vacante de trabajo"
		content.innerHTML = `
        <form id="editVacancy" >
	
			<div class="form-floating mb-4">
				<select class="form-control" id="COMPANYID" name="COMPANYID">
					<option value="${a['COMPANYID']}">${a['COMPANYNAME']}</option>
					<?php
					$mydb->setQuery("SELECT * FROM tblcompany WHERE COMPANYSTATUS = 1");
					$companies = $mydb->loadResultList();
					foreach ($companies as $company) {
						echo '<option value="' . $company->COMPANYID . '">' . $company->COMPANYNAME . '</option>';
					}
					?>
				</select>
				<label for="floatingSelect"> Sede</label>
			</div>

			<div class="row g-2">
				<div class="col-md">
					<div class="form-floating mb-4">
						<select class="form-control" id="AREAID" name="AREAID" onchange="ocup(this)">
							<option value="${a['AREAID']}">${a['AREA']}</option>
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
						<option value="${a['OCUPACIONID']}">${a['OCUPACION']}</option>
						</select>
						<label for="floatingSelect"> Titulo de ocupación</label>
					</div>
				</div>
			</div>

			<div class="row g-2">
				<div class="col-md">
					<div class="form-floating mb-4">
						<input type="number" name="REQ_EMPLOYEES" id="REQ_EMPLOYEES" class="form-control" value="${a['REQ_EMPLOYEES']}">
						<label for="REQ_EMPLOYEES">Disponibilidad de vacantes</label>
					</div>
				</div>

				<div class="col-md">
					<div class="form-floating mb-4">
						<input type="text" name="SUELDO" id="SUELDO" class="form-control" value="${a['SUELDO']}">
						<label for="SUELDO"> Sueldo</label>
					</div>
				</div>
			</div>
			

			<div class="form-floating mb-4">
				<div class="card-body">
					<div class="form-group with-title mb-3">
					<textarea class="form-control" name="INFOJOB" id="INFOJOB">${a['INFOJOB']}></textarea>
						<label>Descripción de vacante</label>
					</div>
				</div>
			</div>
			
			<div class="form-floating mb-4">
				<div class="card-body">
					<div class="form-group with-title mb-3">
					<textarea class="form-control" name="WORKEXPERIENCE" id="WORKEXPERIENCE">${a['WORKEXPERIENCE']}></textarea>
						<label>Experiencia / Requisitos </label>
					</div>
				</div>
			</div>


			<div class="form-floating mb-4">
				<div class="card-body">
					<div class="form-group with-title mb-3">
						<textarea class="form-control" name="JOBDESCRIPTION" id="JOBDESCRIPTION"> ${a['JOBDESCRIPTION']}></textarea>
						<label> Descripción /Funciones de trabajo </label>
					</div>
				</div>
			</div>

			<div class="form-floating mb-4">
				<div class="card-body">
					<div class="form-group with-title mb-3">
						<textarea class="form-control" name="BENEFICIOS" id="BENEFICIOS" id="BENEFICIOS"> ${a['BENEFICIOS']}></textarea>
						<label> Beneficios  </label>
					</div>
				</div>
			</div>

			<div class="row g-2">
				<div class="col-md">
					<div class="form-floating mb-4">
						<select class="form-control" id="GENERO" name="GENERO">
							<option value="${a['GENERO']}">${a['GENERO']}</option>
							<option value="Masculino">Masculino</option>
							<option value="Femenino">Femenino</option>
							<option value="Maculino/Femenino">Maculino/Femenino</option>
							<option value="Genero no definido">Genero no definido</option>
						</select>
						<label for="floatingSelect">Genero</label>
					</div>
				</div>

				<div class="col-md">
					<div class="form-floating mb-4">
						<select class="form-control" id="TCONTRATOID" name="TCONTRATOID">
							<option value="${a['TCONTRATOID']}">${a['TIPOCONTRATO']}</option>
							<?php
							$mydb->setQuery("SELECT * FROM tbltipocontrato");
							$tcontratos = $mydb->loadResultList();

							foreach ($tcontratos as $tcontrato) {
								echo '<option value="' . $tcontrato->TCONTRATOID . '">' . $tcontrato->TIPOCONTRATO . '</option>';
							}
							?>
						</select>
						<label for="floatingSelect">Tipo de contrato</label>
					</div>
				</div>
			</div>

			<div class="row g-2">
				<div class="col-md">
					<div class="form-floating mb-4">
						<select class="form-control" id="MODALIDAD" name="MODALIDAD">
							<option value="${a['MODALIDAD']}">${a['MODALIDAD']}</option>
							<option value="Presencial">Presencial</option>
							<option value="Remoto">Remoto</option>
							<option value="Presencial/Remoto">Presencial/Remoto</option>
						</select>
						<label for="floatingSelect">Modalidad de trabajo</label>
					</div>
				</div>

				<div class="col-md">
					<div class="form-floating mb-4">
						<select class="form-control" id="TIEMPO" name="TIEMPO">
							<option value="${a['TIEMPO']}">${a['TIEMPO']}</option>
							<option value="Tiempo completo">Tiempo completo</option>
							<option value="Medio tiempo">Medio tiempo</option>
							<option value="Tiempo coordinado">Tiempo coordinado</option>
						</select>
						<label for="floatingSelect">Tiempo</label>
					</div>
				</div>
			</div>

			<div class="row g-2">
				<div class="col-md">
					<div class="form-floating mb-4">
						<div class="card-body">
							<div class="form-group with-title mb-3">
								<input type="date" name="DATE_INT" id="DATE_INT" class="form-control" value="${a['DATE_INT']}">
								<label>Fecha de publicación</label>
							</div>
						</div>
					</div>
				</div>

				<div class="col-md">
					<div class="form-floating mb-4">
						<div class="card-body">
							<div class="form-group with-title mb-3">
								<input type="date" name="DATE_END" id="DATE_END" class="form-control" value="${a['DATE_END']}">
								<label>Fecha de finalización </label>
							</div>
						</div>
					</div>
				</div>
			</div>

</form>
    `
		foot.innerHTML = `
		<button form="editVacancy" class="alert bg-success ml-1" name="save">                    
			<span class="d-none d-sm-block text-white">Actualizar</span>
        </button>
    `
		myModal.show();
		var modalDialog = document.querySelector(".modal-dialog");
		modalDialog.classList.add("modal-lg");

		document.getElementById("editVacancy").addEventListener('submit', async function(e) {
			e.preventDefault()
			let response = await fetch(`<?php echo URL_WEB . web_root ?>admin/vacancy/controller.php?action=edit&id=${a['JOBID']}`, {
				method: "POST",
				body: new FormData(e.target)
			})

			let data = await response.json();
			console.log(data);

			if (data.status == "success") {
				location.reload()
			}
		})

	}

	function updateVacancy() {
		document.getElementById("editVacancy").submit();

		Swal.fire({
			title: "Vacante actualizada",
			text: "Vacante sido actualizada con éxito",
			icon: "success",
			confirmButtonText: "Aceptar",
			timer: 5000,
			timerProgressBar: true,
		});
	}

	async function ocup(e) {
		let response = await fetch(`<?php echo web_root ?>admin/vacancy/controller.php?action=select&AREAID=${e.value}`)
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