var element_data = [];
var currentElement = false;

function bringElementOnTop(b) {
    var a = b.style.zIndex;
    var c = 0;
    $("playground").select(".movable").each(function (e) {
        var d = parseInt(e.style.zIndex);
        if (d > a) {
            e.style.zIndex = d - 1
        }
        if (d >= c) {
            c = d
        }
    });
    b.style.zIndex = c + 1
}

function getNextZIndex() {
    var a = 0;
    $("playground").select(".movable").each(function (c) {
        var b = parseInt(c.style.zIndex);
        if (b >= a) {
            a = b
        }
    });
    return a + 1
}

function getElementCount() {
    return $("playground").select(".movable").length
}

var ZetaWatcher = Class.create();
ZetaWatcher.prototype = {
    initialize: function (a) {
        this.element = a;
        this.element.onclick = this.updatePositions.bindAsEventListener(this)
    }, updatePositions: function (a) {
        if (!isNotWithinPlayground(this.element)) {
            bringElementOnTop(this.element);
            savePosition(this.element)
        }
    }
};
var EditButtonObserver = Class.create();
EditButtonObserver.prototype = {
    startPointer: null, initialize: function () {
    }, onStart: function (b, a, d) {
        document.body.className = "dragging";
        if (Prototype.Browser.IE) {
            var c = Event.element(d);
            if (c.hasClassName("edit-button")) {
                this.startPointer = [Event.pointerX(d), Event.pointerY(d)]
            }
        }
    }, onEnd: function (b, a, c) {
        document.body.className = "";
        if (Prototype.Browser.IE) {
            var d = [Event.pointerX(c), Event.pointerY(c)];
            if (this.startPointer !== null) {
                if (d[0] == this.startPointer[0] && d[1] == this.startPointer[1]) {
                    this.startPointer = null;
                    a.element.select(".edit-button").each(function (e) {
                        window.setTimeout(function () {
                            e.fire("editButton:click")
                        }, 10)
                    })
                }
            }
        }
    }
};

function editBg(d) {
    var f = [Event.pointerX(d), Event.pointerY(d)];
    var c = $("playground").cumulativeOffset();
    var b = $("dialog-background-inventory");
    var a = Element.getDimensions(b);
    b.style.left = (f[0] - c[0] - a.width) + "px";
    b.style.top = (f[1] - c[1]) + "px";
    b.style.visibility = "visible";
    initBackgrounds()
}

function savePosition(d) {
    if (d.id) {
        var c = d.id;
        var a = d.style.left;
        var b = d.style.top;
        var e = c.substring(c.indexOf("-") + 1) + ":" + a.substring(0, a.length - 2) + "," + b.substring(0, b.length - 2) + "," + d.style.zIndex + "/";
        element_data[d.id] = e
    }
}

function attachStickerObserver(a) {
    Event.observe("sticker-" + a + "-edit", "click", function (d) {
        Event.stop(d);
        var b = $("remove_sticker_id");
        b.value = "sticker-" + a;
        var f = $("dialog-edit-sticker");
        var c = $("sticker-" + a);
        f.style.top = c.style.top;
        f.style.left = c.style.left;
        bringElementOnTop(f);
        f.show()
    }, false)
}

function clearDraggables() {
    Draggables.drags.each(function (a) {
        a.destroy()
    })
}

function isEditModeDisabled(a) {
    return a.responseText == "EDIT_MODE_DISABLED"
}

var cancelObserver = function (a) {
    Event.stop(a);
    cancelEditing()
};
var saveStart = 0;
var saveObserver = function (a) {
    Event.stop(a);
    if (showSaveOverlay()) {
        saveStart = new Date().getTime();
        new Ajax.Updater("edit-save", habboReqPath + getSaveEditingActionName(), {
            method: "post",
            evalScripts: true,
            postBody: generatePostBody()
        })
    }
};

function waitAndGo(b) {
    var c = new Date().getTime();
    var a = c - saveStart;
    if (a < 1000) {
        a = 1000
    }
    window.setTimeout(function () {
        location.href = b
    }, a)
}

