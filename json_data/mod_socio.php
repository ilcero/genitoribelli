<?php

//echo $_GET["id"];
$formData[0]["type"] = "fieldset";
$formData[0]["label"] = "Modifica socio";
$formData[0]["inputWidth"] = "340";

$list[0]["type"] = "input";
$list[0]["name"] = "nome";
$list[0]["label"] = "Nome";
$list[0]["value"] = $_GET["id"];

$formData[0]["list"] = $list;

echo json_encode($formData);

//                    {type: "settings", position: "label-left", labelWidth: 130, inputWidth: 120},
//                    {type: "fieldset", label: "Autenticazione", inputWidth: 340, list:[
//                        {type: "input", name: "user", label: "Username", value: "root"},
//                        {type: "password", name: "passwd", label: "Password", value: "root"},
//                        {type: "button", value: "ACCEDI"}
//                    ]}
//                ];
?>


