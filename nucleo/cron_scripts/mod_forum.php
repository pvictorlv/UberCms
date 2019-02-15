<?php

if (!defined('UBER') || !UBER)
{
	exit;
}

$cutoff = time() - 604800;

$get = dbquery("SELECT id FROM moderation_forum_threads WHERE timestamp <= " . $cutoff);

while ($topic = mysql_fetch_assoc($get))
{
	dbquery("DELETE FROM moderation_forum_threads WHERE id = '" . $topic['id'] . "' LIMIT 1");
	dbquery("DELETE FROM moderation_forum_replies WHERE thread_id = '" . $topic['id'] . "'");
}

?>