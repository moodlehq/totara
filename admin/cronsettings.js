
function changeText(newtext) {
    var element = YAHOO.util.Dom.get("cron_execution_status");
    if (element) {
        var nnode = document.createTextNode(newtext);
        element.replaceChild(nnode, element.childNodes[0])
    }
}

var handler = {
    success: function(o){
        var doit = (o.responseText !== undefined);
        if (doit) {
            var resp = YAHOO.lang.JSON.parse(o.responseText);
        }

        var msg = "Unable to check cron status!";
        if (doit && (resp !== false)) {
            msg = resp;
        }
        changeText(msg);
    }
};

function cron_refresh() {
    YAHOO.util.Connect.asyncRequest('POST', 'cron_ajax_refresh.php', handler);
}

function cron_redirect_url(url) {
    window.location = url;
}
