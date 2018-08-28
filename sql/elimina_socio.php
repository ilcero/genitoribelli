<?php
include '../classes/Socio.php';
require_once '../classes/Utils.php';

//print_r($_POST);

$socio = new Socio();

$socio->setId($_POST["id"]);

if($socio->delete())
{
    echo'eliminaizone effettuata';
}
else 
{
     echo'errore eliminaizone';
}

?>