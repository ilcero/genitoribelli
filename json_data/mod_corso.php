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

$formData[1]["type"] = "fieldset";
$formData[1]["label"] = "Dati";
$formData[1]["inputWidth"] = "500";



$list[0]["type"] = "input";
$list[0]["name"] = "nome";
$list[0]["label"] = "Nome";
$list[0]["value"] = $corso->getNome();
$list[0]["required"] = true;

$list[1]["type"] = "input";
$list[1]["name"] = "descrizione";
$list[1]["label"] = "Descrizione";
$list[1]["value"] = $corso->getDescrizione();
$list[1]["required"] = true;

$list[2]["type"] = "combo";
$list[2]["name"] = "insegnante_id";
$list[2]["label"] = "Insegnante";

$soci = Socio::get_all_socio();
$num = 0;
foreach ($soci as $id => $obj) {
    $inseg[$num]["text"] = $obj->getCognomeNome();
    $inseg[$num]["value"] = "".$id;
    if($corso->getInsegnante_id() == $id)
    {
        $inseg[$num]["selected"] = true;
    }
    $num++;
}

$list[2]["options"] = $inseg;

$list[3]["type"] = "calendar";
$list[3]["dateFormat"] = "%d-%m-%Y";
$list[3]["enableTime"] = "false";
$list[3]["name"] = "data_inizio";
$list[3]["label"] = "Data inizio";
$list[3]["value"] = Utils::reverse_date($corso->getData_inizio());
$list[3]["required"] = true;

$list[4]["type"] = "calendar";
$list[4]["dateFormat"] = "%d-%m-%Y";
$list[4]["enableTime"] = "false";
$list[4]["name"] = "data_fine";
$list[4]["label"] = "Data fine";
$list[4]["value"] = Utils::reverse_date($corso->getData_fine());
$list[4]["required"] = true;

$list[5]["type"] = "editor";
$list[5]["name"] = "note";
$list[5]["label"] = "Note";
$list[5]["inputWidth"] = "300";
$list[5]["inputHeight"] = "180";
$list[5]["value"] = $corso->getNote();

$list[6]["type"] = "block";
$list[6]["blockOffset"] = 0;

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


