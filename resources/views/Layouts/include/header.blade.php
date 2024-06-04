<!--    Hamburger CSS     -->
<link rel="stylesheet" href="{{ asset('assets/hamburger.css') }}">
<link rel="stylesheet" href="{{ asset('assets/navbar/css/style.css') }}">
{{-- <link rel="stylesheet" href="{{ asset('assets/navbar/css/bootstrap.min.css') }}"> --}}
<link rel="stylesheet" href="{{ asset('assets/navbar/css/animate.css') }}">
<?php

use App\Models\Collection;

$links = Collection::with('subCollection')->get();
?>

<style>
    .dropdown:hover .dropdown-menu {
        display: block;
        margin-top: 0;
        /* remove the gap so it doesn't close */
    }
</style>
{{-- <header class="header">
    <div id="header_content">
        <div>

        </div>
        <div class="nav_upper">
            <nav class="navbar">
                <div class="navbar-container container">
                    <input type="checkbox" name="" id="">
                    <div class="hamburger-lines">
                        <span class="line line1"></span>
                        <span class="line line2"></span>
                        <span class="line line3"></span>
                    </div>
                    <ul class="menu-items">
                        @foreach ($links as $link)
                            <a href="{{ url('/products' . '/' . $link->id) }}"
                                class="d-flex justify-content-between align-items-center">
                                <li>{{ $link->name }}</li>
                            </a>
                        @endforeach
                    </ul>
                </div>
            </nav>
            <div class="logo">
                <a href="#" class="d-flex">
                    <img src="{{ asset('assets/webResources/Belle_Chic_Logo_PNG.png') }}" class="m-auto" alt="Logo">
                </a>
            </div>
            <nav class="nav_links">
                <ul>
                    <li>
                        <a href="{{ url('/home') }}" class="d-flex justify-content-between align-items-center">
                            Home
                        </a>
                    </li>
                    @foreach ($links as $key => $link)
                        <li>
                            <a href="{{ url('/products' . '/' . $link->id) }}"
                                class="d-flex justify-content-between align-items-center">
                                {{ $link->name ?? 'Null' }} &nbsp;
                                @if (count($link->subCollection) > 0)
                                    <i class="fa fa-caret-down"></i>
                                @endif
                            </a>
                            @if (count($link->subCollection) > 0)
                                <ul class="submenu d-block position-absolute bg-light">
                                    @foreach ($link->subCollection as $subCollection)
                                        <a href="{{ url('products/category/' . $subCollection->id) }}"
                                            style="display: inline-block;width: 100%;padding: .5rem 0.3rem;text-decoration:none;">
                                            <li class="text-dark m-0">
                                                {{ $subCollection->title }}
                                            </li>
                                        </a>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </nav>
            <?php
            $cart_count = 0;
            if (Auth::check()) {
                $cart_count = App\Models\Cart::where('user_id', auth()->user()->id)->count();
            }
            ?>
            <div class="d-flex" style="height: 3rem;">
                <div class="cart mx-3">
                    <a href="{{ route('user.cart') }}" class="material-symbols-outlined  position-relative"
                        style="color: white;text-decoration:none;"><span class="cart_count">{{ $cart_count }}</span>
                        <svg class="icon icon-cart" aria-hidden="true" focusable="false" role="presentation"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 40 40" fill="none"
                            style="height: 3rem;
                            width: 4rem;transform: scale(1.2);">
                            <path fill="currentColor" fill-rule="evenodd"
                                d="M20.5 6.5a4.75 4.75 0 00-4.75 4.75v.56h-3.16l-.77 11.6a5 5 0 004.99 5.34h7.38a5 5 0 004.99-5.33l-.77-11.6h-3.16v-.57A4.75 4.75 0 0020.5 6.5zm3.75 5.31v-.56a3.75 3.75 0 10-7.5 0v.56h7.5zm-7.5 1h7.5v.56a3.75 3.75 0 11-7.5 0v-.56zm-1 0v.56a4.75 4.75 0 109.5 0v-.56h2.22l.71 10.67a4 4 0 01-3.99 4.27h-7.38a4 4 0 01-4-4.27l.72-10.67h2.22z">
                            </path>
                        </svg>
                    </a>
                </div>
                <div class="cart mx-3 d-flex justify-content-center align-items-center">
                    <a href="{{ route('user.profile') }}" style="font-size: 1.5rem">
                        <i class="fa fa-user"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</header> --}}




