
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

