<!doctype html>
<html lang="en">
<head>
    <style>
        body {
            font-family: sans-serif;
            color: #333;
        }
        .footer {
            border-top: 1px solid #999;
            font-size: .75em;
            color: #999;
        }
        a {
            text-decoration: none;
            color: #3b8bba;
        }
    </style>
</head>
<body>
@yield('content')
<p class="footer">
    Don't want to receive these emails anymore? <a href="{{{ $unsubscribe_url }}}">Unsubscribe</a>.
</p>
</body>
</html>
