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

		// print_r($user); die;

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
	}

	try {

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

		foreach ($_POST as $key => $value) {
			@$user->$key = $value;
		}

		$_SESSION['ADMIN_FOTO'] = $_POST['FOTO'];

		// print_r($user); die;

		@$user->update($id);
		echo json_encode(array("status" => "success", "message" => "Se actualizo"));
	} catch (Exception $e) {
		echo json_encode(array("status" => "error", "message" => $e->getMessage()));
	}
}



function doDelete()
{

	$id = 	$_GET['id'];

	$user = new User();
	$user->delete($id);

	message("User has been deleted!", "info");
	redirect('index.php');
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
