
<?php
require_once("../../include/initialize.php");

if (!isset($_SESSION['ADMIN_USERID'])) {
	redirect(web_root . "admin/index.php");
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

	case 'state':
		updatestate();
		break;
}

function updatestate()
{
	// echo json_encode($_GET);
	$company = new Company();
	$company->COMPANYSTATUS = $_GET['code'];
	$company->update($_GET['id']);
	echo json_encode(array("status" => "success", "msge" => "Cambio de estado", "location" => "index.php"));
}

function doInsert()
{
	global $mydb;
	try {
		if ($_POST['COMPANYNAME'] == "" || $_POST['COMPANYADDRESS'] == "" || $_POST['DESCRIPCION'] == "") {
			throw new Exception("Todos los campos son requeridos", 400);
		}

		$sql = "SELECT * FROM tblcompany WHERE COMPANYNAME LIKE '%" . trim($_POST['COMPANYNAME']) . "%'";
		$mydb->setQuery($sql);
		$cur = $mydb->executeQuery();

		if ($cur->num_rows !== 0) {
			throw new Exception("Ya existe esta sede", 400);
		}

		$company = new Company();
		$company->COMPANYNAME = $_POST['COMPANYNAME'];
		$company->COMPANYADDRESS = $_POST['COMPANYADDRESS'];
		$company->DESCRIPCION = $_POST['DESCRIPCION'];
		$company->COMPANYSTATUS = 1; // Cambia el estado a 1 (activo)
		$company->create();

		http_response_code(200);

		header('Content-Type: application/json');
		echo json_encode(array("status" => "success", "message" => "Sede agregada correctamente"));
	} catch (Exception $e) {
		http_response_code(400);
		header('Content-Type: application/json');
		echo json_encode(array("status" => "error", "message" => $e->getMessage()));
	}
}



function doEdit()
{
	if (isset($_POST['save'])) {
		$company = new Company();
		$company->COMPANYNAME		= $_POST['COMPANYNAME'];
		$company->COMPANYADDRESS	= $_POST['COMPANYADDRESS'];
		$company->DESCRIPCION	= $_POST['DESCRIPCION'];
		$company->update($_GET['id']);

		message("[" . $_POST['COMPANYNAME'] . "] se actualizo correctamente!", "success");
		redirect("index.php");
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
		$company = new Company();
		$company->COMPANYSTATUS = 0;


		$company->update($_GET['id']);

		http_response_code(200);

		header('Content-Type: application/json');
		echo json_encode(array("status" => "success", "message" => "Se elimino correctamente"));
	} catch (Exception $e) {
		http_response_code(400);
		header('Content-Type: application/json');
		echo json_encode(array("status" => "error", "message" => $e->getMessage()));
	}
}

?>