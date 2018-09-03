
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