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
    $area = new Area();
    $area->ESTADO = $_GET['code'];
    $area->update($_GET['id']);
    echo json_encode(array("status" => "success", "msge" => "Cambio de estado", "location" => "index.php"));
}

function doInsert()
{
    global $mydb;
    try {

        if ($_POST['AREA'] == "") {
            throw new Exception("La categoría está vacía", 1);
        }

        $sql = "SELECT * FROM tblareas WHERE AREA LIKE '%" . trim($_POST['AREA']) . "%'";
        $mydb->setQuery($sql);
        $cur = $mydb->executeQuery();

        // print_r($cur);
        // die();

        if ($cur->num_rows !== 0) {
            throw new Exception("Ya existe este registro", 1);
        }

        $area = new Area();
        $area->AREA = $_POST['AREA'];
        $area->ESTADO = 1; // Cambia el estado a 1 (activo)
        $area->create();

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

        $area = new Area();
        $area->AREA = $_POST['AREA'];
        $area->update($_GET['id']);

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
        $area = new Area();
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
