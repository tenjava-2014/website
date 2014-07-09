$(function() {
    Chart.defaults.global.showTooltips = true;
    var ctx = $("#myChart").get(0).getContext("2d");
    var $timesData = $("#chosenTimesData");
    var data = [
        {
            value: $timesData.data("t1"),
            color:"#F7464A",
            highlight: "#FF5A5E",
            label: "Time 1"
        },
        {
            value: $timesData.data("t2"),
            color: "#46BFBD",
            highlight: "#5AD3D1",
            label: "Time 2"
        },
        {
            value: $timesData.data("t3"),
            color: "#FDB45C",
            highlight: "#FFC870",
            label: "Time 3"
        }

    ];

    new Chart(ctx).PolarArea(data);

});
