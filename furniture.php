<?php
header("Content-type: text/plain");
ini_set ('default_charset', 'UTF-8');
date_default_timezone_set('Europe/Madrid');
session_start();
 
mysql_connect("localhost", "root", "hippie") or die (mysql_errno());
mysql_select_db("butterdbb") or die(mysql_errno());
 
// Pasar sacar la url, teneis que entrar a unos de los links de abajo, y copiar el link que os de y ponerlo en el ("http://www.habbo.es/gamedata/furnidata/e2a39d001583743d31347fb521a6ca2db5")
// Idioma Español->[url=http://www.habbo.es/gamedata/furnidata/1]www.habbo.es/gamedata/furnidata/1[/url]
// Idioma English->[url=http://www.habbo.com/gamedata/furnidata/1]www.habbo.com/gamedata/furnidata/1[/url]
// Idioma Italiano->[url=http://www.habbo.it/gamedata/furnidata/1]www.habbo.it/gamedata/furnidata/1[/url]
// Y asi con todos los hoteles.
$Path = utf8_decode(file_get_contents("http://www.habbo.es/gamedata/furnidata/e2a39d001583743d31347fb521a6ca2db5bed585"));
 
$Path = str_ireplace('[[', '[', $Path);
$Path = str_ireplace('[[', '[', $Path);
$Path = str_ireplace(']', '', $Path);
 
$Data = explode('[', $Path);
 
$i = 0;
foreach($Data as $Data2)
{
set_time_limit(0);
        $i++;
        if($i == 1)
        {
        }
        else
        {
                $Data3 = explode('",', $Data2);
                $Data3 = str_ireplace('"', '', $Data3);
 
                $Query = mysql_query("SELECT * FROM furniture WHERE item_name = '".$Data3[2]."' ");
 
                while ($Row = mysql_fetch_assoc($Query))
                {
                        mysql_query("UPDATE catalog_items SET catalog_name = '$Data3[8]' WHERE item_ids = '".$Row["id"]."'");
                }
 
                mysql_query("UPDATE furniture SET public_name = '".$Data3[8]."' WHERE item_name = '".$Data3[2]."'");
        }
}
?>