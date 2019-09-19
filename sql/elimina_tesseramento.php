<?php

require_once '../classes/SocioTesseramento.php';

$sp = new SocioTesseramento();
$sp->setId($_POST["id"]);
$sp->delete();

?>
