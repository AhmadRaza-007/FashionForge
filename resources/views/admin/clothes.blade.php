@extends('admin')
@section('content')
    {{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}

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
                    <form method="post" action="{{ route('admin.addClothes') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body" id="modal-body"
                            style="display: grid;grid-template-columns: 48% 48%;justify-content: space-between;">
                            <div class="mb-3" style="text-align: left;">
                                <label for="collection_id" class="form-label">Sub Collections</label>
                                <select class="form-select" name="sub_collection_id" id="collection_id"
                                    aria-label="Default select example">

                                    @if (sizeof($subCollectionById) !== 1)
                                        <option>Select Sub Collection</option>
                                        @foreach ($subCollectionById as $value)
                                            <option value="{{ $value->id }}">{{ $value->title }}</option>
                                        @endforeach
                                    @else
                                        @foreach ($subCollectionById as $value)
                                            <option value="{{ $value->id }}">{{ $value->title }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <span class="text-danger">
                                    @error('sub_collection_id')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="mb-3" style="text-align: left;">
                                <label for="product_name" class="form-label">Product Name</label>
                                <input type="text" name="product_name" class="form-control" id="product_name"
                                    placeholder="Enter Collection">
                                <span class="text-danger">
                                    @error('product_name')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="mb-3" style="text-align: left;">
                                <label for="product_details" class="form-label">Product Details</label>
                                <input type="text" name="product_details" class="form-control" id="product_details"
                                    placeholder="Enter Collection">
                                <span class="text-danger">
                                    @error('product_details')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="mb-3" style="text-align: left;">
                                <label for="product_fabric_details" class="form-label">Product Fabric Detail</label>
                                <input type="text" name="product_fabric_details" class="form-control"
                                    id="product_fabric_details" placeholder="Enter Collection">
                                <span class="text-danger">
                                    @error('product_fabric_details')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="mb-3" style="text-align: left;">
                                <label for="product_sizes" class="form-label">Product Size</label>
                                <section class="ftco-section">
                                    <div class="container">
                                        <div class="row justify-content-center">
                                            <div class="col-lg-5 d-flex justify-content-center align-items-center"
                                                style="min-width: 100%;padding: 0;">
                                                <select class="js-select2 form-control" id="product_sizes"
                                                    name="product_sizes[]" multiple="multiple">
                                                    @foreach ($sizes as $size)
                                                        <option value="{{ $size->id }}" data-badge="">
                                                            {{ $size->size }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                            <div class="mb-3" style="text-align: left;">
                                <label for="product_colors" class="form-label">Product Color</label>
                                <section class="ftco-section">
                                    <div class="container">
                                        <div class="row justify-content-center">
                                            <div class="col-lg-5 d-flex justify-content-center align-items-center"
                                                style="min-width: 100%;padding: 0;">
                                                <select class="js-select2 form-control" id="product_colors"
                                                    name="product_colors[]" multiple="multiple">
                                                    @foreach ($colors as $color)
                                                        <option value="{{ $color->id }}" data-badge="">
                                                            {{ $color->color }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                            <div class="mb-3" style="text-align: left;">
                                <label for="product_size" class="form-label">Product Size</label>
                                <!-- <input type="text" name="product_size" class="form-control" id="product_size" placeholder="Enter Collection" > -->
                                <textarea name="product_measurements" class="form-control" id="product_measurements" cols="30" rows="10"></textarea>
                                @error('product_measurements')
                                    {{ $message }}
                                @enderror
                                </span>
                            </div>
                            <div class="mb-3" style="text-align: left;">
                                <div class="my-3">
                                    <label for="product_price" class="form-label">Product Price</label>
                                    <input type="text" name="product_price" class="form-control" id="product_price"
                                        placeholder="Enter Collection">
                                    <span class="text-danger">
                                        @error('product_price')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="my-3">
                                    <label for="product_price" class="form-label">Add Gift</label>
                                    <select class="js-select2 form-select" name="gifts[]" id="gift"
                                        multiple="multiple">
                                        {{-- <option value="" selected disabled>Select Gift</option> --}}
                                        @foreach ($gifts as $gift)
                                            <option value="{{ $gift->id }}">{{ $gift->name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger">
                                        @error('gift')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>

                            <div class="img_container mt-4" style="grid-column: span 2;">
                                <div class="container d-flex justify-content-between align-items-center py-3">
                                    <h4>Add more images</h4>
                                    <div class="d-flex align-items-center">
                                        <button type="button" id="minusButton" class="btn btn-danger"
                                            style="border-radius: 5px 0 0 5px;"><i class="fa fa-minus"></i></button>
                                        <span id="input_length"
                                            style="background-color: white;color:black;padding: 0.2rem 0.7rem;"></span>
                                        <button type="button" id="plusButton" class="btn btn-danger"
                                            style="border-radius: 0 5px 5px 0;"><i class="fa fa-plus"></i></button>
                                    </div>
                                </div>
                                <div class="plusButton" id="image_section">
                                    <div class="plusButton"
                                        style="display: grid;grid-template-columns: 48% 48%;align-items: center;justify-content: space-between;">
                                        <div class="mb-3" style="text-align: left;">
                                            <label for="product_images" class="form-label">Product Images</label>
                                            <input class="form-control" name="product_images[]" type="file"
                                                id="product_images">
                                        </div>
                                        <div class="mb-3 url_fields" style="text-align: left;" id="url_fields">
                                            <label for="product_image_url" class="form-label">Product Image URL</label>
                                            <input type="text" name="product_image_url[]" class="form-control"
                                                id="product_image_url" placeholder="Enter image url">
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



        <!-- Edit Modal -->
        <div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModal"
            aria-hidden="true">
            <div class="modal-dialog" style="max-width: 700px;">
                <div class="modal-content dash-card dash-card--fb">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="post" action="{{ route('admin.updateClothes') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="modal-body" id="modal-body"
                            style="display: grid;grid-template-columns: 48% 48%;justify-content: space-between;">
                            <div class="mb-3" style="text-align: left;">
                                <label for="collection_id" class="form-label">Sub Collections</label>
                                <select class="form-select" name="edit_clothe_id" id="edit_clothe_id"
                                    aria-label="Default select example">
                                    <option id="option" value=""></option>
                                    <hr>
                                    <option>Select Sub Collection</option>
                                    @foreach ($subCollection as $value)
                                        <option value="{{ $value->id }}">{{ $value->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <input type="hidden" name="clothe_id_hidden" class="form-control" id="clothe_id_hidden"
                                placeholder="">
                            <div class="mb-3" style="text-align: left;">
                                <label for="edit_product_name" class="form-label">Product Name</label>
                                <input type="text" name="edit_product_name" class="form-control"
                                    id="edit_product_name" placeholder="Enter Collection">
                            </div>
                            <div class="mb-3" style="text-align: left;">
                                <label for="product_details" class="form-label">Product Details</label>
                                <input type="text" name="edit_product_details" class="form-control"
                                    id="edit_product_details" placeholder="Enter Collection">
                            </div>
                            <div class="mb-3" style="text-align: left;">
                                <label for="product_fabric_details" class="form-label">Product Fabric Detail</label>
                                <input type="text" name="edit_product_fabric_details" class="form-control"
                                    id="edit_product_fabric_details" placeholder="Enter Collection">
                            </div>
                            <div class="mb-3" style="text-align: left;">
                                <label for="edit_product_sizes" class="form-label">Product Size</label>
                                <section class="ftco-section">
                                    <div class="container">
                                        <div class="row justify-content-center">
                                            <div class="col-lg-5 d-flex justify-content-center align-items-center"
                                                style="min-width: 100%;padding: 0;">
                                                <select class="js-select2 form-control" id="edit_product_sizes"
                                                    name="edit_product_sizes[]" multiple="multiple">
                                                    @foreach ($sizes as $size)
                                                        <option value="{{ $size->id }}" data-badge="">
                                                            {{ $size->size }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                                <div class="size_container">
                                    <ul class="select2-selection__rendered d-flex flex-wrap" id="editSizeDisplay"
                                        style="padding:0;">

                                    </ul>
                                </div>
                            </div>
                            <div class="mb-3" style="text-align: left;">
                                <label for="edit_product_colors" class="form-label">Product Color</label>
                                <section class="ftco-section">
                                    <div class="container">
                                        <div class="row justify-content-center">
                                            <div class="col-lg-5 d-flex justify-content-center align-items-center"
                                                style="min-width: 100%;padding: 0;">
                                                <select class="js-select2 form-control" id="edit_product_colors"
                                                    name="edit_product_colors[]" multiple="multiple">
                                                    @foreach ($colors as $color)
                                                        <option value="{{ $color->id }}" data-badge="">
                                                            {{ $color->color }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                                <div class="color_container">
                                    <ul class="select2-selection__rendered d-flex flex-wrap" id="editColorDisplay"
                                        style="padding:0;">
                                        {{-- @foreach ($products as $productColors)
                                    @foreach ($productColors->color as $colorNames) --}}

                                        {{-- <li class="select2-selection__choice d-flex mx-1 my-1" style="list-style: none;padding: 0.3rem .5rem;width: max-content;background-color: orange;border-radius: .5rem;color: black;">
                                        <a href="" class="select2-selection__choice__remove mr-2" role="presentation" style="cursor: pointer;font-weight:bolder">×</a>
                                        <div class="color" id="editColor"></div>
                                    </li> --}}
                                        {{-- @endforeach
                                    @endforeach --}}
                                    </ul>
                                </div>
                            </div>
                            <div class="mb-3" style="text-align: left;">
                                <label for="product_size" class="form-label">Product Size</label>
                                <!-- <input type="text" name="product_size" class="form-control" id="product_size" placeholder="Enter Collection" > -->
                                <textarea name="edit_product_measurements" class="form-control" id="edit_product_measurements" cols="30"
                                    rows="10"></textarea>
                                @error('product_measurements')
                                    {{ $message }}
                                @enderror
                                </span>
                            </div>
                            <div class="mb-3" style="text-align: left;">
                                <div class="my-3">
                                    <label for="edit_product_price" class="form-label">Product Price</label>
                                    <input type="text" name="edit_product_price" class="form-control"
                                        id="edit_product_price" placeholder="Enter Collection">
                                </div>

                                <div class="my-3">
                                    <label for="product_price" class="form-label">Add Gift</label>
                                    <select class="js-select2 form-select" name="edit_product_gift[]" id="gift"
                                        multiple="multiple">
                                        {{-- <option value="" selected disabled>Select Gift</option> --}}
                                        @foreach ($gifts as $gift)
                                            <option value="{{ $gift->id }}">{{ $gift->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="size_container">
                                        <ul class="select2-selection__rendered d-flex flex-wrap" id="editGiftDisplay"
                                            style="padding:0;">

                                        </ul>
                                    </div>
                                    <span class="text-danger">
                                        @error('gift')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>

                            <div class="img_container mt-4" style="grid-column: span 2;">
                                <div class="container d-flex justify-content-between align-items-center py-3">
                                    <h4>Add more images</h4>
                                    <div class="d-flex align-items-center">
                                        <button type="button" id="minusButton2" class="btn btn-danger"
                                            style="border-radius: 5px 0 0 5px;"><i class="fa fa-minus"></i></button>
                                        <span id="input_length2"
                                            style="background-color: white;color:black;padding: 0.2rem 0.7rem;"></span>
                                        <button type="button" id="plusButton2" class="btn btn-danger"
                                            style="border-radius: 0 5px 5px 0;"><i class="fa fa-plus"></i></button>
                                    </div>
                                </div>

                                <div class="plausButton" id="image_section2">
                                    <div class="plusButton"
                                        style="display: grid;grid-template-columns: 48% 48%;align-items: center;justify-content: space-between;">
                                        <div class="mb-3" style="text-align: left;">
                                            <label for="edit_product_images" class="form-label">Product Images</label>
                                            <input class="form-control" name="edit_product_images[]" type="file"
                                                id="edit_product_images">
                                        </div>
                                        <div class="mb-3 url_fields" style="text-align: left;" id="url_fields">
                                            <label for="edit_product_image_url" class="form-label">Product Image
                                                URL</label>
                                            <input type="text" name="edit_product_image_url[]" class="form-control"
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
                            <th>Price</th>
                            <th>Size</th>
                            <th>Color</th>
                            <th>Product Details</th>
                            <th>Fabric Details</th>
                            <th>Measurements</th>
                            <th>Images</th>
                            <th>Images Links</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($products as $product)
                            <tr class="row1" data-id="{{ $product->name }}" style="text-align: left;">
                                {{-- <td>
                            {{ $product->id }}
                        </td> --}}
                                <td>
                                    {{ $product->name }}
                                </td>
                                <td>
                                    {{ $product->price }}
                                </td>
                                <td>
                                    @foreach ($product->size as $key => $size)
                                        {{ $size->size ?? 'null' }},
                                    @endforeach
                                    {{-- $product->size --}}
                                </td>
                                <td>
                                    @foreach ($product->color as $color)
                                        {{ $color->color }},
                                    @endforeach
                                    {{-- $product->color_id --}}
                                </td>
                                <td>
                                    {{ $product->product_detail }}
                                </td>
                                <td>
                                    {{ $product->fabric_detail }}
                                </td>
                                <td>
                                    <pre style="max-width: 10rem">
                                        {{ $product->Measurements }}
                                    </pre>
                                </td>
                                <td class="d-flex">
                                    @foreach ($product->productImages as $image)
                                        <div class="image_container" style="width: 100px;float:left; position:relative;">
                                            <a class="btn delete btn-sm image_delete_btn"
                                                href="{{ url('/admin/delete/clotheImage' . '/' . $image->id) }}"
                                                style="position: absolute; background: black;right:0;">
                                                <i class="fas fa-trash-alt delete_image"
                                                    style="color: var(--clr-youtube);"></i>
                                            </a>
                                            <img src="{{ asset($image->product_images) }}" width="100" height="100"
                                                alt="" class="product_image">
                                        </div>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($product->productImages as $image)
                                        <a href="{{ $image->product_image_url }}">{{ $image->product_image_url }}</a>
                                    @endforeach
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
                $("#editGiftDisplay").text('');
                for (let index = 0; index < data.gifts.length; index++) {
                    // const element = data.color[index];
                    $("#editGiftDisplay").append(`<li class="select2-selection__choice d-flex mx-1 my-1" style="list-style: none;padding: 0.3rem .5rem;width: max-content;background-color: orange;border-radius: .5rem;color: black;">
                                        <a href="{{ url('admin/delete/clotheGift/${data.id}/${data.gifts[index].id}') }}" class="select2-selection__choice__remove mr-2" role="presentation" style="cursor: pointer;font-weight:bolder">×</a>
                                        <div class="color">${data.gifts[index].name}</div>
                                    </li>`);
                }
                $("#edit_sub_collection_image").attr('src', data.image);
            }
        })
    }
</script>
