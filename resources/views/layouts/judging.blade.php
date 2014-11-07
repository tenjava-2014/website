<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <title>{{ $titleAdd or "ten.java" }}</title>
    <link rel="shortcut icon" href="{!! asset('/assets/img/icons/favicon.ico') !!}" type="image/x-icon"/>
    <link rel="apple-touch-icon" href="{!! asset('/assets/img/icons/apple-touch-icon.png') !!}"/>
    <link rel="apple-touch-icon" sizes="57x57" href="{!! asset('/assets/img/icons/apple-touch-icon-57x57.png') !!}"/>
    <link rel="apple-touch-icon" sizes="72x72" href="{!! asset('/assets/img/icons/apple-touch-icon-72x72.png') !!}"/>
    <link rel="apple-touch-icon" sizes="76x76" href="{!! asset('/assets/img/icons/apple-touch-icon-76x76.png') !!}"/>
    <link rel="apple-touch-icon" sizes="114x114" href="{!! asset('/assets/img/icons/apple-touch-icon-114x114.png') !!}"/>
    <link rel="apple-touch-icon" sizes="120x120" href="{!! asset('/assets/img/icons/apple-touch-icon-120x120.png') !!}"/>
    <link rel="apple-touch-icon" sizes="144x144" href="{!! asset('/assets/img/icons/apple-touch-icon-144x144.png') !!}"/>
    <link rel="apple-touch-icon" sizes="152x152" href="{!! asset('/assets/img/icons/apple-touch-icon-152x152.png') !!}"/>
    <link href="{!! elixir('styles.css') !!}" rel="stylesheet"/>
    <script type="application/javascript" src="//cdnjs.cloudflare.com/ajax/libs/fastclick/1.0.0/fastclick.min.js"></script>
    @yield('additional-scripts')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.1.0/css/font-awesome.min.css"/>
    <meta name="description" content="Ten-hour, Java development contests."/>
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1"/>
</head>
<body class="judge-interface">
<div id="wrapper">
    @include('partials.nav', ['logo' => asset('/assets/img/logo_light_judge.svg')])
    <div id="point-ticker">
        <div class="grid-container">
            <div class="grid-20 tablet-grid-20">Actual participants: <span>{{ $turnout['real'] }}</span></div>
            <div class="grid-20 tablet-grid-20">Turnout: <span>{{ sprintf("%.2f%%", ($turnout['real'] / ($turnout['total'] > 0 ? $turnout['total'] : 1)) * 100) }}</span></div>
            <div class="grid-20 tablet-grid-20">Assigned entries: <span>{{ $claims['total'] }}</span></div>
            <div class="grid-20 tablet-grid-20">Completed entries: <span>{{ count($claims['done']) }}</span></div>
            <div class="grid-20 tablet-grid-20">Entries remaining: <span>{{ count($claims['pending']) }}</span></div>
        </div>
    </div>
    @yield('content')
    <div class="push"></div>
</div>
@include('partials.footer')
<script type="application/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
@yield('post-scripts')
<script type="application/javascript" src="{!! asset('/assets/js/time-circles.js') !!}"></script>
<script type="application/javascript" src="{!! asset('/assets/js/jquery.timediff.min.js') !!}"></script>
<script type="application/javascript" src="{!! asset('/assets/js/app.js?v=1.1') !!}"></script>
</body>
</html>
