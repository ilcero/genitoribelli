<?php
include '../classes/Socio.php';
//echo $_GET["id"];

$socio = Socio::get_by_id($_GET["id"]);

//type: "settings", position: "label-left", labelWidth: 130, inputWidth: 120},

$formData[0]["type"] = "settings";
$formData[0]["position"] = "label-left";
$formData[0]["labelWidth"] = "130";
$formData[0]["inputWidth"] = "250";

$formData[1]["type"] = "fieldset";
$formData[1]["label"] = "Dati";
$formData[1]["inputWidth"] = "500";



$list[0]["type"] = "input";
$list[0]["name"] = "nome";
$list[0]["label"] = "Nome";
$list[0]["value"] = $socio->getNome();
$list[0]["required"] = true;

$list[1]["type"] = "input";
$list[1]["name"] = "cognome";
$list[1]["label"] = "Cognome";
$list[1]["value"] = $socio->getCognome();
$list[1]["required"] = true;

$list[2]["type"] = "input";
$list[2]["name"] = "codice_fiscale";
$list[2]["label"] = "Codice fiscale";
$list[2]["value"] = $socio->getCodice_fiscale();
//$list[2]["required"] = true;

$list[3]["type"] = "input";
$list[3]["name"] = "email";
$list[3]["label"] = "Email";
$list[3]["value"] = $socio->getEmail();
//$list[3]["required"] = true;

$list[4]["type"] = "input";
$list[4]["name"] = "tel";
$list[4]["label"] = "Tel";
$list[4]["value"] = $socio->getTel();
//$list[4]["required"] = true;

$list[5]["type"] = "calendar";
$list[5]["dateFormat"] = "%d-%m-%Y";
$list[5]["enableTime"] = "false";
$list[5]["name"] = "data_nascita";
$list[5]["label"] = "Data di nascita";
$list[5]["value"] = Utils::reverse_date($socio->getData_nascita());
$list[5]["required"] = true;

$list[6]["type"] = "editor";
$list[6]["name"] = "note";
$list[6]["label"] = "Note";
$list[6]["inputWidth"] = "300";
$list[6]["inputHeight"] = "180";
$list[6]["value"] = $socio->getNote();

$list[7]["type"] = "block";
$list[7]["blockOffset"] = 0;

$listbtn[0]["type"] = "button";
$listbtn[0]["label"] = "salva";
$listbtn[0]["value"] = "salva";
$listbtn[0]["name"] = "salva";

$listbtn[1]["type"] = "newcolumn";

$listbtn[2]["type"] = "button";
$listbtn[2]["label"] = "elimina";
$listbtn[2]["value"] = "elimina";
$listbtn[2]["name"] = "elimina";

$list[6]["list"] = $listbtn;

$formData[1]["list"] = $list;

echo json_encode($formData);

?>


