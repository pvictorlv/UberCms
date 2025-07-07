var reportingButtonsObserved = false;
var reportingZ = 8100;
var oldZ = new Array();
var bringToTop = function (a) {
    Event.stop(a);
    if (reportingButtonsObserved == true) {
        oldZ[this.id] = this.style.zIndex;
        this.style.zIndex = reportingZ;
        reportingZ++
    }
};

function initView(b, c) {
    var k = $("leave-group-button");
    if (k) {
        Event.observe(k, "click", function (n) {
            Event.stop(n);
            openGroupActionDialog("/ajax_habblet/actions/confirm_leave.php", "/ajax_habblet/actions/leave.php", null, b, null)
        })
    }
    var f = $("join-group-button");
    if (f) {
        Event.observe(f, "click", function (n) {
            Event.stop(n);
            openGroupJoinDialog("/ajax_habblet/actions/join.php", b)
        })
    }
    var a = $("webstore-button");
    if (a) {
        Event.observe(a, "click", function (n) {
            Event.stop(n);
            loadWebStore(function () {
                if (window.WebStore) {
                    WebStore.open("webstore-store")
                }
            })
        })
    }
    var d = $("inventory-button");
    if (d) {
        Event.observe(d, "click", function (n) {
            Event.stop(n);
            loadWebStore(function () {
                if (window.WebStore) {
                    WebStore.open("webstore-inventory")
                }
            })
        })
    }
    var g = $("reporting-button");
    if (g) {
        Element.show(g);
        Event.observe(g, "click", startReportingModeObserver, false);
        Event.observe("stop-reporting-button", "click", stopReportingModeObserver, false)
    }
    var m = $("myhabbo-group-tools-button");
    if (m) {
        GroupEditTools.init(b, m)
    }
    var h = $("group-memberlist");
    if (h) {
        MembersList.init(b, c)
    }
    var j = $("select-favorite-button");
    var e = $("deselect-favorite-button");
    if (j || e) {
        GroupFavoriteSelector.init(null, c, b, function () {
            window.location.replace(window.location.href)
        });
        if (j) {
            Event.observe(j, "click", GroupFavoriteSelector.selectFavorite)
        }
        if (e) {
            Event.observe(e, "click", GroupFavoriteSelector.deselectFavorite)
        }
    }
    if (!!location.hash) {
        var l = location.hash.substring(1).split("/");
        if (h && l[0] == "members") {
            MembersList.open();
            if (l[1] == "pending") {
                MembersList.switchToPending();
                MembersList.loadPending(true)
            }
        }
        if (!!$("group-tools-settings") && window.GroupEditTools) {
            if (l[0] == "settings") {
                openGroupSettings(GroupEditTools.groupId)
            }
        }
    }
}

var startReportingModeObserver = function (b) {
    Event.stop(b);
    var c = $("playground");
    c.select(".report-button").each(function (d) {
        Element.show(d);
        d.style.zIndex = 9998
    });
    $$(".reporting-start").each(function (d) {
        Element.show(d);
        d.style.zIndex = 9998
    });
    c.select(".stickie").each(function (d) {
        Event.observe(d, "click", this.bringToTop.bindAsEventListener(d), false)
    });
    c.select(".RoomsWidget").each(function (d) {
        Event.observe(d, "click", this.bringToTop.bindAsEventListener(d), false)
    });
    c.select(".ProfileWidget").each(function (d) {
        Event.observe(d, "click", this.bringToTop.bindAsEventListener(d), false)
    });
    var a = c.select(".sticker").concat(c.select(".FriendsWidget")).findAll(function (d) {
        return !d.hasClassName("es_dynamic_animator_sticker")
    });
    a.each(function (d) {
        Element.hide(d)
    });
    if (!reportingButtonsObserved) {
        $$(".report-button.report-s").each(function (e) {
            var d = e.id.substring("stickie-".length, e.id.length - "-report".length);
            Event.observe(e, "click", function (f) {
                Event.stop(f);
                ReportDialogManager.show("stickie", d, e)
            }, false)
        });
        $$(".report-button.report-n").each(function (d) {
            var e = d.id.substring("name-".length, d.id.length - "-report".length);
            Event.observe(d, "click", function (f) {
                Event.stop(f);
                ReportDialogManager.show("name", e, d)
            }, false)
        });
        $$(".reporting-start").each(function (d) {
            var e = d.id.substring("url-".length, d.id.length - "-report".length);
            Event.observe(d, "click", function (f) {
                Event.stop(f);
                ReportDialogManager.show("url", e, d)
            }, false)
        });
        $$(".report-button.report-m").each(function (d) {
            var e = d.id.substring("motto-".length, d.id.length - "-report".length);
            Event.observe(d, "click", function (f) {
                Event.stop(f);
                ReportDialogManager.show("motto", e, d)
            }, false)
        });
        $$(".report-button.report-gn").each(function (e) {
            var d = e.id.substring("groupname-".length, e.id.length - "-report".length);
            Event.observe(e, "click", function (f) {
                Event.stop(f);
                ReportDialogManager.show("groupname", d, e)
            }, false)
        });
        $$(".report-button.report-gd").each(function (e) {
            var d = e.id.substring("groupdesc-".length, e.id.length - "-report".length);
            Event.observe(e, "click", function (f) {
                Event.stop(f);
                ReportDialogManager.show("groupdesc", d, e)
            }, false)
        });
        $$(".report-button.report-r").each(function (d) {
            var e = d.id.substring("room-".length, d.id.length - "-report".length);
            Event.observe(d, "click", function (f) {
                Event.stop(f);
                ReportDialogManager.show("room", e, d)
            }, false)
        });
        $$(".es_dynamic_animator_sticker").each(function (d) {
            var f = d.id.substring("sticker-".length);
            var e = Builder.node("img", {
                src: habboStaticFilePath + "/images/myhabbo/buttons/report_button.gif",
                "class": "animator-report-button"
            });
            d.appendChild(e);
            setTimeout(function () {
                Event.observe(e, "click", function (g) {
                    Event.stop(g);
                    ReportDialogManager.show("animator", f, d)
                }, false)
            }, 50)
        });
        reportingButtonsObserved = true
    }
    Element.hide("reporting-button");
    Element.show("stop-reporting-button")
};
var stopReportingModeObserver = function (a) {
    Event.stop(a);
    var b = $("playground");
    b.select(".report-button").each(function (c) {
        Element.hide(c)
    });
    $$(".reporting-start").each(function (c) {
        Element.hide(c)
    });
    reportingZ = 8100;
    b.select(".stickie").each(function (c) {
        Event.stopObserving(c, "click", this.bringToTop, false)
    });
    b.select(".ProfileWidget").each(function (c) {
        Event.stopObserving(c, "click", this.bringToTop, false)
    });
    b.select(".RoomsWidget").each(function (c) {
        Event.stopObserving(c, "click", this.bringToTop, false)
    });
    b.select(".sticker").each(function (c) {
        Element.show(c)
    });
    b.select(".FriendsWidget").each(function (c) {
        Element.show(c)
    });
    $$(".es_dynamic_animator_sticker").each(function (d) {
        var c = d.getElementsByTagName("img");
        if (c.length > 0) {
            Element.remove(c[0])
        }
    });
    for (x in oldZ) {
        el = $(x);
        if (el) {
            el.style.zIndex = oldZ[x]
        }
    }
    oldZ = new Array();
    Element.hide("stop-reporting-button");
    ReportDialogManager.hideAll();
    Element.show("reporting-button");
    Event.observe("reporting-button", "click", startReportingModeObserver, false)
};

function observeAnim() {
    var b = $$(".profile-figure");
    if (b.length > 0) {
        R = 0;
        x1 = 0.1;
        y1 = 0.08;
        x2 = 0.25;
        y2 = 0.24;
        x3 = 1.6;
        y3 = 0.24;
        x4 = 220;
        y4 = 200;
        x5 = 260;
        y5 = 200;
        DI = $("mypage-wrapper").select(".movable");
        DIL = DI.length;
        bckup = new Array();
        for (i = 0; i < DIL; i++) {
            bckup[DI[i].id + "-t"] = DI[i].style.top;
            bckup[DI[i].id + "-l"] = DI[i].style.left
        }
        Event.observe(b[0], "dblclick", function (c) {
            if (R < 100) {
                Event.stop(c);
                for (i = 0; i < DIL; i++) {
                    new Effect.Move(DI[i], {
                        x: parseFloat(Math.sin(R * x1 + i * x2 + x3) * x4 + x5),
                        y: parseFloat(Math.cos(R * y1 + i * y2 + y3) * y4 + y5),
                        mode: "absolute"
                    })
                }
                setTimeout(function () {
                    B = setInterval(a, 10)
                }, 1000)
            }
        })
    }

    function a() {
        for (i = 0; i < DIL; i++) {
            DIS = DI[i].style;
            DIS.left = Math.sin(R * x1 + i * x2 + x3) * x4 + x5 + "px";
            DIS.top = Math.cos(R * y1 + i * y2 + y3) * y4 + y5 + "px"
        }
        R++;
        if (R > 100) {
            clearInterval(B);
            for (i = 0; i < DIL; i++) {
                new Effect.Move(DI[i], {
                    x: parseFloat(bckup[DI[i].id + "-l"]),
                    y: parseFloat(bckup[DI[i].id + "-t"]),
                    mode: "absolute"
                })
            }
        }
    }
}

function letItSnow() {
    var q = new Date();
    var s = q.getMonth();
    var n = q.getDate();
    var h = 11;
    var m = 24;
    var p = 18;
    if (h == q.getMonth() && m == q.getDate() && q.getHours() >= p) {
        var e = 20;
        var g = new Array();
        var u = 850;
        var f = new Array();
        var a = 1400;
        var o = new Array();
        var t = new Array();
        var c = new Array();
        for (i = 0; i < e; i++) {
            var l = "the_stickr_" + i;
            g[i] = u * Math.random();
            f[i] = a * Math.random();
            o[i] = Math.random() * 10 + 5;
            t[i] = Math.random() * 7 + 1;
            c[i] = Math.random() * 2 * Math.PI;
            var j = "";
            if (i % 2 == 0) {
                j = '<div class="the_stickr sticker s_ss_snowflake2" style="left: ' + g[i] + "px; top: " + f[i] + 'px; z-index: 100" id="' + l + '">'
            } else {
                j = '<div class="the_stickr sticker s_ss_snowflake1" style="left: ' + g[i] + "px; top: " + f[i] + 'px; z-index: 100" id="' + l + '">'
            }
            $("playground").insert(j);
            Element.hide($(l));
            new Effect.Appear($(l))
        }
        var r = $("mypage-wrapper").select(".the_stickr");
        var b = 0;
        var k = 0;
        setTimeout(function () {
            k = setInterval(d, 80)
        }, 1000);

        function d() {
            for (i = 0; i < e; i++) {
                g[i] = Math.sin(c[i] + b * 0.1) * o[i] + g[i];
                f[i] = t[i] + f[i];
                if (f[i] > a) {
                    f[i] -= a
                }
                stickrStyle = r[i].style;
                stickrStyle.left = g[i] + "px";
                stickrStyle.top = f[i] + "px"
            }
            b++;
            if (b > 1000) {
                clearInterval(k);
                for (i = 0; i < e; i++) {
                    var v = "the_stickr_" + i;
                    Element.hide($(v))
                }
            }
        }
    }
}

