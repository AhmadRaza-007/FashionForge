@extends('app')
@section('content')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta name="csrf-token" content="content">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta charset="UTF-8">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    </head>

    <body>
        <div class="container mt-5">
            <div class="heading d-flex justify-content-between align-items-center">
                <h1 style="font-size: 3.5rem;">Your cart</h1>
                <a href="{{ route('user.homeSection') }}"
                    style="font-size: 1.3rem; font-weight:500;letter-spacing:.22rem;border-bottom: 1px solid;text-decoration: none;height: 1.7rem;">Continue
                    shopping</a>
            </div>

            <div class="cart_products">
                @if (count($cartProducts) !== 0)
                    <table class="table">

                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Gift</th>
                                <th>Quantity</th>
                                <th>Total</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($cartProducts as $product)
                                <tr>
                                    <td>
                                        <div class="detail_more_images d-flex mt-2" style="height: 12rem;">
                                            <div class="detail_images_sm mx-1 d-flex" style="height: 100%;min-width: 20%;">
                                                <img src="{{ $product->clothe->productImages[0]->product_images }}"
                                                    alt="">
                                            </div>
                                            <div class="cart_product_details mx-2" style="margin-left: 2rem !important;">
                                                <div class="title" style="width: 17rem;">
                                                    <a href="{{ route('user.homeSection') }}">
                                                        <h3 style="margin: 0;">{{ $product->clothe->name }}</h3>
                                                    </a>
                                                    <div class="d-flex"
                                                        style="height: 5rem;flex-direction: column;justify-content: space-between;font-size: 1.1rem;font-weight:400;margin-top: 1rem;">
                                                        <span>Rs. {{ $product->clothe->price }}</span>
                                                        <span>Size: {{ $product->size->size }}</span>
                                                        <span>Color: {{ $product->color->color }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        @if ($product->gift)
                                            <div class="detail_more_images d-flex mt-2" style="height: 12rem;">
                                                <div class="detail_images_sm mx-1 d-flex" style="height: 100%;">
                                                    <img src="{{ $product->gift->image }}" alt="">
                                                </div>
                                                <input type="hidden" value="{{ $product->gift->id }}" name="gift_id">
                                                {{-- <div class="cart_product_details mx-2" style="margin-left: 2rem !important;"> --}}
                                                {{-- <div class="title" style="width: 17rem;"> --}}
                                                {{-- <a href="{{ route('user.homeSection') }}">
                                                        <h3 style="margin: 0;">{{ $product->gift->name }}</h3>
                                                    </a> --}}
                                                {{-- <div class="d-flex"
                                                    style="height: 5rem;flex-direction: column;justify-content: space-between;font-size: 1.1rem;font-weight:400;margin-top: 1rem;">
                                                    <span>Rs. {{ $product->clothe->price }}</span>
                                                    <span>Size: {{ $product->size->size }}</span>
                                                    <span>Color: {{ $product->color->color }}</span>
                                                </div> --}}
                                                {{-- </div> --}}
                                                {{-- </div> --}}
                                            </div>
                                        @endif
                                    </td>
                                    <td class="">
                                        <form id="{{ 'createForm' . $product->id }}" action="javascript:void(0)">
                                            @csrf
                                            <div class="quantity_counter d-flex align-items-center">
                                                <div class="counter mt-1">
                                                    <button type="button" class="down"
                                                        onClick='decreaseCount(event, this); saveData({{ $product->id }})'>-</button>
                                                    <input type="text" value="{{ $product->quantity }}"
                                                        name="{{ 'editQuantity_' . $product->id }}" readonly>
                                                    <button type="button" class="up"
                                                        onClick='increaseCount(event, this); saveData({{ $product->id }})'>+</button>
                                                </div>
                                                <a class="btn delete btn-sm"
                                                    href="{{ url('/cartDelete' . '/' . $product->id) }}">
                                                    <i class="fas fa-trash-alt" style="transform: scale(1.5);"></i>
                                                </a>
                                            </div>
                                        </form>
                                    </td>
                                    <td style="font-size: 1.2rem;font-weight:600;width: 12rem;">
                                        Rs.<span id="price" class="price" style="font-size: 1.2rem;font-weight:600;">
                                            {{ $product->quantity * $product->price }}</span>.00
                                        {{-- <span id="price" style="font-size: 1.2rem;font-weight:600;"></span> --}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="cart_order_section d-flex align-items-center justify-content-between">
                        <div class="speacial_instruction">
                            <div class="text">
                                Order special instructions
                            </div>
                            <textarea name="special_instructions" id="" cols="30" rows="5"
                                style="border: 2px solid;
                                border-bottom-width: 4px;
                            border-bottom-style: solid;
                            border-bottom-color: currentcolor;
                            padding: 15px;
                            border-radius: 1rem 1rem 0 1rem;
                            outline: none;
                            font-size: 1rem;"></textarea>
                        </div>
                        <div class="check_out_option">
                            <h4>
                                <span>Subtotal </span>
                                Rs.<span id="subtotal">{{ $total }}</span>.00
                            </h4>
                            <p>Taxes and shipping calculated at checkout</p>
                            <a href="{{ route('cart.checkout') }}" class="detail_button" name="action"
                                value="add_to_cart">Check
                                out</a>
                        </div>
                    </div>
                @else
                    <h1 class="my-5 py-5 text-center">Cart is empty</h1>
                @endif
            </div>
        </div>


        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
            integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script>
            function saveData(id) {
                // console.log(`#createForm${id}`)
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                })
                $.ajax({
                    url: "{{ url('/cartIncrement') }}" + '/' + id,
                    type: 'post',
                    data: $(`#createForm${id}`).serialize(),
                    success: function(response) {
                        // console.log(response);
                        let arr = $(`.price`);
                        array = response.prices;

                        for (let index = 0; index < array.length; index++) {
                            // arr[index] = array[index];
                            // console.log(arr);
                            // console.log(array);
                            // console.log(arr[index]);
                            // console.log(`index${index}:`, arr[index]);
                            // console.log(array[index].quantity);
                            arr[index].innerText = ' ' + array[index].price * array[index].quantity;
                            // console.log(array[index]);

                        }
                        console.log();
                        // arr.each((index, element) => {
                        //     console.log(index, element);
                        //     console.log(element.prices.id);
                        //     array.forEach(elem => {
                        //         console.log(element)
                        //         element.innerText = element.prices
                        //         console.log(element);
                        //     });
                        // })
                        // console.log(response.cart.id)
                        // $(`#price`).text(response.cart.price * response.cart.quantity)
                        console.log(response);
                        $('#subtotal').text(response.total);
                    }
                })
            }
            // $.ajax({
            //     url: "{{ url('/cartIncrement') }}" + '/' + id,
            //     type: 'post',
            //     data: $(`#createForm${id}`).serialize(),
            //     success: function(response) {
            //         // console.log($(`#createForm${id}`));

            //         console.log(response);
            //         $(`#price`).text(response.cart.price * response.cart.quantity);
            //         $('#subtotal').text(response.total);
            //     }
            // })

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
        </script>
    </body>

    </html>
@endsection
