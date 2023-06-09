<?php
if (!isset($_SESSION['ADMIN_USERID'])) {
	redirect(web_root . "admin/index.php");
}

date_default_timezone_set('America/Lima');


$mydb->setQuery("SELECT * FROM `tblapplicants` a, `tblcompany` c, `tbljob` j, `tblocupaciones` o, `tbltipocontrato` t WHERE a.`COMPANYID` = c.`COMPANYID`  AND a.`JOBID` = j.`JOBID` AND j.`OCUPACIONID` = o.`OCUPACIONID` AND j.`TCONTRATOID` = t.`TCONTRATOID` AND a.`APPLICANTID`=" . $_GET['id']);
$cur = $mydb->loadResultList();


$appl = $cur[0];
// print_r($appl); return;


$mydb->setQuery("SELECT * FROM `tblevaluaciones` e, `tblapplicants` a, `tblcreaevaluaciones` c WHERE e.`APPLICANTID` = a.`APPLICANTID` AND e.`IDEVALUACIONCREA` = c.`IDEVALUACIONCREA` AND a.`APPLICANTID` = " . $_GET['id'] . " AND e.`OCUPACIONID` = " . $appl->OCUPACIONID . " AND e.`AREAID` = " . $appl->AREAID);
$cur2 = $mydb->loadSingleResult();

// print_r($cur2); exit;

$fechaHoraActual = date('Y-m-d H:i:s'); // Obtener la fecha y hora actual


?>

<style>
	.knob-container {
		position: relative;
		display: inline-block;
		width: 150px;
		height: 150px;
	}

	.knob {
		position: absolute;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
		opacity: 0;
	}

	.knob-value {
		position: absolute;
		top: 50%;
		left: 50%;
		transform: translate(-50%, -50%);
		font-size: 36px;
		font-weight: bold;
		color: #333;
		text-shadow: 1px 1px 0 rgba(255, 255, 255, 0.5);
	}
</style>

