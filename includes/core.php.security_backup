<?php
/*=========================================================+
|| # HabboCMS - Sistema de administraci�n de contenido Habbo.
|+=========================================================+
|| # Copyright � 2010 Kolesias123. All rights reserved.
|| # http://www.infosmart.com.mx
|| # Partes Copyright � 2009 Yifan Lu. All rights reserved.
|| # http://www.yifanlu.com
|| # Base Copyright � 2007-2008 Meth0d. All rights reserved.
|| # http://www.meth0d.org
|+=========================================================+
|| # InfoSmart 2010. The power of Proyects.
|| # Este es un Software de c�digo libre, libre edici�n.
|+=========================================================+
|| # Todas las imagenes, scripts y temas
|| # Copyright (C) 2010 Sulake Ltd. All rights reserved.
|+=========================================================*/

########## DEFINICI�N DE FUNCI�N PARA ERRORES ####################################################

function writeError($title, $msg)
{
	echo "<br /><font size='2' face='Tahoma'><b>".$title."</b><br /><br />".$msg."</font>";
	
	/* Cr�ditos e Informaci�n del Desarrollador ~ Inecesaria :P */
	//echo "<br /><br /><pre>HabboCMS 9, Powered by InfoSmart, Lns ~ The power of Proyects. 2009 - 2010<br /><br />http://www.infosmart.com.mx/<br />ibravo[at]hotmail[dot]com";
	
	echo "<pre>";
	
	/* Ayudame a seguir con el Proyecto :D */
	echo "<center><br /><p><script type=\"text/javascript\"><!--
tucodigo addsence en incluedes/core.php
//-->
</script>
<script type=\"text/javascript\"
src=\"http://pagead2.googlesyndication.com/pagead/show_ads.js\">
</script>";
	echo "<br />�Ayudame a seguir con el Proyecto! Dale un clic.</p></center></pre>";  exit;	
	/* Da un clic en la publicidad */
}

########## INICIO DEL NUCLEO ####################################################

define("IN_HOLOCMS", TRUE);
define("MY_IP", $_SERVER['REMOTE_ADDR']);

if(strpos($_SERVER['SERVER_SOFTWARE'],"Win") == false){ $page['dir'] = str_replace('\\','/',$page['dir']); }
chdir(str_replace($page['dir'], "", getcwd()));

if(@ini_get('date.timezone') == null && function_exists("date_default_timezone_get")){ @date_default_timezone_set("America/Los_Angeles"); }

session_start();

@include('./includes/config.php');
@include('../includes/config.php');

define("PATH", "http://".$path.$subpath);

########## COMPROBRACI�N DE REQUISITOS ####################################################

if (!function_exists('curl_init')) 
{
	writeError("�Ha sucedido un error fatal!", "Lo sentimos, pero al parecer no tienes activado el servicio de <b>Curl</b> (curl_init). Por la cual no es posible continuar.");
}


if (!is_writable('./includes/config.php') && !is_writable('../includes/config.php'))
{
	writeError("�Ha sucedido un error fatal!", "Lo sentimos, pero al parecer el archivo de configuraci�n no es modificable. Por favor ajusta los permisos necesarios al archivo 'config.php'");
}


########## CONEXI�N A LA BASE DE DATOS ##########################################

if(empty($dbhost) || empty($dbuser) || empty($dbpass) || empty($dbname))
{
	header("Location: ./setup/"); exit;
} 
else
{
	@mysql_connect($dbhost, $dbuser, $dbpass)or die(writeError("�Ha sucedido un error fatal!", "No ha sido posible la conexi�n a la Base de datos. Por favor si eres el due�o del Hotel revisa la configuraci�n."));
	@mysql_select_db($dbname)or die(writeError("�Ha sucedido un error fatal!", "No ha sido posible la conexi�n a la Base de datos. Por favor si eres el due�o del Hotel revisa la configuraci�n."));
}

########## DECLARACI�N DE VARIABLES GLOBALES ####################################

$cms_sytem = mysql_query("SELECT * FROM cms_system") or die(mysql_error());
$cms_row = mysql_fetch_assoc($cms_sytem);

$sitename = $cms_row["sitename"];
$shortname = $cms_row["shortname"];
$client = $cms_row["client"];
$maintenance = $cms_row["site_closed"];
$analytics = $cms_row["analytics"];
$description = $cms_row["site_description"];
$keywords = $cms_row["site_keywords"];
$lang = $cms_row["language"];

$online_count = getSystem("users_online");
$room_count = getSystem("rooms_loaded");
$ver = getSystem("server_Ver");


$H = date('H');
$i = date('i');
$s = date('s');
$m = date('m');
$d = date('d');
$Y = date('Y');
$j = date('j');
$n = date('n');
$M = date('M');
$A = date('A');

$date_normal = date('d-m-Y',mktime($m,$d,$Y));
$date_reversed = date('Y-m-d', mktime($m,$d,$y));
if($lang == "spanish"){
$date_name = $d."-".getMonth($m)."-".$Y." ".$H.":".$i.":".$s;
}
if($lang == "english"){
$date_name = getMonth($m)." ".$d.", ".$Y." ".$H.":".$i.":".$s." ".$A;
}
$date_full = date('d-m-Y H:i:s',mktime($H,$i,$s,$m,$d,$Y));
$date_time = date('H:i:s',mktime($H,$i,$s));
$time_compare = (time() - 501);

####################################################################################

function getConfig($value)
{
	$sql = mysql_query("SELECT ".$value." FROM cms_system LIMIT 1") or die(mysql_error());
	$row = mysql_fetch_assoc($sql);
	
	return $row[$value];
}

function getSystem($value)
{
	$sql = mysql_query("SELECT ".$value." FROM server_status LIMIT 1") or die(mysql_error());
	$row = mysql_fetch_assoc($sql);
	
	return $row[$value];
}


function getPub($value)
{
	$sql = mysql_query("SELECT ".$value." FROM cms_pubs LIMIT 1") or die(mysql_error());
	$row = mysql_fetch_assoc($sql);
	
	return $row[$value];
}

function getRpx($value, $exist=false)
{
	$sql = mysql_query("SELECT ".$value." FROM cms_rpx LIMIT 1") or die(mysql_error());
	$row = mysql_fetch_assoc($sql);
	
	if($exist == true)
	{
		if(empty($row[$value])) { return false; } else { return true; }
	}
	else
	{
		return $row[$value];
	}
}

