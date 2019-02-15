<div id="friend-list-header-container" class="clearfix">
    <div id="friend-list-header">
        <div class="page-limit">
            <div class="big-icons friend-header-icon">Amigos
                <br />Ver
                <a class="category-limit" id="pagelimit-30">30</a> |
                <a class="category-limit" id="pagelimit-50">50</a> |
                100
            </div>
        </div>
    </div>
    <div id="friend-list-paging">
        </div>
    </div>


<form id="friend-list-form">
    <table id="friend-list-table" border="0" cellpadding="0" cellspacing="0">
        <thead>
            <tr class="friend-list-header">
                <th class="friend-select" />
                <th class="friend-name">
                    <a class="sort sorted">Nombre</a>
                </th>
                <th class="friend-login">
                    <a class="sort">Último acceso</a>
                </th>
                <th class="friend-remove">Quitar</th>
            </tr>
        </thead>
        <tbody>
<?php
session_start();
require_once("../global.php");
function time_stamp($session_time){$time_difference = time() - $session_time ;$seconds = $time_difference ;$minutes = round($time_difference / 60 );$hours = round($time_difference / 3600 );$days = round($time_difference / 86400 );$weeks = round($time_difference / 604800 );$months = round($time_difference / 2419200 );$years = round($time_difference / 29030400 );if($seconds <= 60){echo "Hace $seconds segundos";}else if($minutes <=60){if($minutes==1){echo "Hace 1 minuto";}else{echo "Hace $minutes minutos";}}else if($hours <=24){if($hours==1){echo "Hace 1 hora"; } else{echo "Hace $hours horas";}}else if($days <= 7){if($days==1){echo "Hace 1 día";}else{echo "Hace $days días";}}else if($weeks <= 4){if($weeks==1){echo "Hace 1 semana";}else{echo "Hace $weeks semanas";}}else if($months <=12){if($months==1){echo "Hace 1 mes";}else{echo "Hace $months meses";}}else{if($years==1){echo "Hace 1 año";}else{echo "Hace $years años";}}}
	if(!isset($_GET['pageNumber'])){$pagenumber = "1";}else{$pagenumber = $_GET['pageNumber'];};
		if(!isset($_GET['pageSize'])){$pagesize = "30";}else{$pagedize = $_GET['pageSize'];};
				if(!isset($_GET['sortColumn'])){$sortcolumn = "name";}else{$sortcolumn = $_GET['sortColumn'];};
				if($sortcolumn == "name"){$short = "username";}elseif($sortcolumn == "login"){$short = "last_online";}else{};
	$pag = (int)$pagenumber*$pagesize;
	$pag2 = $pag-($pagesize-1);
	$net = '';
	$m = 0;
$getID = dbquery("SELECT * FROM users WHERE username = '".USER_NAME."'");
$b = mysql_fetch_assoc($getID);
$userid = $b['id'];
$amigosdehabbo = mysql_query("SELECT * FROM messenger_friendships WHERE user_one_id = '".$userid."'");
$array = array();
$i = "0";
while ($friends = mysql_fetch_assoc($amigosdehabbo)){
	$i++;
$array[$i] = $friends['user_two_id'];	
	
	};
	

      while (list($clave, $valor) = each($array)) {
		  
		  		$buscarhabbo = mysql_query("SELECT * FROM users WHERE id = '".$valor."'");
while ($mefriend = mysql_fetch_assoc($buscarhabbo)){
	if ($i%2==1){$highlight = 'even';}else{$highlight = 'odd';}; $i++;
		if(empty($mefriend['last_online'])){	
		$acceso = "Nunca";}else{$acceso = @date("d/m/Y h:iA", $mefriend['last_online']);};
	echo ' <tr class="'.$highlight.'">
               <td><input type="checkbox" name="friendList" value="'.$mefriend['id'].'" /></td>
               <td class="friend-name">
                '.$mefriend['username'].'
               </td>
               <td class="friend-login" title="'.$acceso.'">'.time_stamp($mefriend['last_online']).'</td>
               <td class="friend-remove"><div id="remove-friend-button-'.$mefriend['id'].'" class="friendmanagement-small-icons friendmanagement-remove remove-friend"></div></td>
           </tr>';
};};

	/*
		$buscarhabbo = mysql_query("SELECT * FROM users WHERE id = '".$friends['user_two_id']."' ORDER BY ".$short." DESC LIMIT ".$pag2.", ".$pagesize."");

	while ($mefriend = mysql_fetch_assoc($buscarhabbo)){
	if ($i%2==1){$highlight = 'even';}else{$highlight = 'odd';}; $i++;
		if(empty($mefriend['last_online'])){	
		$acceso = "Nunca";}else{$acceso = @date("d/m/Y h:iA", $mefriend['last_online']);};
	echo ' <tr class="'.$highlight.'">
               <td><input type="checkbox" name="friendList" value="'.$mefriend['id'].'" /></td>
               <td class="friend-name">
                '.$mefriend['username'].'
               </td>
               <td class="friend-login" title="'.$acceso.'">'.time_stamp($mefriend['last_online']).'</td>
               <td class="friend-remove"><div id="remove-friend-button-'.$mefriend['id'].'" class="friendmanagement-small-icons friendmanagement-remove remove-friend"></div></td>
           </tr>';
};
	*/


?>
        </tbody>
    </table>
    <a class="select-all" id="friends-select-all" href="#">Seleccionar todo</a> |
    <a class="deselect-all" href=#" id="friends-deselect-all">Quitar selección</a>
</form>

<div id="category-options" class="clearfix">
<select id="category-list-select" name="category-list">
    <option value="0">Amigos</option>
</select>
<div class="friend-del"><a class="new-button red-button cancel-icon" href="#" id="delete-friends"><b><span></span>Eliminar Amigos</b><i></i></a></div>
<div class="friend-move"><a class="new-button" href="#" id="move-friend-button"><b><span></span>Mover</b><i></i></a></div></div>

