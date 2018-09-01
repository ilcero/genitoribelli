<?php
include '../classes/Corso.php';
require_once '../classes/Utils.php';

//print_r($_POST);

$corso = new Corso();

$corso->setNome($_POST["nome"]);
$corso->setDescrizione($_POST["descrizione"]);
$corso->setInsegnante_id($_POST["insegnante_id"]);
$corso->setData_inizio(Utils::reverse_date($_POST["data_inizio"]));
$corso->setData_fine(Utils::reverse_date($_POST["data_fine"]));
print_r($corso);
if($corso->insert())
{
    echo'inserimento effettuato';
}
else 
{
     echo'errore inserimento';
}

?>