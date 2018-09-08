<?php

require_once '../classes/CorsoIscrizione.php';


$corso = CorsoIscrizione::get_by_id($_POST["id"]);

if($corso->getPagato() == 0)
{
    $corso->setPagato(1);
}
else
{
    $corso->setPagato(0);
}
$corso->update();