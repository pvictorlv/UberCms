<?php

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
	$getData = dbquery("SELECT * FROM site_promo WHERE id = '" . $u . "' LIMIT 1");
	
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
		dbquery("UPDATE site_promo SET title = '" . $title . "', category_id = '" . $category . "', topstory_image = '" . $topstory . "', body = '" . $content . "', snippet = '" . $teaser . "' WHERE id = '" . $data['id'] . "' LIMIT 1");
		fMessage('ok', 'News article updated.');
		
		header("Location: index.php?_cmd=news");
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

require_once "top.php";

?>			
<head>
<script type='text/javascript' src='js/utils.js'></script> 
<script type='text/javascript' src='js/editor.js'></script> 
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
</head>
<script type="text/javascript">
function previewTS(el)
{
	document.getElementById('ts-preview').innerHTML = '<img src="<?php echo WWW; ?>/images/ts/' + el + '" />';
}
</script> 
 

<div class="wrap"> 
<div id="icon-edit" class="icon32"><br /></div> 
<h2>Editar promo</h2>  <img src="images/packi/typo.gif" style="float: right;">
<form method="post">

<br />

<div style="float: left;">
<div class="wrap"> 
<strong>Titúlo da promoção:</strong><br />
<input type="text" value="<?php if (isset($_POST['title'])) { echo clean($_POST['title']); } ?>" name="title" size="50" onkeyup="suggestSEO(this.value);" style="padding: 5px; font-size: 130%;"><br />


<div id="poststuff" class="metabox-holder"> 
<div id="side-info-column" class="inner-sidebar"> 
 
 
<div id='side-sortables' class='meta-box-sortables'> 
</div></div> 
 
<div id="post-body"> 
<div id="post-body-content"> 
<div id="titlediv"> 

<div class="inside"> 
	<div id="edit-slug-box"> 
	</div> 
</div> 
</div> 
 
<div id="postdivrich" class="postarea"> 
 <div id="editor-toolbar"> 
		<div class="zerosize"><input accesskey="e" type="button" onclick="switchEditors.go('content')" /></div> 
			<a id="edButtonHTML" class="hide-if-no-js" onclick="switchEditors.go('content', 'html');">HTML</a> 
			<a id="edButtonPreview" class="active hide-if-no-js" onclick="switchEditors.go('content', 'tinymce');">Visual</a> 
		
	</div> 
	<div id="quicktags">	<script type="text/javascript">edToolbar()</script> 
	</div> 
 
<div id='editorcontainer'><textarea rows='10' class='theEditor' cols='40' name='content' tabindex='2' id="content" name="content"><?php if (isset($_POST['content'])) { echo clean($_POST['content']); } ?></textarea></div> 
	<script type="text/javascript"> 
	edCanvas = document.getElementById('content');
	</script> 
 
<table id="post-status-info" cellspacing="0"><tbody><tr> 
	<td id="wp-word-count"></td> 
	<td class="autosave-info"> 
	<span id="autosave">&nbsp;</span> 
	</td> 
</tr></tbody></table> 
 <br><br>
 

<div id='normal-sortables' class='meta-box-sortables'> 
<div id="metabox" class="postbox " > 
<div class="handlediv" title="Clique para expandir ou recolher."><br /></div><h3 class='hndle'><span>SEO-friendly URL</span></h3> 
<div class="inside"> 
<strong>SEO-friendly URL:</strong><br><br>
<div style="border: 1px dotted; width: 300px; padding: 5px;">
<?php echo WWW; ?>/<b><?php echo $data['id']; ?>-<?php echo clean($data['seo_link']); ?></b>/<br />
</div>
<small>This will be automatically suggested for you when you type a title. Required for us to be friendly to search engines.</small><br />
<br></div> 
</div> 
<div id="postexcerpt" class="postbox " > 
<div class="handlediv" title="Clique para expandir ou recolher."><br /></div><h3 class='hndle'><span>Frontpage texto</span></h3> 
<div class="inside"> 
<label class="screen-reader-text" for="excerpt">Frontpage texto</label>
<textarea name="teaser" cols="48" rows="5" id="excerpt" style="padding: 5px; font-size: 120%;"><?php if (isset($_POST['teaser'])) { echo clean($_POST['teaser']); } ?></textarea><br />
<br />

<p>Frontpage são pequenas descrições do conteúdo do seu post feitas manualmente que podem ser usadas em seu tema.</p> 
</div> 
</div> 


<div id="authordiv" class="postbox " > 
<div class="handlediv" title="Clique para expandir ou recolher."><br /></div><h3 class='hndle'><span>Categoria da Notícia</span></h3> 
<div class="inside"> 
<label class="screen-reader-text" for="post_author_override">Categoria da Notícia</label><select name='post_author_override' id='post_author_override' class=''> 
<strong>Category:</strong><br />
<select name="category">
<?php

$getOptions = dbquery("SELECT * FROM site_promo_categories ORDER BY caption ASC");

while ($option = mysql_fetch_assoc($getOptions))
{
	echo '<option value="' . intval($option['id']) . '" ' . (($option['id'] == $_POST['category']) ? 'selected' : '') . '>' . clean($option['caption']) . '</option>';
}

?>
</select>
</select></div> 
</div> 
<div id="trackbacksdiv" class="postbox "> 
<div class="handlediv" title="Clique para expandir ou recolher."><br /></div><h3 class='hndle'><span>Topstory imagem</span></h3> 
<div class="inside" style="display:none;"> 
<p>	<select onkeypress="previewTS(this.value);" onchange="previewTS(this.value);" name="topstory" id="topstory" style="font-size: 120%;">
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
	

<div id="ts-preview" style="margin-left: 20px; padding: 10px; float: left; text-align: center; vertical-align: middle;">

	<small>(Select an Topstory image from the list to preview it here)</small>

</div>
</div> 
</div> 


<div class="clear"></div> 

<input type="submit" value="Update article"  class="button-secondary">&nbsp;
<input type="button" value="Cancel" onclick="window.location = 'index.php?_cmd=news';"  class="button-primary">


</div> 
</div> 
</div><div id='advanced-sortables' class='meta-box-sortables'> 
</div> 
</div> 
</div> 
<br class="clear" /> 
</div><!-- /poststuff --> 
</form> 
</div> 


</form>


<?php

require_once "bottom.php";

?>