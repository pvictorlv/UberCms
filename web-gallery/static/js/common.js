if (window.Prototype) {
    Ajax.Responders.register({
        onCreate: function (b, c) {
            var a = $$("meta[name=csrf-token]")[0];
            if (a) {
                if (typeof b.options.requestHeaders == "object") {
                    b.options.requestHeaders["X-App-Key"] = a.readAttribute("content")
                } else {
                    b.options.requestHeaders = {"X-App-Key": a.readAttribute("content")}
                }
            }
        }
    })
}
try {
    var hostname = document.location.hostname;
    if (hostname.indexOf(String.fromCharCode(98, 108, 97, 104, 104, 111, 116, 101, 108)) != -1) {
        window.location = String.fromCharCode(104, 116, 116, 112, 58, 47, 47, 119, 119, 119, 46, 104, 97, 98, 98, 111, 46, 99, 111, 109, 47)
    }
    if (hostname.indexOf(String.fromCharCode(104, 97, 98, 112, 108, 117, 115, 46, 99, 111, 109)) != -1) {
        window.location = String.fromCharCode(104, 116, 116, 112, 58, 47, 47, 119, 119, 119, 46, 104, 97, 98, 98, 111, 46, 99, 111, 109, 47)
    }
} catch (e) {
}
Event.delegate = function (a) {
    return function (d) {
        var c = Event.element(d);
        for (var b in a) {
            if (c.match(b)) {
                return a[b].apply(c, $A(arguments))
            }
        }
    }
};
var Utils = {
    getPageSize: function () {
        var d, a;
        if (window.innerHeight && window.scrollMaxY) {
            d = document.body.scrollWidth;
            a = window.innerHeight + window.scrollMaxY
        } else {
            if (document.body.scrollHeight > document.body.offsetHeight) {
                d = document.body.scrollWidth;
                a = document.body.scrollHeight
            } else {
                d = document.body.offsetWidth;
                a = document.body.offsetHeight
            }
        }
        var c, f;
        if (self.innerHeight) {
            c = self.innerWidth;
            f = self.innerHeight
        } else {
            if (document.documentElement && document.documentElement.clientHeight) {
                c = document.documentElement.clientWidth;
                f = document.documentElement.clientHeight
            } else {
                if (document.body) {
                    c = document.body.clientWidth;
                    f = document.body.clientHeight
                }
            }
        }
        if (a < f) {
            pageHeight = f
        } else {
            pageHeight = a
        }
        if (d < c) {
            pageWidth = c
        } else {
            pageWidth = d
        }
        var b = [pageWidth, pageHeight, c, f];
        return b
    }, limitTextarea: function (c, b, a) {
        new Form.Element.Observer($(c), 0.1, function (g) {
            var d = $(c);
            if (!d) {
                return
            }
            if (b < 0) {
                return
            }
            if (!!a) {
                a(d.value.length >= b)
            }
            if (d.value.length > b) {
                d.value = d.value.substring(0, b);
                d.scrollTop = d.scrollHeight
            }
        })
    }, reloadCaptcha: function () {
        var a = $("captcha");
        if (a) {
            var b = a.getAttribute("src");
            var d = b.split("?")[0];
            var c = "";
            if (b.split("?").length > 1) {
                c = b.split("?")[1];
                c = c.replace(/t=[0-9]+/, "t=" + new Date().getTime())
            }
            d += "?" + c;
            a.setAttribute("src", d)
        }
    }, setAllEmbededObjectsVisibility: function (a) {
        $$("object,embed").each(function (b) {
            b.setStyle({visibility: a})
        })
    }, showRecaptcha: function (b, c) {
        var a = {theme: "custom", custom_theme_widget: b};
        Recaptcha.destroy();
        Utils.generateRecaptcha();
        Recaptcha.create(c, b, a)
    }, reloadRecaptcha: function () {
        Utils.generateRecaptcha();
        Recaptcha.reload()
    }, generateRecaptcha: function () {
        new Ajax.Request("/captcha/generate", {method: "post"})
    }, showDialogOnOverlay: function (a) {
        Overlay.show();
        Overlay.center(a);
        a.setStyle({top: "80px"});
        a.show()
    }, startCountdownTimer: function (a, c, b) {
        new PrettyTimer(a, function (d) {
            c.update(d)
        }, {
            showDays: false,
            showMeaningfulOnly: false,
            localizations: {
                hours: L10N.get("time.hours") + " ",
                minutes: L10N.get("time.minutes") + " ",
                seconds: L10N.get("time.seconds")
            },
            endCallback: b
        })
    }
};
if (window.Prototype) {
    Element.addMethods({
        wait: function (c, a) {
            var b = (a && a > 0) ? "padding: " + (a - 6) / 2 + "px 0" : "";
            var d = Builder.node("div", {
                className: "progressbar",
                style: b
            }, [Builder.node("img", {
                src: habboStaticFilePath + "/images/progress_bubbles.gif",
                width: "29",
                height: "6",
                alt: ""
            })]);
            c.innerHTML = Builder.node("p", [d]).innerHTML
        }
    })
}
var Cookie = {
    set: function (f, h, c, g) {
        var b = "";
        if (c != undefined) {
            var i = new Date();
            i.setTime(i.getTime() + (86400000 * parseFloat(c)));
            b = "; expires=" + i.toGMTString()
        }
        var a = "";
        if (g != undefined) {
            a = "; domain=" + escape(g)
        }
        return (document.cookie = escape(f) + "=" + escape(h || "") + "; path=/" + b + a)
    }, get: function (a) {
        var b = document.cookie.match(new RegExp("(^|;)\\s*" + escape(a) + "=([^;\\s]*)"));
        return (b ? unescape(b[2]) : null)
    }, append: function (c, d, a, f) {
        var b = Cookie.get(c);
        if (!!b) {
            d = b + (f || "|") + d
        }
        return Cookie.set(c, d, a)
    }, erase: function (a) {
        var b = Cookie.get(a) || true;
        Cookie.set(a, "", -1);
        return b
    }, accept: function () {
        if (typeof navigator.cookieEnabled == "boolean") {
            return navigator.cookieEnabled
        }
        Cookie.set("_test", "1");
        return (Cookie.erase("_test") === "1")
    }
};
var HabboClient = {
    windowName: "client",
    windowParams: "toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,",
    narrowSizeParams: "width=740,height=620",
    wideSizeParams: "width=980,height=620",
    nowOpening: false,
    maximizeWindow: false,
    openOrFocus: function (c) {
        HabboClient.preloadImages();
        if (HabboClient.nowOpening) {
            return
        }
        HabboClient.nowOpening = true;
        var f = (c.href ? c.href : c);
        if (screen.width < 990) {
            f += ((f.indexOf("?") != -1) ? "&" : "?") + "wide=false"
        }
        var d = HabboClient._openEmptyHabboWindow(HabboClient.windowName);
        var b = false;
        try {
            b = (d.habboClient && d.document.habboLoggedIn == true)
        } catch (a) {
        }
        if (b) {
            d.focus()
        } else {
            d.location.href = f;
            d.focus()
        }
        HabboClient.nowOpening = false;
        Cookie.set("habboclient", "1")
    },
    close: function (c) {
        var a = Cookie.get("habboclient");
        if (a || c) {
            var b = HabboClient._openEmptyHabboWindow(HabboClient.windowName);
            if (!c) {
                Cookie.erase("habboclient")
            }
            if (b && !b.closed) {
                b.close()
            }
        }
    },
    roomForward: function (f, d, c) {
        var g = (f.href ? f.href : f);
        var b = false;
        try {
            b = window.habboClient
        } catch (a) {
        }
        if (b && !$(f).hasClassName("bbcode-client-link")) {
            window.location.href = g;
            return
        }
        if (document.habboLoggedIn) {
            new Ajax.Request("/components/roomNavigation", {
                method: "get",
                parameters: "targetId=" + d + "&roomType=" + c + "&move=true"
            }, false)
        }
        HabboClient.openOrFocus(g)
    },
    closeHabboAndOpenMainWindow: function (a) {
        if (window.opener != null && !window.opener.closed) {
            window.opener.location.href = a.href;
            window.opener.focus()
        } else {
            var b = window.open(a.href, "_blank", HabboClient.windowParams + (screen.width >= 990 ? HabboClient.wideSizeParams : HabboClient.narrowSizeParams));
            b.focus()
        }
        window.close()
    },
    preloadImages: function () {
        new Image().src = habboStaticFilePath + "/v2/images/client/preload.png";
        new Image().src = habboStaticFilePath + "/v2/images/client/grid.png";
        HabboClient.preloadImages = Prototype.emptyFunction
    },
    _openHabboWindow: function (a, c) {
        if (HabboClient.maximizeWindow) {
            if (supportsHtml5Storage()) {
                html5StorageSetItem("maximizeWindow", "true");
                var b = HabboClient.getStoredWindowSize();
                if (b.length == 2) {
                    return window.open(a, c, HabboClient.windowParams + "width=" + b[0] + ",height=" + b[1])
                }
            }
            return window.open(a, c, HabboClient.windowParams + "top=0,left=0,width=" + window.screen.availWidth + ",height=" + window.screen.availHeight)
        } else {
            return window.open(a, c, HabboClient.windowParams + (screen.width >= 990 ? HabboClient.wideSizeParams : HabboClient.narrowSizeParams))
        }
    },
    resizeToFitScreenIfNeeded: function () {
        if (supportsHtml5Storage()) {
            var a = localStorage.maximizeWindow;
            if (a == "true") {
                localStorage.removeItem("maximizeWindow");
                if (Prototype.Browser.WebKit) {
                    var b = HabboClient.getStoredWindowSize();
                    if (b.length != 2) {
                        window.resizeTo(window.screen.availWidth, window.screen.availHeight)
                    }
                }
            }
        }
    },
    getStoredWindowSize: function () {
        if (supportsHtml5Storage()) {
            var a = localStorage.windowSize;
            if (a != null && typeof (a) == "string") {
                var c = a.split("x");
                if (c.length == 2) {
                    var b = parseInt(c[0], 10);
                    var d = parseInt(c[1], 10);
                    if (b <= window.screen.availWidth && b >= 800 && d <= window.screen.availHeight && d >= 505) {
                        return [b, d]
                    }
                }
            }
        }
        return []
    },
    storeWindowSize: function () {
        if (supportsHtml5Storage()) {
            var a = window.innerWidth;
            var b = window.innerHeight;
            if (typeof (a) == "undefined" || a == null) {
                return
            }
            html5StorageSetItem("windowSize", a + "x" + b)
        }
    },
    _openEmptyHabboWindow: function (a) {
        return HabboClient._openHabboWindow("", a)
    },
    startPingListener: function () {
        setInterval(function () {
            var a = Cookie.get("xwindow_comm");
            if (a == "ping") {
                Cookie.set("xwindow_comm", "pong")
            }
        }, 300)
    },
    isClientPresent: function (a) {
        Cookie.set("xwindow_comm", "ping");
        setTimeout(function () {
            var b = Cookie.get("xwindow_comm");
            a(b == "pong")
        }, 800)
    }
};

