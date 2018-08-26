<?php

//echo $_POST["id"];

?>


<div id="modSocioForm"></div>

<script>
    var modSocioForm = new dhtmlXForm("modSocioForm");
    
    modSocioForm.loadStruct("json_data/mod_socio.php?id="+<?php echo $_POST["id"] ?>, function(){});
</script>