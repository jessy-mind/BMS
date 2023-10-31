<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BMS - Make your bussness simple</title>
    <link rel="stylesheet" href="{{ asset('dash/assets/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dash/assets/fonts/fontawesome-all.min.css') }}">
</head>
<body>
    <div id="app">
        @if (Auth::check())
            <mainapps :user="{{ Auth::user() }}"></mainapps>
        @else
            <mainapps :user="false"></mainapps>
        @endif
    </div>
</body>
<script>
    (function() {
        window.Laravel = {
            csrfToken: '{{ csrf_token() }}'
        };
    })();
</script>
<script src="{{ asset('dash/assets/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('dash/assets/js/bs-init.js') }}"></script>
<script src="{{ asset('dash/assets/js/chart.min.js') }}"></script>
<script src="{{ asset('dash/assets/js/theme.js') }}"></script>
<script src="{{ mix('/js/app.js') }}"></script>
</html>