function getServer($value, $switch = false){

	$sql = mysql_query("SELECT sval FROM system_config WHERE skey = '".$value."' LIMIT 1") or die(mysql_error());
	$row = mysql_fetch_assoc($sql);

	if($switch !== true){
		return $row['sval'];
	} else if($switch && $row['sval'] == "1"){
		return "Activado(s)";
	} else if($switch && $row['sval'] !== "1"){
		return "Desactivado(s)";
	}

}

function getAds($value)
{
	$sql = mysql_query("SELECT ".$value." FROM room_ads LIMIT 1") or die(mysql_error());
	$row = mysql_fetch_assoc($sql);
	
	return $row[$value];
}


####################################################################################

if($require_facebook || $_SESSION['rpx'] == "facebook")
{
	@include('./facebook/facebook.php');
	@include('../facebook/facebook.php');
		
	$facebook = new Facebook(array('appId'  => ''.getRpx("facebook_id").'', 'secret' => ''.getRpx("facebook_secret").'', 'cookie' => true,));
	$session = $facebook->getSession();
	
	if($session) 
	{
		$fid = $facebook->getUser();
		$details = $facebook->api('/me');
	}
	else
	{
		unset($_SESSION['rpx']);	
		$_SESSION['error'] = "<li>�Ha sucedido un error fatal!</li>";
		header("location:".PATH."?page=".$_SERVER["REQUEST_URI"]."&username="); exit;
	}
}

####################################################################################

if($require_rpx || $_SESSION['rpx'] == "rpx")
{
	if(!empty($_POST['token'])) 
	{
		$_SESSION['rpx_token'] = FilterText($_POST['token']);
	}

	@include('./rpx/rpx.php');
	@include('../rpx/rpx.php');

	if($auth_info['stat'] == 'ok') 
	{
		$profile = $auth_info['profile'];
	} 
	else
	{
		unset($_SESSION['rpx_token']);
		unset($_SESSION['rpx']);
	
		$_SESSION['error'] = "<li>�Ha sucedido un error fatal!</li>";
		header("location:".PATH."?page=".$_SERVER["REQUEST_URI"]."&username="); exit;
	}
}

####################################################################################

function HoloHash($password)
{
	@include('./includes/config.php');
	@include('../includes/config.php');
	
	if($pass_hash){
		$string = sha1(sha1($password.infohabcms.strtolower($password)));
	}else{
		$string = $password;
	}
	
	return $string;
}

####################################################################################

function getMonth($number)
{
	switch ($number) {
	case "01":
	$return = "ene";
	break;
	case "02":
	$return = "feb";
	break;
	case "03":
	$return = "mar";
	break;
	case "04":
	$return = "abr";
	break;
	case "05":
	$return = "may";
	break;
	case "06":
	$return = "jun";
	break;
	case "07":
	$return = "jul";
	break;
	case "08":
	$return = "ago";
	break;
	case "09":
	$return = "sep";
	break;
	case "10":
	$return = "oct";
	break;
	case "11":
	$return = "nov";
	break;
	case "12":
	$return = "dic";
	break;
	}
	return $return;
}

####################################################################################

function showfriendsOnline($my_id, $show_names = false)
{

	$get_myfriends = mysql_query("SELECT * FROM messenger_friendships WHERE user_one_id = '".$my_id."' OR user_two_id = '".$my_id."'") or die(mysql_error());
	$time_compare = (time() - 501);
	$counter = 0;
	$users = "";
	
	while ($row = mysql_fetch_array($get_myfriends)){
	
	if($row['user_one_id'] == $my_id){
	$get_friend = mysql_query("SELECT username FROM users WHERE id = '".$row['user_two_id']."' AND online >= ".$time_compare." LIMIT 1");
	} else {
	$get_friend = mysql_query("SELECT username FROM users WHERE id = '".$row['user_one_id']."' AND online >= ".$time_compare." LIMIT 1");
	}
	
	$row2 = mysql_fetch_assoc($get_friend);	
	$friend_exist = mysql_num_rows($get_friend);
	
	if($friend_exist > 0){
	$counter++;
	$users = $users."\n<a href=\"".PATH."/home/".$row2['username']."\">".$row2['username']."</a>, ";
	}
	
	}
  
    if($show_names){
	return $users;
	} else {
	return $counter;
	}
}


####################################################################################

function showfriendsOffline($my_id)
{

	$get_myfriends = mysql_query("SELECT * FROM messenger_friendships WHERE user_one_id = '".$my_id."' OR user_two_id = '".$my_id."'") or die(mysql_error());
	$time_compare = (time() - 501);
	$counter = 0;
	
	while ($row = mysql_fetch_array($get_myfriends)){
	if($row['user_one_id'] == $my_id){
	$get_friend = mysql_query("SELECT username FROM users WHERE id = '".$row['user_two_id']."' AND online < ".$time_compare." LIMIT 1");
	} else {
	$get_friend = mysql_query("SELECT username FROM users WHERE id = '".$row['user_one_id']."' AND online < ".$time_compare." LIMIT 1");
	}
	
	$row2 = mysql_fetch_assoc($get_friend);	
	$friend_exist = mysql_num_rows($get_friend);
	
	if($friend_exist > 0){
	$counter++;
	}
  }
  
	return $counter;
}

####################################################################################

function showtags($my_id)
{

	$get_tags = mysql_query("SELECT * FROM users_tags WHERE user_id = '".$my_id."'") or die(mysql_error());
	$get_total = mysql_num_rows($get_tags);
	$tags = "";
	$total_tags = 1;
	
	while ($row = mysql_fetch_array($get_tags)){
	if($total_tags == $get_total){
	$final = "";
	} else {
	$final = ",";
	}
	
	$tags = $tags.$row['tag'].$final;
	$total_tags++;
    }
	
	return $tags;
}

####################################################################################

