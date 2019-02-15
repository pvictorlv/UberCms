AuthProviders = {
    init: function () {
        $(document.body).addClassName("js");
        if ($$(".auth-providers").length > 0) {
            $$(".auth-providers li a").each(function (a) {
                $(a).observe("click", function (j) {
                    Event.stop(j);
                    var i = $(a).next("form");
                    if (i) {
                        var b = $(a).next("form");
                        if (b.getAttribute("target") != null) {
                            var h = typeof window.screenX != "undefined" ? window.screenX : window.screenLeft, d = typeof window.screenY != "undefined" ? window.screenY : window.screenTop, n = typeof window.outerWidth != "undefined" ? window.outerWidth : document.documentElement.clientWidth, l = typeof window.outerHeight != "undefined" ? window.outerHeight : (document.documentElement.clientHeight - 22), c = 800, m = 500, g = parseInt(h + ((n - c) / 2), 10), k = parseInt(d + ((l - m) / 2.5), 10);
                            login_window = window.open("", "rpx_login", "menubar=1,resizable=1,scrollbars=yes,width=" + c + ",height=" + m + ",left=" + g + ",top=" + k);
                            login_window.focus()
                        }
                        b.submit()
                    }
                })
            })
        }
    }
};
SimpleRegistration = {
    nameFailures: 0, initRegistrationUI: function (b) {
        $(document.body).addClassName("js");
        var d = b || "/embed/";
        if ($("name-field-container")) {
            var c = function (f) {
                Event.stop(f);
                new Ajax.Updater("name-field-container", d + "register_submit", {
                    parameters: {checkNameOnly: "true", "bean.avatarName": $F("habbo-name")}, onComplete: function () {
                        if ($("name-field-container").select(".state-error").length == 0) {
                            SimpleRegistration.trackNameSuccess();
                            if ($("password")) {
                                $("password").focus()
                            }
                        } else {
                            SimpleRegistration.trackNameFailure();
                            $("habbo-name").focus()
                        }
                    }
                })
            };
            Event.observe($("name-field-container"), "click", Event.delegate({
                "#check-name-btn > *": c, "#check-name-btn": c, "#name-suggestion-list a": function (f) {
                    Event.stop(f);
                    new Ajax.Updater("name-field-container", d + "register_submit", {
                        parameters: {checkNameOnly: "true", "bean.avatarName": Event.element(f).innerHTML},
                        onComplete: function () {
                            if ($("name-field-container").select(".state-error").length == 0) {
                                SimpleRegistration.trackNameSuccess();
                                if ($("password")) {
                                    $("password").focus()
                                }
                            } else {
                                SimpleRegistration.trackNameFailure();
                                $("habbo-name").focus()
                            }
                        }
                    })
                }
            }));
            if ($("show-login-form")) {
                $("show-login-form").observe("click", function (f) {
                    Event.stop(f);
                    $("embedded-login-container").toggle()
                })
            }
        }
        if ($("avatar-field-container")) {
            var a = function (e) {
                return function (f) {
                    Event.stop(f);
                    new Ajax.Updater("selected-avatar", d + "register_submit", {
                        parameters: {
                            checkFigureOnly: "true",
                            "bean.gender": e,
                            "bean.figure": $(Event.element(f)).up("a").readAttribute("rel")
                        }
                    })
                }
            };
            Event.observe($("avatar-field-container"), "click", Event.delegate({
                "a.female-avatar img": a("f"), "a.male-avatar img": a("m"), "#more-avatars": function (f) {
                    Event.stop(f);
                    new Ajax.Updater("avatar-field-container", d + "register_submit", {parameters: {refreshAvailableFigures: "true"}})
                }
            }))
        }
        if ($("next")) {
            $$("#next,#next-btn").each(function (e) {
                Event.observe($(e), "click", function (f) {
                    if (!SimpleRegistration.validatePasswords()) {
                        f.stop();
                        return
                    }
                    setTimeout(function () {
                        $("next").disable();
                        $("next-btn").addClassName("disabled-button");
                        $("register-page").down("form").submit()
                    }, 50)
                })
            })
        }
        AuthProviders.init()
    }, validatePasswords: function () {
        if (!$("password") || !$("password2")) {
            return true
        }
        var c = $F("password");
        var b = $F("password2");
        if (typeof(c) == "string" && typeof(b) == "string") {
            var a = SimpleRegistration.highlightField;
            SimpleRegistration.deHighlightField("field-password");
            SimpleRegistration.deHighlightField("field-password2");
            if (c.length == 0) {
                SimpleRegistration.displayError(L10N.get("register.error.password_required"));
                a("field-password");
                return false
            }
            if (b.length == 0) {
                SimpleRegistration.displayError(L10N.get("register.error.retyped_password_required"));
                a("field-password2");
                return false
            }
            if (c != b) {
                SimpleRegistration.displayError(L10N.get("register.error.retyped_password_notsame"));
                a("field-password");
                a("field-password2");
                return false
            }
            if (c.length < 6) {
                SimpleRegistration.displayError(L10N.get("register.error.password_length"));
                a("field-password");
                a("field-password2");
                return false
            }
        }
        return true
    }, displayError: function (a) {
        if ($("error-messages-container")) {
            $("error-messages-container").update('<div class="error-messages-holder"><h3>' + L10N.get("embedded_registration.errors.header") + '</h3><ul><li><p class="error-message">' + a + "</p></li></ul></div>")
        }
    }, highlightField: function (a) {
        $$("." + a).each(function (b) {
            if (!b.hasClassName("state-error")) {
                b.addClassName("state-error")
            }
        })
    }, deHighlightField: function (a) {
        $$("." + a).each(function (b) {
            if (b.hasClassName("state-error")) {
                b.removeClassName("state-error")
            }
        })
    }, trackNameSuccess: function () {
        if (typeof pageTracker != "undefined") {
            pageTracker._trackEvent("register", "name", "success")
        }
    }, trackNameFailure: function () {
        SimpleRegistration.nameFailures++;
        if (typeof pageTracker != "undefined") {
            pageTracker._trackEvent("register", "name", "failure" + SimpleRegistration.nameFailures)
        }
    }
};