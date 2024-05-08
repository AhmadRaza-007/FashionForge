@extends('app')
@section('content')
<!-- fadeSlider -->
<!-- sideSlider -->
<!-- slideInRight -->
<!-- slideInLeft -->
<!-- slideInTopRight -->
<!-- slideInBottomLeft -->

<div class="container" id="women">
    <section class="women_products mt-5" id="womenProducts">
        <div class="container women_section_name">
            <h1 style="font-size: 3rem;">{{ $products[0]->subCollection->title ?? 'Null' }}</h1>
        </div>
        <div class="products_container">
            @foreach ($products as $product)
            <div class="products">
                <a href="{{ route('user.productDetail', $product->id) }}">
                    <div class="product_card product_card_sm">
                        <img src="{{ asset($product->productImages[0]->product_images) ?? 'Null' }}" class="product_image" alt="">
                    </div>
                    <div class="home_product_contant">
                        <div class="home_product_information">
                            <h3>{{ $product->name ?? 'Null' }}</h3>
                        </div>
                        <div class="home_product_price">
                            <span>Rs. {{ $product->price ?? 'Null' }}.00 PKR</span>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </section>
</div>

<script>
    containerDiv = document.getElementById('women')

    // if (window.innerWidth < 1300) {
    //     containerDiv.classList.remove('container');
    // }
</script>
@endsection
