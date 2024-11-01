<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tổng quan</title>
</head>
@vite(['resources/js/form.js','resources/sass/overview.scss','resources/js/overview.js','resources/js/app.js', 'resources/sass/profile.scss'])

<body style="background-color: #189444;">
    @include('layouts.menu')

    <div class="profile">
        @include('layouts.navigation')
        <div class="content">
        @yield('content')
        </div>



</body>

</html>