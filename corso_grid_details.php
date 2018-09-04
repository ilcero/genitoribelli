<?Php 
    require_once './classes/Corso.php';
?>

<div id="my_tabbar" style="width:100%; height:600px;"></div>
<div id="modEdizioni"></div>
<div id="modCorsoForm"></div>

<script>
    
    myTabbar = new dhtmlXTabBar("my_tabbar");
			
    myTabbar.addTab("a1", "Edizioni", null, null, true);
    myTabbar.addTab("a2", "Modifica corso");

    myTabbar.tabs("a1").attachObject("modEdizioni");
    myTabbar.tabs("a2").attachObject("modCorsoForm");
    
    myTabbar.attachEvent("onTabClick", function(idClicked, idSelected){
        if(idClicked == "a2")
        {
            load_mod_corso(<?php echo $_POST["id"] ?>);
        }
        else if(idClicked == "a1")
        {
            load_elenco_elementi(<?php echo $_POST["id"] ?>);
        }
    });
    
    load_elenco_elementi(<?php echo $_POST["id"] ?>);

</script>