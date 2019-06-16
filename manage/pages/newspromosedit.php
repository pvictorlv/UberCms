<?php

if (!defined('IN_HK') || !IN_HK)
{
	exit;
}

if (!HK_LOGGED_IN || !$users->hasFuse(USER_ID, 'fuse_housekeeping_sitemanagement'))
{
	exit;
}

function fixTexter($str, $quotes = true, $clean = false, $ltgt = false, $transform = false, $guestbook = false)
    {
		$str = str_replace("\r\n","<br>",$str); 
$str = str_replace("[B]","<b>",$str); 
$str = str_replace("[/B]","</b>",$str); 
$str = str_replace("[img]","<img src='",$str); 
$str = str_replace("[/img]","'>",$str); 
$str = str_replace("[IMG]","<img src=",$str); 
$str = str_replace("[/IMG]",">",$str); 
$str = str_replace("[S]","<s>",$str); 
$str = str_replace("[/S]","</s>",$str); 
$str = str_replace("[UL]","<ul>",$str); 
$str = str_replace("[/UL]","</ul>",$str); 
$str = str_replace("[FLASH=425,350]", "<object type=application/x-shockwave-flash width=425 height=350 data=",$str);
$str = str_replace("[/FLASH]", "><param name=movie value= /></object>",$str);
$str = str_replace("[LI]","<li>",$str); 
$str = str_replace("[/LI]","</li>",$str); 
$str = str_replace("[OL]","<ol>",$str); 
$str = str_replace("[/OL]","</ol>",$str); 
$str = str_replace("[QUOTE]","<br /><table width='80%' bgcolor='#ffff66' align='center'><tr><td style='border: 1px dotted black'><font color=black><b>Quote:<br></b>",$str); 
$str = str_replace("[/QUOTE]","</font></td></tr></table>",$str); 
$str = str_replace("[I]","<i>",$str); 
$str = str_replace("[/I]","</i>",$str); 
$str = str_replace("[U]","<u>",$str); 
$str = str_replace("[/U]","</u>",$str); 
$str = str_replace("[SPOILER]",'[SPOILER]<font bgcolor ="#000000" color="#DDDDDD">',$str); 
$str = str_replace("[/SPOILER]","</font>[/SPOILER]",$str); 
		$str = str_replace("&Acirc;", "�", $str);
        $str = str_replace("¡", "�", $str);
        $str = str_replace("¿", "�", $str);
        $str = str_replace("�", "�", $str);
        $str = str_replace("ñ", "�", $str);
        $str = str_replace("�", "�", $str);
        $str = str_replace("á", "�", $str);
        $str = str_replace("�", "�", $str);
        $str = str_replace("é", "�", $str);
        $str = str_replace("�", "�", $str);
        $str = str_replace("ó", "�", $str);
        $str = str_replace("�", "�", $str);
        $str = str_replace("ú", "�", $str);
        $str = str_replace("�", "�", $str);
        $str = str_replace("ä", "�", $str);
        $str = str_replace("�", "", $str);
        $str = str_replace("�", "�", $str);
        $str = str_replace(")", "&#x29;", $str);
        $str = str_replace("(", "&#x28;", $str);
		$str = str_replace("¥", "�", $str);
		$str = str_replace("\\\\r\\\\n", "<br />", $str);
		$str = str_replace("\\\\\\\\r\\\\\\\\n", "<br />", $str);
        $str = str_replace("\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\'", "&apos;", $str);
        $str = str_replace("\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\&quot;", "&#x22;", $str);
        $str = str_replace("\'", "'", $str);
        $str = str_replace('\"', '"', $str);
        $str = str_replace("\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\"", "&#x22;", $str);
        $str = str_replace("\\\\\\\\\\\\\\\\r\\\\\\\\\\\\\\\\n", "<br />", $str);
        $str = str_replace('\\\\n', "<br />", $str);
        $str = str_replace('\\\\\\\\\\\\"', '"', $str);
        $str = str_replace('\\\\r\\\\n', "<br />", $str);
        $str = str_replace('\\\\\\\\r\\\\\\\\n', "<br />", $str);
		$str = str_replace('\r\n', "<br />", $str);
		$str = str_replace('\\', "", $str);
        
        if ($quotes) {
            $str = str_replace('"', "&#x22;", $str);
            $str = str_replace("'", "&apos;", $str);
        }
        
        
        
        if ($clean) {
            $str = str_replace("�", "N", $str);
            $str = str_replace("�", "n", $str);
            $str = str_replace("�", "A", $str);
            $str = str_replace("�", "a", $str);
            $str = str_replace("�", "E", $str);
            $str = str_replace("�", "e", $str);
            $str = str_replace("�", "O", $str);
            $str = str_replace("�", "o", $str);
            $str = str_replace("�", "U", $str);
            $str = str_replace("�", "u", $str);
            $str = str_replace("�", "I", $str);
            $str = str_replace("�", "i", $str);
        }
        
        if ($ltgt) {
            $str = str_replace("<", "&lt;", $str);
            $str = str_replace(">", "&gt;", $str);
        }
        
        if ($transform) {
            $str = str_replace("'", '"', $str);
        }
		
		if($guestbook) {
			$str = str_replace("&lt;br /&gt;", '<br />', $str);
			$str = str_replace("&lt;b&gt;", '<b>', $str);
			$str = str_replace("&lt;/b&gt;", '</b>', $str);
			$str = str_replace("&lt;u&gt;", '<u>', $str);
			$str = str_replace("&lt;/u&gt;", '</u>', $str);
			$str = str_replace("&lt;i&gt;", '<i>', $str);
			$str = str_replace("&lt;/i&gt;", '</i>', $str);
			$str = str_replace("&lt;/i&gt;", '<br />', $str);
			$str = preg_replace("/\&lt;a href=\"(.*?)\"\&gt;(.*?)\&lt;\/a&gt;/is", "<a href=\"$1\" target=\"_blank\">$2</a>", $str);
			$str = preg_replace("/\&lt;div class=\"bbcode-quote\"\&gt;(.*?)\&lt;\/div&gt;/is", "<div class=\"bbcode-quote\">$1</div>", $str);
			$str = preg_replace("/\&lt;span style=\"(.*?)\"\&gt;(.*?)\&lt;\/span&gt;/is", "<span style=\"$1\">$2</span>", $str);
			$str = preg_replace("/\&lt;span style=\"font-size: 14px\"\&gt;(.*?)\&lt;\/span&gt;/is", "<span style=\"font-size: 14px\">$1</span>", $str);
		}
        
        
        
        return $str;
    }

