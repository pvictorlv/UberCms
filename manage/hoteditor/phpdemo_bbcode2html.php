<?php
//Function BBCode to HTML that will work with Hoteditor.
function BBCodeToHTML($text){

	$patterns[] = "#&#";
	$replacements[] = '&amp;';

	$patterns[] = "#<#";
	$replacements[] = '&lt;';

	$patterns[] = "#>#";
	$replacements[] = '&gt;';

	$patterns[] = "#  #si";
	$replacements[] = '&nbsp;&nbsp;';

	$patterns[] = "#\t#si";
	$replacements[] = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';

	$patterns[] = "#\[(\/)indent\]#si";
	$replacements[] = '<$1blockquote>';

	$patterns[] = "#\[(sub|sup|strike|blockquote|b|i|u)\]#si";
	$replacements[] = '<$1>';

	$patterns[] = "#\[\/(sub|sup|strike|blockquote|b|i|u)\]#si";
	$replacements[] = '</$1>';

	$patterns[] = "#\[font=(.*?)\]#si";
	$replacements[] = '<font face="$1">';

	$patterns[] = "#\[color=(.*?)\]#si";
	$replacements[] = '<font color="$1">';

	$patterns[] = "#\[size=(.*?)\]#si";
	$replacements[] = '<font size="$1">';

	$patterns[] = "#\[highlight=(.*?)\]#si";
	$replacements[] = '<font style="background-color:$1">';

	$patterns[] = "#\[\/(font|color|size|highlight)\]#si";
	$replacements[] = '</font>';

	$patterns[] = "#\[center\]#si";
	$replacements[] = '<div align="center">';

	$patterns[] = "#\[left\]#si";
	$replacements[] = '<div align="left">';

	$patterns[] = "#\[right\]#si";
	$replacements[] = '<div align="right">';

	$patterns[] = "#\[justify\]#si";
	$replacements[] = '<div align="justify">';

	$patterns[] = "#\[\/(center|left|right|justify)\]#si";
	$replacements[] = '</div>';

	$patterns[] = "#\[email=(.*?)\]#si";
	$replacements[] = '<a href="mailto:$1">';

	$patterns[] = "#\[email\](.*?)\[\/email\]#si";
	$replacements[] = '<a href="mailto:$1">$1[/email]';

	$patterns[] = "#\[url=(.*?)\]#si";
	$replacements[] = '<a href="$1">';

	$patterns[] = "#\[url\](.*?)\[\/url\]#si";
	$replacements[] = '<a href="$1">$1[/url]';

	$patterns[] = "#\[img\](.*?)\[\/img\]#si";
	$replacements[] = '<img src="$1">';

	$patterns[] = "#\[img=(.*?)\]\[\/img\]#si";
	$replacements[] = '<img src="$1">';

	$patterns[] = "#\n+(\[list\])#si";
	$replacements[] = '[LIST]';

	$patterns[] = "#\n+(\[list=1\])#si";
	$replacements[] = '[LIST=1]';

	$patterns[] = "#\n+(\[\/list\])#si";
	$replacements[] = '[/LIST]';

	$patterns[] = "#\[list\]\n+#si";
	$replacements[] = '[LIST]';

	$patterns[] = "#\[list=1\]\n+#si";
	$replacements[] = '[LIST=1]';

	$patterns[] = "#\[\/list\]\n+#si";
	$replacements[] = '[\/LIST]';

	$patterns[] = "#\[hr\]#si";
	$replacements[] = '<hr>';

	$patterns[] = "#\[\/(email|url)\]#si";
	$replacements[] = '</a>';

	$patterns[] = "#\[list=1\]#si";
	$replacements[] = '<ol>';

	$patterns[] = "#\[list\]#si";
	$replacements[] = '<ul>';

	$patterns[] = "#\[\*\]#si";
	$replacements[] = '<li>';

	$patterns[] = "#\n#si";
	$replacements[] = '<br>';

	$patterns[] = "#<br[^>]*><li>#si";
	$replacements[] = '<li>';

	$patterns[] = "#<br[^>]*> <li>#si";
	$replacements[] = '<li>';

	$patterns[] = "#<br[^>]*><\/li>#si";
	$replacements[] = '</li>';

	$patterns[] = "#\[\/list\]#si";
	$replacements[] = '</list>';

	$patterns[] = "#\[FLASH=(.*?),(.*?)\](.*?)\[\/FLASH\]#si";
	$replacements[] = '<object width="$1" height="$2"><param name="movie" value="$3"></param><param name="wmode" value="transparent"></param><embed src="$3" type="application/x-shockwave-flash" wmode="transparent" width="$1" height="$2"></embed></object>';

	$text = preg_replace($patterns, $replacements, $text);
	
	if (preg_match("/<ol/si",$text) || preg_match("/<ul/si",$text)){
		$array=split("<",$text);
		$output="";
		$x=0;
		foreach($array as $line){
			if($x>0)$line="<".$line;
			if(preg_match("/<ol/i",$line)){
				$temp="</ol>";
			}
			elseif(preg_match("/<ul/i",$line)){
				$temp="</ul>";
			}
			if(preg_match("/<\/list>/i",$line)){
				$line=str_replace("</list>",$temp,$line);
			}
			$output.=$line;
			$x++;
		}
	}
	else{
		$output=$text;
	}

	return $output;
}
?>