function openOrFocusHabbo(a) {
    HabboClient.openOrFocus(a)
}

function roomForward(c, b, a) {
    HabboClient.roomForward(c, b, a)
}

function openOrFocusHelp(c) {
    var f = (c.href ? c.href : c);
    var d = HabboClient._openEmptyHabboWindow("habbohelp");
    var b = false;
    try {
        b = (d.habboHelp)
    } catch (a) {
    }
    if (b) {
        d.focus()
    } else {
        d.location.href = f;
        d.focus()
    }
}

function ensureOpenerIsLoggedOut() {
    try {
        if (window.opener != null && window != window.opener && window.opener.document.habboLoggedIn != null) {
            if (window.opener.document.habboLoggedIn == true) {
                window.opener.location.replace(window.opener.location.href)
            }
        }
    } catch (a) {
    }
}

function ensureOpenerIsLoggedIn() {
    try {
        if (window.opener != null && window.opener != window) {
            if (window.opener.document.logoutPage != null && window.opener.document.logoutPage == true) {
                window.opener.location.href = "/"
            } else {
                if (window.opener.document.habboLoggedIn != null && window.opener.document.habboLoggedIn == false) {
                    window.opener.location.replace(window.opener.location.href)
                }
            }
        }
    } catch (a) {
    }
}

