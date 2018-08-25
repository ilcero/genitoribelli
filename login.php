<!DOCTYPE html>
<html>
    <head>
        <script src="js/mootools.js"></script>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
	<link rel="stylesheet" type="text/css" href="css/login.css"/>
	<link rel="stylesheet" type="text/css" href="dhtmlx/codebase/fonts/font_roboto/roboto.css"/>
	<link rel="stylesheet" type="text/css" href="dhtmlx/codebase/dhtmlx.css"/>
	<script src="dhtmlx/codebase/dhtmlx.js"></script>
	<script src="js/login.js"></script>
	
	<script>
            var loginForm, formData;
            function doOnLoad() {
                formData = [
                    {type: "settings", position: "label-left", labelWidth: 130, inputWidth: 120},
                    {type: "fieldset", label: "Autenticazione", inputWidth: 340, list:[
                        {type: "input", name: "user", label: "Username", value: "root"},
                        {type: "password", name: "passwd", label: "Password", value: "pass"},
                        {type: "button", value: "ACCEDI"}
                    ]}
                ];
                loginForm = new dhtmlXForm("loginForm", formData);
                loginForm.attachEvent("onButtonClick", function(id){

                    if (loginForm.getItemValue("user")== "" || loginForm.getItemValue("user")== "undefined") //defines addition
                        { alert("Inserire username")}
                    else if ((loginForm.getItemValue("passwd")== "" || loginForm.getItemValue("passwd")== "undefined")) //defines addition
                        { alert("Inserire password")}
                    else
                    {
                        doLogin(loginForm.getItemValue("user"),loginForm.getItemValue("passwd"));
                    }
                })
            }
	</script>
        
        
    </head>
    <body onload="doOnLoad();">
        <div class="main_login">
            <div id="loginForm" style="height:550px;"></div>
        </div>
	<div id="test">11111</div>
</body>
</html>