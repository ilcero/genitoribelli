<?php
require_once '../classes/Socio.php';
require_once '../classes/Corso.php';

//$rows["rows"] = "";

$socio = Socio::get_all_socio();
$corso = Corso::get_all_corso();

if($corso != NULL)
{
    $num = 0;
    foreach($corso as $id => $obj)
    {
        $va[0] = $obj->getNome();
        $va[1] = $obj->getDescrizione();
        $va[2] = $socio[$obj->getInsegnante_id()]->getCognomeNome();
        $va[3] = Utils::reverse_date($obj->getData_inizio());
        $va[4] = Utils::reverse_date($obj->getData_fine());
        $va[5] = $obj->getNote();
        
        $s["id"]=$id;
        $s["data"]=$va;
        $rows["rows"][$num] = $s;
        
        $num++;
    }
}  
echo json_encode($rows);

?>


