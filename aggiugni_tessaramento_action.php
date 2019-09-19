<?php

require_once './classes/SocioTesseramento.php';

$tess = new SocioTesseramento();
$tess->setSocio_id($_POST["socio_id"]);
$tess->setData_inizio(Utils::reverse_date($_POST["data_inizio"]));
$tess->setData_fine(Utils::reverse_date($_POST["data_fine"]));
$tess->setNote($_POST["note"]);
$tess->insert();

?>
