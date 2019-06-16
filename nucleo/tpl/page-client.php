<noscript>
    <meta http-equiv="refresh" content="0;url=/client/nojs"/>
</noscript>

<link rel="stylesheet" href="%www%/web-gallery/v2/styles/habboclient.css" type="text/css"/>
<link rel="stylesheet" href="%www%/web-gallery/v2/styles/habboflashclient.css" type="text/css"/>
<script src="%www%/web-gallery/static/js/habboflashclient.js" type="text/javascript"></script>
<script src="https://code.jquery.com/jquery-latest.js"></script>
<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
<script src="%www%/web-gallery/ws/wsFunctions.js"></script>
<script src="%www%/web-gallery/ws/wsInit.js"></script>

<script type="text/javascript">
    FlashExternalInterface.loginLogEnabled = false;

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
        "external.variables.txt": "%www%/gamedata/external_variablesnew.txt?1",
        "external.texts.txt": "%www%/gamedata/external_flash_texts.txt?3",
        "productdata.load.url": "%www%/gamedata/productdata.txt",
        "avatareditor.promohabbos": "%www%/gamedata/hotlooks.xml",
        "furnidata.load.url": "%www%/gamedata/furnidata.txt?19",
        "use.sso.ticket": "1",
        "sso.ticket": "%sso_ticket%",
        "processlog.enabled": "0",
        "account_id": "0",
        "client.starting": "Hey %habboName%, Aguarde, o hotel está carregando!",
        "flash.client.url": "%www%/gordon/RELEASE63-30422-30421-201012031025_ae9f99b7038dab3670d4b6ab7c9bf83b/",
        "user.hash": "199275052dbf5f89adb0a643bf16b0ea1cd646db",
        "flash.client.origin": "popup"
    };
    var params = {
        "base": "%www%/gordon/RELEASE63-30422-30421-201012031025_ae9f99b7038dab3670d4b6ab7c9bf83b/",
        "allowScriptAccess": "always",
        "menu": "false"
    };

    if (!(HabbletLoader.needsFlashKbWorkaround())) {
        params["wmode"] = "opaque";
    }


    var callback = function (e) {
        if (!e.success || !e.ref) {
            return false;
        }
        setTimeout(function () {

            if (typeof e.ref.PercentLoaded !== "undefined" && e.ref.PercentLoaded() >= 0) {
                var loadCheckInterval = setInterval(function () {
                    if (e.ref.PercentLoaded() === 100) {
                        startWebSockets();
                        clearInterval(loadCheckInterval);
                    }
                }, 1500);
            }
        }, 200);

    };

    var clientUrl = "%www%/gordon/RELEASE63-30422-30421-201012031025_ae9f99b7038dab3670d4b6ab7c9bf83b/Habbo04112.swf?19";
    swfobject.embedSWF(clientUrl, "flash-container", "100%", "100%", "10.0.0", "%www%/web-gallery/flash/expressInstall.swf", flashvars, params,null, callback);

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
            console.log(e);
        }
    }
</script>

<meta name="description"
      content="Check into the world?s largest virtual hotel for FREE! Meet and make friends, play games, chat with others, create your avatar, design rooms and more?"/>
<meta name="keywords"
      content="habbo hotel, virtual, world, social network, free, community, avatar, chat, online, teen, roleplaying, join, social, groups, forums, safe, play, games, online, friends, teens, rares, rare furni, collecting, create, collect, connect, furni, furniture, pets, room design, sharing, expression, badges, hangout, music, celebrity, celebrity visits, celebrities, mmo, mmorpg, massively multiplayer"/>

<!--[if IE 8]>
<link rel="stylesheet" href="%www%/web-gallery/v2/styles/ie8.css" type="text/css"/>
<![endif]-->
<!--[if lt IE 8]>
<link rel="stylesheet" href="%www%/web-gallery/v2/styles/ie.css" type="text/css"/>
<![endif]-->
<!--[if lt IE 7]>
<link rel="stylesheet" href="%www%/web-gallery/v2/styles/ie6.css" type="text/css"/>
<script src="%www%/web-gallery/static/js/pngfix.js" type="text/javascript"></script>
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
<img src="%www%/web-gallery/v2/images/page_loader.gif" style="position:absolute; margin: -1500px;"/>

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
                                        src="%www%/web-gallery/v2/images/client/get_flash_player.gif"
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