function IsFriend($myid, $userid)
{

	$get = mysql_query("SELECT * FROM messenger_friendships WHERE user_one_id = '".$myid."' AND user_two_id = '".$userid."' LIMIT 1") or die(mysql_error());
	$get2 = mysql_query("SELECT * FROM messenger_friendships WHERE user_one_id= '".$userid."' AND user_two_id = '".$myid."' LIMIT 1") or die(mysql_error());
	
	if(mysql_num_rows($get) > 0 || mysql_num_rows($get2) > 0){
	return true;
	} else {
	return false;
	}

####################################################################################

if(!session_is_registered(username) && $_COOKIE['remember'] == "remember")
{
	$cname = FilterText($_COOKIE['rusername']);
	$cpass = FilterText($_COOKIE['rpassword']);

	$csql = mysql_query("SELECT password FROM users WHERE username = '".$cname."' OR mail = '".$cname."' LIMIT 1") or die(mysql_error());
	$cnum = mysql_num_rows($csql);
	
	setcookie("remember", "", time()-60*60*24*100);
	setcookie("rusername", "", time()-60*60*24*100);
	setcookie("rpassword", "", time()-60*60*24*100);

	if($cnum > 0)
	{
		$crow = mysql_fetch_assoc($csql);
		$correct_pass = $crow['password'];

		if(HoloHash($cpass) == $correct_pass)
		{			
			$_SESSION['check_username'] = $cname;
			$_SESSION['check_password'] = $cpass;
				
			header("Location:".PATH."/security_check"); exit;
				
		} 
	}
}}


####################################################################################

function IsEven($intNumber)
{
	if($intNumber % 2 == 0){
		return "even";
	} else {
		return "odd";
	}
}

####################################################################################

function bbcode_format($str){

        $simple_search = array(
                                '/\[b\](.*?)\[\/b\]/is',
                                '/\[i\](.*?)\[\/i\]/is',
                                '/\[u\](.*?)\[\/u\]/is',
                                '/\[s\](.*?)\[\/s\]/is',
                                '/\[quote\](.*?)\[\/quote\]/is',
                                '/\[link\=(.*?)\](.*?)\[\/link\]/is',
                                '/\[url\=(.*?)\](.*?)\[\/url\]/is',
                                '/\[color\=(.*?)\](.*?)\[\/color\]/is',
                                '/\[size=small\](.*?)\[\/size\]/is',
                                '/\[size=large\](.*?)\[\/size\]/is',
                                '/\[code\](.*?)\[\/code\]/is',
                                '/\[habbo\=(.*?)\](.*?)\[\/habbo\]/is',
                                '/\[room\=(.*?)\](.*?)\[\/room\]/is',
                                '/\[group\=(.*?)\](.*?)\[\/group\]/is'
                                );

        $simple_replace = array(
                                '<strong>$1</strong>',
                                '<em>$1</em>',
                                '<u>$1</u>',
                                '<s>$1</s>',
                                "<div class='bbcode-quote'>$1</div>",
                                "<a href='$1'>$2</a>",
								"<a href='$1'>$2</a>",
                                "<font color='$1'>$2</font>",
                                "<font size='1'>$1</font>",
                                "<font size='3'>$1</font>",
                                '<pre>$1</pre>',
                                "<a href='".PATH."/home/$1/id'>$2</a>",
                                "<a onclick=\"roomForward(this, '$1', 'private'); return false;\" target=\"client\" href=\"".PATH."/client?forwardId=2&roomId=$1\">$2</a>",
                                "<a href='".PATH."/groups/$1/id'>$2</a>"
                                );
								
		$str = preg_replace ($simple_search, $simple_replace, $str);								
		$str = str_replace(":)", " <img src='".PATH."/web-gallery/smilies/smile.gif' border='0'> ", $str);
		$str = str_replace(";)", " <img src='".PATH."/web-gallery/smilies/wink.gif' border='0'> ", $str);
		$str = str_replace(":P", " <img src='".PATH."/web-gallery/smilies/tongue.gif' border='0'> ", $str);
		$str = str_replace(";P", " <img src='".PATH."/web-gallery/smilies/winktongue.gif' border='0'> ", $str);
		$str = str_replace(":p", " <img src='".PATH."/web-gallery/smilies/tongue.gif' border='0'> ", $str);
		$str = str_replace(";p", " <img src='".PATH."/web-gallery/smilies/winktongue.gif' border='0'> ", $str);
		$str = str_replace("(L)", " <img src='".PATH."/web-gallery/smilies/heart.gif' border='0'> ", $str);
		$str = str_replace("(l)", " <img src='".PATH."/web-gallery/smilies/heart.gif' border='0'> ", $str);
		$str = str_replace(":o", " <img src='".PATH."/web-gallery/smilies/shocked.gif' border='0'> ", $str);
		$str = str_replace(":O", " <img src='".PATH."/web-gallery/smilies/shocked.gif' border='0'> ", $str);       

        return $str;
}

####################################################################################

function GenerateRandom($type = "sso", $length = 0)
{
	switch($type)
	{
		case "sso":
			$data = GenerateRandom("random",8)."-".GenerateRandom("random",4)."-".GenerateRandom("random",4)."-".GenerateRandom("random",4)."-".GenerateRandom("random",12);
			return $data;
		break; 
		case "app_key":
			$data = strtoupper(GenerateRandom("random",32)).".resin-fe-".GenerateRandom("random_number",1);
			return $data;
		break; 
		case "random":
			$data = "";
			$possible = "0123456789abcdef"; 
			$i = 0;
			while ($i < $length) { 
				$char = substr($possible, mt_rand(0, strlen($possible)-1), 1);
				$data .= $char;
				$i++;
			}
			return $data;
		break; 
		case "random_number":
			$data = "";
			$possible = "0123456789"; 
			$i = 0;
			while ($i < $length) { 
				$char = substr($possible, mt_rand(0, strlen($possible)-1), 1);
				$data .= $char;
				$i++;
			}
			return $data;
		break;
	}
}


####################################################################################

