<?php
$searchfor = (isset($_GET['searchfor']) && $_GET['searchfor'] != '') ? $_GET['searchfor'] : '';

$search = isset($_POST['SEARCH']) ? ($_POST['SEARCH'] != '') ? $_POST['SEARCH'] : 'todo' : 'todo';
$company = isset($_POST['COMPANY']) ? ($_POST['COMPANY'] != '') ? $_POST['COMPANY'] : 'todo' : 'todo';
$area = isset($_POST['AREA']) ? ($_POST['AREA'] != '') ? $_POST['AREA'] : 'todo' : 'todo';

switch ($searchfor) {
	case 'bycompany':
		# code...
		$result = 'Resultado : '  . $search . ' | Sede : ' . $company;
		break;
	case 'advancesearch':
		# code... 
		$result = 'Resultado : '  . $search . ' | Sede : ' . $company . ' | Funcion : ' . $area;
		break;
	case 'byfunction':
		# code... 
		$result = 'Resultado : '  . $search . ' | Funcion : ' . $area;
		break;

	case 'bytitle':
		# code... 
		$result = 'Resultado : '  . $search;
		break;

	default:
		# code...
		break;
}

function time_ago($timestamp)
{
	$time_ago = strtotime($timestamp);
	$current_time = time();
	$time_difference = $current_time - $time_ago;
	$seconds = $time_difference;
	$minutes = round($seconds / 60);
	$hours = round($seconds / 3600);
	$days = round($seconds / 86400);
	$weeks = round($seconds / 604800);
	$months = round($seconds / 2629440);
	$years = round($seconds / 31553280);

	if ($seconds <= 60) {
		return "just now";
	} else if ($minutes <= 60) {
		if ($minutes == 1) {
			return "Publicado hace un minuto";
		} else {
			return "Hace $minutes minutos";
		}
	} else if ($hours <= 24) {
		if ($hours == 1) {
			return "Publicado hace una hora";
		} else {
			return "Publicado hace $hours horas";
		}
	} else if ($days <= 7) {
		if ($days == 1) {
			return "Publicado ayer";
		} else {
			return "Publicado hace $days dias";
		}
	} else if ($weeks <= 4.3) {
		if ($weeks == 1) {
			return "Hace una semana";
		} else {
			return "Hace $weeks semanas";
		}
	} else if ($months <= 12) {
		if ($months == 1) {
			return "Hace un mes";
		} else {
			return "Hace $months meses";
		}
	} else {
		if ($years == 1) {
			return "Hace un año";
		} else {
			return "Hace $years años";
		}
	}
};


$search = isset($_POST['SEARCH']) ? $_POST['SEARCH'] : '';
$company = isset($_POST['COMPANY']) ? $_POST['COMPANY'] : '';
$area = isset($_POST['AREA']) ? $_POST['AREA'] : '';

$sql = "SELECT * FROM `tbljob` j, `tblcompany` c 
	WHERE j.`COMPANYID`=c.`COMPANYID` AND COMPANYNAME LIKE '%{$company}%' AND AREA LIKE '%{$area}%' AND (`OCCUPATIONTITLE` LIKE '%{$search}%' OR `JOBDESCRIPTION` LIKE '%{$search}%' OR `QUALIFICATION_WORKEXPERIENCE` LIKE '%{$search}%')";
$mydb->setQuery($sql);
$cur = $mydb->executeQuery();
$maxrow = $mydb->num_rows($cur);

?>



<div class="services_section layout_padding">
	<div class="container">
		<p class="text-muted"><?= $result ?></p>
		<?php if ($maxrow > 0) {
			$res = $mydb->loadResultList();
			foreach ($res as $row) { ?>
				<div class="row mx-auto">
					<a href="index.php?q=viewjob&search=<?= $row->JOBID ?>" class="card mb-3 w-100" style="height: 300px;">
						<div class="row g-0">
							<div class="col-md-4">
								<img src="assets/images/logo-gandules.png" alt="" class="rounded-start border-end img-fluid">
							</div>
							<div class="col-md-8">
								<div class="card-body">
									<div class="d-flex justify-content-between align-items-center">
										<p class="text-muted"><?= time_ago($row->DATEPOSTED) ?></p>
										<p class="text-muted">(Sede <?= $row->COMPANYNAME ?>)</p>
									</div>
									<h3 class="card-title"><?= $row->OCCUPATIONTITLE;
															json_encode($res) ?></h3>
									<p class="card-text"><?= $row->JOBDESCRIPTION; ?></p>
								</div>
							</div>
						</div>
					</a>
				</div>
			<?php }
		} else { ?>
			<div class="row">
				<div class="col">
					<h1 class="text-muted text-center">Sin resultado</h1>
				</div>
			</div>
		<?php } ?>
	</div>
</div>