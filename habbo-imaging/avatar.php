<?php
	header('Content-Type: image/png');
	define('HOTEL', 'habbo.es');
	define('FOLDER', 'avatarcache');
	define('DEVMODE', false);
	if (!is_dir(FOLDER)) 
    {
		mkdir(FOLDER, 0);
    }
	function Hashit()
	{
		http_build_query($_GET);
		$hash = sha1(http_build_query($_GET).'SDJkt325JAEKj');
		return $hash;
	}
	function GetCache()
	{
		if(file_exists(FOLDER.'/'.Hashit().'.png'))
		{
			return require(FOLDER.'/'.Hashit().'.png');
		} else {
			return 0;
		}
	}
	function Avatar()
	{
		$create = fopen(FOLDER.'/'.Hashit().'.png', 'w+');
		$ch = curl_init('https://'.HOTEL.'/habbo-imaging/avatarimage?figure='.http_build_query($_GET));
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
		curl_setopt($ch, CURLOPT_FILE, $create);         
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 1000);      
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0');
		curl_exec($ch);
		curl_close($ch);
		fclose($create);
		return GetCache();
	}
	if(GetCache() != 0 AND DEVMODE == false)
	{
		echo GetCache();
		exit;
	} 
	else 
	{
		echo Avatar();
		exit;
	}
?>