if(session_is_registered('username'))
{	
	$rawname = FilterText($_SESSION['username']);
	$rawpass = HoloHash($_SESSION['password']);

	$usersql = mysql_query("SELECT * FROM users WHERE username = '".$rawname."' AND password = '".$rawpass."' LIMIT 1");
	$myrow = mysql_fetch_assoc($usersql);
	$password_correct = mysql_num_rows($usersql);

	if($password_correct !== 1)
	{
		unset($_SESSION['username']);
		unset($_SESSION['password']);		
		$_SESSION['error'] = "Contrase�a incorrecta";
		header("Location: ".PATH."/?page=".$_SERVER["REQUEST_URI"]."&username=".$rawname); exit;
	} 
	else if(getBanUser($myrow['username']))
	{
		unset($_SESSION['username']);
		unset($_SESSION['password']);		
		$_SESSION['error'] = "�Has sido baneado! La raz�n es: \"".getBanReason($myrow['id'], MY_IP)." (id: ".$myrow['id'].")\", y acabar� en ".getBanReason($myrow['id'], MY_IP, true).".";
		header("Location: ".PATH."/?page=".$_SERVER["REQUEST_URI"]."&username=".$rawname); exit;
	}
	
	if($no_refresh)
	{ 
		$web_online = "0"; 
	} 
	else
	{ 
		$web_online = time(); 
	}

	mysql_query("UPDATE users SET web_online = '".$web_online."', ip_last = '".MY_IP."' WHERE id = '".$my_id."' LIMIT 1") or die(mysql_error());
	
	$my_rank = $myrow['rank'];
	$my_id = $myrow['id'];
	$name = $myrow['username'];

	if($_SESSION['special_login'] == "habboid")
	{	
		$is_email = true;
		$explode = explode("@", $myrow['mail']);
		$name_email = $explode[0];	
		$avatar_image = "http://static.ak.fbcdn.net/pics/q_silhouette.gif";	
	} 
	else if($_SESSION['special_login'] == "facebook")
	{	
		$is_facebook = true;
		$no_rea = true;
		$name_account = FilterText(textInJS($_SESSION['facebook']['name']));
		$first_name = FilterText(textInJS($_SESSION['facebook']['first_name'])); 
		$avatar_image = FilterText($_SESSION['facebook']['avatar']);	
	} 
	else if($_SESSION['special_login'] == "rpx")
	{	
		$is_rpx = true;		
		$no_rea = true;
		$provider = FilterText($_SESSION['srpx']['provider']);
		$first_name = FilterText(textInJS($_SESSION['srpx']['first_name'])); 
		$avatar_image = FilterText($_SESSION['srpx']['avatar']);	
	}
	
	define("LOGGED_IN", TRUE);

} 
else
{
	$my_rank = 0;
	$my_id = 0;
	$name = "";	
	define("LOGGED_IN", FALSE);	
}

####################################################################################

if(session_is_registered('email') && !$_SESSION['already_login'])
{
	$rawemail = FilterText($_SESSION['email']);
	$rawpass = HoloHash($_SESSION['password']);

	$usersql = mysql_query("SELECT * FROM users WHERE mail = '".$rawemail."' AND password = '".$rawpass."' ORDER BY id LIMIT 1");
	$myrow = mysql_fetch_assoc($usersql);
	$password_correct = mysql_num_rows($usersql);

	if($password_correct !== 1)
	{
		unset($_SESSION['email']);
		unset($_SESSION['password']);		
		$_SESSION['error'] = "Contrase�a incorrecta";
		header("Location: ".PATH."/?page=".$_SERVER["REQUEST_URI"]."&username=".$rawemail); exit;		
	} 
	else if(getBanUser($myrow['username']))
	{
		unset($_SESSION['email']);
		unset($_SESSION['password']);		
		$_SESSION['error'] = "�Has sido baneado! La raz�n es: \"".getBanReason($myrow['id'], MY_IP)." (id: ".$myrow['id'].")\", y acabar� en ".getBanReason($myrow['id'], MY_IP, true).".";
		header("Location: ".PATH."/?page=".$_SERVER["REQUEST_URI"]."&username=".$rawemail); exit;
	}
	
	$my_rank = $myrow['rank'];
	$my_id = $myrow['id'];
	
	$explode = explode("@", $rawemail);
	$name = $explode[0];
	$fid = 0;
	
	define("EMAIL_LOGGED_IN", TRUE);
	
} 
else
{
	define("EMAIL_LOGGED_IN", FALSE);
}


####################################################################################

if($_SESSION['rpx'] == "facebook")
{
	$usersql = mysql_query("SELECT * FROM users WHERE rpxid = '".$fid."' AND rpx_type = 'facebook' ORDER BY id LIMIT 1");
	$exist = mysql_num_rows($usersql);
	$myrow = mysql_fetch_assoc($usersql);
	
	if($exist == 0)
	{
		unset($_SESSION['rpx']);
		$_SESSION['error'] = "�Error desconcido al autenticarte!";
		header("Location: ".PATH."/?page=".$_SERVER["REQUEST_URI"]."&username="); exit;
		
	} 
	else if(IsUserBanned($myrow['id'], MY_IP))
	{
		unset($_SESSION['rpx']);
		$_SESSION['error'] = "�Has sido baneado! La raz�n es: \"".getBanReason($myrow['id'], MY_IP)." (id: ".$myrow['id'].")\", y acabar� en ".getBanReason($myrow['id'], MY_IP, true).".";
		header("Location: ".PATH."/?page=".$_SERVER["REQUEST_URI"]."&username="); exit;
	}	
	
	$first_name = textInJS($details['first_name']); 
	$name = textInJS($details['name']); 
	$avatar_image = $details['pic_with_logo'];

	$my_rank = $myrow['rank'];
	$my_id = $myrow['id'];
	
	define("FACEBOOK_LOGGED_IN", TRUE);
	
} 
else
{
	define("FACEBOOK_LOGGED_IN", FALSE);
}


####################################################################################

if($_SESSION['rpx'] == "rpx"){

	$usersql = mysql_query("SELECT * FROM users WHERE rpxid = '".textInJS($profile['displayName'])."' AND rpx_type = 'rpx' ORDER BY id LIMIT 1");
	$exist = mysql_num_rows($usersql);
	$myrow = mysql_fetch_assoc($usersql);
	
	if($exist == 0){

		unset($_SESSION['rpx']);
		$_SESSION['error'] = "�Error desconcido al autenticarte!";
		header("Location: ".PATH."/?page=".$_SERVER["REQUEST_URI"]."&username="); exit;
		
	} else if(IsUserBanned($myrow['id'], MY_IP)){

		unset($_SESSION['rpx']);
		$_SESSION['error'] = "�Has sido baneado! La raz�n es: \"".IsUserBanned($myrow['id'], MY_IP, true, false)." (id: ".$myrow['id'].")\", y acabar� en ".IsUserBanned($myrow['id'], MY_IP, false, true).".";
		header("Location: ".PATH."/?page=".$_SERVER["REQUEST_URI"]."&username="); exit;
	}	
		
	$first_name = textInJS($profile['preferredUsername'], true);
	$name = textInJS($profile['displayName'], true); 
	$avatar_image = $profile['photo'];	
	
	$my_rank = $myrow['rank'];
	$my_id = $myrow['id'];
	define("RPX_LOGGED_IN", TRUE);
	
} else {
	define("RPX_LOGGED_IN", FALSE);
}

