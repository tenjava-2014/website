<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>{{ $titleAdd or "ten.java" }}</title>
    <link rel="icon" type="image/png" href="{!! asset('/assets/img/favicon.ico') !!}" />
    <link href="{!! asset('/assets/css/grid.css') !!}" rel="stylesheet" />
    <link href="{!! asset('/assets/css/styles.css') !!}?v=1.51" rel="stylesheet" />
    <script type="application/javascript" src="//cdnjs.cloudflare.com/ajax/libs/fastclick/1.0.0/fastclick.min.js"></script>
    @yield('additional-scripts')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.1.0/css/font-awesome.min.css">
    <meta name="description" content="Ten hour Bukkit plugin development contest." />
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />
</head>
<body class="donate-interface">
<div id="wrapper">
    @include('partials.nav', ['logo' => asset('/assets/img/logo_light_secure.svg')])
    <div id="point-ticker">
        <div class="grid-container">
            <div class="grid-25 tablet-grid-20">
                Latest Donation:
                <span>
                    @if ($pointsData->recent->count() > 0)
                    {{ $pointsData->recent{0}->user->username }} ({{ $formatter->formatCurrency($pointsData->recent{0}->amount, 'USD') }})
                    @else
                    None
                    @endif
                </span>
            </div>
            <div class="grid-25 tablet-grid-20">
                Top Donor:
                <span>
                    @if ($pointsData->top->count() > 0)
                    {{ $pointsData->top{0}->username }} ({{ $formatter->formatCurrency($pointsData->top{0}->amount, 'USD') }})
                    @else
                    None
                    @endif
                </span>
            </div>
            <div class="grid-25 tablet-grid-20">Prize: <span>{{ $formatter->formatCurrency($pointsData->totalMoney, 'USD') }}</span>
            </div>
            <div class="grid-25 tablet-grid-20">Total Sign-ups: <span>{{ $pointsData->teams }} {{ Str::plural('team', $pointsData->teams) }}</span></div>
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
