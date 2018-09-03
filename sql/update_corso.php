<?php
include '../classes/Corso.php';
require_once '../classes/Utils.php';

//print_r($_POST);

$corso = new Corso();

$corso->setId($_POST["id"]);
$corso->setNome($_POST["nome"]);
$corso->setDescrizione($_POST["descrizione"]);
$corso->setInsegnante_id($_POST["insegnante_id"]);
$corso->setData_inizio(Utils::reverse_date($_POST["data_inizio"]));
$corso->setData_fine(Utils::reverse_date($_POST["data_fine"]));
$corso->setNote($_POST["note"]);

if($corso->update())
{
    echo'<p class="success_message">salvataggio effettuato</p>';
}
else 
{
     echo'<p class="error_message">errore salvataggio</p>';
}

?>