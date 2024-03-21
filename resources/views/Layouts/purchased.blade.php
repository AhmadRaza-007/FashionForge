@extends('userProfile')
@section('content')
    <style>
        :root {
            --background-header-theme: #910f3f;
            --background-pale-yellow: #faf9e1;
            --background-theme: #ffffff;

            --border-color: #3d081b;

            --text-color: #000000;
            --text-dark: #3d081b;
            --text-light: rgba(255, 255, 255, 0.75);
            --text-light-hover: #ffffff;
        }

        .detail_images_sm {
            height: 7rem;
            min-width: 7rem;
            max-width: 7rem;
            overflow: hidden;
            border: 2.5px solid var(--border-color);
            border-bottom: 7px solid var(--border-color);
            border-radius: 1rem;
        }

        .detail_images_sm img {
            height: 100%;
            min-width: 100%;
            object-fit: fill;
        }
    </style>
    <div class="cart_products container">
        {{-- {{ $purchase }} --}}
        <table class="table my-5">

            <thead>
                <tr>
                    <th>Products</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($purchase as $key => $item)
                    <tr>
                        <td>
                            <div class="detail_more_images d-flex mt-2" style="height: 12rem;">
                                <div class="detail_images_sm mx-1 d-flex" style="height: 100%;min-width: 15%;width:8rem">
                                    <img src="{{ asset($item->clothe->productImages[0]->product_images) }}" alt="">
                                </div>
                                <div class="cart_product_details mx-2" style="margin-left: 1rem !important;">
                                    <div class="title" style="width: 17rem;">
                                        <a href="{{ route('user.homeSection') }}">
                                            <h3 style="margin: 0;"></h3>
                                        </a>
                                        <div class="d-flex"
                                            style="height: 5rem;flex-direction: column;justify-content: space-between;font-size: 1.1rem;font-weight:400;margin-top: 1rem;">
                                            <span>Rs. {{ $item->price }}</span>
                                            <span>Size: {{ $item->size->size }}</span>
                                            <span>Color: {{ $item->color->color }}</span>
                                            <span>quantity: {{ $item->quantity }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td>
                            <h1 class="text-center">No Purchases</h1>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
