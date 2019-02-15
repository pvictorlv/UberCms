<?php
ini_set ('default_charset', 'iso-8859-15');

require_once INCLUDES . 'configuración/nombre.php';

function getGallery()
{
	$web = file_get_contents('http://www.habbo.com');
	$buffer = explode('var habboStaticFilePath = "', $web);
	
	foreach ($buffer as $data)
	{
		$temp = explode('";', $data);
	}
	
	return $temp[0];
}

if(empty($_SESSION['web_gallery']))
{
	$_SESSION['web_gallery'] = getGallery();
}

$gallery = $_SESSION['web_gallery'];
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title><?php echo $config['HotelName']; ?>:  </title>

<script type="text/javascript">
var andSoItBegins = (new Date()).getTime();
</script>
<link rel="shortcut icon" href="http://www.habbo.es<?php echo $gallery; ?>/v2/favicon.ico" type="image/vnd.microsoft.icon" />
<link rel="alternate" type="application/rss+xml" title="Habbo: RSS" href="http://www.habbo.es/articles/rss.xml" />
<meta name="csrf-token" content="3e81b3c649"/>
<link rel="stylesheet" href="<?php echo $gallery; ?>/static/styles/common.css" type="text/css" />
<script src="<?php echo $gallery; ?>/static/js/libs2.js" type="text/javascript"></script>
<script src="<?php echo $gallery; ?>/static/js/visual.js" type="text/javascript"></script>
<script src="<?php echo $gallery; ?>/static/js/libs.js" type="text/javascript"></script>
<script src="<?php echo $gallery; ?>/static/js/common.js" type="text/javascript"></script>


<script type="text/javascript">
var ad_keywords = "";
var ad_key_value = "";
</script>
<script type="text/javascript">
document.habboLoggedIn = false;
var habboName = null;
var habboId = null;
var habboReqPath = "";
var habboStaticFilePath = "<?php echo $gallery; ?>";
var habboImagerUrl = "http://www.habbo.es/habbo-imaging/";
var habboPartner = "";
var habboDefaultClientPopupUrl = "http://www.habbo.es/client";
window.name = "36296fe8ae552967edf66c5e1af7a3b894f02995";
if (typeof HabboClient != "undefined") {
    HabboClient.windowName = "36296fe8ae552967edf66c5e1af7a3b894f02995";
    HabboClient.maximizeWindow = true;
}


</script>

<meta property="fb:app_id" content="157382664122" />

<meta property="og:site_name" content="Habbo Hotel" />
<meta property="og:title" content="Habbo: " />
<meta property="og:url" content="http://www.habbo.es" />
<meta property="og:image" content="http://www.habbo.es/v2/images/facebook/app_habbo_hotel_image.gif" />
<meta property="og:locale" content="es_ES" />

<link rel="stylesheet" href="<?php echo $gallery; ?>/static/styles/quickregister.css" type="text/css" />
<script src="<?php echo $gallery; ?>/static/js/quickregister.js" type="text/javascript"></script>
    <script type="text/javascript" src="https://www.google.com/recaptcha/api/js/recaptcha_ajax.js"></script>

<meta name="description" content="Habbo Hotel: haz amig@s, únete a la diversión y date a conocer." />
<meta name="keywords" content="habbo hotel, mundo, virtual, red social, gratis, comunidad, personaje, chat, online, adolescente, roleplaying, unirse, social, grupos, forums, seguro, jugar, juegos, amigos, adolescentes, raros, furni raros, coleccionable, crear, coleccionar, conectar, furni, muebles, mascotas, diseño de salas, compartir, expresión, placas, pasar el rato, música, celebridad, visitas de famosos, celebridades, juegos en línea, juegos multijugador, multijugador masivo" />



<!--[if IE 8]>
<link rel="stylesheet" href="<?php echo $gallery; ?>/static/styles/ie8.css" type="text/css" />
<![endif]-->
<!--[if lt IE 8]>
<link rel="stylesheet" href="<?php echo $gallery; ?>/static/styles/ie.css" type="text/css" />
<![endif]-->
<!--[if lt IE 7]>
<link rel="stylesheet" href="<?php echo $gallery; ?>/static/styles/ie6.css" type="text/css" />
<script src="<?php echo $gallery; ?>/static/js/pngfix.js" type="text/javascript"></script>
<script type="text/javascript">
try { document.execCommand('BackgroundImageCache', false, true); } catch(e) {}
</script>

