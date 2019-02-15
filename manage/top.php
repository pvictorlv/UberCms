<?php

if (!defined('IN_HK') || !IN_HK) {
    exit;
}

if (!HK_LOGGED_IN) {
    exit;
}

?>
<html>
<head>
    <title>Housekeeping</title>
    <style type="text/css">
        * {
            margin: 0;
            padding: 0;
        }

        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        table {
            font-size: 12px;
        }

        table thead {
            font-weight: bold;
        }

        #menu {
            padding: 5px;
        }

        a {
            color: #35415C;
            text-decoration: none;
            font-weight: normal;
        }

        #boton {
            border: 1px solid #BBB;
            margin: 0;
            padding: 0 0 1px;
            font-family: Verdana, Arial, Helvetica, sans-serif;
            font-size: 11px;
            min-width: 94px;
            height: 24px;
            background: url(/manage/white-grad-active.png) 0 0;
            color: black;
            -moz-border-radius: 3px;
            -khtml-border-radius: 3px;
            -webkit-border-radius: 3px;
            border-radius: 3px;
            font-weight: bold;
            cursor: pointer;
        }

        a:hover {
            text-decoration: underline;
        }

        #menu li {
            margin: 0px;
        }

        #menu li:hover {
            background: #f6f7fe;
        }

        #menu li a {
            display: block;
            width: 100%;
        }

        h1, h2 {
            background: #EFF0F9;
            text-align: left;
        }

        h1 {
            margin-top: 0px;
            font-size: 140%;
            padding: 3px;
            color: #000;
        }

        h2 {
            margin: 0;
            font-size: 100%;
            margin-top: 1em;
            padding: 3px;
        }

        #main {
            padding: 5px;
        }

        .plus {
            float: right;
            font-size: 8px;
            font-weight: normal;
            padding: 1px 4px 2px 4px;
            margin: 0px 0px;
            background: #f6f7fe;
            color: #000;
            border: 1px solid #b4b8d0;
            cursor: pointer;
        }

        .plus:hover {
            background: #f6f7fe;
            border: 1px solid #c97;
        }

        ul.listmnu {
            list-style: none;
        }

        .listmnu {
            padding: 5px;
            text-align: left;
        }

        #top-flashmessage-ok {
            background-color: #E0F8E0;
            color: #088A08;
        }

        #top-flashmessage-error {
            background-color: #F8E0E0;
            color: #8A0808;
        }

        #top-flashmessage-ok, #top-flashmessage-error {
            font-family: arial, san-serif;
            border: 1px solid #2E2E2E;
            font-size: 14px;
            font-weight: bold;
            text-align: center;
            padding: 5px;
            margin-bottom: 10px;
        }

        table td {
            padding: 3px;
        }
    </style>
    <script type="text/javascript">

        function Toggle(id) {
            var List = document.getElementById('list-' + id);
            var Button = document.getElementById('plus-' + id);

            if (List.style.display == 'block' || List.style.display == '') {
                List.style.display = 'none';
                Button.innerHTML = '+';
            }
            else {
                List.style.display = 'block';
                Button.innerHTML = '-';
            }

            setCookie('tab-' + id, List.style.display, 9999);
        }

        function t(id) {
            var el = document.getElementById(id);

            if (el.style.display == 'block' || el.style.display == '') {
                el.style.display = 'none';
            }
            else {
                el.style.display = 'block';
            }
        }

        function setCookie(c_name, value, expiredays) {
            var exdate = new Date();
            exdate.setDate(exdate.getDate() + expiredays);
            document.cookie = c_name + "=" + escape(value) +
                ((expiredays == null) ? "" : ";expires=" + exdate.toGMTString());
        }

        function checkCookies() {
            ca = document.cookie.split(';');

            for (i = 0; i < ca.length; i++) {
                bits = ca[i].split('=');

                key = trim(bits[0]);
                value = trim(bits[1]);

                if (key.substr(0, 3) == 'tab') {
                    tabName = key.substr(4);

                    if (value == 'none') {
                        Toggle(tabName);
                    }
                }
            }
        }

        function trim(value) {
            value = value.replace(/^\s+/, '');
            value = value.replace(/\s+$/, '');
            return value;
        }

        function popClient() {
            window.open('/client.php', 'LxCMS v2 BETA', 'width=980,height=600,location=no,status=no,menubar=no,directories=no,toolbar=no,resizable=no,scrollbars=no');
            return false;
        }

        function popSsoClient(sso) {
            window.open('/client.php?forceTicket=' + sso, 'LxCMS v2 BETA', 'width=980,height=600,location=no,status=no,menubar=no,directories=no,toolbar=no,resizable=no,scrollbars=no');
            return false;
        }
    </script>

    <link href="http://www.guifx.com/StyleSheets/ModuleStyleSheets.css" type="text/css" rel="StyleSheet"/>
    <link rel="shortcut icon" href="/web-gallery/v2/favicon.ico"/>
    <link rel="stylesheet" type="text/css" href="css/style.css" media="screen" charset="utf-8"/>
    <link rel="stylesheet" type="text/css" href="css/styles_store.css" media="screen" charset="utf-8"/>
    <script type="text/javascript" src="http://www.guifx.com/scripts/rollover.js" defer></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/prototype/1.6.1/prototype.js"></script>
    <script type="text/javascript"
            src="https://ajax.googleapis.com/ajax/libs/scriptaculous/1.8.2/scriptaculous.js"></script>

    <link rel="stylesheet" type="text/css" href="http://www.guifx.com/scripts/lightview/css/lightview.css"/>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1"/>

