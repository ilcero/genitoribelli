<?php
require_once '../classes/CorsoIscrizione.php';
require_once '../classes/Utils.php';

//print_r($_POST);

$iscrizione = new CorsoIscrizione();

$iscrizione->setClasse_id($_POST["classe_id"]);
$iscrizione->setSocio_id($_POST["socio_id"]);
$iscrizione->setCorso_id($_POST["corso_elemento_id"]);
$iscrizione->setPagato($_POST["pagato"]);
$iscrizione->setData_iscrizione(date("Y-m-d h:m:s"));
$iscrizione->setNote($_POST["note"]);

if($iscrizione->insert())
{
    echo'inserimento effettuato';
}
else 
{
     echo'errore inserimento';
}

?>
