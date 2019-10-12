<?php
include 'inc/header.php';
include 'classes/Classe.php';
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
                    json: "json_data/dhxmenu.json",
                    onload: function() {
                            // callback
                    }
                });
                
                gbMenu.attachEvent("onClick", function(id, zoneId, cas){
                    menu_go_to(id);
                });
                
                var myCalendar = new dhtmlXCalendarObject(
                    {input:"period",button:"calendar_icon"}
                );
            }
    </script>
</head>
<body onload="doOnLoad();">
	<div>
            <?php include 'inc/loggeduser.php';?>
            <br/>
            <div id="gbMenu"></div><br/>
            <div id="container">
                Classe: <select id="classe_id">
                <?Php
                    $classi = Classe::get_all();
                    foreach ($classi as $classe_id => $classe) {
                        echo'<option value="'.$classe_id.'">'.$classe->getNome().'</option>';
                    }
                ?>
                </select>
                &nbsp;&nbsp;
                Periodo: <input type="text" id="period" readonly>
                <span>
                    <img id="calendar_icon" src="./imgs/calendar.png" border="0">
                </span>
                <input type="button" value="genera excel" onclick="do_report_partecipanti_classe()"/>
            </div>
            <div id="report"></div>
	</div>
</body>
</html>

