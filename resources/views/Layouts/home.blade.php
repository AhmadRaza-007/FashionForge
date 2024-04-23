@extends('app')
@section('content')
    <!-- fadeSlider -->
    <!-- sideSlider -->
    <!-- slideInRight -->
    <!-- slideInLeft -->
    <!-- slideInTopRight -->
    <!-- slideInBottomLeft -->

    <div id="home">
        <div id="fadeSlider" class="sliderWrapper mb-3" style="width:100%; min-height:15rem; height:40rem; object-fit:cover">
            <div class="slider">
                <div class="slide"><img src="{{ asset('assets/webResources/banner-2.jpg') }}" style="object-fit: cover;">
                </div>
                <div class="slide"><img src="{{ asset('assets/webResources/banner-3.jpg') }}" style="object-fit: cover;">
                </div>
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
                                    <img src="{{ asset($product->productImages[0]->product_images) }}" class="product_image"
                                        alt="">
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
@endsection
