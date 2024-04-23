@extends('app')
@section('content')
    <link rel="stylesheet" href="{{ asset('assets/slider/slick/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/slider/slick/slick-theme.css') }}">

    <style>
        .slick-prev:before,
        .slick-next:before {
            color: black;
        }

        .slider {
            max-width: 30rem;
        }

        .cont {
            width: 93%;
            /* max-width: 350px; */
            text-align: center;
            margin: 4% auto;
            padding: 30px 0;
            background: #111;
            color: #EEE;
            border-radius: 5px;
            border: thin solid #444;
            overflow: hidden;
        }

        .name_input {
            background: #222;
            border: none;
            width: 100%;
            max-width: 100%;
            height: 50px;
            padding: 10px;
            box-sizing: border-box;
            color: #EEE;
            margin: 1rem 0;
            outline: none;
        }

        hr {
            margin: 20px;
            border: none;
            border-bottom: thin solid rgba(255, 255, 255, .1);
        }

        div.title {
            font-size: 2em;
        }

        h1 span {
            font-weight: 300;
            color: #Fd4;
        }

        div.stars {
            /* width: 270px; */
            width: 75%;
            max-width: 30rem;
            display: inline-block;
        }

        input.star {
            display: none;
        }

        label.star {
            float: right;
            padding: 10px;
            font-size: 36px;
            color: #444;
            transition: all .2s;
            max-width: calc(100%/5);
            width: fit-content;
            height: fit-content;
        }

        input.star:checked~label.star:before {
            content: '\f005';
            color: #FD4;
            transition: all .25s;
        }


        input.star-5:checked~label.star:before {
            color: #FE7;
            text-shadow: 0 0 20px #952;
        }

        input.star-1:checked~label.star:before {
            color: #F62;
        }

        label.star:hover {
            transform: rotate(-15deg) scale(1.1);
        }

        label.star:before {
            content: '\f006';
            font-family: FontAwesome;
        }

        .rev-box {
            overflow: hidden;
            /* height: 0; */
            width: 100%;
            min-width: 17rem;
            transition: all .25s;
        }

        textarea.review {
            background: #222;
            border: none;
            width: 100%;
            max-width: 100%;
            height: 100px;
            padding: 10px;
            box-sizing: border-box;
            color: #EEE;
            outline: none;
        }

        label.review {
            display: block;
            transition: opacity .25s;
        }



        /* input.star:checked~.rev-box {
                                                                                height: 125px;
                                                                                overflow: visible;
                                                                            } */
    </style>
    <div class="container" id="women">
        <section class="women_products" id="womenProducts">
            @foreach ($products as $key => $product)
                <form class="products_container_detail" action="{{ route('user.check', $product->id) }}" method="get">
                    <div class="product_detail_section" style="position: sticky;top: 8rem;height: fit-content;">
                        <div class="product_card product_card_lg">
                            <img src="{{ asset($product->productImages[0]->product_images) ?? 'Null' }}"
                                class="detail_image" id="detail_image" alt="">
                        </div>
                        <div class="detail_more_images d-flex justify-content-start mt-2 flex-column">
                            @foreach ($product->productImages as $images)
                                <div class="detail_images_sm mx-1">
                                    <img src="{{ asset($images->product_images) }}" alt="" height="150"
                                        class="detail_image_sm">
                                </div>
                            @endforeach
                            @if (count($product->gifts))
                                <fieldset class="d-flex mt-3 flex-column">
                                    <legend><strong style="font-size: 1.5rem">Select Gift: </strong></legend>
                                    <div class="d-flex">
                                        @foreach ($product->gifts as $key => $gift)
                                            <div>
                                                <div class="detail_images_sm mx-1">
                                                    <label for="{{ $key }}" style="height: 100%; width:100%;">
                                                        <img src="{{ asset($gift->image) }}" alt="" height="150"
                                                            class="detail_image_sm" style="width: 100%">
                                                    </label>
                                                </div>
                                                <input type="radio" id="{{ $key }}"
                                                    class="color_radio_buttons gift_radio_buttons" name="gift"
                                                    value="{{ $gift->id }}">
                                            </div>
                                        @endforeach
                                    </div>
                                </fieldset>
                            @endif
                        </div>
                    </div>
                    {{-- <form class="products_details_section" action="{{ route('user.check', $product->id) }}" method="get"> --}}
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
                                            <input type="radio" class="size_radio_buttons" id="ageS" name="size"
                                                value="{{ $size->id }}" checked>
                                        @else
                                            <input type="radio" class="size_radio_buttons" id="ageS" name="size"
                                                value="{{ $size->id }}">
                                        @endif
                                        <label for="ageS" class="size_label">{{ $size->size }}</label>
                                    @elseif ($size->size == 'M')
                                        @if ($key === 0)
                                            <input type="radio" class="size_radio_buttons" id="ageM" name="size"
                                                value="{{ $size->id }}" checked>
                                        @else
                                            <input type="radio" class="size_radio_buttons" id="ageM" name="size"
                                                value="{{ $size->id }}">
                                        @endif
                                        <label for="ageM" class="size_label">{{ $size->size }}</label>
                                    @elseif ($size->size == 'L')
                                        @if ($key === 0)
                                            <input type="radio" class="size_radio_buttons" id="ageL" name="size"
                                                value="{{ $size->id }}" checked>
                                        @else
                                            <input type="radio" class="size_radio_buttons" id="ageL" name="size"
                                                value="{{ $size->id }}">
                                        @endif
                                        <label for="ageL" class="size_label">{{ $size->size }}</label>
                                    @elseif ($size->size == 'XL')
                                        @if ($key === 0)
                                            <input type="radio" class="size_radio_buttons" id="ageXL" name="size"
                                                value="{{ $size->id }}" checked>
                                        @else
                                            <input type="radio" class="size_radio_buttons" id="ageXL" name="size"
                                                value="{{ $size->id }}">
                                        @endif
                                        <label for="ageXL" class="size_label">{{ $size->size }}</label>
                                    @elseif ($size->size == 'XXL')
                                        @if ($key === 0)
                                            <input type="radio" class="size_radio_buttons" id="ageXXL" name="size"
                                                value="{{ $size->id }}" checked>
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
                                        <input type="radio" class="color_radio_buttons" id="color_{{ $color->color }}"
                                            name="color" value="{{ $color->id }}" checked>
                                    @else
                                        <input type="radio" class="color_radio_buttons" id="color_{{ $color->color }}"
                                            name="color" value="{{ $color->id }}">
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
                                <button type="submit" class="detail_button" name="action" value="buy_now">Buy
                                    it
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
                    {{-- </form> --}}
                </form>

                <div class="cont">
                    <h3>Customer Reviews</h3>
                    <h1>{{ number_format($overallRating, 1) }} / 5</h1>
                    <span class="text-light">{{ count($product->reviews) }} Reviews</span>
                </div>

                <div class="cont">
                    <h2>Review</h2>
                    <div class="stars">
                        <form action="{{ route('review', $product->id) }}" method="POST" style="width: 100%;">
                            @csrf
                            <div style="width: 100%;display: flex;justify-content: center;flex-direction: row-reverse;">
                                <input class="star star-5" id="star-5-2" type="radio" name="rating" value="5"
                                    required />
                                <label class="star star-5" for="star-5-2"></label>
                                <input class="star star-4" id="star-4-2" type="radio" name="rating"
                                    value="4" />
                                <label class="star star-4" for="star-4-2"></label>
                                <input class="star star-3" id="star-3-2" type="radio" name="rating"
                                    value="3" />
                                <label class="star star-3" for="star-3-2"></label>
                                <input class="star star-2" id="star-2-2" type="radio" name="rating"
                                    value="2" />
                                <label class="star star-2" for="star-2-2"></label>
                                <input class="star star-1" id="star-1-2" type="radio" name="rating"
                                    value="1" />
                                <label class="star star-1" for="star-1-2"></label>
                            </div>
                            <div class="rev-box">
                                <input type="text" class="name_input" name="name" placeholder="Name" required>
                                <textarea class="review" col="30" name="review" placeholder="Breif Review"></textarea>
                                {{-- <label class="review text-light" for="review">Breif Review</label> --}}
                            </div>
                            <button class="btn btn-primary mt-4" onclick="validateForm()">Submit</button>
                        </form>
                    </div>
                </div>

                <table id="datatablesSimple">
                    {{-- <thead>
                        <tr>hello</tr>
                    </thead> --}}
                    <tbody>
                        @foreach ($product->reviews as $review)
                            <tr class="" style="text-align: left; padding: 2rem;">
                                <td class="d-flex justify-content-center">
                                    <div class="cont text-light" style="margin: 0px 0px 0px 0px;">
                                        <div class="d-flex">
                                            <div class="text-dark bg-light d-flex justify-content-center align-items-center  mx-3"
                                                style="width: 3rem; height: 3rem;border-radius: 50%">
                                                {{ substr($review->name, 0, 1) }}
                                            </div>

                                            <div class="">
                                                <h5 style="text-align: left;">
                                                    <strong class="text-light">{{ $review->name }}</strong>
                                                </h5>

                                                <div class="" style="display: flex;">
                                                    @for ($rating = 0; $rating < $review->rating; $rating++)
                                                        <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                                    @endfor
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-5 mx-3" style="text-align: left;">
                                            <span class="text-light">{{ $review->review }}</span>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endforeach
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


        var radioButtons = document.querySelectorAll('.gift_radio_buttons');
        // Attach event listener to each radio button
        radioButtons.forEach(function(radioButton) {
            radioButton.addEventListener('change', function() {
                // Get the id of the radio button
                var id = this.id;

                // Get the corresponding label using the for attribute
                var label = document.querySelector('label[for="' + id + '"]');

                // Get the parent element of the label
                var parent = label.parentNode;

                // Change the border color of the parent element when the radio button is selected
                if (parent) {
                    parent.style.borderColor = 'red'; // Change this to whatever color you want
                }

                // Optionally, you can remove border color from other parent elements
                document.querySelectorAll('.detail_images_sm').forEach(function(otherParent) {
                    if (otherParent !== parent) {
                        otherParent.style.borderColor = ''; // Reset border color
                    }
                });
            });
        });
    </script>

    <script src="{{ asset('assets/multiSelect/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/slider/slick/slick.js') }}"></script>
    <script>
        // $(document).ready(function() {
        //     $('.demo').slick();
        // });

        $('.one-time').slick({
            dots: true,
            dotsClass: 'slick-dots',
            slidesToShow: 4,
            slidesToScroll: 1,
            touchMove: true,
            accessibility: true,
            arrows: true,
            prevArrow: '<button type="button" data-role="none" class="slick-prev">Previous</button>',
            nextArrow: '<button type="button" data-role="none" class="slick-next">Next</button>',
            autoplay: false,
            autoplaySpeed: 3000,
            centerPadding: '50px',
            cssEase: 'ease',
            customPaging: function(slider, i) {
                045
                return '<button type="button" data-role="none">' + (i + 1) + '</button>';
                046
            },
            draggable: true,
            easing: 'linear',
            edgeFriction: 0.35,
            fade: false,
            focusOnSelect: false,
            focusOnChange: false,
            initialSlide: 0,
            lazyLoad: 'ondemand',
            pauseOnHover: true,
            pauseOnDotsHover: false,
            respondTo: 'window',
            responsive: null,
            rtl: false,
            swipe: true,
            touchMove: true,
            touchThreshold: 5,
            useCSS: true,
            useTransform: true,
            verticalSwiping: false,
            waitForAnimate: true,
            zIndex: 1000
        });



        function validateForm() {
            // Check if any radio button in the group is selected
            const radioButtons = document.querySelectorAll('input[name="rating"]');
            let radioSelected = false;
            radioButtons.forEach(button => {
                if (button.checked) {
                    radioSelected = true;
                }
            });

            if (!radioSelected) {
                // Display a custom validation message or alert
                alert('Please select a star rating.');
                return false; // Prevent form submission
            }

            return true; // Allow form submission
        }
    </script>
@endsection
