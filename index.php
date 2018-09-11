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
            var gbMenu, sociGrid;
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
                
                sociGrid = new dhtmlXGridObject('socigridbox');
                sociGrid.setImagePath("dhtmlx/skins/skyblue/imgs/");
                sociGrid.setHeader("Tessera, Nome, Cognome, Codice Fiscale, email, tel, Data nascita");
                sociGrid.attachHeader("#numeric_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,&nbsp;");
                sociGrid.setInitWidths("70,*,*,*,*,*,*");
                sociGrid.setColAlign("center,left,left,left,left,left,left");
                sociGrid.setColTypes("ro,ro,ro,ro,ro,ro,ro");
                sociGrid.setColSorting("int,str,str,str,str,str,date");
                sociGrid.attachEvent("onRowSelect",open_socio_details);
                sociGrid.enableColumnAutoSize(true);
                sociGrid.enableAutoHeight(true, 800, false);
                sociGrid.setCustomSorting(str_custom,1);
                sociGrid.setCustomSorting(str_custom,2);
                sociGrid.init();
                sociGrid.load("json_data/soci_all.php","json");
            }
    </script>
</head>
<body onload="doOnLoad();">
	<div>
            <?php include 'inc/loggeduser.php';?>
            <br/>
            <div id="gbMenu"></div><br/>
            <div id="container">
                <div id="socigridbox"></div>
                <div id="socigriddetails"></div>
                <div style="clear:both;"></div>
            </div>
	</div>
</body>
</html>

