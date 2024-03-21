<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- <link rel="stylesheet" href="{{ asset('assets/style.css') }}"> --}}

    <!--    Dashboard css     -->
    <link rel="stylesheet" href="{{ asset('assets/admin/dashboard.css') }}">

    <!--    Cards css     -->
    <link rel="stylesheet" href="{{ asset('assets/admin/cards.css') }}">

    <!--    Custom css     -->
    {{-- <link rel="stylesheet" href="{{ asset('assets/admin/custom.css') }}"> --}}

    <!--    font Awesome     -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!--    Google Icons     -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

    <!--    Google Fonts     -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Source+Serif+Pro:400,600&display=swap" rel="stylesheet">

    <!--    Bootstrap 5     -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!--    Data Tables     -->
    <link href="{{ asset('dataTables/datatablestyle.css') }}" rel="stylesheet" />

    <!--    Bootstrap 4     -->
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet"> -->

    <!-- MultiSelect Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS For MultiSelect -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Style Link For MultiSelect -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/css/select2.min.css" rel="stylesheet" />

    <!-- MultiSelect CSS File  -->
    <link rel="stylesheet" href="{{ asset('assets/multiSelect/css/style.css') }}">

    <style>
        a {
            text-decoration: none;
        }

        a:hover {
            color: unset;
        }

        pre {
            color: unset
        }

        .nav_links {
            width: 70%;
        }

        .nav_links a {
            color: black;
        }

        .nav_links ul {
            display: flex;
            list-style: none;
            padding: 0;
            width: 100%;
            align-items: center;
            justify-content: space-between;
            margin: auto;
        }

        .nav_links ul li ul {
            display: none !important;
            width: 10rem;
        }

        .nav_links ul li:hover ul {
            display: block !important;
            padding: .7rem;
            width: 10rem;
            border-radius: .5rem;
            border: 1px solid lightgray;
        }

        .nav_links ul li ul a:hover {
            background-color: lightgray;
            border-radius: .2rem;
        }

        .logo {
            height: 4rem;
        }
    </style>

    <title>Document</title>
</head>

<body class="body_theme_light">

    <div class='dashboard'>
        <div class='dashboard-app'>
            <header class='dashboard-toolbar d-flex justify-content-between align-items-center'>
                {{-- <a href="#" class="menu-toggle">
                    <i class="fas fa-bars"></i>
                </a> --}}
                <div class="logo">
                    <a href="{{ url('') }}" class="d-flex">
                        <img src="{{ asset('assets/webResources/Belle_Chic_Logo_PNG.png') }}" class="m-auto logo"
                            alt="Logo">
                    </a>
                </div>
                <?php

                use App\Models\Collection;

                $links = Collection::with('subCollection')->get();
                ?>
                <nav class="nav_links">
                    <ul>
                        <li>
                            <a href="{{ url('/home') }}" class="d-flex justify-content-between align-items-center">
                                Home
                            </a>
                        </li>
                        @foreach ($links as $key => $link)
                            <li>
                                <a href="{{ url('/womenSection' . '/' . $link->id) }}"
                                    class="d-flex justify-content-between align-items-center">
                                    {{ $link->name ?? 'Null' }} &nbsp;
                                    @if (count($link->subCollection) > 0)
                                        <i class="fa fa-caret-down"></i>
                                    @endif
                                </a>
                                @if (count($link->subCollection) > 0)
                                    <ul class="submenu d-block position-absolute bg-light">
                                        @foreach ($link->subCollection as $subCollection)
                                            <a href="{{ $subCollection->image_url }}"
                                                style="display: inline-block;width: 100%;padding: .5rem 0.3rem;">
                                                <li class="text-dark nv-hoverValue">
                                                    {{ $subCollection->title }}
                                                </li>
                                            </a>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endforeach
                        <?php
                        $cart_count = 0;
                        if (Auth::check()) {
                            $cart_count = App\Models\Cart::where('user_id', auth()->user()->id)->count();
                        }
                        ?>
                        {{-- <div class="d-flex" style="height: 3rem;"> --}}
                        {{-- <li class="search mx-3 d-flex">
                                <i class="fa-solid fa-magnifying-glass" style="margin: auto;"></i>
                            </li> --}}
                        <li class="cart mx-3 d-flex justify-content-center align-items-center">
                            <a href="{{ route('user.cart') }}" class="material-symbols-outlined  position-relative"
                                style="color:black;text-decoration:none;margin-bottom: 5px;">
                                <i class="fa-solid fa-bag-shopping" style="margin: auto;"></i>
                            </a>
                        </li>
                        <li class="cart mx-3 d-flex justify-content-center align-items-center">
                            <a href="{{ route('user.profile') }}" style="color:black;font-size: 1.5rem">
                                <i class="fa fa-user" style="margin: auto;"></i>
                            </a>
                        </li>
                        {{-- </div> --}}
                    </ul>
                </nav>

                {{-- <form id="themeForm" action="{{ route('setTheme') }}" method="GET" class="m-0">
                    @csrf
                    <div class="checkbox-wrapper-54">
                        <label class="switch">
                            <input type="checkbox" id="switchCeckbox" type='checkbox' name="theme"
                                @if (Illuminate\Support\Facades\Cookie::get('theme') == 'light') checked @endif onchange="saveData(), toggleTheme()">
                            <span class="slider"></span>
                        </label>
                    </div>
                </form> --}}
            </header>

            <div class="dashboard-nav">
                <header class="sidebar_header">
                    <a href="{{ route('admin.dashboard') }}" class="menu-toggle">
                        <i class="fas fa-bars"></i>
                    </a>
                    <a href="#" class="brand-logo">
                        <i class="fas fa-anchor"></i>
                        <span>Profile</span>
                    </a>
                </header>
                <nav class="dashboard-nav-list">
                    {{-- <a href="{{ route('user.profile') }}" class="dashboard-nav-item">
                        <i class="fas fa-home"></i>
                        Personal Details
                    </a> --}}
                    <a href="{{ route('user.address') }}" class="dashboard-nav-item">
                        <i class="fas fa-tachometer-alt"></i>
                        Personal Details
                    </a>
                    <a href="{{ route('user.purchased') }}" class="dashboard-nav-item">
                        <i class="fas fa-file-upload">
                        </i>
                        Orders
                    </a>
                    <a href="{{ route('admin.clothes') }}" class="dashboard-nav-item">
                        <i class="fas fa-file-upload"></i>
                        Purchased History
                    </a>


                    <div class="nav-item-divider"></div>
                    <form id="adminLogout" action="{{ route('admin.postLogout') }}" method="post"
                        style="cursor: pointer;">
                        @csrf
                        <a class="dashboard-nav-item" onclick="document.getElementById('adminLogout').submit()">
                            <i class="fas fa-sign-out-alt"></i>
                            Logout
                        </a>
                    </form>
                </nav>
            </div>
            @yield('content')
        </div>
    </div>





    <!--    JQuery     -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!--    Custom     -->
    <script src="{{ asset('assets/admin/script.js') }}"></script>

    <!--    Bootstrap 5     -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>


    <!--    Data Tables     -->
    <script src="{{ asset('dataTables/simple-datatables.js') }}" crossorigin="anonymous"></script>
    <script src="{{ asset('dataTables/datatables-simple-demo.js') }}"></script>

    <!-- MultiSelect JS -->
    <script src="{{ asset('assets/multiSelect/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/multiSelect/js/popper.js') }}"></script>
    <script src="{{ asset('assets/multiSelect/js/bootstrap.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js"></script>
    <script src="{{ asset('assets/multiSelect/js/main.js') }}"></script>
</body>

</html>
