<?php

header("Content-type: image/png");
echo file_get_contents("banned/" . rand(1, 6) . ".png");

?>