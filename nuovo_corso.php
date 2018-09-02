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
                nuovoSocioForm = new dhtmlXForm("nuovoCorsoForm");
                nuovoSocioForm.loadStruct("json_data/nuovo_corso.php", function(){});
                
                nuovoSocioForm.attachEvent("onButtonClick", function(id)
                {
                    var nome = nuovoSocioForm.getItemValue("nome");
                    var descrizione = nuovoSocioForm.getItemValue("descrizione");
                    var insegnante_id = nuovoSocioForm.getItemValue("insegnante_id");
                    var data_inizio = nuovoSocioForm.getItemValue("data_inizio", true);
                    var data_fine = nuovoSocioForm.getItemValue("data_fine", true);
                    var note = nuovoSocioForm.getItemValue("note");

                    if(nome == "" || nome == "undefined")
                    {
                        alert('ATTENZIONE: inserire il nome');
                        return false;
                    }
                    else if(descrizione == "" || descrizione == "undefined")
                    {
                        alert('ATTENZIONE: inserire la descrizione');
                        return false;
                    }
                    else if(insegnante_id == "" || insegnante_id == "undefined")
                    {
                        alert('ATTENZIONE: selezionare l\'insegnante');
                        return false;
                    }
                    else
                    {
                        var insert_corso = new Request.HTML({
                            url: 'sql/insert_corso.php',
                                onSuccess: function(tree, elements, html, js) {
                                    window.location.href = "elenco_corsi.php";
                            }
                        });
                        insert_corso.post({
                            'nome': nome,
                            'descrizione': descrizione,
                            'insegnante_id': insegnante_id,
                            'data_inizio': data_inizio,
                            'data_fine': data_fine, 
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
                <div id="nuovoCorsoForm"></div>
	</div>
</body>
</html>

