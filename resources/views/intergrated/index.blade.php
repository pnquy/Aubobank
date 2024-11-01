<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wordpress</title>
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/sass/intergrated.scss', 'resources/sass/profile.scss', 'resources/js/intergrated.js'])
</head>

<body style="background-color: #189444;">
    @include('layouts.menu')

    <div class="profile" style="background-color: #f1f5f8;">
        @include('layouts.navigation')
        <div class="wordpress">
            <div class="block-price">
                @yield('content')
            </div>
        </div>
    </div>
</body>

</html>