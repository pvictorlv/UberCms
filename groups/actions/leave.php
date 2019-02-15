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

function fixText($str, $clean = false)
	{
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
//		$str = str_replace("\'","'",$str);
//		$str = str_replace('\"','"',$str);
	
		if($clean)
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

$groupid = FixText($_POST['groupId']);

if(is_numeric($groupid) && $groupid > 0){

	$check = mysql_query("SELECT type FROM groups_details WHERE id = '".$groupid."' LIMIT 1") or die(mysql_error());
	$exists = mysql_num_rows($check);

	if($exists > 0){

		$check2 = mysql_query("SELECT groupid FROM groups_memberships WHERE userid = '".USER_ID."' AND groupid = '".$groupid."' LIMIT 1") or die(mysql_errors());
		$already_member = mysql_num_rows($check2);

		if($already_member > 0){

			mysql_query("DELETE FROM groups_memberships WHERE userid = '".$my_id."' AND groupid = '".$groupid."' LIMIT 1") or die(mysql_error());
			echo "<script type=\"text/javascript\">\nlocation.href = habboReqPath + \"groups/".$groupid."/id\";\n</script>";
			echo "<p>Has dejado el grupo con éxito.</p>";
			echo "<p>Por favor espera, seras reedireccionado...</p>";

		} else {

			exit;

		}

	} else {

		exit;

	}

}
?>