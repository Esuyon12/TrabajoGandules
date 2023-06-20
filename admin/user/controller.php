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

	case 'state':
		updatestate();
		break;
}


function updatestate()
{
	$user = new User();
	$user->ESTADO = $_GET['code'];
	$user->update($_GET['id']);
	echo json_encode(array("status" => "success", "msge" => "Cambio de estado", "location" => "index.php"));
}


function doInsert()
{

	$dni = $_POST['DNI'];

	try {
		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => 'https://api.apis.net.pe/v1/dni?numero=' . $dni,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_SSL_VERIFYPEER => 0,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 2,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'GET'
		));
		$response = curl_exec($curl);
		curl_close($curl);
		$response = json_decode($response);

		if (!empty($response->error) or !isset($response)) {
			http_response_code(400);
			throw new Exception(isset($response->error) ? $response->error : "No existes", 1);
		}

		$_POST['FULLNAME'] = ucwords(strtolower($response->nombres . " " . $response->apellidoPaterno . " " . $response->apellidoMaterno));
		$_POST['PASS'] = password_hash("Gandules" . date('Y') . "@", PASSWORD_DEFAULT);
		if (!empty($_FILES['FOTO']["full_path"])) {
			$picture = UploadImage();
		} else {
			$numero = rand(1, 8);
			$_POST['FOTO'] = "faces/" . $numero . ".jpg";
		}

		$user = new User();
		foreach ($_POST as $key => $value) {
			@$user->$key = $value;
		}

		@$user->create();
		echo json_encode(array("status" => "success", "message" => "Se creo correctamente"));
	} catch (Exception $e) {
		// $mydb->rollBack();
		echo json_encode(array("status" => "error", "message" => $e->getMessage()));
	}
}


function doEdit()
{
	global $mydb;

	$user = new User();
	$id = $_POST["USERID"];
	unset($_POST["USERID"]);

	if (empty(trim($_POST["PASS"]))) {
		unset($_POST["PASS"]);
	} else {
		$_POST['PASS'] = password_hash($_POST['PASS'], PASSWORD_DEFAULT);
	}

	try {

		if (isset($_FILES)) {

			if (!empty($_FILES['FOTO']["full_path"])) {
				$mydb->setQuery("SELECT FOTO FROM `tblusers` WHERE USERID = " . $id);
				$namefoto = $mydb->loadSingleResult();
				$oldFilePath = __DIR__ . "/photos/" . $namefoto->FOTO;

				if (file_exists($oldFilePath)) {
					// Eliminar la imagen anterior
					unlink($oldFilePath);
				}

				// Agregar nueva imagen
				$picture = UploadImage();
			}
		}

		// print_r($_POST); die;

		foreach ($_POST as $key => $value) {
			@$user->$key = $value;
		}

		$_SESSION['ADMIN_FOTO'] = isset($_POST['FOTO']) ? $_POST['FOTO'] : $_SESSION['ADMIN_FOTO'];
		$_SESSION['ADMIN_CORREO'] = isset($_POST['email']) ? $_POST['email'] : $_SESSION['ADMIN_CORREO'];
		$_SESSION['ADMIN_TELF'] = isset($_POST['TELEFONO']) ? $_POST['TELEFONO'] : $_SESSION['ADMIN_TELF'];
		$_SESSION['ADMIN_USERNAME'] = isset($_POST['fullname']) ? $_POST['fullname'] : $_SESSION['ADMIN_USERNAME'];

		// print_r($user); die;

		@$user->update($id);
		echo json_encode(array("status" => "success", "message" => "Se actualizo"));
	} catch (Exception $e) {
		echo json_encode(array("status" => "error", "message" => $e->getMessage()));
	}
	die;
}



function doDelete()
{
	try {
		@$user = new User();
		@$user->ESTADO = 1;
		@$user->update($_POST['iduser']);

		$response = array('success' => true, 'message' => 'El usuario ha sido actualizado correctamente.');
	} catch (Exception $e) {
		$response = array('success' => false, 'message' => 'Error al actualizar el usuario: ' . $e->getMessage());
	}

	header('Content-Type: application/json');
	echo json_encode($response);
}


function doupdateimage()
{

	$errofile = $_FILES['photo']['error'];
	$type = $_FILES['photo']['type'];
	$temp = $_FILES['photo']['tmp_name'];
	$myfile = $_FILES['photo']['name'];
	$location = "photos/" . $myfile;


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
			move_uploaded_file($temp, "photos/" . $myfile);



			$user = new User();
			// @$user->PICLOCATION 			= $location;
			$user->update($_SESSION['ADMIN_USERID']);
			redirect("index.php?view=view");
		}
	}
}

function UploadImage()
{
	$target_dir = "/user/photos/";

	$upload_error = $_FILES['FOTO']['error'];
	if ($upload_error !== UPLOAD_ERR_OK) {
		throw new Exception("Error al cargar el archivo: " . GetUploadErrorMessage($upload_error), $upload_error);
	}

	$target_file = $target_dir . date("dmYhis") . basename($_FILES["FOTO"]["name"]);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($_FILES["FOTO"]["name"], PATHINFO_EXTENSION));

	if ($imageFileType == "jpg" || $imageFileType == "jpeg" || $imageFileType == "png" || $imageFileType == "gif") {
		if (move_uploaded_file($_FILES["FOTO"]["tmp_name"], ROOT_PATH . '/../admin' . $target_file)) {
			return $_POST['FOTO'] =  date("dmYhis") . basename($_FILES["FOTO"]["name"]);
		} else {
			throw new Exception("Error al subir el archivo", 1);
		}
	} else {
		throw new Exception("Archivo no soportado. Solo se admiten archivos de imagen JPG, JPEG, PNG y GIF", 1);
	}
}

function GetUploadErrorMessage($upload_error)
{
	switch ($upload_error) {
		case UPLOAD_ERR_INI_SIZE:
			return "El archivo excede el tamaño máximo permitido por la configuración del servidor.";
		case UPLOAD_ERR_FORM_SIZE:
			return "El archivo excede el tamaño máximo permitido por el formulario.";
		case UPLOAD_ERR_PARTIAL:
			return "El archivo solo se ha subido parcialmente.";
		case UPLOAD_ERR_NO_FILE:
			return "No se ha seleccionado ningún archivo para cargar.";
		case UPLOAD_ERR_NO_TMP_DIR:
			return "Falta la carpeta temporal para cargar el archivo.";
		case UPLOAD_ERR_CANT_WRITE:
			return "No se puede escribir el archivo en el disco.";
		case UPLOAD_ERR_EXTENSION:
			return "La carga del archivo fue detenida por una extensión de PHP.";
		default:
			return "Error desconocido al cargar el archivo.";
	}
}
