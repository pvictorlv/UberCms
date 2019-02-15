<?php

	error_reporting('E_ALL ^ E_NOTICE');

	$parser_version = phpversion();
	if ($parser_version <= "4.1.0") { 
		$GET_VARS      	= $HTTP_GET_VARS ;
		$POST_VARS     	= $HTTP_POST_VARS;
		$SERVER_VARS   	= $HTTP_SERVER_VARS;
		$COOKIES  	 	= $HTTP_COOKIE_VARS;
		$FILES			= $HTTP_POST_FILES;
	}	
	else{ 
		$GET_VARS      	= $_GET;
		$POST_VARS     	= $_POST;
		$SERVER_VARS   	= $_SERVER;
		$COOKIES  		= $_COOKIE;
		$FILES			= $_FILES;
	}
	
	#Language
	$lang_Category ="Category";
	$lang_Upload_Text ="Upload your image files <br> (.gif - .jpg - .png)";

	#Upload file option
	$max_width = 500;
	$max_height = 500;
	$max_size = 50000; # bytes
	$show_cat_dropdown ="yes"; //say "yes" or "no"
	$pic_per_page = 50;
	$pic_per_row = 5;

	$script_filename=$SERVER_VARS['SCRIPT_FILENAME'] ;
	$real_path=str_replace("\\","/",$script_filename);
	$pathinfo = pathinfo($real_path);
	if($pathinfo[dirname]!=""){
		$richedit_dir =$pathinfo[dirname];
	}
	else{
		$richedit_dir ="../richedit";
	}

	$script_url = $SERVER_VARS['PHP_SELF'];

	$richedit_url = get_site_url(); //Or enter the URL to main forum folder - example: $richedit_url ="http://ecardmax.com/forum"; - NO / at the end
	$smiley_folder_url ="$richedit_url/smileys";
	$clipart_folder_url ="$richedit_url/cliparts";
	$wordart_folder_url ="$richedit_url/wordarts";
	$q_string = $SERVER_VARS['QUERY_STRING'];

	$step = $GET_VARS['step'];
	$step_upload = $POST_VARS['step_upload'];
	$cat = $GET_VARS['cat'];
	$page = $GET_VARS['page'];
	$what = $GET_VARS['what'];
	$first= $GET_VARS['first'];

	if ($what =="smileys"){
		$folder_url = $smiley_folder_url;
	}
	elseif ($what =="wordarts"){
		$folder_url = $wordart_folder_url;
	}
	elseif ($what =="cliparts"){
		$folder_url = $clipart_folder_url;
	}
	elseif ($what =="vk"){
		require_once "keyboard.php";
	}

	if (!file_exists("$richedit_dir/$what")){
		print "Path to folder richedit not found. Please use Text editor to open file richedit/show_it.php and edit <b>\$richedit_dir</b>";
		exit;
	}

	if ($fh = opendir("$richedit_dir/$what")) {
		while (($get_item = readdir($fh)) !== false) { 
			if ($get_item != "." && $get_item != ".." && is_dir("$richedit_dir/$what/$get_item")) {
				$get_it .="$get_item\n";
			} 
		}
		closedir($fh); 
	}
	
	$my_array_folder = explode("\n",$get_it);
	natsort($my_array_folder);
	$tt_pic = 0;
	foreach ($my_array_folder as $get_item){
		if ($get_item != ""){
			if ($fh = opendir("$richedit_dir/$what/$get_item")) {
				while (($get_subitem = readdir($fh)) !== false) { 
					if ($get_subitem != "." && $get_subitem != ".." && strpos($get_subitem,".gif") || strpos($get_subitem,".png") || strpos($get_subitem,".jpg")) {
						$tt_pic++;
					} 
				}
				closedir($fh); 
			$get_item2 = str_replace ("_"," ",$get_item);
			$random_img_cat = random_img_cat($get_item,$what);
			$folder .="<tr>\n";
			$folder .="<td class='Hoteditor_Select' STYLE=\"cursor:hand;cursor:pointer\" onClick=\"location.href='$script_url?what=$what&step=2&page=1&cat=$get_item';\" onMouseover=\"this.className='Hoteditor_Select_Over';\" onMouseout=\"this.className='Hoteditor_Select';\" align=\"center\" height=\"27\" >\n";
			$folder .="<font size=1>$lang_Category: <b>$get_item2 ($tt_pic)</b></font><br><img align=absmiddle src=$folder_url/$get_item/$random_img_cat> </td>\n";
			$folder .="</tr>\n";
			$drop_down_data .="<option value='$get_item'>$get_item2 ($tt_pic)</option>\n";
			$tt_pic = 0;
			}

		}
	}

	if ($show_cat_dropdown != "no"){
	$drop_down ="<form name=form_cat method=get action=$script_url><input type=hidden name=step value=2><input type=hidden name=what value=$what><input type=hidden name=first value=no><input type=hidden name=page value=1><select name=cat onchange=\"document.form_cat.submit();\"><option value=''>$lang_Category</option>$drop_down_data</select></form>";
	}

