<?php
include '../classes/Socio.php';

//$rows["rows"] = "";

$socio = Socio::get_all_socio();
if($socio != NULL)
{
    $num = 0;
    foreach($socio as $id => $obj)
    {
        $va[0] = $obj->getNumero_tessera();
        $va[1] = $obj->getNome();
        $va[2] = $obj->getCognome();
        $va[3] = $obj->getCodice_fiscale();
        $va[4] = $obj->getEmail();
        $va[5] = $obj->getTel();
        $va[6] = $obj->getData_nascita_ita();
        
        $s["id"]=$id;
        $s["data"]=$va;
        $rows["rows"][$num] = $s;
        
        
//        $rows["rows"][$num]["id"]["data"] = array();
//        
//        $rows["rows"][$num]["id"]["data"] = 1;
        $num++;
    }
}  
echo json_encode($rows);

//{rows:[
//    { id:1001, 
// data:[
//      "100",
//      "A Time to Kill",
//      "John Grisham",
//      "12.99",
//      "1",
//      "05/01/1998"] }
//      ]
//}
?>


