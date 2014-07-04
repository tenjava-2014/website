function formatDate(date) {
    return date.getFullYear() + "-" + date.getMonth() + "-" + date.getDay() + " " + date.getHours() + ":" + date.getMinutes() + ":" + date.getSeconds();
}


$(document).ready(function() {
    // Navigation for mobile devices
    $("#nav-toggle").click(function() {
        $("#nav-container").toggleClass("hide-on-mobile");
    });

    // Tool to display dates in local timezones
    $(".date-replacer").each(function() {
        var date = new Date($(this).data("time") * 1000);
        $(this).text(date.toString());
    });

    // Homepage countdown
    // Grab the t1 time
    var $times = $("#times-info");
    var t1 = $times.data("t1");
    var t2 = $times.data("t2");
    var t3 = $times.data("t3");
    var curTime = new Date();
    curTime = new Date(curTime.getTime() + t1);

    $(".time-circle").data("date", formatDate(curTime)).TimeCircles();
});