# Upload image file

if ($step =="upload"){
print<<<HTML_CODE

<html>
<head>

<script>
var get_styles_folder_path = self.parent.styles_folder_path;
get_styles_folder_path=get_styles_folder_path.replace("richedit/","");
document.writeln("<style type=text/css>@import url(" + get_styles_folder_path + "/style.css);</style>");
document.writeln("<style type=text/css>@import url(" + get_styles_folder_path + "/style_popup_layer.css);</style>");
</script>

</head>
<body>
<FORM method='POST' enctype="multipart/form-data" action="$script_url">
<input type="hidden" name="step_upload" value="1">
<div style="text-align:center;"><font size="4">$lang_Upload_Text</font></div><br>
<div align="center">
  <table class=Hoteditor_Main_Border cellpadding="0" cellspacing="0" width="360">
    <tr>
      <td width="572" background="none">
      <p align="center"><br>
      <font size="1">Your image's width must be less than <b>&lt; $max_width px</b><br>
      Your image's height must be less than <b>&lt; $max_height px</b><br>
      Your image's size must be less than <b>&lt; $max_size bytes</b></font></p>
      <div align="center">
        <center>		
        <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="62%" id="AutoNumber2" background="none">
          <tr>
            <td width="87%" background="none"><FONT face="verdana" size=1>Upload file from your computer</FONT></td>
          </tr>
          <tr>
            <td width="87%" background="none">
			<INPUT type=file name='filename' size=33>
			</td>
          </tr>
          <tr>
            <td width="87%" background="none"><hr color="#C0C0C0" size="1"></td>
          </tr>
          <tr>
            <td width="87%" background="none">
			
            <input type="submit" value="Upload now" name="B1"><br>
            <br></td>
          </tr>
        </table>
        </center>
      </div>
      </td>
    </tr>
    </table>
</div>
</form>
</body>
</html>

HTML_CODE;
exit;
}

