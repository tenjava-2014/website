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
    $(".time-circle").TimeCircles();
});