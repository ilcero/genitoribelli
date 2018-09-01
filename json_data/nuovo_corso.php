<?php
require_once '../classes/socio.php';


$formData[0]["type"] = "settings";
$formData[0]["position"] = "label-left";
$formData[0]["labelWidth"] = "130";
$formData[0]["inputWidth"] = "250";

$formData[1]["type"] = "fieldset";
$formData[1]["label"] = "Nuovo corso";
$formData[1]["inputWidth"] = "500";



$list[0]["type"] = "input";
$list[0]["name"] = "nome";
$list[0]["label"] = "Nome";
$list[0]["value"] = "";
$list[0]["required"] = true;

$list[1]["type"] = "input";
$list[1]["name"] = "descrizione";
$list[1]["label"] = "Descrizione";
$list[1]["value"] = "";
$list[1]["required"] = true;

$list[2]["type"] = "combo";
$list[2]["name"] = "insegnante_id";
$list[2]["label"] = "Insegnante";

$soci = Socio::get_all_socio();
$num = 0;
foreach ($soci as $id => $obj) {
    $inseg[$num]["text"] = $obj->getCognomeNome();
    $inseg[$num]["value"] = "".$id;
    $num++;
}

$list[2]["options"] = $inseg;
//$list[2]["required"] = true;

//{type: "combo", label: "Format", name: "format", comboType: "checkbox", options:[
//					{text: "AAC", value: "AAC"},
//					{text: "AC3", value: "AC3", checked: true, selected: true},
//					{text: "MP3", value: "MP3", checked: true},
//					{text: "FLAC", value: "FLAC"}
//				]},

$list[3]["type"] = "calendar";
$list[3]["dateFormat"] = "%d-%m-%Y";
$list[3]["enableTime"] = "false";
$list[3]["name"] = "data_inizio";
$list[3]["label"] = "Data inizio";
$list[3]["value"] = "";
$list[3]["required"] = true;

$list[4]["type"] = "calendar";
$list[4]["dateFormat"] = "%d-%m-%Y";
$list[4]["enableTime"] = "false";
$list[4]["name"] = "data_fine";
$list[4]["label"] = "Data fine";
$list[4]["value"] = "";
$list[4]["required"] = true;

$list[5]["type"] = "button";
$list[5]["label"] = "salva";
$list[5]["value"] = "salva";

$formData[1]["list"] = $list;


//s



echo json_encode($formData);

//                    {type: "settings", position: "label-left", labelWidth: 130, inputWidth: 120},
//                    {type: "fieldset", label: "Autenticazione", inputWidth: 340, list:[
//                        {type: "input", name: "user", label: "Username", value: "root"},
//                        {type: "password", name: "passwd", label: "Password", value: "root"},
//                        {type: "button", value: "ACCEDI"}
//                    ]}
//                ];
?>


