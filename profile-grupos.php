<?
include("global.php");

// Definimos la ID de la pagina \\
$menu_id = "home";

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<style type="text/css">
.profiles {
	color: #FFF;
}
</style>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<base href="<?=$config['cms_base'];?>" />
<link href="images/css/header.css" rel="stylesheet" type="text/css" />
<link href="images/css/me.css" rel="stylesheet" type="text/css" />
<?  $is_exist = Db::query("Select * from `users` where username = '".htmlspecialchars($_GET['name'])."' ");
if($is_exist->rowCount()){
$drt = $is_exist->fetch(PDO::FETCH_ASSOC);
$prname = "Perfil de ".$drt['username'];
}else{ $prname = "Perfil no encontrado"; } ?>
<title><?=$config['cms_name']; ?> - <? echo $prname; ?></title>
<style type="text/css">
td,th {
	font-family: verdana;
	font-size: 11px;
}
.title_menu {
	color: #FFF;
	
}
 
body {
	margin-top: 0px;
	background-image: url(images/backgrounds/bg_fi_vw.png);

	background-position:top;
	background-color: #A8E3F9;
	background-repeat:repeat-x;
}
.submenu {
	color: #FFF;
}
.submenu_on {
	color: #000;
}
.rellall {	color: #F00;
}
.nick_pltb {
	font-size: 9px;
}
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}
a:hover {
	text-decoration: underline;
}
a:active {
	text-decoration: none;
}
</style>

<base href="<?=$config['cms_base'];?>" />

</head>

