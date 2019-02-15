<?php
include "../global.php";
?>
<script>
    function send(value) {
        ws.send(value);
    }
</script>
<script type="text/javascript" src="<?php echo WWW ?>/slot5/slots.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo WWW ?>/slot5/slots.css"/>


<div id="wrap">

    <div id="game">
        <canvas id="slots" width="185" height="160"></canvas>
        <br/>
        <p id="credits"></p>

        <div id="align">
            <button type="button" onclick="spin(1);" class="button">1 &nbsp;Linha&nbsp;</button>
            <button type="button" onclick="spin(3);" class="button">3 Linhas</button>
            <button type="button" onclick="spin(5);" class="button">5 Linhas</button>
        </div>
        <p id="log" style="display: none"></p>
    </div>
</div>

<script type="text/javascript">
    init();
</script>