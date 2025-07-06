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
        // Sanitize column name to prevent SQL injection
        $allowedColumns = ['caption', 'owner', 'state', 'model_name', 'wallpaper', 'floor'];
        if (!in_array($var, $allowedColumns)) {
            throw new InvalidArgumentException('Invalid column name');
        }
        return db::query("SELECT $var FROM rooms_data WHERE id = ? LIMIT 1", $roomId)->fetchColumn();
    }
}
