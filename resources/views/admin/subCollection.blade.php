@extends('admin')
@section('content')


<div class="container my-4">




    <!-- Button trigger modal -->

    @if ($subName)
    <span><h1 class="d-inline">{{ $subName->collection->name . ' Section' }}</h1></span>
    @endif
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal" style="float: right;">
        Add Sub Collection
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content dash-card dash-card--yt">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Sub Collection</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="{{ route('admin.addSubCollection') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3" style="text-align: left;">
                            <label for="collection_id" class="form-label">Collection</label>
                            <select class="form-select" name="collection_id" id="collection_id" aria-label="Default select example" required>
                                <option>Select Collection</option>
                                @foreach ($collection as $coll)
                                <option value="{{ $coll->id }}">{{ $coll->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3" style="text-align: left;">
                            <label for="sub_collection_title" class="form-label">Sub Collection Name</label>
                            <input type="text" name="sub_collection_title" class="form-control" id="sub_collection_title" placeholder="Enter Collection" required>
                        </div>
                        <div class="mb-3" style="text-align: left;">
                            <label for="sub_collection_image_url" class="form-label">Image URL</label>
                            <input type="text" name="sub_collection_image_url" class="form-control" id="sub_collection_image_url" placeholder="Enter image url">
                        </div>
                        <!-- <div class="mb-3" style="text-align: left;">
                            <label for="sub_collection_price" class="form-label">Price</label>
                            <input type="text" name="sub_collection_price" class="form-control" id="sub_collection_price" placeholder="Enter Price">
                        </div> -->
                        <div class="mb-3" style="text-align: left;">
                            <label for="sub_collection_image" class="form-label">Image</label>
                            <input class="form-control" name="sub_collection_image" type="file" id="sub_collection_image" required multiple>
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
    <div class="modal fade" id="editSubCollectionModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content dash-card dash-card--yt">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Sub Collection</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="{{ route('admin.editSubCollection') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="sub_collection_id_hidden" id="sub_collection_id_hidden">
                        <div class="mb-3" style="text-align: left;">
                            <label for="collection_id" class="form-label">Collection</label>
                            <select class="form-select" name="collection_id" id="collection_id" aria-label="Default select example" required>
                                <option id="option" value=""></option>
                                <hr>
                                @foreach ($collection as $coll)
                                <option value="{{ $coll->id }}">{{ $coll->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3" style="text-align: left;">
                            <label for="edit_sub_collection_title" class="form-label">Sub Collection Name</label>
                            <input type="text" name="sub_collection_title" class="form-control" id="edit_sub_collection_title" placeholder="Enter Collection" required>
                        </div>
                        <div class="mb-3" style="text-align: left;">
                            <label for="edit_sub_collection_image_url" class="form-label">Image URL</label>
                            <input type="text" name="sub_collection_image_url" class="form-control" id="edit_sub_collection_image_url" placeholder="Enter image url">
                        </div>
                        <div class="mb-3" style="text-align: left;">
                            <label for="sub_collection_image" class="form-label">Image</label>
                            <input class="form-control" name="sub_collection_image" type="file" id="sub_collection_image">
                        </div>
                        <div class="mb-3" style="text-align: left;">
                            <img src="" id="edit_sub_collection_image" alt="" width="100">
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
        <div class="dash-card dash-card--yt" style="width: 100%; margin: auto;">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Collection Name</th>
                        <th>Image URL</th>
                        <th>image</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($subCollection as $coll)
                    <tr class="row1" data-id="{{ $coll -> name }}" style="text-align: left;">
                        <td>
                            {{ $coll->id }}
                        </td>
                        <td>
                            {{ $coll->collection->name }}
                        </td>
                        <td>
                            {{ $coll->title }}
                        </td>
                        <td>
                            <a href="{{ $coll->image_url }}">{{ $coll->image_url }}</a>
                        </td>
                        <td>
                            <img src="{{ asset($coll->image) }}" width="100" height="100" alt="">
                        </td>
                        <td>
                            <a class="btn btn-sm" onclick="editCollection({{$coll->id}})">
                                <i class="fas fa-edit" style="color: skyblue;"></i>
                            </a>
                            <a class="btn delete btn-sm" href="{{ route('admin.deleteSubCategory',$coll->id) }}">
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
            url: "{{ url('/admin/subCollection/edit/') }}" + "/" + id,
            success: function(data) {
                // let image = 'public/' + data.image;
                console.log(data)
                $("#sub_collection_id_hidden").val(data.id);
                $("#edit_sub_collection_title").val(data.title);
                $("#edit_sub_collection_image_url").val(data.image_url);
                $("#option").val(data.collection_id);
                $("#option").text(data.collection.name);
                $("#edit_sub_collection_image").attr('src', data.image);
                $("#editSubCollectionModal").modal("show");
            }
        })
    }
</script>
