<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');

include "../global.php";
if (!LOGGED_IN) {
    print_r($_SESSION);
    exit;
}
include "../inc/plus.class.php";
$length = $_GET['l'];
$data = $_GET['o'];
if (!isset($data, $length)) {
    echo 2;
    exit;
}
db::query("INSERT INTO jukebox_songs_data (codename, name, artist, song_data, length) VALUES (:code, :name, :user, :data, :length)", array(':code' => USER_NAME . '_music', ':name' => USER_NAME . ' music', ':user' => USER_NAME, ':data' => $data, ':length' => $length));
$id = db::query('SELECT id FROM jukebox_songs_data WHERE song_data = :data AND artist = :user', array(':data' => $data, ':user' => USER_NAME))->fetch(2)['id'];
$mus = new Plus($_MUS_HOST_, $_MUS_PORT_);
$mus->addSong(USER_ID, 1007, $length, $data);
