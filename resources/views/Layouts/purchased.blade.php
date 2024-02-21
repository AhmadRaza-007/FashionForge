@extends('app')
@section('content')
    <div class="cart_products container">

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
                                <div class="detail_images_sm mx-1 d-flex" style="height: 100%;min-width: 20%;">
                                    <img src="{{ asset($item->clothe->productImages[0]->product_images) }}" alt="">
                                </div>
                                <div class="cart_product_details mx-2" style="margin-left: 2rem !important;">
                                    <div class="title" style="width: 17rem;">
                                        <a href="{{ route('user.homeSection') }}">
                                            <h3 style="margin: 0;"></h3>
                                        </a>
                                        <div class="d-flex"
                                            style="height: 5rem;flex-direction: column;justify-content: space-between;font-size: 1.1rem;font-weight:400;margin-top: 1rem;">
                                            <span>Rs. {{ $item->price }}</span>
                                            <span>Size: {{ $item->size->size }}</span>
                                            <span>Color: {{ $item->color->color }}</span>
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
