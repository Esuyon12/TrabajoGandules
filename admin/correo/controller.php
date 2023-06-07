
<?php
require_once("../../include/initialize.php");

if (!isset($_SESSION['ADMIN_USERID'])) {
    http_response_code(401);
    echo json_encode(array("estado" => "Sin autorizacion"));
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

    case 'state':
        updatestate();
        break;
}


function updatestate()
{
    // echo json_encode($_GET);
    $correo = new Correo();
    $correo->ESTADO = $_GET['code'];
    $correo->update($_GET['id']);
    echo json_encode(array("status" => "success", "msge" => "Cambio de estado", "location" => "index.php"));
}


function doInsert()
{
    global $mydb;
    try {

        if ($_POST['ASUNTO'] == "") {
            throw new Exception("El resgitro está vacío", 400);
        }

        $sql = "SELECT * FROM tblcorreo WHERE ASUNTO LIKE '%" . trim($_POST['ASUNTO']) . "%'";
        $mydb->setQuery($sql);
        $cur = $mydb->executeQuery();

        if ($cur->num_rows !== 0) {
            throw new Exception("Ya existe este correo", 400);
        }

        $correo = new Correo();
        $correo->ASUNTO = $_POST['ASUNTO'];
        $correo->CONTENIDO = $_POST['CONTENIDO'];
        $correo->ESTADO = 1; // Cambia el estado a 1 (activo)
        $correo->create();

        http_response_code(200);

        header('Content-Type: application/json');
        echo json_encode(array("status" => "success", "message" => "Registro agregado correctamente"));
    } catch (Exception $e) {
        http_response_code(400);
        header('Content-Type: application/json');
        echo json_encode(array("status" => "error", "message" => $e->getMessage()));
    }
}


function doEdit()
{
    if (isset($_POST['save'])) {

        $correo = new Correo();
        $correo->ASUNTO    = $_POST['ASUNTO'];
        $correo->CONTENIDO = $_POST['CONTENIDO'];

        $correo->update($_GET['id']);

        message("[" . $_POST['CONTENIDO'] . "] has been updated!", "success");
        redirect("index.php");
    }
}

?>