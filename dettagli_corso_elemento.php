<?php
require_once './classes/Socio.php';
require_once './classes/CorsoElemento.php';
require_once './classes/Classe.php';
?>
<script>
    
    function str_custom(a,b,order){ 
        return (a.toLowerCase()>b.toLowerCase()?1:-1)*(order=="asc"?1:-1);
    };
    
    iscrittiGridMenu = new dhtmlXMenuObject();
    iscrittiGridMenu.renderAsContextMenu();
    iscrittiGridMenu.attachEvent("onClick",onButtonClick);
    iscrittiGridMenu.loadStruct("./json_data/gridiscritticontextmenu.json");

    function onButtonClick(menuitemId){
            var data=iscrittiGrid.contextID.split("_"); //rowInd_colInd
            var rId = data[0];
            var cInd = data[1];
            switch(menuitemId){
                    case "pagato":
                        change_pagato(rId,<?Php echo $_POST["corso_elemento_id"]; ?>);
                            break;
                    case "elimina":
                        delete_iscrizione(rId,<?Php echo $_POST["corso_elemento_id"]; ?>);
                            break;
            }
    }
    
    iscrittiGrid = new dhtmlXGridObject('elenco_iscritti');
    iscrittiGrid.setImagePath("dhtmlx/skins/skyblue/imgs/");
    iscrittiGrid.setHeader("Cognome,Nome,Classe,Data iscrizione,Pagato");
    iscrittiGrid.attachHeader("#text_filter,#text_filter,#text_filter,&nbsp;,&nbsp;");
    iscrittiGrid.setInitWidths("*,*,*,*,*");
    iscrittiGrid.setColAlign("left,left,left,left,left");
    iscrittiGrid.setColTypes("ro,ro,ro,ro,img");
    iscrittiGrid.setColSorting("str,str,str,date,str");
    iscrittiGrid.enableLightMouseNavigation(true);
    iscrittiGrid.enableColumnAutoSize(true);
    iscrittiGrid.enableAutoHeight(true);
    iscrittiGrid.setCustomSorting(str_custom,0);
    iscrittiGrid.setCustomSorting(str_custom,1);
    iscrittiGrid.enableContextMenu(iscrittiGridMenu);
    iscrittiGrid.init();
    iscrittiGrid.load("json_data/iscritti_corso_elemento.php?corso_elemento_id="+<?Php echo $_POST["corso_elemento_id"]; ?>,"json");
</script>
<div id="container_iscritti">
    <div id="aggiunta_iscritto">
        <?Php
            $corso = CorsoElemento::get_by_id($_POST["corso_elemento_id"]);
            echo'<select id="socio_id">';
            $soci = Socio::get_solo_attivo($corso->data_inizio);
            foreach ($soci as $key => $value) {
                echo'<option value="'.$value->getId().'">'.$value->getCognomeNome().'</option>';
            }
            echo'</select>&nbsp;&nbsp;';
            echo'<select id="classe_id">';
            $classi = Classe::get_all();
            foreach ($classi as $key => $value) {
                echo'<option value="'.$value->getId().'">'.$value->getNome().'</option>';
            }
            echo'</select>';
        ?>
        &nbsp;<input type="checkbox" id="pagato"/> Pagato
        &nbsp;<input type="button" class="button_aggiungi" value="ISCRIVI" onclick="iscrivi_socio(<?Php echo $_POST["corso_elemento_id"]; ?>)"/>
        &nbsp;<input type="button" class="button_aggiungi" value="REPORT" onclick="do_report_iscritti(<?Php echo $_POST["corso_elemento_id"]; ?>)"/>
    </div><br/><br/>
    <div id="elenco_iscritti"></div>
</div>
