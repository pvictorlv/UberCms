var w = window;

var button = {
    width: false,
    height: false,
    font_size: false,
};

requestAnimationFrame = w.requestAnimationFrame || w.webkitRequestAnimationFrame || w.msRequestAnimationFrame || w.mozRequestAnimationFrame;

function zufall(min, max) {
    return Math.floor((Math.random() * (max - min)) + min);
}

$(document).ready(function () {
    $('button#spielen').hover(function () {
        $(this).stop().animate({
            'width': '154px',
            'height': '44px',
            'margin': '-22px 0 0 -77px',
            'font-size': '1.705em'
        }, 100);
    }, function () {
        $(this).stop().animate({
            'width': '140px',
            'height': '40px',
            'margin': '-20px 0 0 -70px',
            'font-size': '1.55em'
        }, 100);
    });

    $('#gameovermenu button').hover(function () {
        button.width = $(this).outerWidth();
        button.height = $(this).outerHeight();
        button.font_size = parseFloat($(this).css('font-size'));

        $(this).stop().animate({
            'width': button.width * 1.05,
            'height': button.height * 1.05,
            'font-size': button.font_size * 1.05
        }, 100);
    }, function () {
        $(this).stop().animate({'width': button.width, 'height': button.height, 'font-size': button.font_size}, 100);
    });

    $('#spielmenu #volume').click(function () {
        $(this).fadeOut(250, function () {
            if (spieler.einstellungen['volume'] == 1) {
                spieler.einstellung_ändern('Volume', 'aus');
                $(this).addClass('aus');
            } else {
                spieler.einstellung_ändern('Volume', 'an');
                $(this).removeClass('aus');
            }

            $(this).fadeIn(250, function () {
                spieler.einstellungen['volume'] = (spieler.einstellungen['volume'] == 1) ? 0 : 1;
            });
        });
    });


    $('#gameovermenu button#zurück').click(function () {
        spiel.menu_wechseln('hauptmenu');
    });

    $('button#spielen, #gameovermenu button#replay').click(function () {
        spiel.menu_wechseln('spiel');
    });
});

var spieler = {
    x: 151,
    y: 420,
    map_x: 151,
    map_y: 204,
    speed: 2,
    richtung: false,
    leben: 3,
    taler: 0,
    //aussehen: 'hr-3163-61.lg-3116-110-1408.ch-3222-1408.cc-3007-110-110.hd-209-1359', // Voltus
    aussehen: import_php.spieler_aussehen,
    bild_daten: [],
    einstellungen: {
        volume: 1
    },

    einstellung_ändern: function (einstellung, wert) {
        switch (einstellung) {
            case 'Volume':
                for (var i in spiel.musik) {
                    spiel.musik[i].volume = (wert == 'an') ? 1 : 0;
                }
                break;
        }
    },

    zeichnen: function () {
        switch (this.richtung) {
            case 'hinten':
                this.bild_daten = [10, -25, spieler.x + 2, spieler.y - 65];
                break;

            case 'vorne':
                this.bild_daten = [10, -25, spieler.x + 2, spieler.y - 75];
                break;

            case 'links':
                this.bild_daten = [10, -25, spieler.x + 7, spieler.y - 67];
                break;

            case 'rechts':
                this.bild_daten = [10, -25, spieler.x + 5, spieler.y - 67];
                break;

            case 'hintenlinks':
            case 'hintenrechts':
                this.bild_daten = [10, -25, spieler.x + 5, spieler.y - 65];
                break;

            case 'vornelinks':
                this.bild_daten = [10, -15, spieler.x + 12, spieler.y - 65];
                break;

            case 'vornerechts':
                this.bild_daten = [10, -15, spieler.x + 0, spieler.y - 65];
                break;
        }

        spiel.bild_zeichnen('avatar-' + this.richtung, this.bild_daten[0], this.bild_daten[1], 100, 100, this.bild_daten[2], this.bild_daten[3]);
    }
};

var map = {
    x: 0,
    y: 204,
    speed: 2
};

