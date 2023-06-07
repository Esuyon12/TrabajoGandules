<?php
require_once("include/initialize.php");
$content = 'home.php';
$view = (isset($_GET['q']) && $_GET['q'] != '') ? $_GET['q'] : '';
switch ($view) {
	case 'apply':
		$title = "Submit Application";
		$content = 'applicationform.php';
		break;
	case 'login':
		$title = "Login";
		$content = 'login.php';
		break;
	case 'company':
		$title = "Company";
		$content = 'company.php';
		break;
	case 'hiring':
		$title = isset($_GET['search']) ? 'Hiring in ' . $_GET['search'] : "Hiring";
		$content = 'hirring.php';
		break;

	case 'searcharea':
		$title = isset($_GET['search']) ? 'searcharea in ' . $_GET['search'] : "searcharea";
		$content = 'searcharea.php';
		break;

	case 'viewjob':
		$title = "Job Details";
		$content = 'viewjob.php';
		break;
	case 'success':
		$title = "Success";
		$content = 'success.php';
		break;

	case 'About':
		$title = 'About Us';
		$content = 'About.php';
		break;
	case 'advancesearch':
		$title = 'Advance Search';
		$content = 'advancesearch.php';
		break;

	case 'result':
		$title = 'Advance Search';
		$content = 'advancesearchresult.php';
		break;
	case 'search-company':
		$title = 'Search by Company';
		$content = 'searchbycompany.php';
		break;


	case 'evaluacion':
		$title = 'evaluacion';
		$content = 'evaluacion.php';
		break;


	case 'trabajos':
		$content = 'trabajos.php';
		break;

	case 'about':
		$content = 'about.php';
		break;

	case 'infoContrato':
		$content = 'infoContrato.php';
		break;

	case 'area':
		$content = 'area.php';
		break;


	case 'postul':
		$content = 'postul.php';
		break;

	default:
		$active_home = 'active';
		$title = "Home";
		$content = 'home.php';
}
require_once("theme/templates.php");
