<?php
require_once("../../include/initialize.php");

if (!isset($_SESSION['ADMIN_USERID'])) {
	redirect(web_root . "admin/index.php");
}

$autonum = new Autonumber();
$res = $autonum->set_autonumber('userid');

?>

<div class="page-heading">
	<div class="col-lg-12">
		<div class="d-flex justify-content-between align-items-center w-100">
			<div class="d-flex align-items-center">
				<h1>Usuarios</h1>
			</div>
			<div class="d-flex">
				<div class="form-floating mb-3">
					<input type="text" id="tableSearch" class="form-control" placeholder="Escriba su búsqueda aquí...">
					<label for="tableSearch">Buscar registros</label>
				</div>
			</div>
		</div>
	</div>
</div>

	<?php $mydb->setQuery("SELECT * FROM  `tblusers`");
	$cur = $mydb->loadResultList(); ?>
    <div class="col-lg-12">
        <div class="card shadow-sm  ">
            <div class="card-body">
                <table id="myTable" class="table table-striped table-bordered">
                    <thead>

						<tr>
							<th>Nombre</th>
							<th>Usuario</th>
							<th>Rol</th>
							<th>Correo</th>
							<th>Dni</th>
							<th>telefono</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($cur as $result) { ?>
							<tr>
								<td><?= $result->FULLNAME ?></td>
								<td><?= $result->USERNAME ?></td>
								<td style="width: 7%;">
									<span class="badge <?= ($result->ROLE == 'Administrador') ? 'btn-blue' : 'btn-grads'; ?>"><?= $result->ROLE ?></span>
								</td>
								<td><?= $result->CORREO ?></td>
								<td><?= $result->DNI ?></td>
								<td><?= $result->TELEFONO ?></td>
								<td style="width: 7%;">
									<div class="badges text-center">
										<span style="cursor:pointer;" ondblclick="state(<?php echo $result->ESTADO ?>, <?php echo $result->USERID ?>)" class="badge <?= ($result->ESTADO == 0) ? 'btn-grads' : 'btn-red' ?>">
											<?= ($result->ESTADO == 0) ? 'Activo' : 'Inactivo' ?>
										</span>
									</div>
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
            let response = await fetch(`<?php echo web_root ?>admin/user/controller.php?action=state&id=${b}&code=${a == 1 ? 0 : 1}`, {
                method: 'POST'
            })

            let text = await response.json()
            if (text.status == "success") {
                location.href = text.location
            }
            console.log(text);
        }

		</script>
