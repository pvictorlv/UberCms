function SetSlot(weapon, slot) {
    if (weapon == null) return;
    var slotData = '#slot' + slot;
    if (weapon == 'bastao') {
        slotData.css('left', 8);
        slotData.css('top', 9);
    } else if (weapon == 'machado') {
        slotData.css('left', 13);
        slotData.css('top', 4);
    } else if (weapon == 'medieval') {
        slotData.css('left', 13);
        slotData.css('top', 8);
    } else if (weapon == 'taco') {
        slotData.css('left', 5);
        slotData.css('top', 4);
    } else if (weapon == 'espadavip') {
        slotData.css('left', 13);
        slotData.css('top', 8);
    } else if (weapon == 'machadovip') {
        slotData.css('left', 13);
        slotData.css('top', 4);
    } else if (weapon == 'katana') {
        slotData.css('left', 12);
        slotData.css('top', 2);
    } else if (weapon == 'magnum') {
        slotData.css('left', 12);
        slotData.css('top', 2);
    } else if (weapon == 'machadoverm') {
        slotData.css('left', 13);
        slotData.css('top', 4);
    } else if (weapon == 'vara') {
        slotData.css('left', 3);
        slotData.css('top', 3);
    } else if (weapon == 'stun') {
        slotData.css('left', 12);
        slotData.css('top', 16);
    } else if (weapon == 'colete') {
        slotData.css('left', 11);
        slotData.css('top', 7);
    } else if (weapon == 'medic') {
        slotData.css('left', 6);
        slotData.css('top', 9);
    } else if (weapon == 'snack') {
        slotData.css('left', 6);
        slotData.css('top', 5);
    } else if (weapon == 'semente') {
        slotData.css('left', 10);
        slotData.css('top', 12);
    } else if (weapon == 'salmao') {
        slotData.css('left', 2);
        slotData.css('top', 3);
    } else if (weapon == 'corda') {
        slotData.css('left', 2);
        slotData.css('top', 8);
    } else if (weapon == 'carrot') {
        slotData.css('left', 6);
        slotData.css('top', 14);
    } else if (weapon == 'flower') {
        slotData.css('left', 14);
        slotData.css('top', 8);
    } else if (weapon == 'maconha') {
        slotData.css('left', 2);
        slotData.css('top', 6);
    }

    slotData.css('content', 'url(http://habborp.com.br/app/tpl/skins/Byxhp/ws/' + weapon + '.png)');
    if (weapon == 'medic' || weapon == 'snack' || weapon == 'semente' || weapon == 'carrot' || weapon == 'flower' || weapon == 'maconha' || weapon == 'corda' || weapon == 'salmao') {
       var quantity = $('#quantity' + slot);
        quantity.text(user.quantity1);
        quantity.show();
    } else {
        $('#wh' + slot).css({
            height: (user.whp1) + '%'
        }, 200);
        $('#whp' + slot).show();
    }
}
function ChangeStats(data) {

    $('#hpbar_inner').css({
        width: ((user.health / user.maxhealth) * 100) + '%'
    }, 200);
    $('#engybar_inner').css({
        width: (user.energy) + '%'
    }, 200);
    $('#xpbar_inner').css({
        width: ((user.xp / user.xpdue) * 100) + '%'
    }, 200);
    $('#hpbar_text').text((user.health) + '/' + (user.maxhealth));
    $('#engybar_text').text((user.energy) + '/100');
    $('#level').text(user.level);
    $('#money').text('R$' + user.money);
    $('#mylook').css('content', 'url(' + look + user.look + '&direction=2&headonly=0)');
    $('#slide').fadeIn();
    $('#gangicon').fadeIn();
    $('#abrir-populares').fadeIn();
    //$('#mystats').fadeIn();
    $('#myname').fadeIn();
    $('#caixavip').fadeIn();
    $('#botao-configs').fadeIn();
    $('#foto-cidade').fadeIn();
    $('#botao-emojis').fadeIn();
    $('#weaponwindow').fadeIn();

    for (var i = 1; i <= 8; i++) {
        SetSlot(data["weapon" + i], i);
    }
}
