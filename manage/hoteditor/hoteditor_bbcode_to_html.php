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

	$patterns[] = "#\[email=(.*?)\]#si";
	$replacements[] = '<a href="mailto:$1">';

	$patterns[] = "#\[email\](.*?)\[\/email\]#si";
	$replacements[] = '<a href="mailto:$1">$1[/email]';

	$patterns[] = "#\[url=(.*?)\]#si";
	$replacements[] = '<a href="$1">';

	$patterns[] = "#\[url\](.*?)\[\/url\]#si";
	$replacements[] = '<a href="$1">$1[/url]';

	$patterns[] = "#\[\/(email|url)\]#si";
	$replacements[] = '</a>';

	$patterns[] = "#\[img\](.*?)\[\/img\]#si";
	$replacements[] = '<img src="$1">';

	$patterns[] = "#\[img=(.*?)\]\[\/img\]#si";
	$replacements[] = '<img src="$1">';

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