####################################################################################

if(getConfig("hotel_status") == "1")
{
	$online = "online";
} 
elseif(getConfig("hotel_status") == "2" && $my_rank > 4) 
{
	$online = "online";
	$staffs_only = true;
} else {
	$online = "offline";
} 

####################################################################################

function GetUserBadge($strName)
{ 

	$check = mysql_query("SELECT id FROM users WHERE (id = '".FilterText($strName)."' OR username = '".FilterText($strName)."') LIMIT 1") or die(mysql_error());
	$exists = mysql_num_rows($check);

		if($exists > 0){
			$usrrow = mysql_fetch_assoc($check);
			$check = mysql_query("SELECT * FROM user_badges WHERE user_id = '".$usrrow['id']."' AND iscurrent = '1' LIMIT 1") or die(mysql_error());
			$hasbadge = mysql_num_rows($check);
			if($hasbadge > 0){
				$badgerow = mysql_fetch_assoc($check);
				return $badgerow['badgeid'];
                } else {
				return false;
			}
		} else {
			return false;
		}
}

####################################################################################

function GetUserGroup($my_id){

$check = mysql_query("SELECT groupid FROM groups_memberships WHERE userid = '".$my_id."' AND is_current = '1' LIMIT 1") or die(mysql_error());
$has_fave = mysql_num_rows($check);

	if($has_fave > 0){

		$row = mysql_fetch_assoc($check);
		$groupid = $row['groupid'];

		return $groupid;

	} else {

		return false;

	}
}

####################################################################################

function GetUserGroupBadge($my_id){

$check = mysql_query("SELECT groupid FROM groups_memberships WHERE userid = '".$my_id."' AND is_current = '1' LIMIT 1") or die(mysql_error());
$has_badge = mysql_num_rows($check);

	if($has_badge > 0){

		$row = mysql_fetch_assoc($check);
		$groupid = $row['groupid'];

		$check = mysql_query("SELECT badge FROM groups_details WHERE id = '".$groupid."' LIMIT 1") or die(mysql_error());

		$row = mysql_fetch_assoc($check);
		$badge = $row['badge'];

		return $badge;

	} else {

		return false;

	}
}
####################################################################################

	function getClubDays($id)
	{
		$sql = mysql_query("SELECT timestamp_activated, timestamp_expire FROM user_subscriptions WHERE user_id = '".$id."' LIMIT 1");

		if (mysql_num_rows($sql) == 0)
		{
			return 0;
		}
		
		$data = mysql_fetch_assoc($sql);
		$diff = $data['timestamp_expire'] - time();
		
		if ($diff <= 0)
		{
			return 0;
		}
		
		return ceil($diff / 86400);
	}

####################################################################################

	function getHC($id)
	{
		$sql = mysql_query("SELECT * FROM user_subscriptions WHERE subscription_id = 'habbo_club' AND user_id = '".$id."' LIMIT 1");

		if (mysql_num_rows($sql) == 0)
		{
			return 0;
		}

		$data = mysql_fetch_assoc($sql);
		$diff = $data['timestamp_expire'] - time();
		
		if ($diff <= 0)
		{
			return 0;
		}
		
		return ceil($diff / 86400);
		
	}

####################################################################################

	function getVIP($id)
	{
		$sql = mysql_query("SELECT * FROM user_subscriptions WHERE subscription_id = 'habbo_vip' AND user_id = '".$id."' LIMIT 1");

		if (mysql_num_rows($sql) == 0)
		{
			return 0;
		}
		
		$data = mysql_fetch_assoc($sql);
		$diff = $data['timestamp_expire'] - time();
		
		if ($diff <= 0)
		{
			return 0;
		}
		
		return ceil($diff / 86400);
		
	}
	

####################################################################################

function GiveHC($user_id, $months){

$sql = mysql_query("SELECT * FROM user_subscriptions WHERE user_id = '".$user_id."' LIMIT 1") or die(mysql_error());
$valid = mysql_num_rows($sql);

    if($valid > 0){
	
        mysql_query("UPDATE users SET rank = '2' WHERE rank = '1' AND id = '".$user_id."' LIMIT 1") or die(mysql_error());
        mysql_query("UPDATE user_subscriptions SET timestamp_expire = timestamp_expire + '".$seconds."' WHERE user_id = '".$user_id."' LIMIT 1") or die(mysql_error());
		
        if(getBadge($user_id, "ACH_BasicClub1") == false){
            mysql_query("INSERT INTO user_badges (user_id,badge_id,iscurrent) VALUES ('".$user_id."','ACH_BasicClub1','1')") or die(mysql_error());
	    } else if(getBadge($user_id, "ACH_BasicClub2") == false){
            mysql_query("UPDATE user_badges SET badge_id = 'ACH_BasicClub2' WHERE badge_id = 'ACH_BasicClub1' AND user_id = '".$user_id."'") or die(mysql_error());
}

              
		
    } else {
        mysql_query("INSERT INTO user_subscriptions (user_id,subscription_id,timestamp_activated,timestamp_expire) VALUES ('".$user_id."','habbo_club','".time()."','".time()."')") or die(mysql_error());
        GiveHC($user_id, $sec);
    }

}

####################################################################################

function GiveVIP($user_id, $months){

$sql = mysql_query("SELECT * FROM user_subscriptions WHERE user_id = '".$user_id."' LIMIT 1") or die(mysql_error());
$valid = mysql_num_rows($sql);

    if($valid > 0){
	
        mysql_query("UPDATE users SET rank = '2' WHERE rank = '1' AND id = '".$user_id."' LIMIT 1") or die(mysql_error());
        mysql_query("UPDATE user_subscriptions SET timestamp_expire = timestamp_expire + '".$seconds."' WHERE user_id = '".$user_id."' LIMIT 1") or die(mysql_error());
		
        if(getBadge($user_id, "ACH_VipClub1") == false){
            mysql_query("INSERT INTO user_badges (user_id,badge_id,iscurrent) VALUES ('".$user_id."','ACH_VipClub1','1')") or die(mysql_error());
	    } else if(getBadge($user_id, "ACH_BasicClub2") == false){
            mysql_query("UPDATE user_badges SET badge_id = 'ACH_VipClub2' WHERE badge_id = 'ACH_VipClub1' AND user_id = '".$user_id."'") or die(mysql_error());;
        }
		
    } else {
        mysql_query("INSERT INTO user_subscriptions (user_id,subscription_id,timestamp_activated,timestamp_expire) VALUES ('".$user_id."','habbo_vip','".time()."','".time()."')") or die(mysql_error());
        GiveHC($user_id, $sec);
    }

}

