function handleInfo(res, status, xhr) {
    setLogsInfo("Got data from server: " + JSON.stringify(res));
    setLogsInfo("Got signature: " + xhr.getResponseHeader("X-Signature"));
}

function setLogsInfo(data, replace) {
    var $logs = $("#logs");
    if (replace != undefined) {
        $logs.html(data);
    } else {
        $logs.html($logs.html() + "<br />" + data);
    }
}

$(document).ready(function () {
    setLogsInfo("Initializing...");
    var infoUrl = "/judging/logs/ajax";
    $.ajax(infoUrl, {
        type: 'GET',
        dataType: 'json',
        success: handleInfo
    });
});