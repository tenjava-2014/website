<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>
        @section('title')
            ten.java 2014
        @stop
    </title>
    <link href="//cdnjs.cloudflare.com/ajax/libs/gumby/2.6.0/css/gumby.min.css" rel="stylesheet">
    <script type="application/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <link href="/assets/css/styles.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <div class="row">
        @yield('content')
    </div>
    @yield('scripts')
</body>
</html>
