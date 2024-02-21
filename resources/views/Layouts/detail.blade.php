@extends('app')
@section('content')
    <div class="container" id="women">
        <section class="women_products" id="womenProducts">
            <div class="products_container_detail">
                @foreach ($products as $key => $product)
                    <div class="product_detail_section" style="position: sticky;top: 8rem;height: fit-content;">
                        <div class="product_card product_card_lg">
                            <img src="{{ asset($product->productImages[0]->product_images) ?? 'Null' }}" class="detail_image"
                                id="detail_image" alt="">
                        </div>
                        <div class="detail_more_images d-flex justify-content-start mt-2">
                            @foreach ($product->productImages as $images)
                                <div class="detail_images_sm mx-1">
                                    <img src="{{ asset($images->product_images) }}" alt="" height="150"
                                        class="detail_image_sm">
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <form class="products_details_section" action="{{ route('user.check', $product->id) }}" method="get">
                        @csrf
                        <div class="product_title  py-3">
                            <h1 style="font-size: 3.5rem;font-weight: 300;">{{ $product->name }}</h1>
                            <div class="home_product_price my-2">
                                <span>Rs. {{ $product->price ?? 'Null' }}.00 PKR</span>
                            </div>
                            <input type="hidden" name="hidden_price" id="hidden_price"
                                value="{{ $product->price ?? 'Null' }}">
                            <div class="mt-4 mb-2">
                                <fieldset class="size_counter">
                                    <legend>Size</legend>
                                    @foreach ($product->size as $key => $size)
                                        @if ($size->size == 'S')
                                            @if ($key === 0)
                                                <input type="radio" class="size_radio_buttons" id="ageS"
                                                    name="size" value="{{ $size->id }}" checked>
                                            @else
                                                <input type="radio" class="size_radio_buttons" id="ageS"
                                                    name="size" value="{{ $size->id }}">
                                            @endif
                                            <label for="ageS" class="size_label">{{ $size->size }}</label>
                                        @elseif ($size->size == 'M')
                                            @if ($key === 0)
                                                <input type="radio" class="size_radio_buttons" id="ageM"
                                                    name="size" value="{{ $size->id }}" checked>
                                            @else
                                                <input type="radio" class="size_radio_buttons" id="ageM"
                                                    name="size" value="{{ $size->id }}">
                                            @endif
                                            <label for="ageM" class="size_label">{{ $size->size }}</label>
                                        @elseif ($size->size == 'L')
                                            @if ($key === 0)
                                                <input type="radio" class="size_radio_buttons" id="ageL"
                                                    name="size" value="{{ $size->id }}" checked>
                                            @else
                                                <input type="radio" class="size_radio_buttons" id="ageL"
                                                    name="size" value="{{ $size->id }}">
                                            @endif
                                            <label for="ageL" class="size_label">{{ $size->size }}</label>
                                        @elseif ($size->size == 'XL')
                                            @if ($key === 0)
                                                <input type="radio" class="size_radio_buttons" id="ageXL"
                                                    name="size" value="{{ $size->id }}" checked>
                                            @else
                                                <input type="radio" class="size_radio_buttons" id="ageXL"
                                                    name="size" value="{{ $size->id }}">
                                            @endif
                                            <label for="ageXL" class="size_label">{{ $size->size }}</label>
                                        @elseif ($size->size == 'XXL')
                                            @if ($key === 0)
                                                <input type="radio" class="size_radio_buttons" id="ageXXL"
                                                    name="size" value="{{ $size->id }}" checked>
                                            @else
                                                <input type="radio" class="size_radio_buttons" id="ageXXL"
                                                    name="size" value="{{ $size->id }}">
                                            @endif
                                            <label for="ageXXL" class="size_label">{{ $size->size }}</label>
                                        @endif
                                    @endforeach
                                </fieldset>
                            </div>

                            <div class="mt-4 mb-2">
                                <fieldset class="color_counter">
                                    <legend>Color</legend>
                                    @foreach ($product->color as $key => $color)
                                        @if ($key === 0)
                                            <input type="radio" class="color_radio_buttons"
                                                id="color_{{ $color->color }}" name="color" value="{{ $color->id }}"
                                                checked>
                                        @else
                                            <input type="radio" class="color_radio_buttons"
                                                id="color_{{ $color->color }}" name="color"
                                                value="{{ $color->id }}">
                                        @endif
                                        <label for="color_{{ $color->color }}"
                                            class="color_label">{{ $color->color }}</label>
                                    @endforeach
                                </fieldset>
                            </div>

                            <div class="quantity_counter mt-4 mb-2">
                                <span>Quantity</span>
                                <div class="counter mt-1">
                                    <span class="down" onClick='decreaseCount(event, this)'
                                        style="font-size: 1.5rem; font-weight: 600;cursor: pointer;">-</span>
                                    <input type="text" value="1" name="quantity">
                                    <span class="up" onClick='increaseCount(event, this)'
                                        style="font-size: 1.5rem; font-weight: 600;cursor: pointer;">+</span>
                                </div>
                            </div>

                            <div class="detail_section_buttons">
                                <div class="detail_cart mt-5 mb-3">
                                    <button type="submit" class="detail_button" name="action" value="add_to_cart">Add
                                        to
                                        cart</button>
                                </div>
                                <div class="detail_buy  my-3">
                                    <button type="submit" class="detail_button" name="action" value="buy_now">Buy it
                                        now</button>
                                </div>
                            </div>

                            <div class="fabric_details">
                                <span
                                    style="font-size: 1rem;font-weight: 500;line-height: 2;font-family: 'nunito';white-space: pre-line;">
                                    <p style="font-weight: bold;margin-bottom: -2rem!important;">Fabric detail:</p>
                                    {{ $product->Measurements }}
                                </span>
                            </div>
                            <div class="fabric_details">
                                <span
                                    style="font-size: 1rem;font-weight: 500;line-height: 2;font-family: 'nunito';white-space: pre-line;">
                                    <p style="font-weight: bold;margin-bottom: -2rem!important;">Measurements:</p>
                                    {{ $product->Measurements }}
                                </span>
                            </div>
                        </div>
                    </form>
                @endforeach
            </div>
        </section>
    </div>
    <script>
        function increaseCount(a, b) {
            var input = b.previousElementSibling;
            var value = parseInt(input.value, 10);
            value = isNaN(value) ? 0 : value;
            value++;
            input.value = value;
        }

        function decreaseCount(a, b) {
            var input = b.nextElementSibling;
            var value = parseInt(input.value, 10);
            if (value > 1) {
                value = isNaN(value) ? 0 : value;
                value--;
                input.value = value;
            }
        }

        let detail_image = document.getElementById('detail_image')
        let detail_image_sm = document.querySelectorAll('.detail_image_sm')
        let sm_image_arr = Array.from(detail_image_sm)
        // console.log(sm_image_arr);

        sm_image_arr.forEach((elem) => {
            elem.addEventListener('click', () => {
                detail_image.src = elem.src;
            })
        })

        let buyNow = document.getElementById('buyNow')
        console.log(buyNow);
    </script>
@endsection