<style type="text/css">
body { behavior: url(/js/csshover.htc); }
</style>
<![endif]-->
<meta name="build" content="63-BUILD1397 - 30.05.2012 12:59 - es" />
</head>

<body id="client" class="background-captcha">
<div id="overlay"></div>
<img src="<?php echo $gallery; ?>/v2/images/page_loader.gif" style="position:absolute; margin: -1500px;" />

<div id="change-password-form" style="display: none;">
    <div id="change-password-form-container" class="clearfix">
        <div id="change-password-form-title" class="bottom-border">¿Contraseña olvidada?</div>
        <div id="change-password-form-content" style="display: none;">
            <form method="post" action="https://www.habbo.es/account/password/identityResetForm" id="forgotten-pw-form">
                <input type="hidden" name="page" value="/quickregister/captcha?changePwd=true" />
                <span>Por favor, introduce el email de tu Habbo cuenta:</span>
                <div id="email" class="center bottom-border">
                    <input type="text" id="change-password-email-address" name="emailAddress" value="" class="email-address" maxlength="48"/>
                    <div id="change-password-error-container" class="error" style="display: none;">Por favor, introduce un e-mail</div>
                </div>
            </form>
            <div class="change-password-buttons">
                <a href="#" id="change-password-cancel-link">Cancelar</a>
                <a href="#" id="change-password-submit-button" class="new-button"><b>Enviar email</b><i></i></a>
            </div>
        </div>
        <div id="change-password-email-sent-notice" style="display: none;">
            <div class="bottom-border">
                <span>Te hemos enviado un email a tu dirección de correo electrónico con el link que necesitas clicar para cambiar tu contraseña.<br>
<br>

¡NOTA!: Recuerda comprobar también la carpeta de 'Spam'</span>
                <div id="email-sent-container"></div>
            </div>
            <div class="change-password-buttons">
                <a href="#" id="change-password-change-link">Atrás</a>
                <a href="#" id="change-password-success-button" class="new-button"><b>Cerrar</b><i></i></a>
            </div>
        </div>
    </div>
    <div id="change-password-form-container-bottom"></div>
</div>

<script type="text/javascript">
HabboView.add( function() {
     ChangePassword.init();


});
</script>
<div id="stepnumbers">
    <div class="stepdone">Cumpleaños y Género</div>
    <div class="stepdone">Detalles de la cuenta</div>
    <div class="step3focus">Comprueba la seguridad</div>
    <div class="stephabbo"></div>
</div>

<div id="main-container">

       <div id="error-placeholder">%errors%</div>

    <h2>Avanza hacia el Hotel</h2>

        <div id="avatar-choices">
            <h3>Elige look para tu primera visita:</h3>
            <ul id="avatars">
			
			<?php

