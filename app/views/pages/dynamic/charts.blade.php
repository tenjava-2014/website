@extends('layouts.master')
@section('additional-scripts')
<script type="application/javascript" src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/0.2.0/Chart.min.js"></script>
@stop
@section('content')
<div class="content-back">
    <div class="grid-container">
        <div class="grid-100">
            <h2>Chosen times</h2>
            <canvas id="myChart" width="400" height="400"></canvas>
        </div>
    </div>
</div>
@stop
@section('post-scripts')
<script type="application/javascript">
    $(document).ready(function() {
        // Get context with jQuery - using jQuery's .get() method.
        var ctx = $("#myChart").get(0).getContext("2d");
        // This will get the first returned node in the jQuery collection.
        var data = [
            {
                value: 300,
                color:"#F7464A",
                highlight: "#FF5A5E",
                label: "Red"
            },
            {
                value: 50,
                color: "#46BFBD",
                highlight: "#5AD3D1",
                label: "Green"
            },
            {
                value: 100,
                color: "#FDB45C",
                highlight: "#FFC870",
                label: "Yellow"
            },
            {
                value: 40,
                color: "#949FB1",
                highlight: "#A8B3C5",
                label: "Grey"
            },
            {
                value: 120,
                color: "#4D5360",
                highlight: "#616774",
                label: "Dark Grey"
            }

        ];
        var myNewChart = new Chart(ctx).PolarArea(data, {});
    });

</script>
@stop