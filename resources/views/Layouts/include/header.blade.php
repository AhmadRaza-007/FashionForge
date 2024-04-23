<!--    Hamburger CSS     -->
<link rel="stylesheet" href="{{ asset('assets/hamburger.css') }}">

<header class="header">
    <div id="header_content">
        <div class="nav_upper">
            <nav class="navbar">
                <div class="navbar-container container">
                    <input type="checkbox" name="" id="">
                    <div class="hamburger-lines">
                        <span class="line line1"></span>
                        <span class="line line2"></span>
                        <span class="line line3"></span>
                    </div>
                    <?php

                    use App\Models\Collection;

                    $links = Collection::with('subCollection')->get();
                    ?>
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
                {{-- <div class="search mx-3 d-flex">
                    <a class="material-symbols-outlined m-auto" id="search" style="text-decoration:none;">
                        <img srcset="https://img.icons8.com/?size=50&amp;id=132&amp;format=png 1x, https://img.icons8.com/?size=100&amp;id=132&amp;format=png 2x,"
                            src="https://img.icons8.com/?size=100&amp;id=132&amp;format=png" alt="ios7"
                            loading="lazy" width="50" height="50" lazy="loaded"
                            style="object-fit: contain;
                            height: 2rem;;">
                    </a>
                </div> --}}
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

    <div class="search_bar" id="search_bar">
        <div class="d-flex justify-content-center align-items-center">
            <form class="footer_email_input">
                @csrf
                <input type="search" id="footer_email" placeholder="Search" required>
                <button type="submit" class="material-symbols-outlined" style="color: black;">
                    search
                </button>
            </form>
            <div class="search_close_btn" id="search_close_btn">
                <span class="material-symbols-outlined">close</span>
            </div>
        </div>
    </div>
</header>
