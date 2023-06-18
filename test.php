<?php
function reemplazarTexto($cadena, $patron, $reemplazo)
{
    $patron = "/" . $patron . ".*?&/";
    $nueva_cadena = preg_replace($patron, $reemplazo, $cadena);
    return $nueva_cadena;
}

$cadena = "localhost/index.php?pepe=papa&fecha=asc&num=4321";
echo $cadena . "<br>";
$patron = "&fecha=";
$reemplazo = "&fecha=durmio&";

$nueva_cadena = reemplazarTexto($cadena, $patron, $reemplazo);
echo $nueva_cadena;
