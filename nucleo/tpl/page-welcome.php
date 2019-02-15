<body id="welcome">
<div id="overlay"></div>
<div id="header-container">
    <div id="header" class="clearfix">
        <h1><a href="%www%"></a></h1>
        <div id="subnavi">
            <div id="subnavi-search">
                <div id="subnavi-search-upper">
                    <ul id="subnavi-search-links">
                        <li><a href="%www%/help" target="habbohelp"
                               onClick="openOrFocusHelp(this); return false">Ajuda</a></li>
                        <li><a href="%www%/account/logout" class="userlink" id="signout">Sair</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="content-container">

    <div id="navi2-container" class="pngbg">
    </div>

    <div id="container">
        <div id="content" style="position: relative" class="clearfix">
            <div id="column1" class="column">

                <div class="habblet-container ">
                    <div class="cbb clearfix welcome ">

                        <h2 class="title">Escolha uma sala para começar a jogar. </h2>
                        <div id="roomselection-welcome-intro" class="box-content">
                            Seja bem-vindo ao %site_name%, um mundo virtual. Escolha a sala que mais gostar, selecione-a
                            e já estará pronto para jogar. Escolha uma das 6 opções!
                        </div>
                        <ul class="roomselection-welcome clearfix">
                            <li class="odd">
                                <a class="roomselection-select new-button" href="%www%/client?createRoom=0"
                                   target="uberClientWnd" onClick="return RoomSelectionHabblet.create(this, 0);"><b>Selecionar</b><i></i></a>
                            </li>
                            <li class="even">
                                <a class="roomselection-select new-button" href="%www%/client?createRoom=1"
                                   target="uberClientWnd" onClick="return RoomSelectionHabblet.create(this, 1);"><b>Selecionar</b><i></i></a>
                            </li>
                            <li class="odd">
                                <a class="roomselection-select new-button" href="%www%/client?createRoom=2"
                                   target="uberClientWnd" onClick="return RoomSelectionHabblet.create(this, 2);"><b>Selecionar</b><i></i></a>
                            </li>
                            <li class="even">
                                <a class="roomselection-select new-button" href="%www%/client?createRoom=3"
                                   target="uberClientWnd" onClick="return RoomSelectionHabblet.create(this, 3);"><b>Selecionar</b><i></i></a>
                            </li>
                            <li class="odd">
                                <a class="roomselection-select new-button" href="%www%/client?createRoom=4"
                                   target="uberClientWnd" onClick="return RoomSelectionHabblet.create(this, 4);"><b>Selecionar</b><i></i></a>
                            </li>
                            <li class="even">
                                <a class="roomselection-select new-button" href="%www%/client?createRoom=5"
                                   target="uberClientWnd" onClick="return RoomSelectionHabblet.create(this, 5);"><b>Selecionar</b><i></i></a>
                            </li>
                        </ul>


                    </div>
                </div>
                <script type="text/javascript">if (!$(document.body).hasClassName('process-template')) {
                        Rounder.init();
                    }</script>


            </div>
            <div id="column2" class="column">

                <div class="habblet-container " id="welcome-partner">

                    <div class="cbb clearfix lightgreen">

                        <div class="welcome-intro clearfix">
                            <img alt="%habboName%"
                                 src="%www%/habbo-imaging/avatarimage.php?figure=%habboLook%&direction=3&head_direction=3"
                                 width="64" height="110" class="welcome-habbo"/>
                            <div id="welcome-intro-welcome-user">
                                Bem-vindo %habboName%!
                            </div>
                            <div id="welcome-intro-welcome-party" class="box-content">
                                Agora, selecione um quarto, caso tenha alguma dúvida peça ajuda a um MOD ou chame um BOT
                                Guía.
                            </div>
                        </div>

                    </div>


                </div>
                <script type="text/javascript">if (!$(document.body).hasClassName('process-template')) {
                        Rounder.init();
                    }</script>


                <div class="habblet-container ">


                </div>
                <script type="text/javascript">if (!$(document.body).hasClassName('process-template')) {
                        Rounder.init();
                    }</script>


                <div class="habblet-container ">


                </div>
                <script type="text/javascript">if (!$(document.body).hasClassName('process-template')) {
                        Rounder.init();
                    }</script>


                <div class="habblet-container ">
                    <div class="cbb clearfix green ">

                        <h2 class="title">Adobe Flash
                        </h2>
                        <div class="welcome-flash clearfix box-content">
                            <div id="welcome-flash-text">Em alguns casos, é necessário que instale o Adobe Flash Player
                                em seu computador para poder acessar ao %site_name%.
                            </div>
                            <div id="welcome-flash-logo"><img src="%www%/web-gallery/v2/images/welcome/inst_flash.gif"
                                                              alt="flash"/></div>
                        </div>


                    </div>
                </div>
                <script type="text/javascript">if (!$(document.body).hasClassName('process-template')) {
                        Rounder.init();
                    }</script>


            </div>
            <script type="text/javascript">
                HabboView.run();
            </script>
            <div id="column3" class="column">

                <div class="habblet-container ">

                    <div class="ad-container">
                        <br>
                    </div>


                </div>
                <script type="text/javascript">if (!$(document.body).hasClassName('process-template')) {
                        Rounder.init();
                    }</script>


            </div>
            <!--[if lt IE 7]>
            <script type="text/javascript">
                Pngfix.doPngImageFix();
            </script>
            <![endif]-->
        </div>