####################################################################################


if($no_refresh == true)
{ $web_online = "0"; } else { $web_online = time(); }

if(LOGGED_IN == TRUE)
{	
	mysql_query("UPDATE users SET web_online = '".$web_online."', ip_last = '".MY_IP."' WHERE id = '".$my_id."' LIMIT 1") or die(mysql_error());
}

####################################################################################

if($config['rea_time'] > 0 && LOGGED_IN == TRUE)
{

	$rea_time = time() - ($config['rea_time'] * 60);
	$logout_time = time() - (($config['rea_time'] * 2) * 60);
	
	if($myrow['web_online'] < $logout_time && $no_rea !== true)
	{
	
		header("location:".PATH."/account/logout?token=".$myrow['token']); exit;
			
	}
	else if($myrow['web_online'] < $rea_time && $no_rea !== true)
	{
	
		$_SESSION['page'] = $_SERVER["REQUEST_URI"];
		header("location:".PATH."/account/reauthenticate"); exit;
			
	}
}
	
####################################################################################

function IsUserOnline($intUID, $inWeb = false)
{

$result = mysql_query("SELECT online, web_online FROM users WHERE id = '".FilterText($intUID)."' OR username = '".FilterText($intUID)."' LIMIT 1") or die(mysql_error());
$row = mysql_fetch_assoc($result);
$time_compare = (time() - 501);

if($inWeb == false)
{
	if($row['online'] >= $time_compare){ return true; } else { return false; }
}
else
{
	if($row['web_online'] >= $time_compare){ return true; } else { return false; }
}
	
}

####################################################################################

	function getBanUser($name)
	{
		$sql = mysql_query("SELECT * FROM bans WHERE bantype = 'user' AND value = '".$name."' LIMIT 1");

		if (mysql_num_rows($sql) == 0)
		{
			return false;
		}

		$data = mysql_fetch_assoc($sql);
		$diff = $data['expire'] - time();
		
		if ($diff <= 0)
		{
			return true;
		}
		
		return ceil($diff / 86400);
		
	}

####################################################################################

function getBanReason($my_id, $ip="", $date=false)
{
	$check = mysql_query("SELECT * FROM bans WHERE bantype = 'user' AND value = '".$myrow['username']."' LIMIT 1") or die(mysql_error());
	$is_banned = mysql_num_rows($check);

	if($is_banned > 0)
	{
		$bandata = mysql_fetch_assoc($check);
		
		if(!$date)
		{
			return $bandata['reason'];
		}
		else
		{
			return $bandata['expire'];
		}
	}
}

####################################################################################

function mysql_evaluate($query, $default_value="undefined") {
	$result = mysql_query($query) or die(mysql_error());

	if(mysql_num_rows($result) < 1){
		return $default_value;
	} else {
		return mysql_result($result, 0);
	}
}

####################################################################################

function FilterText($str, $advanced=false, $bbcode=false) {
	if($advanced == true){ return mysql_real_escape_string($str); }
	$str = mysql_real_escape_string(htmlspecialchars($str));
	return $str;
}

function HoloText($str, $advanced=false, $bbcode=false) {
	if($advanced == true){ return stripslashes($str); }
	$str = stripslashes(nl2br(htmlspecialchars($str)));
	if($bbcode == true){$str = bbcode_format($str); }
	return $str;
}

function stringToURL($str,$lowercase=true,$spaces=false){
	$str = trim(preg_replace('/\s\s+/',' ',preg_replace("/[^A-Za-z0-9-]/", " ", $str)));
	if($lowercase == true){ $str = strtolower($str); }
	if($spaces == true){ $str = str_replace(" ", "-", $str); }else{ str_replace(" ", "", $str); }
	return $str;
}

function textInJS($str, $clean = false){
	$str = str_replace("¡","�",$str);
	$str = str_replace("¿","�",$str);
	$str = str_replace("�","�",$str);
	$str = str_replace("ñ","�",$str);
	$str = str_replace("�","�",$str);
	$str = str_replace("á","�",$str);
	$str = str_replace("�","�",$str);
	$str = str_replace("é","�",$str);
	$str = str_replace("�","�",$str);
	$str = str_replace("ó","�",$str);
	$str = str_replace("�","�",$str);
	$str = str_replace("ú","�",$str);
	$str = str_replace("�","�",$str);
	$str = str_replace("�","�",$str);
	
	if($clean == true)
	{
	$str = str_replace("�","N",$str);
	$str = str_replace("�","n",$str);
	$str = str_replace("�","A",$str);
	$str = str_replace("�","a",$str);
	$str = str_replace("�","E",$str);
	$str = str_replace("�","e",$str);
	$str = str_replace("�","O",$str);
	$str = str_replace("�","o",$str);
	$str = str_replace("�","U",$str);
	$str = str_replace("�","u",$str);
	$str = str_replace("�","I",$str);
	$str = str_replace("�","i",$str);
	}
	
	return $str;
}
	
####################################################################################

function avatarURL($look,$style,$retfigure= 0){
		$look = HoloText($look);
		$hash = md5($figure.strtolower($style));
		$style = explode(",", $style);
		if($style[0] == "s"){ $style[6] = "1"; }else{ $style[6] = "0"; }
		if($style[3] == "sml"){ $style[7] = "1"; }else{ $style[7] = "0"; }
		$expandedstyle = "s-".$style[6].".g-".$style[7].".d-".$style[1].".h-".$style[2].".a-0";
		$URL = "http://www.habbo.com/habbo-imaging/avatarimage?figure=".$look."&size=".$style[0]."&direction=".$style[1]."&head_direction=".$style[2]."&crr=".$style[5]."&gesture=".$style[3]."&frame=".$style[4];
		if($return == 0){ return $URL; }else{ return $hash; }
	}
	
####################################################################################

