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
                sociGrid = new dhtmlXGridObject('socigridbox');
                sociGrid.setImagePath("dhtmlx/skins/web/imgs/");
                sociGrid.setHeader("Tessera, Nome, Cognome, Codice Fiscale, email, tel, Data nascita");
                sociGrid.attachHeader("&nbsp;,#text_filter,#text_filter,&nbsp;,&nbsp;,&nbsp;,&nbsp;");
                sociGrid.setInitWidths("70,*,*,*,*,*,*");
                sociGrid.setColAlign("center,left,left,left,left,left,left");
                sociGrid.setColTypes("ro,ro,ro,ro,ro,ro,ro");
                sociGrid.setColSorting("int,str,str,str,str,str,str");
                sociGrid.attachEvent("onRowSelect",doOnRowSelect);
                sociGrid.init();
                sociGrid.load("json_data/soci_all.php","json");
            }
            function doOnRowSelect(id){
//                alert(id);
            }
    </script>
</head>
<body onload="doOnLoad();">
	<div>
            <div class="logged_user"><?php echo ' '.$_SESSION["nome"]." ".$_SESSION["cognome"]?> | <a href="logout.php">esci</a></div>
            <br/>
            <div id="gbMenu"></div><br/>
            <div id="socigridbox"></div>
	</div>
</body>
</html>

