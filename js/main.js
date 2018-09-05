
function open_socio_details(id)
{
    var open_socio_details = new Request.HTML({
        url: 'soci_grid_details.php',
        update: $('socigriddetails'),
            onSuccess: function(tree, elements, html, js) {
                
        }
    });
    open_socio_details.post({'id': id});
}
function refreshSociGrid()
{
//    alert(sociGrid);
    sociGrid.clearAll()
    sociGrid.load("json_data/soci_all.php","json");
}
function refreshCorsiGrid()
{
//    alert(sociGrid);
    corsiGrid.clearAll()
    corsiGrid.load("json_data/corsi_all.php","json");
}

function menu_go_to(id)
{
    if(id == "elenco_soci")
    {
        window.location.href = "index.php";
    }
    else if(id == "nuovo_socio")
    {
        window.location.href = "nuovo_socio.php";
    }
    else if(id == "elenco_corsi")
    {
        window.location.href = "elenco_corsi.php";
    }
    else if(id == "nuovo_corso")
    {
        window.location.href = "nuovo_corso.php";
    }
}

function load_parentela(socio_id)
{
//    alert('load_parentela')
    var load_parentela = new Request.HTML({
        url: 'parentela.php',
        update: $('modSocioParentela'),
            onSuccess: function(tree, elements, html, js) {
//                alert('success');
        }
    });
    load_parentela.post({'socio_id': socio_id});
}

function aggiugni_parente(socio_id)
{
    var load_parentela = new Request.HTML({
        url: 'form_aggiunta_parente.php',
        update: $('form_aggiunta_parente'),
            onSuccess: function(tree, elements, html, js) {
//                alert('success');
        }
    });
    load_parentela.post({'socio_id': socio_id});
}
function aggiugni_parente_action(socio_id)
{
    var parente_id =  parenteCombo.getSelectedValue();
    var grado_parentela = parentelaCombo.getSelectedValue();
    
    
    if(parente_id == "" || parente_id == "undefined")
    {
        alert("ATTENZIONE: scegliere il parente");
        return false;
    }
    else if(grado_parentela == "" || grado_parentela == "undefined")
    {
        alert("ATTENZIONE: scegliere il grado di parentela");
        return false;
    }
    else
    {
        var aggiugni_parente_action = new Request.HTML({
            url: 'aggiugni_parente_action.php',
                onSuccess: function(tree, elements, html, js) {
                    load_parentela(socio_id);
            }
        });
        aggiugni_parente_action.post({'socio_id': socio_id, 'parente_id' : parente_id, 'grado_parentela' : grado_parentela});
    }
}

function elimina_parente_action(id, socio_id)
{
//    alert(id)
    if(confirm("ATTENZIONE: sicuro di voler procedere con l'eliminazione?"))
    {
        var elimina_parente_action = new Request.HTML({
            url: 'sql/elimina_parente.php',
                onSuccess: function(tree, elements, html, js) {
                    load_parentela(socio_id);
            }
        });
        elimina_parente_action.post({'id': id});
    }
}

function open_corso_details(id)
{
    var open_corso_details = new Request.HTML({
        url: 'corso_grid_details.php',
        update: $('corsigriddetails'),
            onSuccess: function(tree, elements, html, js) {
                
        }
    });
    open_corso_details.post({'id': id});
}

function load_mod_corso(corso_id)
{
    var load_mod_corso = new Request.HTML({
        url: 'corso_mod_form.php',
        update: $('modCorsoForm'),
            onSuccess: function(tree, elements, html, js) {
//                alert('succ')
        }
    });
    load_mod_corso.post({'corso_id': corso_id});
}

function load_elenco_elementi(corso_id)
{
    var load_elenco_elementi = new Request.HTML({
        url: 'corso_elenco_elementi.php',
        update: $('modEdizioni'),
            onSuccess: function(tree, elements, html, js) {
//                alert('succ')
        }
    });
    load_elenco_elementi.post({'corso_id': corso_id});
}