class HoloFigureCheck {
	var $error = 0;
	function HoloFigureCheck($look=null,$gender=null,$club=false){
	  if(getConfig("check_figures") == "1"){
		if(empty($look)){ $error = 12; return false; }
		$xml = @simplexml_load_file('./xml/figuredata_old.xml');
		if(!$xml){
		$xml = @simplexml_load_file('../xml/figuredata_old.xml');
		}
		$sets = explode(".",$look);
		foreach($sets as $set){
			$valid = array(false,false,false,false);
			$parts = explode("-",$set);
			$havesets[] = $parts[0];
			foreach($xml->sets->settype as $settype){
				if((string) $settype['mandatory'] == "1"){ $mandatory[] = $settype['type']; }
				if((string) $settype['type'] == $parts[0]){
					$parts[3] = $settype['paletteid'];
					$valid[0] = true; $type = $settype;
					break;
				}
			}
			if($valid[0] != true){ $error = 1; return false; }
		foreach($type->set as $xset){
				if((string) $xset['id'] == $parts[1]){
					if($xset['selectable'] == "0"){ $error = 2; return false; }
					if($xset['colorable'] == "0"){ $nocolor = true; if($parts[2] != ""){ $error = 3; return false; } }else{ $nocolor = false; }
					if($xset['gender'] != $gender && $xset['gender'] != "U"){ $error = 4; return false; }
					if($xset['club'] == "1" && $club == false){ $error = 5; return false; }
					$valid[1] = true; $details = $xset;
					break;
				}
			}
			if($valid[1] != true){ $error = 6; return false; }
			if($nocolor != true){
				foreach($xml->colors->palette as $palette){
					if((string) $palette['id'] == (string) $parts[3]){
						$valid[2] = true; $pat = $palette;
						break;
					}
				}
				if($valid[2] != true){ $error = 7; return false; }
				foreach($pat->color as $color){
					if((string) $color['id'] == $parts[2]){
						if($color['club'] == "1" && $club == false){ $error = 8; return false; }
						if($color['selectable'] == "0"){ $error = 9; return false; }
						$valid[3] = true;
						break;
					}
				}
				if($valid[3] != true){ $error = 10; return false; }
			}
		}
		if(count($mandatory) != count(array_intersect($mandatory,$havesets))){ $error = 11; return false; }
		return true;
	  } else {
	  return true;
	  }
	}
}
	

####################################################################################

function generateFigure($club = true, $gender = null){
		if($gender == null){ if(rand(0,1) == 0){ $gender = "M"; }else{ $gender = "F"; } }
		if($club == true){ $club = (bool) rand(0,1); }
		$xml = @simplexml_load_file('./xml/figuredata_old.xml');
		if(!$xml){
		$xml = @simplexml_load_file('../xml/figuredata_old.xml');
		}
		$figure = "";
		foreach($xml->sets->settype as $settype){
			if((string) $settype['mandatory'] == "1" || rand(0,1) == 1){
				$item['settype'] = $settype['type'];
				$palette = (int) $settype['paletteid'];
				$possible = array();
				foreach($settype->set as $xset){
					if($xset['gender'] != "U" && $xset['gender'] != $gender){ $fail = true; }
					if($xset['selectable'] == "0"){ $fail = true; }
					if($xset['colorable'] == "0"){ $color = false; }else{ $color = true; }
					if($xset['club'] == "1" && $club == false){ $fail = true; }
					if($fail != true){ $possible[] = array($xset['id'],$color); }
					$fail = false; $color = false;
				}
				$count = count($possible);
				$num = rand(0,$count-1);
				$item['set'] = $possible[$num][0];
				if($possible[$num][1] == false){ $item['color'] = ""; }else{
					$possible = array();
					foreach($xml->colors->palette[$palette-1]->color as $color){
						if($color['club'] == "1" && $club == false){ $fail = true; }
						if($color['selectable'] == "0"){ $fail = true; }
						if($fail != true){ $possible[] = $color['id']; }
						$fail = false;
					}
					$count = count($possible);
					$num = rand(0,$count-1);
					$item['color'] = $possible[$num];
				}
				$figure .= $item['settype']."-".$item['set']."-".$item['color'].".";
			}
		}
		$figure = substr($figure, 0, -1);
		return array($figure,$gender);
	}
	
####################################################################################

if($auto_styles == false)
{
$webgallery = PATH."/web-gallery";
}
else
{
$webgallery = $styles_path;
}
	
	
####################################################################################

if($maintenance == "1" && $my_rank <= 4 && $no_maintenance !== true)
{
	session_destroy();
	@include("./maintenance.php");
	@include("../maintenance.php");
	exit;
}
else if($maintenance == "1" && $my_rank >= 5)
{
	$notify_maintenance = true;
}

####################################################################################

if($hkzone == true)
{
	define("HPATH", PATH."/".$hpath."/");
}

####################################################################################

function SendMUSData($data){

if(getServer("server_mus_enabled") !== "0"){

$mus_ip = getConfig("ip");
$mus_port = getServer("server_mus_port");

$sock = socket_create(AF_INET, SOCK_STREAM, getprotobyname('tcp'));
socket_connect($sock, $mus_ip, $mus_port);

if(!is_resource($sock)){
return false;
} else {
socket_send($sock, $data, strlen($data), MSG_DONTROUTE);
return true;
}

socket_close($sock);

} else {
return false;
}
}

####################################################################################

function randomVoucher($code) {
$characters = "1234567890abdefghijklmnopqrstuvwxyz1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ";
$key = $characters{rand(0,71)};
for($i=1;$i<$code;$i++)
	{
		$key .= $characters{rand(0,71)};
	}
	return $key;
}

####################################################################################

function UpdateSSO($my_id)
{
	$myticket = GenerateRandom();
	mysql_query("UPDATE users SET auth_ticket = '".$myticket."' WHERE id = '".$my_id."' LIMIT 1") or die(mysql_error());
	return $myticket;
}

####################################################################################

function SweardsWordFilter($str)
{

$sql = mysql_query("SELECT * FROM system_wordfilter WHERE word LIKE '%".$str."%'") or die(mysql_error());
$exist = mysql_num_rows($sql);

if($exist > 0){ return true; } else { return false; }
}

####################################################################################

function SwitchWordFilter($str)
{

$sql = mysql_query("SELECT word FROM system_wordfilter") or die(mysql_error());

	while($row = mysql_fetch_assoc($sql)){
	$str = str_replace($row['word'],getServer("wordfilter_censor"),$str);
	}

return $str;

}

####################################################################################

