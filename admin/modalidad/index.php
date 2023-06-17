<?php
require_once("../../include/initialize.php");

if (!isset($_SESSION['ADMIN_USERID'])) {
    redirect(web_root . "admin/index.php");
}

$view = (isset($_GET['view']) && $_GET['view'] != '') ? $_GET['view'] : '';
$title = "Modalidad | Gandules ";
$header = $view;
switch ($view) {
    case 'list':
        $content    = 'list.php';
        break;

    case 'add':
        $content    = 'add.php';
        break;

    case 'edit':
        $content    = 'edit.php';
        break;

    default:
        $content    = 'list.php';
}
require_once("../theme/template.php");