function getDateLabel(date) {
    return date.getFullYear() + "-" + ('0' + (date.getMonth() + 1)).slice(-2) + "-" + ('0' + date.getDate()).slice(-2);
}

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
        responsive: true
    });


    var $participationData = $("#confirmedAppsData");
    data = [
        {
            value: $participationData.data("co"),
            color:"#46BFBD",
            highlight: "#5AD3D1",
            label: "Confirmed"
        },
        {
            value: $participationData.data("uc"),
            color: "#F7464A",
            highlight: "#FF5A5E",
            label: "Unconfirmed"
        }

    ];

    new Chart($("#confirmedApps").get(0).getContext("2d")).Pie(data, {
        responsive: true
    });


    var timestamps = [];
    var timestampLabels = [];
    var values = {};
    $.getJSON("/api/points", function(data) {
        var transactions = data.recent_transactions.reverse();
        $.each(transactions, function(index, item) {
            var curseTimestamp = item['curse-timestamp'];
            console.log("Dealing with " + item['username'] + " with a CT of " + curseTimestamp + " and amount of " + item.amount);
            if ($.inArray(curseTimestamp, timestamps) == -1) {
                var dateLbl = getDateLabel(new Date(curseTimestamp * 1000));
                //dateLbl = index;
                timestampLabels.push(dateLbl);
                timestamps.push(curseTimestamp);
            }

            var curVal = values[curseTimestamp];
            if (curVal == undefined) {
                values[curseTimestamp] = item.amount;
            } else {
                values[curseTimestamp] += item.amount;
            }

        });
        console.log(timestamps);
        console.log(values);
        var newValues = [];
        var cumulative = [];
        $.each(values, function(index, value) {
            newValues.push(value);
        });
        var runningTotal = 0;
        $.each(values, function(index, value) {
            runningTotal += value;
            cumulative.push(runningTotal);
        });
        var pointsData = {
            labels: timestampLabels,
            responsive: true,
            datasets: [
                {
                    label: "Points",
                    fillColor: "rgba(220,220,220,0.2)",
                    strokeColor: "rgba(220,220,220,1)",
                    pointColor: "rgba(220,220,220,1)",
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(220,220,220,1)",
                    data: newValues
                },
                {
                    label: "Cumulative",
                    fillColor: "rgba(151,187,205,0.2)",
                    strokeColor: "rgba(151,187,205,1)",
                    pointColor: "rgba(151,187,205,1)",
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(151,187,205,1)",
                    data: cumulative
                }
            ]
        };
        var opts = {
            scaleOverride: true,

            // ** Required if scaleOverride is true **
            // Number - The number of steps in a hard coded scale
            scaleSteps: 30,
            // Number - The value jump in the hard coded scale
            scaleStepWidth: 1000,
            // Number - The scale starting value
            scaleStartValue: 0,
            showTooltips: false
        };
        new Chart($("#pointData").get(0).getContext("2d")).Line(pointsData, opts);

    });

});