if ($step_upload !=""){
	# Get random picture ID (picture file name)
	$upload_file_id = "2k". substr(md5(uniqid(rand(),1)), 0, 10); 

	$file_upload_name = $FILES['filename']['name'];
	$file_upload_size = $FILES['filename']['size'];
	$file = strtolower($file_upload_name) ;
	$get_length = strlen($file);
	$get_ext=substr($file,$get_length-3,3);

	//Check file type .gif - .jpg - .png
	if ($get_ext != "gif" && $get_ext != "jpg" && $get_ext != "png") {
		print "<script language=javascript>alert('Please upload file with extension .gif or .jpg or .png');window.history.back()</script>";
		exit ;	 
	}

	if($FILES['filename']['type'] != "image/gif" && $FILES['filename']['type'] != "image/png" && $FILES['filename']['type'] != "image/pjpeg" && $FILES['filename']['type'] !="image/jpeg") {
		print "<script language=javascript>alert('Image Type Error');window.history.back()</script>";
		exit ;	 
	}

	//Check file size
	if ($file_upload_size == 0){
		print "<script language=javascript>alert('Error. File upload size = 0');window.history.back()</script>";
		exit ;	 
	}

	# If size over $max_pic_size - Upload failed
	if ($file_upload_size > $max_size){
		print "<script language=javascript>alert('Error. File upload size > $max_size');window.history.back()</script>";
		exit ;
	}

	//Upload to server
	if (move_uploaded_file($FILES['filename']['tmp_name'], "$richedit_dir/upload/" . $upload_file_id . ".$get_ext" )) {
		chmod ("$richedit_dir/upload/" . $upload_file_id . ".$get_ext", 0777);
		$chk_img_size = @getimagesize ("$richedit_dir/upload/" . $upload_file_id . ".$get_ext"); 
		$upload_width = $chk_img_size[0];
		$upload_height = $chk_img_size[1];	

		if ($upload_width > $max_width || $upload_height > $max_height){
			print "<script language=javascript>alert('Error. Your upload image has image\'s width > $max_width or image\'s height > $max_height.');window.history.back()</script>";
			unlink("$richedit_dir/upload/" . $upload_file_id . ".$get_ext");
			exit;
		}

		$uploadpic_path ="$richedit_url/upload/" . $upload_file_id . ".$get_ext" ;
		$uploadpic_file_name = $upload_file_id . ".$get_ext" ;

print<<<HTML_CODE
<html>
<head>

<script>
if(self.parent.styles_folder_path){
	var get_styles_folder_path = self.parent.styles_folder_path;
}
else{
	var get_styles_folder_path = window.opener.styles_folder_path;
}

get_styles_folder_path=get_styles_folder_path.replace("richedit/","");
document.writeln("<style type=text/css>@import url(" + get_styles_folder_path + "/style.css);</style>");
document.writeln("<style type=text/css>@import url(" + get_styles_folder_path + "/style_popup_layer.css);</style>");
</script>

</head>
<body>

<p align="center"><b><font face="Verdana" size="2">Click image below to insert it to your document</font></b></p>
<div style="overflow:auto;height:190;width:100%;border: 1px solid black" align="center">
<p align="center"><img STYLE="cursor:hand;cursor: pointer" onClick="self.parent.InsertSymbol('<img border=0 src=$uploadpic_path>&nbsp;');self.parent.close_insert_pop();" border="0" src="$uploadpic_path" alt ="image file name: $uploadpic_file_name"></p>
</div>
</body></html>
HTML_CODE;
	}

	//Check width & height 

	exit;
}