if(LOGGED_IN == TRUE || EMAIL_LOGGED_IN == TRUE || FACEBOOK_LOGGED_IN == TRUE || RPX_LOGGED_IN == TRUE)
{

$check_figure = new HoloFigureCheck();

if(getClubDays($my_id) || getClubDays($my_id)){
$exclusive = true;
} else {
$exclusive = false;
}

}

####################################################################################

function isLoggedIn()
{
	if(LOGGED_IN || EMAIL_LOGGED_IN || FACEBOOK_LOGGED_IN || RPX_LOGGED_IN)
	{
		return true;
	}
	else
	{
		return false;
	}
}

####################################################################################

if(LOGGED_IN == FALSE && $require_login == true)
{
	header("Location: ".PATH); exit;
}

####################################################################################

function userData($key, $value)
{
	$sql = mysql_query("SELECT ".$key." FROM users WHERE username = '".$value."' OR id = '".$value."' LIMIT 1") or die(mysql_error());
	$row = mysql_fetch_assoc($sql);
	
	return $row[$key];
}

####################################################################################

function userRPXData($key, $value)
{
	$sql = mysql_query("SELECT ".$key." FROM users WHERE rpxid = '".$value."' LIMIT 1") or die(mysql_error());
	$row = mysql_fetch_assoc($sql);
	
	return $row[$key];
}

####################################################################################

function newTransaction($uid, $date, $amount, $desc)
{
	mysql_query("INSERT INTO cms_transactions (userid,date,amount,descr) VALUES ('".$uid."','".$date."','".$amount."','".$desc."')") or die(mysql_error());
}

####################################################################################

function getBadge($myid, $badge)
{
	$check = mysql_query("SELECT badge_id FROM user_badges WHERE user_id = '".$myid."' AND badge_id = '".$badge."' LIMIT 1") or die(mysql_error());
	$exist = mysql_num_rows($check);
	
		if($exist > 0) { return true; } else { return false; }
}

####################################################################################

function newBadge($uid, $code, $replace=false, $oldcode="")
{
	$sql = mysql_query("SELECT * FROM users WHERE id = '".$uid."' LIMIT 1") or die(mysql_error());
	$exist = mysql_num_rows($sql);
	
	if($exist > 0 && $replace == false)
	{
		mysql_query("INSERT INTO user_badges (user_id, badge_id) VALUES ('".$uid."', '".$code."')") or die(mysql_error());
	}
	else if($exist > 0 && $replace == true)
	{
		mysql_query("UPDATE user_badges SET badge_id = '".$code."' WHERE badge_id = '".$oldcode."' AND user_id = '".$uid."' LIMIT 1") or die(mysql_error());
	}
	
	@SendMUSData('UPRS' . $uid); 
}

####################################################################################

function mgmBadge($uid)
{
	$invites = userData("invitedUsers", $uid);
	
	switch($invites)
	{
		case "1":
			newBadge($uid, "ACH_MGM1"); break;
		case "2":
			newBadge($uid, "ACH_MGM2", true, "ACH_MGM1"); break;
		case "3":
			newBadge($uid, "ACH_MGM3", true, "ACH_MGM2"); break;
		case "5":
			newBadge($uid, "ACH_MGM4", true, "ACH_MGM3"); break;
		case "7":
			newBadge($uid, "ACH_MGM5", true, "ACH_MGM4"); break;
		case "9":
			newBadge($uid, "ACH_MGM6", true, "ACH_MGM5"); break;
		case "11":
			newBadge($uid, "ACH_MGM7", true, "ACH_MGM6"); break;
		case "13":
			newBadge($uid, "ACH_MGM8", true, "ACH_MGM7"); break;
		case "15":
			newBadge($uid, "ACH_MGM9", true, "ACH_MGM8"); break;
		case "17":
			newBadge($uid, "ACH_MGM10", true, "ACH_MGM9"); break;
	}
	@SendMUSData('UPRS' . $uid); 
}

####################################################################################

if(getConfig('time_lotery') == "0")
{
	$date = time() + (1 * 60 * 60);
	mysql_query("UPDATE cms_system SET time_lotery = '".$date."' LIMIT 1") or die(mysql_error());

} else {
	$date = getConfig('time_lotery');
}

if(time() > $date)
{
	$date = getConfig('time_lotery') + (1 * 60 * 60);

	$win1 = mysql_query("SELECT userid FROM cms_lotery ORDER BY RAND() LIMIT 1") or die(mysql_error());
	$wrow1 = mysql_fetch_assoc($win1);
	$win2 = mysql_query("SELECT userid FROM cms_lotery ORDER BY RAND() LIMIT 1") or die(mysql_error());
	$wrow2 = mysql_fetch_assoc($win2);

	if(mysql_num_rows($win1) > 0)
	{
		mysql_query("UPDATE users SET credits = credits + 200, activity_points = activity_points + 150 WHERE id = '".$wrow1['userid']."'") or die(mysql_error());
		mysql_query("INSERT INTO cms_alerts (userid, template, alert) VALUES ('".$wrow1['userid']."', '2', '�Has gando la loteria! �Felicidades! Has obtenido con �xito tu premio.')") or die(mysql_error());
		
		@SendMUSData('UPRC' . $wrow1['userid']); 
		@SendMUSData('HKTM' . $wrow1['userid'] . chr(2) . "¡Has ganado la loteria! Felicidades ;D");
	}
	
	if(mysql_num_rows($win2) > 0)
	{
		mysql_query("UPDATE users SET credits = credits + 200, activity_points = activity_points + 150 WHERE id = '".$wrow2['userid']."'") or die(mysql_error());
		mysql_query("INSERT INTO cms_alerts (userid, template, alert) VALUES ('".$wrow2['userid']."', '2', '�Has gando la loteria! �Felicidades! Has obtenido con �xito tu premio.')") or die(mysql_error());
		
		@SendMUSData('UPRC' . $wrow2['userid']); 
		@SendMUSData('HKTM' . $wrow2['userid'] . chr(2) . "¡Has ganado la loteria! Felicidades ;D");
	}

	mysql_query("UPDATE cms_system SET time_lotery = '".$date."' LIMIT 1") or die(mysql_error());
	mysql_query("TRUNCATE TABLE `cms_lotery`;") or die(mysql_error());
}

$time_tolotery = $date - time();

####################################################################################

@include('./includes/version.php');
@include('../includes/version.php');

?>