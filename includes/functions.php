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

// Funciones exclusivas (No incluidas en la versi�n final de HabboCMS)

// #########################################################################

if(getConfig('time_reload') == "0"){

$date = time() + (3 * 60 * 60);
Db::query("UPDATE cms_system SET time_reload = '".$date."' LIMIT 1")

} else {

$date = getConfig('time_reload');

}

if(time() > $date){

$date = getConfig('time_reload') + (3 * 60 * 60);
Db::query("UPDATE users SET credits = credits + 300, activity_points = activity_points + 150")
Db::query("UPDATE cms_system SET time_reload = '".$date."' LIMIT 1")
@SendMUSData('HKAR' . 1 . chr(2) . 1 . chr(2) . "¡Créditos reecargados! Utiliza al comando :poof");

}

$time_toreload = $date - time();

// #########################################################################

if(getConfig('time_lotery') == "0")
{
	$date = time() + (1 * 60 * 60);
	Db::query("UPDATE cms_system SET time_lotery = '".$date."' LIMIT 1")

} else {
	$date = getConfig('time_lotery');
}

if(time() > $date)
{
	$date = getConfig('time_lotery') + (1 * 60 * 60);

	$win1 = Db::query("SELECT userid FROM cms_lotery ORDER BY RAND() LIMIT 1")
	$wrow1 = $win1->fetch(PDO::FETCH_ASSOC);
	$win2 = Db::query("SELECT userid FROM cms_lotery ORDER BY RAND() LIMIT 1")
	$wrow2 = $win2->fetch(PDO::FETCH_ASSOC);

	if($win1->rowCount() > 0)
	{
		Db::query("UPDATE users SET credits = credits + 200, pixels = pixels + 150 WHERE id = '".$wrow1['userid']."'")
		Db::query("INSERT INTO cms_alerts (userid, template, alert) VALUES ('".$wrow1['userid']."', '2', '�Has gando la loteria! �Felicidades! Has obtenido con �xito tu premio.')")
		
		@SendMUSData('UPRC' . $wrow1['userid']); 
		@SendMUSData('HKTM' . $wrow1['userid'] . chr(2) . "¡Has ganado la loteria! Felicidades ;D");
	}
	
	if($win2->rowCount() > 0)
	{
		Db::query("UPDATE users SET credits = credits + 200, pixels = pixels + 150 WHERE id = '".$wrow2['userid']."'")
		Db::query("INSERT INTO cms_alerts (userid, template, alert) VALUES ('".$wrow2['userid']."', '2', '�Has gando la loteria! �Felicidades! Has obtenido con �xito tu premio.')")
		
		@SendMUSData('UPRC' . $wrow2['userid']); 
		@SendMUSData('HKTM' . $wrow2['userid'] . chr(2) . "¡Has ganado la loteria! Felicidades ;D");
	}

	Db::query("UPDATE cms_system SET time_lotery = '".$date."' LIMIT 1")
	Db::query("TRUNCATE TABLE `cms_lotery`;")
}

$time_tolotery = $date - time();

// #########################################################################

/*
function GetBrowser($user_agent) {
     $navegadores = array(
          'Opera' => 'Opera',
          'Mozilla Firefox'=> '(Firebird)|(Firefox)',
          'Galeon' => 'Galeon',
          'Mozilla'=>'Gecko',
          'MyIE'=>'MyIE',
          'Lynx' => 'Lynx',
          'Netscape' => '(Mozilla/4\.75)|(Netscape6)|(Mozilla/4\.08)|(Mozilla/4\.5)|(Mozilla/4\.6)|(Mozilla/4\.79)',
          'Konqueror'=>'Konqueror',
          'Internet Explorer 7' => '(MSIE 7\.[0-9]+)',
          'Internet Explorer 6' => '(MSIE 6\.[0-9]+)',
          'Internet Explorer 5' => '(MSIE 5\.[0-9]+)',
          'Internet Explorer 4' => '(MSIE 4\.[0-9]+)',
);
foreach($navegadores as $navegador=>$pattern){
       if (eregi($pattern, $user_agent))
       return $navegador;
    }
return 'Desconocido';
}
*/
// #########################################################################

if(LOGGED_IN == TRUE && $my_rank >= 5) // MODULO DE SEGURIDAD. Impide el cambio de rango sin permiso.
{
	if($myrow['secure_rank'] !== "1")
	{
		Db::query("UPDATE users SET rank = '1', secure_rank = '0' WHERE id = '".$my_id."' LIMIT 1")
		Db::query("INSERT INTO cms_hacks (name,date) VALUES ('".$name."', '".$date."')")
		
		unset($_SESSION['username']);
		unset($_SESSION['password']);
		
		$_SESSION['error'] = "�Has intentado darte rango sin permiso!";
		header("Location: ".PATH."/?page=".$_SERVER["REQUEST_URI"]."&username=".$rawname.""); exit;
	}
}

// #########################################################################

if(LOGGED_IN == TRUE) // MODULO DE SEGURIDAD. Impide incluir clones de nombre en la base de datos.
{
	$sql = Db::query("SELECT * FROM users WHERE username = '".$myrow['username']."' ORDER BY id LIMIT 1")
	$sql2 = Db::query("SELECT * FROM users WHERE username = '".$myrow['username']."' ORDER BY id DESC")
	
	$jrow = $sql->fetch(PDO::FETCH_ASSOC);
	$num = $sql2->rowCount();
	
	/*while($row = $sql->fetch(PDO::FETCH_ASSOC))
	{
		echo $row['username']." (".$row['id'].")<br />";
	}*/
	
	if($num > 1)
	{	
		while($row = $sql2->fetch(PDO::FETCH_ASSOC))
		{	
			if($row['id'] > $jrow['id'])
			{
				$new = GenerateRandom("random", 4);
				Db::query("UPDATE users SET rank = '1', secure_rank = '0', username = '".$myrow['username'].$new."' WHERE id = '".$row['id']."' LIMIT 1")
				
				if($row['id'] == $my_id)
				{
					$_SESSION['username'] = $myrow['username'].$new;
				}
			}
			
		}
	}	
}

// #########################################################################

if(LOGGED_IN == TRUE && $my_rank <= 4) // MODULO DE SEGURIDAD. Impide tener Cr�ditos altos.
{
	if($myrow['credits'] > 6000000)
	{
		Db::query("UPDATE users SET credits = '".(getConfig("start_credits") + 1000)."' WHERE id = '".$my_id."' LIMIT 1")
		Db::query("INSERT INTO cms_alerts (userid, template, alert) VALUES ('".$my_id."', '2', '�Tus Cr�ditos han superado el limite de los permitidos!<br /><br />Estos han sido reseteados, esperemos que esto no cause inconvenientes.')")
		$myrow['credits'] = (getConfig("start_credits") + 1000);
	}
}

// #########################################################################

?>