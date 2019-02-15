<?php
ini_set ('default_charset', 'iso-8859-15');

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
<link rel="stylesheet" href="/habboweb/63_1dc60c6d6ea6e089c6893ab4e0541ee0/841/web-gallery/static/styles/common.css" type="text/css" />

<script src="/habboweb/63_1dc60c6d6ea6e089c6893ab4e0541ee0/841/web-gallery/static/js/libs2.js" type="text/javascript"></script>
<script src="/habboweb/63_1dc60c6d6ea6e089c6893ab4e0541ee0/841/web-gallery/static/js/visual.js" type="text/javascript"></script>
<script src="/habboweb/63_1dc60c6d6ea6e089c6893ab4e0541ee0/841/web-gallery/static/js/libs.js" type="text/javascript"></script>
<script src="/habboweb/63_1dc60c6d6ea6e089c6893ab4e0541ee0/841/web-gallery/static/js/common.js" type="text/javascript"></script>



<script type="text/javascript">

var ad_keywords = "";

var ad_key_value = "";

</script>

<script type="text/javascript">
document.habboLoggedIn = false;
var habboName = null;
var habboId = null;
var habboReqPath = "";
var habboStaticFilePath = "/web-gallery";
var habboImagerUrl = "%www%/habbo-imaging/";
var habboPartner = "";
var habboDefaultClientPopupUrl = "%www%/client";
window.name = "5e89fa73be984693b11c671f512eb4da990e09e5";
if (typeof HabboClient != "undefined") {
    HabboClient.windowName = "5e89fa73be984693b11c671f512eb4da990e09e5";
    HabboClient.maximizeWindow = true;
}


</script>

<meta property="fb:app_id" content="157382664122" />

<meta property="og:site_name" content="Habbo Hotel" />
<meta property="og:title" content="Habbo: " />
<meta property="og:url" content="%www%" />
<meta property="og:image" content="%www%/v2/images/facebook/app_habbo_hotel_image.gif" />
<meta property="og:locale" content="es_ES" />

<link rel="stylesheet" href="/habboweb/63_1dc60c6d6ea6e089c6893ab4e0541ee0/841/web-gallery/static/styles/quickregister.css" type="text/css" />

<meta name="description" content="Habbo Hotel: haz amig@s, únete a la diversión y date a conocer." />
<meta name="keywords" content="habbo hotel, mundo, virtual, red social, gratis, comunidad, personaje, chat, online, adolescente, roleplaying, unirse, social, grupos, forums, seguro, jugar, juegos, amigos, adolescentes, raros, furni raros, coleccionable, crear, coleccionar, conectar, furni, muebles, mascotas, diseño de salas, compartir, expresión, placas, pasar el rato, música, celebridad, visitas de famosos, celebridades, juegos en línea, juegos multijugador, multijugador masivo" />



<!--[if IE 8]>
<link rel="stylesheet" href="/habboweb/63_1dc60c6d6ea6e089c6893ab4e0541ee0/841/web-gallery/static/styles/ie8.css" type="text/css" />
<![endif]-->
<!--[if lt IE 8]>
<link rel="stylesheet" href="/habboweb/63_1dc60c6d6ea6e089c6893ab4e0541ee0/841/web-gallery/static/styles/ie.css" type="text/css" />
<![endif]-->
<!--[if lt IE 7]>
<link rel="stylesheet" href="/habboweb/63_1dc60c6d6ea6e089c6893ab4e0541ee0/841/web-gallery/static/styles/ie6.css" type="text/css" />
<script src="/habboweb/63_1dc60c6d6ea6e089c6893ab4e0541ee0/841/web-gallery/static/js/pngfix.js" type="text/javascript"></script>
<script type="text/javascript">
try { document.execCommand('BackgroundImageCache', false, true); } catch(e) {}
</script>

<style type="text/css">
body { behavior: url(/js/csshover.htc); }
</style>
<![endif]-->
<meta name="build" content="63-BUILD1005 - 21.12.2011 12:59 - es" />
</head>

<body id="client" class="background-accountdetails-male"> 
<div id="overlay"></div> 
<img src="/habboweb/63_1dc60c6d6ea6e089c6893ab4e0541ee0/841/web-gallery/v2/images/page_loader.gif" style="position:absolute; margin: -1500px;" /> 


