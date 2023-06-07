
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
    $ocupacion = new Ocupacion();
    $ocupacion->OCUPACIONSTATUS = $_GET['code'];
    $ocupacion->update($_GET['id']);
    echo json_encode(array("status" => "success", "msge" => "Cambio de estado", "location" => "index.php"));
}

function doInsert()
{
    global $mydb;
    try {

        if ($_POST['OCUPACION'] == "") {
            throw new Exception("La ocupación está vacía", 400);
        }

        $sql = "SELECT * FROM tblocupaciones WHERE OCUPACION LIKE '%" . trim($_POST['OCUPACION']) . "%'";
        $mydb->setQuery($sql);
        $cur = $mydb->executeQuery();

        if ($cur->num_rows !== 0) {
            throw new Exception("Ya existe esta ocupación", 400);
        }

        $ocupacion = new Ocupacion();
        $ocupacion->OCUPACION = $_POST['OCUPACION'];
        $ocupacion->AREAID = $_POST['AREAID'];
        $ocupacion->OCUPACIONSTATUS = 1; // Cambia el estado a 1 (activo)
        $ocupacion->create();

        http_response_code(200);

        header('Content-Type: application/json');
        echo json_encode(array("status" => "success", "message" => "Ocupación agregada correctamente"));
    } catch (Exception $e) {
        http_response_code(400);
        header('Content-Type: application/json');
        echo json_encode(array("status" => "error", "message" => $e->getMessage()));
    }
}



function doEdit()
{
    if (isset($_POST['save'])) {

        $ocupacion = new Ocupacion();
        $ocupacion->OCUPACION    = $_POST['OCUPACION'];
        $ocupacion->AREAID    = $_POST['AREAID'];
        $ocupacion->update($_GET['id']);

        message("[" . $_POST['OCUPACION'] . "] has been updated!", "success");
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
        $ocupacion = new Ocupacion();
        $ocupacion->OCUPACIONSTATUS = 0; //0 ES A INACTIVO

        $ocupacion->update($_GET['id']);

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