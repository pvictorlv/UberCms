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

	$patterns[] = "#\r\n#si";
	$replacements[] = "<br />";

	$patterns[] = "#\n#si";
	$replacements[] = "<br />";

	$patterns[] = "#\[hr\]#si";
	$replacements[] = "<hr class=HR_Color />";	

	//Support Table here
	$patterns[] = "#\[table\]#si";
	$replacements[] = '<table align=center style="border-collapse: collapse;border-spacing: 0px;border: 1px solid #6CAFF7;background-color: #F4F4F4;width:98%;font-family:Verdana,Arial,Sans-Serif,Tahoma;font-size:12px;color: black;">';
	$patterns[] = "#\[\/table\]#si";
	$replacements[] = '</table>';
	$patterns[] = "#\[td\]#si";
	$replacements[] = '<td style="height:25px; border: 1px solid #6CAFF7">';
	$patterns[] = "#\[\/td\]#si";
	$replacements[] = '</td>';
	$patterns[] = "#\[tr\]#si";
	$replacements[] = '<tr>';
	$patterns[] = "#\[\/tr\]#si";
	$replacements[] = '</tr>';

	$patterns[] = "#\[(indent|blockquote)\]#si";
	$replacements[] = "<blockquote>";

	$patterns[] = "#\[\/(indent|blockquote)\]#si";
	$replacements[] = "</blockquote>";

	$patterns[] = "#\[(\/|)sub\]#si";
	$replacements[] = "<$1sub>";

	$patterns[] = "#\[(\/|)sup\]#si";
	$replacements[] = "<$1sup>";

	$patterns[] = "#\[(\/|)strike\]#si";
	$replacements[] = "<$1strike>";

	$patterns[] = "#\[(\/|)u\]#si";
	$replacements[] = "<$1u>";

	$patterns[] = "#\[(\/|)b\]#si";
	$replacements[] = "<$1strong>";

	$patterns[] = "#\[(\/|)i\]#si";
	$replacements[] = "<$1em>";

	$patterns[] = "#\[size=1\]#si";
	$replacements[] = '<span style="font-size: 8pt">';
	$patterns[] = "#\[size=2\]#si";
	$replacements[] = '<span style="font-size: 10pt">';
	$patterns[] = "#\[size=3\]#si";
	$replacements[] = '<span style="font-size: 12pt">';
	$patterns[] = "#\[size=4\]#si";
	$replacements[] = '<span style="font-size: 14pt">';
	$patterns[] = "#\[size=5\]#si";
	$replacements[] = '<span style="font-size: 18pt">';
	$patterns[] = "#\[size=6\]#si";
	$replacements[] = '<span style="font-size: 24pt">';
	$patterns[] = "#\[size=7\]#si";
	$replacements[] = '<span style="font-size: 36pt">';

	$patterns[] = "#\[font=(.*?)\]#si";
	$replacements[] = '<span style="font-family: $1">';

	$patterns[] = "#\[color=(.*?)\]#si";
	$replacements[] = '<span style="color: $1">';

	$patterns[] = "#\[highlight=(.*?)\]#si";
	$replacements[] = '<span style="background-color: $1">';

	$patterns[] = "#\[\/(font|color|size|highlight)\]#si";
	$replacements[] = '</span>';

	$patterns[] = "#\[(center|left|right|justify)\]#si";
	$replacements[] = "<div align=\"$1\">";

	$patterns[] = "#\[\/(center|left|right|justify)\]#si";
	$replacements[] = "</div>";

	$patterns[] = "#\[email=(.*?)\]#si";
	$replacements[] = '<a href="mailto:$1">';
	$patterns[] = "#\[email\](.*?)\[\/email\]#si";
	$replacements[] = '<a href="mailto:$1">$1[/email]';

	$patterns[] = "#\[url=(.*?)\]#si";
	$replacements[] = '<a href="$1">';
	$patterns[] = "#\[url\](.*?)\[\/url\]#si";
	$replacements[] = '<a href="$1">$1[/url]';

	$patterns[] = "#\[\/(email|url)\]#si";
	$replacements[] = "</a>";

	$patterns[] = "#\[img\](.*?)\[\/img\]#si";
	$replacements[] = '<img src="$1" alt="" />';

	$patterns[] = "#\[list=1\]#si";
	$replacements[] = "<ol>";

	$patterns[] = "#\[list\]#si";
	$replacements[] = "<ul>";

	$patterns[] = "#\[\*\]#si";
	$replacements[] = "<li>";

	$patterns[] = "#<br[^>]*><li>#si";
	$replacements[] = "<li>";

	$patterns[] = "#<br[^>]*> <li>#si";
	$replacements[] = "<li>";

	$patterns[] = "#<br[^>]*><\/li>#si";
	$replacements[] = "</li>";

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

	//Try to close tag <li>
	$output=str_replace("<li>","</li><li>",$output);
	$output=str_replace("<ul></li>","<ul>",$output);
	$output=str_replace("<ol></li>","<ol>",$output);
	$output=str_replace("</ul>","</li></ul>",$output);
	$output=str_replace("</ol>","</li></ol>",$output);

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
<title>HotEditor V4.2 - WYSIWYG to BBCode Converter (HTML to BBCode and BBCode to HTML) Support Safari</title>
<style>

