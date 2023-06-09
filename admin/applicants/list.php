<?php
require_once("../../include/initialize.php");

if (!isset($_SESSION['ADMIN_USERID'])) {
	redirect(web_root . "admin/index.php");
}


$mydb->setQuery("SELECT * FROM `tblocupaciones`");
$search_tblocupaciones = $mydb->loadResultList();

$mydb->setQuery("SELECT * FROM `tblareas`");
$search_tblareas = $mydb->loadResultList();

$mydb->setQuery("SELECT * FROM `tblcompany` c, `tblareas` i, `tblocupaciones` o, `tblapplicants` a, `tbljob` j WHERE c.`COMPANYID` = a.`COMPANYID` AND a.`JOBID` = j.`JOBID` AND o.`OCUPACIONID` = j.`OCUPACIONID` AND i.`AREAID` = j.`AREAID` AND a.`state` = 0");
$cur = $mydb->loadResultList();

$fechaHoraActual = date('Y-m-d H:i:s');

?>

<!-- 
<div class="page-title">
	<div class="row">
		<div class="col-12 col-md-6 order-md-1 order-last">
			<h1>Aplicantes</h1>
		</div>
	</div>
</div> -->


<div class="page-heading">


	<div class="col-lg-12">
		<div class="d-flex justify-content-between align-items-center w-100">
			<div class="page-title">
				<div class="row">
					<div class="col-12 col-md-6 order-md-1 order-last">
						<h1>Solicitudes</h1>
					</div>
				</div>
			</div>
			<div class="d-flex">
				<div class="form-floating mb-4">
					<input type="text" id="tableSearch" class="form-control shadow" placeholder="Escriba su búsqueda aquí...">
					<label for="tableSearch">Buscar registros</label>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- <div class="row d-flex align-items-center">
	<div class="col-md-12">
		<div class="card bg-white">
			<div class="card-body">
				<div class="row">
					<div class="col-md-3">
						<div class="form-floating mb-3">
							<select class="form-select" id="areaSelect" onchange="valuechange(this,4)" aria-label="Floating label select example">
								<option selected value="">Todos</option>
								<?php foreach ($search_tblareas as $area) { ?>
									<option value="<?php echo $area->AREA ?>"><?php echo $area->AREA ?></option>
								<?php } ?>
							</select>
							<label for="areaSelect">Áreas</label>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-floating mb-3">
							<select class="form-select" id="ocupacionSelect" onchange="valuechange(this,3)" aria-label="Floating label select example">
								<option selected value="">Todos</option>
								<?php foreach ($search_tblocupaciones as $ocupacion) { ?>
									<option value="<?php echo $ocupacion->OCUPACION ?>"><?php echo $ocupacion->OCUPACION ?></option>
								<?php } ?>
							</select>
							<label for="ocupacionSelect">Ocupación</label>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-floating mb-3">
							<input type="date" id="dateFrom" class="form-control" onchange="filterTable()" placeholder="Fecha inicial">
							<label for="dateFrom">Fecha inicial</label>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-floating mb-3">
							<input type="date" id="dateTo" class="form-control" onchange="filterTable()" placeholder="Fecha final">
							<label for="dateTo">Fecha final</label>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div> -->

<div class="col-lg-12">
	<div class="card">
		<div class="card-body">
			<table id="myTable" class="table table-striped table-bordered">
				<thead>
					<tr>
						<th>Nombre</th>
						<th>DNI</th>
						<th>Area</th>
						<th>Ocupación</th>
						<th>Fecha de solicitud</th>
						<th>Estado</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php
					foreach ($cur as $result) {
						// Obtener el estado de evaluación para esta fila
						// print_r($result); exit;

						$mydb->setQuery("SELECT * FROM `tblevaluaciones` WHERE APPLICANTID = " . $result->APPLICANTID . " AND OCUPACIONID = " . $result->OCUPACIONID);
						// echo("SELECT * FROM `tblevaluaciones` WHERE APPLICANTID =". $result->APPLICANTID. " AND OCUPACIONID = ". $result->OCUPACIONID); exit;
						$cur2 = $mydb->loadSingleResult();

						// print_r($cur2);
					?>

						<tr>
							<td> <?php echo $result->FNAME . ' ' . $result->LNAME . ' ' . $result->MNAME ?></td>
							<td> <?php echo $result->DNI ?> </td>
							<td> <?php echo $result->AREA ?></td>
							<td> <?php echo $result->OCUPACION ?></td>
							<td> <?php echo $result->DATEADD ?></td>
							<td class="text-center">
								<?php if (!empty($cur2)) { ?>
									<?php if ($cur2->MSG == 0) { ?>
										<span class="badge bg-danger text-uppercase">Enviar correo</span>
									<?php } elseif (!empty($cur2->RESULT) && $cur2->RESULT >= 16) { ?>
										<span class="badge bg-success text-uppercase">enviar correo aprobatorio</span>
									<?php } elseif (!empty($cur2->DATE_END) && $fechaHoraActual > $cur2->DATE_END) { ?>
										<?php if (empty($cur2->RESULT)) { ?>
											<span class="badge bg-warning text-uppercase">revisión</span>
										<?php } else { ?>
											<span class="badge bg-success text-uppercase">Finalizado</span>
										<?php } ?>
									<?php } elseif (!empty($cur2->DATE_END) && $fechaHoraActual < $cur2->DATE_END) { ?>
										<span class="badge bg-secondary text-uppercase">En proceso</span>
									<?php } else { ?>
										<span class="badge bg-warning text-uppercase">pendiente</span>
									<?php } ?>
								<?php } else { ?>
									<span class="badge bg-danger text-uppercase">sin evaluacion</span>
								<?php } ?>
							</td>
							<td>
								<a title="View" href="index.php?view=view&id=<?php echo $result->APPLICANTID ?>" class="btn bg-success btn-outline-light btn-xs">
									<i class="bi bi-eye"></i>
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
	function valuechange(e, b) {
		var table = $('#myTable').DataTable();
		// console.log(e);
		table.column(b).search(e.value).draw();
	}

	function filterTable() {
		var table = document.getElementById("myTable");
		var dateFrom = document.getElementById("dateFrom").value;
		var dateTo = document.getElementById("dateTo").value;

		for (var i = 1; i < table.rows.length; i++) {
			var rowDate = table.rows[i].cells[4].innerText;

			if (dateFrom !== "" && rowDate < dateFrom) {
				table.rows[i].style.display = "none";
			} else if (dateTo !== "" && rowDate > dateTo) {
				table.rows[i].style.display = "none";
			} else {
				table.rows[i].style.display = "";
			}
		}
	}
</script>