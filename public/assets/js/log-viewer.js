function handleInfo(data) {
    setLogsInfo("Got data from server " + JSON.stringify(data));
}

function setLogsInfo(data, replace) {
    var $logs = $("#logs");
    if (replace != undefined) {
        $logs.html(data);
    } else {
        $logs.html($logs.text() + "<br />" + data);
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