
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

