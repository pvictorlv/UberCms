<?php
/*=========================================================+
|| # HabboCMS - Sistema de administración de contenido Habbo.
|+=========================================================+
|| # Copyright © 2010 Kolesias123. All rights reserved.
|| # http://www.infosmart.com.mx
|| # Partes Copyright © 2009 Yifan Lu. All rights reserved.
|| # http://www.yifanlu.com
|| # Base Copyright © 2007-2008 Meth0d. All rights reserved.
|| # http://www.meth0d.org
|+=========================================================+
|| # InfoSmart 2010. The power of Proyects.
|| # Este es un Software de código libre, libre edición.
|+=========================================================+
|| # Todas las imagenes, scripts y temas
|| # Copyright (C) 2010 Sulake Ltd. All rights reserved.
|+=========================================================*/

require_once('../global.php');

function SwitchWordFilter($str)
{

$sql = Db::query("SELECT word FROM wordfilter")

	while($row = $sql->fetch(PDO::FETCH_ASSOC)){
	$str = str_replace($row['word'],getServer("wordfilter_censor"),$str);
	}

return $str;

}

function textInJS($str, $clean = false){
	$str = str_replace("Â¡","¡",$str);
	$str = str_replace("Â¿","¿",$str);
	$str = str_replace("í‘","Ñ",$str);
	$str = str_replace("Ã±","ñ",$str);
	$str = str_replace("í","Á",$str);
	$str = str_replace("Ã¡","á",$str);
	$str = str_replace("í‰","É",$str);
	$str = str_replace("Ã©","é",$str);
	$str = str_replace("í“","Ó",$str);
	$str = str_replace("Ã³","ó",$str);
	$str = str_replace("íš","Ú",$str);
	$str = str_replace("Ãº","ú",$str);
	$str = str_replace("í","Í",$str);
	$str = str_replace("Ã","í",$str);
	
	if($clean == true)
	{
	$str = str_replace("Ñ","N",$str);
	$str = str_replace("ñ","n",$str);
	$str = str_replace("Á","A",$str);
	$str = str_replace("á","a",$str);
	$str = str_replace("É","E",$str);
	$str = str_replace("é","e",$str);
	$str = str_replace("Ó","O",$str);
	$str = str_replace("ó","o",$str);
	$str = str_replace("Ú","U",$str);
	$str = str_replace("ú","u",$str);
	$str = str_replace("Í","I",$str);
	$str = str_replace("í","i",$str);
	}
	
	return $str;
}

$security_time = '1';
$name = $users->GetUserVar(USER_ID, 'username');
$topicTitle = addslashes(SwitchWordFilter(textInJS($_POST['topicName'])));
$message = addslashes(SwitchWordFilter(textInJS($_POST['message'])));


if(empty($topicTitle)){ echo "<center>El titulo del Asunto no puede estar vacío.</center>"; exit; }

if($security_time < time()){
if($security_time < 3){
Db::query("INSERT INTO cms_forum_threads (forumid,type,title,author,date,lastpost_author,lastpost_date,views,posts,unix) VALUES ('".$_POST['groupId']."','1','".$topicTitle."','".$name."','".USER_NAME."','".$name."','".USER_NAME."','0','0','".strtotime('now')."')")
Db::query("UPDATE users SET postcount = postcount + 1 WHERE id = '".USER_ID."' LIMIT 1");

$check = Db::query("SELECT id FROM cms_forum_threads WHERE forumid = ?' ORDER BY id DESC LIMIT 1")
$row = $check->fetch(PDO::FETCH_ASSOC);

$threadid = $row['id'];

Db::query("INSERT INTO cms_forum_posts (forumid,threadid,message,author,date) VALUES ('".$_POST['groupId']."','".$threadid."','".$message."','".$name."','".$date_name."')");
$_SESSION['savetopic'] = time();

echo "<center>El Asunto ha sido publicado con éxito. <a href=\"/groups/".FilterText($_POST['groupId'])."/id/discussions/".$threadid."/id/page/1\">OK</a></center>";
$_SESSION['savetimesincorrect'] = 0;
} else {
echo "<center>Has sido bloqueado del foro. Por favor intentalo nuevamente más tarde.</center>";
}
} else {

if(empty($_SESSION['savetimesincorrect'])){
$_SESSION['savetimesincorrect'] = 0;
}

echo "<center>Has grabado tus datos demasiado rápido. Por favor, tómate un minuto antes de volver a la acción.</center>";
$_SESSION['savetimesincorrect']++;
}
?>