function openGroupActionDialog(j, g, e, c, d, b) {
    var a = "9001";
    if (d != null && d.widgetId != 0) {
        Overlay.show()
    } else {
        Overlay.move("9002");
        a = "9003"
    }
    var f = Dialog.createDialog("group-action-dialog", "", a);
    Dialog.moveDialogToCenter(f);
    Dialog.setAsWaitDialog(f);
    var h = {groupId: c};
    if (e) {
        h.targetAccountId = e
    }
    new Ajax.Request(habboReqPath + j, {
        method: "post", parameters: h, onComplete: function (l, k) {
            Dialog.setDialogBody(f, l.responseText);
            if (!!$("group-action-cancel")) {
                Event.observe($("group-action-cancel"), "click", function (m) {
                    Event.stop(m);
                    hideGroupActionDialog(d)
                })
            }
            if (!!$("group-action-ok")) {
                Event.observe($("group-action-ok"), "click", function (m) {
                    Event.stop(m);
                    Dialog.setAsWaitDialog(f);
                    var n = {groupId: c};
                    if (e) {
                        n.targetAccountId = e
                    }
                    new Ajax.Request(habboReqPath + g, {
                        method: "post", parameters: n, onComplete: function (q, p) {
                            var o = true;
                            if (b) {
                                o = b(q, p)
                            }
                            if (o) {
                                Dialog.setDialogBody(f, q.responseText);
                                q.responseText.evalScripts();
                                if (!!$("group-action-cancel")) {
                                    Event.observe($("group-action-cancel"), "click", function (r) {
                                        Event.stop(r);
                                        hideGroupActionDialog(d)
                                    })
                                }
                            }
                        }
                    })
                })
            }
        }
    })
}

function openGroupJoinDialog(a, c) {
    var d = "9001";
    Overlay.show();
    var b = Dialog.createDialog("group-action-dialog", "", d);
    Dialog.moveDialogToCenter(b);
    Dialog.setAsWaitDialog(b);
    new Ajax.Request(habboReqPath + a, {
        method: "post", parameters: {groupId: c}, onComplete: function (f, e) {
            Dialog.setDialogBody(b, f.responseText);
            if ($("error-action-cancel")) {
                Event.observe($("error-dialog-cancel"), "click", function (g) {
                    Event.stop(g);
                    hideGroupActionDialog()
                })
            }
            if ($("group-action-ok")) {
                Event.observe($("group-action-ok"), "click", function (g) {
                    Event.stop(g);
                    window.location.replace(window.location.href)
                })
            }
            f.responseText.evalScripts()
        }
    })
}

function addGroupActionEventHandler(c, e, g, a, h, b, f, d) {
    Event.observe(c, e, function (j) {
        Event.stop(j);
        openGroupActionDialog(g, a, h, b, f, d)
    })
}

function hideGroupActionDialog(a) {
    $("group-action-dialog").remove();
    if (a != null && a.widgetId != null && a.widgetId != 0) {
        Overlay.hide()
    } else {
        Overlay.move("9000")
    }
}

function showGroupSettingsConfirmation(c) {
    if ($("group-settings-update-button").hasClassName("disabled")) {
        return
    }
    $("group-settings-update-button").addClassName("disabled");
    var d = Form.getInputs($("group-settings-form"), "radio", "group_type").find(function (j) {
        return j.checked
    }).value;
    var a = Form.getInputs($("group-settings-form"), "radio", "forum_type").find(function (j) {
        return j.checked
    }).value;
    var h = Form.getInputs($("group-settings-form"), "radio", "new_topic_permission").find(function (j) {
        return j.checked
    }).value;
    var b = $F("initial_group_type");
    var g = $F("group_url_edited");
    var f = $F("group_url");
    var g = $F("group_url_edited");
    var e = {url: f, groupId: c};
    if (f == "" || g == 0) {
        confirmAndUpdateGroupSettings(c)
    } else {
        new Ajax.Request(habboReqPath + "/ajax_habblet/actions/check_group_url.php", {
            method: "post", parameters: e, onComplete: function (n, m) {
                var o = Dialog.createDialog("group-url-confirmation", L10N.get("group.settings.title.text"), "9003", 0, -1000, cancelGroupSettingsConfirmation);
                var l = Builder.node("a", {
                    href: "#",
                    className: "new-button"
                }, [Builder.node("b", L10N.get("myhabbo.groups.confirmation_ok")), Builder.node("i")]);
                var p = Builder.node("a", {
                    href: "#",
                    className: "new-button"
                }, [Builder.node("b", L10N.get("myhabbo.groups.confirmation_cancel")), Builder.node("i")]);
                var k = n.responseText;
                var j = k.match(/(^ERROR\s)(.+$)/);
                if (j == null) {
                    Dialog.appendDialogBody(o, Builder.node("p", k));
                    Dialog.appendDialogBody(o, p);
                    Dialog.appendDialogBody(o, l)
                } else {
                    k = j[2];
                    Dialog.appendDialogBody(o, Builder.node("p", k));
                    Dialog.appendDialogBody(o, p)
                }
                Event.observe(p, "click", function (q) {
                    Event.stop(q);
                    Element.remove("group-url-confirmation");
                    $("group-settings-update-button").removeClassName("disabled");
                    Overlay.move("9001")
                }, false);
                Event.observe(l, "click", function (q) {
                    Element.remove("group-url-confirmation");
                    confirmAndUpdateGroupSettings(c)
                });
                Overlay.move("9002");
                o.style.zIndex = "9003";
                Dialog.moveDialogToCenter(o)
            }
        })
    }
}

function cancelGroupSettingsConfirmation() {
    Element.remove("group-settings-confirmation");
    $("group-settings-update-button").removeClassName("disabled");
    Overlay.move("9001")
}

function confirmAndUpdateGroupSettings(b) {
    var c = Form.getInputs($("group-settings-form"), "radio", "group_type").find(function (e) {
        return e.checked
    }).value;
    var a = $("initial_group_type").value;
    if (c != a) {
        var d = ["normal", "exclusive", "closed", "large"];
        Dialog.showConfirmDialog(L10N.get("group.settings.group_type_change_warning." + d[parseInt(c)]), {
            okHandler: function () {
                Element.remove($(this.dialogId));
                Overlay.hide();
                updateGroupSettings(b)
            },
            cancelHandler: function () {
                $("group-settings-update-button").removeClassName("disabled")
            },
            headerText: L10N.get("group.settings.title.text"),
            buttonText: L10N.get("myhabbo.groups.confirmation_ok"),
            cancelButtonText: L10N.get("myhabbo.groups.confirmation_cancel")
        })
    } else {
        updateGroupSettings(b)
    }
}

function updateGroupSettings(a) {
    new Ajax.Request(habboReqPath + "/ajax_habblet/actions/update_group_settings.php", {
        parameters: {
            name: $F("group_name"),
            description: $F("group_description"),
            groupId: a,
            type: Form.getInputs($("group-settings-form"), "radio", "group_type").find(function (b) {
                return b.checked
            }).value,
            url: $F("group_url"),
            forumType: Form.getInputs($("group-settings-form"), "radio", "forum_type").find(function (b) {
                return b.checked
            }).value,
            newTopicPermission: Form.getInputs($("group-settings-form"), "radio", "new_topic_permission").find(function (b) {
                return b.checked
            }).value,
            roomId: Form.getInputs($("group-settings-form"), "radio", "roomId").find(function (b) {
                return b.checked
            }).value
        }, onComplete: function (c) {
            var b = $("dialog-group-settings");
            if (c.responseText.indexOf("group-settings-form") < 0) {
                Overlay.move("9002");
                b = Dialog.createDialog("group_settings_result", L10N.get("group.settings.title.text"), "9003", 0, -1000, closeGroupSettings);
                b.style.zIndex = "9003"
            } else {
                Overlay.move("9001")
            }
            Dialog.setDialogBody(b, c.responseText);
            Dialog.moveDialogToCenter(b)
        }
    })
}

function closeGroupSettings() {
    var a = $("dialog-group-settings");
    a.style.left = "-1500px";
    a.hide();
    Element.wait($("dialog-group-settings-body"));
    Overlay.hide()
}

function openGroupSettings(b) {
    var a = $("dialog-group-settings");
    a.show();
    a.style.zIndex = "9001";
    new Ajax.Updater("dialog-group-settings-body", habboReqPath + "/ajax_habblet/actions/group_settings.php", {
        parameters: {groupId: b},
        evalScripts: true,
        method: "post"
    });
    Overlay.show();
    Dialog.moveDialogToCenter(a);
    $A(["group", "forum", "room"]).each(function (d) {
        var c = $("group-settings-link-" + d);
        if (c) {
            c.observe("click", function (f) {
                switchGroupSettingsTab(f, d)
            })
        }
    })
}

function switchGroupSettingsTab(c, a) {
    if (!!c) {
        Event.stop(c)
    }
    var b = $("group-settings-link-" + a);
    if (!b.hasClassName("selected")) {
        $A(["group", "forum", "room"]).without(a).each(function (e) {
            var d = $("group-settings-link-" + e);
            if (d) {
                d.removeClassName("selected");
                $(e + "-settings").hide()
            }
        });
        b.addClassName("selected");
        $(a + "-settings").show()
    }
}

