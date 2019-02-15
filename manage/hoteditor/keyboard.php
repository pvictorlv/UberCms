<?php
	$first=$_GET[first];
	$first =str_replace("/","",$first);
	$first =str_replace("..","",$first);
	$keyboard_url="keyboard.php";
	require_once "vk_code/$first";

	$key_height = "22px";

	//Print Drop Down List of files inside vk_code folder
	$array_vk_files =get_list_file("vk_code","vk_");
	sort($array_vk_files);
	$myfirst =str_replace("vk_","",$first);
	$myfirst =str_replace(".php","",$myfirst);
	$dropdown ="<form name=form1 method=get action=keyboard.php>\n<input type=hidden name=what value=vk><select size=1 name=first onchange='SetFormat(\"\");document.form1.submit();'><option value=\"$first\">Select Keyboard - $myfirst</option>";
	foreach($array_vk_files as $file){
		if($file !=""){
			$file2 =str_replace("vk_","",$file);
			$file2 =str_replace(".php","",$file2);
			$dropdown .="<option value='$file'>$file2</option>\n";
		}
	}
	$dropdown .="</select> <input type=submit onClick='SetFormat(\"\");' value=Go></form>";

	$array_list = explode ("\n",$keyboard);
	$x = 0;
	$y = 0;
	$top = 20;
	foreach ($array_list as $key){
		if($key !=""){
			
			if(!(strpos($key,"UP")===false)){ 
				$x++;
				$key =str_replace("(UP),","",$key);
				$key =str_replace("(UP)","",$key);
				$data .="<div align=center><center><table width=95% id=up$x STYLE='position:absolute; visibility:hidden; left:8; top: $top; z-index: 1' cellpadding=1 cellspacing=1 border=0>\n<tr>\n\t";
			}
			elseif(!(strpos($key,"SPACE_BAR")===false)){ 
				$top = $top + $key_height + 10;
				$data .="<div align=center><center><table width=95% STYLE='position:absolute; visibility:visible; left:8; top: $top; z-index: 1' cellpadding=1 cellspacing=1 border=0>\n<tr>\n\t";
			}
			else{
				$top = $top + $key_height + 10;
				$y++;
				$data .="<div align=center><center><table width=95% id=dn$y STYLE='position:absolute; visibility:visible; left:8; top: $top; z-index: 1' cellpadding=1 cellspacing=1 border=0>\n<tr>\n\t";
			}
			$key_array = explode(",",$key);
			foreach($key_array as $val){
				$val =str_replace("comma",",",$val);
				$style_bkg_change =" onmouseover=\"this.className='Hoteditor_main_key_over';\" onmouseout=\"this.className='Hoteditor_main_key';\" ";
				if(!(strpos($val,"Tab")===false)){ 
					$data .="<td align=center> <div $style_bkg_change class=Hoteditor_main_key style='width:40px' align=center onclick=\"SetFormat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;');\">$val</div> </td>\n";
				}
				elseif(!(strpos($val,"CAP")===false)){
					$data .="<td align=center> <div $style_bkg_change id=mycap class=Hoteditor_main_key style='width:60px' align=center onclick=\"cap_click();\" >$val</div> </td>\n";
				}
				elseif(!(strpos($val,"Shift")===false)){
					$data .="<td align=center> <div $style_bkg_change class=Hoteditor_main_key style='width:60px' align=center onclick=\"shift_click();\">&#8593; Shift</div> </td>\n";
				}
				elseif(!(strpos($val,"ENTER")===false)){
					$data .="<td align=center> <div $style_bkg_change class=Hoteditor_main_key style='width:60px' align=center onclick=\"SetFormat('ENTER');\">$val</div> </td>\n";
				}
				elseif(!(strpos($val,"Ctrl")===false)){
					$data .="<td align=center> <div class=Hoteditor_main_key style='width:30px' align=center>$val</div> </td>\n";
				}
				elseif(!(strpos($val,"Alt")===false)){
					$data .="<td align=center> <div class=Hoteditor_main_key style='width:30px' align=center>$val</div> </td>\n";
				}
				elseif(!(strpos($val,"SPACE_BAR")===false)){
					$val ="SPACE BAR";
					$data .="<td align=center> <div style='width:200px' onmouseover=\"this.className='Hoteditor_normal_key_over';\" onmouseout=\"this.className='Hoteditor_normal_key';\" class=Hoteditor_normal_key align=center onclick=\"SetFormat('&nbsp;');\">$val</div> </td>\n";
				}
				else{
					$val_info = split(" ",$val);
					$val1=$val_info[0];
					$val2=$val_info[1];
					$val3=$val_info[2];
					$val4=$val_info[3];
					$val5=$val_info[4];
					$style_bkg_change =" onmouseover=\"this.className='Hoteditor_normal_key_over';\" onmouseout=\"this.className='Hoteditor_normal_key';\" ";

					if(count($val_info) == 1){
						if($val == "'"){
							$data .="<td align=center> <div $style_bkg_change class=Hoteditor_normal_key align=center onclick=\"SetFormat('\'');\">$val</div> </td>\n";
						}
						elseif($val == "BF"){
							$data .="<td align=center> <div $style_bkg_change class=Hoteditor_normal_key align=center onclick=\"SetFormat('BF');\">\\</div> </td>\n";
						}
						else{
							$data .="<td align=center> <div $style_bkg_change class=Hoteditor_normal_key align=center onclick=\"SetFormat('$val');\">$val</div> </td>\n";
						}
					}
					elseif(count($val_info) > 1){
						if($val1 =="'"){
							$sub1=""; $sub2=""; $sub3=""; $sub4=""; $sub5="";
							//$sub1="<sub class=Hoteditor_sub_key onmouseover=\"this.className='Hoteditor_sub_key_over';\" onmouseout=\"this.className='Hoteditor_sub_key';\" onclick=\"SetFormat('\'');\" title='$val1'>$val1</sub>";
							$sub1="<sub class=Hoteditor_sub_key onmouseover=\"this.className='Hoteditor_sub_key_over';\" onmouseout=\"this.className='Hoteditor_sub_key';\" onclick=\"SetFormat('\'');\" title='$val1'>$val1</sub>";
							if ($val2 !="") $sub2="<sup class=Hoteditor_sub_key onmouseover=\"this.className='Hoteditor_sub_key_over';\" onmouseout=\"this.className='Hoteditor_sub_key';\" onclick=\"SetFormat('$val2');\" title='$val2'>$val2</sup>";
							if ($val3 !="") $sub3="<sub class=Hoteditor_sub_key onmouseover=\"this.className='Hoteditor_sub_key_over';\" onmouseout=\"this.className='Hoteditor_sub_key';\" onclick=\"SetFormat('$val3');\" title='$val3'>$val3</sub>";
							if ($val4 !="") $sub4="<sup class=Hoteditor_sub_key onmouseover=\"this.className='Hoteditor_sub_key_over';\" onmouseout=\"this.className='Hoteditor_sub_key';\" onclick=\"SetFormat('$val4');\" title='$val4'>$val4</sup>";
							if ($val5 !="") $sub5="<sub class=Hoteditor_sub_key onmouseover=\"this.className='Hoteditor_sub_key_over';\" onmouseout=\"this.className='Hoteditor_sub_key';\" onclick=\"SetFormat('$val5');\" title='$val5'>$val5</sub>";
							if($sub4 ==""){
								$data .="<td align=center> <div class=Hoteditor_normal_key align=center>$sub1$sub2$sub3$sub4$sub5</div> </td>\n";
							}
							else{
								$data .="<td align=center> <div class=Hoteditor_normal_key align=center>$sub1$sub2$sub3$sub4$sub5</div> </td>\n";
							}
						}
						elseif($val1 == "BF"){
							$sub1=""; $sub2=""; $sub3=""; $sub4=""; $sub5="";
							$sub1="<sub class=Hoteditor_sub_key onmouseover=\"this.className='Hoteditor_sub_key_over';\" onmouseout=\"this.className='Hoteditor_sub_key';\" onclick=\"SetFormat('BF');\" title='\\'>\\</sub>";
							if ($val2 !="") $sub2="<sup class=Hoteditor_sub_key onmouseover=\"this.className='Hoteditor_sub_key_over';\" onmouseout=\"this.className='Hoteditor_sub_key';\" onclick=\"SetFormat('$val2');\" title='$val2'>$val2</sup>";
							if ($val3 !="") $sub3="<sub class=Hoteditor_sub_key onmouseover=\"this.className='Hoteditor_sub_key_over';\" onmouseout=\"this.className='Hoteditor_sub_key';\" onclick=\"SetFormat('$val3');\" title='$val3'>$val3</sub>";
							if ($val4 !="") $sub4="<sup class=Hoteditor_sub_key onmouseover=\"this.className='Hoteditor_sub_key_over';\" onmouseout=\"this.className='Hoteditor_sub_key';\" onclick=\"SetFormat('$val4');\" title='$val4'>$val4</sup>";
							if ($val5 !="") $sub5="<sub class=Hoteditor_sub_key onmouseover=\"this.className='Hoteditor_sub_key_over';\" onmouseout=\"this.className='Hoteditor_sub_key';\" onclick=\"SetFormat('$val5');\" title='$val5'>$val5</sub>";
							if($sub4 ==""){
								$data .="<td align=center> <div class=Hoteditor_normal_key align=center>$sub1$sub2$sub3$sub4$sub5</div> </td>\n";	
							}
							else{
								$data .="<td align=center> <div class=Hoteditor_normal_key align=center>$sub1$sub2$sub3$sub4$sub5</div> </td>\n";
							}
						}
						else{
							$sub1=""; $sub2=""; $sub3=""; $sub4=""; $sub5="";
							$sub1="<sub class=Hoteditor_sub_key onmouseover=\"this.className='Hoteditor_sub_key_over';\" onmouseout=\"this.className='Hoteditor_sub_key';\" onclick=\"SetFormat('$val1');\" title='$val1'>$val1</sub>";
							if ($val2 !="") $sub2="<sup class=Hoteditor_sub_key onmouseover=\"this.className='Hoteditor_sub_key_over';\" onmouseout=\"this.className='Hoteditor_sub_key';\" onclick=\"SetFormat('$val2');\" title='$val2'>$val2</sup>";
							if ($val3 !="") $sub3="<sub class=Hoteditor_sub_key onmouseover=\"this.className='Hoteditor_sub_key_over';\" onmouseout=\"this.className='Hoteditor_sub_key';\" onclick=\"SetFormat('$val3');\" title='$val3'>$val3</sub>";
							if ($val4 !="") $sub4="<sup class=Hoteditor_sub_key onmouseover=\"this.className='Hoteditor_sub_key_over';\" onmouseout=\"this.className='Hoteditor_sub_key';\" onclick=\"SetFormat('$val4');\" title='$val4'>$val4</sup>";
							if ($val5 !="") $sub5="<sub class=Hoteditor_sub_key onmouseover=\"this.className='Hoteditor_sub_key_over';\" onmouseout=\"this.className='Hoteditor_sub_key';\" onclick=\"SetFormat('$val5');\" title='$val5'>$val5</sub>";
							if($sub4 ==""){
								$data .="<td align=center> <div class=Hoteditor_normal_key align=center>$sub1$sub2$sub3$sub4$sub5</div> </td>\n";
							}
							elseif($val4 =="í" || $val4 =="ì" || $val4 =="î" || $val4 =="Ï" || $val4 =="Í" || $val4 =="Ì" || $val4=="&#970;" || $val4=="&#912;" || $val4=="&#943;"){
								$data .="<td align=center> <div class=Hoteditor_normal_key align=center>$sub1$sub2$sub3$sub4$sub5</div> </td>\n";
							}
							else{
								$data .="<td align=center> <div class=Hoteditor_normal_key align=center>$sub1$sub2$sub3$sub4$sub5</div> </td>\n";
							}
							
						}
					}
				}
			}
			$data .="</tr></table></center></div>";
		}
	}

