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
        $.each(data.recent_transactions, function(index, item) {
            var curseTimestamp = item['curse-timestamp'];
            if ($.inArray(curseTimestamp, timestamps) == -1) {
                console.log("Dealing with " + item['username'] + " with a CT of " + curseTimestamp + " and amount of " + item.amount);
                timestamps.push(curseTimestamp);
                var curVal = values[curseTimestamp];
                if (curVal == undefined) {
                    values[curseTimestamp] = item.amount;
                } else {
                    values[curseTimestamp] += item.amount;
                }
            }
        });
        console.log(timestamps);
        console.log(values);
    })

});
