@extends('app')
@section('content')
    <!-- fadeSlider -->
    <!-- sideSlider -->
    <!-- slideInRight -->
    <!-- slideInLeft -->
    <!-- slideInTopRight -->
    <!-- slideInBottomLeft -->

    <div id="home">
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
            </div>
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    {{ $products->links() }}
                </ul>
            </nav>
        </section>
    </div>
@endsection