<div id="change-password-form" style="display: none;">

    <div id="change-password-form-container" class="clearfix">

        <div id="change-password-form-title" class="bottom-border">¿Contraseña olvidada?</div>

        <div id="change-password-form-content" style="display: none;">

            <form method="post" action="%www%/account/password/identityResetForm" id="forgotten-pw-form">

                <input type="hidden" name="page" value="%www%/quickregister/email_password?changePwd=true" />

                <span>Email:</span>

                <div id="email" class="center bottom-border">

                    <input type="text" id="change-password-email-address" name="emailAddress" value="" class="email-address" maxlength="48"/>

                    <div id="change-password-error-container" class="error" style="display: none;">Por favor, introduce un e-mail</div>

                </div>

            </form>

            <div class="change-password-buttons">

                <a href="#" id="change-password-cancel-link">Cancelar</a>

                <a href="#" id="change-password-submit-button" class="new-button"><b></b><i></i></a>

            </div>

        </div>

        <div id="change-password-email-sent-notice" style="display: none;">

            <div class="bottom-border">

                <span>Te hemos enviado un email a tu dirección de correo electrónico con el link que necesitas clicar para cambiar tu contraseña.<br /><br/>¡NOTA!: Recuerda comprobar tambi&eacute;n la carpeta de 'Spam'</span>

                <div id="email-sent-container"></div>

            </div>

            <div class="change-password-buttons">

                <a href="#" id="change-password-change-link">Atr&aacute;s</a>

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

    <div class="step2focus">Detalles de la cuenta </div>

    <div class="step3">Comprueba la seguridad</div>

    <div class="stephabbo"></div>

</div>


<div id="main-container">
		<div id="error-placeholder">%errors%</div> 
    <form method="post" action="/quickregister/email_password_submit" id="quickregister-form">
        <h2>Detalles de la cuenta</h2>
      <div id="inner-container">

        <div class="inner-content bottom-border">


            <div class="field">

                <label for="bean.name"><?php echo $config['HotelName']; ?> Nombre</label>

                <input type="text" id="email-address" name="bean.name" value="" class="" />
				
            </div>		
			
			<div class="help">Este sera tu nombre para todo el hotel.</div>
			
            <div class="field">

                <label for="email-address">Email</label>

                <input type="text" id="email-address" name="bean.email" value="" class="%error%"/>


            </div>

            <div class="help">Necesitarás usar esta <b>dirección de email para conectarte</b> a Habbo en el futuro. Por favor, usa un email válido. Asegúrate de que introduces la terminación correcta (Ejemplo: hotmail.es ó hotmail.com, o bien yahoo.es ó yahoo.com)</div>

            <div class="field">

                <label for="email-address2">Reintroduce email</label>

                <input type="text" id="email-address2" name="bean.retypedEmail" value="" class=""/>

            </div>

            <div class="help">... sólo por seguridad.</div>
            <div id="password-field" class="field">

                <label for="register-password">Nueva contraseña</label>

                <input class"" type="password" name="bean.password" id="register-password" maxlength="32" value="" class="" />

            </div>

            <div class="help">La contraseña debe tener al menos 6 caracteres e incluir letras y números.</div>

        </div>
        <div class="inner-content top-margin">

			<div class="field-content checkbox ">	


			  <label>

			    <input type="checkbox" name="bean.termsOfServiceSelection" id="terms" value="true" class="checkbox-field"/>

			    Acepto los <a href="#" target="_blank" onclick="window.open('/reglas'); return false;">Terminos y Condiciones del Servicio</a>

			  </label>

			</div>            
			<div class="field-content checkbox">

			  <label>

							    <input type="checkbox" name="bean.marketing" id="marketing" value="true" class="checkbox-field"/>

			    Enviadme actualizaciones de Habbo, incluida la newsletter semanal.
			  </label>


			</div>

        </div>

      </div>

    </form>    <div id="select">

        <div class="button">

            <a id="proceed-button" href="#" class="area">Continuar</a>

            <span class="close"></span>

        </div>

        <a href="/quickregister/cancel" id="back-link">Atr&aacute;s</a>

   </div>

</div>



<script type="text/javascript">

    document.observe("dom:loaded", function() {
        Event.observe($("back-link"), "click", function() {
            Overlay.show(null,'Cargando...');
        });

        Event.observe($("proceed-button"), "click", function() {
            Overlay.show(null,'Cargando...');            
            $("quickregister-form").submit();
        });
            $("email-address").focus();
    });

</script>  
 
<script type="text/javascript"> 
    HabboView.run();
</script> 
 
</body> 
</html>