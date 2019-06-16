<?php
require_once("../global.php");

function time_stamp($session_time)
{
    $time_difference = time() - $session_time;
    $seconds = $time_difference;
    $minutes = round($time_difference / 60);
    $hours = round($time_difference / 3600);
    $days = round($time_difference / 86400);
    $weeks = round($time_difference / 604800);
    $months = round($time_difference / 2419200);
    $years = round($time_difference / 29030400);
    if ($seconds <= 60) {
        return "Fazem $seconds segundos";
    }
    if ($minutes <= 60) {
        if ($minutes == 1) {
            return "Faz 1 minuto";
        }
        return "Fazem $minutes minutos";
    }
    if ($hours <= 24) {
        if ($hours == 1) {
            return "Faz 1 hora";
        }
        return "Fazem $hours horas";
    }
    if ($days <= 7) {
        if ($days == 1) {
            return "Faz 1 dia";
        }
        return "Fazem $days dias";
    } else if ($weeks <= 4) {
        if ($weeks == 1) {
            return "Faz 1 semana";
        } else {
            return "Fazem $weeks semanas";
        }
    } else if ($months <= 12) {
        if ($months == 1) {
            return "Faz 1 mês";
        } else {
            return "Fazem $months meses";
        }
    } else {
        if ($years == 1) {
            return "Faz 1 ano";
        } else {
            return "Fazem $years anos";
        }
    }
}

function searchHabbos($tag)
{
    if (!isset($_POST['pageNumber'])) {
        $pg = 0;
    } else {
        $pg = (int) $_POST['pageNumber'];
    }
    $pag2 = $pg * 10;
    $buscarhabbo = db::query("SELECT id,last_online,motto,username,look FROM users WHERE username LIKE ? LIMIT $pag2, 10", "%$tag%");
    if ($buscarhabbo->rowCount()) {
        $net = '<ul class="habblet-list">';
        $m = 0;
        while ($datoshabbo = $buscarhabbo->fetch(2)) {
            $amigosdehabbo = db::query("SELECT * FROM messenger_friendships WHERE user_one_id = '" . USER_ID . "' AND user_two_id = ?", $datoshabbo['id']);
            if ($m % 2 == 0)
                $color = "even";
            else
                $color = "odd";

            $acceso = $datoshabbo['last_online'];
            if (empty($datoshabbo['last_online']))
                $acceso = "Nunca";
            if (empty($datoshabbo['motto']))
                $datoshabbo['motto'] = "";
            if (empty($datoshabbo['last_online'])) {
                $hace = "Nunca";
            } else {
                $hace = $datoshabbo['last_online'];
            }
            $look = $datoshabbo['look'];
            $net .= '<li style="background-image: url(https://habbo.city/habbo-imaging/avatarimage?figure=' . $look . '&size=s)" homeurl="/home/' . $datoshabbo['username'] . '" class="' . $color . ' offline">';
            $net .= '<div class="item"><b>' . $datoshabbo['username'] . '</b><br>' . $datoshabbo['motto'] . '</div>';
            $net .= '<div class="lastlogin"><b>&#218;ltimo acceso</b><br><span title="' . $acceso . '">' . $hace . '</span></div>';
            if ($amigosdehabbo->rowCount() <= 0 && ($datoshabbo['id'] != USER_ID))
                $net .= '<div class="tools"><a title="Adicionar  ' . $datoshabbo['username'] . ' a sua lista de amigos" avatarid="' . $datoshabbo['id'] . '" class="add" href="#"></a></div>';
            $net .= '<div class="clear"></div></li>';
            $m++;
        }
        $net .= '</ul>';
    } else {
        $net = "Nenhum usuário encontrado";
    }
    $dato1 = db::query("SELECT count(id) FROM users WHERE username LIKE ?", "%$tag%")->fetchColumn();
    $dato = $dato1 / 10;
    if (substr($dato, strlen($dato) - 2, strlen($dato) - 1) === ".9" or ".8" or ".7" or ".6" or ".5" or ".4" or ".3" or ".2" or ".1")
        $dato = substr($dato, 0, -2) + 1;

    if ($dato != 1) {
        $net .= '<div id="habblet-paging-avatar-habblet-list-container"><p class="paging-navigation" id="avatar-habblet-list-container-list-paging">';
        $net .= '<a id="avatar-habblet-list-container-list-previous" class="avatar-habblet-list-container-list-paging-link" href="#">&#171;</a>';
        for ($i = $_POST['pageNumber']; $i <= $_POST['pageNumber'] + 5; $i++) {
            if ($i <= $dato)
                $net .= '<a id="avatar-habblet-list-container-list-page-' . $i . '" class="avatar-habblet-list-container-list-paging-link" href="#">' . $i . '</a>';
        }
        $net .= '<a id="avatar-habblet-list-container-list-next" class="avatar-habblet-list-container-list-paging-link" href="#">&#187;</a></p><input type="hidden" value="' . $_POST['pageNumber'] . '" id="avatar-habblet-list-container-pageNumber"><input type="hidden" value="' . $dato . '" id="avatar-habblet-list-container-totalPages"></div>';
    }
    return $net;
}

if (!isset($_POST['searchString'])) {
    $string = "";
} else {
    $string = $_POST['searchString'];
}
echo searchHabbos($string);

?>