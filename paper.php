<?php
$no_rea = true;
require_once('includes/core.php');

$old_login = true;
$page = HoloText($_GET['page']);

if($page == "privacy"){
$pagename = "Política de Privacidad";
require_once('templates/sub_subheader.php');
?>

<div id="process-content">
	        	<div id="terms" class="box-content">
<div class="tos-header"><b>POLÍTICA DE PRIVACIDAD</b></div>
<div class="tos-item"><br>En EgoCMS 2011 queremos que todo el mundo pase un buen rato en <?php echo $sitename; ?> y nos comprometemos a mantener el Sitio Web tan seguro y privado como podamos. El Hotel es un lugar en el que puedes dar una vuelta y conocer nueva gente. Tenemos muy pocas normas que tienes que aceptar previamente para poder converirte en un miembro del Hotel.<br><br><br>Esta Política de Privacidad, junto con los Términos y Condiciones y la Manera Habbo (todos ello, conjutamente en el ´Contrato´), es aplicable a la recogida y tratamiento de los datos de carácter personal de los usuarios del Sitio Web bajo los dominios <?php echo PATH; ?>, y bajo cualquiera de los subdominios o páginas web dependientes de los mismos y de los Servicios titularidad de InfoSmart 2010 que están disponibles en el Sitio Web.<br><br><br>El hecho de acceder al Sitio Web y/o utilizar los Servicios, y/o registrarte en el Sitio Web, significa que has leído, entiendes y aceptas, sin reservas de ninguna clase, esta Política de Privacidad, y CONSIENTES EN QUE RECOJAMOS Y TRATEMOS TUS DATOS PERSONALES Y TU INFORMACIÓN DE ACUERDO CON ESTA POLÍTICA DE PRIVACIDAD Y CON LAS LEYES ESPAÑOLAS, así como aceptas expresamente las medidas de seguridad que hemos implementado para hacer de <?php echo $sitename; ?> un lugar seguro. Si no aceptas esta Política de Privacidad, no debes utilizar este Sitio Web ni los Servicios ofrecidos.
</div>
</div>
</div>

<?php
include('templates/login_footer.php');
}elseif($page == "termsAndConditions"){
$pagename = "Términos y Condiciones";
include('templates/sub_subheader.php');
?>

<div id="process-content">
	        	<div id="terms" class="box-content">
<div class="tos-header"><b>TÉRMINOS Y CONDICIONES DEL SERVICIO</b></div>
<div class="tos-item"><p><br />Antes de registrarte en el servicio debes tener en cuenta que esto es un 'Habbo Retro', una copia de Habbo Hotel.<br />
<?php echo $sitename; ?> usa <b>EgoCMS v2</b> que esta registrado por <a href="http://mundomax.us" target="_new">MundoMax</a>, jugar en un Habbo Retro no tiene peligro, pero se debe recordar que esto es <b>Ilegal</b>.<br />
<br />Tambien debes aceptar seguir las siguientes normas que tiene este Hotel.<br><br><br>Normas del Hotel<br><br>Las normas se dividen en secciones que debes cumplir, son sencillos:<br><b><br>Respeto<br>Tolerancia<br>Script<br>Abuso</b><br><br>Cada seccion tiene reglas diferentes que deberas seguir. Para que puedas jugar limpiamente.<br><b><br>Respeto:</b><br><br>1-	Respetar a todos los jugadores, sean como sean.<br>2-	Respetar a los miembros Administrativos del Hotel, asi como a los Jugadores dentro.<br>3-	Respetar las Creencias de cada quien dentro del Juego.<br>4-	Respetar a los Habbo Guias.<br>5-	Respetar el Chat y a las personas dentro de el.<br><b><br>Tolerancia:</b><br>  <br>1-	Tolerancia para los miembros Administrativos.<br>2-	Tolerancia si en algun momento los miembros Administrativos se demoran para tus alertas.<br>3-	Tolerancia al aceptar las reglas<br>4-	Tolerancia Con los demas, Asi te evitas problemas.<br>5-	Tolerancia con asuntos de primera mano<br><b><br>Script:</b><br><br>1-	Recuerda, Los script estan totalmente prohibidos.<br>2-	No uses programas Script dentro del Juego o seras <b>Eliminado</b> del Servidor.<br>3-	Si tu problema causa problemas mayores, el equipo de Asistencia Tecnica de Habboticos 2010 hablara con tigo.<br>4-	Los script a veces traen virus, Evitate problemas con tu ordenador.<br>5-	Ten en cuenta que sabemos todo tipo de scripts, Asi que ninguno que intentes nos hara algun tipo de daño critico. <br><b><br>Abuso:</b><br><br>1-	Cuando se hacen las solicitudes para rango, No abuses con los miembros Administrativos.<br>2-	Abusar con lo que te puedan brindar nuestros amigos staff.<br>3-	Abusar del Equipo de Asistencia Tecnica o Ayuda.<br>4-	Abusar o pasarse de la raya con las personas de tu sexo opuesto es motivo de baneo.<br>5-	Recuerda Reportar a los Jugadores o inclusive a los Miembros <b>Administrativos</b> acerca de cualquier tipo de Rompimiento a las Normas. <br><br><br>Si necesitas mas Ayuda acerca de las Normas o algun otro tema puedes usar el Habbo Help Tool.<br />
<strong><br />
JuanCarlos and Jorge40813, Proyects Mangers.</strong></p>
</div>
</div>
</div>

<?php
include('templates/login_footer.php');
}elseif($page == "habboid"){
$pagename = $shortname." ID";
include('templates/sub_subheader.php');
?>

<div id="process-content">
	        	<div class="box-content clearfix">
    <?php echo $shortname; ?> ID es una cuenta usada para jugar <?php echo $shortname; ?>. <?php echo $shortname; ?> ID utiliza su dirección de correo electrónico como su nombre de usuario, en lugar de nombre de tu personaje <?php echo $shortname; ?>.<br><br> Toda la información de perfil introducido como parte de tu <?php echo $shortname; ?> ID (dirección de correo electrónico, fecha de nacimiento, contraseña) se mantiene como privado y no compartida con otros usuarios.<br><br> El ID de <?php echo $shortname; ?> identifica quién es usted, rahter que un personaje <?php echo $shortname; ?> único. Cada <?php echo $shortname; ?> ID puede contener múltiples personajes <?php echo $shortname; ?>, así que cuando usted accede con un <?php echo $shortname; ?> ID, puedes elegir el que el personaje que desea utilizar.
     <br /><br />
    <div class="habbo-id-logo"></div>
</div>

<?php
include('templates/login_footer.php');
}elseif($page == "happyhour"){
$pagename = "Happy Hour";
include('templates/sub_subheader.php');
?>

<div id="process-content">
	        	<div class="box-content clearfix">
    El <b>"Happy Hour"</b> u <b>"Hora Feliz"</b> es el tiempo en donde los furnis de catálogo son rebajados a la mitad de su precio normal, la cual solo predura por un corto tiempo.<br /><br /> No hay hora definida para estas horas, así que mantente alerta.<br /><br />Happy Hour: <b><?php if(getServer("enableHappyHour") == "1") { ?><font color="green">Activado</font><?php } else { ?><font color="red">Desactivado</font><?php } ?></b>
     <br /><br />
    <div class="habbo-id-logo"></div>
</div>

<?php
include('templates/login_footer.php');
} else {
header("HTTP/1.0 404 Not Found");
$cored = true;
include('error.php');
?>
</div>
</div>
<?php } ?>