</head>
<body onload="checkCookies();">
<div id="section_main">
    <div id="page">
        <a href="/manage"><img alt="Habbo Painel" src="images/website/logo.gif" id="logo"/></a>


        <!--// NAV MAIN //-->
        <div id="nav_main">
            <div id="nav_main_l">&nbsp;</div>
            <div id="nav_main_r">&nbsp;</div>
            <div id="nav_main_center">
                <div id="main_nav_btns" style="margin-top: 8px;">
                    <style> .catmain323206 {
                            padding: 0px;
                            margin: 0px;
                            border-width: 0px;
                            border-style: none;
                            border-color: black;
                        }

                        .catmain0323206 {
                            font-family: Verdana, Arial;
                            font-size: 10pt;
                            text-align: left;
                            color: black;
                            background-color: gray;
                            border-width: 0px;
                            border-style: none;
                            border-color: black;
                            padding-top: 0px;
                            padding-right: 0px;
                            padding-bottom: 0px;
                            padding-left: 0px;
                            text-decoration: none;
                        }

                        .catmain1323206 {
                            cursor: pointer;
                            font-family: Verdana, Arial;
                            font-size: 10pt;
                            text-align: left;
                            color: black;
                            background-color: blue;
                            border-width: 0px;
                            border-style: none;
                            border-color: black;
                            padding-top: 0px;
                            padding-right: 0px;
                            padding-bottom: 0px;
                            padding-left: 0px;
                            text-decoration: none;
                        }

                        .catdiv323206 {
                            position: absolute;
                            visibility: hidden;
                            z-index: 1000;
                            padding: 0px;
                            margin: 0px;
                        }

                        .catsub323206 {
                            padding: 0px;
                            margin: 0px;
                            border-width: 1px;
                            border-style: solid;
                            border-color: black;
                        }

                        .catsub0323206 {
                            font-family: Verdana, Arial;
                            font-size: 10pt;
                            text-align: left;
                            color: black;
                            background-color: gray;
                            border-width: 0px;
                            border-style: none;
                            border-color: black;
                            padding-top: 0px;
                            padding-right: 0px;
                            padding-bottom: 0px;
                            padding-left: 0px;
                            text-decoration: none;
                        }

                        .catsub1323206 {
                            cursor: pointer;
                            font-family: Verdana, Arial;
                            font-size: 10pt;
                            text-align: left;
                            color: black;
                            background-color: blue;
                            border-width: 0px;
                            border-style: none;
                            border-color: black;
                            padding-top: 0px;
                            padding-right: 0px;
                            padding-bottom: 0px;
                            padding-left: 0px;
                            text-decoration: none;
                        }</style>


                </div>

            </div>
            <div id="nav_main_secondary">
                <div id="nav_main_secondary_l">&nbsp;</div>
                <div id="nav_main_secondary_r">&nbsp;</div>
                <div id="nav_main_secondary_center">
                    <div id="breadcrumbs">
              <span id="breadcrumbs_current">
