<?php
include "../global.php";
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Habbowood</title>
</head>
<body bgcolor="#292929">

<object type="application/x-shockwave-flash"
        data="<?php echo WWW; ?>/habbowood/flash/movie_player_skin.swf?figuredata_url=<?php echo WWW; ?>/habbowood/xml/figure_data_xml_hc.xml&movie_data_url=<?php echo WWW; ?>/habbowood/movie_xml_data.php?id=<?php echo(filter($_GET["movieId"])); ?>&localization_url=<?php echo WWW; ?>/habbowood//xml/locale.xml"
        width="536" height="360">
    <param name="base" value="<?php echo WWW; ?>/habbowood/flash/"/>
    <param name="allowScriptAccess" value="always"/>
</object>

</body>
</html>