<?php
    require_once './classes/SocioTesseramento.php';
    
    $tesseramenti = SocioTesseramento::get_by_socio_id($_POST["socio_id"]);
    echo'qui';
    if($tesseramenti != NULL)
    {
        
    }
    else
    {
        echo'NESSUNA ISCRIZIONE ATTIVA';
    }
    
//    $corsi = Corso::get_all_corso();
//    $corsi_elementi = CorsoElemento::get_all_corso_elemento();
//    
//    $corso_iscrizione = CorsoIscrizione::get_by_socio_id_active($_POST["socio_id"]);
//    if($corso_iscrizione != NULL)
//    {
//        echo'<fieldset><legend>ISCRIZIONE AI CORSI:</legend>';
//        foreach ($corso_iscrizione as $key => $obj)
//        {
//            $corso_elm = $corsi_elementi[$obj->getCorso_id()];
//            $corso = $corsi[$corso_elm->getCorso_id()];
//            
//            echo '<div><p class="title">'.$corso->getNome().'</p>';
//            echo '<p class="line">Dal '.$corso_elm->getData_inizio_display().' al '.$corso_elm->getData_fine_display().'</p>';
//            if($obj->getPagato() == 1)
//            {
//                echo '<p class="line">Pagato: <img src="imgs/pagato.png"/></p>';
//            }
//            else
//            {
//                echo '<p class="line">Pagato: <img src="imgs/no_pagato.png"/></p>';
//            }
//            echo'</div><br/>';
//        }
//        echo' </fieldset>';
//    }
//    else
//    {
//        echo'NESSUNA ISCRIZIONE ATTIVA';
//    }
?>