hr {
	border: 0px none;
    width: 100%
}

hr.HR_Color { 
	color: #6593CF;
	background-color: #6593CF;
	height: 1px;
}

</style>
</head>

<body>
<form action="phpdemo.php" method="post" name=form1>
<div align="center" >
	<table border="0" width="800" >
		<tr>
			<td>
			<p align="center"><b><font size="4" color="#008000">HotEditor V.4.2 works with <br>	IE, FireFox, NetScape, Opera 9x and Safari 1.3.2 or higher</font></b><br>&nbsp;</td>
		</tr>
		<tr>
			<td><b><font face="Verdana">Preview</font></b></td>
		</tr>
		<tr>
			<td>
<div style="border:2px solid #6593CF;background-color:#DBE6F3;font-family: Verdana, Tahoma, Arial;font-size:12px;">
<?php 
	$xhtml= stripslashes(BBCodeToHTML($_POST[bbcode_holder]));
	print $xhtml; 
?>
</div>
			</td>
		</tr>
		<tr>
			<td>
				<br><b><font face="Verdana">xHTML Code Output</font></b><br>
				<textarea readonly wrap=off style="width:100%;height:150px;border:2px solid #6593CF;background-color:#FFFFE1;font-family: Verdana, Tahoma, Arial;font-size:12px;"><?php print $xhtml; ?></textarea>
			</td>
		</tr>
		<tr>
			<td>
				<br><b><font face="Verdana">Forum BBCode Output</font></b><br>
				<textarea readonly wrap=off style="width:100%;height:150px;border:2px solid #6593CF;background-color:#FFFFE1;font-family: Verdana, Tahoma, Arial;font-size:12px;"><?php print stripslashes($_POST[bbcode_holder]); ?></textarea>
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
					Instantiate("max","editor", getdata , "100%", "300px");

					//For Vietnamese User. Edit file editor.js to enable vietnamese keyboard
					if(enable_vietnamese_keyboard==1){
						document.write("<script language=\"JavaScript\" type=\"text/javascript\" src=avim.js><\/script>");
						var hoteditor_avim_method = hot_readCookie("hoteditor_avim_method");var him_auto_checked="";var him_telex_checked="";var him_vni_checked="";var him_viqr_checked="";var him_viqr2_checked="";var him_off_checked="";if(hoteditor_avim_method=="0"){him_auto_checked="checked";}else if(hoteditor_avim_method=="1"){him_telex_checked="checked";}else if(hoteditor_avim_method=="2"){him_vni_checked="checked";}else if(hoteditor_avim_method=="3"){him_viqr_checked="checked";}else if(hoteditor_avim_method=="4"){him_viqr2_checked="checked";}else if(hoteditor_avim_method=="-1"){him_off_checked="checked";}
						document.write("<div style='width:100%;text-align:center;font-family:Verdana;font-size:11px;'><input "+him_auto_checked+" id=him_auto onclick=setMethod(0); type=radio name=viet_method> Auto :: <input "+him_telex_checked+" id=him_telex onclick=setMethod(1); type=radio name=viet_method> Telex :: <input "+him_vni_checked+" id=him_vni onclick=setMethod(2); type=radio name=viet_method> VNI :: <input "+him_viqr_checked+" id=him_viqr onclick=setMethod(3); type=radio name=viet_method> VIQR :: <input "+him_viqr2_checked+" id=him_viqr2 onclick=setMethod(4); type=radio name=viet_method> VIQR* :: <input "+him_off_checked+" id=him_off onclick=setMethod(-1); type=radio name=viet_method> Off<br><img src="+styles_folder_path+"/vietnamese_symbol.gif></div>");
					}
			
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
			<td align=center><font size="2"><b>DEMO </b>Insert HTML (or Text) to HotEditor - Click icons below</font><br>
				<img style="CURSOR:hand; CURSOR:Pointer" onmousedown="if(editor_type==1){WriteHTML('<img src=smileys/1.gif>','editor');}else{WriteTEXT('[IMG]smileys/1.gif[/IMG]','editor');}" src="smileys/1.gif">
				<img style="CURSOR:hand; CURSOR:Pointer" onmousedown="if(editor_type==1){WriteHTML('<img src=smileys/2.gif>','editor');}else{WriteTEXT('[IMG]smileys/2.gif[/IMG]','editor');}" src="smileys/2.gif">
				<img style="CURSOR:hand; CURSOR:Pointer" onmousedown="if(editor_type==1){WriteHTML('<img src=smileys/3.gif>','editor');}else{WriteTEXT('[IMG]smileys/3.gif[/IMG]','editor');}" src="smileys/3.gif">
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

