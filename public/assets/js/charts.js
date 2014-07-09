$(function() {
    Chart.defaults.global.showTooltips = true;
    var ctx = $("#chosenTimes").get(0).getContext("2d");
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

    new Chart(ctx).PolarArea(data, {
        responsive: true,
        legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
    });

    var timestamps = [];
    var values = [];
    $.getJSON("/api/points", function(data) {
        $.each(data.recent_transactions, function(item) {
            if (!$.inArray(item['curse-timestamp'], timestamps)) {
                timestamps.push(item['curse-timestamp']);
                values[item['curse-timestamp']] += item.amount;
            }
        });
        console.log(timestamps);
        console.log(values);
    })

});
