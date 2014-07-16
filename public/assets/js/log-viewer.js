function handleInfo(data) {
    alert(data);
}

$(document).ready(function () {
    var infoUrl = "/judging/logs/ajax";
    $.ajax(infoUrl, {
        type: 'GET',
        success: handleInfo
    });
});