<?php
require_once("../../include/initialize.php");

if (!isset($_SESSION['ADMIN_USERID'])) {
	redirect(web_root . "admin/index.php");
}

$mydb->setQuery("SELECT * FROM  `tblocupaciones`");
$search = $mydb->loadResultList(); ?>

<div class="row d-flex align-items-center">
	<div class="col-md-6">
		<div class="d-flex  align-items-center w-100">
			<h1 class="page-header">Palabras claves</h1>
			<a href="#" onclick="addKeyword()"><i class="bi bi-plus-lg"></i></a>
		</div>
	</div>
	<div class="col-md-6">
		<div class="row">
			<div class="col-md-6">
				<div class="form-floating shadow mb-3">
					<select class="form-select" id="floatingSelect" onchange="valuechange(this)" aria-label="Floating label select example">
						<option selected value="">Todos</option>
						<?php foreach ($search as $key) { ?>
							<option value="<?php echo $key->OCUPACION ?>"><?php echo $key->OCUPACION ?></option>


						<?php } ?>
					</select>
					<label for="floatingSelect"> <i class="bi bi-search"></i> Filtrar por ocupación</label>
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

<?php
$mydb->setQuery("SELECT * FROM `tblkeywords` o, `tblocupaciones` a WHERE o.`OCUPACIONID` = a.`OCUPACIONID` AND a.`OCUPACIONSTATUS` = 1");
$cur = $mydb->loadResultList();
?>

<div class="col-lg-12">
	<div class="card shadow">
		<div class="card-body">
			<table id="myTable" class="table table-striped table-bordered">
				<thead>

					<tr>
						<th>Ocupación</th>
						<th>keyword</th>
					</tr>
				</thead>

				<tbody>
					<?php
					foreach ($cur as $result) { ?>
						<tr>
							<td><?= $result->OCUPACION ?></td>
							<td><?= $result->keyword ?></td>
						</tr>
					<?php } ?>
				</tbody>

			</table>
		</div>
	</div>
</div>

<!-- <div class="col-lg-12 mt-5">

	<div class="container">
		<div class="row">
			<?php
			$sql = "SELECT * FROM `tblkeywords`";
			$mydb->setQuery("SELECT * FROM `tblkeywords` o, `tblocupaciones` a WHERE o.`OCUPACIONID` = a.`OCUPACIONID` AND a.`OCUPACIONSTATUS` = 1");
			$key = $mydb->loadResultList();

			// Creamos un array para almacenar las ocupaciones y sus keywords
			$ocupaciones = array();

			foreach ($key as $keywords) {
				$ocupacion = $keywords->OCUPACION;

				// Verificamos si la ocupación ya existe en el array
				if (!isset($ocupaciones[$ocupacion])) {
					// Si no existe, creamos un nuevo array para almacenar los keywords
					$ocupaciones[$ocupacion] = array();
				}

				// Agregamos el keyword al array correspondiente a la ocupación
				$ocupaciones[$ocupacion][] = $keywords->keyword;
			}
			?>
			<?php foreach ($ocupaciones as $ocupacion => $keywords) { ?>

				<div class="col-lg-3 col-md-6 col-12">
					<div class="card shadow-sm">
						<div class="card-header">
							<div class="d-flex align-items-center w-100">
								<h6 class="text-uppercase"><?php echo $ocupacion; ?></h6>
								<a href="#" onclick="addKeyword()"><i class="bi bi-plus-lg"></i></a>
								<a title="Edit" href="#" onclick='editKeyword(<?= json_encode($result) ?>)' style="margin-left: 10px;"><i class="bi bi-pencil"></i></a>

							</div>

						</div>
						<div class="card-body">
							<?php foreach ($keywords as $keyword) { ?>
								<p class="text-muted"><?php echo $keyword; ?></p>
							<?php } ?>
						</div>
					</div>
				</div>
			<?php } ?>

		</div>
	</div>
</div> -->


<script>
	const myModal = new bootstrap.Modal(document.getElementById('modal'))
	const content = document.getElementById("content")
	const head = document.getElementById("headTitle")
	const foot = document.getElementById("footer")

	//FILTRO DE AREAS
	function valuechange(e) {
		var table = $('#myTable').DataTable();
		// console.log(e);
		table.column(1).search(e.value).draw();
	}

	function addKeyword() {
		head.innerHTML = "AGREGAR KEYWORDS";
		content.innerHTML = `
			
                <form id="addKeyword">
                        <div class="form-floating mb-3">
                        <input type="text" name="keyword" id="keyword" class="form-control" placeholder="..." autocomplete="off">
                        <label for="keyword">Agregar keyword</label>
                    </div>
                    <div class="form-floating mb-4">
					<select class="form-control" id="OCUPACIONID" name="OCUPACIONID">
                        <option value="">Seleccionar ocupación</option>
                        <?php
						$mydb->setQuery("SELECT * FROM tblocupaciones WHERE OCUPACIONSTATUS = 1");
						$ocupaciones = $mydb->loadResultList();
						foreach ($ocupaciones as $ocupacion) {
							echo '<option value="' . $ocupacion->OCUPACIONID . '">' . $ocupacion->OCUPACION . '</option>';
						}
						?>
                    </select>
                        <label for="floatingSelect">ocupacion</label>
                    </div>
                </form>
			`;
		foot.innerHTML = `
		<button form="addKeyword" class="btn bg-success ml-1">
			<span class="d-none d-sm-block text-white">Guardar</span>
		</button>
			`;
		myModal.show();

		const form = document.getElementById("addKeyword");
		const formFields = [
			document.getElementById("keyword"),
			document.getElementById("OCUPACIONID"),
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
				let response = await fetch("<?php echo web_root ?>admin/keywords/controller.php?action=add", {
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



	function editKeyword(a) {

		head.innerHTML = "Modificar palabras claves"
		content.innerHTML = `
		<form action="controller.php?action=edit&id=${a['cod_keyword']}" method="POST" id="editKeyword">
	<div class="form-floating mb-3">
		<input type="text" name="OCUPACION" id="OCUPACION" class="form-control" value="${a['OCUPACION']}" required>
		<label for="OCUPACION">Ocupación</label>
	</div>

	<div class="form-floating mb-3">
		<input type="text" name="keyword" id="keyword" class="form-control" value="${a['keyword']}" required>
		<label for="keyword">keyword</label>
	</div>

</form>
    `
		foot.innerHTML = `
        <button form="editKeyword" class="btn btn-success ml-1" name="save" onclick="updateKeyword()">                    
            <span class="d-none d-sm-block">Actualizar</span>
        </button>
    `
		myModal.show();
	}

	function updateKeyword() {
		document.getElementById("editKeyword").submit();

		Swal.fire({
			title: " palabras claves actualizadas",
			text: "La palabras claves actualizadas con éxito",
			icon: "success",
			confirmButtonText: "Aceptar",
			timer: 5000,
			timerProgressBar: true,
		});
	}
</script>