<?php
$pagename= "Editar noticias";
if (!defined('IN_HK') || !IN_HK)
{
	exit;
}

if (!HK_LOGGED_IN || !$users->hasFuse(USER_ID, 'fuse_housekeeping_sitemanagement'))
{
	exit;
}

$data = null;

if (isset($_GET['u']) && is_numeric($_GET['u']))
{
	$u = intval($_GET['u']);
	$getData = dbquery("SELECT * FROM site_news WHERE id = '" . $u . "' LIMIT 1");
	
	if (mysql_num_rows($getData) > 0)
	{
		$data = mysql_fetch_assoc($getData);
	}
}

if ($data == null)
{
	fMessage('error', 'Woops, that article does not exist.');
	header("Location: index.php?_cmd=news");
	exit;
}

if (isset($_POST['content']))
{
	$title = filter($_POST['title']);
	$teaser = filter($_POST['teaser']);
	$topstory = WWW . '/images/ts/' . filter($_POST['topstory']);
	$content = filter($_POST['content']);
	$category = intval($_POST['category']);
	
	if (strlen($title) < 1 || strlen($teaser) < 1 || strlen($content) < 1)
	{
		fMessage('error', 'Please fill in all fields.');
	}
	else
	{
		dbquery("UPDATE site_news SET title = '" . $title . "', category_id = '" . $category . "', topstory_image = '" . $topstory . "', body = '" . $content . "', snippet = '" . $teaser . "' WHERE id = '" . $data['id'] . "' LIMIT 1");
		fMessage('ok', 'News article updated.');
		
		header("Location: index.php?_cmd=newsedit2");
		exit;
	}
}

foreach ($data as $key => $value)
{
	switch ($key)
	{
		case 'snippet':
		
			$key = 'teaser';
			break;
			
		case 'topstory_image':
			
			$bits = explode('/', $value);
			$value = $bits[count($bits) - 1];
			$key = 'topstory';
			break;
			
		case 'body':
		
			$key = 'content';
			break;
	}

	if (!isset($_POST[$key]))
	{
		$_POST[$key] = $value;
	}
}
?>
<div style="float: left;">

<strong>Titulo del Artículo:</strong><br />
<input type="text" value="<?php if (isset($_POST['title'])) { echo clean($_POST['title']); } ?>" name="title" size="50" onkeyup="suggestSEO(this.value);" style="padding: 5px; font-size: 130%;"><br />
<br />

<strong>Categoria:</strong><br />
<select name="category">
<?php

$getOptions = dbquery("SELECT * FROM site_news_categories ORDER BY caption ASC");

while ($option = mysql_fetch_assoc($getOptions))
{
	echo '<option value="' . intval($option['id']) . '" ' . (($option['id'] == $data['category_id']) ? 'selected' : '') . '>' . clean($option['caption']) . '</option>';
}

?>
</select><br />
<br />

<strong>URL:</strong><br />
<div style="border: 1px dotted; width: 300px; padding: 5px;">
<?php echo WWW; ?>/<b><?php echo $data['id']; ?>-<?php echo clean($data['seo_link']); ?></b>/<br />
</div><br />

<strong>Texto de la descripción:</strong><br />
<textarea name="teaser" cols="45" rows="5" style="padding: 5px; font-size: 100%;"><?php if (isset($_POST['teaser'])) { echo clean($_POST['teaser']); } ?></textarea><br />
<br />

<strong>Topstory imagen:</strong><br />

	<select onkeypress="previewTS(this.value);" onchange="previewTS(this.value);" name="topstory" id="topstory" style="padding: 5px; font-size: 120%;">
	<?php
	
	if ($handle = opendir(CWD . '/images/ts'))
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

<div id="ts-preview" style="margin-left: 20px; padding: 10px; float: left; text-align: center; vertical-align: middle;">

	<img src="<?php echo $data['topstory_image']; ?>">

</div>

<div style="clear: both;"></div>

<br /><br />

<textarea id="content" name="content" style="width:80%"><?php if (isset($_POST['content'])) { echo clean($_POST['content']); } ?></textarea>

<script type="text/javascript" src="<?php echo WWW; ?>/manage /tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
tinyMCE.init({
	mode : "exact",
	elements : "content",
	theme : "advanced",
	theme_advanced_toolbar_location : "top",
	theme_advanced_toolbar_align : "left",
	theme_advanced_resizing : true,
	theme_advanced_statusbar_location : "bottom"
});
</script>

<br />
<br />

<input type="submit" value="Actualizar Articulo">&nbsp;
<input type="button" value="Cancelar" onclick="window.location = 'index.php?_cmd=news';">

</form>