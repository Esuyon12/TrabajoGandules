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

	case 'photos':
		doupdateimage();
		break;

	case 'addfiles':
		doAddFiles();
		break;

	case 'state':
		updatestate();
		break;
}


function updatestate()
{
	// echo json_encode($_GET);
	$emp = new Employee();
	$emp->ESTADO = $_GET['code'];
	$emp->update($_GET['id']);
	echo json_encode(array("status" => "success", "msge" => "Cambio de estado", "location" => "index.php"));
}

function doInsert()

{
	global $mydb;
	try {

		if ($_POST['DNI'] == "") {
			throw new Exception("La vacante está vacía", 400);
		}

		$sql = "SELECT * FROM empleados WHERE DNI LIKE '%" . trim($_POST['DNI']) . "%'";
		$mydb->setQuery($sql);
		$cur = $mydb->executeQuery();

		if ($cur->num_rows !== 0) {
			throw new Exception("Ya existe este registro", 400);
		}

		$emp = new Employee();
		$emp->APELLIDOP				= $_POST['APELLIDOP'];
		$emp->APELLIDOM				= $_POST['APELLIDOM'];
		$emp->NOMBRE 	   			= $_POST['NOMBRE'];
		$emp->DNI					= $_POST['DNI'];
		$emp->TELEFONO 				= $_POST['TELEFONO'];
		$emp->CORREO				= $_POST['CORREO'];
		$emp->GENERO				= $_POST['GENERO'];
		$emp->DEPARTAMENTO			= $_POST['DEPARTAMENTO'];
		$emp->PROVINCIA				= $_POST['PROVINCIA'];
		$emp->DISTRITO				= $_POST['DISTRITO'];
		$emp->DIRECCION				= $_POST['DIRECCION'];
		$emp->AREAID					= $_POST['AREAID'];
		$emp->OCUPACIONID				= $_POST['OCUPACIONID'];
		$emp->COMPANYID					= $_POST['COMPANYID'];
		$emp->ESTADO 				= 1; // Cambia el estado a 1 (activo)
		$emp->create();
		http_response_code(200);

		header('Content-Type: application/json');
		echo json_encode(array("status" => "success", "message" => "Empleado agregada correctamente"));
	} catch (Exception $e) {
		http_response_code(400);
		header('Content-Type: application/json');
		echo json_encode(array("status" => "error", "message" => $e->getMessage()));
	}
}


function doEdit()
{
	if (isset($_POST['save'])) {

		if (
			$_POST['FNAME'] == "" or $_POST['LNAME'] == ""
			or $_POST['MNAME'] == "" or $_POST['ADDRESS'] == ""
			or $_POST['TELNO'] == ""
		) {
			$messageStats = false;
			message("All fields are required!", "error");
			redirect('index.php?view=add');
		} else {

			$birthdate =  date_format(date_create($_POST['BIRTHDATE']), 'Y-m-d');

			$age = date_diff(date_create($birthdate), date_create('today'))->y;
			if ($age < 20) {
				message("Invalid age. 20 years old and above is allowed.", "error");
				redirect("index.php?view=edit&id=" . $_POST['EMPLOYEEID']);
			} else {

				@$datehired = date_format(date_create($_POST['EMP_HIREDDATE']), 'Y-m-d');

				$emp = new Employee();
				$emp->EMPLOYEEID 		= $_POST['EMPLOYEEID'];
				$emp->FNAME				= $_POST['FNAME'];
				$emp->LNAME				= $_POST['LNAME'];
				$emp->MNAME 	   		= $_POST['MNAME'];
				$emp->ADDRESS			= $_POST['ADDRESS'];
				$emp->BIRTHDATE	 		= $birthdate;
				$emp->BIRTHPLACE		= $_POST['BIRTHPLACE'];
				$emp->AGE			    = $age;
				$emp->SEX 				= $_POST['optionsRadios'];
				$emp->TELNO				= $_POST['TELNO'];
				$emp->CIVILSTATUS		= $_POST['CIVILSTATUS'];
				$emp->POSITION			= trim($_POST['POSITION']);
				// $emp->DEPARTMENTID		= $_POST['DEPARTMENTID'];
				// $emp->DIVISIONID		= $_POST['DIVISIONID'];
				$emp->EMP_EMAILADDRESS		= $_POST['EMP_EMAILADDRESS'];
				$emp->EMPUSERNAME		= $_POST['EMPLOYEEID'];
				$emp->EMPPASSWORD		= sha1($_POST['EMPLOYEEID']);
				$emp->DATEHIRED			=  @$datehired;
				$emp->COMPANYID			= $_POST['COMPANYID'];
				$emp->update($_POST['EMPLOYEEID']);


				message("Employee has been updated!", "success");
				// redirect("index.php?view=view&id=".$_POST['EMPLOYEEID']);
				redirect("index.php?view=edit&id=" . $_POST['EMPLOYEEID']);
			}
		}
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
		$employee = new Employee();
		$employee->ESTADO = 0;

		$employee->update($_GET['id']);

		http_response_code(200);

		header('Content-Type: application/json');
		echo json_encode(array("status" => "success", "message" => "Se elimino correctamente"));
	} catch (Exception $e) {
		http_response_code(400);
		header('Content-Type: application/json');
		echo json_encode(array("status" => "error", "message" => $e->getMessage()));
	}
}



function UploadImage()
{
	$target_dir = "../../employee/photos/";
	$target_file = $target_dir . date("dmYhis") . basename($_FILES["picture"]["name"]);
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);


	if (
		$imageFileType != "jpg" || $imageFileType != "png" || $imageFileType != "jpeg"
		|| $imageFileType != "gif"
	) {
		if (move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file)) {
			return  date("dmYhis") . basename($_FILES["picture"]["name"]);
		} else {
			echo "Error Uploading File";
			exit;
		}
	} else {
		echo "File Not Supported";
		exit;
	}
}

function doupdateimage()
{

	$errofile = $_FILES['photo']['error'];
	$type = $_FILES['photo']['type'];
	$temp = $_FILES['photo']['tmp_name'];
	$myfile = $_FILES['photo']['name'];
	$location = "photo/" . $myfile;


	if ($errofile > 0) {
		message("No Image Selected!", "error");
		redirect("index.php?view=view&id=" . $_GET['id']);
	} else {

		@$file = $_FILES['photo']['tmp_name'];
		@$image = addslashes(file_get_contents($_FILES['photo']['tmp_name']));
		@$image_name = addslashes($_FILES['photo']['name']);
		@$image_size = getimagesize($_FILES['photo']['tmp_name']);

		if ($image_size == FALSE) {
			message("Uploaded file is not an image!", "error");
			redirect("index.php?view=view&id=" . $_GET['id']);
		} else {
			//uploading the file
			move_uploaded_file($temp, "photo/" . $myfile);



			$stud = new Student();
			$stud->StudPhoto	= $location;
			$stud->studupdate($_POST['StudentID']);
			redirect("index.php?view=view&id=" . $_POST['StudentID']);
		}
	}
}
