if (window.Prototype) {
    // patch html comments and evalScripts
    Prototype.ScriptFragment = '(?:<script.*?>\\s*(?:<!--)*)((\n|\r|.)*?)(?:<\/script>)';

    // from <http://www.vivabit.com/bollocks/2006/06/21/a-dom-ready-extension-for-prototype>
    Object.extend(Event, {
        _domReady : function() {
            if (arguments.callee.done) return;
            arguments.callee.done = true;
            if (this._timer) clearInterval(this._timer);
            this._readyCallbacks.each(function(f) { f() });
            this._readyCallbacks = null;
        },
        onDOMReady : function(f) {
            if (!this._readyCallbacks) {
                var domReady = this._domReady.bind(this);
                if (document.addEventListener) document.addEventListener("DOMContentLoaded", domReady, false);
                /*@cc_on @*/
                /*@if (@_win32)
                    var proto = "javascript:void(0)";
                    if (location.protocol == "https:") proto = "//0";
                    document.write("<script id=__ie_onload defer src=" + proto + "><\/script>");
                    document.getElementById("__ie_onload").onreadystatechange = function() {
                        if (this.readyState == "complete") domReady();
                    };
                /*@end @*/
                if (/WebKit/i.test(navigator.userAgent)) {
                    this._timer = setInterval(function() {
                        if (/loaded|complete/.test(document.readyState)) domReady();
                    }, 10);
                }
                Event.observe(window, 'load', domReady);
                Event._readyCallbacks =  [];
            }
            Event._readyCallbacks.push(f);
        }
    });

    Ajax.Responders.register({
      onCreate: function(request, transport) {
        var sc = Cookie.get("JSESSIONID");
        if (sc) {
            if (typeof request.options.requestHeaders == 'object') {
              request.options.requestHeaders["X-App-Key"] = sc;
            } else {
              request.options.requestHeaders = { "X-App-Key" : sc };
            }
        }
      }
    });
}
