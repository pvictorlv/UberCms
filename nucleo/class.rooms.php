<?php

class RoomManager
{
    public static function CreateRoom($name, $owner, $model)
    {
        dbquery("INSERT INTO rooms (roomtype,caption,owner,state,model_name) VALUES ('private','" . filter($name) . "','" . $owner . "','open','" . $model . "')");
        return (int)dbquery("SELECT id FROM rooms WHERE owner = '" . $owner . "' ORDER BY id DESC LIMIT 1")->fetch_assoc()['id'];
    }

    public static function PaintRoom($roomId, $wallpaper, $floor)
    {
        dbquery("UPDATE rooms SET wallpaper = '" . $wallpaper . "', floor = '" . $floor . "' WHERE id = '" . $roomId . "' LIMIT 1");
    }

    public static function GetRoomVar($roomId, $var)
    {
        return dbquery('SELECT ' . $var . " FROM rooms WHERE id = '" . $roomId . "' LIMIT 1")->fetch_assoc()[$var];
    }
}
