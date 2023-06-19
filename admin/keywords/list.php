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
						<?php foreach ($search as $key) {
							if ($key->OCUPACIONSTATUS == 1) { ?>
								<option value="<?php echo $key->OCUPACION ?>"><?php echo $key->OCUPACION ?></option>
						<?php }
						} ?>
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
<?php
foreach ($cur as $result) { ?>
<?php } ?>

<div class="col-lg-12 mt-5">
	<div class="container">
		<div class="row">
			<?php
			$sql = "SELECT o.*, a.* 
					FROM tblkeywords o, 
					tblocupaciones a 
					WHERE o.OCUPACIONID = a.OCUPACIONID 
					AND a.OCUPACIONSTATUS = 1 
					ORDER BY a.OCUPACIONID, a.OCUPACION";

			$mydb->setQuery($sql);
			$key = $mydb->loadResultList();

			$data = array();
			$currentOcupacionID = null;
			$currentOcupacion = null;
			$currentOcupacionStatus = null;
			$currentAreaId = null;
			$currentFecha = null;
			$datos = array();

			foreach ($key as $row) {
				if ($currentOcupacionID !== $row->OCUPACIONID) {
					if ($currentOcupacionID !== null) {
						$obj = new stdClass();
						$obj->OCUPACIONID = $currentOcupacionID;
						$obj->OCUPACION = $currentOcupacion;
						$obj->OCUPACIONSTATUS = $currentOcupacionStatus;
						$obj->AREAID = $currentAreaId;
						$obj->FECHAREGISTRO = $currentFecha;
						$obj->KEYWORDS = $datos;
						$data[] = $obj;
					}

					$currentOcupacionID = $row->OCUPACIONID;
					$currentOcupacion = $row->OCUPACION;
					$currentOcupacionStatus = $row->OCUPACIONSTATUS;
					$currentAreaId = $row->AREAID;
					$currentFecha = $row->FECHAREGISTRO;

					$datos = array();
				}

				$obj = new stdClass();
				$obj->cod_keyword = $row->cod_keyword;
				$obj->keyword = $row->keyword;
				$obj->fecha_registro = $row->fecha_registro;
				$datos[] = $obj;
			}

			if ($currentOcupacionID !== null) {
				$obj = new stdClass();
				$obj->OCUPACIONID = $currentOcupacionID;
				$obj->OCUPACION = $currentOcupacion;
				$obj->OCUPACIONSTATUS = $currentOcupacionStatus;
				$obj->AREAID = $currentAreaId;
				$obj->FECHAREGISTRO = $currentFecha;
				$obj->KEYWORDS = $datos;
				$data[] = $obj;
			}
			$colors = array("primary", "secondary", "success", "danger", "warning");

			foreach ($data as $a) { ?>
				<div class="col-lg-4 col-md-6 col-12">
					<div class="card shadow-sm" style="height: 250px;">
						<div class="card-header">
							<div class="d-flex align-items-center w-100">
								<h6 class="text-uppercase"><?php echo $a->OCUPACION; ?></h6>
								<a onclick='editKeyword(<?= json_encode($a) ?>)' style="margin-left: 10px; cursor: pointer;">
									<i class="bi bi-pencil"></i>
								</a>
							</div>
						</div>
						<div class="card-body">
							<div class="keywords row" style="max-height: 150px; overflow:overlay;">
								<?php foreach ($a->KEYWORDS as $key) { ?>
									<div class="col-auto">
										<p class="badge bg-light-<?php echo $colors[array_rand($colors)] ?> mb-2"><?php echo $key->keyword ?></p>
									</div>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
			<?php }
			?>

		</div>
	</div>
</div>


<script>
	const myModal = new bootstrap.Modal(document.getElementById('modal'))
	const content = document.getElementById("content")
	const head = document.getElementById("headTitle")
	const foot = document.getElementById("footer")

	function addKeyword() {
		head.innerHTML = "AGREGAR KEYWORDS";
		content.innerHTML = `
    <a id="btn-form">Agregar</a>
    <form id="addKeyword">
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
      <h4>Keywords</h4>
      <div class="row" id="keys">
        <div class="col-md-6 position-relative">
          <input class="form-control mb-3" type="text" name="keywords[]">
        </div>
      </div>
    </form>
    `;
		foot.innerHTML = `
    <button form="addKeyword" class="btn bg-success ml-1">
      <span class="d-none d-sm-block text-white">Guardar</span>
    </button>
  `;

		checkInputLimit();

		myModal.show();

		const form = document.getElementById("addKeyword");

		form.addEventListener("submit", async function(e) {
			e.preventDefault();

			let inputs = form.querySelectorAll("input, select");

			function validateForm() {
				inputs.forEach((input) => {
					if (input.value === "") {
						input.style.borderColor = "red";
						return false; // Indicar que la validación ha fallado
					}
				});
				return true; // Indicar que la validación ha sido exitosa
			}

			// Validar los inputs antes de enviar el formulario
			if (!validateForm()) {
				return; // Detener el envío del formulario si la validación ha fallado
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


	function editKeyword(all) {
		let input = ""

		head.innerHTML = "Modificar palabras claves"
		all.KEYWORDS.forEach(as => {
			input += `
			<div class="col-md-6 position-relative">
				<input class="form-control mb-3" type="text" value="${as.keyword}" name="keywords[]">
				<a href="#" onclick="deleteK(this)"><ion-icon name="remove-circle-outline"></ion-icon></a>
			</div>
			`
		});


		content.innerHTML = `
		<h3 class="card-title">${all.OCUPACION}</div>
		<a id="btn-form">Agregar</a>
		<form id="editKeyword">
			<input type="hidden" name="OCUPACIONID" value="${all.OCUPACIONID}">
			<div class="row mt-3" id="keys">
				${input}
			</div>
		</form>
		`
		foot.innerHTML = `
        <button form="editKeyword" class="btn btn-success ml-1" name="save">                    
            <span class="d-none d-sm-block">Actualizar</span>
        </button>
    `
		checkInputLimit();

		myModal.show();
		document.getElementById("editKeyword").addEventListener("submit", updateKeys);

	}

	async function updateKeys(e) {
		e.preventDefault()
		let response = await fetch("controller.php?action=edit", {
			method: "POST",
			body: new FormData(e.target)
		})

		let data = await response.json()

		if (data.status == "success") {
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

	}

	function add() {
		checkInputLimit();
		document.getElementById("keys").innerHTML += `
			<div class="col-md-6 position-relative">
				<input class="form-control mb-3" type="text" name="keywords[]">
				<a href="#" onclick="deleteK(this)"><ion-icon name="remove-circle-outline"></ion-icon></a>
			</div>
			`
	}

	function deleteK(element) {
		element.parentNode.remove()
	}

	function checkInputLimit() {
		let inputs = document.getElementById("keys").querySelectorAll(".form-control").length;

		if (inputs < 9) {
			document.getElementById("btn-form").addEventListener("click", add);
		} else {
			document.getElementById("btn-form").style.display = "none";
		}
	}
</script>