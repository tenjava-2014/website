var pointer = 0;

function handleInfo(res, status, xhr) {
    pollThor(res, xhr.getResponseHeader("X-Signature"));
}

function pollThor(data, signature) {
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
    setLogsInfo("<pre>" + htmlEncode(res.log_data) + "</pre>");
    pointer = res.pointer_position;
    setTimeout(beginLogView, 1000);
}

function setLogsInfo(data, replace) {
    var $logs = $("#logs");
    if (replace != undefined) {
        $logs.html(data);
    } else {
        $logs.html($logs.html() + "<br />" + data);
    }
}

function beginLogView() {
    var infoUrl = "/judging/logs/ajax";
    $.ajax(infoUrl, {
        type: 'GET',
        dataType: 'json',
        success: handleInfo
    });
}
$(document).ready(function () {

    setLogsInfo("");
    beginLogView();
});