<div class="row">
	<div class="row">
		<div class="col-md-8">
			<h3 class="text-uppercase mb-3">Seguimiento de <?= $appl->FNAME . ' ' . $appl->LNAME . ' ' . $appl->MNAME; ?></h3>
		</div>
	</div>
	<div class="card d-none">
		<div class="card-body">
			<input type="hidden" name="vacancyREGID" value="<?php // echo $vacancyreg->REGISTRATIONID; 
															?>">
			<input type="hidden" name="APPLICANTID" value="<?php echo $appl->APPLICANTID; ?>">
		</div>
	</div>

	<div class="col-md-6">
		<div class="card shadow-sm">
			<div class="card-header">
				<p class="text-muted">Informacion del aplicante</h4>
				<h4 class="text-uppercase"><?php echo $appl->FNAME . ' ' . $appl->LNAME . ' ' . $appl->MNAME; ?></h3>
			</div>
			<div class="card-body">
				<ul>
					<li>DNI: <?php echo $appl->DNI; ?></li>
					<li>Correo electronico: <?php echo $appl->EMAILADDRESS; ?></li>
					<li>Telefono: <?php echo $appl->CONTACTNO; ?></li>
				</ul>
				<div class="row">
					<div class="col-md-6 mb-3">
						<div class="d-flex gap-4 justify-content-center bg-body px-5 py-2 rounded-3">
							<p class="text-muted">Puntos</p>
							<div class=""><?php echo $appl->POINTS; ?></div>
						</div>
					</div>
					<div class="col-md-6">
						<a class="d-flex px-5 py-2 justify-content-center rounded-3 btn btn-grad" onclick="mostrarPDF('<?php echo $appl->CVFILE; ?>')">
							<p>Visualizar</p>
						</a>
					</div>
				</div>
			</div>
		</div>
		<?php if (!empty($cur2)) { ?>
			<div class="card shadow-sm">
				<div class="card-header">
					<div class="d-flex align-items-center justify-content-between">
						<h4 class="card-title">Desarrolo de evaluación</h4>
						<?php if ($cur2->MSG == 0) { ?>
							<div onclick="evalua()" class="btn btn-primary d-flex flex-column justify-content-center align-items-center">
								<ion-icon style="height: 25px;width: 25px;" name="send-outline"></ion-icon>
								<p style="font-size: 10px;">Enviar</p>
							</div>
							<?php } else if (!empty($cur2->RESULT)) {
							if ($cur2->RESULT >= 16) { ?>
								<div onclick="messagesend()" class="btn btn-success d-flex flex-column justify-content-center align-items-center">
									<ion-icon style="height: 25px;width: 25px;" name="send-outline"></ion-icon>
									<p style="font-size: 10px;">Enviar</p>
								</div>
						<?php }
						} ?>
					</div>
				</div>
				<?php
				if (!empty($cur2->DATE_END) and $fechaHoraActual > $cur2->DATE_END) { ?>
					<div class="card-body">
						<div class="d-flex justify-content-center align-items-center">
							<ion-icon style="width: 10rem; height: 10rem;" class="text-success" name="checkmark-circle-outline"></ion-icon>
						</div>
					</div>
					<div class="card-footer text-center">
						<h4 class="text-uppercase">Finalizado</h4>
						<?php if (empty($cur2->RESULT)) { ?>
							<a href="#" onclick="viewEva('<?php echo isset($cur2->RESPUESTA) ? $cur2->RESPUESTA : '' ?>', '<?php echo isset($cur2->TAREA) ? $cur2->TAREA : '' ?>')">Ver evaluacion</a>
						<?php } ?>
					</div>
				<?php } else if (!empty($cur2->DATE_END) and $fechaHoraActual < $cur2->DATE_END) { ?>
					<div class="card-body">
						<div class="d-flex justify-content-center align-items-center">
							<div class="spinner-border" style="width: 10rem; height: 10rem;" role="status">
								<span class="visually-hidden">Cargando...</span>
							</div>
						</div>
					</div>
					<div class="card-footer text-center">
						<h4 class="text-uppercase">En Proceso</h4>
					</div>
				<?php } else { ?>
					<div class="card-body">
						<div class="d-flex justify-content-center align-items-center">
							<ion-icon style="width: 10rem; height: 10rem;" class="text-warning" name="time-outline"></ion-icon>
						</div>
					</div>
					<div class="card-footer text-center">
						<h4 class="text-uppercase">Pendiente</h4>
					</div>
				<?php } ?>
			</div>
		<?php } ?>

	</div>

	<div class="col-md-6">
		<div class="card shadow-sm">
			<div class="card-header">
				<p class="text-muted">Detalles de trabajo</p>
				<h4 class="text-uppercase mb-3"><?php echo $appl->OCUPACION; ?></h4>
			</div>
			<div class="card-body">
				<ul>
					<li><i class="fp-ht-tv"></i>Sede contratante: <?php echo $appl->COMPANYNAME; ?></li>
					<li><i class="fp-ht-computer"></i>Lugar de trabajo : <?php echo $appl->COMPANYADDRESS; ?></li>
					<li><i class="fp-ht-food"></i>Sueldo : S/. <?php echo number_format($appl->SUELDO, 2);  ?> (Mensual)</li>

				</ul>
				<ul>
					<li><i class="fp-ht-tv"></i>Tipo de contrato: <?php echo $appl->TIPOCONTRATO; ?></li>
					<li><i class="fp-ht-tv"></i>Modalidad: <?php echo $appl->MODALIDAD; ?></li>
				</ul>
			</div>
		</div>

		<?php
		$mydb->setQuery("SELECT * FROM tblkeywords WHERE OCUPACIONID = " . $appl->OCUPACIONID);
		$keyword = $mydb->loadResultList();
		?>

		<div class="card shadow-sm">

			<div class="card-header">
				<h4>Porcentaje de coincidencias</h4>
			</div>
			<div class="card-body d-flex justify-content-center">
				<div class="demo" style="position: relative;display: flex;justify-content: center;align-items: center;">
					<input readonly class="knob" data-angleOffset=-90 data-angleArc=180 data-fgColor="#2cc14e" data-rotation="clockwise" value="<?php echo $appl->POINTS; ?>">
					<div class="value text-center" id="value" style="position: absolute;top: 60px;font-size: 30px; font-weight: bold;"></div>
				</div>
			</div>

			<div class="card-header">
				<h4>Keywords</h4>
			</div>
			<div class="card-body">
				<div class="tags">
					<?php if (empty($keyword)) { ?>
						<span>No hay keywords relacionados</span>
					<?php } else { ?>
						<?php foreach ($keyword as $row) { ?>
							<span class="badge bg-primary"><?php echo $row->keyword; ?></span>
						<?php } ?>
					<?php } ?>
				</div>
			</div>

		</div>
	</div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery-Knob/1.2.13/jquery.knob.min.js"></script>
