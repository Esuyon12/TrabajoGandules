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

    case 'update':
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
    $contrato = new Contrato();
    $contrato->ESTADO = $_GET['code'];
    $contrato->update($_GET['id']);
    echo json_encode(array("status" => "success", "msge" => "Cambio de estado", "location" => "index.php"));
}

function doInsert()
{
    global $mydb;
    try {

        if ($_POST['TIPOCONTRATO'] == "") {
            throw new Exception("La categoría está vacía", 1);
        }

        $sql = "SELECT * FROM tbltipocontrato WHERE TIPOCONTRATO LIKE '%" . trim($_POST['TIPOCONTRATO']) . "%'";
        $mydb->setQuery($sql);
        $cur = $mydb->executeQuery();

        // print_r($cur);
        // die();

        if ($cur->num_rows !== 0) {
            throw new Exception("Ya existe este registro", 1);
        }

        $contrato = new Contrato();
        $contrato->TIPOCONTRATO = $_POST['TIPOCONTRATO'];
        $contrato->CONTENIDO = $_POST['CONTENIDO'];
        $contrato->ESTADO = 1; // Cambia el estado a 1 (activo)
        $contrato->create();

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
    $cod = $_POST['TCONTRATOID'];
    unset($_POST['TCONTRATOID']);

    try {
        $contrato = new Contrato();

        foreach ($_POST as $key => $value) {
            $contrato->$key = $value;
        }

        $contrato->update($cod);
        echo json_encode(array("status" => "success", "message" => "Se actualizo"));
    } catch (Exception $e) {
        echo json_encode(array("status" => "error", "message" => $e->getMessage()));
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
        $tcontrato = new Tcontrato();
        $tcontrato->ESTADO = 0; //0 ES A INACTIVO

        $tcontrato->update($_GET['id']);


        http_response_code(200);

        header('Content-Type: application/json');
        echo json_encode(array("status" => "success", "message" => "Se elimino correctamente"));
    } catch (Exception $e) {
        http_response_code(400);
        header('Content-Type: application/json');
        echo json_encode(array("status" => "error", "message" => $e->getMessage()));
    }
}
