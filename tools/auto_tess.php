<?php

require_once '../classes/Socio.php';
require_once '../classes/SocioTesseramento.php';
$data_inizio = "2018-09-01";
$data_fine = "2019-08-31";

$soci = Socio::get_all_socio();
if($soci != NULL)
{
    foreach($soci as $id => $obj)
    {
        $tess = new SocioTesseramento();
        $tess->setData_inizio($data_inizio);
        $tess->setData_fine($data_fine);
        $tess->setSocio_id($obj->getId());
        $tess->setNote("IMPORTAZIONE AUTOMATICA");
        $tess->insert();
    }
}  
?>