<body><? include("top.php"); ?>
<br><br>
<? $is_exist = Db::query("Select * from `users` where username = '".htmlspecialchars($_GET['name'])."' ");
if($is_exist->rowCount()){
$drt = $is_exist->fetch(PDO::FETCH_ASSOC);

if($drt['profile'] == "0"){
if($drt['username'] == $_SESSION['username']){ $access = true; }else{ $access = false; }
}elseif($drt['profile'] == "1"){
$ch = Db::query("Select * from `messenger_friendships` where user_one_id = '".$sys->UserInfo($username,"id")."'  and user_two_id = '".$drt['id']."' ");
if($ch->rowCount() ||  $drt['username'] == $_SESSION['username']){ $access = true; }else{ $access = false; }
}elseif($dt['profile'] == "2"){ $access = true; }else{ $access = true; }
if($access == true){
 ?>
<table width="929" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="929" height="71" align="center" style="border:1px solid #000; border-radius:3px 3px 3px 3px; background-color:#FFF;"><table width="928" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="929"><table width="99%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td background="gallery/box/homes.png"><table width="928" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td width="918"><?php
$allow_guests = true;

require_once('includes/core.php');


if(isset($_GET['tag']) || isset($_GET['name']) || isset($_POST['name'])){
	if(isset($_GET['tag'])){
	$searchname = FilterText($_GET['tag']);
	} else if(isset($_GET['name'])){
	$searchname = FilterText($_GET['name']);
	} else if(isset($_POST['name'])){
	$searchname = FilterText($_POST['name']);
	} else {
	$error = true;
	}

	$user_sql = Db::query("SELECT * FROM users WHERE username = '".$searchname."' LIMIT 1")
	$user_exists = $user_sql->rowCount();

	if($user_exists == "1"){
	$error = false;
	$user_row = $user_sql->fetch(PDO::FETCH_ASSOC);
	$pagename = "User Profile - ".$user_row['username']."";
		if($user_row['rank'] == "6"){
		$drank = "Administrator";
		} else if($user_row['rank'] == "5"){
		$drank = "Moderator";
		} else if($user_row['rank'] == "4"){
		$drank = "Staff member";
		} else if($user_row['rank'] < 4){
		$drank = "member";
		}
	} else {
	$error = true;
	}

} else if(isset($_GET['tagid']) || isset($_GET['id']) || isset($_POST['id'])){
	if(isset($_GET['tagid'])){
	$searchid = FilterText($_GET['tagid']);
	} else if(isset($_GET['id'])){
	$searchid = FilterText($_GET['id']);
	} else if(isset($_POST['id'])){
	$searchid = FilterText($_POST['id']);
	} else {
	$error = true;
	}

	$user_sql = Db::query("SELECT * FROM users WHERE id = '".$searchid."' LIMIT 1")
	$user_exists = $user_sql->rowCount();

	if($user_exists == "1"){
	$error = false;
	$user_row = $user_sql->fetch(PDO::FETCH_ASSOC);
	$pagename = "User Profile - ".$user_row['username']."";
		if($user_row['rank'] == "6"){
		$drank = "Administrator";
		} else if($user_row['rank'] == "5"){
		$drank = "Moderator";
		} else if($user_row['rank'] == "4"){
		$drank = "Staff member";
		} else if($user_row['rank'] < 4){
		$drank = "member";
		}
	} else {
	$error = true;
	}

} else {
$error = true;
}

if(isset($_GET['do']) && $_GET['do'] == "edit" && $logged_in){
	if($user_row['username'] == $name){
	$edit_mode = true;
	Db::query("UPDATE cms_homes_group_linker SET active = '0' WHERE userid = '".$my_id."' LIMIT 1")
	} else {
		echo'<script language="JavaScript" type="text/javascript">

var pagina="./home/'.$user_row['username'].'"
function redireccionar() 
{
location.href=pagina
} 
setTimeout ("redireccionar()", 0);

</script>';
	exit;
	$edit_mode = false;
	}
} else {
$edit_mode = false;
}

if(!$error){
$body_id = "viewmode";
	if($edit_mode){
	$body_id = "editmode";
	}
} else {
$body_id = "home";
}

if($searchname == $rawname && $logged_in){
$pageid = "myprofile";
} else {
$pageid = "profile";
}

$bg_fetch = Db::query("SELECT data FROM cms_homes_stickers WHERE type = '4' AND userid = '".$user_row['id']."' AND groupid = '-1' LIMIT 1");
$bg_exists = $bg_fetch->rowCount();

	if($bg_exists < 1){ // if there's no background override for this user set it to the standard
		$bg = "b_bg_pattern_abstract2";
	} else {
		$bg = $bg_fetch->fetch(PDO::FETCH_ASSOC);
		$bg = "b_" . $bg[0];
	}

if(!$error){
include('templates/community/hsubheader.php');
include('templates/community/header.php');
?>
                  <table width="100%"  height="49" border="0" align="center" cellpadding="0" cellspacing="0" >
                    <tr>
                      <td width="916"><div class="box-tabs-container box-tabs-left clearfix">
                        <?php if($user_row['username'] == $name && $edit_mode !== true){ ?>
                        <a href="home/<?php echo FilterText($name); ?>/edit" id="edit-button" class="new-button dark-button edit-icon" style="float:left"><b><span></span>Editar</b><i></i></a>
                        <?php } ?>
                        <h2 class="page-owner"><?php echo $user_row['username']; ?></h2>
                      </div>
                        <?php if($edit_mode == true){ ?>
                        <div id="top-toolbar" class="clearfix">
                          <ul>
                            <li><a href="#" id="inventory-button">Inventario</a></li>
                            <li><a href="#" id="webstore-button">Catalogo</a></li>
                          </ul>
                          <form action="#" method="get" style="width: 50%;">
                            <a id="cancel-button" class="new-button red-button cancel-icon" href="#"><b><span></span>Cancelar</b><i></i></a> <a id="save-button" class="new-button green-button save-icon" href="#"><b><span></span>Guardar</b><i></i></a>
                          </form>
                        </div>
                        <?php } ?></td>
                    </tr>
                  </table></td>
              </tr>
            </table></td>
          </tr>
        </table>
          <table  width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
              <td><div id="mypage-bg" class="<?php echo $bg; ?>">
                <div id="playground-outer">
                  <div id="playground">
                    <?php
$get_em = Db::query("SELECT id,type,x,y,z,data,skin,subtype,var FROM cms_homes_stickers WHERE userid = '".$user_row['id']."' AND groupid = '-1' AND type < 4 LIMIT 200")
$_SESSION['profile_id'] = $user_row['id'];
while ($row = $get_em, MYSQL_NUM->fetch(PDO::FETCH_ASSOC)) {

	switch($row[1]){
	default: $type = "sticker"; break;
	case 1: $type = "sticker"; break;
	case 2: $type = "widget"; break;
	case 3: $type = "stickie"; break;
	case 4: $type = "ignore"; break;
	}

	if($edit_mode == true){
	$edit = "\n<img src=\"./web-gallery/images/myhabbo/icon_edit.gif\" width=\"19\" height=\"18\" class=\"edit-button\" id=\"" . $type . "-" . $row[0] . "-edit\" />
<script language=\"JavaScript\" type=\"text/javascript\">
Event.observe(\"".$type."-".$row[0]."-edit\", \"click\", function(e) { openEditmenu(e, ".$row[0].", \"".$type."\", \"".$type."-".$row[0]."-edit\"); }, false);
</script>\n";
	} else {
	$edit = " ";
	}

	// old check
	if($user_row['rank'] > 5){
		$content = bbcode_format(nl2br(HoloText($row[5])));
	} else {
		$content = bbcode_format(nl2br(HoloText($row[5])));
	}

	if($type == "stickie"){
	printf("<div class=\"movable stickie n_skin_%s-c\" style=\" left: %spx; top: %spx; z-index: %s;\" id=\"stickie-%s\">
	<div class=\"n_skin_%s\" >
		<div class=\"stickie-header\">
			<h3>%s</h3>
			<div class=\"clear\"></div>
		</div>
		<div class=\"stickie-body\">
			<div class=\"stickie-content\">
				<div class=\"stickie-markup\">%s</div>
				<div class=\"stickie-footer\">
				</div>
			</div>
		</div>
	</div>
</div>",$row[6],$row[2],$row[3],$row[4],$row[0],$row[6],$edit,$content);
	} elseif($type == "sticker"){
	printf("<div class=\"movable sticker s_%s\" style=\"left: %spx; top: %spx; z-index: %s\" id=\"sticker-%s\">\n%s\n</div>", $row[5], $row[2], $row[3], $row[4], $row[0], $edit);
	} elseif($type == "widget"){

		switch($row[7]){
		case 1: $subtype = "Profilewidget"; break;
		case 2: $subtype = "GroupsWidget"; break;
		case 3: $subtype = "RoomsWidget"; break;
		case 4: $subtype = "GuestbookWidget"; break;
		case 5: $subtype = "FriendsWidget"; break;
		case 6: $subtype = "TraxPlayerWidget"; break;
		case 7: $subtype = "HighScoresWidget"; break;
		case 8: $subtype = "BadgesWidget";
		}

		if($subtype == "GroupsWidget"){
		$groups = mysql_evaluate("SELECT COUNT(*) FROM groups_memberships WHERE userid = '".$user_row['id']."' AND is_pending = '0' LIMIT 1");

			echo "<div class=\"movable widget GroupsWidget\" id=\"widget-".$row[0]."\" style=\" left: ".$row[2]."px; top: ".$row[3]."px; z-index: ".$row[4].";\">
<div class=\"w_skin_".$row[6]."\">
	<div class=\"widget-corner\" id=\"widget-".$row[0]."-handle\">
		<div class=\"widget-headline\"><h3><span class=\"header-left\">&nbsp;</span><span class=\"header-middle\">Mis grupos (<span id=\"groups-list-size\">".$groups."</span>)</span><span class=\"header-right\">".$edit."</span></h3>
		</div>
	</div>
	<div class=\"widget-body\">
		<div class=\"widget-content\">

<div class=\"groups-list-container\">
<ul class=\"groups-list\">";

$get_groups = Db::query("SELECT * FROM groups_memberships WHERE userid = '".$user_row['id']."' AND is_pending = '0'")
while($membership_row = $get_groups->fetch(PDO::FETCH_ASSOC)){
	$get_groupdata = Db::query("SELECT * FROM groups_details WHERE id = '".$membership_row['groupid']."' LIMIT 1")
	$grouprow = $get_groupdata->fetch(PDO::FETCH_ASSOC);

	echo "	<li title=\"".$grouprow['name']."\" id=\"groups-list-".$row[0]."-".$grouprow['id']."\">
		<div class=\"groups-list-icon\"><a href=\"groups/".$grouprow['id']."/id\"><img src='./habbo-imaging/badge?badge=".$grouprow['badge']."'/></a></div>
		<div class=\"groups-list-open\"></div>
		<h4>
		<a href=\"groups/".$membership_row['groupid']."/id\">".$grouprow['name']."</a>
		</h4>
		<p>
		Grupo creado:<br />";
		if($membership_row['is_current'] == 1){ echo "<div class=\"favourite-group\" title=\"Favourite\"></div>\n"; }
		if($membership_row['member_rank'] > 1 && $grouprow['ownerid'] !== $user_row['id']){ echo "<div class=\"admin-group\" title=\"Administrador\"></div>\n"; }
		if($grouprow['ownerid'] == $user_row['id'] && $membership_row['member_rank'] > 1){ echo "<div class=\"owned-group\" title=\"Due&ntilde;o\"></div>\n"; }
		echo "<b>".date("d/m/y", $grouprow['created'])."</b>
		</p>
		<div class=\"clear\"></div>
	</li>";

}

echo "</ul></div>

<div class=\"groups-list-loading\"><div><a href=\"#\" class=\"groups-loading-close\"></a></div><div class=\"clear\"></div><p style=\"text-align:center\"><img src=\"./web-gallery/images/progress_bubbles.gif\" alt=\"\" width=\"29\" height=\"6\" /></p></div>
<div class=\"groups-list-info\"></div>

		<div class=\"clear\"></div>
		</div>
	</div>
</div>
</div>

<script type=\"text/javascript\">
document.observe(\"dom:loaded\", function() {
	new GroupsWidget('".$user_row['id']."', '".$row[0]."');
});
</script>";
		} elseif($subtype == "Profilewidget"){

		$found_profile = true;
		
		$info = Db::query("SELECT * FROM users WHERE username = '".$searchname."' LIMIT 1")
		$userdata = $info->fetch(PDO::FETCH_ASSOC);
		$valid = $info->rowCount();

			if($valid > 0){
			echo "<div class=\"movable widget ProfileWidget\" id=\"widget-".$row[0]."\" style=\" left: ".$row[2]."px; top: ".$row[3]."px; z-index: ".$row[4].";\">
<div class=\"w_skin_".$row[6]."\">
	<div class=\"widget-corner\" id=\"widget-".$row[0]."-handle\">
		<div class=\"widget-headline\"><h3>" . $edit . "
<span class=\"header-left\">&nbsp;</span><span class=\"header-middle\">Mi usuario</span><span class=\"header-right\">&nbsp;</span></h3>
		</div>
	</div>
	<div class=\"widget-body\">
		<div class=\"widget-content\">
	<div class=\"profile-info\">

		<div class=\"name\" style=\"float: left\">
			<span class=\"name-text\">".$userdata['username']."</span>
		</div>

		<br class=\"clear\" />";

			if($userdata['online'] == "1"){ echo "<img alt=\"online\" src=\"./web-gallery/images/myhabbo/habbo_online_anim_big.gif\" />"; } else { echo "<img alt=\"offline\" src=\"./web-gallery/images/myhabbo/habbo_offline_big.gif\" />"; }

		echo "<div class=\"birthday text\">
	<strong>		 Registrado el:</strong>
		</div>
		<div class=\"birthday date\">
			".date("d/m/y", $userdata['account_created'])."
		</div>
		<div>";

echo "
        </div>
	</div>
	<div class=\"profile-figure\">
			<img alt=\"".$userdata['username']."\" src=\"http://www.habbo.es/habbo-imaging/avatarimage?figure=".$userdata['look']."&size=b&direction=4&head_direction=4&gesture=sml\" />
	</div>";
	if($userdata['id'] != $my_id && $logged_in == true){ 
	$sql = Db::query("SELECT * FROM messenger_friendships WHERE user_one_id = '".$my_id."' AND user_two_id = '".$userdata['id']."'");
	$rows = $sql->rowCount();
	if($rows < 1){
	?>
                    <div class="profile-friend-request clearfix"> <a href="./myhabbo/friends_add.php?id=<?php echo $userdata['id']; ?>" class="new-button" id="add-friend" style="float: left"><b>A&ntilde;adir como amigo</b><i></i></a></div>
                    <?php } }
	echo "<br clear=\"all\" style=\"display: block; height: 1px;\"/>
    <div id=\"profile-tags-panel\" style=\"border-top-width: 1px;border-top-style: dashed;border-top-color: black;\">
    <div id=\"profile-tag-list\">
<div id=\"profile-tags-container\">\n";

$get_tags = Db::query("SELECT * FROM users_tags WHERE user_id = '".$userdata['id']."' ORDER BY id LIMIT 20")
$rows = $get_tags->rowCount();

	$num = $get_tags->rowCount();
	if($num > 0){

		if($userdata['id'] == $my_id && $logged_in){
			while ($row1 = $get_tags->fetch(PDO::FETCH_ASSOC)){


				printf("    <span class=\"tag-search-rowholder\">
        <a href=\"#\" class=\"tag-search-link tag-search-link-%s\"
        >%s</a><img border=\"0\" class=\"tag-delete-link tag-delete-link-%s\" onMouseOver=\"this.src='./web-gallery/images/buttons/tags/tag_button_delete_hi.gif'\" onMouseOut=\"this.src='./web-gallery/images/buttons/tags/tag_button_delete.gif'\" src=\"./web-gallery/images/buttons/tags/tag_button_delete.gif\"
        /></span>", $row1['tag'], $row1['tag'], $row1['tag'], $row1['tag']);
			}
		} elseif($logged_in){
			while ($row1 = $get_tags->fetch(PDO::FETCH_ASSOC)){


				printf("    <span class=\"tag-search-rowholder\">
        <a href=\"#\" class=\"tag-search-link tag-search-link-%s\"
        >%s</a><img border=\"0\" class=\"tag-add-link tag-add-link-%s\" onMouseOver=\"this.src='./web-gallery/images/buttons/tags/tag_button_add_hi.gif'\" onMouseOut=\"this.src='./web-gallery/images/buttons/tags/tag_button_add.gif'\" src=\"./web-gallery/images/buttons/tags/tag_button_add.gif\"
        /></span>", $row1['tag'], $row1['tag'], $row1['tag'], $row1['tag']);
			}
		} else {
			while ($row1 = $get_tags->fetch(PDO::FETCH_ASSOC)){


				printf("    <span class=\"tag-search-rowholder\">
        <a href=\"#\" class=\"tag-search-link tag-search-link-%s\"
        >%s</a></span>", $row1['tag'], $row1['tag'], $row1['tag'], $row1['tag']);
			}
		}

	} else {
		echo "No tienes tags.";
	}

echo "\n    <img id=\"tag-img-added\" border=\"0\" src=\"./web-gallery/images/buttons/tags/tag_button_added.gif\" style=\"display:none\"/>
</div>

<script type=\"text/javascript\">
    document.observe(\"dom:loaded\", function() {
        TagHelper.setTexts({
            buttonText: \"OK\",
            tagLimitText: \"Hay un limite de 20 tags\"
        });
    });
</script>
    </div>
<div id=\"profile-tags-status-field\">
 <div style=\"display: block;\">
  <div class=\"content-red\">
   <div class=\"content-red-body\">
    <span id=\"tag-limit-message\"><img src=\"./web-gallery/images/register/icon_error.gif\"/> Hay un limite de 20 tags</span>
    <span id=\"tag-invalid-message\"><img src=\"./web-gallery/images/register/icon_error.gif\"/> Tag invalido.</span>
   </div>
  </div>
 <div class=\"content-red-bottom\">
  <div class=\"content-red-bottom-body\"></div>
 </div>
 </div>
</div>";


if($userdata['id'] == $my_id){
        echo "<div class=\"profile-add-tag\">
            <input type=\"text\" id=\"profile-add-tag-input\" maxlength=\"30\"/><br clear=\"all\"/>
            <a href=\"#\" class=\"new-button\" style=\"float:left;margin:5px 0 0 0;\" id=\"profile-add-tag\"><b>A&ntilde;adir tag</b><i></i></a>
        </div>";
}
    echo "</div>
    <script type=\"text/javascript\">
		document.observe(\"dom:loaded\", function() {
			new ProfileWidget('".$userdata['id']."', '".$userdata['id']."', {
				headerText: \"�Estas seguro?\",
				messageText: \"&iquest;Estas seguro que quieres a&ntilde;adir como amigo a <strong\>".$userdata['username']."</strong\>? El deber&aacute; aceptar tu petici&oacute;n.\",
				buttonText: \"OK\",
				cancelButtonText: \"Cancelar\"
			});
		});
	</script>
		<div class=\"clear\"></div>
		</div>
	</div>
</div></div>";
	}
	} elseif($subtype == "GuestbookWidget"){
	$sql = Db::query("SELECT * FROM cms_guestbook WHERE widget_id = '".$row['0']."' ORDER BY id DESC");
	$count = $sql->rowCount();

		$status = "public";

	?>
                    <div class="movable widget GuestbookWidget" id="widget-<?php echo $row['0']; ?>" style=" left: <?php echo $row['2']; ?>px; top: <?php echo $row['3']; ?>px; z-index: <?php echo $row['4']; ?>;">
                      <div class="w_skin_<?php echo $row['6']; ?>">
                        <div class="widget-corner" id="widget-<?php echo $row['0']; ?>-handle">
                          <div class="widget-headline">
                            <h3> <?php echo $edit; ?> <span class="header-left">&nbsp;</span><span class="header-middle">Mi libro de visitas(<span id="guestbook-size"><?php echo $count; ?></span>) <span id="guestbook-type" class="<?php echo $status; ?>"><img src="./web-gallery/images/groups/status_exclusive.gif" title="Friends only" alt="Friends only"/></span></span><span class="header-right">&nbsp;</span></h3>
                          </div>
                        </div>
                        <div class="widget-body">
                          <div class="widget-content">
                            <div id="guestbook-wrapper" class="gb-public">
                              <ul class="guestbook-entries" id="guestbook-entry-container">
                                <?php if($count == 0){ ?>
                                <div id="guestbook-empty-notes">Este es tu libro de visitas. Actualmente est&aacute; vac&iacute;o, pero puedes invitar a tus amigos para que a&ntilde;aden un mensaje un mensaje en tu libro.</div>
                                <?php } else { ?>
                                <?php 
			$i = 0;
			while ($row1 = $sql->fetch(PDO::FETCH_ASSOC)) {
				$i++;
				$userrow = Db::query("SELECT * FROM users WHERE id = '".$row1['userid']."' LIMIT 1")->fetch(PDO::FETCH_ASSOC);
				if($my_id == $row1['userid']){
					$owneronly = "<img src=\"./web-gallery/images/myhabbo/buttons/delete_entry_button.gif\" id=\"gbentry-delete-".$row1['id']."\" class=\"gbentry-delete\" style=\"cursor:pointer\" alt=\"\"/><br/>";
				} elseif($user_row['id'] == $my_id) {
					$owneronly = "<img src=\"./web-gallery/images/myhabbo/buttons/delete_entry_button.gif\" id=\"gbentry-delete-".$row1['id']."\" class=\"gbentry-delete\" style=\"cursor:pointer\" alt=\"\"/><br/>";
				} else {
					$owneronly = "";
				}
				if($row1['online'] == "1"){ $useronline = "online"; } else { $useronline = "offline"; }
				printf("	<li id=\"guestbook-entry-%s\" class=\"guestbook-entry\">
		<div class=\"guestbook-author\">
			<img title=\"%s\" src=\"http://www.habbo.es/habbo-imaging/avatarimage?figure=".$userrow['look']."&direction=2&head_direction=2&gesture=sml&size=s\" alt=\"%s\" title=\"%s\"/>
		</div>
			<div class=\"guestbook-actions\">
					$owneronly
			</div>
		<div class=\"guestbook-message\">
			<div class=\"%s\">
			<strong>	<a href=\"./home/%s\">%s</a></strong>
			</div>
			<p><br />
%s</p>
		</div>
		<div class=\"guestbook-cleaner\">&nbsp;</div>
		<div class=\"guestbook-entry-footer metadata\">".$row1['time']."</div>
	</li>",$row1['id'], $userrow['look'], $userrow['username'], $userrow['username'], $useronline, $userrow['username'], $userrow['username'], HoloText($row1['message'],false ,true), $userrow['time']);
			}
	} ?>
                              </ul>
                            </div>
                            <?php if($edit_mode == false){ ?>
                           <? if(LOGGED_IN){ ?> <div class="guestbook-toolbar clearfix"> <a href="#" class="new-button envelope-icon" id="guestbook-open-dialog"> <b><span></span>A&ntilde;adir nuevo</b><i></i></a></div><? } ?>
                            <?php } ?>
                            <script type="text/javascript">	
	document.observe("dom:loaded", function() {
		var gb<?php echo $row['0']; ?> = new GuestbookWidget('17570', '<?php echo $row['0']; ?>', 500);
		var editmenuSection = $('guestbook-privacy-options');
		if (editmenuSection) {
			gb<?php echo $row['0']; ?>.updateOptionsList('public');
		}
	});
              </script>
                            <div class="clear"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php
	} elseif($subtype == "HighScoresWidget"){
	?>
                    <div class="movable widget HighScoresWidget" id="widget-<?php echo $row['0']; ?>" style=" left: <?php echo $row['2']; ?>px; top: <?php echo $row['3']; ?>px; z-index: <?php echo $row['4']; ?>;">
                      <div class="w_skin_<?php echo $row['6']; ?>">
                        <div class="widget-corner" id="widget-<?php echo $row['0']; ?>-handle">
                          <div class="widget-headline">
                            <h3><?php echo $edit; ?><span class="header-left">&nbsp;</span><span class="header-middle">HIGH SCORES</span><span class="header-right">&nbsp;</span></h3>
                          </div>
                        </div>
                        <div class="widget-body">
                          <div class="widget-content">
                            <?php
	$bbsql = Db::query("SELECT * FROM users WHERE id = '".$user_row['id']."' LIMIT 1");
	$bbrow = $bbsql->fetch(PDO::FETCH_ASSOC);
	if($bbrow['bb_playedgames'] == "0"){
		echo "You have not played any games yet.";
	}else{ ?>
                            <table>
                              <tr colspan="2">
                                <th>Battle Ball</a></th>
                              </tr>
                              <tr>
                                <td>Games played</td>
                                <td><?php echo $bbrow['bb_playedgames']; ?></td>
                              </tr>
                              <tr>
                                <td>Total score</td>
                                <td><?php echo $bbrow['bb_totalpoints']; ?></td>
                              </tr>
                            </table>
                            <?php } ?>
                            <div class="clear"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php
	} elseif($subtype == "FriendsWidget"){ 
	$sql = Db::query("SELECT * FROM messenger_friendships WHERE user_one_id = '".$user_row['id']."' ");
	$count = $sql->rowCount();
	?>
                    <div class="movable widget FriendsWidget" id="widget-<?php echo $row['0']; ?>" style=" left: <?php echo $row['2']; ?>px; top: <?php echo $row['3']; ?>px; z-index: <?php echo $row['4']; ?>;">
                      <div class="w_skin_<?php echo $row['6']; ?>">
                        <div class="widget-corner" id="widget-<?php echo $row['0']; ?>-handle">
                          <div class="widget-headline">
                            <h3><?php echo $edit; ?><span class="header-left">&nbsp;</span><span class="header-middle">Mis amigos (<?php echo $count; ?>)</span><span class="header-right">&nbsp;</span></h3>
                          </div>
                        </div>
                        <div class="widget-body">
                          <div class="widget-content">
                            <div id="avatar-list-search">
                              <input type="text" style="float:left;" id="avatarlist-search-string"/>
                              <a class="new-button" style="float:left;" id="avatarlist-search-button"><b>Buscar</b><i></i></a></div>
                            <br clear="all"/>
                            <div id="avatarlist-content">
                              <?php
$bypass = true;
$widgetid = $row['0'];
$user = $user_row['id'];
include('./myhabbo/avatarlist_friendsearchpaging.php');
?>
                              <script type="text/javascript">
document.observe("dom:loaded", function() {
	window.widget<?php echo $row['0']; ?> = new FriendsWidget('<?php echo $user_row['id']; ?>', '<?php echo $row['0']; ?>');
});
              </script>
                            </div>
                            <div class="clear"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php
	} elseif($subtype == "TraxPlayerWidget"){ ?>
                    <div class="movable widget TraxPlayerWidget" id="widget-<?php echo $row['0']; ?>" style=" left: <?php echo $row['2']; ?>px; top: <?php echo $row['3']; ?>px; z-index: <?php echo $row['4']; ?>;">
                      <div class="w_skin_<?php echo $row['6']; ?>">
                        <div class="widget-corner" id="widget-<?php echo $row['0']; ?>-handle">
                          <div class="widget-headline">
                            <h3><?php echo $edit; ?><span class="header-left">&nbsp;</span><span class="header-middle">TRAXPLAYER</span><span class="header-right">&nbsp;</span></h3>
                          </div>
                        </div>
                        <div class="widget-body">
                          <div class="widget-content">
                            <?php 
if($row['8'] == ""){ $songselected = false; }else{ $songselected = true; }
if($edit_mode == true){ ?>
                            <div id="traxplayer-content" style="text-align: center;"> <img src="./web-gallery/images/traxplayer/player.png"/></div>
                            <div id="edit-menu-trax-select-temp" style="display:none">
                              <select name="trax-select-options-temp" id="trax-select-options-temp">
                                <option value="">- Choose song -</option>
                                <?php
	$mysql = Db::query("SELECT * FROM furniture WHERE ownerid = '".$user_row['id']."'");
	$i = 0;
	while($machinerow = $mysql->fetch(PDO::FETCH_ASSOC)){
		$i++;
		$sql = Db::query("SELECT * FROM soundmachine_songs WHERE machineid = '".$machinerow['id']."'");
		$n = 0;
		while($songrow = $sql->fetch(PDO::FETCH_ASSOC)){
			$n++;
			if($songrow['id'] <> ""){ echo "		<option value=\"".$songrow['id']."\">".trim(nl2br(HoloText($songrow['title'])))."</option>\n"; }
		}
	} ?>
                              </select>
                            </div>
                            <?php }elseif($songselected == false){ ?>
                            You do not have a selected Trax song.
                            <?php }else{
$sql1 = Db::query("SELECT * FROM soundmachine_songs WHERE id = '".$row['8']."' LIMIT 1");
$songrow1 = $sql->fetch(PDO::FETCH_ASSOC); ?>
                            <div id="traxplayer-content" style="text-align:center;"></div>
                            <embed type="application/x-shockwave-flash"
src="<?php echo $path; ?>web-gallery/flash/traxplayer/traxplayer.swf" name="traxplayer" quality="high"
base="<?php echo $path; ?>web-gallery/flash/traxplayer/" allowscriptaccess="always" menu="false"
wmode="transparent" flashvars="songUrl=<?php echo $path; ?>myhabbo/trax_song.php?songId=<?php echo $row['8']; ?>&amp;sampleUrl=http://images.habbohotel.com/dcr/hof_furni//mp3/" height="66" width="210" />
                            </embed>
                            <?php } ?>
                            <div class="clear"></div>
                          </div>
                        </div>
                      </div>
                    </div>
     <?php } elseif($subtype == "BadgesWidget"){
	$sql = Db::query("SELECT * FROM user_badges WHERE user_id = '".$user_row['id']."' ORDER BY badge_id ASC");
	$count = $sql->rowCount();
	?>
<div class="movable widget BadgesWidget" id="widget-<?php echo $row['0']; ?>" style=" left: <?php echo $row['2']; ?>px; top: <?php echo $row['3']; ?>px; z-index: <?php echo $row['4']; ?>;">
<div class="w_skin_<?php echo $row['6']; ?>">
	<div class="widget-corner" id="widget-<?php echo $row['0']; ?>-handle">
		<div class="widget-headline"><h3><?php echo $edit; ?><span class="header-left">&nbsp;</span><span class="header-middle">Placas y Recompensas</span><span class="header-right">&nbsp;</span></h3>
		</div>	
	</div>
	<div class="widget-body">
		<div class="widget-content">
    <div id="badgelist-content">

	<?php if($count == 0){ echo "No hay placas disponibles."; 
	} else {
	$bypass1 = true;
	$widgetid = $row['0'];
	include('./habblet/myhabbo_badgelist_badgepaging.php');
    } ?>
        <script type="text/javascript">
        document.observe("dom:loaded", function() {
            window.badgesWidget<?php echo $row['0']; ?> = new BadgesWidget('<?php echo $user_row['id']; ?>', '<?php echo $row['0']; ?>');
        });
        </script>
    </div>
		<div class="clear"></div>
		</div>
	</div>

</div>
</div>
                    <?php
	}
}
}

if($found_profile !== true){

$info = Db::query("SELECT * FROM users WHERE username = '".$searchname."' LIMIT 1")
$userdata = $info->fetch(PDO::FETCH_ASSOC);
$valid = $info->rowCount();

	if($valid > 0){

	Db::query("INSERT INTO cms_homes_stickers (userid,type,subtype,x,y,z,skin) VALUES ('".$userdata['id']."','2','1','25','25','5','defaultskin')")
?>
                    <div class="movable widget FriendsWidget" id="widget-<?php echo $row['0']; ?>" style=" left: <?php echo $row['2']; ?>px; top: <?php echo $row['3']; ?>px; z-index: <?php echo $row['4']; ?>;"> <?php echo "<div class=\"w_skin_defaultskin\">
	<div class=\"widget-corner\" id=\"widget-".$row['id']."-handle\">
		<div class=\"widget-headline\"><h3>" . $edit . "
<span class=\"header-left\">&nbsp;</span><span class=\"header-middle\">Mi usuario</span><span class=\"header-right\">&nbsp;</span></h3>
		</div>
	</div>
	<div class=\"widget-body\">
		<div class=\"widget-content\">
	<div class=\"profile-info\">

		<div class=\"name\" style=\"float: left\">
			<span class=\"name-text\">".$userdata['username']."</span>
		</div>

		<br class=\"clear\" />";

			if($userdata['online'] == "1"){ echo "<img alt=\"online\" src=\"./web-gallery/images/myhabbo/habbo_online_anim.gif\" />"; } else { echo "<img alt=\"offline\" src=\"./web-gallery/images/myhabbo/habbo_offline.gif\" />"; }

		echo "<div class=\"birthday text\">
			<strong>Registrado el:</strong>
		</div>
		<div class=\"birthday date\">
			".date("d/m/y", $userdata['account_created'])."
		</div>
		<div>";
echo "
        </div>
	</div>
	<div class=\"profile-figure\">
			<img alt=\"".$userdata['username']."\" src=\"http://www.habbo.es/habbo-imaging/avatarimage?figure=".$userdata['look']."&size=b&direction=4&head_direction=4&gesture=sml\" />
	</div>
	<br clear=\"all\" style=\"display: block; height: 1px\"/>
    <div id=\"profile-tags-panel\">
    <div id=\"profile-tag-list\">
<div id=\"profile-tags-container\">\n";

$get_tags = Db::query("SELECT * FROM users_tags WHERE user_id= '".$userdata['id']."' ORDER BY id LIMIT 20")
$rows = $get_tags->rowCount();

	$num = $get_tags->rowCount();
	if($num > 0){

		if($userdata['id'] == $my_id && $logged_in){
			while ($row = $get_tags->fetch(PDO::FETCH_ASSOC)){


				printf("    <span class=\"tag-search-rowholder\">
        <a href=\"#\" class=\"tag-search-link tag-search-link-%s\"
        >%s</a><img border=\"0\" class=\"tag-delete-link tag-delete-link-%s\" onMouseOver=\"this.src='./web-gallery/images/buttons/tags/tag_button_delete_hi.gif'\" onMouseOut=\"this.src='./web-gallery/images/buttons/tags/tag_button_delete.gif'\" src=\"./web-gallery/images/buttons/tags/tag_button_delete.gif\"
        /></span>", $row['tag'], $row['tag'], $row['tag'], $row['tag']);
			}
		} elseif($logged_in){
			while ($row = $get_tags->fetch(PDO::FETCH_ASSOC)){


				printf("    <span class=\"tag-search-rowholder\">
        <a href=\"#\" class=\"tag-search-link tag-search-link-%s\"
        >%s</a><img border=\"0\" class=\"tag-add-link tag-add-link-%s\" onMouseOver=\"this.src='./web-gallery/images/buttons/tags/tag_button_add_hi.gif'\" onMouseOut=\"this.src='./web-gallery/images/buttons/tags/tag_button_add.gif'\" src=\"./web-gallery/images/buttons/tags/tag_button_add.gif\"
        /></span>", $row['tag'], $row['tag'], $row['tag'], $row['tag']);
			}
		} else {
			while ($row = $get_tags->fetch(PDO::FETCH_ASSOC)){


				printf("    <span class=\"tag-search-rowholder\">
        <a href=\"#\" class=\"tag-search-link tag-search-link-%s\"
        >%s</a></span>", $row['tag'], $row['tag'], $row['tag'], $row['tag']);
			}
		}

	} else {
		echo "No tienes tags.";
	}

echo "\n    <img id=\"tag-img-added\" border=\"0\" src=\"./web-gallery/images/buttons/tags/tag_button_added.gif\" style=\"display:none\"/>
</div>

<script type=\"text/javascript\">
    document.observe(\"dom:loaded\", function() {
        TagHelper.setTexts({
            buttonText: \"OK\",
            tagLimitText: \"Hay un limite de 20 tags\"
        });
    });
</script>
    </div>
<div id=\"profile-tags-status-field\">
 <div style=\"display: block;\">
  <div class=\"content-red\">
   <div class=\"content-red-body\">
    <span id=\"tag-limit-message\"><img src=\"./web-gallery/images/register/icon_error.gif\"/> Hay un limite de 20 tags</span>
    <span id=\"tag-invalid-message\"><img src=\"./web-gallery/images/register/icon_error.gif\"/> Tag inv&aacute;lido.</span>
   </div>
  </div>
 <div class=\"content-red-bottom\">
  <div class=\"content-red-bottom-body\"></div>
 </div>
 </div>
</div>";


if($userdata['id'] == $my_id){
        echo "<div class=\"profile-add-tag\">
            <input type=\"text\" id=\"profile-add-tag-input\" maxlength=\"30\"/><br clear=\"all\"/>
            <a href=\"#\" class=\"new-button\" style=\"float:left;margin:5px 0 0 0;\" id=\"profile-add-tag\"><b>A&ntilde;adir tag</b><i></i></a>
        </div>";
}
    echo "</div>
    <script type=\"text/javascript\">
		document.observe(\"dom:loaded\", function() {
			new ProfileWidget('21063711', '21063711', {
				headerText: \"�Estas seguro?\",
				messageText: \"&iquest;Estas seguro que deseas a&ntilde;adir como amigo a <strong\>".$userdata['username']."</strong\>? El deber&aacute; aceptar tu petici&oacute;n\",
				buttonText: \"OK\",
				cancelButtonText: \"Cancel\"
			});
		});
	</script>
		<div class=\"clear\"></div>
		</div>
	</div>
</div></div>";
	}
}
?></div>
                  </div>
                  <div id="mypage-ad">
                    <div class="habblet ">
                      <div class="ad-container"></div>
                    </div>
                  </div>
                </div>
              </div>
                </div>
                <script language="JavaScript" type="text/javascript">
initEditToolbar();
initMovableItems();
document.observe("dom:loaded", initDraggableDialogs);
                </script>
                <div id="edit-save" style="display:none;"></div>
                </div>
                </div>
                </div>
                <div id="edit-menu" class="menu">
                  <div class="menu-header">
                    <div class="menu-exit" id="edit-menu-exit"><img src="./web-gallery/images/dialogs/menu-exit.gif" alt="" width="11" height="11" /></div>
                    <h3>Cambiar</h3>
                  </div>
                  <div class="menu-body">
                    <div class="menu-content">
                      <form action="#" onSubmit="return false;">
                        <div id="edit-menu-skins">
                          <select name="edit-menu-skins-select" id="edit-menu-skins-select">
                            <option value="1" id="edit-menu-skins-select-defaultskin">Por defecto</option>
                            <option value="6" id="edit-menu-skins-select-goldenskin">Dorado</option>
                            <option value="3" id="edit-menu-skins-select-metalskin">metal</option>
                            <option value="5" id="edit-menu-skins-select-notepadskin">Libreta</option>
                            <option value="2" id="edit-menu-skins-select-speechbubbleskin">Blocadillo de di&aacute;logo</option>
                            <option value="4" id="edit-menu-skins-select-noteitskin">Nota</option>
                            <?php if($user_rank >= 6){ ?>
                            <option value="9" id="edit-menu-skins-select-nakedskin">Transparente</option>
                            <?php } ?>
                          </select>
                        </div>
                        <div id="edit-menu-stickie">
                          <p>Si borras esta nota no podr&aacute;s volver a ponerla.</p>
                        </div>
                        <div id="rating-edit-menu">
                          <input type="button" id="ratings-reset-link"
						value="Reset rating" />
                        </div>
                        <div id="highscorelist-edit-menu" style="display:none">
                          <select name="highscorelist-game" id="highscorelist-game">
                            <option value="">Select game</option>
                            <option value="1">Battle Ball: Rebound!</option>
                            <option value="2">SnowStorm</option>
                            <option value="0">Wobble Squabble</option>
                          </select>
                        </div>
                        <div id="edit-menu-remove-group-warning">
                          <p>Esta etiqueta es de otro usurio. Si lo borras, aparecer&aacute; en su inventario.</p>
                        </div>
                        <!--<div id="edit-menu-gb-availability">
					<select id="guestbook-privacy-options">
						<option value="private">Alleen vrienden kunnen posten</option>
						<option value="public">Iedereen kan posten</option>
					</select>
				</div>-->
                        <div id="edit-menu-trax-select">
                          <select name="trax-select-options" id="trax-select-options">
                          </select>
                        </div>
                        <div id="edit-menu-remove">
                          <input type="button" id="edit-menu-remove-button" value="Eliminar" />
                        </div>
                      </form>
                      <div class="clear"></div>
                    </div>
                  </div>
                  <div class="menu-bottom"></div>
                </div>
                <script language="JavaScript" type="text/javascript">
Event.observe(window, "resize", function() { if (editmenuOpen) closeEditmenu(); }, false);
Event.observe(document, "click", function() { if (editmenuOpen) closeEditmenu(); }, false);
Event.observe("edit-menu", "click", Event.stop, false);
Event.observe("edit-menu-exit", "click", function() { closeEditmenu(); }, false);
Event.observe("edit-menu-remove-button", "click", handleEditRemove, false);
Event.observe("edit-menu-skins-select", "click", Event.stop, false);
Event.observe("edit-menu-skins-select", "change", handleEditSkinChange, false);
Event.observe("guestbook-privacy-options", "click", Event.stop, false);
Event.observe("guestbook-privacy-options", "change", handleGuestbookPrivacySettings, false);
Event.observe("trax-select-options", "click", Event.stop, false);
Event.observe("trax-select-options", "change", handleTraxplayerTrackChange, false);
                </script>
                <div class="cbb topdialog" id="guestbook-form-dialog">
                  <h2 class="title dialog-handle">Escribir un mensaje</h2>
                  <a class="topdialog-exit" href="#" id="guestbook-form-dialog-exit">X</a>
                  <div class="topdialog-body" id="guestbook-form-dialog-body">
                    <div id="guestbook-form-tab">
                      <form method="post" id="guestbook-form">
                        <p> El mensaje puede tener un m&aacute;ximo de 200 car&aacute;cteres
                          <input type="hidden" name="ownerId" value="<?php echo $user_row['id']; ?>" />
                        </p>
                        <div>
                          <textarea cols="15" rows="5" name="message" id="guestbook-message"></textarea>
                          <script type="text/javascript">
        bbcodeToolbar = new Control.TextArea.ToolBar.BBCode("guestbook-message");
        bbcodeToolbar.toolbar.toolbar.id = "bbcode_toolbar";
        var colors = { "red" : ["#d80000", "Rojo"],
            "orange" : ["#fe6301", "Naranja"],
            "yellow" : ["#ffce00", "Amarillo"],
            "green" : ["#6cc800", "Verde"],
            "cyan" : ["#00c6c4", "Cyan"],
            "blue" : ["#0070d7", "Azul"],
            "gray" : ["#828282", "Gris"],
            "black" : ["#000000", "Negro"]
        };
        bbcodeToolbar.addColorSelect("Color", colors, true);
                </script>
                        </div>
                        <div class="guestbook-toolbar clearfix"> <a href="#" class="new-button" id="guestbook-form-cancel"><b>Publicar</b><i></i></a> <a href="#" class="new-button" id="guestbook-form-preview"><b>Previa</b><i></i></a></div>
                      </form>
                    </div>
                    <div id="guestbook-preview-tab">&nbsp;</div>
                  </div>
                </div>
                <div class="cbb topdialog" id="guestbook-delete-dialog">
                <h2 class="title dialog-handle">Eliminar mensaje</h2>
                <a class="topdialog-exit" href="#" id="guestbook-delete-dialog-exit">X</a>
                <div class="topdialog-body" id="guestbook-delete-dialog-body">
                  <form method="post" id="guestbook-delete-form">
                    <input type="hidden" name="entryId" id="guestbook-delete-id" value="" />
                    <p>&iquest;Estas seguro que deseas eliminar este mensaje?</p>
                    <p> <a href="#" id="guestbook-delete-cancel" class="new-button"><b>Cancelar</b><i></i></a> <a href="#" id="guestbook-delete" class="new-button"><b>Borrar</b><i></i></a></p>
                  </form>
                </div>
                <script type="text/javascript">
HabboView.run();
                </script>
                <?php
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
} 
?></td>
            </tr>
          </table></td>
      </tr>
    </table></td>
  </tr>
</table><? }else{ ?>
<table width="930" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="267" height="317" valign="top"><table background="images/boxes/green.png" width="256" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="256" height="35" align="center"><strong class="profiles">Perfiles</strong></td>
      </tr>
    </table>
      <table width="256" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="253" height="56" align="center" valign="top" style="border-left:1px solid #666;  border-right:1px solid #666; border-bottom:1px solid #666; -moz-border-radius:0px 0px 4px 4px; border-radius:0px 0px 4px 4px; background-color:#FFF;"><br>
            <table width="231" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="231" class="rule1"><strong>&iexcl;Importante!<br>
                  <img src="images/extra/frs_sc.png" width="74" height="96" align="right"><br>
                  </strong>Si te sale esta p&aacute;gina, significa que el usuario no existe, o ha seleccionado ocultar su perfil.<br>
                  <br>
                  Si quieres, puedes visitar otros perfiles, de tus amigos, o gente que conozcas.</td>
              </tr>
            </table>
            <br></td>
        </tr>
      </table>
      <br></td>
    <td width="536" valign="top"><table width="467" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="467" height="15" align="center" valign="middle" style="border:1px solid #666; border-radius:4; -moz-border-radius:4; background-color:#FFF;"><table width="446" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="446" height="152" align="left" valign="top"><br>
              <table width="100" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td height="43"><table width="447" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td width="447" height="34" align="center" bgcolor="#F7F7F7" style="border:1px solid #000; border-radius:3px 3px 3px 3px; "><table width="419" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td width="419"><strong>&iquest;Que es esta p&aacute;gina?</strong></td>
                        </tr>
                      </table></td>
                    </tr>
                  </table></td>
                </tr>
              </table>
              -Esta pagina, te indica que el perfil que est&aacute;s intentando acceder, no se encuentra disponible temporalmente.
              </p>
              <p><strong>Puede que el usuario tenga oculto su perfil, o que no exista.</strong></td>
          </tr>
        </table>
          <br></td>
      </tr>
    </table></td>
    <td width="187" valign="top"><div id="web-ads">
      <div id="web-ads-face"><a href="<?=$config['url_face'];?>" target="_blank"><img src="images/icos/facebook.jpg" width="34"  border="0"  height="34"></a></div>
      <div id="web-ads-twt"><a href="<?=$config['url_twitter'];?>" target="_blank"><img  border="0" src="images/icos/twitter.png" width="32" height="32"></a></div>
      <div id="web-ads-youtb"><a href="<?=$config['url_youtube'];?>" target="_blank"><img src="images/icos/youtub.png" width="32" border="0" height="32"></a></div>
    </div>
      <div id="web-ads">
        <?=$config['adversiment'];?>
      </div></td>
  </tr>
</table>
<? } }else{ ?>
<table width="930" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="267" height="317" valign="top"><table background="images/boxes/green.png" width="256" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="256" height="35" align="center"><strong class="profiles">Perfiles</strong></td>
      </tr>
    </table>
      <table width="256" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="253" height="56" align="center" valign="top" style="border-left:1px solid #666;  border-right:1px solid #666; border-bottom:1px solid #666; -moz-border-radius:0px 0px 4px 4px; border-radius:0px 0px 4px 4px; background-color:#FFF;"><br>
            <table width="231" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="231" class="rule1"><strong>&iexcl;Importante!<br>
                  <img src="images/extra/frs_sc.png" width="74" height="96" align="right"><br>
                  </strong>Si te sale esta p&aacute;gina, significa que el usuario no existe, o ha seleccionado ocultar su perfil.<br>
                  <br>
                  Si quieres, puedes visitar otros perfiles, de tus amigos, o gente que conozcas.</td>
              </tr>
            </table>
            <br></td>
        </tr>
      </table>
      <br></td>
    <td width="536" valign="top"><table width="467" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="467" height="15" align="center" valign="middle" style="border:1px solid #666; border-radius:4; -moz-border-radius:4; background-color:#FFF;"><table width="446" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="446" height="152" align="left" valign="top"><br>
              <table width="100" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td height="43"><table width="447" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td width="447" height="34" align="center" bgcolor="#F7F7F7" style="border:1px solid #000; border-radius:3px 3px 3px 3px; "><table width="419" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td width="419"><strong>&iquest;Que es esta p&aacute;gina?</strong></td>
                        </tr>
                      </table></td>
                    </tr>
                  </table></td>
                </tr>
              </table>
              -Esta pagina, te indica que el perfil que est&aacute;s intentando acceder, no se encuentra disponible temporalmente.
              </p>
              <p><strong>Puede que el usuario tenga oculto su perfil, o que no exista.</strong></td>
          </tr>
        </table>
          <br></td>
      </tr>
    </table></td>
    <td width="187" valign="top"><div id="web-ads"><div id="web-ads-face"><a href="<?=$config['url_face'];?>" target="_blank"><img src="images/icos/facebook.jpg" width="34"  border="0"  height="34"></a></div><div id="web-ads-twt"><a href="<?=$config['url_twitter'];?>" target="_blank"><img  border="0" src="images/icos/twitter.png" width="32" height="32"></a></div><div id="web-ads-youtb"><a href="<?=$config['url_youtube'];?>" target="_blank"><img src="images/icos/youtub.png" width="32" border="0" height="32"></a></div></div>
<div id="web-ads"><?=$config['adversiment'];?></div></td>
  </tr>
</table>
<? } ?>

<div id="center-copy"><div id="copyright"><font face="<?=$copy['font'];?>" style="font-size:<?=$copy['size'];?>"><strong>
  <?=$copy['message'];?>
</strong></font></div></div>
</body>
</html>