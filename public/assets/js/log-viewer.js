function handleInfo(res, status, xhr) {
    setLogsInfo("Got data from server: " + JSON.stringify(res));
    setLogsInfo("Got signature: " + xhr.getResponseHeader("X-Signature"));
    setLogsInfo("Sending data to thor...");
    pollThor(res, xhr.getResponseHeader("X-Signature"));
}

function pollThor(data, signature) {
    setLogsInfo("Formulating URL...");
    var url = "http://thor.tenjava.com:8181/log?beta";
    $.ajax({
        type: 'POST',
        url: url,
        data: JSON.stringify(data),
        success: handleThorData,
        contentType: "application/json",
        dataType: 'json',
        beforeSend: function (request) {
            request.setRequestHeader("X-Signature", signature);
        }
    });
}

function htmlEncode(value){
    if (value) {
        return jQuery('<div />').text(value).html();
    } else {
        return '';
    }
}


function handleThorData(res, status, xhr) {
    setLogsInfo("<pre>" + htmlEncode(res.log_data) + "</pre>", true);
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
