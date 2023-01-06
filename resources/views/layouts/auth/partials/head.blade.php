<head>
    <meta charset="utf-8">
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('favicon.ico') }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'Laravel') &mdash; {{ config('app.name') }}</title>

    <!-- Fonts -->
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <!-- Custom Styles -->
    @stack('stylesheet')
</head>
