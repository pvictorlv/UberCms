<?php

require_once("../global.php");
mysql_query("INSERT INTO messenger_requests (to_id, from_id) VALUES ('".$_POST['accountId']."', '".USER_ID."')");
echo '<ul>La petici&#243;n de Amigo se envi&#243; correctamente.</ul><p>
<a class="new-button done" href="#"><b>&#161;Listo!</b><i></i></a>
</p>';
?>