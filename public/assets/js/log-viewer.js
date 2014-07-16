function handleInfo(data) {
    setLogsInfo("Got data from server " + JSON.stringify(data));
}

function setLogsInfo(data) {
    $("#logs").text(data);
}

$(document).ready(function () {
    var infoUrl = "/judging/logs/ajax";
    $.ajax(infoUrl, {
        type: 'GET',
        dataType: 'json',
        success: handleInfo
    });
});