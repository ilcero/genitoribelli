<br/>
<table class="form_aggiunta_parente">
<tr>
    <td style="text-align:right;width:120px;">Data inizio</td>
    <td><input type="text" id="data_inizio" style="width: 200px;" readonly/></td>
</tr>
<tr>
    <td style="text-align:right;width:120px;">Data fine</td>
    <td><input type="text" id="data_fine" style="width: 200px;" readonly/></td>
</tr>
<tr>
    <td style="text-align:right;width:120px;">Note</td>
    <td><textarea id="note" style="width: 200px;"/></textarea></td>
</tr>
<tr><td></td><td><input type="button" class="button_aggiungi" value="SALVA" onclick="aggiugni_tessaramento_action(<?Php echo $_POST["socio_id"]; ?>)"/></td></tr>
</table>
<br/>

<script>
var myCalendar = new dhtmlXCalendarObject(["data_inizio","data_fine"]);
myCalendar.setDateFormat("%d-%m-%Y");

</script>