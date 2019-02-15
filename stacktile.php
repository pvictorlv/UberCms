<?php
include 'global.php';
if (!LOGGED_IN) {
    exit;
}

$hoehe = filter($_GET['hoehe']);
$itemid = filter($_GET['itemid']);

$hoehe = str_replace(',', '.', $hoehe);
?>

<style>
    #Fenster-Stapelfelder {
        color: #000;
        background: url("<?php echo WWW ?>/images/stacktile/box.png");
    }
    .alertt {
        margin-top: 5px;
        margin-left: 5px;
        width: 430px;
        padding: 5px;
        height: 20px;
        line-height: 20px;
        border-radius: 3px;
        color: #FFF;
        display: none;
    }

    .alertt.success {
        background: #2AA12C;
        border: 0px;
        border-bottom: 2px solid #218123;
    }

    .alertt.error {
        background: #B62B1C;
        border: 0px;
        border-bottom: 2px solid #912216;
    }

    #slider {
        width: 200px;
        margin-left: 15px;
        height: 30px;
        float: left;
    }

    #slider a {
        height: 28px;
        margin-top: 4px;

    }

    .head {
        height: 20px;
        line-height: 20px;
        text-align: center;
        font-size: 14px;
        font-weight: 700;
        color: #000;
    }

    .alert {
        position: absolute;
        left: 50%;
        right: -50%;
        top: 50%;
        bottom: -50%;
        font-size: 13px;
        width: 200px;
        height: 100px;
        font-family: Ubuntu;
        font-weight: lighter;
        background: #FFF;
    }

    .imagee .close {
        position: absolute;
        background: url('https://holohotel.ws/public/images/client/box/close.png') no-repeat 50% 50%;
        width: 19px;
        height: 20px;
        cursor: pointer;
        margin-top: 5px;
        margin-left: 5px;
    }

    .alert .head .close {
        background: url("<?php echo WWW ?>/images/stacktile/close_button.png");
        float: right;
        width: 17px;
        height: 18px;
        cursor: pointer;
        margin-top: 6px;
        margin-right: 6px;
    }

    .alert .head .close:hover {
        background-position-y: -16px;
        cursor: hand;
    }

    .alert .head .close:active {
        background-position-y: -16px;
    }

    .ui-slider {
        background: url("<?php echo WWW ?>/images/stacktile/line.png") !important;
        height: 6px !important;
        width: 206px !important;
        border: 0 !important;
        margin-top: 15px !important;
        margin-left: 35px !important;
    }

    .ui-slider-handle {
        background: url("<?php echo WWW ?>/images/stacktile/handler.png") !important;
        height: 19px !important;
        width: 15px !important;
        border: 0 !important;
        margin-top: -2px !important;
    }

    .info1 {
        background: url("<?php echo WWW ?>/images/stacktile/info1.png");
        height: 35px;
        width: 266px;
        border: 0;
        margin-top: 25px;
        margin-left: 20px;
    }

    .info3 {
        background: url("<?php echo WWW ?>/images/stacktile/info3.png");

        height: 13px;
        width: 125px;
        border: 0;
        margin-top: 25px;
        margin-left: 35px;
    }

    .info2 {
        background: url("<?php echo WWW ?>/images/stacktile/info2.png");
        height: 35px;
        width: 266px;
        border: 0;
        margin-top: 25px;
        margin-left: 20px;
    }
</style>
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<div class="head">
    <div class="close" onclick="$('#Fenster-Stapelfelder').remove()"></div>
</div>
<div class="banner"></div>

<div class="alertt success"></div>
<div class="alertt error"></div>

<div class="text">
    <div class="info1"></div>
    <div class="info3"></div>
    <div id="slider"></div>
    <input type="text" id="count" onkeyup="changeValue(this.value)" value="<?php echo $hoehe; ?>"
           style="margin-left: 8px; margin-top: 8px;text-align: center;float: left;height: 20px;border: 1px solid #000;border-radius: 3px;width: 32px;">
</div>

<script>
    $("#slider").slider({
        value: <?php echo $hoehe; ?>,
        max: 40,
        step: 0.1
    }).on("slide", function (event, ui) {
        $("#count").val(ui.value);
        ws.send("2|<?php echo $itemid; ?>|" + ui.value);

    });

    function changeValue(value) {
        var vvalue = value;
        if (vvalue < 41) {
            $("#slider").slider({
                value: vvalue
            });
            ws.send("2|<?php echo $itemid; ?>|" + vvalue);
        } else {
            $("#count").val('40');
        }
    }

</script>
