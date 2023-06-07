
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

        if ($_POST['keyword'] == "") {
            throw new Exception("El resgitro está vacío", 400);
        }

        $sql = "SELECT * FROM tblkeywords WHERE keyword LIKE '%" . trim($_POST['keyword']) . "%'";
        $mydb->setQuery($sql);
        $cur = $mydb->executeQuery();

        if ($cur->num_rows !== 0) {
            throw new Exception("Ya existe este Keyword", 400);
        }

        $Keyword = new Keyword();
        $Keyword->keyword = $_POST['keyword'];
        $Keyword->OCUPACIONID  = $_POST['OCUPACIONID'];
        $Keyword->create();

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

        $Keyword = new Keyword();
        $Keyword->OCUPACION  = $_POST['OCUPACION'];
        $Keyword->keyword    = $_POST['keyword'];
        $Keyword->update($_GET['id']);

        message("[" . $_POST['keyword'] . "] has been updated!", "success");
        redirect("index.php");
    }
}

?>