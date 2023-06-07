<?php
if (!isset($_SESSION['ADMIN_USERID'])) {
	redirect(web_root . "admin/index.php");
}

$mydb->setQuery("SELECT * FROM  `tblemployees` e, `tblapplicants`a, `tblareas` r, `tblcompany` c, `tblocupaciones` o WHERE e.`APLICANTID` = a.`APPLICANTID` AND e.`AREAID` = r.`AREAID` AND e.`OCUPACIONID` = o.`OCUPACIONID` AND e.`COMPANYID` = c.`COMPANYID`");
$cur = $mydb->loadResultList();

$appl = $cur[0];


$mydb->setQuery("SELECT * FROM `tblevaluaciones` e, `tblapplicants` a, `tblcreaevaluaciones` c , `tbljob` j , `tbltipocontrato` r WHERE e.`APPLICANTID` = a.`APPLICANTID` AND e.`IDEVALUACIONCREA` = c.`IDEVALUACIONCREA` AND a.`JOBID` = j.`JOBID` AND j.`TCONTRATOID` = r.`TCONTRATOID` AND a.`APPLICANTID` = " . $_GET['id'] . " AND e.`OCUPACIONID` = " . $appl->OCUPACIONID . " AND e.`AREAID` = " . $appl->AREAID);
$cur2 = $mydb->loadSingleResult();

?>

