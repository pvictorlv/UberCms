<?php

class RoomManager
{
    public static function CreateRoom($name, $owner, $model): int
    {
        db::query("INSERT INTO rooms_data (roomtype,caption,owner,state,model_name) VALUES ('private',?,?,'open',?)", $name, $owner, $model);

        return Db::GetId();
    }

    public static function PaintRoom($roomId, $wallpaper, $floor): void
    {
        db::query('UPDATE rooms_data SET wallpaper = ?, floor = ? WHERE id = ? LIMIT 1', $wallpaper, $floor, $roomId);
    }

    public static function GetRoomVar($roomId, $var)
    {
        return db::query('SELECT ' . $var . " FROM rooms_data WHERE id = ? LIMIT 1", $roomId)->fetchColumn();
    }
}
