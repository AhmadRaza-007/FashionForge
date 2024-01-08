@extends('admin')
@section('content')


<div class="container my-4">




    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary mb-1" data-bs-toggle="modal" data-bs-target="#exampleModal" style="float: right;">
        Add Collection
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content dash-card dash-card--yt">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Cloth Collection</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="{{ route('admin.addCollection') }}">
                    @csrf
                    <div class="modal-bod">
                        <!-- <div class="mb-3" style="text-align: left;">
                            <label for="category_id" class="form-label">Collection Name</label>
                            <select class="form-select" name="category_id" id="category_id" aria-label="Default select example" required>
                                <option>Select Collection</option>
                                <option value=""></option>
                            </select>
                        </div> -->
                        <div class="mb-3" style="text-align: left;">
                            <label for="category" class="form-label">Collection Name</label>
                            <input type="text" name="name" class="form-control" id="title" placeholder="Enter Collection" required>
                        </div>
                        <!-- <div class="mb-3" style="text-align: left;">
                            <label for="wallpaper_image_url" class="form-label">Wallpaper Image Url</label>
                            <input type="text" name="wallpaper_image_url" class="form-control" id="wallpaper_image_url" placeholder="Enter wallpaper imageurl">
                        </div>
                        <div class="mb-3" style="text-align: left;">
                            <label for="wallpaper_image" class="form-label">wallpaper Image</label>
                            <input class="form-control" name="wallpaper_image" type="file" id="Wallpaper Image" required>
                        </div> -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <!-- Modal Edit -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content dash-card dash-card--yt">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Cloth Collection</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="{{ route('admin.editCollection') }}">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="collection_id_edit" class="form-control" id="collection_id_edit" placeholder="Enter Collection" required>
                        <div class="mb-3" style="text-align: left;">
                            <label for="category" class="form-label">Collection Name</label>
                            <input type="text" name="edit_name" class="form-control" id="edit_name" placeholder="Enter Collection" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                </form>
            </div>
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
                    <th>Collection Name</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($collection as $coll)
                <tr class="row1" data-id="{{ $coll -> name }}" style="text-align: left;">
                    <td>
                        {{ $coll -> id }}
                    </td>
                    <td>
                        {{ $coll -> name }}
                    </td>
                    <td>
                        <a class="btn btn-sm" onclick="editCollection({{$coll->id}})">
                            <i class="fas fa-edit" style="color: skyblue;"></i>
                        </a>
                        <a class="btn delete btn-sm" href="{{ route('admin.deleteCategory',$coll->id) }}">
                            <i class="fas fa-trash-alt" style="color: pink;"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection

<script>
    function editCollection(id) {
        $.ajax({
            url: "{{ url('/admin/collection/edit/') }}" + "/" + id,
            success: function(data) {
                console.log(data)
                $("#edit_name").val(data.name);
                $("#collection_id_edit").val(data.id);
                $("#editModal").modal("show");
            }
        })
    }
</script>