<html>
<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="AUTHOR" content="eCardMAX.com">
<meta name="keywords" content="WYSIWYG,Rich Text Editor,HTML2BBCode,BBCode2HTML,HTMLTOBBCODE,BBCODETOHTML,HTML to BBCode, BBCode to HTML,JavaScript, Java, Applet, Java Applet, Make Friend, Love, Liebe, Amour, Amore, Friendship, Cool, Music, Midi, Photos, HTML, XML, DHTML, Flash, cgi, perl script, ecard, e-card, ecards, e-cards, postcard, postcards, guestbook, search, tell-a-friend, feedback form, weeding, header footer, email, random, java, birthday, internet, congratulation, baby, computer, music, realplayer, audio, upload, download, banner, poem, animated, skin, voice recorder, greeting card, php, mysql, erotic, webmaster, customized scripts, paypal, 2checkout, bluemountain, egreetings, eletronic greeting card, Card History, software, free">
<META name="verify-v1" content="Qn0+YWD3aQIAUPGXxHS4L4N55/EfUPI0O4JW804AKOs=" />
<meta name="description" content=""> 
<title>HotEditor V4.1 - WYSIWYG to BBCode Converter (HTML to BBCode and BBCode to HTML)</title>
</head>

<body>
<form action="phpdemo_bbcode2html.php" method="post" name=form1>
<div align="center" >
	<table border="0" width="800" >
		<tr>
			<td><b><font face="Verdana">Preview Submit</font></b></td>
		</tr>
		<tr>
			<td><hr></td>
		</tr>
		<tr>
			<td>
				<div style="border:2px solid #6593CF;background-color:#DBE6F3;font-family: Verdana, Tahoma, Arial;font-size:12px;">
				<?php print stripslashes(BBCodeToHTML($_POST[bbcode_holder])); ?>
				</div>
			</td>
		</tr>
	</table>
</div>

<div align="center">
	<table border="0" width="800">
		<tr>
			<td>
				<textarea style="visibility:hidden;position:absolute;top:0;left:0;" name="bbcode_holder" id="bbcode_holder" rows="1" cols="1" tabindex="2"><?php print stripslashes($_POST[bbcode_holder]); ?></textarea>
				<style type='text/css'>@import url(styles/office2007/style.css);</style>
				<script language="JavaScript" type="text/javascript" src="editor.js?version=4.1"></script>				
				<script language="JavaScript" type="text/javascript">
					var getdata =document.getElementById("bbcode_holder").value;
					Instantiate("max","editor", getdata , "800px", "300px");
			
					function get_hoteditor_data(){
						setCodeOutput();
						var bbcode_output=document.getElementById("hoteditor_bbcode_ouput_editor").value;//Output to BBCode
						document.getElementById("bbcode_holder").value = bbcode_output;
						document.form1.submit();
					}					
				</script>
			</td>
		</tr>		
		<tr>
			<td align=center><input type="submit" value="Submit" name="B1" onclick="get_hoteditor_data();"></td>
		</tr>
		<tr>
			<td align=center><b><font size="4">Tip:</font></b> Click icon <img src=styles/office2007/switch_richtext_on.gif> to convert BBCode to HTML or HTML to BBCode<br><br>
				<a href=index.html>Click here</a> to see 1 editor with all buttons<br>
				<a href=index_mini.html>Click here</a> to see mini editor (You can add/remove buttons by editting file editor.js)<br>
				<a href=index_2editors.html>Click here</a> to see 2 editors with all buttons on 1 page<br>
				<a href=index_rtl.html>Click here</a> to see text flow form Right To Left<br>
				<a href=phpdemo.php>Click here</a> to see PHP page Sample<br>
			</td>
		</tr>
	</table>
</div>
</form>
</body>

</html>

