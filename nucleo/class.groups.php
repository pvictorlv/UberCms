<?php

class Groups {

    public function alreadyGroupTag(array|bool|string $groupId, array|string $tagName)
    {
        $query = db::query("SELECT id FROM groups_tags WHERE group_id = ? AND tag = ? LIMIT 1", $groupId, $tagName)->rowCount();
        return $query > 0;
    }

    public function addGroupTag(array|bool|string $groupId, string $tagName)
    {
        db::query("INSERT INTO groups_tags (group_id, tag) VALUES (?, ?)", $groupId, $tagName);

    }
}