<?php
require_once '../classes/Socio.php';
require_once '../classes/Classe.php';
require_once '../classes/CorsoIscrizione.php';

$rows["rows"] = Array();

$socio = Socio::get_all_socio();
$classe = Classe::get_all();
$corso = CorsoIscrizione::get_by_corso_elemento_id($_GET["corso_elemento_id"]);

if($corso != NULL)
{
    $num = 0;
    foreach($corso as $id => $obj)
    {
        $va[0] = $socio[$obj->getSocio_id()]->getCognome();
        $va[1] = $socio[$obj->getSocio_id()]->getNome();
        $va[2] = $classe[$obj->getClasse_id()]->getNome();
        $va[3] = $obj->getData_iscrizione_display();
        $va[4] = $obj->getPagato_display();
        
        $s["id"]=$id;
        $s["data"]=$va;
        $rows["rows"][$num] = $s;
        
        $num++;
    }
}  
echo json_encode($rows);

?>


