<?php
include '../classes/CorsoElemento.php';
require_once '../classes/Utils.php';

//print_r(implode("|",$_POST["giorni_settimana"]));

    $corso_elemento = new CorsoElemento();

    $corso_elemento->setCorso_id($_POST["corso_id"]);
    $corso_elemento->setNome($_POST["nome"]);
    
    if(isset($_POST["prezzo"]) && $_POST["prezzo"] != "")
    {
        $corso_elemento->setPrezzo($_POST["prezzo"]);
    }
    else
    {
        $corso_elemento->setPrezzo(0);
    }
    if(isset($_POST["giorni_settimana"]) && $_POST["giorni_settimana"] != "")
    {
        $corso_elemento->setGiorni_settimana(implode("|",$_POST["giorni_settimana"]));
    }
    else
    {
         $corso_elemento->setGiorni_settimana("");
    }
    $corso_elemento->setData_inizio(Utils::reverse_date($_POST["data_inizio"]));
    $corso_elemento->setData_fine(Utils::reverse_date($_POST["data_fine"]));

    $corso_elemento->setOra_inizio(($_POST["ora_inizio"]));
    $corso_elemento->setOra_fine(($_POST["ora_fine"]));

    if($corso_elemento->insert())
    {
        echo'inserimento';
    }
    else 
    {
         echo'errore inserimento';
    }

?>