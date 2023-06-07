
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
    $indi = new Indicaciones();
    $indi->ESTADO = $_GET['code'];
    $indi->update($_GET['id']);
    echo json_encode(array("status" => "success", "msge" => "Cambio de estado", "location" => "index.php"));
}

function doInsert()
{
    global $mydb;
    try {

        if ($_POST['DESCRIPCION'] == "") {
            throw new Exception("El resgitro está vacío", 400);
        }

        $sql = "SELECT * FROM tblindicacioneseva WHERE DESCRIPCION LIKE '%" . trim($_POST['DESCRIPCION']) . "%'";
        $mydb->setQuery($sql);
        $cur = $mydb->executeQuery();

        if ($cur->num_rows !== 0) {
            throw new Exception("Ya existe este Keyword", 400);
        }

        $indi = new Indicaciones();
        $indi->DESCRIPCION = $_POST['DESCRIPCION'];
        $indi->ESTADO = 1; // Cambia el estado a 1 (activo)
        $indi->create();

        http_response_code(200);

        header('Content-Type: application/json');
        echo json_encode(array("status" => "success", "message" => "Indicación agregada correctamente"));
    } catch (Exception $e) {
        http_response_code(400);
        header('Content-Type: application/json');
        echo json_encode(array("status" => "error", "message" => $e->getMessage()));
    }
}


function doEdit()
{
    if (isset($_POST['save'])) {

        $indi = new Indicaciones();
        $indi->DESCRIPCION    = $_POST['DESCRIPCION'];
        $indi->update($_GET['id']);

        message("[" . $_POST['DESCRIPCION'] . "] has been updated!", "success");
        redirect("index.php");
    }
}

?>