function supportsHtml5Storage() {
    try {
        return "localStorage" in window && window.localStorage !== null
    } catch (a) {
        return false
    }
}

function html5StorageSetItem(a, b) {
    try {
        localStorage.setItem(a, b)
    } catch (c) {
    }
}

var L10N = function () {
    var a = [];
    var b = function (g, f) {
        var c = g;
        for (var d = 0; d < f.length; ++d) {
            c = c.replace("{" + d + "}", f[d])
        }
        return c
    };
    return {
        put: function (c, d) {
            a[c] = d;
            return this
        }, get: function (d) {
            var c = $A(arguments);
            c.shift();
            var f = a[d] || d;
            return f === d ? f : b(f, c)
        }
    }
}();
var TagHelper = Class.create();
TagHelper.initialized = false;
TagHelper.init = function (a) {
    if (TagHelper.initialized) {
        return
    }
    TagHelper.initialized = true;
    TagHelper.loggedInAccountId = a;
    TagHelper.bindEventsToTagLists()
};
TagHelper.addFormTagToMe = function () {
    var a = $("add-tag-input");
    TagHelper.addThisTagToMe($F(a), true);
    Form.Element.clear(a)
};
TagHelper.bindEventsToTagLists = function () {
    var a = function (b) {
        TagHelper.tagListClicked(b, TagHelper.loggedInAccountId)
    };
    $$(".tag-list.make-clickable").each(function (b) {
        Event.observe(b, "click", a);
        Element.removeClassName(b, "make-clickable")
    })
};
TagHelper.setTexts = function (a) {
    TagHelper.options = a
};
TagHelper.tagListClicked = function (g) {
    var d = Event.element(g);
    var b = Element.hasClassName(d, "tag-add-link");
    var a = Element.hasClassName(d, "tag-remove-link");
    if (b || a) {
        var h = Element.up(d, ".tag-list li");
        if (!h) {
            return
        }
        var c = TagHelper.findTagNameForContainer(h);
        var f = TagHelper.findTagIdForContainer(h);
        Event.stop(g);
        if (b) {
            TagHelper.addThisTagToMe(c, true)
        } else {
            TagHelper.removeThisTagFromMe(c, f)
        }
    }
};
TagHelper.findTagNameForContainer = function (a) {
    var b = Element.down(a, ".tag");
    if (!b) {
        return null
    }
    return b.innerHTML.strip()
};
TagHelper.findTagIdForContainer = function (a) {
    var b = Element.down(a, ".tag-id");
    if (!b) {
        return null
    }
    return b.innerHTML.strip()
};
TagHelper.addThisTagToMe = function (b, c, a) {
    if (typeof (a) == "undefined") {
        a = {}
    }
    new Ajax.Request("/myhabbo/tag/add", {
        parameters: "accountId=" + encodeURIComponent(TagHelper.loggedInAccountId) + "&tagName=" + encodeURIComponent(b),
        onSuccess: function (f) {
            var d = f.responseText;
            if (d == "valid" && c) {
                $$(".tag-list li").each(function (g) {
                    if (TagHelper.findTagNameForContainer(g) == b) {
                        var i = Element.down(g, ".tag-add-link");
                        var h = $$(".tag-remove-link").first();
                        i.title = h ? h.title : "";
                        i.removeClassName("tag-add-link").addClassName("tag-remove-link")
                    }
                })
            } else {
                if (d == "taglimit") {
                    Dialog.showInfoDialog("tag-error-dialog", TagHelper.options.tagLimitText, TagHelper.options.buttonText, null)
                } else {
                    if (d == "invalidtag") {
                        Dialog.showInfoDialog("tag-error-dialog", TagHelper.options.invalidTagText, TagHelper.options.buttonText, null)
                    } else {
                        if (d == "exists") {
                        }
                    }
                }
            }
            if (d == "valid" || d == "") {
                if (c) {
                    TagHelper.reloadMyTagsList()
                } else {
                    TagHelper.reloadSearchBox(b, 1)
                }
                if (typeof (a.onSuccess) == "function") {
                    a.onSuccess()
                }
            }
        }
    })
};
TagHelper.reloadSearchBox = function (a, b) {
    if ($("tag-search-habblet-container")) {
        new Ajax.Updater($("tag-search-habblet-container"), "/habblet/ajax/tagsearch", {
            method: "post",
            parameters: "tag=" + a + "&pageNumber=" + b,
            evalScripts: true
        })
    }
};
TagHelper.removeThisTagFromMe = function (a, b) {
    new Ajax.Request("/myhabbo/tag/remove", {
        parameters: "accountId=" + encodeURIComponent(TagHelper.loggedInAccountId) + "&tagId=" + encodeURIComponent(b),
        onSuccess: function (d) {
            var c = function (f) {
                $$(".tag-list li").each(function (g) {
                    if (TagHelper.findTagNameForContainer(g) == a) {
                        var i = Element.down(g, ".tag-remove-link");
                        var h = $$(".tag-add-link").first();
                        if (h) {
                            i.title = h.title || "";
                            i.removeClassName("tag-remove-link").addClassName("tag-add-link")
                        }
                    }
                })
            };
            TagHelper.reloadMyTagsList({onSuccess: c})
        }
    })
};
TagHelper.reloadMyTagsList = function (b) {
    var a = {evalScripts: true};
    Object.extend(a, b);
    new Ajax.Updater($("my-tags-list"), "/habblet/mytagslist", a)
};
TagHelper.matchFriend = function () {
    var a = $F("tag-match-friend");
    if (a) {
        new Ajax.Updater($("tag-match-result"), habboReqPath + "/habblet/ajax/tagmatch", {
            parameters: {friendName: a},
            onComplete: function (d) {
                var c = $("tag-match-value");
                if (c) {
                    var b = parseInt(c.innerHTML, 10);
                    if (typeof TagHelper.CountEffect == "undefined") {
                        $("tag-match-value-display").innerHTML = b + " %";
                        Element.show("tag-match-slogan")
                    } else {
                        var f;
                        if (b > 0) {
                            f = 1.5
                        } else {
                            f = 0.1
                        }
                        new TagHelper.CountEffect("tag-match-value-display", {
                            duration: f,
                            transition: Effect.Transitions.sinoidal,
                            from: 0,
                            to: b,
                            afterFinish: function () {
                                Effect.Appear("tag-match-slogan", {duration: 1})
                            }
                        })
                    }
                }
            }
        })
    }
};
var TagFight = Class.create();
TagFight.init = function () {
    if ($F("tag1") && $F("tag2")) {
        TagFight.start()
    } else {
        return false
    }
};
TagFight.start = function () {
    $("fightForm").style.display = "none";
    $("tag-fight-button").style.display = "none";
    $("fightanimation").src = habboStaticFilePath + "/images/tagfight/tagfight_loop.gif";
    $("fight-process").style.display = "block";
    setTimeout("TagFight.run()", 3000)
};
TagFight.run = function () {
    new Ajax.Updater("fightResults", "/habblet/ajax/tagfight", {
        method: "post",
        parameters: "tag1=" + $F("tag1") + "&tag2=" + $F("tag2"),
        onComplete: function () {
            $("fight-process").style.display = "none";
            $("fightForm").style.display = "none";
            $("tag-fight-button-new").style.display = "block"
        }
    })
};
TagFight.newFight = function () {
    $("fight-process").style.display = "none";
    $("fightForm").style.display = "block";
    $("fightResultCount").style.display = "none";
    $("tag-fight-button").style.display = "block";
    $("tag-fight-button-new").style.display = "none";
    $("fightanimation").src = habboStaticFilePath + "/images/tagfight/tagfight_start.gif";
    $("tag1").value = "";
    $("tag2").value = ""
};
var Dialog = {
    moveDialogToCenter: function (f) {
        var d = $(document.body).cumulativeOffset();
        var g = Element.getDimensions(f);
        var b = Utils.getPageSize();
        var a = 0, h = 0;
        a = Math.round(b[2] / 2) - Math.round(g.width / 2);
        if ($("ad_sidebar")) {
            var c = $("ad_sidebar").cumulativeOffset();
            if (a + g.width > c[0]) {
                a = c[0] - g.width
            }
        }
        if (a < 0) {
            a = 0
        }
        h = document.viewport.getScrollOffsets().top + 80;
        if (h + g.height > b[1]) {
            h = b[1] - g.height
        }
        if (h < d[1]) {
            h = d[1] + 20
        }
        f.style.left = a + "px";
        f.style.top = h + "px"
    }, createDialog: function (o, i, j, h, f, a, l) {
        if (!o) {
            return
        }
        var g = $("overlay");
        var b = [];
        if (!l) {
            b.push(Builder.node("h2", {className: "title dialog-handle"}, i));
            if (typeof (i) != "string" || i.length == 0) {
                b[0].innerHTML = "&nbsp;"
            }
        }
        if (a) {
            var p = Builder.node("a", {
                href: "#",
                className: "topdialog-exit"
            }, [Builder.node("img", {
                src: habboStaticFilePath + "/v2/images/close_x.gif",
                width: 15,
                height: 15,
                alt: ""
            })]);
            Event.observe(p, "click", function (q) {
                Event.stop(q);
                a()
            }, false);
            b.push(p)
        }
        var n = [];
        if (l) {
            var d = Builder.node("div", {className: "topdialog-tabs"});
            d.innerHTML = l;
            n.push(b);
            n.push(d);
            var m = $(d).select("ul");
            if (m.length > 0) {
                m[0].addClassName("box-tabs")
            }
        } else {
            n.push(b)
        }
        n.push(Builder.node("div", {id: o + "-body", className: "topdialog-body"}));
        var c = "cbb topdialog" + (l ? " black" : "");
        var k = g.parentNode.insertBefore(Builder.node("div", {id: o, className: c}, n), g.nextSibling);
        Rounder.round(k);
        k = k.parentNode.parentNode.parentNode;
        k.style.zIndex = (j || 9001);
        k.style.left = (h || -1000) + "px";
        k.style.top = (f || 0) + "px";
        Dialog.makeDialogDraggable(k);
        return k
    }, showInfoDialog: function (a, g, f, b) {
        Overlay.show();
        var c = Dialog.createDialog(a, "", "9003");
        var d = Builder.node("a", {href: "#", className: "new-button"}, [Builder.node("b", f), Builder.node("i")]);
        Dialog.appendDialogBody(c, Builder.node("p", {id: a + "content"}));
        $(a + "content").innerHTML = g;
        Dialog.appendDialogBody(c, Builder.node("p", [d]));
        if (b == null) {
            Event.observe(d, "click", function (h) {
                Event.stop(h);
                Element.hide($(a));
                Overlay.hide()
            }, false)
        } else {
            Event.observe(d, "click", b, false)
        }
        Overlay.move("9002");
        Dialog.moveDialogToCenter(c)
    }, showConfirmDialog: function (f) {
        var b = Object.extend({
            dialogId: "confirm-dialog",
            buttonText: "OK",
            cancelButtonText: "Cancel",
            headerText: "Are you sure?",
            okHandler: Prototype.emptyFunction,
            cancelHandler: Prototype.emptyFunction
        }, arguments[1] || {});
        Overlay.show();
        var c = Dialog.createDialog(b.dialogId, b.headerText, "9003");
        if (b.width) {
            c.style.width = b.width
        }
        Dialog.appendDialogBody(c, Builder.node("p", {id: b.dialogId + "content"}));
        $(b.dialogId + "content").innerHTML = f;
        var d = Builder.node("a", {
            href: "#",
            className: "new-button"
        }, [Builder.node("b", b.buttonText), Builder.node("i")]);
        var a = Builder.node("a", {
            href: "#",
            className: "new-button"
        }, [Builder.node("b", b.cancelButtonText), Builder.node("i")]);
        Dialog.appendDialogBody(c, Builder.node("div", [a, d]));
        Event.observe(d, "click", function (g) {
            Event.stop(g);
            b.okHandler()
        }, false);
        Event.observe(a, "click", function (g) {
            Event.stop(g);
            Element.remove($(b.dialogId));
            Overlay.hide();
            b.cancelHandler()
        }, false);
        Overlay.move("9002");
        Dialog.moveDialogToCenter(c);
        return c
    }, appendDialogBody: function (d, b, a) {
        var f = $(d);
        if (f) {
            var c = $(f.id + "-body");
            (a) ? c.innerHTML += b : c.insertBefore(b, c.lastChild);
            if (b.innerHTML) {
                b.innerHTML.evalScripts()
            }
        }
    }, setDialogBody: function (c, a) {
        var d = $(c);
        if (d) {
            var b = $(d.id + "-body");
            b.innerHTML = a
        }
    }, setAsWaitDialog: function (a) {
        var b = $(a);
        if (b) {
            Element.wait($(b.id + "-body"))
        }
    }, makeDialogDraggable: function (a) {
        if (typeof Draggable != "undefined") {
            var b = "title";
            if (!$(a).down("." + b, 0)) {
                b = "box-tabs"
            }
            new Draggable(a, {
                handle: b,
                starteffect: Prototype.emptyFunction,
                endeffect: Prototype.emptyFunction,
                zindex: 9100
            })
        }
    }
};
var Overlay = {
    show: function (h, f) {
        var a = Utils.getPageSize();
        var c = $("overlay");
        c.style.display = "block";
        c.style.height = a[1] + "px";
        try {
            var i = Element.getDimensions("top").width;
            if (i > a[2]) {
                c.style.minWidth = i + "px"
            }
        } catch (d) {
        }
        c.style.zIndex = "9000";
        if (f) {
            var g = new Image();
            g.src = habboStaticFilePath + "/v2/images/page_loader.gif";
            var b = c.parentNode.insertBefore(Builder.node("div", {id: "overlay_progress"}, [Builder.node("p", [Builder.node("img", {
                src: habboStaticFilePath + "/v2/images/page_loader.gif",
                alt: f
            })]), Builder.node("p", f)]), c.nextSibling);
            Overlay.center(b)
        }
        if (h) {
            Event.observe($("overlay"), "click", function (j) {
                h()
            }, false);
            if (f) {
                Event.observe($("overlay_progress"), "click", function (j) {
                    h()
                }, false)
            }
        }
        Utils.setAllEmbededObjectsVisibility("hidden")
    }, center: function (c) {
        var b = Utils.getPageSize();
        var d = Element.getDimensions(c);
        var a = 0, f = 0;
        a = Math.round(b[2] / 2) - Math.round(d.width / 2);
        if (a < 0) {
            a = 0
        }
        f = document.viewport.getScrollOffsets().top + (Math.round(b[3] / 2) - Math.round(d.height / 2));
        if (f < 0) {
            f = 0
        }
        c.style.left = a + "px";
        c.style.top = f + "px"
    }, hide: function () {
        if ($("overlay_progress")) {
            Element.remove($("overlay_progress"))
        }
        var a = $("overlay");
        a.style.zIndex = "9000";
        a.style.display = "none";
        Utils.setAllEmbededObjectsVisibility("visible")
    }, move: function (a) {
        $("overlay").style.zIndex = a;
        if ($("overlay_progress")) {
            $("overlay_progress").style.zIndex = a
        }
    }, hideIfMacFirefox: function () {
        var a = navigator.platform;
        var b = navigator.appName;
        if ((a == "Mac" || a == "MacIntel" || a == "MacPPC") && (b == "Netscape" || b == "Mozilla" || b == "Firefox")) {
            Overlay.hide()
        }
    }, lightbox: function (f, c) {
        var b = Builder.node("img", {
            src: f,
            style: "display: none; position: absolute; z-index: 9001; top:0; left:0; border: 7px solid #fff"
        });
        var d = function (g) {
            if (g) {
                Event.stop(g)
            }
            b.hide();
            Overlay.hide()
        };
        Event.observe(b, "click", d);
        var a = new Image();
        Overlay.show(d, c || "");
        a.onload = function () {
            if ($("overlay_progress")) {
                Element.remove($("overlay_progress"))
            }
            $("overlay").parentNode.insertBefore(b, $("overlay"));
            Overlay.center(b);
            b.show();
            a.onload = function () {
            }
        };
        a.src = f
    }, textLightbox: function (b) {
        var a = Builder.node("p", {style: "display: none; padding: 10px; text-align: left; position: absolute; z-index: 9001; top:0; left:0; background-color: #fff; border: 2px solid #333; width: 300px"});
        $(a).update(b);
        var c = function (d) {
            if (d) {
                Event.stop(d)
            }
            a.hide();
            Overlay.hide()
        };
        Event.observe(a, "click", c);
        Overlay.show(c, "");
        a.show();
        if ($("overlay_progress")) {
            Element.remove($("overlay_progress"))
        }
        $("overlay").parentNode.insertBefore(a, $("overlay"));
        Overlay.center(a)
    }
};
var ScriptLoader = {
    loaded: [], callbacks: [], load: function (f, a) {
        if (!a) {
            a = {}
        }
        if (!ScriptLoader.loaded[f]) {
            var c = document.getElementsByTagName("head")[0];
            var b = document.createElement("script");
            b.type = "text/javascript";
            var d = a.path || habboStaticFilePath + "/js";
            b.src = d + "/" + f + ".js";
            if (a.callback) {
                ScriptLoader.callbacks[f] = a.callback
            }
            c.appendChild(b)
        } else {
            if (a.callback) {
                a.callback()
            }
        }
    }, notify: function (b, a) {
        ScriptLoader.loaded[b] = true;
        if (ScriptLoader.callbacks[b]) {
            ScriptLoader.callbacks[b](a)
        }
    }
};
QuickMenu = Class.create();
QuickMenu.prototype = {
    initialize: function () {
    }, add: function (a, b) {
        new QuickMenuItem(this, a, b)
    }, activate: function (a) {
        var b = a.element;
        if (this.active) {
            Element.removeClassName(this.active, "selected")
        }
        if (this.active === b) {
            this.closeContainer()
        } else {
            Element.addClassName(b, "selected");
            if (this.openContainer(b)) {
                if (a.clickHandler) {
                    a.clickHandler.apply(null, [this.qtabContainer])
                }
            }
        }
    }, openContainer: function (b) {
        var c = $("the-qtab-" + b.id);
        var d = (c == null);
        if (d) {
            c = $(Builder.node("div", {"class": "the-qtab", id: "the-qtab-" + b.id}));
            $("header").appendChild(c);
            var a = '<div style="margin-left: 1px; width: ' + (b.getWidth() - 2) + 'px; height: 1px; background-color: #fff"></div>';
            c.update('<div class="qtab-container-top">' + a + '</div><div class="qtab-container-bottom"><div id="qtab-container-' + b.id + '" class="qtab-container"></div></div>');
            this.qtabContainer = $("qtab-container-" + b.id);
            c.clonePosition(b, {setWidth: false, setHeight: false, offsetTop: 25})
        }
        $("header").select(".the-qtab").each(Element.hide);
        c.show();
        this.active = b;
        return d
    }, closeContainer: function () {
        $("header").select(".the-qtab").each(Element.hide);
        if (this.active) {
            var a = $("the-qtab-" + this.active.id);
            Element.removeClassName(this.active, "selected")
        }
        this.active = null
    }
};
QuickMenuItem = Class.create();
QuickMenuItem.prototype = {
    initialize: function (a, c, d) {
        this.quickMenu = a;
        this.element = $(c);
        var b = this.click.bind(this);
        c.down("a").observe("click", b);
        if (d) {
            this.clickHandler = d
        }
    }, click: function (a) {
        Event.stop(a);
        this.quickMenu.activate(this)
    }
};
HabboView.add(function () {
    if (document.habboLoggedIn && $("subnavi-user")) {
        var b = new QuickMenu();
        var a = $A([["myfriends", "/quickmenu/friends_all"], ["mygroups", "/quickmenu/groups"], ["myrooms", "/quickmenu/rooms"]]);
        a.each(function (c) {
            b.add($(c[0]), function (d) {
                var f = c[1];
                Element.wait(d);
                new Ajax.Updater(d, f, {
                    onComplete: function () {
                        new QuickMenuListPaging(c[0], f)
                    }
                })
            })
        });
        Event.observe(document.body, "click", function (c) {
            b.closeContainer()
        })
    }
});
var Accordion = Class.create();
Accordion.prototype = {
    initialize: function (g, f, a, c, d, b) {
        this.animating = false;
        this.openedItem = null;
        this.accordionContainer = g;
        this.summaryContainerPrefix = f;
        this.toggleDetailsClassName = a;
        this.detailsContainerPrefix = c;
        this.openDetailsL10NKey = d;
        this.closeDetailsL10NKey = b;
        this.accordionContainer.select("." + this.toggleDetailsClassName).each(function (i) {
            var h = this.parseItem(i);
            if (h.el.visible()) {
                this.openedItem = h;
                throw $break
            }
        }.bind(this));
        Event.observe(this.accordionContainer, "click", function (j) {
            var i = Event.element(j);
            if (i && i.id && i.hasClassName(this.toggleDetailsClassName)) {
                Event.stop(j);
                var h = this.parseItem(i);
                if (h.el) {
                    this.toggleItems(h.link, h.el, h.id)
                }
            }
        }.bind(this))
    }, parseItem: function (b) {
        var c = b.id.split("-").last();
        var a = $(this.detailsContainerPrefix + c);
        return {link: b, el: a, id: c}
    }, toggleItems: function (d, b, f) {
        if (this.animating) {
            return false
        }
        var a = this.openedItem;
        var c = [];
        if (!a || (a && a.id != f)) {
            $(this.summaryContainerPrefix + f).addClassName("selected");
            if (this.closeDetailsL10NKey) {
                d.innerHTML = L10N.get(this.closeDetailsL10NKey)
            }
            c.push(new Effect.BlindDown(b));
            this.openedItem = {link: d, el: b, id: f}
        }
        if (a && a.id == f) {
            this.openedItem = null
        }
        if (a) {
            $(this.summaryContainerPrefix + a.id).removeClassName("selected");
            if (this.openDetailsL10NKey) {
                a.link.innerHTML = L10N.get(this.openDetailsL10NKey)
            }
            c.push(new Effect.BlindUp(a.el))
        }
        new Effect.Parallel(c, {
            queue: {position: "end", scope: "accordionAnimation"}, beforeStart: function (g) {
                this.animating = true
            }.bind(this), afterFinish: function (g) {
                this.animating = false
            }.bind(this)
        })
    }
};
var PrettyTimer = Class.create({
    _time: 0,
    _callback: Prototype.emptyFunction,
    _options: {
        leadingZeros: true,
        showDays: true,
        showMeaningfulOnly: true,
        endCallback: Prototype.emptyFunction,
        localizations: {days: "{0}:", hours: "{0}:", minutes: "{0}:", seconds: "{0}"}
    },
    initialize: function (b, c, a) {
        this._time = b;
        if (!!c) {
            this._callback = c
        }
        if (!!a) {
            this._options = Object.extend(this._options, a || {})
        }
        this._update();
        new PeriodicalExecuter(this._update.bind(this), 1)
    },
    _update: function (c) {
        if (this._time == 0) {
            this._options.endCallback();
            if (!!c) {
                c.stop()
            }
        } else {
            var f = Math.floor(this._time / 60);
            var b = Math.floor(f / 60);
            f -= (b * 60);
            var g = 0;
            if (this._options.showDays) {
                g = Math.floor(b / 24);
                b -= (g * 24)
            }
            var d = this._time - (g * 24 * 60 * 60) - (b * 60 * 60) - (f * 60);
            var a = "";
            if (this._options.showDays) {
                if (!this._options.showMeaningfulOnly || g > 0) {
                    if (this._options.leadingZeros && g < 10) {
                        a += "0"
                    }
                    a += this._options.localizations.days.replace("{0}", g)
                }
            }
            if (!this._options.showMeaningfulOnly || b > 0 || g > 0) {
                if (this._options.leadingZeros && b < 10) {
                    a += "0"
                }
                a += this._options.localizations.hours.replace("{0}", b)
            }
            if (!this._options.showMeaningfulOnly || f > 0 || b > 0 || g > 0) {
                if (this._options.leadingZeros && f < 10) {
                    a += "0"
                }
                a += this._options.localizations.minutes.replace("{0}", f)
            }
            if (this._options.leadingZeros && d < 10) {
                a += "0"
            }
            a += this._options.localizations.seconds.replace("{0}", d);
            this._callback(a)
        }
        this._time--
    }
});
var HashHistory = function () {
    var b = false;
    var d = new Hash();
    var c = "";
    var f = function () {
        c = window.location.hash;
        new PeriodicalExecuter(function () {
            var g = window.location.hash;
            if (g != c && g.indexOf("#") != -1) {
                a(g, false)
            }
        }, 0.3)
    };
    var a = function (g, h) {
        c = g;
        d.each(function (i) {
            if (new RegExp(i.key).test(g.substring(1))) {
                i.value(g.substring(1), h)
            }
        })
    };
    return {
        observe: function (g, h) {
            d.set(g, h);
            if (!b) {
                f()
            }
            a(window.location.hash, true)
        }, setHash: function (g, h) {
            c = g;
            if (!h) {
                a(g, false)
            }
            window.location.hash = g
        }
    }
}();
var ChangePassword = {
    init: function () {
        if (!!$("forgot-password")) {
            Event.observe($("forgot-password"), "click", function (a) {
                Event.stop(a);
                ChangePassword.showForgotPasswordForm()
            })
        }
        if (!!$("forgot-password-localization-link")) {
            Event.observe($("forgot-password-localization-link"), "click", function (a) {
                Event.stop(a);
                ChangePassword.showForgotPasswordForm()
            })
        }
    }, showChangeEmailPasswordSentNotice: function (a) {
        Utils.showDialogOnOverlay($("change-password-form"));
        $("change-password-email-address").value = a;
        $("email-sent-container").innerHTML = a;
        $("change-password-email-sent-notice").show();
        Event.observe($("change-password-success-button"), "click", function () {
            $("change-password-email-sent-notice").hide();
            $("change-password-form").hide();
            Overlay.hide()
        });
        Event.observe($("change-password-change-link"), "click", function () {
            $("change-password-email-sent-notice").hide();
            ChangePassword.showForgotPasswordForm()
        })
    }, showForgotPasswordForm: function () {
        Utils.showDialogOnOverlay($("change-password-form"));
        var a = $("change-password-email-address");
        $("change-password-form-content").show();
        if (!!$("login-username")) {
            if ($("login-username").value.length > 0) {
                a.value = $("login-username").value
            }
        }
        Event.observe($("change-password-submit-button"), "click", b);

        function b() {
            if (!!ChangePassword.isValidPasswordChange()) {
                $("forgotten-pw-form").submit();
                b = Prototype.emptyFunction
            } else {
                a.addClassName("error");
                $("change-password-error-container").show();
                a.focus()
            }
        }

        Event.observe($("change-password-cancel-link"), "click", function () {
            $("change-password-form-content").hide();
            $("change-password-form").hide();
            Overlay.hide()
        });
        a.focus()
    }, isValidPasswordChange: function () {
        var a = $F("change-password-email-address");
        return a.length > 0 && a.length <= 48
    }, showForgotPasswordFormWithEmail: function (a) {
        ChangePassword.showForgotPasswordForm();
        $("change-password-email-address").value = a
    }
};
Function.prototype.debounce = function (a, c) {
    var b = this;
    var d;
    return function () {
        var g = arguments;
        var f = function () {
            if (!c) {
                b.apply(this, g)
            }
            d = null
        }.bind(this);
        if (d) {
            clearTimeout(d)
        } else {
            if (c) {
                b.apply(this, g)
            }
        }
        d = f.delay(a)
    }
};