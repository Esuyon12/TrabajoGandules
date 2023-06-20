<?php
require_once("../../include/initialize.php");
date_default_timezone_set('America/Lima');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

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

	case 'evalua':
		evalua();
		break;

	case 'newtoken':
		insertToken();
		break;

	case 'send':
		sendResponse();
		break;
}

function sendResponse()
{


	try {
		$evacre = new Evaluaciones();

		if (isset($_POST['mood'])) {
			$fechaHoraActual = date('Y-m-d H:i:s'); // Obtener la fecha y hora actual
			$fechaHoraAtras = date('Y-m-d H:i:s', strtotime('-1 hour')); // Sumar una hora a la fecha y hora actual
			@$evacre->DATE_IN = $fechaHoraAtras;
			@$evacre->DATE_END = $fechaHoraActual;
		}

		// print_r($_POST); die();

		@$evacre->RESPUESTA = $_POST['respuesta'];
		@$response = $evacre->update($_POST['ID']);

		echo json_encode(array("status" => "success", "message" => "Se guardo automaticamente"));
		die();
	} catch (Exception $e) {
		echo json_encode(array("status" => "error", "message" => $e->getMessage()));
		die();
	}
}


if (!isset($_SESSION['ADMIN_USERID'])) {
	http_response_code(401);
	echo json_encode(array("estado" => "Sin autorizacion"));
	exit;
}


function insertToken()
{
	// global $mydb;
	try {

		// Define la clave secreta para la firma del token
		$clave_secreta = 'XjhGjf7SPsdoobvW';


		$evacre = new Evaluaciones();
		@$evacre->APPLICANTID = $_POST['APPLICANTID'];
		@$evacre->IDEVALUACIONCREA = $_POST['IDEVALUACIONCREA'];
		@$evacre->OCUPACIONID = $_POST['OCUPACIONID'];
		@$evacre->AREAID = $_POST['AREAID'];

		@$response = $evacre->create();

		$id = @$response;

		unset($_POST['OCUPACIONID']);
		unset($_POST['AREAID']);

		$_POST['EVALUACIONID'] = $response;

		// Define los datos que deseas incluir en la carga útil del token
		$datos = array(
			"start" => strtotime($_POST['DATE_START']),
			"exp" => strtotime($_POST['DATE_OUT']) // convierte la fecha DATE_OUT recibida por POST en una marca de tiempo UNIX
		);

		// Agrega los datos adicionales de la solicitud POST al arreglo de datos para el token
		foreach ($_POST as $key => $value) {
			$datos[$key] = $value;
		}

		// Codifica los datos en formato JSON
		$datos_json = json_encode($datos);

		// Codifica los datos en Base64
		$datos_base64 = base64_encode($datos_json);

		// Genera la firma del token
		$firma = hash_hmac('sha256', $datos_base64, $clave_secreta);

		// Crea el token concatenando los datos codificados y la firma
		$token = $datos_base64 . '.' . $firma;

		@$evacre->TOKEN = $token;

		$response = $evacre->update($response);

		http_response_code(200);

		header('Content-Type: application/json');
		echo json_encode(array("status" => "success", "message" => $token, "id" => $id));
	} catch (Exception $e) {
		http_response_code(400);
		header('Content-Type: application/json');
		echo json_encode(array("status" => "error", "message" => $e->getMessage()));
	}
}

function evalua()
{

	try {
		// print_r($_POST);
		// die();

		if ($_POST['type'] == "new") {
			$result = sendMessage($_POST['EMAIL'], $_POST['ASUNTO'], 'PRUEBA', $_POST['MESSAGE']);
			$id = $_POST['APLICANTID'];
			unset($_POST['type']);
			unset($_POST['MESSAGE']);
			unset($_POST['EMAIL']);
			unset($_POST['ASUNTO']);
			// print_r($_POST);
			// die;
			$emp = new Employee();
			foreach ($_POST as $key => $value) {
				@$emp->$key = $value;
			}

			unset($_POST['APLICANTID']);

			@$emp->create();

			@$applicant = new Applicants();
			@$applicant->STATE = 1;

			@$applicant->update($id);
		} else if (isset($_POST['EVALUACIONID'])) {
			$result = sendMessage($_POST['EMAIL'], $_POST['ASUNTO'], 'PRUEBA', $_POST['MESSAGE']);
			$evacre = new Evaluaciones();
			@$evacre->MSG = 1;
			@$evacre->update($_POST['EVALUACIONID']);
		} else {
			$result = sendMessage($_POST['EMAIL'], $_POST['ASUNTO'], 'PRUEBA', $_POST['MESSAGE']);
		}

		echo json_encode(array("status" => "success", "message" => $result));
		die();
	} catch (Exception $e) {
		echo json_encode(array("status" => "error", "message" => $e->getMessage()));
		die();
	}
}


