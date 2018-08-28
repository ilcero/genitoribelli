
<div id="modSocioForm"></div>

<script>
    var modSocioForm = new dhtmlXForm("modSocioForm");
    
    modSocioForm.loadStruct("json_data/mod_socio.php?id="+<?php echo $_POST["id"] ?>, function(){});
    modSocioForm.attachEvent("onButtonClick", function(id)
    {
        var nome = modSocioForm.getItemValue("nome");
        var cognome = modSocioForm.getItemValue("cognome");
        var codice_fiscale = modSocioForm.getItemValue("codice_fiscale");
        var email = modSocioForm.getItemValue("email");
        var tel = modSocioForm.getItemValue("tel");
        var data_nascita = modSocioForm.getItemValue("data_nascita", true);
        
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
                'data_nascita': data_nascita

            });
        }
    })
</script>