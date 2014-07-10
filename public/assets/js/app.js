function formatDate(date) {
    return date.getFullYear() + "-" + ('0' + (date.getMonth() + 1)).slice(-2) + "-" + ('0' + date.getDate()).slice(-2) + " " + ('0' + date.getHours()).slice(-2) + ":" + ('0' + date.getMinutes()).slice(-2) + ":" + ('0' + date.getSeconds()).slice(-2);
}

function refreshCommits() {
    var url = "/ajax/commits";
    var $commits = $("#commits");
    if ($commits.length == 0) {
        return;
    }
    var previousHash = $commits.find("#commitHash").data("hash");
    $commits.load(url, function (response, status, xhr) {
        if ($commits.find("#commitHash").length == 0) {
            $commits.html("");
        }
        if ($commits.find("#commitHash").data("hash") != previousHash) {
            $commits.find("#commitsInner").delay(100).fadeOut("fast").fadeIn('fast');
        }
        setTimeout(refreshCommits, 30000);
    });

}

$(document).ready(function () {
    $("time").each(function () {
        var t = new Date();
        t.setSeconds(t.getSeconds() + $(this).data("secs"));
        $(this).attr("datetime", t.toISOString());

    });
    $('time').timediff();

    // Navigation for mobile devices
    $("#nav-toggle").click(function () {
        $("#nav-container").toggleClass("hide-on-mobile");
    });

    // Tool to display dates in local timezones
    $(".date-replacer").each(function () {
        var date = new Date($(this).data("time") * 1000);
        $(this).text(date.toString());
    });


    // Homepage countdown
    // Grab the t1 time
    var $times = $("#times-info");
    var t1 = $times.data("t1");

    var t2 = $times.data("t2");
    var t3 = $times.data("t3");
    var $time = $(".time-circle");
    var curTime = new Date();

    var $contestTime = $("#contestTime");
    if (t1 < 0 && t2 > 0) {
        $contestTime.text("Time remaining for timeslot 1:");
        $time.data("active-time", "t1e");
        curTime = new Date(curTime.getTime() + (t1 * 1000) + 1000 * 60 * 60 * 10);
        $time.data("date", formatDate(curTime)).TimeCircles();
    } else if (t1 > 0) {
        $contestTime.text("Time until timeslot 1 start:");
        $time.data("active-time", "t1");
        curTime = new Date(curTime.getTime() + (t1 * 1000));
        $time.data("date", formatDate(curTime)).TimeCircles();
    } else if (t1 > 0) {
        $contestTime.text("Time until timeslot 1 start:");
        $time.data("active-time", "t1");
        curTime = new Date(curTime.getTime() + (t1 * 1000));
        $time.data("date", formatDate(curTime)).TimeCircles();
    }


    $contestTime.click(function () {
        $time.data("date", formatDate(curTime)).TimeCircles();
    });


    $time.data("active-time", "t1");
    setTimeout(refreshCommits, 30000);
});