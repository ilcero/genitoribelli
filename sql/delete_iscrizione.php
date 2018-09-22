<?php

require_once '../classes/CorsoIscrizione.php';


$corsoIscr = CorsoIscrizione::get_by_id($_POST["id"]);

$corsoIscr->delete();