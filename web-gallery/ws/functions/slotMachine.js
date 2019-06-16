/* jshint node: true */


function OpenSlot() {
    var left = (($(window).width() / 2) - (350 / 2));
    var top = (($(window).height() / 2) - (250 / 2));
    $("#client").append("<div id='ws-slot' class='ui-draggable ui-draggable-handle' onClick='makeZIndex(\"slot\")' style='left: " + left + "px;top: " + top + "px;'></div>");

    $("#ws-slot").load("/ws/slot/open").draggable({containment: '#client'});
}

function SpinMachine(spinData) {
    if (spinData <= 3) {
        $("#defaultAudio").play();
        var spinDiv = $('#slotspin' + spinData);
        spinDiv.attr('loop', 'loop');
        spinDiv.show();
    }
    var spin = $('#spin4');
    spin.play();
    spin.attr('loop', 'loop');
    $('#slottitle').text('GIRANDO...');
}

//values = array
function ShowResult(spinData, values) {

    var spinAreas = [$('#spin1_pic1'), $('#spin1_pic2'), $('#spin1_pic3'), $('#spin2_pic1'), $('#spin2_pic2'), $('#spin2_pic3'), $('#spin3_pic1'), $('#spin3_pic2'), $('#spin3_pic3')];

    if (spinData == 1) {
        if (values[0] == "100") {
            spinAreas[0].css('top', 85);
            spinAreas[0].css('left', 180);
        }
        else if (values[0] == "20") {
            spinAreas[0].css('top', 85);
            spinAreas[0].css('left', 185);
        }
        else if (values[0] == "50") {
            spinAreas[0].css('top', 97);
            spinAreas[0].css('left', 180);
        }
        else if (values[0] == "10" || values[0] == "5" || values[0] == "1") //
        {
            spinAreas[0].css('top', 100);
            spinAreas[0].css('left', 195);
        }
        if (values[1] == "20") {
            spinAreas[1].css('top', 185);
            spinAreas[1].css('left', 185);
        }
        else if (values[1] == "100") {
            spinAreas[1].css('top', 185);
            spinAreas[1].css('left', 180);
        }
        else if (values[1] == "50") {
            spinAreas[1].css('top', 195);
            spinAreas[1].css('left', 180);
        }
        else if (values[1] == "10" || values[1] == "5" || values[1] == "1") //
        {
            spinAreas[1].css('top', 200);
            spinAreas[1].css('left', 195);
        }
        if (values[2] == "20") {
            spinAreas[2].css('top', 280);
            spinAreas[2].css('left', 185);
        }
        else if (values[2] == "100") {
            spinAreas[2].css('top', 280);
            spinAreas[2].css('left', 180);
        }
        else if (values[2] == "50") {
            spinAreas[2].css('top', 290);
            spinAreas[2].css('left', 180);
        }
        else if (values[2] == "10" || values[2] == "5" || values[2] == "1") //
        {
            spinAreas[2].css('top', 295);
            spinAreas[2].css('left', 195);
        }
        spinAreas[0].css('content', 'url(http://habborp.com.br/app/tpl/skins/Byxhp/ws/' + values[0] + '.png)');
        spinAreas[1].css('content', 'url(http://habborp.com.br/app/tpl/skins/Byxhp/ws/' + values[1] + '.png)');
        spinAreas[2].css('content', 'url(http://habborp.com.br/app/tpl/skins/Byxhp/ws/' + values[2] + '.png)');
        $('#slotspin1').hide();
        spin1.pause();
    }
    else if (spinData == 2) {
        if (values[3] == "100") {
            spinAreas[3].css('top', 85);
            spinAreas[3].css('left', 360);
        }
        else if (values[3] == "20") {
            spinAreas[3].css('top', 85);
            spinAreas[3].css('left', 365);
        }
        else if (values[3] == "50") {
            spinAreas[3].css('top', 97);
            spinAreas[3].css('left', 360);
        }
        else if (values[3] == "10" || values[3] == "5" || values[3] == "1") //
        {
            spinAreas[3].css('top', 100);
            spinAreas[3].css('left', 375);
        }
        if (values[4] == "20") {
            spinAreas[4].css('top', 185);
            spinAreas[4].css('left', 365);
        }
        else if (values[4] == "100") {
            spinAreas[4].css('top', 185);
            spinAreas[4].css('left', 360);
            console.log('olá');
        }
        else if (values[4] == "50") {
            spinAreas[4].css('top', 195);
            spinAreas[4].css('left', 360);
        }
        else if (values[4] == "10" || values[4] == "5" || values[4] == "1") //
        {
            spinAreas[4].css('top', 200);
            spinAreas[4].css('left', 375);
        }
        if (values[5] == "20") {
            spinAreas[5].css('top', 280);
            spinAreas[5].css('left', 365);
        }
        else if (values[5] == "100") {
            spinAreas[5].css('top', 280);
            spinAreas[5].css('left', 360);
            console.log('olá');
        }
        else if (values[5] == "50") {
            spinAreas[5].css('top', 290);
            spinAreas[5].css('left', 360);
        }
        else if (values[5] == "10" || values[5] == "5" || values[5] == "1") //
        {
            spinAreas[5].css('top', 295);
            spinAreas[5].css('left', 375);
        }
        spinAreas[3].css('content', 'url(http://habborp.com.br/app/tpl/skins/Byxhp/ws/' + values[3] + '.png)');
        spinAreas[4].css('content', 'url(http://habborp.com.br/app/tpl/skins/Byxhp/ws/' + values[4] + '.png)');
        spinAreas[5].css('content', 'url(http://habborp.com.br/app/tpl/skins/Byxhp/ws/' + values[5] + '.png)');
        $('#slotspin2').hide();
        spin2.pause();
    }
    else if (spinData == 3) {
        if (values[6] == "100") {
            spinAreas[6].css('top', 85);
            spinAreas[6].css('left', 540);
        }
        else if (values[6] == "20") {
            spinAreas[6].css('top', 85);
            spinAreas[6].css('left', 545);
        }
        else if (values[6] == "50") {
            spinAreas[6].css('top', 97);
            spinAreas[6].css('left', 540);
        }
        else if (values[6] == "10" || values[6] == "5" || values[6] == "1") //
        {
            spinAreas[6].css('top', 100);
            spinAreas[6].css('left', 555);
        }
        else if (values[7] == "20") {
            spinAreas[7].css('top', 185);
            spinAreas[7].css('left', 545);
        }
        else if (values[7] == "100") {
            spinAreas[7].css('top', 185);
            spinAreas[7].css('left', 540);
        }
        else if (values[7] == "50") {
            spinAreas[7].css('top', 195);
            spinAreas[7].css('left', 540);
        }
        else if (values[7] == "10" || values[7] == "5" || values[7] == "1") //
        {
            spinAreas[7].css('top', 200);
            spinAreas[7].css('left', 555);
        }

        if (values[8] == "20") {
            spinAreas[8].css('top', 280);
            spinAreas[8].css('left', 545);
        }
        else if (values[8] == "100") {
            spinAreas[8].css('top', 280);
            spinAreas[8].css('left', 540);
            console.log('olá');
        }
        else if (values[8] == "50") {
            spinAreas[8].css('top', 290);
            spinAreas[8].css('left', 540);
        }
        if (values[8] == "10" || values[8] == "5" || values[8] == "1") //
        {
            spinAreas[8].css('top', 295);
            spinAreas[8].css('left', 555);
        }
        spinAreas[6].css('content', 'url(http://habborp.com.br/app/tpl/skins/Byxhp/ws/' + values[6] + '.png)');
        spinAreas[7].css('content', 'url(http://habborp.com.br/app/tpl/skins/Byxhp/ws/' + values[7] + '.png)');
        spinAreas[8].css('content', 'url(http://habborp.com.br/app/tpl/skins/Byxhp/ws/' + values[8] + '.png)');
        $('#slotspin3').hide();
        spin3.pause();
        spin4.pause();
        if (user.win == '1') {
            spin6.play();
            $('#slottitle').text('JACKPOT!!');
        } else {
            $('#slottitle').text('Boa sorte da próxima vez!');
        }
    }
    spin5.play();
}