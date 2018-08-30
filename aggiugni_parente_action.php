<?php

require_once './classes/SocioParentela.php';

$sp = new SocioParentela();
$sp->setParente_id($_POST["parente_id"]);
$sp->setSocio_id($_POST["socio_id"]);
$sp->setParentela($_POST["grado_parentela"]);
$sp->insert();

?>
