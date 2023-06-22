<?php

//Definir las rutas principales
//Definirlos como valores absolutos para asegurarse de que require_once funcione como se esperaba

//DIRECTORY_SEPARATOR es una constante predefinida de PHP:
//(\ para windows, / para Unix)
date_default_timezone_set('America/Lima');

define('ROOT_PATH', __DIR__);
defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);

if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
    defined('url') ? null : define('url', "https://");
    defined('SITE_ROOT') ? null : define('SITE_ROOT', $_SERVER['DOCUMENT_ROOT'] . DS . '');
} else {
    if ($_SERVER['SERVER_NAME'] == 'localhost') {
        defined('SITE_ROOT') ? null : define('SITE_ROOT', $_SERVER['DOCUMENT_ROOT'] . DS . 'TrabajoGandules');
    } else {
        defined('SITE_ROOT') ? null : define('SITE_ROOT', $_SERVER['DOCUMENT_ROOT'] . DS . '');
    }
    defined('url') ? null : define('url', "http://");
}

defined('LIB_PATH') ? null : define('LIB_PATH', SITE_ROOT . DS . 'include');

defined('URL_WEB') ? null : define('URL_WEB', url . $_SERVER['HTTP_HOST']);
// echo "<pre>";
// print_r(get_defined_constants(true)['user']); die();

//Carga primero la configuración de la base de datos.require_once(LIB_PATH. DS ."config.php");
require_once(LIB_PATH . DS . "function.php");
require_once(LIB_PATH . DS . "session.php");
require_once(LIB_PATH . DS . "accounts.php");
require_once(LIB_PATH . DS . "autonumbers.php");
require_once(LIB_PATH . DS . "companies.php");
require_once(LIB_PATH . DS . "job.php");
require_once(LIB_PATH . DS . "employees.php");
require_once(LIB_PATH . DS . "categories.php");
require_once(LIB_PATH . DS . "applicant.php");
require_once(LIB_PATH . DS . "jobregistration.php");


require_once(LIB_PATH . DS . '../vendor/autoload.php');

require_once(LIB_PATH . DS . "database.php");

$messageVac = updateAllsVacancy(); 
