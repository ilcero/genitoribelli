<?php
include '../classes/socio.php';


$formData[0]["type"] = "settings";
$formData[0]["position"] = "label-left";
$formData[0]["labelWidth"] = "130";
$formData[0]["inputWidth"] = "250";

$formData[1]["type"] = "fieldset";
$formData[1]["label"] = "Nuovo socio";
$formData[1]["inputWidth"] = "500";



$list[0]["type"] = "input";
$list[0]["name"] = "nome";
$list[0]["label"] = "Nome";
$list[0]["value"] = "";
$list[0]["required"] = true;

$list[1]["type"] = "input";
$list[1]["name"] = "cognome";
$list[1]["label"] = "Cognome";
$list[1]["value"] = "";
$list[1]["required"] = true;

$list[2]["type"] = "input";
$list[2]["name"] = "codice_fiscale";
$list[2]["label"] = "Codice fiscale";
$list[2]["value"] = "";
//$list[2]["required"] = true;

$list[3]["type"] = "input";
$list[3]["name"] = "email";
$list[3]["label"] = "Email";
$list[3]["value"] = "";
//$list[3]["required"] = true;

$list[4]["type"] = "input";
$list[4]["name"] = "tel";
$list[4]["label"] = "Tel";
$list[4]["value"] = "";
//$list[4]["required"] = true;

$list[5]["type"] = "calendar";
$list[5]["dateFormat"] = "%d-%m-%Y";
$list[5]["enableTime"] = "false";
$list[5]["name"] = "data_nascita";
$list[5]["label"] = "Data di nascita";
$list[5]["value"] = "";
$list[5]["required"] = true;

$list[6]["type"] = "editor";
$list[6]["name"] = "note";
$list[6]["label"] = "Note";
$list[6]["inputWidth"] = "300";
$list[6]["inputHeight"] = "150";
$list[6]["value"] = "";

$list[7]["type"] = "button";
$list[7]["label"] = "salva";
$list[7]["value"] = "salva";

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


