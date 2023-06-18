
<?php
require_once("../../include/initialize.php");
date_default_timezone_set('America/Lima');

if (!isset($_SESSION['ADMIN_USERID'])) {
	http_response_code(401);
	echo json_encode(array("estado" => "Sin autorizacion"));
	redirect(web_root . "admin/index.php");
	exit;
}


$action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : '';

switch ($action) {
	case 'add':
		doInsert();
		break;

	case 'edit':
		doEdit();
		break;

	case 'delete':
		doDelete();
		break;

	case 'select':
		SelectOcu();
		break;

	case 'state':
		updatestate();
		break;
}


function updatestate()
{
	// echo json_encode($_GET);
	$job = new Jobs();
	$job->JOBSTATUS = $_GET['code'];
	$job->update($_GET['id']);
	echo json_encode(array("status" => "success", "msge" => "Cambio de estado", "location" => "index.php"));
}

function doInsert()

{
	global $mydb;
	try {

		if ($_POST['REQ_EMPLOYEES'] == "") {
			throw new Exception("La vacante está vacía", 400);
		}


		$sql = "SELECT * FROM tbljob j, tblcompany c WHERE OCUPACIONID LIKE '%" . trim($_POST['OCUPACIONID']) . "%' AND j.COMPANYID=c.COMPANYID  AND c.COMPANYID =" . $_POST["COMPANYID"];
		$mydb->setQuery($sql);
		$cur = $mydb->executeQuery();

		if ($cur->num_rows !== 0) {
			throw new Exception("Ya Existe Una Vacante De Esta Ocupación En Esta Sede.", 400);
		}



		$fechaHoraActual = date('Y-m-d H:i:s');

		if ($_POST['DATE_INT'] > $fechaHoraActual) {
			$_POST['JOBSTATUS'] = 1;
		}

		$job = new Jobs();
		foreach ($_POST as $key => $value) {
			if (strpos($value, "\r") !== false) {
				$value = str_replace("\r\n", "<br>", $value);
				$value = str_replace("\r", "<br>", $value);
			} elseif (strpos($value, "\n") !== false) {
				$value = str_replace("\n", "<br>", $value);
			}

			@$job->$key = $value;
		}

		@$job->create();

		http_response_code(200);

		header('Content-Type: application/json');
		echo json_encode(array("status" => "success", "message" => "Vacante agregada correctamente"));
	} catch (Exception $e) {
		http_response_code(400);
		header('Content-Type: application/json');
		echo json_encode(array("status" => "error", "message" => $e->getMessage()));
	}
}


function doEdit()
{
	// print_r($_POST);
	// die();
	try {
		$fechaHoraActual = date('Y-m-d H:i:s');

		if ($_POST['DATE_INT'] > $fechaHoraActual) {
			$_POST['JOBSTATUS'] = 1;
		} else {
			$_POST['JOBSTATUS'] = 0;
		}

		$job = new Jobs();
		foreach ($_POST as $key => $value) {
			$job->$key = $value;
		}

		$job->update($_GET['id']);
		http_response_code(200);

		header('Content-Type: application/json');
		echo json_encode(array("status" => "success", "message" => "Categoría agregada correctamente"));
	} catch (Exception $e) {
		http_response_code(400);
		header('Content-Type: application/json');
		echo json_encode(array("status" => "error", "message" => $e->getMessage()));
	}
}


function doDelete()
{
	global $mydb;

	try {
		if (empty($_GET['id'])) {
			throw new Exception("No existe ninguna id", 400);
		}

		$id = $_GET['id'];
		$Job = new Jobs();
		$Job->JOBSTATUS = 1;

		// print_r($Job);
		// die();

		$Job->update($_GET['id']);

		http_response_code(200);

		header('Content-Type: application/json');
		echo json_encode(array("status" => "success", "message" => "Se elimino correctamente"));
	} catch (Exception $e) {
		http_response_code(400);
		header('Content-Type: application/json');
		echo json_encode(array("status" => "error", "message" => $e->getMessage()));
	}
}

function SelectOcu()
{
	global $mydb;

	try {
		$_GET['AREAID'];
		$mydb->setQuery("SELECT * FROM  `tblocupaciones` WHERE AREAID = " . $_GET['AREAID']);
		$cur = $mydb->loadResultList();
		echo json_encode(array("status" => "success", "data" => $cur));
	} catch (Exception $e) {
		echo json_encode(array("message" => $e));
	}
}
?>

