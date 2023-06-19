<?php
require_once("../../include/initialize.php");

if (!isset($_SESSION['ADMIN_USERID'])) {
	redirect(web_root . "admin/index.php");
}

?>

<div class="page-heading">
	<div class="col-lg-12">
		<div class="d-flex justify-content-between align-items-center w-100">
			<div class="d-flex">
				<h1>Empleados</h1>
			</div>
			<div class="d-flex">
				<div class="form-floating mb-4">
					<input type="text" id="tableSearch" class="form-control shadow-sm" placeholder="Escriba su búsqueda aquí...">
					<label for="tableSearch">Buscar empleado</label>
				</div>
			</div>
		</div>
	</div>
</div>

<?php $mydb->setQuery("SELECT * FROM  `tblemployees` e, `tblapplicants`a, `tblareas` r, `tblcompany` c, `tblocupaciones` o WHERE e.`APLICANTID` = a.`APPLICANTID` AND e.`AREAID` = r.`AREAID` AND e.`OCUPACIONID` = o.`OCUPACIONID` AND e.`COMPANYID` = c.`COMPANYID`");
$cur = $mydb->loadResultList();
?>
<div class="col-lg-12">
	<div class="card shadow-sm">
		<div class="card-body">
			<table id="myTable" class="table table-striped table-bordered">
				<thead>
					<tr>
						<th>Nombre</th>
						<th>Correo</th>
						<th>Dni</th>
						<th>Telefono</th>
						<th></th>
						<th></th>

					</tr>
				</thead>
				<tbody>
					<?php
					foreach ($cur as $result) {
						unset($result->DESCRIPCION);
						unset($result->COMPANYADDRESS);
						unset($result->AREA)
					?>

						<tr>
							<td><?= $result->FNAME . ' ' . $result->LNAME . ' ' . $result->MNAME ?></td>
							<td><?= $result->EMAILADDRESS  ?></td>
							<td><?= $result->DNI  ?></td>
							<td><?= $result->CONTACTNO  ?></td>
							<td style="width: 7%;">
								<div class="badges text-center"><span style="cursor:pointer;" ondblclick="state(<?php echo $result->ESTADO ?>, <?php echo $result->INCID ?>)" class="badge bg-<?= ($result->ESTADO == 1) ? 'success' : 'danger' ?>"><?= ($result->ESTADO == 1) ? 'Activo' : 'Inactivo' ?></span></div>
							</td>
							<!-- <td>
								<a title="View" href="index.php?view=view&id=<?php echo $result->APPLICANTID ?>" class="btn-grads">
									<i class="bi bi-eye"></i>
								</a>
							</td> -->

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
	const myModal = new bootstrap.Modal(document.getElementById('modal'));
	const content = document.getElementById("content");
	const head = document.getElementById("headTitle");
	const foot = document.getElementById("footer");

	function viewEmployee(data) {
		head.innerHTML = ""
		content.innerHTML = ` 
			<div class="container-fluid mb-3">
					<div class="row">
					<h4 class="text-center">${data.FNAME}    ${data.LNAME}   ${data.MNAME} </h4>
					</div>
					<div class="row">
						<p class="text-muted text-center"> ${data.OCUPACION} </p>
					</div>
					<br>
					<div class="card-info">
						<div class="icon-detail">
							<ion-icon name="at-circle-outline"></ion-icon>
							<p class="text-muted"> ${data.EMAILADDRESS} </p>
						</div>
						<div class="icon-detail">
							<ion-icon name="card-outline"></ion-icon>
							<p class="text-muted"> ${data.DNI} </p>
						</div>
						<div class="icon-detail">
							<ion-icon name="call-outline"></ion-icon>
							<p class="text-muted"> ${data.CONTACTNO} </p>
						</div>
						<div class="icon-detail">
							<ion-icon name="time-outline"></ion-icon>
							<p class="text-muted">${data.DATEHIRED}</p>
						</div>
						
					</div>
				</div>
			`
		foot.innerHTML = `
				<a href="index.php?view=view&id=${data.INCID}">ver</a>			`
		myModal.show();
	}
</script>