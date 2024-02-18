<noscript>You need to enable JavaScript to run this app.</noscript>


<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />

<link rel="manifest" crossorigin="use-credentials" href="%www%/webclient/site.webmanifest">
<link rel="mask-icon" href="%www%/webclient/safari-pinned-tab.svg" color="#000000">
<meta name="apple-mobile-web-app-title" content="Nitro">
<meta name="application-name" content="Nitro">
<meta name="msapplication-TileColor" content="#000000">
<meta name="theme-color" content="#000000" />
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<base href="./">

<script type="module" crossorigin src="%www%/webclient/assets/index.js"></script>
<link rel="modulepreload" crossorigin href="%www%/webclient/assets/vendor.js">
<link rel="modulepreload" crossorigin href="%www%/webclient/assets/nitro-renderer.js">
<link rel="stylesheet" href="%www%/webclient/src/assets/index.css">

<div id="root" class="w-100 h-100"></div>
<script>
    const NitroConfig = {
        "config.urls": [ '%www%/webclient/renderer-config.json', '%www%/webclient/ui-config.json' ],
        "sso.ticket": '%sso_ticket%',
        "forward.type": '%forwardType%',
        "forward.id": '%forwardId%',
        "friend.id": (new URLSearchParams(window.location.search).get('friend') || 0),
    };
</script>


</body>
</html>
