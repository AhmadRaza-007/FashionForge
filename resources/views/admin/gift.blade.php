<!DOCTYPE HTML>
@extends('admin')
@section('content')
    <style>
        .image_delete_btn {
            display: none;
        }

        .image_container:hover .image_delete_btn {
            display: block;
        }
    </style>

    <div class="container my-4" style="min-width: 95%;">

        <div class="container d-flex" style="justify-content: space-between;margin: 0;min-width: 100%;margin: 2rem 0;">
            <!-- <div class="navLink"></div> -->
            <h5 class="Count" style="float: right;">Product Count: {{ $productCount }}</h5>
        </div>

        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalForCount"
            style="float: right;">
            Add Product
        </button>

        <!-- Modal -->
        <div class="modal fade" id="modalForCount" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" style="max-width: 700px;">
                <div class="modal-content dash-card dash-card--fb">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="post" action="{{ route('gift.create') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body" id="modal-body"
                            style="display: grid;grid-template-columns: 48% 48%;justify-content: space-between;">
                            <div class="mb-3" style="text-align: left;">
                                <label for="product_name" class="form-label">Product Name</label>
                                <input type="text" name="gift_name" class="form-control" id="product_name"
                                    placeholder="Enter Collection">
                                <span class="text-danger">
                                    @error('product_name')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="mb-3" style="text-align: left;">
                                <label for="product_details" class="form-label">Product Details</label>
                                <input type="text" name="gift_detail" class="form-control" id="product_details"
                                    placeholder="Enter Collection">
                                <span class="text-danger">
                                    @error('product_details')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="plusButton" id="image_section" style="grid-column: span 2;">
                                <div class="plusButton"
                                    style="display: grid;grid-template-columns: 48% 48%;align-items: center;justify-content: space-between;">
                                    <div class="mb-3" style="text-align: left;">
                                        <label for="product_images" class="form-label">Product Images</label>
                                        <input class="form-control" name="image" type="file" id="product_images">
                                    </div>
                                    <div class="mb-3 url_fields" style="text-align: left;" id="url_fields">
                                        <label for="product_image_url" class="form-label">Product Image URL</label>
                                        <input type="text" name="image_url" class="form-control" id="product_image_url"
                                            placeholder="Enter image url">
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>



        <!-- Edit Modal -->
        <div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModal" aria-hidden="true">
            <div class="modal-dialog" style="max-width: 700px;">
                <div class="modal-content dash-card dash-card--fb">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="post" action="{{ route('gift.update') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body" id="modal-body"
                            style="display: grid;grid-template-columns: 48% 48%;justify-content: space-between;">
                            <input type="hidden" name="gift_id_hidden" class="form-control" id="clothe_id_hidden"
                                placeholder="">
                            <div class="mb-3" style="text-align: left;">
                                <label for="edit_product_name" class="form-label">Product Name</label>
                                <input type="text" name="gift_name" class="form-control" id="edit_product_name"
                                    placeholder="Enter Collection">
                            </div>
                            <div class="mb-3" style="text-align: left;">
                                <label for="product_details" class="form-label">Product Details</label>
                                <input type="text" name="gift_detail" class="form-control" id="edit_product_details"
                                    placeholder="Enter Collection">
                            </div>

                            <div class="img_container mt-4" style="grid-column: span 2;">
                                <div class="plausButton" id="image_section2">
                                    <div class="plusButton"
                                        style="display: grid;grid-template-columns: 48% 48%;align-items: center;justify-content: space-between;">
                                        <div class="mb-3" style="text-align: left;">
                                            <label for="edit_product_images" class="form-label">Product Images</label>
                                            <input class="form-control" name="image" type="file"
                                                id="edit_product_images">
                                        </div>
                                        <div class="mb-3 url_fields" style="text-align: left;" id="url_fields">
                                            <label for="edit_product_image_url" class="form-label">Product Image
                                                URL</label>
                                            <input type="text" name="image_url" class="form-control"
                                                id="edit_product_image_url" placeholder="Enter image url">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>



        <!-- Data Table -->
        <div class="dash-cards" style="width: 100%; grid-template-columns: repeat(1, 1fr) !important;">
            <div class="dash-card dash-card--fb" style="width: 100%; margin: auto;overflow: scroll;">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <!-- <th>ID</th> -->
                            <th>Name</th>
                            <th>Product Details</th>
                            <th>Images</th>
                            <th>Images Links</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($products as $product)
                            {{-- {{ $product->name }} --}}
                            <tr class="row1" data-id="{{ $product->name }}" style="text-align: left;">
                                {{-- <td>
                            {{ $product->id }}
                        </td> --}}
                                <td>
                                    {{ $product->name }}
                                </td>
                                {{--
                                <td>
                                    @foreach ($product->size as $key => $size)
                                        {{ $size->size ?? 'null' }},
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($product->color as $color)
                                        {{ $color->color }},
                                    @endforeach
                                </td> --}}
                                <td>
                                    {{ $product->gift_detail }}
                                </td>
                                {{-- <td>
                                    {{ $product->fabric_detail }}
                                </td> --}}
                                {{-- <td>
                                    <pre>
                            {{ $product->Measurements }}
                            </pre>
                                </td> --}}
                                <td class="d-flex">
                                    <img src="{{ asset($product->image) }}" width="100" height="100" alt=""
                                        class="product_image">

                                </td>
                                <td>
                                    <a href="{{ $product->image_url }}">{{ $product->image_url }}</a>
                                </td>

                                <td>
                                    <a class="btn btn-sm" onclick="editCollection({{ $product->id }})"
                                        data-bs-toggle="modal" data-bs-target="#editProductModal"
                                        data-bs-target="#editProductModal">
                                        <i class="fas fa-edit" style="color: skyblue;"></i>
                                    </a>
                                    <a class="btn delete btn-sm"
                                        href="{{ url('/admin/delete/clothes' . '/' . $product->id) }}">
                                        <i class="fas fa-trash-alt" style="color: pink;"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

{{-- <script src="https://cdn.tiny.cloud/1/ec3a4qea3zyju6snajq5pv2tuvkg010qygoilm598ulqtmuv/tinymce/5/tinymce.min.js"
    referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: 'textarea#tiny'
    });
</script> --}}
<script>
    function editCollection(id) {
        $.ajax({
            url: "{{ url('/admin/gift/edit/') }}" + "/" + id,
            success: function(data) {
                $("#clothe_id_hidden").val(data.id);
                $("#edit_product_name").val(data.name);
                $("#edit_product_details").val(data.gift_detail);
                $("#edit_product_image_url").val(data.image_url);
            }
        })
    }
</script>
