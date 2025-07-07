<?php

if (!defined('UBER') || !UBER)
{
	exit;
}

$cutoff = time() - 604800;

//$get = db::query("SELECT id FROM moderation_forum_threads WHERE timestamp <= " . $cutoff);

//while ($topic = $get->fetch(PDO::FETCH_ASSOC)))
{
//	db::query("DELETE FROM moderation_forum_threads WHERE id = '" . $topic['id'] . "' LIMIT 1");
//	db::query("DELETE FROM moderation_forum_replies WHERE thread_id = '" . $topic['id'] . "'");
}

?>