<?php
ini_set ('default_charset', 'iso-8859-15');

require_once INCLUDES . 'facebook/config.php';
require_once INCLUDES . 'configuración/nombre.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title><?php echo $config['HotelName']; ?>:  </title>

<script type="text/javascript">
var andSoItBegins = (new Date()).getTime();
</script>
<link rel="shortcut icon" href="/habboweb/63_1dc60c6d6ea6e089c6893ab4e0541ee0/841/web-gallery/v2/favicon.ico" type="image/vnd.microsoft.icon" />
<link rel="alternate" type="application/rss+xml" title="Habbo: RSS" href="%www%/articles/rss.xml" />
<meta name="csrf-token" content="f8e4363676"/>
<link rel="stylesheet" href="/habboweb/63_1dc60c6d6ea6e089c6893ab4e0541ee0/841/web-gallery/static/styles/common.css" type="text/css" /><script src="/habboweb/63_1dc60c6d6ea6e089c6893ab4e0541ee0/841/web-gallery/static/js/libs2.js" type="text/javascript"></script><script src="/habboweb/63_1dc60c6d6ea6e089c6893ab4e0541ee0/841/web-gallery/static/js/visual.js" type="text/javascript"></script><script src="/habboweb/63_1dc60c6d6ea6e089c6893ab4e0541ee0/841/web-gallery/static/js/libs.js" type="text/javascript"></script><script src="/habboweb/63_1dc60c6d6ea6e089c6893ab4e0541ee0/841/web-gallery/static/js/common.js" type="text/javascript"></script>

<script type="text/javascript">var ad_keywords = "";var ad_key_value = "";</script><script type="text/javascript">
document.habboLoggedIn = false;
var habboName = null;
var habboId = null;
var habboReqPath = "";
var habboStaticFilePath = "/habboweb/63_1dc60c6d6ea6e089c6893ab4e0541ee0/841/web-gallery";
var habboImagerUrl = "http://habbo.es/habbo-imaging/";
var habboPartner = "";
var habboDefaultClientPopupUrl = "%www%/client";
window.name = "05c53de561018bbce7406d849eb2bf090b3e6992";
if (typeof HabboClient != "undefined") {
    HabboClient.windowName = "05c53de561018bbce7406d849eb2bf090b3e6992";
    HabboClient.maximizeWindow = true;
}


</script>

<meta property="fb:app_id" content="157382664122" />

<meta property="og:site_name" content="Habbo Hotel" />
<meta property="og:title" content="Habbo: " />
<meta property="og:url" content="%www%" />
<meta property="og:image" content="%www%/v2/images/facebook/app_habbo_hotel_image.gif" />
<meta property="og:locale" content="es_ES" />

<link rel="stylesheet" href="/habboweb/63_1dc60c6d6ea6e089c6893ab4e0541ee0/841/web-gallery/static/styles/quickregister.css" type="text/css" /><script src="/habboweb/63_1dc60c6d6ea6e089c6893ab4e0541ee0/841/web-gallery/static/js/quickregister.js" type="text/javascript"></script>

<meta name="description" content="Habbo Hotel: haz amig@s, únete a la diversión y date a conocer." />
<meta name="keywords" content="habbo hotel, mundo, virtual, red social, gratis, comunidad, personaje, chat, online, adolescente, roleplaying, unirse, social, grupos, forums, seguro, jugar, juegos, amigos, adolescentes, raros, furni raros, coleccionable, crear, coleccionar, conectar, furni, muebles, mascotas, diseño de salas, compartir, expresión, placas, pasar el rato, música, celebridad, visitas de famosos, celebridades, juegos en línea, juegos multijugador, multijugador masivo" />



<!--[if IE 8]>
<link rel="stylesheet" href="/habboweb/63_1dc60c6d6ea6e089c6893ab4e0541ee0/841/web-gallery/static/styles/ie8.css" type="text/css" /><![endif]-->
<!--[if lt IE 8]>
<link rel="stylesheet" href="/habboweb/63_1dc60c6d6ea6e089c6893ab4e0541ee0/841/web-gallery/static/styles/ie.css" type="text/css" /><![endif]-->
<!--[if lt IE 7]>
<link rel="stylesheet" href="/habboweb/63_1dc60c6d6ea6e089c6893ab4e0541ee0/841/web-gallery/static/styles/ie6.css" type="text/css" /><script src="/habboweb/63_1dc60c6d6ea6e089c6893ab4e0541ee0/841/web-gallery/static/js/pngfix.js" type="text/javascript"></script><script type="text/javascript">
try { document.execCommand('BackgroundImageCache', false, true); } catch(e) {}
</script>

