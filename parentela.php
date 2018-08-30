<?Php
    require_once './classes/Socio.php';
    require_once './classes/SocioParentela.php';
?>
<input type="button" value="AGGIUNGI PARENTE" onclick="aggiugni_parente(<?Php echo $_POST["socio_id"]; ?>)"/>
<div id="form_aggiunta_parente"></div>
<?Php
    
        $socio_parentela = SocioParentela::get_by_socio($_POST["socio_id"]);

        if($socio_parentela != null && $socio_parentela != "")
        {
            echo '<table>';
            foreach($socio_parentela as $id => $obj)
            {
                $socio = Socio::get_by_id($obj->getParente_id());
                if($socio != null && $socio != "")
                {
                    echo '<tr><td>'.$obj->getParentela()."</td><td>".$socio->getCognomeNome()."</td></tr>";
                }
            }
            echo '</table>';
        }
        
        $socio_parentela = SocioParentela::get_by_parente($_POST["socio_id"]);

        if($socio_parentela != null && $socio_parentela != "")
        {
            echo '<table>';
            foreach($socio_parentela as $id => $obj)
            {
                $socio = Socio::get_by_id($obj->getSocio_id());
                if($socio != null && $socio != "")
                {
                    echo '<tr><td>'.$obj->getParentela()." di </td><td>".$socio->getCognomeNome()."</td></tr>";
                }
            }
            echo '</table>';
        }
        
        
?>