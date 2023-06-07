<?php
require_once("../../include/initialize.php");

$action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : '';

switch ($action) {

	case 'photos':
		doupdateimage();
		break;

	case 'postul':
		doSubmitApplication();
		break;

	case 'downCV':
		downloadCV();
		break;
	case 'cal':
		cal();
		break;
}

function doSubmitApplication()
{
	try {

		// echo json_encode(array("post" => $_POST,"files" => $_FILES)); exit;

		$dni = $_POST['DNI'];

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

		$_POST['MNAME'] = $response->apellidoMaterno;
		$_POST['LNAME'] = $response->apellidoPaterno;
		$_POST['FNAME'] = $response->nombres;

		$points = verifyPoints();
		$_POST['POINTS'] = $points;
		$picture = UploadImage();


		// echo json_encode(array("data" => $_POST)); die();

		$applicant = new Applicants();

		foreach ($_POST as $key => $value) {
			@$applicant->$key = $value;
		}

		// echo json_encode($applicant); die();

		$applicant->create();
		echo json_encode(array("status" => "success", "message" => "Se añadio corectamente"));
	} catch (Exception $e) {
		http_response_code(400);
		echo json_encode(array("status" => "error", "message" => $e->getMessage()));
	}
	die();
}

function UploadImage()
{
	$target_dir = "/applicants/cv/";

	$upload_error = $_FILES['CVFILE']['error'];
	if ($upload_error !== UPLOAD_ERR_OK) {
		throw new Exception("Error al cargar el archivo: " . GetUploadErrorMessage($upload_error), $upload_error);
	}

	$target_file = $target_dir . date("dmYhis") . basename($_FILES["CVFILE"]["name"]);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($_FILES["CVFILE"]["name"], PATHINFO_EXTENSION));

	if ($imageFileType == "pdf" || $imageFileType == "doc" || $imageFileType == "docx") {
		if (move_uploaded_file($_FILES["CVFILE"]["tmp_name"], ROOT_PATH . '/../admin' . $target_file)) {
			return $_POST['CVFILE'] =  date("dmYhis") . basename($_FILES["CVFILE"]["name"]);
		} else {
			throw new Exception("Error al subir el archivo", 1);
		}
	} else {
		throw new Exception("Archivo no soportado", 1);
	}
}

function GetUploadErrorMessage($error_code)
{
	switch ($error_code) {
		case UPLOAD_ERR_INI_SIZE:
			return "El archivo cargado excede la directiva upload_max_filesize en php.ini";
		case UPLOAD_ERR_FORM_SIZE:
			return "El archivo cargado excede la directiva MAX_FILE_SIZE que fue especificada en el formulario HTML";
		case UPLOAD_ERR_PARTIAL:
			return "El archivo cargado fue sólo parcialmente cargado";
		case UPLOAD_ERR_NO_FILE:
			return "No se cargó ningún archivo";
		case UPLOAD_ERR_NO_TMP_DIR:
			return "Falta la carpeta temporal";
		case UPLOAD_ERR_CANT_WRITE:
			return "Error al escribir el archivo en el disco";
		case UPLOAD_ERR_EXTENSION:
			return "Una extensión de PHP detuvo la carga del archivo";
		default:
			return "Error de carga desconocido";
	}
}

function verifyPoints()
{
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		// Verificar que se haya subido un archivo PDF
		if (!empty($_FILES['CVFILE']['name']) && $_FILES['CVFILE']['type'] == 'application/pdf') {
			try {
				// Obtener el texto del archivo PDF subido
				$pdf = file_get_contents($_FILES['CVFILE']['tmp_name']);

				// Validar que el archivo PDF no contenga código malicioso o virus
				if (!is_valid_pdf($pdf)) {
					throw new Exception("El archivo PDF subido no es válido o contiene código malicioso.");
				}

				// Convertir el contenido del PDF en texto
				$text = (new \Smalot\PdfParser\Parser())->parseContent($pdf)->getText();

				// Limpiar el texto
				$text = clean_text($text);

				// Definir las palabras clave relevantes para la evaluación sssa
				$palabras_clave = array('proyecto', 'innovación', 'mejora', 'input', 'excel'); //Aqui sera la BD 


				// Evaluar la relevancia del documento en base a las palabras clave
				$puntaje = evaluate_document($text, $palabras_clave);

				// Imprimir el puntaje asignado al PDF
				return $puntaje;
			} catch (Exception $e) {
				throw new Exception($e->getMessage(), 1);
			}
		}
		// else {
		// 	echo json_encode(array("status" => "error", "message" => "Debes subir un archivo PDF"));
		// }
	}
}

function is_valid_pdf($pdf)
{
	// Agregar aquí la validación específica que desees realizar
	return true;
}

function clean_text($text)
{
	$text = strtolower($text);
	// Agregar aquí otras operaciones de limpieza que desees realizar
	return $text;
}

function evaluate_document($text, $palabras_clave)
{
	$puntaje = 0;
	$palabras_encontradas = array();
	foreach ($palabras_clave as $palabra) {
		if (!in_array($palabra, $palabras_encontradas)) {
			$conteo_palabra = substr_count($text, $palabra);
			$puntaje += $conteo_palabra ? 1 : 0;
			// array_push($palabras_encontradas, $palabra);
			$palabras_encontradas[] = $conteo_palabra ? $palabra : null;
		}
	}
	// print_r($palabras_encontradas);
	return $puntaje;
}

if (!isset($_SESSION['ADMIN_USERID'])) {
	redirect(web_root . "admin/index.php");
}

function cal()
{
	try {
		$_POST['RESULT'] = $_POST['RESULT'] * 4;
		// print_r($_POST); die();
		$applicant = new Evaluaciones();
		@$applicant->RESULT = $_POST['RESULT'];

		@$applicant->update($_POST['ID']);
	} catch (Exception $e) {
		// Manejar la excepción aquí
		echo "Error: " . $e->getMessage();
	}
	die();
}

function downloadCV()
{

	// Nombre del archivo de CV
	if (isset($_GET['archivo'])) {
		$nombre_archivo = $_GET['archivo'];
	} else {
		die('No se especificó un archivo para descargar.');
	}

	// Ruta completa del archivo de CV
	$ruta_archivo = ROOT_PATH . '../../admin/applicants/cv/' . $nombre_archivo;

	echo $ruta_archivo;
	echo "<br>";

	// Descarga el archivo de CV
	if (file_exists($ruta_archivo)) {
		header('Content-Description: Archivo de CV');
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename="' . $nombre_archivo . '"');
		header('Expires: 0');
		header('Cache-Control: must-revalidate');
		header('Pragma: public');
		header('Content-Length: ' . filesize($ruta_archivo));
		readfile($ruta_archivo);
		exit;
	} else {
		echo 'El archivo de CV no existe.';
	}
}
