@extends('app')
@section('content')
    <link rel="stylesheet" href="{{ asset('assets/slider/slick/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/slider/slick/slick-theme.css') }}">

    <style>
        .slick-slide img {
            display: block;
            width: 100%;
            aspect-ratio: 8/3.5;
            height: auto;
        }

        .slick-next {
            right: 0;
            z-index: 10;
        }

        .slick-prev {
            left: 0;
            z-index: 10;
        }
    </style>
    <!-- fadeSlider -->
    <!-- sideSlider -->
    <!-- slideInRight -->
    <!-- slideInLeft -->
    <!-- slideInTopRight -->
    <!-- slideInBottomLeft -->

    <div id="home">
        {{-- <div id="slideInRight" class="sliderWrapper mb-3"
            style="width:100%; min-height:15rem; height:40rem; object-fit:cover">
            <div class="slider">
                <div class="slide"><img src="{{ asset('assets/webResources/banner-2.jpg') }}" style="object-fit: cover;">
                </div>
                <div class="slide"><img src="{{ asset('assets/webResources/banner-3.jpg') }}" style="object-fit: cover;">
                </div>
            </div>
        </div> --}}

        <div class="slider demo" id="demo">
            <div class="slide"><img src="{{ asset('assets/webResources/banner-2.jpg') }}" style="object-fit: cover;">
            </div>
            <div class="slide"><img src="{{ asset('assets/webResources/banner-3.jpg') }}" style="object-fit: cover;">
            </div>
        </div>

        <div class="collection my-5">
            <div class="container home_section_name my-5">
                <h1 style="font-size: 3rem;text-align: center;">CATEGORIES</h1>
            </div>
            <div class="subCollection_container">
                @foreach ($subCollection as $product)
                    <div class="subCollection">
                        <a href="{{ route('user.category', $product->id) }}" class="text-decoration-none">
                            <div class="product_card">
                                <img src="{{ asset($product->image) }}" class="product_image" alt="">
                            </div>
                            <div class="home_product_contant">
                                <div class="home_product_information">
                                    <h3 class="" style="font-size: 2rem;">{{ $product->title }}</h3>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>

        <section class="home_products mt-5" id="homeProducts">
            <div class="container home_section_name">
                <h1 style="font-size: 3rem;text-align: center;">Products</h1>
            </div>
            <div class="products_container">
                @foreach ($products as $product)
                    <div class="products">
                        <a href="{{ route('user.productDetail', $product->id) }}">
                            <div class="product_card">
                                @if ($product->productImages[0]->product_images)
                                    <img src="{{ asset($product->productImages[0]->product_images) }}"
                                        class="product_image" alt="">
                                @else
                                    <img src="{{ asset('assets/uploads/1701084944-1699862641-anime-cartoon-character-vector-illustration_648489-34.jpg.avif') }}"
                                        class="product_image" alt="">
                                @endif
                            </div>
                            <div class="home_product_contant">
                                <div class="home_product_information">
                                    <h3>{{ $product->name }}</h3>
                                </div>
                                <div class="home_product_price">
                                    <span>Rs. {{ $product->price }}.00 PKR</span>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
                {{-- <div class="row">
                    {{ $products->links() }}
                </div> --}}

                {{-- <div class="products">
                <a href="#">
                    <div class="product_card">
                        <img src="{{ asset('assets/webResources/image.jpeg') }}" class="product_image" alt="">
                    </div>
                    <div class="home_product_contant">
                        <div class="home_product_information">

                            <h3> Belle Chic 2 Pcs Winter Tracksuit </h3>

                        </div>
                        <div class="home_product_price">
                            <span> Rs.2,999.00 PKR </span>
                        </div>
                    </div>
                </a>
                </div> --}}
            </div>
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    {{ $products->links() }}
                </ul>
            </nav>
        </section>
    </div>

    {{-- <script src="{{ asset('assets/multiSelect/js/jquery.min.js') }}"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
            integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('assets/slider/slick/slick.js') }}"></script>
    <script>
        // $(document).ready(function() {
        //     $('#demo').slick();
        // });

        $('#demo').slick({

            // Enables tabbing and arrow key navigation
            accessibility: true,

            // Adapts slider height to the current slide
            adaptiveHeight: true,

            // Change where the navigation arrows are attached (Selector, htmlString, Array, Element, jQuery object)
            // appendArrows: $(element),

            // Change where the navigation dots are attached (Selector, htmlString, Array, Element, jQuery object)
            // appendDots: $(element),

            // Enable Next/Prev arrows
            arrows: true,

            // Sets the slider to be the navigation of other slider (Class or ID Name)
            asNavFor: null,

            // prev arrow
            prevArrow: '<button type="button" data-role="none" class="slick-prev">Previous</button>',

            // next arrow
            nextArrow: '<button type="button" data-role="none" class="slick-next" style="right: 0;">Next</button>',

            // Enables auto play of slides
            autoplay: true,
            // autoplay: true,


            // Auto play change interval
            autoplaySpeed: 3000,

            // Enables centered view with partial prev/next slides.
            // Use with odd numbered slidesToShow counts.
            centerMode: false,

            // Side padding when in center mode. (px or %)
            centerPadding: '50px',

            // CSS3 easing
            cssEase: 'ease',

            // Custom paging templates.
            customPaging: function(slider, i) {
                return '<button type="button" data-role="none">' + (i + 1) + '</button>';
            },

            // Current slide indicator dots
            dots: true,

            // Class for slide indicator dots container
            dotsClass: 'slick-dots',

            // Enables desktop dragging
            draggable: true,

            // animate() fallback easing
            easing: 'linear',

            // Resistance when swiping edges of non-infinite carousels
            edgeFriction: 0.35,

            // Enables fade
            fade: false,

            // Focus on select and/or change
            focusOnSelect: false,
            focusOnChange: false,

            // Infinite looping
            infinite: true,

            // Initial slide
            initialSlide: 0,

            // Accepts 'ondemand' or 'progressive' for lazy load technique
            lazyLoad: 'ondemand',

            // Mobile first
            mobileFirst: true,

            // Pauses autoplay on hover
            pauseOnHover: true,

            // Pauses autoplay on focus
            pauseOnFocus: false,

            // Pauses autoplay when a dot is hovered
            pauseOnDotsHover: false,

            // Target containet to respond to
            respondTo: 'window',

            // Breakpoint triggered settings
            /* eg
            responsive: [{

              breakpoint: 1024,
              settings: {
                slidesToShow: 3,
                infinite: true
              }

            }, {

              breakpoint: 600,
              settings: {
                slidesToShow: 2,
                dots: true
              }

            }, {

              breakpoint: 300,
              settings: "unslick" // destroys slick

            }]
            */
            responsive: null,

            // Setting this to more than 1 initializes <a href="https://www.jqueryscript.net/tags.php?/grid/">grid</a> mode.
            // Use slidesPerRow to set how many slides should be in each row.
            rows: 1,

            // Change the slider's direction to become right-to-left
            rtl: false,

            // Slide element query
            slide: '',

            // # of slides to show at a time
            slidesToShow: 1,

            // With grid mode intialized via the rows option, this sets how many slides are in each grid row.
            slidesPerRow: 1,

            // # of slides to scroll at a time
            // slidesTo < a href = "https://www.jqueryscript.net/tags.php?/Scroll/" > Scroll < /a>: 1,

            // Transition speed
            speed: 500,

            // Enables touch swipe
            swipe: true,

            // Swipe to slide irrespective of slidesToScroll
            swipeToSlide: false,

            // Enables slide moving with touch
            touchMove: true,

            // To advance slides, the user must swipe a length of (1/touchThreshold) * the width of the slider.
            touchThreshold: 5,

            // Enable/Disable CSS Transitions
            useCSS: true,

            // Enable/Disable CSS Transforms
            useTransform: true,

            // Disables automatic slide width calculation
            variableWidth: false,

            // Vertical slide direction
            vertical: false,

            // hanges swipe direction to vertical
            verticalSwiping: false,

            // Ignores requests to advance the slide while animating
            waitForAnimate: true,

            // Set the zIndex values for slides, useful for IE9 and lower
            zIndex: 1000

        });
    </script>
@endsection