var level = {
    grenzen: [4000, 9000, 17000, 27000],
    aktuell: 0,
    fortschritt: {
        aktuell: 0,
        zumLevelUp: 0,
        map_y: 0
    },

    fortschritt_update: function () {
        if (this.fortschritt.aktuell >= 121) {
            if (this.aktuell < this.grenzen.length) {
                this.update();
            }
        } else {
            this.fortschritt.zumLevelUp = this.grenzen[this.aktuell - 1];
            this.fortschritt.map_y = map.y - 204;

            if (this.aktuell > 1) {
                for (var i in this.grenzen) {
                    if (this.grenzen[this.aktuell - 1] > this.grenzen[i]) {
                        this.fortschritt.map_y -= this.grenzen[i];
                    }
                }
            }

            this.fortschritt.aktuell = (this.fortschritt.map_y / this.fortschritt.zumLevelUp) * 121;
        }
    },

    animation: function () {
        $('canvas#main_canvas').before('<div id="blackscreen"></div>');
        $('#blackscreen').animate({'opacity': '1'}, 250, function () {
            level.aktuell += 1;
            level.fortschritt.aktuell = 0;

            for (var i in objekte.objekte) {
                for (var i2 in objekte.objekte[i]) {
                    objekte.objekte[i][i2] = '';
                }
            }

            for (var i in animation.animationen) {
                for (var i2 in animation.animationen[i]) {
                    animation.animationen[i][i2] = '';
                }
            }

            window.setTimeout(function () {
                $('#blackscreen').animate({'opacity': '0'}, 250, function () {
                    $(this).remove();
                    level.fortschritt.aktuell = 0;
                    spiel.lvl_beendet = 0;
                    $('#spielmenu').append('<div id="lvl_up" style="left: -90px">Level ' + (level.aktuell) + ' erreicht!</div>');
                    $('#lvl_up').animate({'opacity': '1', 'left': 0}, 250, function () {
                        window.setTimeout(function () {
                            $('#lvl_up').animate({'opacity': '0', 'left': '90px'}, 250, function () {
                                $(this).remove();

                            });
                        }, 2000);
                    });
                });
            }, 250);
        });
    },

    update: function () {
        this.animation();
        spiel.lvl_beendet = 1;
    }
};

var animation = {
    animationen: {
        explosionen: []
    },
    bereits: false,
    zahl: 0,

    berechneInterval: function (i, i2) {
        this.zahl = 0;

        for (var index in this.animationen[i][i2]['intervals']) {
            if (index <= this.animationen[i][i2]['frame'] - 1) {
                this.zahl += this.animationen[i][i2]['intervals'][index];
            }
        }

        return this.zahl;
    },

    zeichnen: function () {
        for (var i in this.animationen) {
            for (var i2 in this.animationen[i]) {
                if (Date.now() - this.animationen[i][i2]['timestamp'] >= this.berechneInterval(i, i2)) {
                    if (this.animationen[i][i2]['frame'] >= this.animationen[i][i2]['intervals'].length) {
                        this.animationen[i][i2] = '';
                    } else {
                        this.animationen[i][i2]['frame'] += 1;
                    }
                }

                if (this.animationen[i][i2]) {
                    spiel.bild_zeichnen(i, this.animationen[i][i2]['maße'][this.animationen[i][i2]['frame'] - 1][0], this.animationen[i][i2]['maße'][this.animationen[i][i2]['frame'] - 1][1], this.animationen[i][i2]['maße'][this.animationen[i][i2]['frame'] - 1][2], this.animationen[i][i2]['maße'][this.animationen[i][i2]['frame'] - 1][3], this.animationen[i][i2]['X'] - this.animationen[i][i2]['maße'][this.animationen[i][i2]['frame'] - 1][2] / 2 + 24, (map.y - this.animationen[i][i2]['Y']) - this.animationen[i][i2]['maße'][this.animationen[i][i2]['frame'] - 1][3] / 2 + 20);
                }
            }
        }
    }
};

