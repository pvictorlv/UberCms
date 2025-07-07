<?php

require_once "../nucleo/class.rooms.php";

if (!defined('IN_HK') || !IN_HK) {
    exit;
}

if (!HK_LOGGED_IN || !$users->hasFuse(USER_ID, 'fuse_housekeeping_moderation')) {
    exit;
}

$searchResults = null;

if (isset($_GET['timeSearch'])) {
    $_POST['searchQuery'] = $_GET['timeSearch'];
    $_POST['searchType'] = '4';
}

if (isset($_POST['searchQuery'])) {
    $query = filter($_POST['searchQuery']);
    $type = $_POST['searchType'];

    $q = "SELECT * FROM chatlogs WHERE ";

    switch ($type) {
        default:
        case '1':

            $q .= "user_name = '" . $query . "'";
            break;

        case '2':

            $q .= "message LIKE '%" . $query . "%'";
            break;

        case '3':

            $q .= "room_id = '" . $query . "'";
            break;

        case '4':

            $cutMin = intval($query) - 300;
            $cutMax = intval($query) + 300;

            $q .= "timestamp >= " . $cutMin . " AND timestamp <= " . $cutMax;
    }

    $searchResults = db::query($q);
}

require_once "top.php";

?>

    <h1>Chatlogs</h1>

    <br/>

    <p>
       Nessa ferramenta você pode analizar os chatlogs de um quarto, pessoa ou pesquiasr por mensagens!
    </p>
    <br/>


<?php

if (isset($searchResults)) {
    echo '<br><h2>Resultados de la Busqueda - Has buscado por: "<span style="font-size: 125%;">' . clean($_POST['searchQuery']) . '</span>"</h2>';
    echo '<br /><p><a href="index.php?_cmd=chatlogs&doReset">Limpiar Resultados.</a></p><br />
	
	<table width="100%">
	<thead>
	<tr>
		<td>Fecha</td>
		<td>Hora</td>
		<td>Usuario</td>
		<td>Sala</td>
		<td>Mensaje</td>
		<td>Hora</td>
	</tr>
	<tbody>';

    while ($result = $searchResults->fetch(PDO::FETCH_ASSOC))) {
        if (strlen($result['hour']) < 2) {
            $result['hour'] = '0' . $result['hour'];
        }

        if (strlen($result['minute']) < 2) {
            $result['minute'] = '0' . $result['minute'];
        }

        $fecha = date('d-m-Y H:i:s', $result['timestamp']);

        echo '<tr>
		<td>' . $result['full_date'] . '</td>
		<td>' . $result['hour'] . ':' . $result['minute'] . '</td>
		<td><a href="#">' . clean($result['user_name']) . '</a> (' . $result['user_id'] . ')</td>
		<td><a href="#">' . clean(RoomManager::GetRoomVar($result['room_id'], 'caption')) . '</a> (' . $result['room_id'] . ')</td>
		<td>' . clean($result['message']) . '</td>
		<td>' . $fecha . ' (<a href="index.php?_cmd=chatlogs&timeSearch=' . $fecha . '">Search</a>)</td>
		</tr>';
    }

    echo '</tbody>
	</thead>
	</table>';
} else {
    echo '<br><h2>Buscar Chatlogs</h2>
	
	<br />
	
	<form method="post">
	
	Buscar por:&nbsp;
	<select name="searchType">
	<option value="1">Usuário</option>
	<option value="2">Conteúdo da mensagem</option>
	<option value="3">ID da sala</option>
	<option value="4">Data e hora</option>
	</select>
	
	<br /><br />
	
	Mensagem:&nbsp;
	<input type="text" name="searchQuery">
	
	<br /><br />
	
	<input type="submit" value="Buscar">
	
	</form>
	
	
	<br><h2>Actividade Recente</h2><br>
	<table width="100%">
	<thead>
	<tr>
		<td>Data</td>
		<td>Hora</td>
		<td>Usuário</td>
		<td>Sala</td>
		<td>Mensagem</td>
		<td>Timestamp</td>
	</tr>
	<tbody>';

    $getRecent = db::query("SELECT * FROM chatlogs ORDER BY id DESC LIMIT 50");

    while ($recent = $getRecent->fetch(2)) {
        if (strlen($recent['hour']) < 2) {
            $recent['hour'] = '0' . $recent['hour'];
        }

        if (strlen($recent['minute']) < 2) {
            $recent['minute'] = '0' . $recent['minute'];
        }

        $fecha = date('d-m-Y H:i:s', $recent['timestamp']);

        echo '<tr>
		<td>' . $recent['full_date'] . '</td>
		<td>' . $recent['hour'] . ':' . $recent['minute'] . '</td>
		<td><a href="#">' . clean($recent['user_name']) . '</a> (' . $recent['user_id'] . ')</td>
		<td><a href="#">' . clean(RoomManager::GetRoomVar($recent['room_id'], 'caption')) . '</a> (' . $recent['room_id'] . ')</td>
		<td>' . clean($recent['message']) . '</td>
		<td>' . $fecha . ' (<a href="index.php?_cmd=chatlogs&timeSearch=' . intval($recent['timestamp']) . '">Search</a>)</td>
		</tr>';
    }

    echo '</tbody>
	</thead>
	</table>';
}


require_once "bottom.php";

?>