if (isset($_GET['nombre']))
{
	$Nombre = $gtfo->cleanWord($_GET['nombre']);


if (isset($_POST['title']))
{
	$title = filter($_POST['title']);
	$imagen = WWW . '/images/promos/' . filter($_POST['topstory']);
	$content = fixTexter($_POST['content']);
	
		db::query("UPDATE site_promos SET titulo='".$title."',imagen='".$imagen."',cuerpo='".$content."' WHERE titulo='".$Nombre."'");
		fMessage('ok', 'Configuraci�n guardada.');
		
		header("Location: index.php?_cmd=newspromos");
		exit;
	}

require_once "top.php";

$GetPromo = mysql_fetch_assoc(mysql_query("SELECT * FROM site_promos WHERE titulo='".$Nombre."'"));

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

<h1>Editar Promo</h1>
<form onsubmit = "content.value = document.getElementById('contenido').innerHTML" method="post">

<br />

<div style="float: left;">

<strong>Titulo:</strong><br />
<input type="text" value="<?php echo $GetPromo['titulo']; ?>" name="title" size="50" onkeyup="suggestSEO(this.value);" style="padding: 5px; font-size: 130%;"><br />
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
			
			if (isset($GetPromo['topstory']) && $GetPromo['topstory'] == $file)
			{
				echo ' selected';
			}
			
			echo '>' . $file . '</option>';
		}
	}

	?>
	</select>
	
</div>

<style type="text/css">

div.editable {
    width: 300px;
    height: 200px;
    border: 1px solid #ccc;
    padding: 5px;
}?
</style>

<div id="ts-preview" style="margin-left: -12px; padding: 5px; float: left; text-align: center; vertical-align: middle;">

	<small>(Seleccione una imagen Topstory de la lista para obtener una vista previa aqu�)</small>

</div>

<div style="clear: both;"></div>
<br>
<strong>Contenido:</strong><br>
<input type="hidden" name="content" />
	<div contentEditable="true" id="contenido" name="contenido" class="editable"><?php echo $GetPromo['cuerpo']; ?></div>
<br />
<br />

<input type="submit" value="Actualizar">

</form>


<?php }else{require_once 'pages/404.php';} ?>