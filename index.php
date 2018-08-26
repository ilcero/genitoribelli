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
	<link rel="stylesheet" type="text/css" href="dhtmlx/skins/web/dhtmlx.css"/>
	<script src="dhtmlx/codebase/dhtmlx.js"></script>
        <script>
            var gbMenu, sociGrid;
            function doOnLoad() {
                gbMenu = new dhtmlXMenuObject({
                    parent: "gbMenu",
                    icons_path: "dhtmlx/common_menu/imgs/",
                    json: "dhtmlx/common_menu/dhxmenu.json",
                    onload: function() {
                            // callback
                    }
                });
                
                gbMenu.attachEvent("onClick", function(id, zoneId, cas){
                    if(id == "elenco")
                    {
                        window.location.href = "index.php";
                    }
                });
                
                sociGrid = new dhtmlXGridObject('socigridbox');
                sociGrid.setImagePath("dhtmlx/skins/web/imgs/");
                sociGrid.setHeader("Tessera, Nome, Cognome, Codice Fiscale, email, tel, Data nascita");
                sociGrid.attachHeader("&nbsp;,#text_filter,#text_filter,&nbsp;,&nbsp;,&nbsp;,&nbsp;");
                sociGrid.setInitWidths("70,*,*,*,*,*,*");
                sociGrid.setColAlign("center,left,left,left,left,left,left");
                sociGrid.setColTypes("ro,ro,ro,ro,ro,ro,ro");
                sociGrid.setColSorting("int,str,str,str,str,str,str");
                sociGrid.attachEvent("onRowSelect",open_socio_details);
                sociGrid.init();
                sociGrid.load("json_data/soci_all.php","json");
            }
    </script>
</head>
<body onload="doOnLoad();">
	<div>
            <div class="logged_user"><?php echo ' '.$_SESSION["nome"]." ".$_SESSION["cognome"]?> | <a href="logout.php">esci</a></div>
            <br/>
                <div id="gbMenu"></div><br/>
                <table id="container" style="width: 100%">
                    <tr>
                        <td style="width:60%"><div id="socigridbox"></div></td>
                        <td style="vertical-align:top"><div id="socigriddetails">wwww</div></td>
                    </tr>
                </table>
	</div>
</body>
</html>