function updatestate()
{
	// echo json_encode($_GET);
	$evaluacion = new Area();
	$evaluacion->ESTADO = $_GET['code'];
	$evaluacion->update($_GET['id']);
	echo json_encode(array("status" => "success", "msge" => "Cambio de estado", "location" => "index.php"));
}

function doInsert()
{
	global $mydb;
	try {

		if ($_POST['APPLICANTID'] == "") {
			throw new Exception("El registro está vacío", 1);
		}

		$sql = "SELECT * FROM tblevaluaciones WHERE APPLICANTID LIKE '%" . trim($_POST['APPLICANTID']) . "%'";
		$mydb->setQuery($sql);
		$cur = $mydb->executeQuery();

		// print_r($cur);
		// die();

		if ($cur->num_rows !== 0) {
			throw new Exception("Ya existe este registro", 1);
		}

		$evaluacion = new Evaluaciones();
		$evaluacion->APPLICANTID = $_POST['APPLICANTID'];
		$evaluacion->TOKEN = $_POST['TOKEN'];
		$evaluacion->IDEVALUACIONCREA	 = $_POST['IDEVALUACIONCREA	'];
		$evaluacion->RESULT = $_POST['RESULT'];
		$evaluacion->DATE_END = $_POST['DATE_END'];
		$evaluacion->DATE_IN = $_POST['DATE_IN'];

		$evaluacion->create();

		http_response_code(200);

		header('Content-Type: application/json');
		echo json_encode(array("status" => "success", "message" => "Área agregada correctamente"));
	} catch (Exception $e) {
		http_response_code(400);
		header('Content-Type: application/json');
		echo json_encode(array("status" => "error", "message" => $e->getMessage()));
	}
}

function doEdit()
{
	if (isset($_POST['save'])) {

		$evaluacion = new Area();
		$evaluacion->AREA = $_POST['AREA'];
		$evaluacion->update($_GET['id']);

		message("[" . $_POST['AREA'] . "] has been updated!", "success");
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
		$evaluacion = new Area();
		$evaluacion->ESTADO = 0; //0 ES A INACTIVO

		$evaluacion->update($_GET['id']);


		http_response_code(200);

		header('Content-Type: application/json');
		echo json_encode(array("status" => "success", "message" => "Se elimino correctamente"));
	} catch (Exception $e) {
		http_response_code(400);
		header('Content-Type: application/json');
		echo json_encode(array("status" => "error", "message" => $e->getMessage()));
	}
}


function sendMessage($para, $asunto, $mensaje, $contenido_quill)
{
	// Crear una nueva instancia de PHPMailer
	$mail = new PHPMailer(true);

	try {
		// Configurar las opciones de envío del correo electrónico
		$mail->SMTPDebug = 0;
		$mail->isSMTP();
		$mail->Host = 'smtp.hostinger.com';
		$mail->SMTPAuth = true;
		$mail->Username = 'test@sysmarkt.com';
		$mail->Password = 'TuPapaNoTeQuiere2@';
		$mail->SMTPSecure = 'ssl';
		$mail->Port = 465;

		// Configurar los destinatarios, el asunto y el cuerpo del mensaje
		$mail->setFrom('test@sysmarkt.com', 'Test');
		$mail->addAddress($para);
		$mail->Subject = $asunto;
		$mail->isHTML(true);
		$mail->CharSet = 'UTF-8'; // Establecer la codificación de caracteres correcta
		$mail->Body = $contenido_quill;
		$mail->AltBody = strip_tags($mensaje);

		// Enviar el correo electrónico
		$result = $mail->send();

		if (!$result) {
			throw new Exception('Hubo un problema al enviar el correo electrónico.', 1);
		}

		return 'El correo electrónico se ha enviado correctamente.';
	} catch (Exception $e) {
		// Capturar cualquier excepción que ocurra durante el envío del correo electrónico
		return 'Hubo un problema al enviar el correo electrónico: ' . $mail->ErrorInfo;
	}
}