# Read dir "smileys" - Display category folder
if ($step ==1){

print<<<EOF
<html>
<head>

<script>
	if(self.parent.styles_folder_path){
		var get_styles_folder_path = self.parent.styles_folder_path;
		var richselected = 1;
		var my_document =self.parent;
	}
	else{
		var get_styles_folder_path = window.opener.styles_folder_path;
		var richselected = 0;
		var my_document =window.opener;
	}
	get_styles_folder_path=get_styles_folder_path.replace("richedit/","");
	document.writeln("<style type=text/css>@import url(" + get_styles_folder_path + "/style.css);</style>");
	document.writeln("<style type=text/css>@import url(" + get_styles_folder_path + "/style_popup_layer.css);</style>");

</script>

</head>
<body leftmargin="0" rightmargin="0" marginwidth="0" marginheight="0" topmargin="0" bottommargin="0">
<table border="0" cellpadding="3" cellspacing="3" style="border-collapse: collapse" width="360" >
  <tr>
    <td width="68%" valign=top>&nbsp; <font size=1>Select categories below</font></td>
    <td width="32%" align="right">$drop_down</td>
  </tr>
</table>
<hr class=HR_Color>
<div style="overflow:auto;height:280;width:100%" align="center">
<table cellpadding="8" cellspacing="8" border="0" width="90%">
$folder
</table>
</div><br><br>
</body>
</html>
<script language=javascript>
	var my_what ="$what";
	if(my_what=="smileys"){
		self.parent.Set_smiles_path("$script_url?step=1&what=$what");
	}
	if(my_what=="wordarts"){
		self.parent.Set_wordarts_path("$script_url?step=1&what=$what");
	}
	if(my_what=="cliparts"){
		self.parent.Set_cliparts_path("$script_url?step=1&what=$what");
	}	
</script>
EOF;

}
else{ # step=2

		if($first =="yes"){
			$open_path ="$richedit_dir/$what";
		}
		else{
			$open_path ="$richedit_dir/$what/$cat";
		}

		if ($fh = opendir($open_path)) {
			while (($get_item = readdir($fh)) !== false) { 
				if ($get_item != "." && $get_item != ".." && strpos($get_item,".gif") || strpos($get_item,".png") || strpos($get_item,".jpg")) {
					$tmp_array .="$get_item\n"; 
					$total_pic++;
				} 
			}
			closedir($fh); 
		}

# Display thumbnail 

$array = explode("\n", $tmp_array);

if ($page == ""){$page = 1;} 
if ($page == 1) {
	$prev = 0;
	$next = $pic_per_page - 1;
}
else {
	$prev = ($page - 1) * $pic_per_page;
	$next = ($page * $pic_per_page) - 1;
}
	$next >= $total_pic and $next = $total_pic - 1;

$x = 0;
$y = 0;

if($first =="yes"){
	$src_path ="$folder_url";
}
else{
	$src_path ="$folder_url/$cat";
}

for ($y=$prev; $y<=$next; $y++) {
	$x++;
	$get_filename = $array[$y] ;
	$image_file .="&nbsp;&nbsp;<img class='Hoteditor_Select' STYLE=\"cursor:hand;cursor:pointer\" onClick=\"InsertImage('$src_path/$get_filename');\" onMouseover=\"this.className='Hoteditor_Select_Over';\" onMouseout=\"this.className='Hoteditor_Select';\" align=absmiddle src=$src_path/$get_filename> \n";
	if($x==$pic_per_row) {
		$image_file .="<hr class=HR_Color>\n";
		$x=0;
	}
}


if ($total_pic == 0){
$image_file ="<p align=center><font face=Verdana size=1><b>No image found in this category.</b></font></p>" ;
}

# Display Page Number ------------------------------------------------------------------------

$b = intval(($total_pic / $pic_per_page) + 1);
$display_page_number .="<font face='verdana' size=1>Page: {A}";

$x = 0;
$y = 0;
for($a_num=1; $a_num<=$b; $a_num++) {
	$y++;
	if ($y == $page) {
		$display_page_number .=" <font color=red>$a_num</font> ";
	}
	else {
		$display_page_number .=" <span style=\"cursor:pointer;cursor:hand;text-decoration:underline;font-weight: bold;\" onmousedown=\"location.href='$script_url?what=$what&page=$a_num&cat=$cat'\">$a_num</span> ";
	}
}

$display_page_number .=" </font>";

if ($page > 1) {
	$page_pr = $page - 1 ;
	$dpn ="<span style=\"cursor:pointer;cursor:hand;text-decoration:underline;font-weight: bold;\" onmousedown=\"location.href='$script_url?what=$what&page=$page_pr&cat=$cat'\"><img border=0 src=$richedit_url/prv.gif align='absmiddle' alt='Previous page: $page_pr'></span>";
	$display_page_number = str_replace("{A}", $dpn, $display_page_number);
}
else{
	$display_page_number = str_replace("{A}", "", $display_page_number);
}

if ($page < $y) {
	$page_ne = $page + 1 ;
	$display_page_number .=" <span style=\"cursor:pointer;cursor:hand;text-decoration:underline;font-weight: bold;\" onmousedown=\"location.href='$script_url?what=$what&page=$page_ne&cat=$cat'\"><img border=0 src=$richedit_url/next.gif align='absmiddle' alt='Next page: $page_ne'></span>";
}

$cat2 = str_replace("_"," ",$cat);
if ($first =="yes"){
	$display_home_more ="<span style=\"cursor:pointer;cursor:hand;text-decoration:underline;font-weight: bold;\" onmousedown=\"location.href='$script_url?what=$what&step=1'\">Click here for more images</span>";
}
else{
	$display_home_more ="<span style=\"cursor:pointer;cursor:hand;text-decoration:underline;font-weight: bold;\" onmousedown=\"location.href='$script_url?what=$what&step=1'\">Home</span>";
}

print<<<EOF
<html><head>
	<script>
	if(self.parent.styles_folder_path){
		var get_styles_folder_path = self.parent.styles_folder_path;
		var richselected = 1;
		var my_document =self.parent;
		var getcurrentrte=self.parent.currenteditor;
		var my_editor_type=self.parent.editor_type;
	}
	else{
		var get_styles_folder_path = window.opener.styles_folder_path;
		var richselected = 0;
		var my_document =window.opener;
		var getcurrentrte=window.opener.currenteditor;
		var my_editor_type=window.opener.editor_type;
	}
	get_styles_folder_path=get_styles_folder_path.replace("richedit/","");
	document.writeln("<style type=text/css>@import url(" + get_styles_folder_path + "/style.css);</style>");
	document.writeln("<style type=text/css>@import url(" + get_styles_folder_path + "/style_popup_layer.css);</style>");
	</script>

	<script language="JavaScript" type="text/javascript">

	var my_what ="$what";
	if(my_what=="smileys"){
		my_document.Set_smiles_path("$script_url?$q_string");
	}
	if(my_what=="wordarts"){
		my_document.Set_wordarts_path("$script_url?$q_string");
	}
	if(my_what=="cliparts"){
		my_document.Set_cliparts_path("$script_url?$q_string");
	}	
 
	function InsertImage(data) {				
		if(my_document.isKonqueror){
			my_document.InsertTextArea(data);
			window.close();
			return false;
		}
		else if(my_editor_type==1){
			if(my_document.isSafari){
				window.opener.SafariInsertImage(data);
			}
			else{
				if(my_what =="smileys"){
					my_document.InsertSymbol("<img border=0 src='" + data + "'> &nbsp;");
				}
				else{
					my_document.InsertSymbol("<br><img border=0 src='" + data + "'><br>&nbsp;");
				}
				my_document.close_insert_pop();
			}
		}
		else{
			my_document.InsertTextArea(data);			
		}
		if(richselected != 1)window.close();
	}
	</script>
	<style fprolloverstyle>A:hover {color: #008000}
    </style>
</head>
<body leftmargin="0" rightmargin="0" marginwidth="0" marginheight="0" topmargin="0" bottommargin="0">
<table border="0" cellpadding="3" cellspacing="3" style="border-collapse: collapse" width="360" >
  <tr>
    <td width="68%"><font face=verdana size=1>$display_home_more / $cat2 <font color=red>($total_pic)</font></font></td>
    <td width="32%" align="right">$drop_down</td>
  </tr>
</table>
<hr class=HR_Color>
<div style="overflow:auto;height:280;width:100%" align="center">
&nbsp; $display_page_number
<br><br>
<table cellpadding="0" cellspacing="0" border="0" style="border-collapse: collapse" bordercolor="#111111" height="37" width="90%">
<tr>
<td align="center" height="27" >
	$image_file
</td>
</tr>
</table>
</div><br><br>
</body>
</html>

EOF;


}

function random_img_cat($folder,$what){
	global $richedit_dir;
	$x=0;
	$rand_array="";
	if ($fh = opendir("$richedit_dir/$what/$folder")) {
		while (($get_item = readdir($fh)) !== false) { 
			if ($get_item != "." && $get_item != ".." && strpos($get_item,".gif") || strpos($get_item,".png") || strpos($get_item,".jpg")) {
				$rand_array .="$get_item\n"; 
				$x++;
			} 
		}
		closedir($fh); 
	}

	$array  = explode("\n", $rand_array);
	$num = rand(0,$x-1);
	$img_file = "$array[$num]";
	$x=0;
	return $img_file;
}

//--------------------------------------------------------------------------------
	//Get eCard URL	
	function get_site_url(){
		global $SERVER_VARS;
		$server_name = $SERVER_VARS['SERVER_NAME'];
		$scr_path = $SERVER_VARS['PHP_SELF'] ;
		$dir_name = pathinfo($scr_path);
		$dir_list = split("\/",$dir_name['dirname']);	
		$c = count($dir_list);		
		$tmp = "";
		for ($i=0; $i<$c;$i++){
			if ($dir_list[$i] !="")
				$tmp .= "/$dir_list[$i]";
		}
		return "http://$server_name$tmp";
	}
?>