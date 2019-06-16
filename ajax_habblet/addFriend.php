<?php

require_once "../global.php";
db::query('INSERT INTO messenger_requests (to_id, from_id) VALUES (?,?)', $_POST['accountId'], USER_ID);
echo '<ul>Pedido de amizade enviado!</ul><p>
<a class="new-button done" href="#"><b>&#161;Pronto!</b><i></i></a>
</p>';
?>