
<?php
require_once("../../../include/initialize.php");

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
	$evacre = new EvaluacionesCrea();
	$evacre->ESTADO = $_GET['code'];
	$evacre->update($_GET['id']);
	echo json_encode(array("status" => "success", "msge" => "Cambio de estado", "location" => "index.php"));
}



function doInsert()
{
	global $mydb;
	try {

		// print_r($_POST);
		// die();

		if (empty($_POST['TITULO'])) {
			throw new Exception("La evaluación está vacía", 400);
		}


		$sql = "SELECT * FROM tblcreaevaluaciones WHERE TITULO LIKE '%" . trim($_POST['TITULO']) . "%'";
		$mydb->setQuery($sql);
		$cur = $mydb->executeQuery();

		if ($cur->num_rows !== 0) {
			throw new Exception("Ya existe esta evaluación", 400);
		}

		@$evacre = new EvaluacionesCrea();
		// $evacre->AREAID = $_POST['AREAID'];

		@$evacre->OCUPACIONID = $_POST['OCUPACIONID'];
		@$evacre->TITULO = $_POST['TITULO'];
		@$evacre->TAREA = $_POST['TAREA'];
		@$evacre->INDICACIONES = $_POST['INDICACIONES'];
		@$evacre->ESTADO = 1; // Cambia el estado a 1 (activo)
		$response =  @$evacre->create();


		// print_r($evacre);

		http_response_code(200);

		header('Content-Type: application/json');
		echo json_encode(array("status" => "success", "message" => "evaluación agregada correctamente"));
		die();
	} catch (Exception $e) {
		http_response_code(400);
		header('Content-Type: application/json');
		echo json_encode(array("status" => "error", "message" => $e->getMessage()));
		die();
	}
}

function doEdit()
{
	global $mydb;

	try {

		if (empty($_POST['JOBID'])) {
			throw new Exception("No hay ID", 400);
		};

		$sql = "SELECT * FROM tbljob where JOBID = {$_POST['JOBID']}";
		$mydb->setQuery($sql);
		$cat = $mydb->loadSingleResult();

		// echo json_encode(array("status" => "error", 'data' => $_POST));
		// die();

		if (empty($cat)) {
			throw new Exception("No existe la id", 400);
		}

		$evacre = new EvaluacionesCrea();
		foreach ($_POST as $key => $value) {
			@$evacre->$key = $value;
		}

		@$evacre->update($_POST['JOBID']);

		http_response_code(201);
		echo json_encode(array("status" => "success", "message" => "Se agrego correctamente"));
	} catch (Exception $e) {
		http_response_code(400);
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
		$area = new EvaluacionesCrea();
		$area->ESTADO = 0; //0 ES A INACTIVO

		$area->update($_GET['id']);


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

