<?php
include '../classes/Corso.php';
include '../classes/socio.php';
//echo $_GET["id"];

$corso = Corso::get_by_id($_GET["id"]);

//type: "settings", position: "label-left", labelWidth: 130, inputWidth: 120},

$formData[0]["type"] = "settings";
$formData[0]["position"] = "label-left";
$formData[0]["labelWidth"] = "130";
$formData[0]["inputWidth"] = "250";

$formData[1]["type"] = "label";
$formData[1]["label"] = "";
//$formData[1]["inputWidth"] = "600";



$list[0]["type"] = "input";
$list[0]["name"] = "nome";
$list[0]["label"] = "Nome";
$list[0]["value"] = "";
$list[0]["required"] = true;

$list[1]["type"] = "calendar";
$list[1]["dateFormat"] = "%d-%m-%Y";
$list[1]["enableTime"] = "false";
$list[1]["name"] = "data_inizio";
$list[1]["label"] = "Data inizio";
$list[1]["value"] = "";
$list[1]["required"] = true;

$list[2]["type"] = "calendar";
$list[2]["dateFormat"] = "%d-%m-%Y";
$list[2]["enableTime"] = "false";
$list[2]["name"] = "data_fine";
$list[2]["label"] = "Data fine";
$list[2]["value"] = "";
$list[2]["required"] = true;

$list[3]["type"] = "input";
$list[3]["name"] = "prezzo";
$list[3]["label"] = "Prezzo";
$list[3]["value"] = "";

$list[4]["type"] = "calendar";
$list[4]["dateFormat"] = "%H:%i";
$list[4]["enableTime"] = "true";
$list[4]["name"] = "ora_inizio";
$list[4]["label"] = "Ora inizio";
$list[4]["value"] = "00:00";
$list[4]["required"] = true;

$list[5]["type"] = "calendar";
$list[5]["dateFormat"] = "%H:%i";
$list[5]["enableTime"] = "true";
$list[5]["name"] = "ora_fine";
$list[5]["label"] = "Ora fine";
$list[5]["value"] = "00:00";
$list[5]["required"] = true;

$gg_sett[0]["text"] = "LUNEDI";
$gg_sett[0]["value"] = "0";
$gg_sett[1]["text"] = "MARTEDI";
$gg_sett[1]["value"] = "1";
$gg_sett[2]["text"] = "MERCOLEDI";
$gg_sett[2]["value"] = "2";
$gg_sett[3]["text"] = "GIOVEDI";
$gg_sett[3]["value"] = "3";
$gg_sett[4]["text"] = "VENERDI";
$gg_sett[4]["value"] = "4";
$gg_sett[5]["text"] = "SABATO";
$gg_sett[5]["value"] = "5";
$gg_sett[6]["text"] = "DOMENICA";
$gg_sett[6]["value"] = "6";

$list[6]["type"] = "combo";
$list[6]["comboType"] = "checkbox";
$list[6]["name"] = "giorni_settimana";
$list[6]["label"] = "Giorni della settimana";
$list[6]["value"] = NULL;
$list[6]["required"] = true;
$list[6]["options"] = $gg_sett;

$list[7]["type"] = "editor";
$list[7]["name"] = "note";
$list[7]["label"] = "Note";
$list[7]["inputWidth"] = "300";
$list[7]["inputHeight"] = "180";

$list[8]["type"] = "block";
$list[8]["blockOffset"] = 0;

$listbtn[0]["type"] = "button";
$listbtn[0]["label"] = "salva";
$listbtn[0]["value"] = "salva";
$listbtn[0]["name"] = "salva";

$listbtn[1]["type"] = "newcolumn";

$listbtn[2]["type"] = "button";
$listbtn[2]["label"] = "elimina";
$listbtn[2]["value"] = "elimina";
$listbtn[2]["name"] = "elimina";

$list[7]["list"] = $listbtn;

$formData[1]["list"] = $list;

echo json_encode($formData);

?>


