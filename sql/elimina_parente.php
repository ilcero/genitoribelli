<?php

require_once '../classes/SocioParentela.php';

$sp = new SocioParentela();
$sp->setId($_POST["id"]);
$sp->delete();

?>