<section class="ftco-section">
    {{-- <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center mb-5">
                <h2 class="heading-section">Website menu #07</h2>
            </div>
        </div>
    </div> --}}

    <div class="container-fluid px-md-5 py-md-4">
        <div class="row justify-content-between">
            <div class="col-md-8 order-md-last">
                <div class="row">
                    <div class="col-md-6 text-center">
                        {{-- <a class="navbar-brand" href="index.html">Logistica <span>Architecture Agency</span></a> --}}
                        <div class="logo" style="width: 5rem; height: 5rem; margin: auto;">
                            <a href="#" class="d-flex">
                                <img src="{{ asset('assets/webResources/Belle_Chic_Logo_PNG.png') }}" class="m-auto"
                                    alt="Logo" style="height: 100%;">
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6 d-md-flex justify-content-end mb-md-0 mb-3">
                        <form action="#" class="searchform order-lg-last">
                            <div class="form-group d-flex">
                                <input type="text" class="form-control pl-3" placeholder="Search"
                                    style="border: 2px solid orange;
                                border-radius: 2rem 0rem 0rem 2rem;height: 3rem !important;">
                                <button type="submit" placeholder="" class="form-control search"
                                    style="display: flex;
                                justify-content: center;
                                align-items: center;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                        <path
                                            d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                                    </svg>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4 d-flex">
                <div class="social" style="display: flex;align-items: center;justify-content: center;">
                    <p class="mb-0 d-flex">
                        {{-- <a href="#" class="d-flex align-items-center justify-content-center">
                            <span class="fa fa-facebook">
                                <i class="sr-only">Facebook</i>
                            </span>
                        </a> --}}
                        <a href="#" class="d-flex align-items-center justify-content-center">
                            <span class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-bag" viewBox="0 0 16 16">
                                    <path
                                        d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1z" />
                                </svg>
                            </span>
                        </a>
                        <a href="#" class="d-flex align-items-center justify-content-center">
                            <span class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                                    <path fill-rule="evenodd"
                                        d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                                </svg>
                            </span>
                        </a>
                        {{-- <a href="#" class="d-flex align-items-center justify-content-center">
                            <span class="fa fa-dribbble">
                                <i class="sr-only">Dribbble</i>
                            </span>
                        </a> --}}
                    </p>
                </div>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar"
        style="width: 100%;height: 4rem;padding-left: 0;padding-right: 0;">
        <div class="container-fluid bg-black">

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
                aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="fa fa-bars"></span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16"
                    style="height: 2.5rem;
                width: 2rem;">
                    <path fill-rule="evenodd"
                        d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5"
                        style="color: white;" />
                </svg>
            </button>
            <div class="collapse navbar-collapse" id="ftco-nav">
                <ul class="navbar-nav m-auto">
                    <li class="nav-item active dropdown">
                        <a href="{{ url('/') }}" class="nav-link text-white" id="dropdown04">
                            Home &nbsp;
                        </a>
                    </li>
                    @foreach ($links as $key => $link)
                        {{-- <li>
                            <a href="{{ url('/products' . '/' . $link->id) }}"
                                class="d-flex justify-content-between align-items-center">
                                {{ $link->name ?? 'Null' }} &nbsp;
                                @if (count($link->subCollection) > 0)
                                    <i class="fa fa-caret-down"></i>
                                @endif
                            </a>
                            @if (count($link->subCollection) > 0)
                                <ul class="submenu d-block position-absolute bg-light">
                                    @foreach ($link->subCollection as $subCollection)
                                        <a href="{{ url('products/category/' . $subCollection->id) }}"
                                            style="display: inline-block;width: 100%;padding: .5rem 0.3rem;text-decoration:none;">
                                            <li class="text-dark m-0">
                                                {{ $subCollection->title }}
                                            </li>
                                        </a>
                                    @endforeach
                                </ul>
                            @endif
                        </li> --}}


                        <li class="nav-item active dropdown">
                            <a href="{{ url('/products' . '/' . $link->id) }}"
                                class="nav-link dropdown-toggle text-white" id="dropdown04">
                                {{ $link->name ?? 'Null' }} &nbsp;
                            </a>

                            @if (count($link->subCollection) > 0)
                                {{-- <ul class="submenu d-block position-absolute bg-light"> --}}
                                <div class="dropdown-menu" aria-labelledby="dropdown04">
                                    @foreach ($link->subCollection as $subCollection)
                                        {{-- <a href="{{ url('products/category/' . $subCollection->id) }}"
                                            style="display: inline-block;width: 100%;padding: .5rem 0.3rem;text-decoration:none;">
                                            <li class="text-dark m-0">
                                                {{ $subCollection->title }}
                                            </li>
                                        </a> --}}
                                        <a class="dropdown-item"
                                            href="{{ url('products/category/' . $subCollection->id) }}">
                                            {{ $subCollection->title }}
                                        </a>
                                    @endforeach
                                </div>
                                {{-- </ul> --}}
                            @endif
                        </li>




                        {{-- <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-white" href="#" id="dropdown04"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Page
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdown04">
                                <a class="dropdown-item" href="#">Page 1</a>
                                <a class="dropdown-item" href="#">Page 2</a>
                                <a class="dropdown-item" href="#">Page 3</a>
                                <a class="dropdown-item" href="#">Page 4</a>
                            </div>
                        </li>
                        <li class="nav-item text-white"><a href="#" class="nav-link text-white">Work</a></li>
                        <li class="nav-item text-white"><a href="#" class="nav-link text-white">Blog</a></li>
                        <li class="nav-item text-white"><a href="#" class="nav-link text-white">Contact</a>
                        </li> --}}
                    @endforeach
                </ul>
            </div>
        </div>
    </nav>
    <!-- END nav -->

</section>


<script src="{{ asset('assets/navbar/js/popper.js') }}"></script>
<script src="{{ asset('assets/navbar/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/navbar/js/main.js') }}"></script>
<script src="{{ asset('assets/navbar/js/bootstrap.min.js') }}"></script>
