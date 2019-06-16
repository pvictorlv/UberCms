<?php

if (!defined('IN_HK') || !IN_HK)
{
	exit;
}

if (!HK_LOGGED_IN || !$users->hasFuse(USER_ID, 'fuse_housekeeping_sitemanagement'))
{
	exit;
}

if (isset($_POST['title']))
{
	$title = filter($_POST['title']);
	$imagen = WWW . '/images/promos/' . filter($_POST['topstory']);
	$content = filter($_POST['content']);
	
	if (empty($imagen) || empty($title) || empty($content))
	{
		fMessage('error', 'Por Favor llena todos los datos.');
	}
	else
	{
		db::query("INSERT INTO site_promos (titulo,imagen,cuerpo) VALUES ('" . $title . "','" . $imagen . "','" . $content . "')");
		fMessage('ok', 'Nuevo articulo publicado.');
		
		header("Location: index.php?_cmd=news");
		exit;
	}
}

require_once "top.php";

?>			

<script type="text/javascript">
function previewTS(el)
{
	document.getElementById('ts-preview').innerHTML = '<img src="<?php echo WWW; ?>/images/promos/' + el + '" />';
}

function suggestSEO(el)
{
	var suggested = el;
	
	suggested = suggested.toLowerCase();
	suggested = suggested.replace(/^\s+/, ''); 
	suggested = suggested.replace(/\s+$/, '');
	suggested = suggested.replace(/[^a-z 0-9]+/g, '');
	
	while (suggested.indexOf(' ') > -1)
	{
		suggested = suggested.replace(' ', '-');
	}
	
	document.getElementById('url').value = suggested;
}
</script>

<h1>Crear Noticia</h1>
<form method="post">

<br />

<div style="float: left;">

<strong>Titulo:</strong><br />
<input type="text" value="<?php if (isset($_POST['title'])) { echo clean($_POST['title']); } ?>" name="title" size="50" onkeyup="suggestSEO(this.value);" style="padding: 5px; font-size: 130%;"><br />
<br />

<br />

<strong>Imagen de los Promos:</strong><br />

	<select onkeypress="previewTS(this.value);" onchange="previewTS(this.value);" name="topstory" id="topstory" style="padding: 5px; font-size: 120%;">
	<?php
	
	if ($handle = opendir(CWD . '/images/promos'))
	{
		while (false !== ($file = readdir($handle)))
		{
			if ($file == '.' || $file == '..')
			{
				continue;
			}	
			
			echo '<option value="' . $file . '"';
			
			if (isset($_POST['topstory']) && $_POST['topstory'] == $file)
			{
				echo ' selected';
			}
			
			echo '>' . $file . '</option>';
		}
	}

	?>
	</select>
	
</div>

<div id="ts-preview" style="margin-left: -12px; padding: 5px; float: left; text-align: center; vertical-align: middle;">

	<small>(Seleccione una imagen Topstory de la lista para obtener una vista previa aqu�)</small>

</div>

<div style="clear: both;"></div>
<br>
<strong>Contenido:</strong><br>
<script type="text/javascript" src="./tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
tinyMCE.init({
	mode : "exact",
	elements : "none",
	theme : "simple",
	theme_advanced_toolbar_location : "top",
	theme_advanced_toolbar_align : "left",
	theme_advanced_resizing : true,
	theme_advanced_statusbar_location : "bottom"
});
</script>



<textarea id="content" name="content" style="margin: 0px; width: 589px; height: 106px; "><?php if (isset($_POST['content'])) { echo clean($_POST['content']); } ?></textarea>

<br />
<br />

<input type="submit" value="Crear">

</form>