if ($_SESSION['jjp']['register'][1]['gender'] == "male") { ?>
    <li>
        <span class="bgtop"></span>
        <span class="bgbottom"></span>
        <img alt="hr-893-42.hd-185-8.ch-255-86.lg-275-64.sh-295-78.ea-1406.fa-1212" src="https://www.habbo.es/habbo-imaging/avatar/hr-893-42.hd-185-8.ch-255-86.lg-275-64.sh-295-78.ea-1406.fa-1212,s-0.g-1.d-4.h-4.a-0,90f2db7cde1692af4307600801dabf25.gif" width="64" height="110"/>
    </li>
    <li>
        <span class="bgtop"></span>
        <span class="bgbottom"></span>
        <img alt="hr-155-35.hd-180-1.ch-3110-82-64.lg-285-64.sh-300-64.wa-3211-64-64" src="https://www.habbo.es/habbo-imaging/avatar/hr-155-35.hd-180-1.ch-3110-82-64.lg-285-64.sh-300-64.wa-3211-64-64,s-0.g-1.d-4.h-4.a-0,a1c6d979ba8e1d27884bafe7fff0184a.gif" width="64" height="110"/>
    </li>
    <li>
        <span class="bgtop"></span>
        <span class="bgbottom"></span>
        <img alt="hr-679-40.hd-209-1.ch-877-62-62.lg-285-62.sh-3115-62-62.ea-1404-64.ca-1802.wa-2002" src="https://www.habbo.es/habbo-imaging/avatar/hr-679-40.hd-209-1.ch-877-62-62.lg-285-62.sh-3115-62-62.ea-1404-64.ca-1802.wa-2002,s-0.g-1.d-4.h-4.a-0,b5b600417f4155bc2f779f342ff4df3d.gif" width="64" height="110"/>
    </li>
    <li>
        <span class="bgtop"></span>
        <span class="bgbottom"></span>
        <img alt="hr-893-40.hd-180-1.ch-877-77-81.lg-280-62.sh-300-62.he-1609-82" src="https://www.habbo.es/habbo-imaging/avatar/hr-893-40.hd-180-1.ch-877-77-81.lg-280-62.sh-300-62.he-1609-82,s-0.g-1.d-4.h-4.a-0,02656841f81e8e05fe766a54ac8aa145.gif" width="64" height="110"/>
    </li>
    <li>
        <span class="bgtop"></span>
        <span class="bgbottom"></span>
        <img alt="hr-679-39.hd-209-7.ch-3109-64-64.lg-285-64.sh-3115-64-64.ea-1404-62.wa-2011.cc-260-62" src="https://www.habbo.es/habbo-imaging/avatar/hr-679-39.hd-209-7.ch-3109-64-64.lg-285-64.sh-3115-64-64.ea-1404-62.wa-2011.cc-260-62,s-0.g-1.d-4.h-4.a-0,606b18740ed84e16f97718cacb930dd8.gif" width="64" height="110"/>
    </li>
    <li>
        <span class="bgtop"></span>
        <span class="bgbottom"></span>
        <img alt="hr-679-1316.hd-209-1.ch-877-73-70.lg-285-62.sh-906-72.ha-3254-62.he-1608.ea-1404-62.ca-1802" src="https://www.habbo.es/habbo-imaging/avatar/hr-679-1316.hd-209-1.ch-877-73-70.lg-285-62.sh-906-72.ha-3254-62.he-1608.ea-1404-62.ca-1802,s-0.g-1.d-4.h-4.a-0,1c74235db97d7da6c065bfac0764dcbb.gif" width="64" height="110"/>
    </li>
	<?php
		}
		else{ ?>
		
 <li>
        <span class="bgtop"></span>
        <span class="bgbottom"></span>
        <img alt="hr-890-31.hd-629-10.ch-685-62.lg-715-62.sh-907-64.he-1605-64.ca-1805-64.wa-2009-64" src="https://www.habbo.es/habbo-imaging/avatar/hr-890-31.hd-629-10.ch-685-62.lg-715-62.sh-907-64.he-1605-64.ca-1805-64.wa-2009-64,s-0.g-1.d-4.h-4.a-0,2d194e1e961e15a3731e615a1de1e103.gif" width="64" height="110"/>
    </li>
    <li>
        <span class="bgtop"></span>
        <span class="bgbottom"></span>
        <img alt="hr-890-39.hd-629-10.ch-685-64.lg-715-64.sh-907-64.he-1608.ca-1812.wa-2009-64" src="https://www.habbo.es/habbo-imaging/avatar/hr-890-39.hd-629-10.ch-685-64.lg-715-64.sh-907-64.he-1608.ca-1812.wa-2009-64,s-0.g-1.d-4.h-4.a-0,e07cba40c0e06ceb6ea95638264747cc.gif" width="64" height="110"/>
    </li>
    <li>
        <span class="bgtop"></span>
        <span class="bgbottom"></span>
        <img alt="hr-890-35.hd-629-1.ch-884-72.lg-715-71.sh-907-72.he-1608.ea-1403-64.ca-1812.wa-2009-72.cp-3126-62" src="https://www.habbo.es/habbo-imaging/avatar/hr-890-35.hd-629-1.ch-884-72.lg-715-71.sh-907-72.he-1608.ea-1403-64.ca-1812.wa-2009-72.cp-3126-62,s-0.g-1.d-4.h-4.a-0,e93ad0fdbba93854021b7bf3ae8ac331.gif" width="64" height="110"/>
    </li>
    <li>
        <span class="bgtop"></span>
        <span class="bgbottom"></span>
        <img alt="hr-891-40.hd-605-8.ch-640-89.lg-716-64-62.sh-740-66" src="https://www.habbo.es/habbo-imaging/avatar/hr-891-40.hd-605-8.ch-640-89.lg-716-64-62.sh-740-66,s-0.g-1.d-4.h-4.a-0,acb9c23bb8999b8c1cab89bbad98ea5f.gif" width="64" height="110"/>
    </li>
    <li>
        <span class="bgtop"></span>
        <span class="bgbottom"></span>
        <img alt="hr-515-45.hd-605-28.ch-660-63.lg-700-78.fa-1204" src="https://www.habbo.es/habbo-imaging/avatar/hr-515-45.hd-605-28.ch-660-63.lg-700-78.fa-1204,s-0.g-1.d-4.h-4.a-0,31351e85e4d12bda2fa99f26f69f5484.gif" width="64" height="110"/>
    </li>
    <li>
        <span class="bgtop"></span>
        <span class="bgbottom"></span>
        <img alt="hr-890-38.hd-629-1.ch-685-64.lg-715-64.sh-907-64.ha-3254-64.he-1602-71.ca-1805-71.wa-2009-71" src="https://www.habbo.es/habbo-imaging/avatar/hr-890-38.hd-629-1.ch-685-64.lg-715-64.sh-907-64.ha-3254-64.he-1602-71.ca-1805-71.wa-2009-71,s-0.g-1.d-4.h-4.a-0,66974518b6fdd999ad87f20b2c8c3a23.gif" width="64" height="110"/>
    </li>
	<?php	} ?>
            </ul>
            <p style="clear: left;">
                ¿No te gusta ninguno?
                <a href="#" id="more-avatars">Mira más estilos.</a>
                <br/><span class="help">No te preocupes - podrás cambiar el look más tarde.</span>
            </p>
        </div>
		

    <div id="captcha-container">
        <h3>Una última cuestión de seguridad antes de acceder:</h3>
        <div id="captcha-image-container">
            <div id="recaptcha_image"></div>
        </div>
        <div id="captcha-reload-container">
            ¿No ves las palabras?
            <a id="recaptcha-reload" href="#">Prueba otro código</a>
        </div>
    </div>

    <div class="delimiter_smooth">
        <div class="flat">&nbsp;</div>
        <div class="arrow">&nbsp;</div>
        <div class="flat">&nbsp;</div>
    </div>

    <div id="inner-container">
        <form id="captcha-form" method="post" action="/quickregister/captcha_submit" onsubmit="Overlay.show(null,'Cargando...');">
            <div id="recaptcha-input-title">Escribe las dos palabras (separadas por un espacio):</div>
            <div id="recaptcha-input">
                <input type="text" tabindex="2" name="captchaResponse" id="recaptcha_response_field">
            </div>
                <input type="hidden" id="avatarFigure" name="bean.figure" value=""/>
        </form>
    </div>

    <div id="select">
        <a href="/quickregister/cancel" id="back-link">Atr&aacute;s</a>
        <div class="button">
            <a id="proceed-button" href="#" class="area">Finalizar</a>
            <span class="close"></span>
        </div>
   </div>

  <script type="text/javascript">

        document.observe("dom:loaded", function() {
            Utils.showRecaptcha("registration-recaptcha", "6Lc4BMASAAAAAN7wRyHPGo2WvrinsGOiXsnrKVmK");
            if ($("recaptcha-reload")) {
                Event.observe($("recaptcha-reload"), "click", function(e) {
                    Event.stop(e);
                    Utils.reloadRecaptcha();
                });
            }
<?php
if ($_SESSION['jjp']['register'][1]['gender'] == "male") { ?>
            if ($("more-avatars")) {
                Event.observe($("more-avatars"), "click", function(e) {
                    Event.stop(e);
                    new Ajax.Updater("avatars", "/quickregister/refresh_avatars", {
                        onComplete: function (t) {
                            QuickRegister.initAvatarChooser();
                        }
                    });
                });
            }
			<?php } else{
			?>
			            if ($("more-avatars")) {
                Event.observe($("more-avatars"), "click", function(e) {
                    Event.stop(e);
                    new Ajax.Updater("avatars", "/quickregister/refresh_avatars_female", {
                        onComplete: function (t) {
                            QuickRegister.initAvatarChooser();
                        }
                    });
                });
            }
			<?php } ?>
			

            if($("proceed-button")) {
                $("proceed-button").observe("click", function(e) {
                    Event.stop(e);
                    Overlay.show(null,'Cargando...');
                    $("captcha-form").submit();
                });

                Event.observe($("back-link"), "click", function() {
                    Overlay.show(null,'Cargando...');
                });
            }

            $("recaptcha_response_field").focus();

            QuickRegister.initAvatarChooser();
        });
    </script>

</div>

<script type="text/javascript">
    HabboView.run();
</script>


</body>
</html>