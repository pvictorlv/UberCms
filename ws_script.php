<?php
define('PAGE_ID', 3);
include __DIR__ . '/global.php';
header('Content-Type:application/javascript');
?>
    var u_credits = '0';
    var zindex = '9999999';
    $(document).ready(function (e) {
        setTimeout(function () {
            startWebsockets();
        }, 2000);
    });
    function startWebsockets() {
        window.ws = new WebSocket('ws://127.0.0.1:8083/');
        ws.onopen = function (event) {
            console.log('Websocket open');
            ws.send("1|<?php echo $users->GetUserVar(USER_ID, 'auth_ticket') ?>");
            console.log('SSO sent to the socket server');
        };
        ws.onclose = function (event) {
            console.log('Websocket CLOSED: ', event);
            ws.close();
        };
        ws.onmessage = function (event) {
            msg = event.data;
            console.log('Socket: ' + msg);
            var packet = msg.split('|');
            switch (packet[0]) {
                case'2':
                    openTraxMachine();
                    break;
                case '3':
                    var itemid = packet[1];
                    var hoehe = packet[2];
                    openStapelFelder(itemid, hoehe);
                    break;
                case '4':
                    openCabboRacer();
                    break;
                case '5':
                    u_credits = packet[1];
                break;
            }
        };
        ws.onerror = function (event) {
            console.log('Websocket ERROR:', event);
        };
    }
    function openStapelFelder(itemid, hoehe) {
        if ($("#Fenster-Stapelfelder").size()) {
            $("#Fenster-Stapelfelder").remove();
        } else {
            var left = (($(window).width() / 2) - (350 / 2));
            var top = (($(window).height() / 2) - (250 / 2));
            $("#client-ui").append("<div id='Fenster-Stapelfelder' class='alert' onClick='makezindex(\"Stapelfelder\")' style='left: " + left + "px;top: " + top + "px;width: 355px;height: 199px'></div>");
            $("#Fenster-Stapelfelder").load("<?php echo WWW; ?>/stacktile.php?itemid=" + itemid + "&hoehe=" + hoehe).draggable({containment: '#client-ui'});
        }
    }
    function makezindex(fenster) {
        if ($("#ws-" + fenster).size()) {
            zindex++;
            $("#ws-" + fenster).css('z-index', zindex);
        }
    }
    function openTraxMachine() {
        if ($("#ws-trax").size()) {
            $("#ws-trax").remove();
        } else {
            var left = (($(window).width() / 2) - (350 / 2));
            var top = (($(window).height() / 2) - (250 / 2));
            $("#client-ui").append("<div id='ws-trax' class='ui-draggable' onClick='makezindex(\"trax\")' style='left: " + left + "px;top: " + top + "px;width: 590px;height: 333px;'></div>");
            $("#ws-trax").load("<?php echo WWW ?>/trax/trax.php").draggable({containment: '#client-ui'});
        }
    }
    function openCabboRacer() {
        if ($("#ws-cabbo").size()) {
            $("#ws-cabbo").remove();
        } else {
            var left = (($(window).width() / 2) - (350 / 2));
            var top = (($(window).height() / 2) - (250 / 2));
            $("#client-ui").append("<div id='ws-cabbo' class='alert' onClick='makezindex(\"cabbo\")' style='left: " + left + "px;top: " + top + "px;width: 350px;height: 250px'></div>");
            $("#ws-cabbo").load("<?php echo WWW; ?>/slot5/index.php").draggable({containment: '#client-ui'});
$("#testww").draggable({containment: '#client-ui'});
$("#testww").show();

        }
    }
    $(window).unload(function () {
        console.log("WS CLOSED BY WINDOW CLOSING");
        ws.close();
    });
