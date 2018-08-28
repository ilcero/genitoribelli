<?php
include '../classes/Socio.php';
require_once '../classes/Utils.php';

//print_r($_POST);

$socio = new Socio();

$socio->setNome($_POST["nome"]);
$socio->setCognome($_POST["cognome"]);
$socio->setCodice_fiscale($_POST["codice_fiscale"]);
$socio->setEmail($_POST["email"]);
$socio->setTel($_POST["tel"]);
$socio->setNote($_POST["note"]);
$socio->setData_nascita(Utils::reverse_date($_POST["data_nascita"]));

if($socio->insert())
{
    echo'inserimento effettuato';
}
else 
{
     echo'errore inserimento';
}

?>