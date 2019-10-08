<?php
include 'inc/header.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title>.:GenitoriBelli:.</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <script src="js/mootools.js"></script>
        <script src="js/main.js"></script>
	<link rel="stylesheet" type="text/css" href="css/main.css"/>
	<link rel="stylesheet" type="text/css" href="dhtmlx/codebase/fonts/font_roboto/roboto.css"/>
	<!--<link rel="stylesheet" type="text/css" href="dhtmlx/codebase/dhtmlx.css"/>-->
	<link rel="stylesheet" type="text/css" href="dhtmlx/skins/material/dhtmlx.css"/>
	<script src="dhtmlx/codebase/dhtmlx.js"></script>
        <script>
            var gbMenu, nuovoSocioForm;
            function doOnLoad() {
                gbMenu = new dhtmlXMenuObject({
                    parent: "gbMenu",
                    icons_path: "dhtmlx/common_menu/imgs/",
                    json: "json_data/dhxmenu.json",
                    onload: function() {
                            // callback
                    }
                });
                
                gbMenu.attachEvent("onClick", function(id, zoneId, cas){
                    menu_go_to(id);
                });
                nuovoSocioForm = new dhtmlXForm("nuovoSocioForm");
                nuovoSocioForm.loadStruct("json_data/nuovo_socio.php", function(){});
                
                nuovoSocioForm.attachEvent("onButtonClick", function(id)
                {
                    var nome = nuovoSocioForm.getItemValue("nome");
                    var cognome = nuovoSocioForm.getItemValue("cognome");
                    var codice_fiscale = nuovoSocioForm.getItemValue("codice_fiscale");
                    var email = nuovoSocioForm.getItemValue("email");
                    var tel = nuovoSocioForm.getItemValue("tel");
                    var data_nascita = nuovoSocioForm.getItemValue("data_nascita", true);
                    var inizio_tessera = nuovoSocioForm.getItemValue("inizio_tessera", true);
                    var fine_tessera = nuovoSocioForm.getItemValue("fine_tessera", true);
                    var note = nuovoSocioForm.getItemValue("note");

                    if(nome == "" || nome == "undefined")
                    {
                        alert('ATTENZIONE: inserire il nome');
                        return false;
                    }
                    else if(cognome == "" || cognome == "undefined")
                    {
                        alert('ATTENZIONE: inserire il cognome');
                        return false;
                    }
                    else if(data_nascita == "" || data_nascita == "undefined")
                    {
                        alert('ATTENZIONE: inserire la data di nascita');
                        return false;
                    }
                    else if(inizio_tessera == "" || inizio_tessera == "undefined")
                    {
                        alert('ATTENZIONE: inserire la data di inizio tessera');
                        return false;
                    }
                    else if(fine_tessera == "" || fine_tessera == "undefined")
                    {
                        alert('ATTENZIONE: inserire la data di fine tessera');
                        return false;
                    }
                    else
                    {
                        var update_socio = new Request.HTML({
                            url: 'sql/insert_socio.php',
                                onSuccess: function(tree, elements, html, js) {
                                    window.location.href = "index.php";
                            }
                        });
                        update_socio.post({
                            'nome': nome,
                            'cognome': cognome,
                            'codice_fiscale': codice_fiscale,
                            'email': email,
                            'tel': tel,
                            'data_nascita': data_nascita,
                            'inizio_tessera': inizio_tessera,
                            'fine_tessera': fine_tessera,
                            'note': note

                        });
                    }
                })
            }
    </script>
</head>
<body onload="doOnLoad();">
	<div>
            <?php include 'inc/loggeduser.php';?>
            <br/>
                <div id="gbMenu"></div><br/>
                <br/>
                <div id="nuovoSocioForm"></div>
	</div>
</body>
</html>