<script type="text/javascript">
    RightClick.init("flash-wrapper", "flash-container");
    if (window.opener && window.opener != window && typeof window.opener.location.href != "undefined") {
        window.opener.location.replace(window.opener.location.href);
    }
    $(document.body).addClass("js");
    HabboClient.startPingListener();


    var jjLoader = {
        'maxStep': 0,
        'currentStep': 1,
        'isInit': false,
        'interval': null,
        'init': function (_wrapperId, _maxStep, _imageUrl, _backgroundUrl) {
            jjLoader.maxStep = _maxStep;

            var wrapper = document.getElementById(_wrapperId);

            wrapper.innerHTML += '<div id="wrapperLoader" style="background: #000000 url(' + _backgroundUrl + ') center no-repeat; position: absolute; z-index: 9999999; width: 100%; height: 100%;">' +
                '<div style="width: 240px; height: 125px; padding: 5px; border-radius: 10px; background: rgba(0, 0, 0, 0.7) url(' + _imageUrl + ') center 15px no-repeat; position: absolute; left: 50%; top: 50%; margin-top: -65px; margin-left: -125px;">' +
                '<div id="wrapperLoaderText" style="margin-top: 60px; margin-bottom: 10px; text-align: center; font-family: Arial; color: #FFFFFF; font-size: 10px;">Bussy with booting up your hotel! 0%</div>' +
                '<div style="border-radius: 1px; border: 1px solid #FFFFFF; background-color: rgba(0, 0, 0, 0.6); padding: 1px; margin-left: 20px; width: 200px; height: 17px">' +
                '<div id="wrapperLoaderProgress" style="background-color: #8CA1AD; height: 17px; width: 0;">' +
                '<div style="background-color: #BACAD3; height: 9px; width: 100%;">' +
                '</div></div></div></div>';

            jjLoader.interval = window.setInterval(jjLoader.IntervalUpdate, 10);

            jjLoader.isInit = true;
            return true;
        },
        'progressNow': 0,
        'progress': 0,
        'IntervalUpdate': function () {
            if (jjLoader.progressNow >= jjLoader.progress || jjLoader.progressNow >= 100) {
                return;
            }

            jjLoader.progressNow += 2;

            var wrapperLoaderProgress = document.getElementById('wrapperLoaderProgress');
            wrapperLoaderProgress.style.width = jjLoader.progressNow + '%';
        },
        'doUpdate': function (_text) {
            if (!jjLoader.isInit) {
                return false;
            }

            jjLoader.currentStep++;
            jjLoader.progress = Math.round((100 / jjLoader.maxStep) * jjLoader.currentStep);

            if (jjLoader.progress > 100) {
                jjLoader.progress = 100;
            }

            jjLoader.updateText(_text);

            return true;
        },
        'updateText': function (_text) {
            if (!jjLoader.isInit) {
                return false;
            }

            var text = '';
            if (jjLoader.progress > 0 && jjLoader.progress < 100) {
                text = "Habbo is loading..";
            } else if (jjLoader.progress > 99 && jjLoader.progress < 101) {
                text = "Welcome to Habbo Hotel!";
            }

            var wrapperLoaderText = document.getElementById('wrapperLoaderText');
            wrapperLoaderText.innerHTML = text + ' ' + jjLoader.progress + '%';

            return true;
        },
        'finish': function () {
            if (!jjLoader.isInit) {
                return false;
            }

            var wrapperLoader = document.getElementById('wrapperLoader');
            wrapperLoader.parentNode.removeChild(wrapperLoader);

            window.clearInterval(jjLoader.interval);

            return true;
        }
    };

</script>


</body>
</html>
