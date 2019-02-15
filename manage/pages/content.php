<?php

if (!defined('IN_HK') || !IN_HK)
{
	exit;
}

if (!HK_LOGGED_IN || !$users->hasFuse(USER_ID, 'fuse_housekeeping_sitemanagement'))
{
	exit;
}

require_once "top.php";

$catId = $_GET['catId'];

if(!isset($_POST['category']) || !isset($_GET['category'])){ 
    foreach($_POST as $key => $value){
        if(strlen($value) > 0 && strlen($key) > 0){
            mysql_query("UPDATE cms_content SET contentvalue = '".FilterText($value, true)."' WHERE contentkey = '".FilterText($key, true)."' LIMIT 1") or die(mysql_error());
            
        }
    }
}
?>			

<h1>Administrar Content do painel</h1>

<br />

<p>
	Mude a parte do painel onde está escrito "NOTE" (no topo da página).
<img src="images/packi/ruler.gif" style="float: right;">

	</p>

<br />


<br><br><br><br><br><br><br><br>

<form action='index.php?_cmd=content&do=save' method='post' name='theAdminForm' id='theAdminForm'>
<table width="100%">

<?php

    $get_settings = mysql_query("SELECT * FROM cms_content WHERE category = '2' ORDER BY contentkey ASC") or die(mysql_error());
    while($row = mysql_fetch_assoc($get_settings)){
	if($row['contentkey'] !== "client-widescreen") {
        echo "<tr>
<td class='tablerow1'  width='40%'  valign='middle'><b>".$row['setting_title']."</b><div class='graytext'>".$row['setting_desc']."</div></td>
<td class='tablerow2'  width='60%'  valign='middle'>";
    if($row['fieldtype'] == "1"){
        // Dynamicly calculate the size of the boxes. Please note that due to the word-is-too-long-so-we-break-the-line
        // stuff we can't really determine it here so it may not be '100%' correct (eg. one line too few creating scrollbars.)
        $rows = ceil(strlen(stripslashes($row['contentvalue'])) / 60);
        // If it is too long, by the means of more than 10 rows, we stick with 10 (avoiding boxes that are way to large).
        if($rows > 10){ $rows = 10; }
        // Default amount of cols is 60, but we'll adjust it if it's only one line
        if($rows < 2){ $cols = strlen(stripslashes($row['contentvalue'])); } else { $cols = "60"; }
        if($rows < 2 && $cols > 3){ $cols = $cols + 10; } else { $cols = $cols + 1; } // give a little extra space
        echo "<br><textarea name='".$row['contentkey']."' cols='" . $cols . "' rows='" . $rows . "' wrap='soft' id='sub_desc'   class='multitext'>".stripslashes($row['contentvalue'])."</textarea>";
    } elseif($row['fieldtype'] == "2"){
        echo "<select name='".$row['contentkey']."' class='dropdown'><option value='1'>Habilitar</option><option value='0'"; if($row['contentvalue'] == "0"){ echo " selected='selected'"; } echo ">Desabilitar</option></select>";
    } elseif($row['fieldtype'] == "3"){
        echo "<select name='".$row['contentkey']."' class='dropdown'><option value='red'"; if($row['contentvalue'] == "red"){ echo " selected='selected'"; } echo ">Rojo</option><option value='blue'"; if($row['contentvalue'] == "blue"){ echo " selected='selected'"; } echo ">Azul</option><option value='white'"; if($row['contentvalue'] == "white"){ echo " selected='selected'"; } echo ">Sin Color</option><option value='green'"; if($row['contentvalue'] == "green"){ echo " selected='selected'"; } echo ">Verde</option></select>";        
    }
    echo "</td>
</tr>";
    }
   }
?>

</table>
<br>
<input type='submit' value='Salvar Alterações' class='realbutton' accesskey='s'></form>
<?php

require_once "bottom.php";

?>