<?php
if ($_cmd == "main") {
    echo " <span id=\"breadcrumbs_current\">Home</span>";
}
if ($_cmd == "getstaff") {
    echo "<a href=\"/manage/\">Home</a>&nbsp;&nbsp;&gt;&nbsp;&nbsp;<span id=\"breadcrumbs_current\">Lista de Staffs</span> ";
}
if ($_cmd == "forum") {
    echo "<a href=\"/manage/\">Home</a>&nbsp;&nbsp;&gt;&nbsp;&nbsp;<span id=\"breadcrumbs_current\">Forum staff</span> ";
}
if ($_cmd == "maint") {
    echo "<a href=\"/manage/\">Home</a>&nbsp;&nbsp;&gt;&nbsp;&nbsp;<span id=\"breadcrumbs_current\">Manutenção</span> ";
}
?></span>
                    </div>


                </div>
            </div>
        </div>
        <!--// END NAV MAIN //-->

        <!--// CONTENT //-->
        <div id="sidebar">
            <div id="nav_store">
                <div id="nav_store_top">
                    &nbsp;
                </div>
                <div id="nav_store_mid">
                    <ul id="navlist">
                        <li class="tier1">
                            <a href="#" class="more" onclick="Effect.toggle('templates', 'blind', {duration: 0.4});">Geral</a>
                        </li>
                        <div class="tier2" id="templates" style="display:none">
                            <ul>
                                <li><a href="../index.php">Voltar ao site</a></li>
                                <li><a href="/client" target="_blank"
                                       onclick="HabboClient.openOrFocus(this); return false;">Abrir client</a>
                                <li><a href="index.php?_cmd=forum">Forum staff</a></li>
                                <li><a href="index.php?_cmd=getstaff">Lista de Staffs</a></li>
                            </ul>
                        </div>
                        <?php if ($users->hasFuse(USER_ID, 'fuse_housekeeping_sitemanagement')) { ?>
                            <li class="tier1">
                                <a href="#" class="more"
                                   onclick="Effect.toggle('management', 'blind', {duration: 0.4});">Usuarios</a>
                            </li>
                            <div class="tier2" id="management" style="display:none">
                                <ul>
                                    <li><a href="index.php?_cmd=maint">Mantenimiento</a></li>
                                    <li><a href="index.php?_cmd=badges">Enviar emblemas</a></li>
                                    <li><a href="index.php?_cmd=rank">Alterar Cargo</a></li>
                                </ul>
                            </div>
                        <?php } ?>
                        <?php if ($users->hasFuse(USER_ID, 'fuse_housekeeping_moderation')) { ?>
                            <li class="tier1">
                                <a href="#" class="more"
                                   onclick="Effect.toggle('Moderation', 'blind', {duration: 0.4});">Moderação</a>
                            </li>
                            <div class="tier2" id="Moderation" style="display:none">
                                <ul>
                                    <li><a href="index.php?_cmd=bans">Gestionar bans</a></li>
                                    <li><a href="index.php?_cmd=iptool">Procurar clones</a></li>
                                    <li><a href="index.php?_cmd=chatlogs">Chatlog</a></li>
                                    <li><a href="index.php?_cmd=cfhs">Llamadas de ayuda</a></li>
                                    <li><a href="index.php?_cmd=vouchers">Codigos Vouchers</a></li>
                                </ul>
                            </div>
                        <?php } ?>
                        <?php if ($users->hasFuse(USER_ID, 'fuse_housekeeping_sitemanagement')) { ?>
                            <li class="tier1">
                                <a href="#" class="more" onclick="Effect.toggle('cms', 'blind', {duration: 0.4});">Noticias e Campanhas</a>
                            </li>
                            <div class="tier2" id="cms" style="display:none">
                                <ul>
                                    <li><a href="index.php?_cmd=campaigns">Campanhas</a></li>
                                    <li><a href="index.php?_cmd=newspublish">Publicar noticias</a></li>
                                    <li><a href="index.php?_cmd=news">Listar notícias</a></li>
                                </ul>
                            </div>
                        <?php } ?>

                        <?php if ($users->hasFuse(USER_ID, 'fuse_housekeeping_catalog')) { ?>
                            <li class="tier1">
                                <a href="#" class="more" onclick="Effect.toggle('catalogo', 'blind', {duration: 0.4});">Cat�logo</a>
                            </li>
                            <div class="tier2" id="catalogo" style="display:none">
                                <ul>
                                    <li><a href="index.php?_cmd=ot-def">Definiciones de los Items</a></li>
                                    <li><a href="index.php?_cmd=ot-cata-items">Items del catalogo</a></li>
                                </ul>
                            </div>
                        <?php } ?>

                        <li class="">
                            <a href="index.php?_cmd=logout">Sair</a>

                        </li>
                    </ul>
                </div>
                <div id="nav_store_bot">
                    &nbsp;
                </div>
            </div>

        </div>
        <div id="content_area" style="font-size: 13px;">
            <!--// CONTENT BODY AREA //-->
            <ul class="productList productLarge">
                <li id="catProdTd_702559" class="productItem"><!--// END PRODUCT //-->


