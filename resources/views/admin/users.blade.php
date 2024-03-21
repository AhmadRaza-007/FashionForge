@extends('admin')
@section('content')
    <div class="container">
        <!-- Data Table -->
        <div class="dash-cards" style="width: 100%; grid-template-columns: repeat(1, 1fr) !important;">
            <div class="dash-card dash-card--fb" style="width: 100%; margin: auto;overflow: scroll;">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <!-- <th>ID</th> -->
                            <th>Name</th>
                            <th>Email</th>
                            <th>Pending Orders</th>
                            <th>Completed Orders</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($users as $product)
                            <tr class="row1" data-id="{{ $product->name }}" style="text-align: left;">
                                <td>
                                    <strong>{{ $product->first_name . ' ' .  $product->second_name }}</strong>
                                </td>
                                <td>
                                    {{ $product->email }}
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
