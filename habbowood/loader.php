<?php
include "../global.php";

if (!LOGGED_IN) {
    header("Location: " . WWW . "/login.php");
    exit;
}

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Habbowood</title>
    <script type="text/javascript" src="js/flashobject.js"></script>
    <script src="https://unpkg.com/@ruffle-rs/ruffle"></script>
    <script>
        var name = '<?php echo USER_NAME;?>';
    </script>
</head>
<body bgcolor="#292929" rightmargin=0"" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td width="100%" height="100%" valign="top" id="flashcontent">

            <div style="margin:20px;padding:20px;background-color:#FFFFFF;">
                <h2>Error!</h2>
                <p>Please install <a href="http://www.adobe.com/go/EN_US-H-GET-FLASH">Flash</a>.</p>
                <p><a href="http://www.adobe.com/go/EN_US-H-GET-FLASH"><img
                            src="http://www.adobe.com/images/shared/download_buttons/get_adobe_flash_player.png"
                            alt="Please install Flash Player" width="88" height="31" border="0"/></a></p>
            </div>

        </td>
        <td width="1"></td>
    </tr>
    <tr>
        <td style="habbowoodnt-size:1px; height:1px;"></td>
        <td></td>
    </tr>
</table>
<script type="text/javascript">

    var habbowood = new FlashObject("<?php echo WWW; ?>/habbowood/flash/habbowood_movie_editor.swf", "habbowoodtester", "100%", "100%", "7", "#292929");
    habbowood.addParam("allowScriptAccess", "always");
    habbowood.addParam("scale", "noscale");
    habbowood.addParam("name", "editor");
    habbowood.addParam("quality", "high");
    habbowood.addVariable("language", "fi");
    habbowood.addParam("base", "<?php echo WWW; ?>/habbowood/flash/");

    habbowood.addVariable("figuredata_url", "<?php echo WWW; ?>/habbowood/xml/figure_data_xml_hc.xml");
    habbowood.addVariable("movie_data_url", "<?php echo WWW; ?>/habbowood/xml/habbowood_blank.xml");
    habbowood.addVariable("avatar_name", name);
    habbowood.addVariable("localization_url", "<?php echo WWW; ?>/habbowood/xml/locale.xml");
    habbowood.addVariable("movie_id", "");
    habbowood.addVariable("cancel_url", "http://www.google.com");
    habbowood.addVariable("post_url", "<?php echo WWW; ?>/habbowood/savemovie.php");
    habbowood.addVariable("end_page_url", "<?php echo WWW; ?>/habbowood/movie.php");
    habbowood.addVariable("is_habbo_club_member", "true");


    habbowood.write("flashcontent");

</script>
</body>
</html>