<style type="text/css">
body { behavior: url(/js/csshover.htc); }
</style>
<![endif]-->
<meta name="build" content="63-BUILD1005 - 21.12.2011 12:59 - es" />
</head>

<body id="client" class="background-agegate">
<div id="overlay"></div>
<img src="/habboweb/63_1dc60c6d6ea6e089c6893ab4e0541ee0/841/web-gallery/v2/images/page_loader.gif" style="position:absolute; margin: -1500px;" />
<div id="change-password-form" style="display: none;">    <div id="change-password-form-container" class="clearfix">        <div id="change-password-form-title" class="bottom-border">¿Contraseña olvidada?</div>        <div id="change-password-form-content" style="display: none;">            <form method="post" action="/account/password/identityResetForm" id="forgotten-pw-form">                <input type="hidden" name="page" value="/quickregister/start?changePwd=true" />                <span>Por favor, introduce el email de tu Habbo cuenta:</span>                <div id="email" class="center bottom-border">                    <input type="text" id="change-password-email-address" name="emailAddress" value="" class="email-address" maxlength="48"/>                    <div id="change-password-error-container" class="error" style="display: none;">Por favor, introduce un e-mail</div>                </div>            </form>            <div class="change-password-buttons">                <a href="#" id="change-password-cancel-link">Cancelar</a>                <a href="#" id="change-password-submit-button" class="new-button"><b>Enviar email</b><i></i></a>            </div>        </div>        <div id="change-password-email-sent-notice" style="display: none;">            <div class="bottom-border">                <span>Te hemos enviado un email a tu dirección de correo electrónico con el link que necesitas clicar para cambiar tu contraseña.<br>
<br>

¡NOTA!: Recuerda comprobar también la carpeta de 'Spam'</span>    
            <div id="email-sent-container"></div>            </div>            <div class="change-password-buttons">                <a href="#" id="change-password-change-link">Atrás</a>                <a href="#" id="change-password-success-button" class="new-button"><b>Cerrar</b><i></i></a>            </div>        </div>    </div>    <div id="change-password-form-container-bottom"></div></div><script type="text/javascript">HabboView.add( function() {     ChangePassword.init();});</script>
<div id="stepnumbers">
    <div class="step1focus">Cumpleaños y Género</div>
    <div class="step2">Detalles de la cuenta</div>
    <div class="step3">Comprueba la seguridad</div>
    <div class="stephabbo"></div>
</div>

<div id="main-container">

<noscript><div id="alert-javascript-container">    <div id="alert-javascript-title">        Sin soporte JavaScript    </div>    <div id="alert-javascript-text">        Javascript está deshabilitado en tu navegador. Por favor, permite que haya JavaScript o actualiza tu navegador a una versión con Javascript para poder usar Habbo :)    </div></div></noscript><div id="alert-cookies-container" style="display:none">    <div id="alert-cookies-title">        &quot;Cookies&quot; deshabilitadas    </div>    <div id="alert-cookies-text">        Tu navegador está configurado para no aceptar "cookies". Por favor, habilita el uso de "cookies" para utilizar Habbo.    </div></div><script type="text/javascript">    document.cookie = "habbotestcookie=supported";    var cookiesEnabled = document.cookie.indexOf("habbotestcookie") != -1;    if (cookiesEnabled) {        var date = new Date();        date.setTime(date.getTime()-24*60*60*1000);        document.cookie="habbotestcookie=supported; expires="+date.toGMTString();    } else {        $('alert-cookies-container').show();    }</script>
       <div id="error-placeholder">%errors%</div>
    <form id="quickregisterform" method="post" action="/quickregister/age_gate_submit">

        <h2>Cumpleaños y Género</h2>

        <div id="date-selector">
            <h3>Por favor, introduce una fecha de nacimiento válida</h3>