<form action="controller.php?action=approve" method="POST">

	<div class="row">
		<div class="col-md-8">
			<h3 class="text-uppercase mb-3">Detalles de <?= $appl->FNAME . ' ' . $appl->LNAME . ' ' . $appl->MNAME; ?></h3>
		</div>
	</div>

	<div class="row">
		<div class="card d-none">
			<div class="card-body">
				<input type="hidden" name="vacancyREGID" value="<?php echo $vacancyreg->REGISTRATIONID; ?>">
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
						<li>Fecha de contrato: <?php echo fechaespañol($appl->DATEHIRED) ?></li>
					</ul>
					<div class="row">
						<div class="col-md-12">
							<a class="d-flex px-5 py-2 justify-content-center rounded-3 btn bg-success text-light" onclick="mostrarPDF('<?php echo $appl->CVFILE; ?>')">
								<p>VER CURRICULUM VITAE</p>
							</a>
						</div>
					</div>
				</div>
			</div>

			<div class="card shadow-sm">
				<div class="card-header">
					<!-- <p class="text-muted">Informacion del aplicante</h4> -->
					<h4 class="text-uppercase">Detalles de evaluación</h3>
				</div>
				<div class="card-body">
					<ul>
						<li>Nota: <?php echo $cur2->RESULT ?> </li>
						<li>Fecha realizada: <?php echo fechaespañol($cur2->DATE_END) ?> </li>
					</ul>
					<div class="row">
						<div class="col-md-12">
							<?php if (!empty($cur2->RESULT)) { ?>
								<a class="d-flex px-5 py-2 justify-content-center rounded-3 btn bg-success text-light" href="#" onclick="viewEva('<?php echo isset($cur2->RESPUESTA) ? $cur2->RESPUESTA : '' ?>', '<?php echo isset($cur2->TAREA) ? $cur2->TAREA : '' ?>')">
									<p>VER EVALUACIÓN</p>
								</a>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-6">
			<div class="card">
				<div class="card-header">
					<p class="text-muted">Detalles de trabajo</p>
					<h4 class="text-uppercase mb-3"><?php echo $appl->OCUPACION; ?></h4>
				</div>
				<div class="card-body">
					<ul>
						<li><i class="fp-ht-tv"></i>Sede contratante: <?php echo $appl->COMPANYNAME; ?></li>
						<li><i class="fp-ht-computer"></i>Lugar de trabajo : <?php echo $appl->COMPANYADDRESS; ?></li>
						<li><i class="fp-ht-food"></i>Sueldo : S/. <?php echo number_format($cur2->SUELDO, 2);  ?> (Mensual)</li>

					</ul>
					<ul>
						<li><i class="fp-ht-tv"></i>Modalidad: <?php echo $cur2->MODALIDAD; ?></li>
						<li><i class="fp-ht-tv"></i>Tipo de contrato: <?php echo $cur2->TIPOCONTRATO; ?></li>
					</ul>

					<div class="col-md-12">
						<a class="d-flex px-5 py-2 justify-content-center rounded-3 btn bg-success text-light" onclick="mostrarContrato('<?php echo $cur2->TCONTRATOID; ?>')">
							<p>VER CONTRATO</p>
						</a>
					</div>

				</div>
			</div>
		</div>
</form>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery-Knob/1.2.13/jquery.knob.min.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery-Knob/1.2.13/jquery.knob.min.js"></script>
<script src="../assets/extensions/jsPDF-master/dist/jspdf.umd.min.js"></script>
<script>
	const myModal = new bootstrap.Modal(document.getElementById('modal'));
	const content = document.getElementById("content");
	const head = document.getElementById("headTitle");
	const Mhead = document.getElementById("MHead");
	const foot = document.getElementById("footer");
	let quill; // Declarar quill como variable global

	function mostrarContrato(e) {
		head.innerHTML = "";
		content.innerHTML = `
            <div class="container-fluid mb-3">
                <div id="editor"></div>
            </div>
            `;
		foot.innerHTML = `
		<button class="btn btn-success text-light ml-1" onclick="guardarContrato()">Guardar</button>
	<button class="btn btn-primary text-light ml-1" onclick="descargarContrato()">Descargar PDF</button>

            `;

		var modalDialog = myModal._element.querySelector('.modal-dialog');
		modalDialog.classList.add('modal-xl');

		myModal.show();

		// Inicializar Quill
		quill = new Quill('#editor', {
			theme: 'snow' // Puedes personalizar el tema según tus necesidades
		});

		// Establecer el contenido del contrato en el editor Quill
		quill.root.innerHTML = "<?php echo $cur2->CONTENIDO; ?>";
	}

	function guardarContrato() {
		var contenidoModificado = quill.root.innerHTML;

		// Enviar contenidoModificado al servidor para almacenarlo en la base de datos

		// Ejemplo de cómo enviar los datos mediante una solicitud AJAX
		var xhr = new XMLHttpRequest();
		xhr.open('POST', 'guardar_contrato.php', true);
		xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		xhr.onreadystatechange = function() {
			if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
				// Manejar la respuesta del servidor, si es necesario
				console.log(xhr.responseText);
			}
		};
		xhr.send('contrato=' + encodeURIComponent(contenidoModificado));

		// Cerrar el modal después de guardar el contrato
		myModal.hide();
	}

	function descargarContrato() {
		var contenidoModificado = quill.root.innerHTML;

		var doc = new jsPDF();

		doc.fromHTML(contenidoModificado, 15, 15, {
			width: 170
		});

		doc.save('contrato.pdf');
	}



	function viewEva(ata, tarea) {

		// console.log(ata);
		head.innerHTML = "Detalle de evaluación";

		content.innerHTML = `
		<div class="container-fluid mb-3">
			${tarea}
		</div>
		<div class="card bg-dark text-bg-dark" style="margin-bottom: 0px !important">
			<div class="card-body text-letf"
				${ata}
			</div>
		</div>
		`
		foot.innerHTML = ''

		var modalDialog = myModal._element.querySelector('.modal-dialog');
		modalDialog.classList.add('modal-xl');


		myModal.show()
	}

	function mostrarPDF(nombre_archivo) {
		// Cargar el archivo PDF utilizando PDF.js
		pdfjsLib.getDocument('../applicants/cv/' + nombre_archivo).promise.then(function(pdf) {
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
				head.innerHTML = "";
				content.innerHTML = '';
				content.appendChild(canvas);

				foot.innerHTML = ''
				myModal.show();
			});
		});
	}
</script>