var MembersList = {
    init: function (a, b) {
        MembersList.groupId = a;
        MembersList.myUserId = b;
        MembersList.selected = "members";
        MembersList.targetPageNumber = 1;
        MembersList.dialog = $("group-memberlist");
        MembersList.membersDiv = $("group-memberlist-members");
        MembersList.pendingDiv = $("group-memberlist-pending");
        MembersList.memberButtonsDiv = $("group-memberlist-members-buttons");
        MembersList.pendingButtonsDiv = $("group-memberlist-pending-buttons");
        MembersList.searchButton = $("group-memberlist-members-search-button");
        MembersList.largeGroup = MembersList.searchButton.hasClassName("large-group");
        Element.hide(MembersList.dialog);
        Element.hide(MembersList.membersDiv);
        if (MembersList.pendingDiv) {
            Element.hide(MembersList.pendingDiv)
        }
        Element.hide(MembersList.memberButtonsDiv);
        if (MembersList.pendingButtonsDiv) {
            Element.hide(MembersList.pendingButtonsDiv)
        }
        MembersList.loadingMembers = false;
        MembersList.loadingPending = false;
        MembersList.loadedMembers = 0;
        MembersList.loadedPending = 0;
        Event.observe("group-memberlist-link-members", "click", function (c) {
            Event.stop(c);
            if (MembersList.selected != "members") {
                MembersList.switchToMembers();
                if (new Date().getTime() - MembersList.loadedMembers > 10000) {
                    MembersList.loadMembers(true, 1)
                }
            }
        });
        if (MembersList.pendingDiv) {
            Event.observe("group-memberlist-link-pending", "click", function (c) {
                Event.stop(c);
                if (MembersList.selected != "pending") {
                    MembersList.switchToPending();
                    if (new Date().getTime() - MembersList.loadedPending > 10000) {
                        MembersList.loadPending(true)
                    }
                }
            })
        }
        Event.observe(MembersList.memberButtonsDiv, "click", function (c) {
            Event.stop(c);
            MembersList.processButtons(c)
        });
        if (MembersList.pendingButtonsDiv) {
            Event.observe(MembersList.pendingButtonsDiv, "click", function (c) {
                Event.stop(c);
                MembersList.processButtons(c)
            })
        }
        Event.observe($("group-memberlist-exit"), "click", function (c) {
            Event.stop(c);
            MembersList.close()
        });
        Event.observe(MembersList.searchButton, "click", function (c) {
            Event.stop(c);
            MembersList.processSearch(c)
        });
        Event.observe("group-memberlist-members-search-string", "keypress", function (c) {
            if (c.keyCode == Event.KEY_RETURN) {
                MembersList.processSearch(c)
            }
        })
    }, open: function () {
        Overlay.show();
        Element.show(MembersList.dialog);
        Dialog.moveDialogToCenter(MembersList.dialog);
        if (MembersList.selected == "pending") {
            MembersList.switchToPending();
            MembersList.loadPending(true)
        } else {
            MembersList.switchToMembers();
            MembersList.loadMembers(true, 1)
        }
    }, close: function () {
        MembersList.dialog.style.left = "-1500px";
        Element.hide(MembersList.dialog);
        Overlay.hide()
    }, switchToMembers: function () {
        Element.hide("group-memberlist-" + MembersList.selected);
        Element.hide("group-memberlist-" + MembersList.selected + "-buttons");
        Element.removeClassName("group-memberlist-link-" + MembersList.selected, "selected");
        Element.show("group-memberlist-members");
        Element.show("group-memberlist-members-buttons");
        Element.addClassName("group-memberlist-link-members", "selected");
        MembersList.selected = "members"
    }, switchToPending: function () {
        Element.hide("group-memberlist-" + MembersList.selected);
        Element.hide("group-memberlist-" + MembersList.selected + "-buttons");
        Element.removeClassName("group-memberlist-link-" + MembersList.selected, "selected");
        Element.show("group-memberlist-pending");
        Element.show("group-memberlist-pending-buttons");
        Element.addClassName("group-memberlist-link-pending", "selected");
        MembersList.selected = "pending"
    }, loadMembers: function (b, c) {
        if (!MembersList.loadingMembers) {
            Element.wait(MembersList.membersDiv);
            MembersList.loadingMembers = true;
            var a = $F("group-memberlist-members-search-string");
            if (a == null) {
                a = ""
            }
            new Ajax.Updater("group-memberlist-members", habboReqPath + "/ajax_habblet/actions/memberlist", {
                method: "post",
                parameters: {pageNumber: c, groupId: MembersList.groupId, searchString: a},
                onComplete: function (e, d) {
                    if (b) {
                        MembersList.updateTitles(d.members, d.pending)
                    }
                    MembersList.loadingMembers = false;
                    MembersList.loadedMembers = new Date().getTime();
                    if ($("member-list-paging")) {
                        Event.observe($("member-list-paging"), "click", function (f) {
                            Event.stop(f);
                            MembersList.processSearch(f)
                        })
                    }
                    Event.observe(MembersList.membersDiv, "click", function (g) {
                        var f = Event.element(g);
                        if (f.nodeName.toLowerCase() == "input") {
                            MembersList.clickCheckbox();
                            return
                        }
                        f = Event.findElement(g, "li");
                        if (f && f.id && f.id.lastIndexOf("-") != -1) {
                            var h = parseFloat(f.id.substring(f.id.lastIndexOf("-") + 1));
                            if (h > 0) {
                                MembersList.loadAvatarInfo(h)
                            }
                            return
                        }
                    })
                }
            })
        }
    }, loadPending: function (a) {
        if (!MembersList.loadingPending) {
            Element.wait(MembersList.pendingDiv);
            MembersList.loadingPending = true;
            new Ajax.Updater("group-memberlist-pending", habboReqPath + "/ajax_habblet/actions/memberlist", {
                method: "post",
                parameters: {groupId: MembersList.groupId, pending: "true"},
                onComplete: function (c, b) {
                    if (a) {
                        MembersList.updateTitles(b.members, b.pending)
                    }
                    MembersList.loadingPending = false;
                    MembersList.loadedPending = new Date().getTime();
                    Event.observe(MembersList.pendingDiv, "click", function (f) {
                        var d = Event.element(f);
                        if (d.nodeName.toLowerCase() == "input") {
                            MembersList.clickCheckbox();
                            return
                        }
                        d = Event.findElement(f, "li");
                        if (d && d.id && d.id.lastIndexOf("-") != -1) {
                            var g = parseFloat(d.id.substring(d.id.lastIndexOf("-") + 1));
                            if (g > 0) {
                                MembersList.loadAvatarInfo(g)
                            }
                            return
                        }
                    })
                }
            })
        }
    }, loadAvatarInfo: function (a) {
        var c = $("group-memberlist-avatarinfo-" + a);
        var b = c.parentNode;
        if (c.innerHTML == "") {
            Element.wait(c);
            Element.show(c);
            Element.addClassName(b, "group-memberlist-opened");
            new Ajax.Request(habboReqPath + "/ajax_habblet/actions/memberlist_avatarinfo", {
                method: "post",
                parameters: {theAccountId: a, groupId: MembersList.groupId},
                onComplete: function (e, d) {
                    c.innerHTML = e.responseText;
                    c.style.display = "block";
                    Element.addClassName($("group-memberlist-member-" + a), "group-memberlist-opened")
                }
            })
        } else {
            if (!Element.visible(c)) {
                c.style.display = "block";
                Element.addClassName(b, "group-memberlist-opened")
            } else {
                c.style.display = "none";
                Element.removeClassName(b, "group-memberlist-opened")
            }
        }
    }, updateTitles: function (b, a) {
        ($("group-memberlist-link-members").getElementsByTagName("a"))[0].innerHTML = b;
        if ($("group-memberlist-link-pending")) {
            ($("group-memberlist-link-pending").getElementsByTagName("a"))[0].innerHTML = a
        }
    }, processButtons: function (b) {
        var a = Event.findElement(b, "a");
        if (a) {
            if (!Element.hasClassName(a, "group-memberlist-button-disabled")) {
                var c = a.id;
                if (c.indexOf("-close") != -1) {
                    MembersList.close()
                } else {
                    if (c == "group-memberlist-button-remove") {
                        MembersList.confirm("remove")
                    } else {
                        if (c == "group-memberlist-button-give-rights") {
                            MembersList.confirm("give_rights")
                        } else {
                            if (c == "group-memberlist-button-revoke-rights") {
                                MembersList.confirm("revoke_rights")
                            } else {
                                if (c == "group-memberlist-button-accept") {
                                    MembersList.confirm("accept")
                                } else {
                                    if (c == "group-memberlist-button-decline") {
                                        MembersList.confirm("decline")
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }, processSearch: function (g) {
        var c = Event.element(g);
        if (c.id == "member-list-paging") {
            return
        }
        var b = $F("group-memberlist-members-search-string");
        if (b == null) {
            b = ""
        }
        if (MembersList.largeGroup && (b.length > 0 && b.length < 3)) {
            $("group-memberlist-search-info").addClassName("error")
        }
        var a = parseInt($F("pageNumberMemberList"));
        if (a == null) {
            a = 1
        }
        var f = parseInt($F("totalPagesMemberList"));
        if (f == null) {
            f = 0
        }
        var d = 1;
        if (c.id == "memberlist-search-first") {
            d = 1
        } else {
            if (c.id == "memberlist-search-previous") {
                d = a - 1
            } else {
                if (c.id == "memberlist-search-next") {
                    d = a + 1
                } else {
                    if (c.id == "memberlist-search-last") {
                        d = f
                    }
                }
            }
        }
        MembersList.loadMembers(true, d)
    }, clickCheckbox: function () {
        if (MembersList.selected == "members") {
            var c = false;
            var b = false;
            var f = MembersList.myUserId;
            var d = false;
            $A(MembersList.membersDiv.getElementsByTagName("input")).each(function (a) {
                if (a.checked) {
                    if (a.id.substring(17, 18) == "a") {
                        c = true
                    } else {
                        b = true
                    }
                    if (a.id.substring(a.id.lastIndexOf("-") + 1) == f) {
                        d = true
                    }
                }
            });
            if (c && b) {
                MembersList.disableButton("give-rights");
                MembersList.disableButton("revoke-rights");
                MembersList.enableButton("remove")
            } else {
                if (!c && !b) {
                    MembersList.disableButton("give-rights");
                    MembersList.disableButton("revoke-rights");
                    MembersList.disableButton("remove")
                } else {
                    if (c) {
                        MembersList.disableButton("give-rights");
                        MembersList.enableButton("revoke-rights");
                        MembersList.enableButton("remove")
                    } else {
                        if (b) {
                            MembersList.enableButton("give-rights");
                            MembersList.disableButton("revoke-rights");
                            MembersList.enableButton("remove")
                        }
                    }
                }
            }
            if (d) {
                MembersList.disableButton("revoke-rights");
                MembersList.disableButton("remove")
            }
        } else {
            if (MembersList.selected == "pending") {
                var e = false;
                $A(MembersList.pendingDiv.getElementsByTagName("input")).each(function (a) {
                    if (a.checked) {
                        e = true;
                        throw $break
                    }
                });
                if (e) {
                    MembersList.enableButton("accept");
                    MembersList.enableButton("decline")
                } else {
                    MembersList.disableButton("accept");
                    MembersList.disableButton("decline")
                }
            }
        }
    }, enableButton: function (a) {
        Element.removeClassName($("group-memberlist-button-" + a), "group-memberlist-button-disabled");
        Element.addClassName($("group-memberlist-button-" + a), "group-memberlist-button")
    }, disableButton: function (a) {
        Element.removeClassName($("group-memberlist-button-" + a), "group-memberlist-button");
        Element.addClassName($("group-memberlist-button-" + a), "group-memberlist-button-disabled")
    }, confirm: function (b) {
        var d = [];
        var a = (MembersList.selected == "pending") ? MembersList.pendingDiv : MembersList.membersDiv;
        $A(a.getElementsByTagName("input")).each(function (e) {
            if (e.checked) {
                d.push(e.id.substring(e.id.lastIndexOf("-") + 1))
            }
        });
        if (d.length > 0) {
            Overlay.move("9002");
            var c = Dialog.createDialog("group-memberlist-action-dialog", "", "9003");
            Dialog.moveDialogToCenter(c);
            Dialog.setAsWaitDialog(c);
            new Ajax.Request(habboReqPath + "/ajax_habblet/actions/batch/confirm_" + b, {
                method: "post", parameters: {groupId: MembersList.groupId, targetIds: d}, onComplete: function (f, e) {
                    Dialog.setDialogBody(c, f.responseText);
                    if ($("error-dialog-cancel")) {
                        Event.observe($("error-dialog-cancel"), "click", function (g) {
                            Event.stop(g);
                            MembersList.closeConfirmationDialog()
                        })
                    }
                    if ($("group-action-cancel")) {
                        Event.observe($("group-action-cancel"), "click", function (g) {
                            Event.stop(g);
                            MembersList.closeConfirmationDialog()
                        })
                    }
                    if ($("group-action-ok")) {
                        Event.observe($("group-action-ok"), "click", function (g) {
                            Event.stop(g);
                            Dialog.setAsWaitDialog(c);
                            new Ajax.Request(habboReqPath + "/ajax_habblet/actions/batch/" + b, {
                                method: "post",
                                parameters: {groupId: MembersList.groupId, targetIds: d},
                                onComplete: function (j, h) {
                                    if (j.responseText == "OK") {
                                        MembersList.closeConfirmationDialog();
                                        if (MembersList.selected == "pending") {
                                            MembersList.loadPending(true)
                                        } else {
                                            MembersList.loadMembers(true, 1)
                                        }
                                    } else {
                                        Dialog.setDialogBody(c, j.responseText);
                                        Event.observe($("error-dialog-cancel"), "click", function (k) {
                                            Event.stop(k);
                                            MembersList.closeConfirmationDialog()
                                        })
                                    }
                                }
                            })
                        })
                    }
                }
            })
        }
    }, closeConfirmationDialog: function () {
        Element.remove("group-memberlist-action-dialog");
        Overlay.move("9000")
    }
};

function openGroupBadgeEditor(b) {
    var a = Dialog.createDialog("badge-editor-dialog", "", "9003", null, null, closeBadgeEditor);
    Dialog.makeDialogDraggable(a);
    Overlay.show();
    Overlay.hideIfMacFirefox();
    Dialog.moveDialogToCenter(a);
    Dialog.setAsWaitDialog(a);
    a.show();
    a.style.zIndex = "9001";
    new Ajax.Updater("badge-editor-dialog-body", habboReqPath + "/ajax_habblet/actions/show_badge_editor.php", {
        parameters: {groupId: b},
        evalScripts: true,
        method: "post",
        onComplete: function (d, c) {
            Dialog.setDialogBody(a, d.responseText)
        }
    })
}

function closeBadgeEditor(a) {
    Overlay.hide();
    if (a != null) {
        Event.stop(a)
    }
    Element.remove("badge-editor-dialog")
}

function loadWebStore(a) {
    ScriptLoader.load("myhabbo-store", {callback: a || null})
}

function initDraggableDialogs() {
    $$(".topdialog").each(function (a) {
        var b = "title";
        if (!a.down("." + b, 0)) {
            b = "box-tabs"
        }
        new Draggable(a, {
            handle: b,
            starteffect: Prototype.emptyFunction,
            endeffect: Prototype.emptyFunction,
            zindex: 9100
        })
    })
}

function isNotWithinPlayground(b) {
    var f = $("playground");
    if (!f) {
        return false
    }
    var e = f.cumulativeOffset();
    var c = Element.getDimensions(f);
    var a = b.cumulativeOffset();
    var d = Element.getDimensions(b);
    return !(Position.within(f, a[0], a[1]) && Position.within(f, a[0] + d.width, a[1] + d.height))
}

function offsetToPlayground(b) {
    var f = $("playground");
    if (!f) {
        return 0
    }
    var e = f.cumulativeOffset();
    var c = Element.getDimensions(f);
    var a = b.cumulativeOffset();
    var d = Element.getDimensions(b);
    return e[0] + c.width - a[0] - d.width
}

function getElementsInInvalidPositions() {
    var a = [];
    $("playground").select(".movable").each(function (b) {
        if (isNotWithinPlayground(b)) {
            a.push(b)
        }
    });
    return a
}

function repositionInvalidItems() {
    var g = $("playground");
    if (!g) {
        return
    }
    var e = g.getDimensions();
    var a = getElementsInInvalidPositions();
    for (var d = 0; d < a.length; d++) {
        var c = a[d].cumulativeOffset();
        var f = a[d].getDimensions();
        if (c.top + f.height > e.height) {
            var b = e.height - f.height;
            a[d].setStyle({top: b + "px"})
        }
    }
}

var Discussions = {
    initialized: false,
    groupdId: null,
    groupUrl: null,
    topicId: null,
    baseParams: null,
    redirectLocation: null,
    captchaPublicKey: "none",
    initialize: function (c, a, b) {
        if (!Discussions.initialized) {
            Discussions.initialized = true;
            Discussions.groupdId = c;
            if (Discussions.groupdId) {
                Discussions.baseParams = "groupId=" + Discussions.groupdId;
                Discussions.redirectLocation = habboReqPath + "/ajax_habblet/" + Discussions.groupdId + "/id/discussions"
            }
            Discussions.groupUrl = a;
            if (Discussions.groupUrl) {
                Discussions.redirectLocation = habboReqPath + "/ajax_habblet/" + Discussions.groupUrl + "/discussions"
            }
            Discussions.topicId = b;
            if (Discussions.topicId) {
                Discussions.baseParams += "&topicId=" + Discussions.topicId
            }
            if ($("group-postlist-container")) {
                Event.observe($("group-postlist-container"), "click", Discussions.handleActions)
            }
            if ($("group-topiclist-container")) {
                Event.observe($("group-topiclist-container"), "click", Discussions.handleActions)
            }
        }
    },
    handleActions: function (j) {
        var f = Event.element(j);
        if (f.up("a.new-button")) {
            f = f.up("a.new-button")
        }
        if (f.className == "delete-button delete-post") {
            Event.stop(j);
            var d = f.id.substring("delete-post-".length);
            Discussions.removeEntry(d)
        } else {
            if (f.hasClassName("report-post")) {
                Event.stop(j);
                var d = f.id.substring("report-post-".length);
                ReportDialogManager.show("discussionpost", d, f, {
                    setWidth: false,
                    setHeight: false,
                    offsetTop: 0,
                    offsetLeft: -120
                })
            } else {
                if (f.id == "edit-topic-settings") {
                    Event.stop(j);
                    Discussions.openTopicSettings()
                } else {
                    if (f.id == "post-form-preview") {
                        Event.stop(j);
                        Discussions.previewPost()
                    } else {
                        if (f.id == "post-form-save" || f.id == "post-form-save-preview") {
                            Event.stop(j);
                            if (!f.hasClassName("disabled-button")) {
                                Discussions.savePost()
                            }
                        } else {
                            if (f.id == "post-form-cancel" || f.id == "post-form-cancel-preview") {
                                Event.stop(j);
                                Discussions.cancelPost()
                            } else {
                                if (f.id == "topic-form-preview") {
                                    Event.stop(j);
                                    Discussions.previewTopic()
                                } else {
                                    if (f.id == "topic-form-save" || f.id == "topic-form-save-preview") {
                                        Event.stop(j);
                                        if (!f.hasClassName("disabled-button")) {
                                            Discussions.saveTopic()
                                        }
                                    } else {
                                        if (f.id == "topic-form-cancel" || f.id == "topic-form-cancel-preview") {
                                            Event.stop(j);
                                            Discussions.cancelTopic()
                                        } else {
                                            if (f.id == "captcha-reload-link" || f.id == "recaptcha-reload-link") {
                                                Event.stop(j);
                                                Discussions.reloadCaptcha()
                                            } else {
                                                if (f.className.search("verify-email") > -1) {
                                                    Event.stop(j);
                                                    var b = f.id;
                                                    var g = $("email-verfication-ok").value;
                                                    var h = $("postentry-verifyemail-dialog");
                                                    var c = function (k) {
                                                        Event.stopObserving($("postentry-verifyemail-dialog-exit"), "click", c);
                                                        Element.hide("postentry-verifyemail-dialog");
                                                        Overlay.hide()
                                                    };
                                                    if (g == 0) {
                                                        Overlay.show();
                                                        Dialog.moveDialogToCenter($("postentry-verifyemail-dialog"));
                                                        Element.show("postentry-verifyemail-dialog");
                                                        Event.observe($("postentry-verifyemail-dialog-exit"), "click", c);
                                                        Event.observe($("postentry-verifyemail-ok"), "click", c)
                                                    } else {
                                                        if (f.id.search("quote-post") > -1) {
                                                            var a = f.id.substring("quote-post-".length, f.id.length - "-message".length);
                                                            Discussions.quotePost(a)
                                                        } else {
                                                            if (f.id.search("edit-post") > -1) {
                                                                var a = f.id.substring("edit-post-".length, f.id.length - "-message".length);
                                                                Discussions.editPost(a)
                                                            } else {
                                                                if (f.id.search("create-post") > -1) {
                                                                    Discussions.createPost()
                                                                } else {
                                                                    if (f.id == "newtopic-upper" || f.id == "newtopic-lower") {
                                                                        Discussions.createTopic()
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    },
    showEditElements: function () {
        if ($("new-topic-entry-label")) {
            Element.show("new-topic-entry-label")
        }
        if ($("new-post-entry-message")) {
            Element.show("new-post-entry-message");
            $("post-message").focus();
            Element.scrollTo("post-message")
        }
        Discussions.showCaptcha()
    },
    hideEditElements: function () {
        if ($("new-topic-entry-label")) {
            Element.hide("new-topic-entry-label")
        }
        Element.hide("new-post-entry-message")
    },
    showCaptcha: function () {
        if ($("recaptcha_challenge")) {
            Utils.showRecaptcha("recaptcha_challenge", Discussions.captchaPublicKey)
        }
        Discussions.swapCaptcha($("discussion-captcha-preview"), $("discussion-captcha"))
    },
    showCaptchaPreview: function () {
        Discussions.swapCaptcha($("discussion-captcha"), $("discussion-captcha-preview"))
    },
    swapCaptcha: function (b, a) {
        if (b && b.innerHTML != "" && a) {
            a.innerHTML = b.innerHTML;
            b.innerHTML = "";
            Discussions.reloadCaptcha();
            $("captcha-code-error").update()
        }
    },
    removeEntry: function (f) {
        offsets = $("delete-post-" + f).cumulativeOffset();
        var d = $("postentry-delete-dialog");
        d.absolutize();
        var b = $("group-postlist-list").scrollTop;
        d.style.top = (offsets[1] - b) + "px";
        d.style.left = (offsets[0] - 250) + "px";
        var a = function (g) {
            Event.stopObserving($("postentry-delete-cancel"), "click", a);
            Element.hide("postentry-delete-dialog")
        };
        Event.observe($("postentry-delete-cancel"), "click", a);
        var c = function (g) {
            Event.stopObserving($("postentry-delete-dialog-exit"), "click", c);
            Element.hide("postentry-delete-dialog")
        };
        Event.observe($("postentry-delete-dialog-exit"), "click", c);
        var e = function (g) {
            Event.stopObserving($("postentry-delete"), "click", e);
            Discussions.deletePost(f);
            Element.hide("postentry-delete-dialog")
        };
        Event.observe($("postentry-delete"), "click", e);
        Element.show("postentry-delete-dialog")
    },
    editPost: function (a) {
        Discussions.showEditElements();
        var b = $(a + "-message");
        var c = $("post-message");
        $("edit-type").value = "update";
        $("post-id").value = a;
        c.value = b.value
    },
    quotePost: function (a) {
        Discussions.showEditElements();
        var c = $(a + "-message");
        var b = $("post-message");
        b.value = "[quote]" + c.value + "[/quote]";
        $("edit-type").value = "new"
    },
    cancelPost: function () {
        Discussions.hideEditElements();
        if ($("create-post-message")) {
            Element.show("create-post-message")
        }
        if ($("create-post-message-lower")) {
            Element.show("create-post-message-lower")
        }
        if ($("new-post-preview")) {
            Element.hide("new-post-preview")
        }
        Pinger.stop()
    },
    cancelTopic: function () {
        location.href = Discussions.redirectLocation
    },
    createPost: function () {
        $("post-message").value = "";
        $("post-id").value = null;
        Discussions.showEditElements();
        if ($("create-post-message")) {
            Element.hide("create-post-message")
        }
        if ($("create-post-message-lower")) {
            Element.hide("create-post-message-lower")
        }
        Pinger.start()
    },
    createTopic: function () {
        var a = Discussions.baseParams;
        new Ajax.Updater("group-topiclist-container", "/ajax_habblet/newtopic.php", {
            method: "post",
            evalScripts: true,
            parameters: a,
            onComplete: function (c, b) {
                if (b && b.forbidden == "true") {
                    $("discussionbox").innerHTML = c.responseText;
                    return
                }
                Discussions.showEditElements();
                if ($("new-topic-name")) {
                    $("new-topic-name").focus()
                }
                Pinger.start()
            }
        })
    },
    previewPost: function () {
        Discussions.preview(null)
    },
    previewTopic: function () {
        $("topic-name-error").update();
        var a = encodeURIComponent($("new-topic-name").value);
        Discussions.preview(a)
    },
    preview: function (b) {
        var c = encodeURIComponent($("post-message").value);
        var d = Discussions.baseParams + "&message=" + c;
        var a = "post";
        if (b != null) {
            a = "topic";
            d += "&topicName=" + b
        }
        new Ajax.Updater("new-" + a + "-preview", habboReqPath + "/ajax_habblet/previewpost.php?x=" + a, {
            method: "post",
            parameters: d,
            onComplete: function (f, e) {
                Discussions.hideEditElements();
                Discussions.showCaptchaPreview();
                Element.show("new-" + a + "-preview");
                if (e && e.forbidden == "true") {
                    return
                }
                Event.observe("edit-post-message", "click", function (g) {
                    Event.stop(g);
                    Element.hide("new-" + a + "-preview");
                    Discussions.showEditElements()
                }, false)
            }
        })
    },
    reloadCaptcha: function () {
        if ($("recaptcha_challenge")) {
            Utils.reloadRecaptcha();
            $("recaptcha_response_field").value = ""
        } else {
            Utils.reloadCaptcha();
            $("captcha-code").value = ""
        }
    },
    checkCaptcha: function () {
        var b;
        if ($("recaptcha_challenge")) {
            b = $("recaptcha_response_field")
        } else {
            b = $("captcha-code")
        }
        if (!b) {
            return true
        }
        var a = b.value;
        if (a.length == 0) {
            Discussions.showErrorBubble("captcha-code-error", L10N.get("register.error.security_code"));
            b.focus();
            return false
        }
        return true
    },
    savePost: function () {
        if (!Discussions.checkCaptcha()) {
            return
        }
        Element.hide("post-form-save");
        Discussions.save(null)
    },
    saveTopic: function () {
        var a = encodeURIComponent($("new-topic-name").value.replace(/^\s+|\s+$/, ""));
        if (a.length == 0) {
            Element.hide("new-topic-preview");
            Discussions.showEditElements();
            Discussions.showErrorBubble("topic-name-error", L10N.get("myhabbo.discussion.error.topic_name_empty"));
            return
        }
        if (!Discussions.checkCaptcha()) {
            return
        }
        Element.hide("topic-form-save");
        Discussions.save(a)
    },
    save: function (a) {
        var e = "";
        if ($("recaptcha_challenge")) {
            var j = "";
            if ($("recaptcha_challenge_field")) {
                j = $("recaptcha_challenge_field").value
            }
            e = "&recaptcha_challenge_field=" + j + "&recaptcha_response_field=" + $("recaptcha_response_field").value
        } else {
            if ($("captcha-code")) {
                e = "&captcha=" + $("captcha-code").value
            }
        }
        var h = encodeURIComponent($("post-message").value);
        var c = Discussions.baseParams + "&message=" + h + e;
        var g = "post";
        var d;
        if (a != null) {
            g = "topic";
            c += "&topicName=" + a;
            d = habboReqPath + "/ajax_habblet/savetopic.php"
        } else {
            var b = $("edit-type").value;
            var f = $("current-page").value;
            if (b == "update") {
                d = habboReqPath + "/discussions/actions/updatepost";
                c += "&postId=" + $("post-id").value
            } else {
                d = habboReqPath + "/discussions/actions/savepost";
                f = -1
            }
            c += "&page=" + f
        }
        new Ajax.Request(d, {
            method: "post", parameters: c, onComplete: function (m, l) {
                var n = $("spam-message").value;
                if (l && l.spam == "true") {
                    m.responseText.evalScripts();
                    Element.hide("new-" + g + "-preview");
                    Discussions.showEditElements()
                } else {
                    if (l && l.forbidden == "true") {
                        $("discussionbox").innerHTML = m.responseText;
                        return
                    } else {
                        if (l && l.captchaError == "true") {
                            Discussions.reloadCaptcha();
                            if (g == "post") {
                                Element.show("post-form-save")
                            } else {
                                Element.show("topic-form-save")
                            }
                            Discussions.showErrorBubble("captcha-code-error", L10N.get("register.error.security_code"));
                            if ($("recaptcha_challenge")) {
                                $("recaptcha_response_field").focus()
                            } else {
                                $("captcha-code").focus()
                            }
                        } else {
                            if (g == "post") {
                                $("group-postlist-container").innerHTML = m.responseText;
                                m.responseText.evalScripts()
                            } else {
                                if (g == "topic") {
                                    var k = m.responseText;
                                    if (k != null && k.startsWith("/groups")) {
                                        document.location = k
                                    } else {
                                        $("group-topiclist-container").innerHTML = m.responseText
                                    }
                                }
                            }
                        }
                    }
                }
                Pinger.stop()
            }
        })
    },
    deletePost: function (a) {
        var c = Discussions.baseParams + "&postId=" + a;
        var b = $("current-page").value;
        c += "&page=" + b;
        new Ajax.Request(habboReqPath + "/discussions/actions/deletepost", {
            method: "post",
            parameters: c,
            onComplete: function (e, d) {
                if (d && d.forbidden == "true") {
                    $("discussionbox").innerHTML = e.responseText;
                    e.responseText.evalScripts();
                    return
                } else {
                    if (e.responseText == "TOPIC_DELETED") {
                        document.location = Discussions.redirectLocation;
                        return
                    }
                }
                $("group-postlist-container").innerHTML = e.responseText
            }
        })
    },
    deleteTopic: function (a) {
        Event.stop(a);
        var b = Discussions.baseParams;
        new Ajax.Request(habboReqPath + "/discussions/actions/deletetopic", {
            method: "post",
            parameters: b,
            onComplete: function (d, c) {
                if (c && c.forbidden == "true") {
                    $("discussionbox").innerHTML = d.responseText;
                    return
                }
                if (d.responseText == "SUCCESS") {
                    document.location = Discussions.redirectLocation
                }
            }
        })
    },
    openTopicSettings: function () {
        var c = Discussions.baseParams;
        var a = $("settings_dialog_header").value;
        var b = Dialog.createDialog("topic_settings_dialog", a, 9001, 0, -1000, Discussions.closeTopicSettings);
        Dialog.appendDialogBody(b, '<p style="text-align:center"><img src="' + habboStaticFilePath + '/images/progress_bubbles.gif" alt="" width="29" height="6" /></p><div style="clear"></div>', true);
        Dialog.moveDialogToCenter(b);
        Overlay.show();
        new Ajax.Request(habboReqPath + "/discussions/actions/opentopicsettings", {
            method: "post",
            parameters: c,
            onComplete: function (e, d) {
                Dialog.setDialogBody(b, e.responseText);
                $("topic_settings_dialog").style.width = "305px";
                if (d && d.forbidden == "true") {
                    Event.observe("general-info-dialog-button", "click", Discussions.closeTopicSettings);
                    return
                }
                if ($("save-topic-settings")) {
                    Event.observe("save-topic-settings", "click", Discussions.saveTopicSettings);
                    Event.observe("cancel-topic-settings", "click", Discussions.closeTopicSettings);
                    if ($("delete-topic")) {
                        Event.observe("delete-topic", "click", Discussions.deleteTopicConfirmation)
                    }
                }
            }
        })
    },
    closeTopicSettings: function (a) {
        if (typeof (a) != "undefined") {
            Event.stop(a)
        }
        Element.remove("topic_settings_dialog");
        Overlay.hide()
    },
    deleteTopicConfirmation: function (c) {
        Event.stop(c);
        Discussions.closeTopicSettings(c);
        var a = $("settings_dialog_header").value;
        var b = Dialog.createDialog("delete-topic-confirmation", a, 9001, 0, -1000);
        Dialog.moveDialogToCenter(b);
        Overlay.show();
        Dialog.setAsWaitDialog(b);
        new Ajax.Request(habboReqPath + "/discussions/actions/confirm_delete_topic", {
            method: "post",
            onComplete: function (e, d) {
                Dialog.setDialogBody(b, e.responseText);
                Event.observe($("discussion-action-cancel"), "click", function (f) {
                    Event.stop(f);
                    Element.remove("delete-topic-confirmation");
                    Overlay.hide()
                });
                Event.observe($("discussion-action-ok"), "click", function (f) {
                    Event.stop(f);
                    Element.remove("delete-topic-confirmation");
                    Overlay.hide();
                    Discussions.deleteTopic(f)
                })
            }
        })
    },
    saveTopicSettings: function (j) {
        Event.stop(j);
        var b = $("topic_name").value.replace(/^\s+|\s+$/, "");
        if (b.length == 0) {
            Discussions.showErrorBubble("topic-name-error", L10N.get("myhabbo.discussion.error.topic_name_empty"));
            return
        }
        var c = 0;
        var g = 0;
        var a = $("topic-settings-form");
        var k = a.topic_type;
        for (var f = 0; f < k.length; f++) {
            if (k[f].checked) {
                c = k[f].value
            }
        }
        var l = a.topic_sticky;
        for (var f = 0; f < l.length; f++) {
            if (l[f].checked) {
                g = l[f].value
            }
        }
        var d = Discussions.baseParams + "&topicName=" + encodeURIComponent(b) + "&topicClosed=" + c + "&topicSticky=" + g;
        var h = $("current-page").value;
        d += "&page=" + h;
        Discussions.closeTopicSettings(j);
        new Ajax.Updater("group-postlist-container", habboReqPath + "/discussions/actions/savetopicsettings", {
            method: "post",
            parameters: d,
            onComplete: function (m, e) {
                if (e && e.forbidden == "true") {
                    return
                }
                m.responseText.evalScripts()
            }
        })
    },
    showErrorBubble: function (c, b) {
        if ($(c).empty()) {
            var a = Builder.node("div", {className: "rounded-red"}, b);
            $(c).appendChild(a);
            Rounder.addCorners(a, 8, 8)
        }
    }
};
var Pinger = {
    invokeCount: 0, timer: null, alreadyNotified: false, start: function () {
        if (Pinger.timer == null) {
            Pinger.timer = new PeriodicalExecuter(Pinger.onTimerEvent, 240);
            Pinger.timer.execute()
        }
    }, onTimerEvent: function () {
        new Ajax.Request("/discussions/actions/pingsession", {
            onSuccess: function (a, b) {
                if (b && b.privilegeLevel != 1) {
                    if (!Pinger.alreadyNotified) {
                        if ($("linktool-inline")) {
                            $("linktool-inline").insert({after: "<br/>" + a.responseText})
                        }
                        if ($("post-form-save")) {
                            $("post-form-save").addClassName("disabled-button")
                        }
                        if ($("topic-form-save")) {
                            $("topic-form-save").addClassName("disabled-button")
                        }
                    }
                    Pinger.alreadyNotified = true;
                    Pinger.stop()
                }
            }
        });
        Pinger.invokeCount++;
        if (Pinger.invokeCount > 5) {
            Pinger.stop()
        }
    }, stop: function () {
        if (Pinger.timer != null) {
            Pinger.timer.stop();
            Pinger.timer = null
        }
    }
};
var WidgetRegistry = {
    _widgetsById: [], _widgetsByType: [], add: function (a, c, b) {
        WidgetRegistry._widgetsById[a + ""] = b;
        if (!WidgetRegistry._widgetsByType[c]) {
            WidgetRegistry._widgetsByType[c] = []
        }
        WidgetRegistry._widgetsByType[c].push(b)
    }, getWidgetById: function (a) {
        return WidgetRegistry._widgetsById[a + ""]
    }, getWidgetsByType: function (a) {
        return WidgetRegistry._widgetsByType[a]
    }
};
var FriendsWidget = Class.create({
    options: {searchUrl: "/myhabbo/avatarlist/friendsearchpaging", ownerParameter: "&_mypage_requested_account="},
    initialize: function (a, b) {
        this.searchString = "";
        this.pageNumber = 1;
        this.ownerId = a;
        this.widgetId = b;
        this.widgetEl = $("widget-" + b);
        this.containerEl = $("avatarlist-content");
        this.listElement = $("avatar-list-list");
        this.pagingElement = $("avatar-list-paging");
        if (this.listElement) {
            this.containerEl.onclick = this._processClick.bindAsEventListener(this);
            this.infoEl = this.widgetEl.select(".avatar-list-info")[0];
            this.infoContentEl = this.infoEl.select(".avatar-list-info-container")[0];
            this.closeLink = this.infoEl.select(".avatar-list-info-close")[0];
            this.closeLink.onclick = this.hideAccountDetails.bindAsEventListener(this);
            Event.observe("avatarlist-search-button", "click", function (c) {
                Event.stop(c);
                this._processSearch(c)
            }.bind(this));
            Event.observe("avatarlist-search-string", "keypress", function (c) {
                if (c.keyCode == Event.KEY_RETURN) {
                    this._processSearch(c)
                }
            }.bind(this))
        }
    },
    showAccountDetails: function (a) {
        this.infoEl = $("avatar-list-info");
        this.listElement = $("avatar-list-list");
        this.pagingElement = $("avatar-list-paging");
        this.searchElement = $("avatar-list-search");
        Element.show(this.infoEl);
        Element.hide(this.listElement);
        Element.hide(this.pagingElement);
        Element.hide(this.searchElement);
        this.infoEl.style.display = "block";
        Element.wait(this.infoEl);
        this.showId = a;
        new Ajax.Request(habboReqPath + "/myhabbo/avatarlist/avatarinfo", {
            method: "post",
            parameters: this._getInfoParameters(),
            onComplete: function (d, c) {
                this.infoEl.innerHTML = d.responseText;
                var b = this.infoEl.select(".avatar-list-info-close")[0];
                b.onclick = this.hideAccountDetails.bindAsEventListener(this);
                this._addLinkObservers()
            }.bind(this)
        })
    },
    hideAccountDetails: function (a) {
        Event.stop(a);
        this.infoContentEl.innerHTML = "";
        Element.hide(this.infoEl);
        Element.show(this.listElement);
        Element.show(this.pagingElement);
        Element.show(this.searchElement)
    },
    leaveFromGroup: function (a) {
        Event.stop(a)
    },
    removeFromGroup: function (a) {
        Event.stop(a)
    },
    revokeRights: function (a) {
        Event.stop(a)
    },
    _parseAccountIdFromElementId: function (a) {
        return a.substring(a.lastIndexOf("-") + 1)
    },
    _getInfoParameters: function () {
        return "ownerAccountId=" + encodeURIComponent(this.ownerId) + "&anAccountId=" + encodeURIComponent(this.showId)
    },
    _processClick: function (b) {
        var a = Event.element(b);
        if (a.nodeName.toLowerCase() == "a" && a.className == "avatar-list-open-link") {
            Event.stop(b);
            this._processOpenClick(b)
        } else {
            if (a.nodeName.toLowerCase() == "a" && a.className == "avatar-list-paging-link") {
                Event.stop(b);
                this._processSearch(b)
            }
        }
    },
    _processOpenClick: function (b) {
        var a = Event.element(b);
        if (a.nodeName.toLowerCase() == "a" && a.className == "avatar-list-open-link") {
            var c = this._parseAccountIdFromElementId(a.parentNode.parentNode.id);
            this.showAccountDetails(c)
        }
    },
    _addLinkObservers: function () {
    },
    _processSearch: function (f) {
        var b = Event.element(f);
        var a = parseInt($F("pageNumber"));
        var d = parseInt($F("totalPages"));
        var c = 1;
        if (b.id == "avatarlist-search-first") {
            c = 1
        } else {
            if (b.id == "avatarlist-search-previous") {
                c = a - 1
            } else {
                if (b.id == "avatarlist-search-next") {
                    c = a + 1
                } else {
                    if (b.id == "avatarlist-search-last") {
                        c = d
                    } else {
                        if (b.parentNode.id == "avatarlist-search-button" || b.id == "avatarlist-search-string") {
                            this.searchString = $F("avatarlist-search-string");
                            c = 1
                        }
                    }
                }
            }
        }
        new Ajax.Updater("avatarlist-content", habboReqPath + this.options.searchUrl, {
            method: "post",
            parameters: "pageNumber=" + encodeURIComponent(c) + "&searchString=" + encodeURIComponent(this.searchString) + "&widgetId=" + this.widgetId + this.options.ownerParameter + this.ownerId
        })
    }
});
var MemberWidget = Class.create(FriendsWidget, {
    options: {searchUrl: "/myhabbo/avatarlist_membersearchpaging.php", ownerParameter: "&_groupspage_requested_group="},
    leaveFromGroup: function ($super, a) {
        Event.stop(a);
        openGroupActionDialog("/ajax_habblet/actions/confirm_leave.php", "/ajax_habblet/actions/leave.php", this.showId, this.ownerId, this)
    },
    removeFromGroup: function ($super, a) {
        Event.stop(a);
        openGroupActionDialog("/ajax_habblet/actions/confirm_remove.php", "/ajax_habblet/actions/remove.php", this.showId, this.ownerId, this)
    },
    giveRights: function ($super, a) {
        Event.stop(a);
        openGroupActionDialog("/ajax_habblet/actions/confirm_give_rights.php", "/ajax_habblet/actions/give_rights.php", this.showId, this.ownerId, this)
    },
    revokeRights: function ($super, a) {
        Event.stop(a);
        openGroupActionDialog("/ajax_habblet/actions/confirm_revoke_rights.php", "/ajax_habblet/actions/revoke_rights.php", this.showId, this.ownerId, this)
    },
    _getInfoParameters: function ($super) {
        return "groupId=" + encodeURIComponent(this.ownerId) + "&anAccountId=" + encodeURIComponent(this.showId)
    },
    _addLinkObservers: function ($super) {
        this.infoEl.select(".avatar-info-rights-leave").each(function (a) {
            a.onclick = this.leaveFromGroup.bindAsEventListener(this)
        }.bind(this));
        this.infoEl.select(".avatar-info-rights-remove").each(function (a) {
            a.onclick = this.removeFromGroup.bindAsEventListener(this)
        }.bind(this));
        this.infoEl.select(".avatar-info-rights-give").each(function (a) {
            a.onclick = this.giveRights.bindAsEventListener(this)
        }.bind(this));
        this.infoEl.select(".avatar-info-rights-revoke").each(function (a) {
            a.onclick = this.revokeRights.bindAsEventListener(this)
        }.bind(this))
    }
});
var ScrollWatcher = Class.create();
ScrollWatcher.prototype = {
    initialize: function (b, a, c) {
        this.widgetId = b;
        this.className = a;
        this.callBack = c;
        this.noticed = [];
        this.listItems();
        this.lastUpdate = 0;
        this.lastScrollTop = 0;
        new PeriodicalExecuter(function () {
            this.update(this)
        }.bind(this), 0.8)
    }, update: function (a) {
        this.widgetEl = $("widget-" + this.widgetId);
        this.scrollDiv = this.widgetEl.select(".avatar-widget-list-container")[0];
        this.scrollDivHeight = Element.getHeight(this.scrollDiv);
        if (this.scrollDiv.scrollTop != this.lastScrollTop) {
            this.listItems();
            this.items.each(function (b) {
                if (b.offsetTop + Element.getHeight(b) >= this.scrollDiv.scrollTop && b.offsetTop < this.scrollDiv.scrollTop + this.scrollDivHeight) {
                    if (this.callBack) {
                        this.callBack(b)
                    }
                    this.noticed.push(b);
                    b.className = ""
                }
            }.bind(this));
            this.listItems()
        }
        this.lastScrollTop = this.scrollDiv.scrollTop
    }, listItems: function () {
        this.items = this.scrollDiv.select("." + this.className)
    }
};
var UpdateQueue = Class.create();
UpdateQueue.prototype = {
    initialize: function () {
        this.queue = []
    }, push: function (a) {
        this.queue.push(a)
    }, flush: function () {
        var a = this.queue;
        this.queue = [];
        return a
    }
};
var GuestbookWidget = Class.create();
GuestbookWidget.prototype = {
    initialize: function (e, d, c) {
        this.accountId = e;
        this.widgetId = d;
        this.maxMessageLength = c;
        if ($("guestbook-open-dialog")) {
            Event.observe("guestbook-open-dialog", "click", function (h) {
                Event.stop(h);
                var f = $("guestbook-open-dialog").cumulativeOffset();
                var g = $("guestbook-form-dialog");
                g.absolutize();
                g.style.top = f[1] + "px";
                g.style.left = (f[0] - 80) + "px";
                Element.hide($("guestbook-preview-tab"));
                Element.show($("guestbook-form-tab"));
                Element.show("guestbook-form-dialog");
                if (Prototype.Browser.IE) {
                    $$("#guestbook-form-dialog .new-button").each(function (j) {
                        Element.show(j)
                    })
                }
                $("guestbook-message").value = "";
                $("guestbook-form-preview").disabled = "true";
                Element.addClassName($("guestbook-form-preview"), "disabled-button");
                Field.activate($("guestbook-message"))
            });
            var a = function (f) {
                Event.stop(f);
                Element.hide($("guestbook-form-dialog"))
            };
            Event.observe("guestbook-form-dialog-exit", "click", a);
            Event.observe("guestbook-form-cancel", "click", a);
            Event.observe("guestbook-form-preview", "click", function (f) {
                Event.stop(f);
                if ("true" == $("guestbook-form-preview").disabled) {
                    return
                }
                if ($F("guestbook-message").length > 0) {
                    Element.hide($("guestbook-form-tab"));
                    Element.wait($("guestbook-preview-tab"));
                    Element.show($("guestbook-preview-tab"));
                    new Ajax.Updater($("guestbook-preview-tab"), habboReqPath + "/myhabbo/guestbook/preview", {
                        method: "post",
                        parameters: Form.serialize($("guestbook-form")) + "&widgetId=" + encodeURIComponent(this.widgetId),
                        evalScripts: true,
                        onComplete: function () {
                            Event.observe("guestbook-form-post", "click", function (g) {
                                Event.stop(g);
                                new Ajax.Updater($("guestbook-entry-container"), habboReqPath + "/myhabbo/guestbook/add", {
                                    method: "post",
                                    parameters: Form.serialize($("guestbook-form")) + "&widgetId=" + encodeURIComponent(this.widgetId),
                                    evalScripts: true,
                                    insertion: "top",
                                    onComplete: function (j, h) {
                                        if (h && h.spam == "true") {
                                            return
                                        }
                                        if ($("guestbook-empty-notes")) {
                                            Element.hide("guestbook-empty-notes")
                                        }
                                        if (Prototype.Browser.IE) {
                                            $$("#guestbook-form-dialog .new-button").each(function (l) {
                                                Element.hide(l)
                                            })
                                        }
                                        Element.hide("guestbook-form-dialog");
                                        $("guestbook-entry-container").scrollTop = 0;
                                        var k = $$("#guestbook-entry-container .guestbook-entry").first();
                                        new Effect.Pulsate(k, {
                                            afterFinish: function () {
                                                Element.setOpacity(k, 1)
                                            }
                                        });
                                        this.incrementSize()
                                    }.bind(this)
                                })
                            }.bind(this));
                            Event.observe("guestbook-form-continue", "click", function (g) {
                                Event.stop(g);
                                Element.hide($("guestbook-preview-tab"));
                                Element.show($("guestbook-form-tab"));
                                Field.focus($("guestbook-message"))
                            })
                        }.bind(this)
                    })
                }
            }.bind(this));
            new Form.Element.Observer($("guestbook-message"), 0.5, (function (g) {
                var f = $F("guestbook-message").length;
                if (f > 0 && f <= this.maxMessageLength) {
                    $("guestbook-form-preview").disabled = "";
                    Element.removeClassName($("guestbook-form-preview"), "disabled-button")
                } else {
                    $("guestbook-form-preview").disabled = "true";
                    Element.addClassName($("guestbook-form-preview"), "disabled-button")
                }
            }).bind(this))
        }
        if ($("guestbook-delete-dialog")) {
            Event.observe($("guestbook-delete"), "click", function (f) {
                Event.stop(f);
                this.doRemoveEntry($("guestbook-delete-id").value);
                this.hideRemoveConfirmation()
            }.bind(this));
            var b = function (f) {
                Event.stop(f);
                this.hideRemoveConfirmation()
            }.bind(this);
            Event.observe($("guestbook-delete-dialog-exit"), "click", b);
            Event.observe($("guestbook-delete-cancel"), "click", b)
        }
        Event.observe($("guestbook-entry-container"), "click", this.handleActions.bindAsEventListener(this));
        this.monitorEventListener = this.monitorScrollPosition.bind(this)
    }, handleActions: function (d) {
        var c = Event.element(d);
        if (c.className == "gbentry-delete") {
            Event.stop(d);
            var b = c.id.substring("gbentry-delete-".length);
            this.removeEntry(b)
        }
        if (c.className == "gbentry-report") {
            Event.stop(d);
            var b = c.id.substring("gbentry-report-".length);
            var a = 0;
            if (Prototype.Browser.IE) {
                a = $("guestbook-entry-container").scrollTop
            }
            ReportDialogManager.show("guestbook", b, c, {
                setWidth: false,
                setHeight: false,
                offsetTop: a,
                offsetLeft: -120
            })
        }
    }, monitorScrollPosition: function () {
        var b = $("guestbook-entry-container");
        if (!$("gb-progress")) {
            var a = Builder.node("div", {id: "gb-progress", style: "margin: 20px 0 60px 0; visibility: hidden"});
            $("guestbook-entry-container").appendChild(a);
            Element.wait(a)
        }
        if (b.scrollTop > 0 && (b.scrollTop + b.clientHeight == b.scrollHeight)) {
            b.scrollTop = b.scrollHeight - b.clientHeight;
            var c = $$("#guestbook-entry-container .guestbook-entry").last().id.substring("guestbook-entry-".length);
            $("gb-progress").style.visibility = "";
            new Ajax.Updater($("guestbook-entry-container"), habboReqPath + "/myhabbo/guestbook/list", {
                method: "post",
                parameters: "ownerId=" + this.accountId + "&lastEntryId=" + c + "&widgetId=" + encodeURIComponent(this.widgetId),
                evalScripts: true,
                insertion: "bottom",
                onComplete: function (e, d) {
                    $("gb-progress").remove();
                    if (d.lastPage == "false") {
                        setTimeout(this.monitorEventListener, 300)
                    }
                }.bind(this)
            })
        } else {
            setTimeout(this.monitorEventListener, 300)
        }
    }, removeEntry: function (d) {
        var b = $("gbentry-delete-" + d).cumulativeOffset();
        var c = $("guestbook-delete-dialog");
        c.absolutize();
        var a = $("guestbook-entry-container").scrollTop;
        c.style.top = (b[1] - a) + "px";
        c.style.left = (b[0] - 250) + "px";
        Element.show(c);
        $("guestbook-delete-id").value = d
    }, hideRemoveConfirmation: function () {
        $("guestbook-delete-id").value = "";
        Element.hide($("guestbook-delete-dialog"))
    }, doRemoveEntry: function (a) {
        new Ajax.Request(habboReqPath + "/myhabbo/guestbook/remove", {
            parameters: "entryId=" + encodeURIComponent(a) + "&widgetId=" + encodeURIComponent(this.widgetId),
            onSuccess: function (b) {
                new Effect.Fade($("guestbook-entry-" + a), {
                    afterFinish: function () {
                        $("guestbook-entry-" + a).remove()
                    }
                });
                this.decrementSize()
            }.bind(this)
        })
    }, incrementSize: function () {
        var b = $("guestbook-size");
        if (b) {
            var a = parseInt(b.innerHTML) + 1;
            if (!isNaN(a)) {
                b.innerHTML = a
            }
        }
    }, decrementSize: function () {
        var b = $("guestbook-size");
        if (b) {
            var a = parseInt(b.innerHTML) - 1;
            if (!isNaN(a)) {
                b.innerHTML = a
            }
        }
    }, updateOptionsList: function (b) {
        var a = $("guestbook-privacy-options");
        $A(a.options).each(function (c) {
            if (c.value == b) {
                a.selectedIndex = c.index
            }
        })
    }
};
var RatingObserver = Class.create();
RatingObserver.prototype = {
    initialize: function (c, b, d, a) {
        this.commonAjaxParams = c;
        this.elementToObserve = b;
        this.urlToCall = d;
        this.elementToObserve = b;
        this.innerHtmlParamName = a;
        Event.observe(b, "click", this.handleEvent.bindAsEventListener(this))
    }, handleEvent: function (a) {
        var b;
        Event.stop(a);
        if (this.innerHtmlParamName != null) {
            b = this.commonAjaxParams.parameters + "&" + this.innerHtmlParamName + "=" + $(this.elementToObserve).innerHTML
        } else {
            b = this.commonAjaxParams.parameters
        }
        $(this.commonAjaxParams.elementToUpdate).innerHTML = "";
        new Ajax.Updater(this.commonAjaxParams.elementToUpdate, habboReqPath + this.urlToCall, {
            method: "get",
            parameters: b,
            evalScripts: false,
            insertion: "bottom",
            onComplete: this.commonAjaxParams.onCompleteFunction
        })
    }
};
var CommonRatingObserverParams = Class.create();
CommonRatingObserverParams.prototype = {
    initialize: function (c, b, a) {
        this.elementToUpdate = c;
        this.parameters = b;
        this.onCompleteFunction = a
    }
};
var RatingWidget = Class.create();
RatingWidget.prototype = {
    initialize: function (b, a, c) {
        this.idParams = "widgetId=" + b + "&ratingId=" + c + "&_mypage_requested_account=" + a;
        this.mainDiv = "rating-main";
        this.givenRate = "rating-rate";
        this.resetLink = "ratings-reset-link";
        this.ratingStarClassName = "rater";
        this.commonObserverParams = new CommonRatingObserverParams(this.mainDiv, this.idParams, this.refreshObservers.bind(this));
        this.refreshObservers()
    }, refreshObservers: function () {
        if ($(this.resetLink) && this.resetLinkObserver == null) {
            this.resetLinkObserver = new RatingObserver(this.commonObserverParams, this.resetLink, "/myhabbo/rating/reset_ratings", null)
        }
        var b = $$("." + this.ratingStarClassName);
        for (var a = 0; a < b.length; ++a) {
            new RatingObserver(this.commonObserverParams, b[a], "/myhabbo/rating/rate", "givenRate")
        }
    }
};
var GroupsWidget = Class.create();
GroupsWidget.prototype = {
    initialize: function (a, b) {
        this.ownerId = a;
        this.widgetId = b;
        this.widgetEl = $("widget-" + b);
        this.containerEl = this.widgetEl.select(".groups-list-container")[0];
        if (typeof this.containerEl == "undefined") {
            return
        }
        this.listEl = this.containerEl.select(".groups-list")[0];
        this.loadingEl = this.widgetEl.select(".groups-list-loading")[0];
        this.infoEl = this.widgetEl.select(".groups-list-info")[0];
        this.closeLink = this.loadingEl.select(".groups-loading-close")[0];
        this.closeLink.onclick = this.hideGroupDetails.bindAsEventListener(this);
        this._addOpenEventHandlers()
    }, showGroupDetails: function (b) {
        if (Event.element(b).nodeName.toLowerCase() == "a") {
            return
        }
        Event.stop(b);
        var a = Event.findElement(b, "li");
        this.groupId = this._parseGroupIdFromElementId(a.id);
        GroupFavoriteSelector.init(this, this.ownerId, this.groupId, this.onCompleteCallback.bind(this));
        Element.hide(this.containerEl);
        this.loadingEl.style.display = "block";
        new Ajax.Request(habboReqPath + "/ajax_habblet/myhabbo_groups_groupinfo.php", {
            method: "post",
            parameters: "ownerId=" + encodeURIComponent(this.ownerId) + "&groupId=" + encodeURIComponent(this.groupId),
            onComplete: function (d, c) {
                this.infoEl.innerHTML = d.responseText;
                Element.hide(this.loadingEl);
                this.infoEl.style.display = "block";
                this.closeLink = this.infoEl.select(".groups-info-close")[0];
                this.closeLink.onclick = this.hideGroupDetails.bindAsEventListener(this);
                this.infoEl.select(".groups-info-select-favorite").each(function (e) {
                    e.onclick = GroupFavoriteSelector.selectFavorite.bindAsEventListener(this)
                }.bind(this));
                this.infoEl.select(".groups-info-deselect-favorite").each(function (e) {
                    e.onclick = GroupFavoriteSelector.deselectFavorite.bindAsEventListener(this)
                }.bind(this))
            }.bind(this)
        })
    }, hideGroupDetails: function (a) {
        if (a) {
            Event.stop(a)
        }
        Element.hide(this.loadingEl);
        Element.hide(this.infoEl);
        this.infoEl.innerHTML = "";
        Element.show(this.containerEl)
    }, refreshGroupList: function () {
        Element.wait(this.containerEl);
        new Ajax.Updater(this.containerEl, habboReqPath + "/ajax_habblet/actions/grouplist", {
            method: "post",
            parameters: "id=" + encodeURIComponent(this.ownerId) + "&widgetId=" + encodeURIComponent(this.widgetId),
            onComplete: function (b, a) {
                this.listEl = this.containerEl.select(".groups-list")[0];
                this._addOpenEventHandlers()
            }.bind(this)
        })
    }, onCompleteCallback: function (b, a) {
        if (b.responseText == "OK") {
            hideGroupActionDialog(this);
            this.hideGroupDetails();
            this.refreshGroupList();
            return false
        }
        return true
    }, _addOpenEventHandlers: function () {
        if (this.listEl) {
            this.listEl.onclick = this.showGroupDetails.bindAsEventListener(this)
        }
    }, _parseGroupIdFromElementId: function (a) {
        return a.substring(a.lastIndexOf("-") + 1)
    }
};
var TagWidgetPartial = Class.create();
TagWidgetPartial.prototype = {
    initialize: function (a) {
        this.parentWidget = a;
        TagHelper.init(this.parentWidget.loggedInAccountId);
        this.btnAddTag = $("profile-add-tag");
        if (this.btnAddTag) {
            this.eventAddTag = this.handleAddTag.bindAsEventListener(this);
            Event.observe(this.btnAddTag, "click", this.eventAddTag)
        }
        Event.observe("profile-tag-list", "click", function (b) {
            this.handleClickTag(b)
        }.bind(this));
        if ($("profile-add-tag-input")) {
            Event.observe($("profile-add-tag-input"), "keypress", function (b) {
                if (b.keyCode == Event.KEY_RETURN) {
                    this.handleAddTag(b)
                }
            }.bind(this))
        }
    }, handleAddTag: function (c) {
        Event.stop(c);
        var b = $F("profile-add-tag-input");
        var a = $("profile-add-tag-input");
        if (this.parentWidget.tagType == "group") {
            this.addGroupTag(b, this.parentWidget.groupId)
        } else {
            if (this.parentWidget.tagType == "avatar") {
                this.addAvatarTag(b, this.parentWidget.accountId)
            }
        }
        a.value = ""
    }, handleClickTag: function (d) {
        var b = Event.element(d);
        var f = Element.up(b, ".tag-search-rowholder");
        if (!f) {
            return
        }
        var a = TagHelper.findTagNameForContainer(f);
        var c = TagHelper.findTagIdForContainer(f);
        if (b.className.indexOf("tag-delete-link") >= 0) {
            Event.stop(d);
            this.errorMessage("valid");
            if (this.parentWidget.tagType == "group") {
                new Ajax.Updater("profile-tag-list", "/myhabbo/tag/remove", {
                    parameters: "groupId=" + encodeURIComponent(this.parentWidget.groupId) + "&tagId=" + encodeURIComponent(c),
                    evalScripts: true,
                    onSuccess: function (e, g) {
                        new Ajax.Updater("profile-tag-list", "/habblet/mytagslist")
                    }
                })
            } else {
                if (this.parentWidget.tagType == "avatar") {
                    new Ajax.Updater("profile-tag-list", "/myhabbo/tag/remove", {
                        parameters: "accountId=" + encodeURIComponent(this.parentWidget.accountId) + "&tagId=" + encodeURIComponent(c),
                        evalScripts: true,
                        onSuccess: function (e, g) {
                            new Ajax.Updater("profile-tag-list", "/habblet/mytagslist")
                        }
                    })
                }
            }
        } else {
            if (b.className.indexOf("tag-add-link") >= 0) {
                Event.stop(d);
                TagHelper.addThisTagToMe(a, false, {
                    onSuccess: function () {
                        if ($("tag-img-added")) {
                            var e = $("tag-img-added").cloneNode(false);
                            e.removeAttribute("id");
                            b.replace(e);
                            $(e).show()
                        }
                    }
                })
            }
        }
    }, errorMessage: function (b) {
        var d = $("profile-tags-status-field");
        if (d) {
            var c = $("tag-limit-message");
            var a = $("tag-invalid-message");
            if (b == "invalidtag") {
                d.style.display = "block";
                a.style.display = "block";
                c.style.display = "none"
            } else {
                if (b == "taglimit") {
                    d.style.display = "block";
                    c.style.display = "block";
                    a.style.display = "none"
                } else {
                    d.style.display = "none"
                }
            }
        }
    }, addAvatarTag: function (a, b) {
        b = encodeURIComponent(b);
        new Ajax.Request("/myhabbo/tag/add", {
            parameters: "accountId=" + b + "&tagName=" + encodeURIComponent(a),
            onSuccess: function (d) {
                var c = d.responseText;
                if (c == "valid" && $("profile-tags-status-field")) {
                    new Ajax.Updater("profile-tag-list", "/habblet/mytagslist", {parameters: "tagMsgCode=" + encodeURIComponent("valid") + "&accountId=" + b})
                }
                this.errorMessage(c)
            }.bind(this)
        })
    }, addGroupTag: function (b, a) {
        a = encodeURIComponent(a);
        new Ajax.Request("/myhabbo/myhabbo_tag_addgrouptag.php", {
            parameters: "groupId=" + a + "&tagName=" + encodeURIComponent(b),
            onSuccess: function (d) {
                var c = d.responseText;
                if (c == "valid" && $("profile-tags-status-field")) {
                    new Ajax.Updater("profile-tag-list", "/habblet/mytagslistgrouptags", {parameters: "tagMsgCode=" + encodeURIComponent("valid") + "&groupId=" + a})
                }
                this.errorMessage(c)
            }.bind(this)
        })
    }
};
var ProfileWidget = Class.create();
ProfileWidget.prototype = {
    tagType: "avatar", initialize: function (b, a) {
        this.options = Object.extend({
            messageText: "Add as friend?",
            headerText: "Are you sure?",
            loginText: ""
        }, arguments[2] || {});
        this.accountId = b;
        if (a) {
            this.loggedInAccountId = a
        }
        this.btnAddFriend = $("add-friend");
        if (this.btnAddFriend) {
            this.eventAddFriend = this.handleAddFriend.bindAsEventListener(this);
            Event.observe(this.btnAddFriend, "click", this.eventAddFriend)
        }
        this.tags = new TagWidgetPartial(this)
    }, handleAddFriend: function (a) {
        if (Element.hasClassName(this.btnAddFriend, "disabled")) {
            Event.stop(a);
            return
        }
        if (this.loggedInAccountId) {
            Event.stop(a);
            this.dialog = Dialog.showConfirmDialog(this.options.messageText, {
                okHandler: this.doSendFriendRequest.bind(this),
                headerText: this.options.headerText,
                buttonText: this.options.buttonText,
                cancelButtonText: this.options.cancelButtonText
            })
        } else {
            Event.stop(a);
            Dialog.showInfoDialog("friend-req.login-info", this.options.loginText, this.options.buttonText, null)
        }
    }, doSendFriendRequest: function () {
        Dialog.setAsWaitDialog(this.dialog);
        new Ajax.Request("/myhabbo/friends/add", {
            parameters: "accountId=" + encodeURIComponent(this.accountId),
            onSuccess: function () {
                Element.addClassName(this.btnAddFriend, "disabled");
                Element.remove(this.dialog);
                Overlay.hide()
            }.bind(this)
        })
    }
};
var GroupInfoWidget = Class.create();
GroupInfoWidget.prototype = {
    tagType: "group", initialize: function (b, a) {
        this.groupId = b;
        if (a) {
            this.loggedInAccountId = a
        }
        this.tags = new TagWidgetPartial(this)
    }
};
var GroupFavoriteSelector = {
    init: function (d, a, b, c) {
        GroupFavoriteSelector.widget = d;
        GroupFavoriteSelector.ownerId = a;
        GroupFavoriteSelector.groupId = b;
        GroupFavoriteSelector.onCompleteCallback = c || Prototype.emptyFunction
    }, selectFavorite: function (a) {
        Event.stop(a);
        openGroupActionDialog("/ajax_habblet/actions/confirm_select_favorite.php", "/ajax_habblet/actions/select_favorite.php", GroupFavoriteSelector.ownerId, GroupFavoriteSelector.groupId, GroupFavoriteSelector.widget, GroupFavoriteSelector.onCompleteCallback)
    }, deselectFavorite: function (a) {
        Event.stop(a);
        openGroupActionDialog("/ajax_habblet/actions/confirm_deselect_favorite.php", "/ajax_habblet/actions/deselect_favorite.php", GroupFavoriteSelector.ownerId, GroupFavoriteSelector.groupId, GroupFavoriteSelector.widget, GroupFavoriteSelector.onCompleteCallback)
    }
};
var BadgesWidget = Class.create({
    options: {searchUrl: "/myhabbo/badgelist/badgepaging", ownerParameter: "&_mypage_requested_account="},
    initialize: function (a, b) {
        this.ownerId = a;
        this.widgetId = b;
        this.containerElement = $("badgelist-content");
        this.listHeight = null;
        if (this.containerElement) {
            this.listHeight = $(this.containerElement).down("ul").getHeight();
            Event.observe(this.containerElement, "click", function (c) {
                Event.stop(c);
                this._processSearch(c)
            }.bind(this))
        }
    },
    _processSearch: function (f) {
        var b = Event.element(f);
        var a = parseInt($F("badgeListPageNumber"));
        var d = parseInt($F("badgeListTotalPages"));
        var c = null;
        if (b.id == "badge-list-search-first") {
            c = 1
        } else {
            if (b.id == "badge-list-search-previous") {
                c = a - 1
            } else {
                if (b.id == "badge-list-search-next") {
                    c = a + 1
                } else {
                    if (b.id == "badge-list-search-last") {
                        c = d
                    }
                }
            }
        }
        if (null == c) {
            return
        }
        new Ajax.Updater(this.containerElement, habboReqPath + this.options.searchUrl, {
            method: "post",
            parameters: "pageNumber=" + encodeURIComponent(c) + "&widgetId=" + this.widgetId + this.options.ownerParameter + this.ownerId,
            onComplete: function (g) {
                if (this.listHeight) {
                    var e = $(this.containerElement).down("ul");
                    $(e).setStyle({height: this.listHeight + "px"})
                }
            }.bind(this)
        })
    }
});