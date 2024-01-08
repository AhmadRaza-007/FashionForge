<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('assets/style.css') }}">

    <!--    Banner Slider     -->
    <link rel="stylesheet" href="{{ asset('assets/bannerSlider/slider.css') }}">

    <!--    Google Icons     -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

    <!--    Bootstrap 5     -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!--    Font Awesome     -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>Document</title>
</head>

<body>

    @include('Layouts.header')
    @yield('content')
    @include('Layouts.footer')


    <script src="{{ asset('assets/bannerSlider/slider.js') }}"></script>
    <script src="{{ asset('assets/script.js') }}"></script>

    <!-- <script>
        let buyNow = document.getElementById('detail_image')
        console.log(buyNow);
    </script> -->
</body>

</html>
