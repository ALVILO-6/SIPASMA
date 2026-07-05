<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name', 'Laravel'))</title>
    @yield('head_assets')

    @hasSection('styles')
    <style>
        @yield('styles')
    </style>
    @endif
</head>
<body>
@yield('content')

@yield('scripts')
</body>
</html>