function add_corso_elemento_win(corso_id)
{
//    alert(corso_id)
    var dhxWins = new dhtmlXWindows("pippo");
    var corso_elemento_win = dhxWins.createWindow("cew", 20, 30, 600, 600);
    corso_elemento_win.setText("Nuova edizione");
    corso_elemento_win.setModal(true);
    dhxWins.window("cew").centerOnScreen();
    
    var corso_elemento_form = corso_elemento_win.attachForm();
    corso_elemento_form.loadStruct("json_data/insert_corso_elemento.php?id="+corso_id, function(){});
    corso_elemento_form.attachEvent("onXLE", function(){
        cal = corso_elemento_form.getCalendar("ora_inizio");
        cal.attachEvent("onShow", function(){
                this.contDates.style.display="none";
                this.contDays.style.display="none";
                this.contMonth.style.display="none";
        });
        cal2 = corso_elemento_form.getCalendar("ora_fine");
        cal2.attachEvent("onShow", function(){
                this.contDates.style.display="none";
                this.contDays.style.display="none";
                this.contMonth.style.display="none";
        });
        
        combo = corso_elemento_form.getCombo("giorni_settimana");
        combo.allowFreeText(true);
        combo.readonly(true);
        combo.setComboText("");

        combo.attachEvent("onCheck", function(value, state)
        {
            var txt = "";
            combo.getChecked().forEach(function(value, index, array)
            {
//                alert(value)
                switch(value) {
                    case "0":
                        txt = txt+" LU";
                        break;
                    case "1":
                        txt = txt+" MA";
                        break;
                    case "2":
                        txt = txt+" ME";
                        break;
                    case "3":
                        txt = txt+" GI";
                        break;
                    case "4":
                        txt = txt+" VE";
                        break;
                    case "5":
                        txt = txt+" SA";
                        break;
                    case "6":
                        txt = txt+" DO";
                        break;
                } 
            });
            combo.setComboText(txt);
            combo.openSelect();
        });
        
    });
     
    corso_elemento_form.attachEvent("onButtonClick", function(name)
    {
        if(name == "salva")
        {
            var nome = corso_elemento_form.getItemValue("nome");
            var data_inizio = corso_elemento_form.getItemValue("data_inizio", true);
            var data_fine = corso_elemento_form.getItemValue("data_fine", true);
            var ora_inizio = corso_elemento_form.getItemValue("ora_inizio", true);
            var ora_fine = corso_elemento_form.getItemValue("ora_fine", true);
            var ora_fine = corso_elemento_form.getItemValue("ora_fine", true);
            var giorni_settimana = corso_elemento_form.getCombo("giorni_settimana").getChecked();
            var prezzo = corso_elemento_form.getItemValue("prezzo");
            var note = corso_elemento_form.getItemValue("note");

            if(nome == "" || nome == "undefined")
            {
                alert("ATTENZIONE: inserire il nome");
                return false;
            }
            else if(data_inizio == "" || data_inizio == "undefined")
            {
                alert("ATTENZIONE: inserire la data di inizio");
                return false;
            }
            else if(data_fine == "" || data_fine == "undefined")
            {
                alert("ATTENZIONE: inserire la data di fine");
                return false;
            }
            else if(ora_inizio == "" || ora_inizio == "undefined")
            {
                alert("ATTENZIONE: inserire l'ora di inizio");
                return false;
            }
            else if(ora_fine == "" || ora_fine == "undefined")
            {
                alert("ATTENZIONE: inserire l'ora di fine");
                return false;
            }
            else
            {
                var insert_corso_elemento = new Request.HTML({
                    url: 'sql/insert_corso_elemento.php',
                    update: $('corsogriddetails'),
                        onSuccess: function(tree, elements, html, js) {
                            dhxWins.window("cew").close();
                            load_elenco_elementi(corso_id);
                    }
                });
                insert_corso_elemento.post({
                    'corso_id': corso_id,
                    'nome': nome,
                    'data_inizio': data_inizio,
                    'data_fine': data_fine,
                    'ora_inizio': ora_inizio,
                    'ora_fine': ora_fine,
                    'giorni_settimana': giorni_settimana,
                    'prezzo': prezzo,
                    'note': note
                });
            }
        }
        else if(name == "elimina")
        {
            alert('elimina')
//            if(confirm("Sicuro di voler procedere con l'eliminaizone?"))
//            {
//                var elimina_socio = new Request.HTML({
//                    url: 'sql/elimina_corso.php',
//                    update: $('corsogriddetails'),
//                        onSuccess: function(tree, elements, html, js) {
//                            window.location.href = "elenco_corsi.php";
//                    }
//                });
//                elimina_socio.post({'id': '<?php echo $_POST["corso_id"] ?>'});
//            }
        }
    });
    
}
function del_corso_elemento(id, corso_id)
{
    if(confirm("Sicuro di voler procedere con l'eliminaizone?"))
    {
        var del_corso_elemento = new Request.HTML({
            url: 'sql/elimina_corso_elemento.php',
            update: $('corsogriddetails'),
                onSuccess: function(tree, elements, html, js) {
                    load_elenco_elementi(corso_id);
            }
        });
        del_corso_elemento.post({'id': id});
    }
}

function dettagli_corso_elemento(corso_elemento_id)
{
    var dhxWins = new dhtmlXWindows();
    var dettagli_corso_elemento_win = dhxWins.createWindow("cew", 20, 30, 800, 600);
    dettagli_corso_elemento_win.setText("Dettagli");
    dettagli_corso_elemento_win.setModal(true);
    dhxWins.window("cew").centerOnScreen();
    
    dettagli_corso_elemento_win.attachURL("dettagli_corso_elemento.php", true, {corso_elemento_id:corso_elemento_id});
}