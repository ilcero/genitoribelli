<?Php
    require_once './classes/Socio.php';
?>
<br/>
Grado di parentela <select id="grado_parentela">
    <option value="MADRE">MADRE</option>
    <option value="PADRE">PADRE</option>
    <option value="FRATELLO">FRATELLO</option>
    <option value="SORELLA">SORELLA</option>
</select>

Parente <select id="parente_id">
    <?Php
        $soci = Socio::get_all_socio();
        foreach($soci as $id => $obj)
        {
            echo '<option value="'.$obj->getId().'">'.$obj->getCognomeNome().'</option>';
        }
    ?>
</select> 

<input type="button" value="SALVA" onclick="aggiugni_parente_action(<?Php echo $_POST["socio_id"]; ?>)"/>
<br/><br/>