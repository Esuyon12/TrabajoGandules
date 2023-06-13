<?php

require_once("include/initialize.php");

global $mydb;

$sql = "SELECT keyword FROM `tblkeywords` WHERE OCUPACIONID = 41";
$mydb->setQuery($sql);
$cur = $mydb->loadResultList();

$keywords = array_column($cur, 'keyword');

echo json_encode($keywords);