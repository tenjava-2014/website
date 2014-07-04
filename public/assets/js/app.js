$(document).ready(function() {
    $("#nav-toggle").click(function() {
        $("#nav-container").toggleClass("hide-on-mobile");
    });
    $(".date-replacer").each(function() {
        var date = new Date($(this).data("time") * 1000);
        $(this).text(date.toString());
    });

    $(".time-circle").TimeCircles();
});