var objekte = {
    objekte: {
        taler: [],
        steine: [],
        herzen: [],
    },

    kollision: function (objekt, x, y) {
        switch (objekt) {
            case 'taler':
                spieler.taler += 1;
                $('#taler_box span#anzahl').text(spieler.taler);
                spiel.musik('münze', 'abspielen');
                break;

            case 'steine':
                spieler.leben -= 1;

                if (spieler.leben == 0) {
                    spiel.gameover();
                } else {
                    animation.animationen['explosionen'].push({
                        'X': x,
                        'Y': y,
                        'maße': [[45, 30, 37, 39], [174, 19, 65, 62], [13, 133, 101, 84], [155, 133, 103, 83], [287, 135, 105, 80], [8, 245, 110, 98], [143, 235, 128, 117], [277, 249, 126, 92], [148, 374, 120, 72]],
                        'frame': 1,
                        'timestamp': Date.now(),
                        'intervals': [80, 80, 60, 60, 60, 60, 60, 50, 50]
                    });

                    $('#spielmenu #status #herz_box .icon:last-child').stop().fadeOut(250, function () {
                        $(this).remove();
                    });
                }

                spiel.musik('explosion', 'abspielen');
                break;

            case 'herzen':
                spieler.leben += 1;

                $('#spielmenu #status #herz_box').append('<div class="icon" style="display: none;"></div>');
                $('#spielmenu #status #herz_box .icon:last-child').fadeIn(250);
                spiel.musik('leben', 'abspielen');
                break;
        }
    },

    zeichnen: function () {
        for (var i in this.objekte) {
            for (var i2 in this.objekte[i]) {
                spiel.bild_zeichnen(i, Math.floor(objekte.objekte[i][i2].X), Math.floor(objekte.objekte[i][i2].Y + map.y));
            }
        }
    }
};