<script>
	const myModal = new bootstrap.Modal(document.getElementById('modal'))
	const content = document.getElementById("content")
	const head = document.getElementById("headTitle")
	const Mhead = document.getElementById("MHead")
	const foot = document.getElementById("footer")

	// Obtener el switch
	let toggleSwitch = document.querySelector("#toggle-dark");

	// Agregar un evento "change" al switch
	toggleSwitch.addEventListener("change", function() {
		// Obtener el body
		body.classList.toggle("abc");
		let body = document.querySelector("body");

		// Verificar si el body tiene la clase "theme-dark"
		let isDark = body.classList.contains("abc");

		$(".knob").trigger("configure", {
			bgColor: isDark ? "#151521" : "#F0F0F0",
		});
	});

	$(".knob").knob({
		min: 0,
		max: 100,
		step: 1,
		fgColor: "#FFCC00",
		bgColor: "#151521",
		lineCap: "round",
		height: 140,
		draw: function() {
			let v = parseInt(this.i[0].value);
			document.getElementById('value').innerHTML = v
			if (v <= 10) this.o.fgColor = "#F44336";
			else if (v <= 20) this.o.fgColor = "#FF5252";
			else if (v <= 30) this.o.fgColor = "#E64A19";
			else if (v <= 40) this.o.fgColor = "#FF9800";
			else if (v <= 50) this.o.fgColor = "#FFB74D";
			else if (v <= 60) this.o.fgColor = "#FBC02D";
			else if (v <= 70) this.o.fgColor = "#FFEB3B";
			else if (v <= 80) this.o.fgColor = "#FFF176";
			else if (v <= 90) this.o.fgColor = "#C5E1A5";
			else this.o.fgColor = "#4CAF50";
		},
	});

	<?php if (isset($cur2->RESPUESTA)) { ?>

		function viewEva(ata, tarea) {

			// console.log(ata);
			head.innerHTML = "Detalles de la evaluacion";

			content.innerHTML = `
			<div class="d-flex justify-content-between">
			<h2>TAREA</h2>
			<div class="d-flex align-items-center justify-content-end">
				<a style="cursor:pointer;" class="d-flex p-2 rounded-start bg-body" onclick="tmre(1, 'RESULT')">
					<ion-icon name="remove-outline"></ion-icon>
				</a>
				<input type="number" value="0" id="RESULT" class="form-control w-25 text-end" readonly>
				<a style="cursor:pointer;" class="d-flex p-2 bg-body rounded-end" onclick="tmre(0, 'RESULT')">
					<ion-icon name="add-outline"></ion-icon>
				</a>
			</div>
			</div>
			<div class="container-fluid mb-3">
				${tarea}
			</div>
			<div class="card bg-dark text-bg-dark" style="margin-bottom: 0px !important">
				<div class="card-body text-center"
					${ata}
				</div>
			</div>
		`
			foot.innerHTML = `
			<button class="btn btn-primary" id="calc">Calificar</button>
		`;



			document.getElementById("calc").addEventListener('click', async () => {
				let formData = new FormData();
				formData.append("RESULT", document.getElementById("RESULT").value);
				formData.append("ID", <?php echo $cur2->EVALUACIONID ?>);

				let response = await fetch('<?php echo URL_WEB . web_root ?>admin/applicants/controller.php?action=cal', {
					method: "POST",
					body: formData
				});

				if (response.ok) {
					let data = await response.text();
					console.log("Respuesta exitosa:", data);
					location.reload()
				} else {
					console.log("Error en la respuesta:", response.status);
				}
			});



			myModal.show()

		}

		function tmre(a, b) {
			let RESULT = document.getElementById(b);
			let value = parseInt(RESULT.value); // Convertir a número

			if (a == 0) {
				if (value < 5) {
					RESULT.value = value + 1; // Realizar suma numérica si es menor a 5
				}
			} else {
				if (value > 0) {
					RESULT.value = value - 1; // Realizar resta numérica si es mayor a 0
				}
			}
		}
	<?php } ?>
	var modalDialog = document.querySelector('.modal-dialog');

	function verMensaje() {
		// Cerrar el modal
		myModal.hide();
		setTimeout(function() {

			Mhead.innerHTML = "Otorgar evaluación";

			content.innerHTML = `
				<form id="addEvaluacion">
				<input type="hidden" name="APPLICANTID" value="<?php echo $appl->APPLICANTID; ?>">

				<input type="hidden" name="OCUPACIONID" value="<?php echo $appl->OCUPACIONID ?>">
				<input type="hidden" name="AREAID" value="<?php echo $appl->AREAID ?>">

				<div class="form-floating mb-4">
					<select class="form-control" id="IDEVALUACIONCREA" name="IDEVALUACIONCREA">
					<?php
					// echo ("SELECT * FROM tblcreaevaluaciones WHERE ESTADO = " . 1 . " AND OCUPACIONID = " . $appl->OCUPACIONID);
					// die();
					$mydb->setQuery("SELECT * FROM tblcreaevaluaciones WHERE ESTADO = " . 1 . " AND OCUPACIONID = " . $appl->OCUPACIONID);
					$evaluaciones = $mydb->loadResultList();

					if (count($evaluaciones) == 0) {
						echo '<option value="">No hay evaluaciones relacionadas</option>';
					} else {
						echo '<option value="">Seleccionar evaluacion</option>';
						foreach ($evaluaciones as $evaluacion) {
							echo '<option value="' . $evaluacion->IDEVALUACIONCREA . '">' . $evaluacion->TITULO . '</option>';
						}
					}

					?>
					</select>
					<label for="floatingSelect">Evaluación</label>
				</div>    
				<div class="row">
					<div class="col-md-6">
					<div class="form-floating mb-4">
						<input type="date" name="DATE_START" id="DATE_IN" min="3" class="form-control" placeholder="..." autocomplete="off">
						<label for="DATE_IN"><i class="bi bi-person-lines-fill"></i>Fecha de inicio</label>
					</div>
					</div>
					<div class="col-md-6">
					<div class="form-floating mb-4">
						<input type="date" name="DATE_OUT" id="DATE_END" min="3" class="form-control" placeholder="..." autocomplete="off">
						<label for="DATE_END"><i class="bi bi-person-lines-fill"></i>Fecha final</label>
					</div>
					</div>	
				</div>
				</form>
			`;
			foot.innerHTML = `
				<button form="addEvaluacion" class="alert bg-success ml-1">
				<span class="d-none d-sm-block text-white">Registrar</span>
				</button>
			`;

			modalDialog.classList.remove('modal-xl');
			myModal.show();

			evalua('addEvaluacion')

		}, 400)
	}

	function evalua(id) {

		<?php if (empty($cur2)) { ?>
			document.getElementById(id).addEventListener('submit', async function(e) {

				e.preventDefault();
				let evaluacion = document.getElementById('IDEVALUACIONCREA').value;
				let dateStart = document.getElementById('DATE_IN').value;
				let dateEnd = document.getElementById('DATE_END').value;

				if (evaluacion === '' || dateStart === '' || dateEnd === '') {
					// Marcar los campos vacíos en rojo
					if (evaluacion === '') {
						document.getElementById('IDEVALUACIONCREA').classList.add('is-invalid');
					} else {
						document.getElementById('IDEVALUACIONCREA').classList.remove('is-invalid');
					}

					if (dateStart === '') {
						document.getElementById('DATE_IN').classList.add('is-invalid');
					} else {
						document.getElementById('DATE_IN').classList.remove('is-invalid');
					}

					if (dateEnd === '') {
						document.getElementById('DATE_END').classList.add('is-invalid');
					} else {
						document.getElementById('DATE_END').classList.remove('is-invalid');
					}

					// Mostrar alerta de SweetAlert indicando que los campos son obligatorios
					Swal.fire({
						icon: 'warning',
						title: 'Error de evaluación',
						text: 'Es necesario completar todos los campos',
					});
					return;
				}

				let response = await fetch('<?php echo URL_WEB . web_root ?>admin/evaluaciones/controller.php?action=newtoken', {
					method: 'POST',
					body: new FormData(e.target)
				});

				let data = await response.json();

				if (data.status === "success") {

					myModal.hide();

					// Restablecer la validación de los campos
					document.getElementById('IDEVALUACIONCREA').classList.remove('is-invalid');
					document.getElementById('DATE_IN').classList.remove('is-invalid');
					document.getElementById('DATE_END').classList.remove('is-invalid');

					setTimeout(function() {

						// Aquí se incluye el código necesario para la acción programada
						Mhead.innerHTML = "REDACTAR CORREO ELECTRONICO";

						content.innerHTML = `
							<form id="verMensaje">
								<input type="hidden" name="EVALUACIONID" value="${data.id}">

								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<span class="input-group-text">PARA</span>
									</div>
									<input readonly type="text" id="para" name="EMAIL" value="<?php echo $appl->EMAILADDRESS; ?>" class="form-control">
									</div>

								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<span class="input-group-text">ASUNTO</span>
									</div>
									<input type="text" id="asunto" name="ASUNTO" class="form-control" value="PROCESO DE EVALUACION GANDULES" placeholder="Asunto">
									</div>
								</div>
								<div class="form-group">
									<div class="google-compose-body-container">
										<div class="google-compose-body" id="editor"></div>
									</div>
								</div>

							</form>
						`;
						foot.innerHTML = `
							<div class="d-flex justify-content-between align-items-center">
								<div>
									<button type="button" class="btn btn-outline-secondary me-2" data-bs-dismiss="modal">Descartar</button>
									<button form="verMensaje" id="load" class="btn btn-primary">Enviar</button>
								</div>
							</div>
						`;

						// Inicializar el editor Quill en el div correspondiente
						var options = {
							modules: {
								toolbar: [
									[{
										'header': [1, 2, 3, false]
									}],
									['bold', 'italic', 'underline'],
									['link'],
									[{
										'list': 'bullet'
									}],
									[{
										'color': []
									}, {
										'background': []
									}],
								]
							},
							placeholder: 'Escribe aquí tu mensaje...',
							theme: 'snow'
						};
						var editor = new Quill('#editor', options);
						var text = `
							<div class="form-floating mb-3">
								Estimado/a <p class="text-uppercase mb-3"> <?= $appl->FNAME . ' ' . $appl->LNAME . ' ' . $appl->MNAME; ?></p>
								Nos complace informarle que su solicitud de trabajo para el puesto de <a><?php echo $appl->OCUPACION; ?></b></a>
								ha sido recibida y revisada por nuestro equipo de reclutamiento.</p>
								<p>Le comunicamos que su Curriculum cumple con la gran mayoría de requisitos establecidos para el puesto y estamos interesados en continuar con el proceso de selección.
								Para avanzar al siguiente paso del proceso, solicitamos que confirme su interés ingresando al siguiente enlace</p>
								<a target="_blank" href="<?php echo URL_WEB . web_root ?>evaluaciones/?TOKEN=${data.message}">Dar evaluación</a>
								<br>
								<p>Si confirma su interés en el puesto, le brindaremos un nombre de usuario y token para que pueda realizar su evaluación de desempeño.</p>
								<p>Si tiene alguna pregunta o inquietud, no dude en ponerse en contacto con nosotros.
								Agradecemos su interés en nuestra empresa y esperamos tener la oportunidad de conocerlo/a en persona.</p>
								<br>
								<p>Att. <?php echo $appl->COMPANYNAME; ?></p>
							</div>
						`;
						editor.clipboard.dangerouslyPasteHTML(text);

						modalDialog.classList.remove('modal-lg');

						// Mover las opciones del editor Quill a la parte inferior
						var quillOptions = document.querySelector('.ql-toolbar');
						var quillContainer = document.querySelector('.ql-container');
						quillContainer.appendChild(quillOptions);

						myModal.show();

						var contenidoMSG = editor.root.innerHTML;

						message('verMensaje', contenidoMSG)

					}, 400)
				}
			})
		<?php } else { ?>
			// Aquí se incluye el código necesario para la acción programada
			Mhead.innerHTML = "REDACTAR CORREO ELECTRONICO";

			content.innerHTML = `
				<form id="verMensaje">
					<input type="hidden" name="EVALUACIONID" value="<?php echo $cur2->EVALUACIONID ?>">

					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text">PARA</span>
						</div>
						<input readonly type="text" id="para" name="EMAIL" value="<?php echo $appl->EMAILADDRESS; ?>" class="form-control">
						</div>

					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text">ASUNTO</span>
						</div>
						<input type="text" id="asunto" name="ASUNTO" class="form-control" value="PROCESO DE EVALUACION GANDULES" placeholder="Asunto">
						</div>
					</div>
					<div class="form-group">
						<div class="google-compose-body-container">
							<div class="google-compose-body" id="editor"></div>
						</div>
					</div>
				</form>
			`;
			foot.innerHTML = `
				<div class="d-flex justify-content-between align-items-center">
					<div>
						<button type="button" class="btn btn-outline-secondary me-2" data-bs-dismiss="modal">Descartar</button>
						<button form="verMensaje" id="load" class="btn btn-primary">Enviar</button>
					</div>
				</div>
			`;

			// Inicializar el editor Quill en el div correspondiente
			var options = {
				modules: {
					toolbar: [
						[{
							'header': [1, 2, 3, false]
						}],
						['bold', 'italic', 'underline'],
						['link'],
						[{
							'list': 'bullet'
						}],
						[{
							'color': []
						}, {
							'background': []
						}],
					]
				},
				placeholder: 'Escribe aquí tu mensaje...',
				theme: 'snow'
			};
			var editor = new Quill('#editor', options);
			var text = `
				<div class="form-floating mb-3">
					Estimado/a <p class="text-uppercase mb-3"> <?= $appl->FNAME . ' ' . $appl->LNAME . ' ' . $appl->MNAME; ?></p>
					Nos complace informarle que su solicitud de trabajo para el puesto de <a><?php echo $appl->OCUPACION; ?></b></a>
					ha sido recibida y revisada por nuestro equipo de reclutamiento.</p>
					<p>Le comunicamos que su Curriculum cumple con la gran mayoría de requisitos establecidos para el puesto y estamos interesados en continuar con el proceso de selección.
					Para avanzar al siguiente paso del proceso, solicitamos que confirme su interés ingresando al siguiente enlace</p>
					<a target="_blank" href="<?php echo URL_WEB . web_root ?>evaluaciones/?TOKEN=<?php echo $cur2->TOKEN ?>">Dar evaluación</a>
					<br>
					<p>Si confirma su interés en el puesto, le brindaremos un nombre de usuario y token para que pueda realizar su evaluación de desempeño.</p>
					<p>Si tiene alguna pregunta o inquietud, no dude en ponerse en contacto con nosotros.
					Agradecemos su interés en nuestra empresa y esperamos tener la oportunidad de conocerlo/a en persona.</p>
					<br>
					<p>Att. <?php echo $appl->COMPANYNAME; ?></p>
				</div>
			`;
			editor.clipboard.dangerouslyPasteHTML(text);

			modalDialog.classList.remove('modal-lg');

			// Mover las opciones del editor Quill a la parte inferior
			var quillOptions = document.querySelector('.ql-toolbar');
			var quillContainer = document.querySelector('.ql-container');
			quillContainer.appendChild(quillOptions);

			myModal.show();

			var contenidoMSG = editor.root.innerHTML;

			message('verMensaje', contenidoMSG)
		<?php } ?>

	}
	<?php if (isset($cur2->RESPUESTA)) { ?>

		function messagesend() {
			Mhead.innerHTML = "REDACTAR CORREO ELECTRONICO";
			content.innerHTML = `
				<form id="verMensaje">
					<input type="hidden" name="type" value="new">
					<input type="hidden" name="APLICANTID" value="<?php echo $cur2->APPLICANTID ?>">
					<input type="hidden" name="AREAID" value="<?php echo $cur2->AREAID ?>">
					<input type="hidden" name="OCUPACIONID" value="<?php echo $cur2->OCUPACIONID ?>">
					<input type="hidden" name="COMPANYID" value="<?php echo $cur2->COMPANYID ?>">

					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text">PARA</span>
						</div>
						<input readonly type="text" id="para" name="EMAIL" value="<?php echo $appl->EMAILADDRESS; ?>" class="form-control">
						</div>

					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text">ASUNTO</span>
						</div>
						<input type="text" id="asunto" name="ASUNTO" class="form-control" value="Felicitaciones por aprobar exitosamente tu evaluación." placeholder="Asunto">
						</div>
					</div>
					<div class="form-group">
						<div class="google-compose-body-container">
							<div class="google-compose-body" id="mail"></div>
						</div>
					</div>
				</form>
			`;
			foot.innerHTML = `
				<div class="d-flex justify-content-between align-items-center">
					<div>
						<button type="button" class="btn btn-outline-secondary me-2" data-bs-dismiss="modal">Descartar</button>
						<button form="verMensaje" id="load" class="btn btn-primary">Enviar</button>
					</div>
				</div>
			`;

			var options = {
				modules: {
					toolbar: [
						[{
							'header': [1, 2, 3, false]
						}],
						['bold', 'italic', 'underline'],
						['link'],
						[{
							'list': 'bullet'
						}],
						[{
							'color': []
						}, {
							'background': []
						}],
					]
				},
				placeholder: 'Escribe aquí tu mensaje...',
				theme: 'snow'
			};
			var editor = new Quill('#mail', options);
			var text = `
				<div class="form-floating mb-3">
					<p>Estimado/a <?php echo $appl->FNAME . ' ' . $appl->LNAME . ' ' . $appl->MNAME; ?>,</p>
					<p>Me complace informarte que has superado con éxito el examen que realizaste como parte del proceso de selección para el puesto de <a><?php echo $appl->OCUPACION; ?></a> en nuestra empresa. </p>
					<p>¡Felicitaciones! Tus resultados demuestran un alto nivel de conocimiento y habilidades en el área, lo cual nos ha impresionado positivamente.</p>
					<p>Queremos destacar que tu desempeño fue excelente y cumples con los requisitos necesarios para seguir avanzando en el proceso de selección.</p>
					<p>En este sentido, nos gustaría invitarte a una entrevista personal en nuestras instalaciones, donde tendrás la oportunidad de conocer más sobre nuestra empresa, equipo de trabajo y los detalles específicos del puesto al que estás aplicando.</p>
					<p>Te proponemos las siguientes fechas y horarios disponibles para tu presentación:</p>
					<p>Fecha: [Fecha de la presentación] </p>
					<p>Hora: [Hora de la presentación] </p>
					<p>Lugar: [Dirección de nuestra empresa] </p>
					<p>Si tienes alguna pregunta o necesitas más información, no dudes en contactarnos. </p>
					<p><strong>¡Nos vemos pronto y te esperamos!</strong></p>
				</div>
			`;

			editor.clipboard.dangerouslyPasteHTML(text);
			// Mover las opciones del editor Quill a la parte inferior
			var quillOptions = document.querySelector('.ql-toolbar');
			var quillContainer = document.querySelector('.ql-container');
			quillContainer.appendChild(quillOptions);

			myModal.show();

			var contenidoMSG = editor.root.innerHTML;

			message('verMensaje', contenidoMSG)
		}
	<?php } ?>

	function message(id, contenidoMSG) {

		document.getElementById(id).addEventListener('submit', async function(e) {
			e.preventDefault();

			// Obtener el contenido del editor Quill y convertirlo a formato JSON

			// Crear un objeto FormData y agregar el contenido a él
			var formData = new FormData(e.target);
			formData.append('MESSAGE', contenidoMSG);

			let load = document.getElementById('load');
			load.disabled = true;
			load.innerHTML = `
			<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
			Procesando...
			`;

			try {
				let response = await fetch('<?php echo URL_WEB . web_root ?>admin/evaluaciones/controller.php?action=evalua', {
					method: 'POST',
					body: formData
				});

				let data = await response.json();

				if (data.status === "success") {
					load.disabled = true;
					load.innerHTML = `
										Enviado
									`;
					Swal.fire({
						icon: 'success',
						title: 'Correo enviado',
						text: 'El correo electrónico ha sido enviado con éxito',
					}).then((result) => {
						if (result.isConfirmed) {
							location.reload();
						}
					});
				} else {
					load.disabled = false;
					load.innerHTML = `
										Enviar
									`;
					Swal.fire({
						icon: 'error',
						title: 'Error al enviar el correo',
						text: 'Ha ocurrido un error al enviar el correo electrónico. Por favor, inténtelo de nuevo.',
					});
				}
			} catch (error) {
				load.disabled = false;
				load.innerHTML = `
									Enviar
								`;
				Swal.fire({
					icon: 'error',
					title: 'Error al enviar la solicitud',
					text: 'Ha ocurrido un error al enviar la solicitud. Por favor, inténtelo de nuevo.',
				});
			}
		})

	}

	function mostrarPDF(nombre_archivo) {
		// Cargar el archivo PDF utilizando PDF.js
		pdfjsLib.getDocument('cv/' + nombre_archivo).promise.then(function(pdf) {
			// Obtener el objeto canvas donde se mostrará el PDF
			var canvas = document.createElement('canvas');
			var context = canvas.getContext('2d');

			var modalDialog = myModal._element.querySelector('.modal-dialog');
			modalDialog.classList.add('modal-xl');

			// Obtener la primera página del PDF
			pdf.getPage(1).then(function(page) {
				// Establecer las dimensiones del canvas para que coincidan con la página
				var viewport = page.getViewport({
					scale: 1.8
				});
				canvas.width = viewport.width;
				canvas.height = viewport.height;

				// Renderizar la página en el objeto canvas
				var renderContext = {
					canvasContext: context,
					viewport: viewport
				};
				page.render(renderContext);

				var currentScale = 1;

				canvas.style.transform = 'scale(' + currentScale + ')';

				// Agregar el contenedor de botones al encabezado del modal
				Mhead.innerHTML = `
					<div class="d-flex gap-3">
					<?php if (empty($cur2)) { ?>
						<a href="#" class="d-flex gap-3 align-items-center btn btn-grad" onclick="verMensaje(event);"><ion-icon name="checkmark-outline"></ion-icon>Aprobar</a>
					<?php } ?>
					</div>`

				// Mostrar el PDF dentro del modal
				content.innerHTML = '';
				content.appendChild(canvas);

				foot.innerHTML = '';

				myModal.show();
			});
		});
	}
</script>