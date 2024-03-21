@extends('admin')
@section('content')
    <div class="container my-4">

        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary mb-1" data-bs-toggle="modal" data-bs-target="#exampleModal"
            style="float: right;">
            Add Collection
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content dash-card dash-card--yt">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Gift</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="post" action="{{ route('gift.create') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3" style="text-align: left;">
                                <label for="Name" class="form-label">Gift Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Enter Collection"
                                    required>
                            </div>
                            <div class="mb-3" style="text-align: left;">
                                <label for="Details" class="form-label">Gift Details</label>
                                <input type="text" name="details" class="form-control" placeholder="Gift Details">
                            </div>
                            <div class="mb-3" style="text-align: left;">
                                <label for="Price" class="form-label">Price <span class="text-muted">(show
                                        cutted)</span></label>
                                <input type="number" name="price" class="form-control"
                                    placeholder="Enter wallpaper imageurl">
                            </div>
                            <div class="mb-3" style="text-align: left;">
                                <label for="Image" class="form-label">Gift Image</label>
                                <input class="form-control" name="image" type="file" required>
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



        <!-- Modal Edit -->
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content dash-card dash-card--yt">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Gift</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="post" action="{{ route('gift.update') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3" style="text-align: left;">
                                <label for="Name" class="form-label">Gift Name</label>
                                <input type="text" name="name" class="form-control" id="Name"
                                    placeholder="Enter Collection" required>
                                <input type="hidden" name="id" class="form-control" id="id"
                                    placeholder="Enter Collection">
                            </div>
                            <div class="mb-3" style="text-align: left;">
                                <label for="Details" class="form-label">Gift Details</label>
                                <input type="text" name="details" class="form-control" id="Details"
                                    placeholder="Gift Details">
                            </div>
                            <div class="mb-3" style="text-align: left;">
                                <label for="Price" class="form-label">Price <span class="text-muted">(show
                                        cutted)</span></label>
                                <input type="number" name="price" class="form-control" id="Price"
                                    placeholder="Enter wallpaper imageurl">
                            </div>
                            <div class="mb-3" style="text-align: left;">
                                <label for="Image" class="form-label">Gift Image</label>
                                <input class="form-control" name="image" type="file">
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
                            <th>Gift</th>
                            <th>Details</th>
                            <th>Price</th>
                            <th>image</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($gifts as $coll)
                            <tr class="row1" data-id="{{ $coll->name }}" style="text-align: left;">
                                <td>
                                    {{ $coll->id }}
                                </td>
                                <td>
                                    {{ $coll->name }}
                                </td>
                                <td>
                                    {{ $coll->details }}
                                </td>
                                <td>
                                    {{ $coll->price }}
                                </td>
                                <td>
                                    <img src="{{ asset($coll->image) }}" alt="gift" width="100">
                                </td>
                                <td>
                                    <a class="btn btn-sm" onclick="editCollection({{ $coll->id }})">
                                        <i class="fas fa-edit" style="color: skyblue;"></i>
                                    </a>
                                    <a class="btn delete btn-sm" href="{{ route('gift.delete', $coll->id) }}">
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
            url: "{{ url('/admin/gift/edit/') }}" + "/" + id,
            success: function(data) {
                console.log(data)
                $("#id").val(data.id);
                $("#Name").val(data.name);
                $("#Details").val(data.details);
                $("#Price").val(data.price);
                $("#editModal").modal("show");
            }
        })
    }
</script>
