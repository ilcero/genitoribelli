
function doLogin(user, passwd)
{
    var doLogin = new Request.HTML({
        url: 'do_login.php',
            onSuccess: function(tree, elements, html, js) {
                if(html == "ok"){
                    window.location.href = "index.php";
                }
        },
        update: $('test')
    });
    doLogin.post({'user': user, 'passwd': passwd});
}