var spiel = {
    menu: false,
    bilder: {},
    bilder_geladen: 0,
    bilder_anzahl: 24,
    tasten: {},
    schleife: false,
    jetzt: false,
    dann: false,
    delta: false,
    pattern: false,
    zeit: 0,
    objekt_x: false,
    objekt_y: false,
    objekt_platzieren: false,
    objekt: false,
    musik: [],
    lvl_beendet: 0,

    init: function () {
        main_canvas = document.getElementById('main_canvas');
        main_ctx = main_canvas.getContext('2d');
        spiel.medien_laden();
    },

    musik: function (titel, befehl) {
        switch (befehl) {
            case 'abspielen':
                this.sound_laden(titel, false, (titel == 'bgm') ? 0.5 : 1);
                this.musik[titel].play();
                break;

            case 'stop':
                this.musik[titel].pause();
                break;
        }
    },

    bild_laden: function (name, link) {
        var img = new Image();
        img.src = link;

        img.onload = function () {
            spiel.bilder[name] = img;
            spiel.bilder[name].style.backgroundPosition = '1px 1px';
            spiel.bilder_geladen++;

            if (spiel.bilder_geladen == spiel.bilder_anzahl) {
                $('#laedt').fadeOut(250, function () {
                    $(this).remove();
                });
            }
        };
    },

    bilder_laden: function () {
        spiel.bild_laden('spielbg1', '/cabbo_racing/medien/grafik/spielbg1.png');
        spiel.bild_laden('spielbg2', '/cabbo_racing/medien/grafik/spielbg2.png');
        spiel.bild_laden('spielbg3', '/cabbo_racing/medien/grafik/spielbg3.png');
        spiel.bild_laden('spielbg4', '/cabbo_racing/medien/grafik/spielbg4.png');
        spiel.bild_laden('auto-hinten', '/cabbo_racing/medien/grafik/auto-hinten.png');
        spiel.bild_laden('auto-vorne', '/cabbo_racing/medien/grafik/auto-vorne.png');
        spiel.bild_laden('auto-links', '/cabbo_racing/medien/grafik/auto-links.png');
        spiel.bild_laden('auto-rechts', '/cabbo_racing/medien/grafik/auto-rechts.png');
        spiel.bild_laden('auto-vornelinks', '/cabbo_racing/medien/grafik/auto-vornelinks.png');
        spiel.bild_laden('auto-vornerechts', '/cabbo_racing/medien/grafik/auto-vornerechts.png');
        spiel.bild_laden('auto-hintenlinks', '/cabbo_racing/medien/grafik/auto-hintenlinks.png');
        spiel.bild_laden('auto-hintenrechts', '/cabbo_racing/medien/grafik/auto-hintenrechts.png');
        spiel.bild_laden('avatar-hinten', 'http://avatar-retro.com/habbo-imaging/avatarimage?figure=' + spieler.aussehen + '&direction=7&head_direction=7');
        spiel.bild_laden('avatar-hintenlinks', 'http://avatar-retro.com/habbo-imaging/avatarimage?figure=' + spieler.aussehen + '&direction=6&head_direction=6');
        spiel.bild_laden('avatar-links', 'http://avatar-retro.com/habbo-imaging/avatarimage?figure=' + spieler.aussehen + '&direction=5&head_direction=5');
        spiel.bild_laden('avatar-vornelinks', 'http://avatar-retro.com/habbo-imaging/avatarimage?figure=' + spieler.aussehen + '&direction=4&head_direction=4');
        spiel.bild_laden('avatar-vorne', 'http://avatar-retro.com/habbo-imaging/avatarimage?figure=' + spieler.aussehen + '&direction=3&head_direction=3');
        spiel.bild_laden('avatar-icon', 'http://avatar-retro.com/habbo-imaging/avatarimage?figure=' + spieler.aussehen + '&direction=3&head_direction=3&size=s');
        spiel.bild_laden('avatar-vornerechts', 'http://avatar-retro.com/habbo-imaging/avatarimage?figure=' + spieler.aussehen + '&direction=2&head_direction=2');
        spiel.bild_laden('avatar-rechts', 'http://avatar-retro.com/habbo-imaging/avatarimage?figure=' + spieler.aussehen + '&direction=1&head_direction=1');
        spiel.bild_laden('avatar-hintenrechts', 'http://avatar-retro.com/habbo-imaging/avatarimage?figure=' + spieler.aussehen + '&direction=0&head_direction=0');
        spiel.bild_laden('taler', '/cabbo_racing/medien/grafik/taler.png');
        spiel.bild_laden('steine', '/cabbo_racing/medien/grafik/stein.png');
        spiel.bild_laden('explosionen', '/cabbo_racing/medien/grafik/explosion.png');
        spiel.bild_laden('herzen', '/cabbo_racing/medien/grafik/herz.png');
    },

    sound_laden: function (name, schleife, volume) {
        this.musik[name] = new Audio('/cabbo_racing/medien/sound/' + name + '.mp3');
        this.musik[name].loop = schleife;
        this.musik[name].volume = spieler.einstellungen['volume'] * volume;
    },

    medien_laden: function () {
        this.bilder_laden();
    },

    render: function () {
    },

    richtung_bestimmen: function () {
        switch (true) {
            case(spiel.tasten['37'] == true && spieler.x > 5):
                spieler.y -= spieler.speed;
                spieler.x -= spieler.speed * 1.5;
                spieler.richtung = 'links';
                break;

            case(spiel.tasten['39'] == true && spieler.x < 287):
                spieler.y -= spieler.speed;
                spieler.x += spieler.speed * 1.5;
                spieler.richtung = 'rechts';
                break;

            default:
                spieler.y -= spieler.speed;
                spieler.richtung = 'hinten';
                break;
        }
    },

    update: function (modifier) {
        if (this.lvl_beendet == 1) {
            spieler.y -= spieler.speed;
            spieler.richtung = 'hinten';
            map.y += map.speed;
            spieler.y += map.speed;
            this.zeit += this.delta;
            $('#zeit_box span#zeit').text(Math.round(this.zeit / 1000));
            return true;
        }

        map.speed += 0.05 * modifier;
        map.y += map.speed;
        spieler.y += map.speed;
        spieler.speed += 0.05 * modifier;

        this.richtung_bestimmen();

        for (var i in objekte.objekte) {
            for (var i2 in objekte.objekte[i]) {
                if (i == null || i2 == null) continue;
                if ((objekte.objekte[i][i2]['Y'] * (-1)) < (map.y - 500)) {
                    objekte.objekte[i][i2] = '';
                }

                if (spieler.x < objekte.objekte[i][i2].X + spiel.bilder[i].width && spieler.x + spiel.bilder['auto-' + spieler.richtung].width > objekte.objekte[i][i2].X && (map.y - spieler.y) - 68 < (-1) * (objekte.objekte[i][i2].Y) + spiel.bilder[i].height / 4 && map.y - spieler.y > (-1) * (objekte.objekte[i][i2].Y + spiel.bilder[i].width)) {
                    objekte.kollision(i, objekte.objekte[i][i2].X, (-1) * objekte.objekte[i][i2].Y);
                    objekte.objekte[i][i2] = '';
                }
            }
        }

        if (zufall(1, Math.floor(200 / map.speed)) == Math.floor(100 / map.speed)) {
            this.objekt_platzieren = true;
            this.objekt_x = zufall(15, 335);
            this.objekt_y = (map.y + 100) * (-1);

            if (zufall(0, 100) <= 70) {
                this.objekt = 'Taler';
            } else if (spieler.leben < 3 && zufall(0, 100) <= 10) {
                this.objekt = 'Herzen';
            } else {
                this.objekt = 'Steine';
            }

            for (var i in objekte.objekte) {
                for (var i2 in objekte.objekte[i]) {

                }
            }

            if (this.objekt_platzieren != false) {
                objekte.objekte[this.objekt.toLowerCase()].push({'X': this.objekt_x, 'Y': this.objekt_y});
            }
        }

        if (spieler.y > 500) {
            this.gameover();
        }

        this.zeit += this.delta;
        $('#zeit_box span#zeit').text(Math.round(this.zeit / 1000));

        level.fortschritt_update();
    },

    main: function () {
        spiel.jetzt = Date.now();
        spiel.delta = spiel.jetzt - spiel.dann;

        spiel.update(spiel.delta / 1000);
        spiel.render();

        spiel.dann = spiel.jetzt;

        if (spiel.menu == 'spiel') {
            requestAnimationFrame(spiel.main);
        } else {
            spiel.gameover();
        }
    },

    bild_zeichnen: function (name, x, y, x_groesse, y_groesse, x_koordinate, y_koordinate) {
        if (arguments.length == 3) {
            main_ctx.drawImage(spiel.bilder[name], x, y);
        } else if (arguments.length == 7) {
            main_ctx.drawImage(spiel.bilder[name], x, y, x_groesse, y_groesse, x_koordinate, y_koordinate, x_groesse, y_groesse);
        }
    },

    menu_wechseln: function (menu) {
        $('#hauptmenu, #spielmenu, #gameovermenu').hide();

        switch (menu) {
            case 'spiel':
                spiel.restart();

                $("#spielmenu").fadeIn(1000);
                spiel.dann = Date.now();
                spiel.menu = 'spiel';
                spiel.main();

                setTimeout(function () {
                    $('img#pfeiltasten').fadeOut(500, function () {
                        $(this).remove();
                    });
                }, 2500);
                // ws.send('4');
                break;

            case 'hauptmenu':
                spiel.menu = 'hauptmenu';
                $('#hauptmenu').show();
                break;

            case 'gameovermenu':
                this.musik('bgm', 'stop');

                spiel.menu = 'gameovermenu';
                $('#gameovermenu').show();
                $('#score_anzahl').text(spieler.taler);
                // ws.send('5|' + spieler.taler);
                break;
        }
    },

    löschen: function () {
        main_ctx.clearRect(0, 0, 350, 500);
    },

    restart: function () {
        spiel.render = function () {
            main_ctx.save();
            main_ctx.beginPath();
            spiel.pattern = main_ctx.createPattern(spiel.bilder['spielbg' + level.aktuell], 'repeat');
            main_ctx.rect(0, 0, 350, 500);
            main_ctx.fillStyle = spiel.pattern;
            main_ctx.translate(0, Math.floor(map.y));
            main_ctx.fill();
            main_ctx.closePath();
            main_ctx.restore();

            // Objekte
            objekte.zeichnen();

            // Spieler & Auto
            spieler.zeichnen();
            spiel.bild_zeichnen('auto-' + spieler.richtung, spieler.x, spieler.y);

            // Animationen
            animation.zeichnen();

            // Level Anzeige
            // Linie
            main_ctx.beginPath();
            main_ctx.rect(45, 20, 150, 13);
            main_ctx.lineWidth = 2;
            main_ctx.strokeStyle = '#54524D';
            main_ctx.fillStyle = '#24231E';
            main_ctx.fill();
            main_ctx.closePath();
            main_ctx.stroke();

            // Box links (aktuelles Level)
            main_ctx.beginPath();
            main_ctx.arc(25, 27, 20, 0, 2 * Math.PI, false);
            main_ctx.lineWidth = 3;
            main_ctx.strokeStyle = '#54524D';
            main_ctx.fillStyle = '#24231E';
            main_ctx.fill();
            main_ctx.closePath();
            main_ctx.stroke();

            // Box rechts (nächstes Level)
            main_ctx.beginPath();
            main_ctx.arc(215, 27, 20, 0, 2 * Math.PI, false);
            main_ctx.lineWidth = 3;
            main_ctx.strokeStyle = '#54524D';
            main_ctx.fillStyle = '#24231E';
            main_ctx.fill();
            main_ctx.closePath();
            main_ctx.stroke();

            // Beschriftung: Box links (aktuelles Level)
            main_ctx.beginPath();
            main_ctx.font = '0.8em Ubuntu';
            main_ctx.fillStyle = 'white';
            main_ctx.fillText('Lv. ' + level.aktuell, 12, 31);
            main_ctx.closePath();
            main_ctx.stroke();

            // Beschriftung: Box rechts (nächstes Level)
            main_ctx.beginPath();
            main_ctx.font = '0.8em Ubuntu';
            main_ctx.fillStyle = 'white';
            main_ctx.fillText('Lv. ' + (level.aktuell + 1), 202, 31);
            main_ctx.closePath();
            main_ctx.stroke();

            // Level Fortschritt Box
            main_ctx.beginPath();
            main_ctx.rect(level.fortschritt.aktuell + 47, 15, 25, 23);
            main_ctx.lineWidth = 1;
            main_ctx.strokeStyle = '#929292';
            main_ctx.fillStyle = '#24231E';
            main_ctx.fill();
            main_ctx.closePath();
            main_ctx.stroke();

            // User Box
            main_ctx.beginPath();
            spiel.bild_zeichnen('avatar-icon', 0, 13, 25, 21, level.fortschritt.aktuell + 44, 16);
            main_ctx.closePath();
            main_ctx.stroke();
        };

        spieler.x = 151;
        spieler.y = 420;
        spieler.map_x = 143,
            spieler.map_y = 204,
            spieler.speed = 2,
            spieler.richtung = false,
            spieler.taler = 0;
        map.x = 0;
        map.y = 204;
        map.speed = 2;
        spieler.leben = 3;
        spiel.zeit = 0;
        level.aktuell = 1;
        level.fortschritt = {
            aktuell: 0,
            zumLevelUp: 0,
            map_y: 0
        };

        for (var i in objekte.objekte) {
            for (var i2 in objekte.objekte[i]) {
                objekte.objekte[i][i2] = '';
            }
        }

        for (var i in animation.animationen) {
            for (var i2 in animation.animationen) {
                animation.animationen[i][i2] = '';
            }
        }

        $('#spielmenu #status #herz_box').html('<div class="icon"></div><div class="icon"></div><div class="icon"></div>');
        $('#spielmenu #status #taler_box span#anzahl').text(spieler.taler);
        $('#spielmenu #status #zeit_box span#zeit').text(spiel.zeit);

        this.musik('bgm', 'abspielen');
    },

    gameover: function () {
        this.löschen();
        this.menu_wechseln('gameovermenu');

        if ($('img#pfeiltasten').length) {
            $('img#pfeiltasten').remove();
        }

        $('#spielmenu').hide();
    },
};

document.addEventListener('DOMContentLoaded', spiel.init);
window.addEventListener('keydown', spiel.button);

document.addEventListener("keydown", function (e) {
    spiel.tasten[e.keyCode] = true;
}, false);
document.addEventListener("keyup", function (e) {
    delete spiel.tasten[e.keyCode];
}, false);