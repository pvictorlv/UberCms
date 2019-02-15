<?php
/* Truncate Messenger 
   Copyright (c) 2010 HighH 
   Solo para uso privado , realizado para www.KekoMundo.com */
#------------------------------------
#      Archivos Requeridos
#------------------------------------
require_once "global.php";
#------------------------------------
#      Comprovacion de Rango
#------------------------------------
if($users->GetUserVar(USER_ID, 'rank') == "7"){// Necesario: Rango 7
#------------------------------------
#      Query's
#------------------------------------
echo "Hola Administrador, Acabas de vaciar las tablas !";
dbquery("TRUNCATE `messenger_friendships`"); 
dbquery("TRUNCATE `messenger_requests`");
}elseif($users->GetUserVar(USER_ID, 'rank') < "7"){// Necesario: Rango menor a 7
echo "Hola , Acabas de ser Reportado al Hotel! , Tu IP sera guardada .";
}elseif($users->GetUserVar(USER_ID, 'rank') > "7"){// Error 01 
echo "Error 01 - Truncate Messenger";
}elseif(!$users->GetUserVar(USER_ID, 'rank')){
echo "Error 02 - Truncate Messenger";
}
// Redireccion ...
?> <meta http-equiv="Refresh" content="5;url=index.php"> 


