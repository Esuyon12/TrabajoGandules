
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
}

function doInsert()
{
    global $mydb;
    try {

        foreach ($_POST['keywords'] as $key) {
            if ($key == "") {
                throw new Exception("El resgitro está vacío", 400);
            }
        }

        foreach ($_POST['keywords'] as $key) {
            $sql = "SELECT * FROM tblkeywords WHERE keyword LIKE '%" . trim($key) . "%'";
            $mydb->setQuery($sql);
            $cur = $mydb->executeQuery();

            if ($cur->num_rows !== 0) {
                throw new Exception("Ya existe la palabra clave " . $key, 400);
            }
        }

        foreach ($_POST['keywords'] as $key) {
            @$Keyword = new Keyword();
            @$Keyword->OCUPACIONID  = $_POST['OCUPACIONID'];
            @$Keyword->keyword = $key;
            @$Keyword->create();
        }

        http_response_code(200);

        header('Content-Type: application/json');
        echo json_encode(array("status" => "success", "message" => "Palabra clave agregada correctamente"));
    } catch (Exception $e) {
        http_response_code(400);
        header('Content-Type: application/json');
        echo json_encode(array("status" => "error", "message" => $e->getMessage()));
    }
    die;
}

function doEdit()
{
    $id = $_POST['OCUPACIONID'];
    unset($_POST['OCUPACIONID']);

    try {

        $Keyword = new Keyword();
        $result = @$Keyword->deleteAlls($id);
        // echo $result."<br>";
        foreach ($_POST['keywords'] as $key) {
            @$Keyword = new Keyword();
            @$Keyword->OCUPACIONID = $id;
            @$Keyword->keyword = $key;
            @$Keyword->create();
        }

        if (!$Keyword) {
            throw new Exception("No se añadio", 1);
        }

        echo json_encode(array("status" => "success", "message" => "Proceso Exitoso"));
    } catch (Exception $e) {
        echo json_encode(array("status" => "error", "message" => $e->getMessage()));
    }

    die();
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

        $sql = "DELETE FROM `tblkeywords` WHERE OCUPACIONID =" . $_POST['OCUPACIONID'];

        $area->delete($_GET['id']);

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
