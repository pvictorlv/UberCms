/* jshint node: true */


function openRoomVideo(url) {
    closeWindow('video');
    var client = $("#client");
    var left = (($(window).width() / 2) - (350 / 2));
    var top = (($(window).height() / 2) - (250 / 2));
    client.append("<div id='ws-video' class='illumina-box center ui-draggable ui-draggable-handle' onClick='makeZIndex(\"video\")' style='left: " + left + "px;top: " + top + "px;'></div>");

    $("#ws-video").load("/data/openVideo?id=" + url).draggable({containment: '#client'});
}

function openTraxMachine() {
    closeWindow('trax');
    var left = (($(window).width() / 2) - (350 / 2));
    var top = (($(window).height() / 2) - (250 / 2));
    $("#client-ui").append("<div id='ws-trax' class='ui-draggable' onClick='makeZIndex(\"trax\")' style='left: " + left + "px;top: " + top + "px;width: 590px;height: 333px;'></div>");
    $("#ws-trax").load("/trax/trax.php").draggable({containment: '#client-ui'});

}


function openStack(itemid, hoehe) {
    closeWindow('stack');
    var left = (($(window).width() / 2) - (350 / 2));
    var top = (($(window).height() / 2) - (250 / 2));
    $("#client-ui").append("<div id='ws-stack' class='alert' onClick='makeZIndex(\"stack\")' style='left: " + left + "px;top: " + top + "px;width: 355px;height: 199px'></div>");
    $("#ws-stack").load("<?php echo WWW; ?>/stacktile.php?itemid=" + itemid + "&hoehe=" + hoehe).draggable({containment: '#client-ui'});

}

function openCabboRacer() {
    closeWindow('cabbo');

    var left = (($(window).width() / 2) - (350 / 2));
    var top = (($(window).height() / 2) - (250 / 2));
    $("#client-ui").append("<div id='ws-cabbo' class='alert' onClick='makeZIndex(\"cabbo\")' style='left: " + left + "px;top: " + top + "px;width: 350px;height: 250px'></div>");
    $("#ws-cabbo").load("/slot5/index.php").draggable({containment: '#client-ui'});
    $("#testww").draggable({containment: '#client-ui'});
    $("#testww").show();


}
