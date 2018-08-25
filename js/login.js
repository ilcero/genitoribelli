
function doLogin(user, passwd)
{
    var doLogin = new Request.HTML({
        url: 'do_login.php',
            onSuccess: function(tree, elements, html, js) {
                if(html == "ok"){
                    window.location.href = "index.php";
                }
                else
                {
//                    var message = new Element('p', {
//                        'class' : 'auth_failed',
//                        'html' : 'AUTENTICAZIONE FALLITA'
//                    }).inject($('auth_failed'));
                    $('auth_failed').set('html','<p class=\"auth_failed\">AUTENTICAZIONE FALLITA</p>');
                }
                
        }
    });
    doLogin.post({'user': user, 'passwd': passwd});
}