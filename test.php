<?php
require "include/initialize.php";

$sql = "SELECT o.*, a.* 
FROM tblkeywords o, 
tblocupaciones a 
WHERE o.OCUPACIONID = a.OCUPACIONID 
AND a.OCUPACIONSTATUS = 1 
ORDER BY a.OCUPACIONID, a.OCUPACION";

$mydb->setQuery($sql);
$key = $mydb->loadResultList();

$data = array();
$currentOcupacionID = null;
$currentOcupacion = null;
$currentOcupacionStatus = null;
$currentAreaId = null;
$currentFecha = null;
$datos = array();

foreach ($key as $row) {
    if ($currentOcupacionID !== $row->OCUPACIONID) {
        if ($currentOcupacionID !== null) {
            $obj = new stdClass();
            $obj->OCUPACIONID = $currentOcupacionID;
            $obj->OCUPACION = $currentOcupacion;
            $obj->OCUPACIONSTATUS = $currentOcupacionStatus;
            $obj->AREAID = $currentAreaId;
            $obj->FECHAREGISTRO = $currentFecha;
            $obj->KEYWORDS = $datos;
            $data[] = $obj;
        }

        $currentOcupacionID = $row->OCUPACIONID;
        $currentOcupacion = $row->OCUPACION;
        $currentOcupacionStatus = $row->OCUPACIONSTATUS;
        $currentAreaId = $row->AREAID;
        $currentFecha = $row->FECHAREGISTRO;

        $datos = array();
    }

    $obj = new stdClass();
    $obj->cod_keyword = $row->cod_keyword;
    $obj->keyword = $row->keyword;
    $obj->fecha_registro = $row->fecha_registro;
    $datos[] = $obj;
}

if ($currentOcupacionID !== null) {
    $obj = new stdClass();
    $obj->OCUPACIONID = $currentOcupacionID;
    $obj->OCUPACION = $currentOcupacion;
    $obj->OCUPACIONSTATUS = $currentOcupacionStatus;
    $obj->AREAID = $currentAreaId;
    $obj->FECHAREGISTRO = $currentFecha;
    $obj->KEYWORDS = $datos;
    $data[] = $obj;
}

// Convertir el arreglo a una cadena JSON
// $jsonData = json_encode($data);
echo json_encode($data);

// Imprimir el resultado
// echo $jsonData;