<select name="bean.day" id="bean_day" class="dateselector"><option value="">Día</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option><option value="31">31</option></select> <select name="bean.month" id="bean_month" class="dateselector"><option value="">Mes</option><option value="1">enero</option><option value="2">febrero</option><option value="3">marzo</option><option value="4">abril</option><option value="5">mayo</option><option value="6">junio</option><option value="7">julio</option><option value="8">agosto</option><option value="9">septiembre</option><option value="10">octubre</option><option value="11">noviembre</option><option value="12">diciembre</option></select> <select name="bean.year" id="bean_year" class="dateselector"><option value="">Año</option><option value="2003">2003</option><option value="2002">2002</option><option value="2001">2001</option><option value="2000">2000</option><option value="1999">1999</option><option value="1998">1998</option><option value="1997">1997</option><option value="1996">1996</option><option value="1995">1995</option><option value="1994">1994</option><option value="1993">1993</option><option value="1992">1992</option><option value="1991">1991</option><option value="1990">1990</option><option value="1989">1989</option><option value="1988">1988</option><option value="1987">1987</option><option value="1986">1986</option><option value="1985">1985</option><option value="1984">1984</option><option value="1983">1983</option><option value="1982">1982</option><option value="1981">1981</option><option value="1980">1980</option><option value="1979">1979</option><option value="1978">1978</option><option value="1977">1977</option><option value="1976">1976</option><option value="1975">1975/option><option value="1974">1974</option><option value="1973">1973</option><option value="1972">1972</option><option value="1971">1971</option><option value="1970">1970</option><option value="1969">1969</option><option value="1968">1968</option><option value="1967">1967</option><option value="1966">1966</option><option value="1965">1965</option><option value="1964">1964</option><option value="1963">1963</option><option value="1962">1962</option><option value="1961">1961</option><option value="1960">1960</option><option value="1959">1959</option><option value="1958">1958</option><option value="1957">1957</option><option value="1956">1956</option><option value="1955">1955</option><option value="1954">1954</option><option value="1953">1953</option><option value="1952">1952</option><option value="1951">1951</option><option value="1950">1950</option><option value="1949">1949</option><option value="1948">1948</option><option value="1947">1947</option><option value="1946">1946</option><option value="1945">1945</option><option value="1944">1944</option><option value="1943">1943</option><option value="1942">1942</option><option value="1941">1941</option><option value="1940">1940</option><option value="1939">1939</option><option value="1938">1938</option><option value="1937">1937</option><option value="1936">1936</option><option value="1935">1935</option><option value="1934">1934</option><option value="1933">1933</option><option value="1932">1932</option><option value="1931">1931</option><option value="1930">1930</option><option value="1929">1929</option><option value="1928">1928</option><option value="1927">1927</option><option value="1926">1926</option><option value="1925">1925</option><option value="1924">1924</option><option value="1923">1923</option><option value="1922">1922</option><option value="1921">1921</option><option value="1920">1920</option><option value="1919">1919</option><option value="1918">1918</option><option value="1917">1917</option><option value="1916">1916</option><option value="1915">1915</option><option value="1914">1914</option><option value="1913">1913</option><option value="1912">1912</option><option value="1911">1911</option><option value="1910">1910</option><option value="1909">1909</option><option value="1908">1908</option><option value="1907">1907</option><option value="1906">1906</option><option value="1905">1905</option><option value="1904">1904</option><option value="1903">1903</option><option value="1902">1902</option><option value="1901">1901</option><option value="1900">1900</option></select>         </div>

        <div class="delimiter_smooth">
            <div class="flat">&nbsp;</div>
            <div class="arrow">&nbsp;</div>
            <div class="flat">&nbsp;</div>
        </div>

        <div id="inner-container">
            <div id="gender-selection">
                <h3>Soy...</h3>
                <input type="hidden" id="avatarGender" name="bean.gender" value=""/>
                <ul id="gender-choices">
                    <li>
                        <span class="bgtop"></span>
                        <span class="bgbottom"></span>
                        <span class="gender-choice">
                            Chico<br/><img alt="male" src="/habboweb/63_1dc60c6d6ea6e089c6893ab4e0541ee0/841/web-gallery/v2/images/registration/male_sign.png" width="36" height="47">
                        </span>
                    </li>
                    <li>
                        <span class="bgtop"></span>
                        <span class="bgbottom"></span>
                        <span class="gender-choice">
                            Chica<br/><img alt="female" src="/habboweb/63_1dc60c6d6ea6e089c6893ab4e0541ee0/841/web-gallery/v2/images/registration/female_sign.png" width="36" height="47">
                        </span>
                    </li>
                </ul>
            </div>
        </div>
    </form>

    <div id="select">
        <a id="back-link" href="/">Atrás</a>
        <div class="button">
            <a id="proceed" href="#" class="area">Continuar</a>
            <span class="close"></span>
        </div>
   </div>
</div>

<script type="text/javascript">
    L10N.put("identity.register.overlay.loading.text", 'Cargando...');
    document.observe("dom:loaded", function() {
        QuickRegister.initAgeGate(true);
        QuickRegister.initGenderChooser("male");
    });
</script>



<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-448325-19']);
  _gaq.push(['_trackPageview']);
  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>
<script type="text/javascript">
    HabboView.run();
</script>

</body>
</html>