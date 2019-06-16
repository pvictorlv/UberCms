<?php

class RoomManager
{
    public static function CreateRoom($name, $owner, $model): int
    {
        db::query("INSERT INTO rooms (roomtype,caption,owner,state,model_name) VALUES ('private',?,?,'open',?)", $name, $owner, $model);

        return Db::GetId();
    }

    public static function PaintRoom($roomId, $wallpaper, $floor): void
    {
        db::query('UPDATE rooms SET wallpaper = ?, floor = ? WHERE id = ? LIMIT 1', $wallpaper, $floor, $roomId);
    }

    public static function GetRoomVar($roomId, $var)
    {
        return db::query('SELECT ' . $var . " FROM rooms WHERE id = ? LIMIT 1", $roomId)->fetchColumn();
    }
}
