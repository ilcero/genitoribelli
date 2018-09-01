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
                
                sociGrid = new dhtmlXGridObject('corsigridbox');
                sociGrid.setImagePath("dhtmlx/skins/skyblue/imgs/");
                sociGrid.setHeader("Nome, Descrizione, Inegnante, Data inizio, Data fine");
                sociGrid.attachHeader("#text_filter,#text_filter,#text_filter,&nbsp;&nbsp;");
                sociGrid.setInitWidths("*,*,*,*,*");
                sociGrid.setColAlign("left,left,left,left,left");
                sociGrid.setColTypes("ro,ro,ro,ro,ro,ro,ro");
                sociGrid.setColSorting("str,str,str,date,date");
                sociGrid.attachEvent("onRowSelect",open_socio_details);
                sociGrid.enableColumnAutoSize(true);
                sociGrid.enableAutoHeight(true);
                sociGrid.setCustomSorting(str_custom,1);
                sociGrid.setCustomSorting(str_custom,2);
                sociGrid.init();
                sociGrid.load("json_data/corsi_all.php","json");
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
<!--                <table id="container" style="width: 100%">
                    <tr>
                        <td style="width:60%"><div id="socigridbox"></div></td>
                        <td style="vertical-align:top"><div id="socigriddetails"></div></td>
                    </tr>
                </table>-->
	</div>
</body>
</html>
