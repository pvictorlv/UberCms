<?php
require_once('../global.php');
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript">
    var import_php = {
        spieler_aussehen: '<?php echo $users->GetUserVar(USER_ID, "look"); ?>'
    };
</script>
<script src="<?php echo WWW ?>/cabbo_racing/medien/js/spiel.js?<?php echo time(); ?>"></script>
<link href="http://fonts.googleapis.com/css?family=Ubuntu:400,700" rel="stylesheet" type="text/css">
<link href="<?php echo WWW ?>/cabbo_racing/medien/css/spiel.css?<?php echo time(); ?>" rel="stylesheet"
      type="text/css">
<div id="laedt">
    <img src="<?php echo WWW ?>/web-gallery/v2/images/page_loader.gif" alt="Bild" title="Carregando.."/>
</div>

<div id="spiel">
    <canvas id="main_canvas" width="350" height="500">Infelizmente o seu navegador não é suportado.</canvas>
    <div id="hauptmenu">
        <button id="spielen">Jogar</button>
    </div>

    <div id="spielmenu">
        <div id="volume"></div>
        <div id="status">
            <div id="herz_box" class="box">
                <div class="icon"></div>
                <div class="icon"></div>
                <div class="icon"></div>
            </div>
            <div id="taler_box" class="box"><span id="anzahl">0</span>
                <div id="icon"></div>
            </div>
            <div id="zeit_box" class="box"><span id="zeit">0</span>
                <div id="icon"></div>
            </div>
        </div>
        <img id="pfeiltasten" src="/cabbo_racing/medien/grafik/pfeiltasten.png" width="150" height="100">
    </div>

    <div id="gameovermenu">
        <div style="text-align: center;">
            <div id="header">
                <p id="überschrift">Fim de jogo</p>
            </div>

            <div id="score">Sua pontuação: <span id="score_anzahl"></span></div>

            <button id="replay"><img src="/cabbo_racing/medien/grafik/replay.png" align="left"> Reiniciar</button>
            <button id="zurück">Voltar ao inicio</button>

            <div id="bild_untenlinks"></div>
            <div id="bild_untenrechts"></div>
        </div>
    </div>
</div>
</div>