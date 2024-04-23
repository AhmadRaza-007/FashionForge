@extends('admin')
@section('content')
    <style>
        @media (min-width: 64em) {
            .dash-cards {
                grid-template-columns: repeat(4, minmax(250px, 1fr)) !important;
            }
        }

        .dash-card:hover {
            opacity: .7;
            cursor: pointer
        }

        .date-info__date::before {
            border-bottom-color: transparent !important;
        }
    </style>
    <div class="dash-cards px-5 py-5">
        @foreach ($purchase as $purchase)
            <a href="{{ route('admin.orders.detail', $purchase->id) }}">
                <div class="dash-card @if ($purchase->order_status == 'Pending') dash-card--yt @elseif($purchase->order_status == 'Shipped') dash-card--fb @elseif($purchase->order_status == 'Delivered') dash-card--success @endif d-flex align-items-center justify-content-around">
                    {{-- style="max-width: 312.5px" --}}
                    <div>
                        <div class="user-info dash-card__user-info">
                            <span class="user-info__icon"><i class="bx bxl-twitter"></i></span>
                            <small
                                class="user-info__username">{{ $purchase->user->first_name . ' ' .$purchase->user->second_name }}</small>
                        </div>

                        <div class="followers-info dash-card__followers-info">
                            <h2 class="followers-info__count">Rs. {{ $purchase->price }}</h2>
                            <small class="followers-info__text">Followers</small>
                        </div>

                        <div class="date-info dash-card__date-info">
                            <small class="date-info__date">{{ $purchase->order_status }}</small>
                        </div>
                    </div>
                    {{-- <div class="">></div> --}}
                </div>
            </a>
        @endforeach
    </div>
@endsection

<script>
    function editCollection(id) {
        $.ajax({
            url: "{{ url('/admin/editClothes/') }}" + "/" + id,
            success: function(data) {
                console.log(data)
                // $("#editProductModal").modal("show");
                $("#clothe_id_hidden").val(data.id);
                $("#edit_product_name").val(data.name);
                $("#edit_product_details").val(data.product_detail);
                $("#eidt_").val(data.detail);
                $("#edit_product_fabric_details").val(data.fabric_detail);
                $("#edit_product_measurements").val(data.Measurements);
                $("#edit_product_color").val(data.color);
                $("#edit_product_size").val(data.size);
                $("#edit_product_price").val(data.price);
                $("#option").val(data.sub_collection_id);
                $("#option").text(data.sub_collection.title);
                $("#editColorDisplay").text('');
                for (let index = 0; index < data.color.length; index++) {
                    // const element = data.color[index];
                    $("#editColorDisplay").append(`<li class="select2-selection__choice d-flex mx-1 my-1" style="list-style: none;padding: 0.3rem .5rem;width: max-content;background-color: orange;border-radius: .5rem;color: black;">
                                        <a href="{{ url('admin/delete/clotheColor/${data.id}/${data.color[index].id}') }}" class="select2-selection__choice__remove mr-2" role="presentation" style="cursor: pointer;font-weight:bolder">×</a>
                                        <div class="color">${data.color[index].color}</div>
                                    </li>`);
                }
                $("#editSizeDisplay").text('');
                for (let index = 0; index < data.size.length; index++) {
                    // const element = data.color[index];
                    $("#editSizeDisplay").append(`<li class="select2-selection__choice d-flex mx-1 my-1" style="list-style: none;padding: 0.3rem .5rem;width: max-content;background-color: orange;border-radius: .5rem;color: black;">
                                        <a href="{{ url('admin/delete/clotheSize/${data.id}/${data.size[index].id}') }}" class="select2-selection__choice__remove mr-2" role="presentation" style="cursor: pointer;font-weight:bolder">×</a>
                                        <div class="color">${data.size[index].size}</div>
                                    </li>`);
                }
                $("#edit_sub_collection_image").attr('src', data.image);
            }
        })
    }
</script>
