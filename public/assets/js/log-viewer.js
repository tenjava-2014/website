var pointer = 0;

function handleInfo(res, status, xhr) {
    pollThor(res, xhr.getResponseHeader("X-Signature"));
}

function pollThor(data, signature) {
    var url = "https://results.tenjava.com:8181/log";
    $.ajax({
        type: 'POST',
        url: url,
        data: JSON.stringify(data),
        success: handleThorData,
        contentType: "application/json",
        dataType: 'json',
        beforeSend: function (request) {
            request.setRequestHeader("X-Signature", signature);
            request.setRequestHeader("X-Pointer-Position", pointer);
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
    if (res.bytes_read == 0) {
        setTimeout(beginLogView, 5000);
        return;
    }
    setLogsInfo(htmlEncode(res.log_data));
    pointer = res.pointer_position;
    setTimeout(beginLogView, 5000);
}

function setLogsInfo(data, replace) {
    var $logs = $("#logs");
    if (replace != undefined || $logs.text() == "") {
        $logs.html(data);
    } else {
        $logs.html($logs.html() + data);
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

    setLogsInfo("", true);
    beginLogView();
});
