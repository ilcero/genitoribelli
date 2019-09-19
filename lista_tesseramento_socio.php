<?php
    require_once './classes/SocioTesseramento.php';
?>
<br/>
<input type="button" value="AGGIUNGI TESSERAMENTO" class="button_aggiungi_fullsize" onclick="aggiugni_tesseramento(<?Php echo $_POST["socio_id"]; ?>)"/>
<br/>
<br/>
<div id="form_aggiunta_tesseramento"></div>
<?Php
    
        $tesseramenti = SocioTesseramento::get_by_socio_id($_POST["socio_id"]);
        
        echo '<table class="table_parentela" cellspacing="0" cellpadding="10">';
        if($tesseramenti != null && $tesseramenti != "")
        {
            foreach($tesseramenti as $id => $obj)
            {
                echo '<tr>';
                echo '<td>Dal <b>'.Utils::reverse_date($obj->getData_inizio()).'</b> al <b>'.Utils::reverse_date($obj->getData_fine()).'</b> (Note: '.$obj->getNote().')</td>';
                echo"<td><input class=\"button_aggiungi\" type=\"button\" onclick=\"elimina_parente_action(".$obj->getId().",".$_POST["socio_id"].")\" value=\"elimina\"/></td>";
                echo '</tr>';
            }
            echo '</table>';
        }
        
        echo '</table>';
        
?>

