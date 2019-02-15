<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
include "../global.php";

?>
<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="<?php echo WWW?>/trax/css/layout.css?<?php echo time()?>"/>
</head>
<body>
<div id="editor-placeholder">
    <div id="editor-title">Sound Machine Editor</div>
    <div id="close-button" onclick='$("#ws-trax").zindex = -100; $("#ws-trax").remove();'></div>
    <div id="chips-placeholder">
        <div class="chip-placeholder" data-chip-id="-1"></div>
        <div class="chip-placeholder" data-chip-id="-1"></div>
        <div class="chip-placeholder" data-chip-id="-1"></div>
    </div>
    <div id="chips-controller">
        <div id="chips-controller-backward"></div>
        <div id="chips-controller-minpage">1</div>
        <div id="chips-controller-dividerpage">/</div>
        <div id="chips-controller-maxpage">1</div>
        <div id="chips-controller-forward"></div>
    </div>
    <div id="chips-equipped-placeholder">
        <div id="chips-equipped-line"></div>
        <div class="chips-equipped-placeholder" data-equipped-chip-id="-1">
            <div class="chips-equipped-title"></div>
            <div class="chips-equipped-body">

            </div>
        </div>
        <div class="chips-equipped-placeholder" data-equipped-chip-id="-1">
            <div class="chips-equipped-title"></div>
            <div class="chips-equipped-body"></div>
        </div>
        <div class="chips-equipped-placeholder" data-equipped-chip-id="-1">
            <div class="chips-equipped-title"></div>
            <div class="chips-equipped-body"></div>
        </div>
        <div class="chips-equipped-placeholder" data-equipped-chip-id="-1">
            <div class="chips-equipped-title"></div>
            <div class="chips-equipped-body"></div>
        </div>
    </div>
    <div id="designer-placeholder" class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" aria-disabled="false">
        <div id="designer-row-label"></div>
        <div id="designer-wrapper">
            <div id="designer-pointer" class="ui-slider-handle ui-state-default ui-corner-all"></div>
            <div class="designer-wrapper-row" data-row-id="1"></div>
            <div class="designer-wrapper-row" data-row-id="2"></div>
            <div class="designer-wrapper-row" data-row-id="3"></div>
            <div class="designer-wrapper-row" data-row-id="4"></div>
        </div>
    </div>
    <div id="controls-wrapper">
        <div id="controls-music-button"></div>
        <div id="controls-save-button"></div>
        <div id="controls-next-button"></div>
    </div>
</div>
<script type="text/javascript" src="<?php echo WWW?>/trax/js/SoundMachine.js?47"></script>
</body>
</html>