<?php

if (!defined('IN_HK') || !IN_HK)
{
	exit;
}

if (!HK_LOGGED_IN)
{
	exit;
}

require_once "top.php";

?>			

<div style="margin: 25px;">
<center>
	<b style="font-size: 18px;">Pagina no encontrada</b>
	
	<p>
		La pagina no existe
	</p>
	
	<p>
		Si encuentras algun Bug reportelo <a href="mailito:robercid_3@hotmail.com">a Rober</a>.
	</p>
	
</center>
</div>

<?php

require_once "bottom.php";

?>