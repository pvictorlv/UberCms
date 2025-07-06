<?php

if (!defined('IN_HK') || !IN_HK)
{
	exit;
}

if (!HK_LOGGED_IN || !$users->hasFuse(USER_ID, 'fuse_housekeeping_sitemanagement'))
{
	exit;
}

if (isset($_POST['content']))
{
	$title = filter($_POST['title']);
	$teaser = filter($_POST['teaser']);
	$topstory = WWW . '/images/ts/' . filter($_POST['topstory']);
	$content = filter($_POST['content']);
	$seoUrl = filter($_POST['url']);
	$category = intval($_POST['category']);
	
	if (strlen($seoUrl) < 1 || strlen($title) < 1 || strlen($teaser) < 1 || strlen($content) < 1)
	{
		fMessage('error', 'Please fill in all fields.');
	}
	else
	{
		db::query("INSERT INTO site_promo (title,category_id,seo_link,topstory_image,body,snippet,datestr,timestamp) VALUES ('" . $title . "','" . $category . "','" . $seoUrl . "','" . $topstory . "','" . $content . "','" . $teaser . "','" . date('d-M-Y') . "', '" . time() . "')");
		fMessage('ok', 'Promo article published.');
		
		header("Location: index.php?_cmd=promo");
		exit;
	}
}

require_once "top.php";

?>			

<script type="text/javascript">
function previewTS(el)
{
	document.getElementById('ts-preview').innerHTML = '<img src="<?php echo WWW; ?>/images/ts/' + el + '" />';
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
<head>
<script type='text/javascript' src='<?php echo WWW; ?>/manage/js/utils.js'></script> 
<script type='text/javascript' src='<?php echo WWW; ?>/manage/js/editor.js'></script> 
<script type="text/javascript" src="<?php echo WWW; ?>/manage/tiny_mce/tiny_mce.js"></script>
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
<div class="wrap"> 
	<div id="icon-edit" class="icon32"><br /></div> 
<h2>Adicionar nova promo��o</h2>  <img src="images/packi/typo.gif" style="float: right;">

<form method="post">


<div style="float: left;">
<div class="wrap"> 
<strong>Tit�lo da promo��o</strong><br />
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
<?php echo WWW; ?>/[id]-<input type="text" id="url" name="url" value="<?php if (isset($_POST['url'])) { echo clean($_POST['url']); } ?>" maxlength="120">/<br />
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

</div> 
</div> 


<div id="authordiv" class="postbox " > 
<div class="handlediv" title="Clique para expandir ou recolher."><br /></div><h3 class='hndle'><span>Categoria da Promo��o</span></h3> 
<div class="inside"> 
<label class="screen-reader-text" for="post_author_override">Categoria da Promo��o</label><select name='post_author_override' id='post_author_override' class=''> 
<strong>Categoria:</strong><br />
<select name="category">
<?php

$getOptions = db::query("SELECT * FROM site_promo_categories ORDER BY caption ASC");

while ($option = mysql_fetch_assoc($getOptions))
{
	echo '<option value="' . intval($option['id']) . '" ' . (($option['id'] == $_POST['category']) ? 'selected' : '') . '>' . clean($option['caption']) . '</option>';
}

?>
</select>
</select></div> 
</div> 
<div id="trackbacksdiv" class="postbox " > 
<div class="handlediv" title="Clique para expandir ou recolher."><br /></div><h3 class='hndle'><span>Topstory imagem</span></h3> 
<div class="inside" style="display:none;"> 
<p>	<select onkeypress="previewTS(this.value);" onchange="previewTS(this.value);" name="topstory" id="topstory" style="padding: 5px; font-size: 120%;">
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






<div style="clear: both;"></div>

<br /><br />


<input  class="button-primary" type="submit" value="Publicar">

</form>


<?php

require_once "bottom.php";

?>