<?php
include '../classes/CorsoElemento.php';
require_once '../classes/Utils.php';

//print_r($_POST);

$corso_elm = new CorsoElemento();

$corso_elm->setId($_POST["id"]);

if($corso_elm->delete())
{
    echo'eliminaizone effettuata';
}
else 
{
     echo'errore eliminaizone';
}

?>