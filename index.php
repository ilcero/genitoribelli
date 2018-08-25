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
	<link rel="stylesheet" type="text/css" href="css/login.css"/>
	<link rel="stylesheet" type="text/css" href="dhtmlx/codebase/fonts/font_roboto/roboto.css"/>
	<link rel="stylesheet" type="text/css" href="dhtmlx/codebase/dhtmlx.css"/>
	<script src="dhtmlx/codebase/dhtmlx.js"></script>
        <script>
            var gbMenu;
            function doOnLoad() {
                gbMenu = new dhtmlXMenuObject({
                    parent: "gbMenu",
                    icons_path: "dhtmlx/common_menu/imgs/",
                    json: "dhtmlx/common_menu/dhxmenu.json",
                    onload: function() {
                            // callback
                    }
                });
            }
    </script>
</head>
<body onload="doOnLoad();">
	<div>
            <?php echo ' '.$_SESSION["nome"]." ".$_SESSION["cognome"]?>
            <br/>
            <br/>
            <div id="gbMenu"></div>
	</div>
</body>
</html>

