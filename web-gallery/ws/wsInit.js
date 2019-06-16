var zindex = 1000;

var ws = null;
var loggedIn = false;
var wsDebug = true;
var started = false;
var u_credits = '0';

function startWebSockets() {
    if (wsDebug) {
        console.log('Started WS');
    }
    if (started) return;

    started = true;
    try {
        ws = new WebSocket('ws://127.0.0.1:8083/');
        ws.onopen = function () {
            setTimeout(function () {
                var tryLogin = setInterval(function () {
                    if (loggedIn) {
                        clearInterval(tryLogin);
                        return;
                    }
                    Send("1|" + flashvars["sso.ticket"]);
                }, 3000);
            }, 3000);

        };
    } catch (e) {
        started = false;
        return;
    }

    ws.onclose = function (event) {
        if (wsDebug) {
            console.log('Websocket CLOSED: ', event);
        }
        ws.close();
    };
    ws.onmessage = function (event) {
        var msg = event.data;
        if (wsDebug) {
            console.log('Socket: ' + msg);
        }
        var arr = msg.split('|');
        switch (arr[0]) {
            case'1':
                loggedIn = true;
                break;
            case'2':
                openTraxMachine();
                break;
            case '3':
                var itemid = arr[1];
                var hoehe = arr[2];
                openStack(itemid, hoehe);
                break;
            case '4':
                openCabboRacer();
                break;
            case '5':
                u_credits = arr[1];
                break;
            case '6':
                openRoomVideo(arr[1]);
                break;
        }
    };
    ws.onerror = function (event) {
        if (wsDebug) {
            console.log('Websocket ERROR:', event);
        }
    };
}

function Send(msg) {
    if (ws.readyState !== WebSocket.OPEN) {
        return;
    }
    if (wsDebug) {
        console.log(msg);
    }
    ws.send(msg);
}

function makeZIndex(fenster) {
    var div = $("#ws-" + fenster);
    if (div.length > 0) {
        zindex++;
        div.css('z-index', zindex);
    }
}

function closeWindow(id) {
    var toRemove = $("#ws-" + id);
    if (toRemove.length > 0) {
        toRemove.remove();
    }
}


