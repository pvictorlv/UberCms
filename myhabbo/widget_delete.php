<?php
if(!defined('Xukys'))
{
	define('Xukys', true);
}
if(!defined('NOWHOS'))
{
	define('NOWHOS', true);
}
include '../global.php';

if(!LOGGED_IN)
{
	header('Location: '.WWW.'/');
}

if(isset($_POST['widgetId']))
{
	if(is_numeric($_POST['widgetId']))
	{
		$widgetId = $gtfo->cleanWord($_POST['widgetId']);
		$sql = mysql_query("SELECT id,owner_id FROM homes_items WHERE id = '".$widgetId."' AND home_id = '".USER_ID."'");
		$data = mysql_fetch_array($sql);
		
		if(mysql_num_rows($sql) > 0)
		{
			if($data['owner_id'] == USER_ID)
			{			
				mysql_query("DELETE from homes_items WHERE id = '".$widgetId."' LIMIT 1");
			}
		}
		
	}
}
?>