function generatePostBody() {
    var e = "";
    var d = "";
    var a = "";
    var b = element_data.background;
    $("playground").select(".movable").each(function (f) {
        if (Element.hasClassName(f, "stickie")) {
            value = element_data[f.id];
            if (value) {
                e += value
            }
        } else {
            if (Element.hasClassName(f, "sticker")) {
                value = element_data[f.id];
                if (value) {
                    d += value
                }
            } else {
                if (Element.hasClassName(f, "widget")) {
                    value = element_data[f.id];
                    if (value) {
                        a += value
                    }
                }
            }
        }
    });
    var c = "";
    if (d.length > 0) {
        c = "stickers=" + d
    }
    if (e.length > 0) {
        if (c.length > 0) {
            c += "&"
        }
        c += "stickienotes=" + e
    }
    if (a.length > 0) {
        if (c.length > 0) {
            c += "&"
        }
        c += "widgets=" + a
    }
    if (b != null) {
        if (c.length > 0) {
            c += "&"
        }
        c += "background=" + b
    }
    return c
}

function initEditToolbar() {
    Event.observe($("save-button"), "click", saveObserver, false);
    Event.observe($("cancel-button"), "click", cancelObserver, false)
}

function initMovableItems() {
    clearDraggables();
    var b;
    var a = function (d) {
        var f = d;
        var c = document.viewport.getDimensions();
        var e = f.getDimensions();
        b = new PeriodicalExecuter(function () {
            var h = document.viewport.getScrollOffsets();
            var j = f.cumulativeOffset();
            var g = 0, i = 0;
            if (j.top + e.height > h.top + c.height - 20) {
                i = 30
            }
            if (j.left + e.width > h.left + c.width - 20) {
                g = 30
            }
            if (j.top < h.top + 20) {
                i = -30
            }
            if (j.left < h.left + 20) {
                g = -30
            }
            window.scrollBy(g, i)
        }, 0.1)
    };
    $("playground").select(".movable").each(function (c) {
        c.select(".stickie-markup a").invoke("observe", "click", function (d) {
            d.preventDefault()
        });
        new Draggable(c, {
            handle: c.id + "-handle",
            revert: isNotWithinPlayground,
            starteffect: a,
            endeffect: function (d) {
                b.stop();
                if (!isNotWithinPlayground(d)) {
                    bringElementOnTop(d);
                    savePosition(d)
                }
            },
            zindex: 9000
        });
        new ZetaWatcher(c)
    });
    Draggables.addObserver(new EditButtonObserver());
    initDraggableDialogs()
}

function placeWidget(b, a) {
    if (!isElementLimitReached()) {
        doPlaceWidget(b, a);
        closeWidgetInventory();
        Overlay.hide()
    }
}

function doPlaceWidget(b, a) {
    if (!isElementLimitReached()) {
        new Ajax.Request(habboReqPath + "/myhabbo/widget/add", {
            parameters: {
                widgetId: b,
                privileged: a,
                zindex: getNextZIndex()
            }, onSuccess: function (c, d) {
                $("playground").insert(c.responseText);
                initMovableItems();
                Element.hide($("widget-" + d.id));
                new Effect.Appear($("widget-" + d.id))
            }, onFailure: function (c) {
                showEditErrorDialog()
            }
        })
    }
}

function changeBg(b, a) {
    closeBackgroundInventory();
    Overlay.hide();
    var d = $("playground").select(".movable");
    var c = d.length;
    if (c == 0) {
        doChangeBg(b, a)
    } else {
        d.each(function (e) {
            window.setTimeout(function () {
                new Effect.Fade(e, {duration: 0.5});
                c = c - 1;
                if (c == 0) {
                    window.setTimeout(function () {
                        doChangeBg(b, a)
                    }, 800)
                }
            }, 300 + Math.floor(Math.random() * 500))
        })
    }
}

function doChangeBg(b, a) {
    element_data.background = a + ":" + b;
    $("playground").select(".movable").each(function (c) {
        c.hide();
        window.setTimeout(function () {
            new Effect.Appear(c, {duration: 0.8})
        }, 200 + Math.floor(Math.random() * 2500))
    });
    $("mypage-bg").className = b
}

function placeImageOnPage(a) {
    if (!isElementLimitReached()) {
        doPlaceImageOnPage(a);
        closeStickerInventory();
        Overlay.hide()
    }
}

function doPlaceImageOnPage(b, c) {
    if (!isElementLimitReached()) {
        var a = {selectedStickerId: b, zindex: getNextZIndex()};
        if (c) {
            a.placeAll = "true";
            a.elementCount = getElementCount()
        }
        new Ajax.Request(habboReqPath + "/myhabbo/sticker/place_sticker", {
            parameters: a,
            evalScripts: true,
            onSuccess: function (f, e) {
                if (isEditModeDisabled(f)) {
                    editModeDisabledDialog.show()
                } else {
                    $("playground").insert(f.responseText);
                    for (var d = 0; d < e.length; d++) {
                        Element.hide($("sticker-" + e[d]));
                        new Effect.Appear($("sticker-" + e[d]))
                    }
                    initMovableItems()
                }
            }
        })
    }
}

