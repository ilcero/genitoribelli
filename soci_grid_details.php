<?Php 
    require_once './classes/Socio.php';
    require_once './classes/SocioParentela.php';
?>

<div id="my_tabbar" style="width:100%; height:600px;"></div>
<div id="modSocioForm"></div>
<div id="modSocioParentela">
    
</div>


<script>
    
    myTabbar = new dhtmlXTabBar("my_tabbar");
			
    myTabbar.addTab("a1", "Modifica socio", null, null, true);
    myTabbar.addTab("a2", "Parentela");

    myTabbar.tabs("a1").attachObject("modSocioForm");
    myTabbar.tabs("a2").attachObject("modSocioParentela");
    
    myTabbar.attachEvent("onTabClick", function(idClicked, idSelected){
        if(idClicked == "a2")
        {
            load_parentela(<?php echo $_POST["id"] ?>);
        }
    });

    var modSocioForm = new dhtmlXForm("modSocioForm");
    
    modSocioForm.loadStruct("json_data/mod_socio.php?id="+<?php echo $_POST["id"] ?>, function(){});
    modSocioForm.attachEvent("onButtonClick", function(name)
    {
        if(name == "salva")
        {
            var nome = modSocioForm.getItemValue("nome");
            var cognome = modSocioForm.getItemValue("cognome");
            var codice_fiscale = modSocioForm.getItemValue("codice_fiscale");
            var email = modSocioForm.getItemValue("email");
            var tel = modSocioForm.getItemValue("tel");
            var data_nascita = modSocioForm.getItemValue("data_nascita", true);
            var note = modSocioForm.getItemValue("note");

            if(nome == "" || nome == "undefined")
            {
                alert('ATTENZIONE: inserire il nome');
                return false;
            }
            else if(cognome == "" || cognome == "undefined")
            {
                alert('ATTENZIONE: inserire il cognome');
                return false;
            }
            else if(data_nascita == "" || data_nascita == "undefined")
            {
                alert('ATTENZIONE: inserire la data di nascita');
                return false;
            }
            else
            {
                var update_socio = new Request.HTML({
                    url: 'sql/update_socio.php',
                    update: $('socigriddetails'),
                        onSuccess: function(tree, elements, html, js) {
                            refreshSociGrid();
                    }
                });
                update_socio.post({
                    'id': '<?php echo $_POST["id"] ?>',
                    'nome': nome,
                    'cognome': cognome,
                    'codice_fiscale': codice_fiscale,
                    'email': email,
                    'tel': tel,
                    'data_nascita': data_nascita,
                    'note': note
                });
            }
        }
        else if(name == "elimina")
        {
            if(confirm("Sicuro di voler procedere con l'eliminaizone?"))
            {
                var elimina_socio = new Request.HTML({
                    url: 'sql/elimina_socio.php',
                    update: $('socigriddetails'),
                        onSuccess: function(tree, elements, html, js) {
                            refreshSociGrid();
                    }
                });
                elimina_socio.post({'id': '<?php echo $_POST["id"] ?>'});
            }
        }
    })
</script>