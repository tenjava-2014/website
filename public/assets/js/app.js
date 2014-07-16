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

function calculateTimes() {
    var lowestVal = 0;
    $("time").each(function () {
        var t = new Date();
        var secs = $(this).data("secs");
        t.setSeconds(t.getSeconds() + secs);
        if (lowestVal == 0 || secs < lowestVal) {
            lowestVal = secs + 1;
        }
        $(this).attr("datetime", t.toISOString());
    });
    if (lowestVal != 0) {
        setTimeout(refreshThemes, lowestVal * 1000);
    }
    $('time').timediff();
}

function refreshThemes() {
    $("#themes").load("/themes?ajax=1", function() {
        calculateTimes();
    });
}

$(document).ready(function () {

    calculateTimes();

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
    if ($times.length > 0) {
        var t1 = $times.data("t1");

        var t2 = $times.data("t2");
        var t3 = $times.data("t3");
        var t3End = $times.data("t3") + (60 * 60 * 10);
        var $time = $(".time-circle");
        var curTime = new Date();

        var $contestTime = $("#contestTime");
        if (t1 < 0 && t2 > 0 && t3 > 0) {
            $contestTime.text("Time until timeslot 2 start:");
            $time.data("active-time", "t2");
            curTime = new Date(curTime.getTime() + (t2 * 1000));
            $time.data("date", formatDate(curTime)).TimeCircles();
        } else if (t1 > 0) {
            $contestTime.text("Time until timeslot 1 start:");
            $time.data("active-time", "t1");
            curTime = new Date(curTime.getTime() + (t1 * 1000));
            $time.data("date", formatDate(curTime)).TimeCircles();
        } else if (t1 < 0 && t2 < 0 && t3 > 0) {
            $contestTime.text("Time until timeslot 3 start:");
            $time.data("active-time", "t3");
            curTime = new Date(curTime.getTime() + (t3 * 1000));
            $time.data("date", formatDate(curTime)).TimeCircles();
        } else if (t3 < 0 && t3End > 0) {
            $contestTime.text("Time until contest end:");
            $time.data("active-time", "t3e");
            curTime = new Date(curTime.getTime() + (t3End * 1000));
            $time.data("date", formatDate(curTime)).TimeCircles();
        } else {
            $contestTime.text("Contest has ended! Check twitter for updates on judging.");
            $time.hide();
        }
    }


    $contestTime.click(function () {
        $time.data("date", formatDate(curTime)).TimeCircles();
    });


    $time.data("active-time", "t1");
    setTimeout(refreshCommits, 30000);
});

$("input[type=\"range\"]").on('input', function() {
    alert($(this).val());
});