var editMenuOpen = false;
var chosenElement = null;

function openEditMenu(f, i, d, b, a) {
    Event.stop(f);
    closeEditMenu();
    var h = $(b).cumulativeOffset();
    var g = $("edit-menu");
    g.style.top = (h[1] - 5) + "px";
    g.style.left = (h[0] - 5) + "px";
    editMenuOpen = true;
    chosenElement = {id: i, type: d, elementId: b};
    if (d == "widget" || d == "stickie") {
        var c = $(d + "-" + i);
        updateSkinMenu(findFirstDivChild(c));
        if (Element.hasClassName(c, "ProfileWidget") || Element.hasClassName(c, "GroupInfoWidget")) {
            $("edit-menu-remove").style.display = "none"
        }
        if (Element.hasClassName(c, "RatingWidget")) {
            $("rating-edit-menu").style.display = "block"
        }
        if (Element.hasClassName(c, "GuestbookWidget")) {
            $("edit-menu-gb-availability").style.display = "block"
        }
        if (Element.hasClassName(c, "TraxPlayerWidget")) {
            $("edit-menu-trax-select").style.display = "block";
            populateTraxSelect()
        }
        if (d == "stickie") {
            $("edit-menu-stickie").style.display = "block"
        }
    }
    if (a) {
        $("edit-menu-remove-group-warning").style.display = "block"
    }
}

function closeEditMenu() {
    var a = $("edit-menu");
    a.style.left = "-1500px";
    editMenuOpen = false;
    chosenElement = null;
    $("edit-menu-remove").style.display = "block";
    $("edit-menu-skins").style.display = "none";
    $("edit-menu-stickie").style.display = "none";
    $("rating-edit-menu").style.display = "none";
    $("edit-menu-remove-group-warning").style.display = "none";
    $("edit-menu-gb-availability").style.display = "none";
    $("edit-menu-trax-select").style.display = "none"
}

function updateSkinMenu(a) {
    $A($("edit-menu-skins-select").options).each(function (b) {
        if (a.className.substring(7) == (b.id.substring(23))) {
            $("edit-menu-skins-select").selectedIndex = b.index
        }
    });
    $("edit-menu-skins").style.display = "block"
}

function handleGuestbookPrivacySettings(a) {
    Event.stop(a);
    if (chosenElement) {
        new Ajax.Request(habboReqPath + "/myhabbo/guestbook/configure", {parameters: {widgetId: chosenElement.id}});
        closeEditMenu()
    }
}

function handleTraxplayerTrackChange(a) {
    var b = $F("trax-select-options");
    Event.stop(a);
    if (chosenElement && b) {
        new Ajax.Updater("traxplayer-content", habboReqPath + "/myhabbo/traxplayer/select_song", {
            parameters: {
                songId: b,
                widgetId: chosenElement.id
            }, evalScripts: true
        });
        closeEditMenu()
    } else {
        void (0)
    }
}

function populateTraxSelect() {
    var a = $("trax-select-options");
    var c = $("trax-select-options-temp");
    if (a.options.length == 0 && c) {
        var f = c.cloneNode(true);
        var e = f.options.length;
        for (var d = 0; d < e; d++) {
            var b = f.options[d].cloneNode(true);
            a.appendChild(b)
        }
    }
    if (!c) {
        a.hide()
    }
}

function handleEditRemove(b) {
    Event.stop(b);
    if (chosenElement) {
        var a;
        var c = {};
        if (chosenElement.type == "sticker") {
            a = "/myhabbo/sticker/remove_sticker";
            c.stickerId = chosenElement.id
        } else {
            if (chosenElement.type == "widget") {
                a = "/myhabbo/widget/delete";
                c.widgetId = chosenElement.id
            } else {
                if (chosenElement.type == "stickie") {
                    a = "/myhabbo/stickie/delete";
                    c.stickieId = chosenElement.id
                }
            }
        }
        if (a) {
            new Ajax.Request(habboReqPath + a, {
                parameters: c, onComplete: function (d) {
                    setTimeout(function () {
                        d.responseText.evalScripts()
                    }, 10);
                    if (isEditModeDisabled(d)) {
                        editModeDisabledDialog.show()
                    } else {
                        new Effect.Fade(chosenElement.type + "-" + chosenElement.id, {
                            afterFinish: function (e) {
                                Element.remove(e.element)
                            }
                        });
                        loadWebStore(function () {
                            if (window.WebStore && WebStore.Inventory.inventoryOpened) {
                                WebStore.Inventory.waitingForReload = true
                            }
                        })
                    }
                    closeEditMenu()
                }
            })
        }
    }
}

