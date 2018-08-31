<?Php
    require_once './classes/Socio.php';
?>
<br/>
<table class="form_aggiunta_parente">
<tr><td style="text-align:right;width:120px;">Grado parentela</td><td><select id="grado_parentela">
    <option value="MADRE">MADRE</option>
    <option value="PADRE">PADRE</option>
    <option value="FRATELLO">FRATELLO</option>
    <option value="SORELLA">SORELLA</option>
</select></td></tr>

<tr><td style="text-align:right;width:120px;">Parente</td><td><select id="parente_id">
    <?Php
        $soci = Socio::get_all_socio();
        foreach($soci as $id => $obj)
        {
            echo '<option value="'.$obj->getId().'">'.$obj->getCognomeNome().'</option>';
        }
    ?>
</select> 
</td></tr>
<tr><td></td><td><input type="button" class="button_aggiungi" value="SALVA" onclick="aggiugni_parente_action(<?Php echo $_POST["socio_id"]; ?>)"/></td></tr>
</table>
<br/>