print<<<HTML_CODE
<html>

<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">

<script>
var get_styles_folder_path = self.parent.styles_folder_path;
get_styles_folder_path=get_styles_folder_path.replace("richedit/","");
document.writeln("<style type=text/css>@import url(" + get_styles_folder_path + "/style.css);</style>");
function NoError() { 
	return(true); 
} 
onerror=NoError; 
</script>

</head>
<body bgcolor="#F8F8F8">

$dropdown
$data

</body>
</html>
<script language="JavaScript">
var getcurrentrte=self.parent.currenteditor;
var isIE=self.parent.isIE;
var isOpera9=self.parent.isOpera9;
var isSafari3=self.parent.isSafari3;
if(isIE){
	self.parent.frames[getcurrentrte].focus();
	document.onmousedown = EditorIEFocus();
}
var chk_cap = 0;
self.parent.SetKeyboard("$keyboard_url?first=$first");
	
	function EditorIEFocus(){
		self.parent.frames[getcurrentrte].focus();
	}

	function SetFormat(data) {
		if (data =="ENTER"){
			if(isOpera9){
				data ="<br/><br/>";
			}
			else if(isSafari3){
				data ="<br/>";
			}
			else{
				data ="<p></p>";
			}
		}
		self.parent.InsertSymbol(data);
		if(chk_cap == 1){
			cap_click();
			chk_cap = 0;
		}
	}

	function shift_click(){
		chk_cap = 1;
		cap_click();
	}

	function cap_click(){
		var i_x = $x;
		var i_y = $y;
		
			for(i = 1; i <= i_x; i++){
				if (document.all){
					if(document.all["up"+i].style.visibility == 'visible' ){
						document.all["up"+i].style.visibility = 'hidden';
					}
					else{
						document.all["up"+i].style.visibility = 'visible';
					}
				}
				else if(document.getElementById){
					if(document.getElementById("up"+i).style.visibility == 'visible'){
						document.getElementById("up"+i).style.visibility = 'hidden';		
					}
					else{
						document.getElementById("up"+i).style.visibility = 'visible';		
					}
				}
			}

			for(z = 1; z <= i_y; z++){
				if (document.all){
					if(document.all["dn"+z].style.visibility == 'hidden'){
						document.all["dn"+z].style.visibility = 'visible';
					}
					else{
						document.all["dn"+z].style.visibility = 'hidden';
					}
				}
				else if(document.getElementById){
					if(document.getElementById("dn"+z).style.visibility == 'hidden'){
						document.getElementById("dn"+z).style.visibility = 'visible';
					}
					else{
						document.getElementById("dn"+z).style.visibility = 'hidden';
					}
				}
			}		
	}	

</script>
HTML_CODE;
	exit;
	//---------------------------------------------------------------------------------------------------------
	//Get list file 
	function get_list_file($path,$pattern=""){
		$res =array();				
		$get_file="";		
		if (is_dir("$path")) {
			if ($fh = opendir("$path")){
				if ($pattern !=""){
					while (($file = readdir($fh)) !== false){ 					
						if (is_file("$path/$file")){
							if ($file != "." && $file != ".." && preg_match ("/$pattern/i", "$file")){ 
								$get_file .="$file\n"; 
							} 
						}
					}
				}
				else{
					while (($file = readdir($fh)) !== false){ 					
						if (is_file("$path/$file")){					
							if ($file != "." && $file != ".."){ 
								$get_file .="$file\n"; 
							} 
						}
					}						
				}
				$res = explode("\n", $get_file);	
				closedir($fh); 
			}
		}			
		return $res;
	}	

?>
