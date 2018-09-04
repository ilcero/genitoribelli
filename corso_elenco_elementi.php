<?php
require_once './classes/CorsoElemento.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of corso_elenco_elementi
 *
 * @author andrea
 */

?>
<div id="lista_corso_elemento">

    <input type="button" class="button_aggiungi_fullsize" value="aggiungi edizione" onclick="add_corso_elemento_win(<?php echo $_POST["corso_id"] ?>)"/>
    <?Php
        $corso_elementi = CorsoElemento::get_by_corso_id($_POST["corso_id"]);
        if($corso_elementi != NULL)
        {
            foreach ($corso_elementi as $id => $obj)
            {
                echo'<p><b>'.$obj->getNome().'</b> <em>dal '.$obj->getData_inizio_display().' al '.$obj->getData_fine_display().'</em></p>';
                $gg_sett = "";
                $num = 0;
                foreach(explode("|", $obj->getGiorni_settimana())as $inx => $gg)
                {
                    if($num > 0)
                        echo ' - ';
                    echo Utils::getGGFromInt($gg);
                    $num++;
                }
                echo'<br/>';
                echo $obj->getOra_inizio().' - '.$obj->getOra_fine();
            }
        }
    ?>
</div>
<script></script>
