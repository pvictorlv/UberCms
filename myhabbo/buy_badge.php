<?php
if(!defined('NOWHOS'))
{
	define('NOWHOS', true);
}
define('Xukys', true);
define('MUST_LOG', true);
require '../global.php';

if(isset($_POST['badge_id']))
{
	$badgeid = $gtfo->cleanWord($_POST['badge_id']);
		if(is_numeric($badgeid))
		{
			switch($badgeid)
			{
				case 1:
					$price = 1;
					$id = 'COM66';
					break;
				case 2:
					$price = 1;
					$id = 'DE153';
					break;
				case 3:
					$price = 1;
					$id = 'FI043';
					break;
				case 4:
					$price = 1;
					$id = 'FI042';
					break;
				case 5:
					$price = 1;
					$id = 'NL105';
					break;
				case 6:
					$price = 1;
					$id = 'UK162';
					break;
				case 7:
					$price = 1;
					$id = 'ES223';
					break;
				case 8:
					$price = 1;
					$id = 'ES218';
					break;
				case 9:
					$price = 1;
					$id = 'FBLL9';
					break;
				case 10:
					$price = 1;
					$id = 'XM10E';
					break;	
				case 11:
					$price = 1;
					$id = 'COM67';
					break;	
				case 12:
					$price = 1;
					$id = 'BR261';
					break;	
				case 13:
					$price = 1;
					$id = 'ES170';
					break;
				case 14:
					$price = 2;
					$id = 'ES158';
					break;
				case 15:
					$price = 1;
					$id = 'CNY04';
					break;
				case 16:
					$price = 1;
					$id = 'USS';
				default:
					break;
			}			
			
			if(isset($price) && isset($id))
			{
				$data = mysql_fetch_array(dbquery("SELECT vip_points,vip FROM users WHERE id = '".USER_ID."' LIMIT 1;"));
				if($data['vip'] == 0)
				{
					die('<center><font color="red">No eres VIP, para poder comprar placas debes ser VIP.</font></center>');
				}
				if($data['vip_points'] > $price)
				{
					$count = mysql_num_rows(dbquery("SELECT badge_id FROM user_badges WHERE user_id = '".USER_ID."' AND badge_id = '".$id."' LIMIT 1;"));
					if($count > 0)
					{
						die('<center><font color="red">Ya cuentas con esta placa, por favor elige otra.</font></center>');
					}
					else
					{
						dbquery("INSERT INTO user_badges (user_id, badge_id) VALUES ('".USER_ID."', '".$id."')");
						dbquery("UPDATE users SET vip_points = vip_points - $price WHERE id = '".USER_ID."' LIMIT 1");
						die('<center><font color="green">Placa comprada correctamente.</font></center>');
					}					
				}
				else
				{
					die('<center><font color="red">No tienes suficientes puntos VIP</font></center>');
				}
				
			}
			
		}
}
?>