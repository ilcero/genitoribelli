<?Php 
    require_once './classes/Corso.php';
?>

<div id="modCorsoFormReal"></div>

<script>
    
    var modCorsoForm = new dhtmlXForm("modCorsoFormReal");
    
    modCorsoForm.loadStruct("json_data/mod_corso.php?id="+<?php echo $_POST["corso_id"]; ?>, function(){});
    modCorsoForm.attachEvent("onButtonClick", function(name)
    {
        if(name == "salva")
        {
            var nome = modCorsoForm.getItemValue("nome");
            var descrizione = modCorsoForm.getItemValue("descrizione");
            var insegnante_id = modCorsoForm.getItemValue("insegnante_id");
            var data_inizio = modCorsoForm.getItemValue("data_inizio", true);
            var data_fine = modCorsoForm.getItemValue("data_fine", true);
            var note = modCorsoForm.getItemValue("note");

            if(nome == "" || nome == "undefined")
            {
                alert('ATTENZIONE: inserire il nome');
                return false;
            }
            else if(insegnante_id == "" || insegnante_id == "undefined")
            {
                alert('ATTENZIONE: selezionare l'linsegnante);
                return false;
            }
            else if(data_inizio == "" || data_inizio == "undefined")
            {
                alert('ATTENZIONE: inserire la data di inizio');
                return false;
            }
            else if(data_fine == "" || data_fine == "undefined")
            {
                alert('ATTENZIONE: inserire la data di fine');
                return false;
            }
            else
            {
                var update_socio = new Request.HTML({
                    url: 'sql/update_corso.php',
                    update: $('corsogriddetails'),
                        onSuccess: function(tree, elements, html, js) {
                            refreshCorsiGrid();
                    }
                });
                update_socio.post({
                    'id': '<?php echo $_POST["corso_id"] ?>',
                    'nome': nome,
                    'descrizione': descrizione,
                    'insegnante_id': insegnante_id,
                    'data_inizio': data_inizio,
                    'data_fine': data_fine,
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
                elimina_socio.post({'id': '<?php echo $_POST["corso_id"] ?>'});
            }
        }
    });
</script>