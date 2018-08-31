
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

function menu_go_to(id)
{
    if(id == "elenco")
    {
        window.location.href = "index.php";
    }
    else if(id == "nuovo")
    {
        window.location.href = "nuovo_socio.php";
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
    var elimina_parente_action = new Request.HTML({
        url: 'sql/elimina_parente.php',
            onSuccess: function(tree, elements, html, js) {
                load_parentela(socio_id);
        }
    });
    elimina_parente_action.post({'id': id});
}
