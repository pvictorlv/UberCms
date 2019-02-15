<noscript>
    <meta http-equiv="refresh" content="0;url=/client/nojs"/>
</noscript>

<link rel="stylesheet" href="http://localhost/web-gallery/v2/styles/habboclient.css" type="text/css"/>
<link rel="stylesheet" href="http://localhost/web-gallery/v2/styles/habboflashclient.css" type="text/css"/>
<script src="http://localhost/web-gallery/static/js/habboflashclient.js" type="text/javascript"></script>
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script src="http://oblivion.website/js/socket.io-1.4.5.js"></script>
<script src="http://oblivion.website/js/jquery-ui.js"></script>
<script src="%www%/ws_script.php"></script>
<script type="text/javascript">
    FlashExternalInterface.loginLogEnabled = false;
    FlashExternalInterface.logLoginStep("web.view.start");
    if (top == self) {

        FlashHabboClient.cacheCheck();

    }

    var flashvars = {
        "client.allow.cross.domain": "1",
        "client.notify.cross.domain": "0",
        "connection.info.host": "127.0.0.1",
        "connection.info.port": "30004",
        "site.url": "%www%",
        "url.prefix": "%www%",
        "client.reload.url": "%www%/account/reauthenticate?page=/flash_client",
        "client.fatal.error.url": "%www%/me.php",
        "client.connection.failed.url": "%www%/me.php",
        "external.hash": "",
        "external.variables.txt": "http://localhost/gamedata/external_variablesnew.txt?1",
        "external.texts.txt": "http://localhost/gamedata/external_flash_texts.txt?3",
        "productdata.load.url": "http://localhost/gamedata/productdata.txt",
        "avatareditor.promohabbos": "http://localhost/gamedata/hotlooks.xml",
        "furnidata.load.url": "http://localhost/gamedata/furnidata.txt?19",
        "use.sso.ticket": "1",
        "sso.ticket": "%sso_ticket%",
        "processlog.enabled": "0",
        "account_id": "0",
        "client.starting": "Hey %habboName%, Aguarde, o hotel está carregando! %hotel_status%",
        "flash.client.url": "http://localhost/gordon/RELEASE63-30422-30421-201012031025_ae9f99b7038dab3670d4b6ab7c9bf83b/",
        "user.hash": "199275052dbf5f89adb0a643bf16b0ea1cd646db",
        "flash.client.origin": "popup"
    };
    var params = {
        "base": "http://localhost/gordon/RELEASE63-30422-30421-201012031025_ae9f99b7038dab3670d4b6ab7c9bf83b/",
        "allowScriptAccess": "always",
        "menu": "false"
    };

    if (!(HabbletLoader.needsFlashKbWorkaround())) {
        params["wmode"] = "opaque";
    }

    var clientUrl = "http://localhost/gordon/RELEASE63-30422-30421-201012031025_ae9f99b7038dab3670d4b6ab7c9bf83b/Habbo.swf?16";
    swfobject.embedSWF(clientUrl, "flash-container", "100%", "100%", "10.0.0", "http://localhost/web-gallery/flash/expressInstall.swf", flashvars, params);

    window.onbeforeunload = unloading;
    function unloading() {
        var clientObject;
        if (navigator.appName.indexOf("Microsoft") != -1) {
            clientObject = window["flash-container"];
        } else {
            clientObject = document["flash-container"];
        }
        try {
            clientObject.unloading();
        } catch (e) {
        }
    }
</script>

<meta name="description"
      content="Check into the world?s largest virtual hotel for FREE! Meet and make friends, play games, chat with others, create your avatar, design rooms and more?"/>
<meta name="keywords"
      content="habbo hotel, virtual, world, social network, free, community, avatar, chat, online, teen, roleplaying, join, social, groups, forums, safe, play, games, online, friends, teens, rares, rare furni, collecting, create, collect, connect, furni, furniture, pets, room design, sharing, expression, badges, hangout, music, celebrity, celebrity visits, celebrities, mmo, mmorpg, massively multiplayer"/>

<!--[if IE 8]>
<link rel="stylesheet" href="http://localhost/web-gallery/v2/styles/ie8.css" type="text/css"/>
<![endif]-->
<!--[if lt IE 8]>
<link rel="stylesheet" href="http://localhost/web-gallery/v2/styles/ie.css" type="text/css"/>
<![endif]-->
<!--[if lt IE 7]>
<link rel="stylesheet" href="http://localhost/web-gallery/v2/styles/ie6.css" type="text/css"/>
<script src="http://localhost/web-gallery/static/js/pngfix.js" type="text/javascript"></script>
<script type="text/javascript">
    try {
        document.execCommand('BackgroundImageCache', false, true);
    } catch (e) {
    }
</script>

<style type="text/css">
    body {
        behavior: url(/js/csshover.htc);
    }
</style>
<![endif]-->
<meta name="build" content="63-BUILD36 - 16.11.2010 11:51 - com"/>
</head>
<body id="client" class="flashclient">
<div id="overlay"></div>
<img src="http://localhost/web-gallery/v2/images/page_loader.gif" style="position:absolute; margin: -1500px;"/>

<div id="overlay"></div>
<div id="client-ui">
    <div id="flash-wrapper">
        <div id="flash-container">
            <div id="content" style="width: 400px; margin: 20px auto 0 auto;">

                <div class="cbb clearfix">
                    <h2 class="title">Por favor, atualize o seu FlashPlayer.</h2>
                    <div class="box-content">
                        <p>Você pode baixar e instalar o Adobe Flash Player aqui: <a
                                href="http://get.adobe.com/flashplayer/">Instalar flash player</a>. Mais informações
                            podem ser obtidas aqui: <a
                                href="http://www.adobe.com/products/flashplayer/productinfo/instructions/">Mais
                                informações</a></p>
                        <p><a href="http://www.adobe.com/go/getflashplayer"><img
                                    src="http://localhost/web-gallery/v2/images/client/get_flash_player.gif"
                                    alt="Get Adobe Flash player"/></a></p>
                    </div>
                </div>

            </div>
            <script type="text/javascript">
                $('content').show();
            </script>
            <noscript>
                <div style="width: 400px; margin: 20px auto 0 auto; text-align: center">
                    <p>If you are not automatically redirected, please <a href="/client/nojs">click here</a></p>
                </div>
            </noscript>
        </div>
    </div>
    <div id="content" class="client-content"></div>
</div>
<div style="display: none">

    <div id="habboCountUpdateTarget">
        %hotel_status%
    </div>
    <script language="JavaScript" type="text/javascript">
        setTimeout(function () {
            HabboCounter.init(600);
        }, 20000);
    </script>
</div>
<script type="text/javascript">
    RightClick.init("flash-wrapper", "flash-container");
    if (window.opener && window.opener != window && typeof window.opener.location.href != "undefined") {
        window.opener.location.replace(window.opener.location.href);
    }
    $(document.body).addClassName("js");
    HabboClient.startPingListener();
</script>



</body>
</html>
