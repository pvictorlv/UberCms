<?php
if(!defined('NOWHOS'))
{
	define('NOWHOS', true);
}
define('MUST_LOG', true);
define('Xukys', true);
require_once '../../global.php';

if(isset($_SESSION['startSessionEditGroup'])) {
	if(is_numeric($_SESSION['startSessionEditGroup'])) {
			$groupId = $gtfo->cleanWord($_SESSION['startSessionEditGroup']);
				
			
				unset($_SESSION['startSessionEditGroup']);
				header('Location: /groups/'.$groupId.'/id');

	}
}

?>