<?php
include '../classes/Corso.php';
require_once '../classes/Utils.php';

//print_r($_POST);

$corso = new Corso();

$corso->setId($_POST["id"]);

if($corso->delete())
{
    echo'eliminaizone effettuata';
}
else 
{
     echo'errore eliminaizone';
}

?>