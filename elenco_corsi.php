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
            var gbMenu, corsiGrid;
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
                
                function str_custom(a,b,order){ 
                    return (a.toLowerCase()>b.toLowerCase()?1:-1)*(order=="asc"?1:-1);
                };
                
                corsiGrid = new dhtmlXGridObject('corsigridbox');
                corsiGrid.setImagePath("dhtmlx/skins/skyblue/imgs/");
                corsiGrid.setHeader("Nome, Descrizione, Inegnante, Data inizio, Data fine, Note");
                corsiGrid.attachHeader("#text_filter,#text_filter,#text_filter,&nbsp;,&nbsp;,&nbsp;");
                corsiGrid.setInitWidths("*,*,*,*,*,*");
                corsiGrid.setColAlign("left,left,left,left,left,left");
                corsiGrid.setColTypes("ro,ro,ro,ro,ro,ro,ro,ro");
                corsiGrid.setColSorting("str,str,str,date,date,str");
                corsiGrid.attachEvent("onRowSelect",open_corso_details);
                corsiGrid.enableColumnAutoSize(true);
                corsiGrid.enableAutoHeight(true);
                corsiGrid.setCustomSorting(str_custom,1);
                corsiGrid.setCustomSorting(str_custom,2);
                corsiGrid.init();
                corsiGrid.load("json_data/corsi_all.php","json");
            }
    </script>
</head>
<body onload="doOnLoad();">
	<div>
            <?php include 'inc/loggeduser.php';?>
            <br/>
            <div id="gbMenu"></div><br/>
            <div id="container">
                <div id="corsigridbox"></div>
                <div id="corsigriddetails"></div>
                <div style="clear:both;"></div>
            </div>
	</div>
</body>
</html>

