function handleInfo(data) {
    alert(JSON.stringify(data));
}

$(document).ready(function () {
    var infoUrl = "/judging/logs/ajax";
    $.ajax(infoUrl, {
        type: 'GET',
        dataType: 'json',
        success: handleInfo
    });
});