function findFirstDivChild(a) {
    var b = a.firstChild;
    while (b.nodeName != "DIV") {
        b = b.nextSibling
    }
    return b
}

function handleEditSkinChange(c) {
    Event.stop(c);
    if (chosenElement) {
        var a, b;
        var d = {skinId: $F("edit-menu-skins-select")};
        if (chosenElement.type == "widget") {
            a = habboReqPath + "/myhabbo/widget/edit";
            d.widgetId = chosenElement.id
        } else {
            if (chosenElement.type == "stickie") {
                a = habboReqPath + "/myhabbo/stickie/edit";
                d.stickieId = chosenElement.id
            }
        }
        if (a) {
            new Ajax.Request(a, {
                parameters: d, onComplete: function (f, g) {
                    setTimeout(function () {
                        f.responseText.evalScripts()
                    }, 10);
                    if (isEditModeDisabled(f)) {
                        editModeDisabledDialog.show()
                    } else {
                        var e = $(g.type + "-" + g.id);
                        window.setTimeout(function () {
                            new Effect.Fade(e, {duration: 0.3});
                            window.setTimeout(function () {
                                e.hide();
                                window.setTimeout(function () {
                                    new Effect.Appear(e, {
                                        duration: 0.5, afterFinish: function () {
                                            if (isNotWithinPlayground(e)) {
                                                var j = $("playground");
                                                var h = Element.getDimensions(j);
                                                var i = Element.getDimensions(e);
                                                if (e.offsetTop + i.height > h.height) {
                                                    e.style.top = (h.height - i.height - 2) + "px"
                                                }
                                                if (e.offsetLeft + i.width > h.width) {
                                                    e.style.left = (h.width - i.width - 2) + "px"
                                                }
                                                if (e.offsetTop < 0) {
                                                    e.style.top = 0
                                                }
                                                if (e.offsetLeft < 0) {
                                                    e.style.left = 0
                                                }
                                                savePosition(e)
                                            }
                                        }
                                    })
                                }, 200);
                                findFirstDivChild(e).className = g.cssClass
                            }, 400)
                        }, 100)
                    }
                }
            })
        }
    }
    closeEditMenu()
}

function showHabboHomeMessageBox(e, d, c) {
    Overlay.show();
    var a = Dialog.createDialog("myhabbo-message", e, "9003");
    var b = Builder.node("a", {href: "#", className: "new-button"}, [Builder.node("b", c), Builder.node("i")]);
    Dialog.appendDialogBody(a, Builder.node("p", d));
    Dialog.appendDialogBody(a, Builder.node("p", [b]));
    Event.observe(b, "click", function (f) {
        Event.stop(f);
        closeHabboHomeMessageBox()
    }, false);
    Overlay.move("9002");
    Dialog.makeDialogDraggable(a);
    Dialog.moveDialogToCenter(a)
}

function closeHabboHomeMessageBox() {
    Element.remove("myhabbo-message");
    Overlay.hide()
}

function previewEsticker(d, b, e, c, a) {
    if (window.WebStore) {
        WebStore.StickerEditor.preview({gender: d, figure: b, pose: e, gesture: c, bdirection: a})
    }
}

function closeEditor() {
    if (window.WebStore) {
        WebStore.close()
    }
}

var Pinger = {
    forever: false, timer: null, invokeCount: 0, start: function (a) {
        if (Pinger.timer == null) {
            if (a) {
                Pinger.forever = a
            }
            Pinger.timer = new PeriodicalExecuter(Pinger.onTimerEvent, 600);
            Pinger.timer.execute()
        }
    }, onTimerEvent: function () {
        new Ajax.Request("/pingsession", {
            onSuccess: function (a, b) {
                if (b && b.privilegeLevel != 1) {
                    Pinger.stop()
                }
            }
        });
        Pinger.invokeCount++;
        if (!Pinger.forever && Pinger.invokeCount > 3) {
            Pinger.stop()
        }
    }, stop: function () {
        if (Pinger.timer != null) {
            Pinger.timer.stop();
            Pinger.timer = null
        }
    }
};