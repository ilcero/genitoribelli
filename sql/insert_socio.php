<?php
include '../classes/Socio.php';
include '../classes/SocioTesseramento.php';
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
    $tess = new SocioTesseramento();
    $tess->setSocio_id($socio->getId());
    $tess->setData_inizio(Utils::reverse_date($_POST["inizio_tessera"]));
    $tess->setData_fine(Utils::reverse_date($_POST["fine_tessera"]));
    if($tess->insert())
    {
        echo'inserimento effettuato';
    }
    else 
    {
         echo'errore inserimento tesseramento';
    }
}
else 
{
     echo'errore inserimento';
}

?>