@extends('admin')
@section('content')
    <div class="container my-5">

        <ol class="breadcrumb mb-4" style="background-color: transparent; padding: 0">
            <li class="breadcrumb-item"><a href="{{ route('admin.orders') }}">Orders</a></li>
            <li class="breadcrumb-item active">Categories</li>
        </ol>

        <div class="row g-3">
            <h1>User Details</h1>
            <div class="col-md-6">
                <label for="firstName" class="form-label">First Name</label>
                <input type="email" class="form-control" id="firstName"
                name="FirstName" placeholder="First Name" required
                    value="{{ old('first_name', $purchase->user->first_name) }}" readonly>
            </div>
            <div class="col-md-6">
                <label for="lastName" class="form-label">Last Name</label>
                <input type="email" class="form-control" id="lastName"
                name="Last Name" placeholder="Last Name" required
                    value="{{ old('first_name', $purchase->user->second_name) }}" readonly>
            </div>
            <div class="col-md-6">
                <label for="UserEmail" class="form-label">Email</label>
                <input type="email" class="form-control" id="UserEmail"
                name="UserEmail" placeholder="email" required
                    value="{{ old('email', $purchase->user->email) }}" readonly>
            </div>
            <div class="col-md-6">
                <label for="transactionType" class="form-label">Transaction Type</label>
                <input type="email" class="form-control" id="transactionType"
                name="TransactionType" placeholder=" Transaction Type" required
                    value="{{ old('transaction_type', $userAddress->transaction_type) }}" readonly>
            </div>
            <div class="col-12">
                <label for="UserAddress" class="form-label">Address</label>
                <input type="text" class="form-control" id="UserAddress" placeholder="1234 Main St"
                name="Address" required
                    value="{{ old('address', $userAddress->address) }}" readonly>
            </div>
            <div class="col-12">
                <label for="UserAddress2" class="form-label">Address 2</label>
                <input type="text" class="form-control" id="UserAddress2" placeholder="Apartment, studio, or floor" name="UserAddress2"
                    value="{{ old('address2', $userAddress->address_2) }}" readonly required>
            </div>
            <div class="col-md-6">
                <label for="UserCity" class="form-label">City</label>
                <input type="text" class="form-control" id="UserCity" name="UserCity" placeholder="City" required
                 value="{{ old('address2', $userAddress->city) }}"
                    readonly>
            </div>
            <div class="col-md-4">
                <label for="userMobile" class="form-label">User Mobile Number</label>
                <input type="text" class="form-control" id="userMobile" name="userMobile" placeholder="Mobile Number" required
                 value="{{ old('phone', $userAddress->phone) }}"
                    readonly>
            </div>
            <div class="col-md-2">
                <label for="zipCode" class="form-label">Zip</label>
                <input type="text" class="form-control" id="zipCode" name="zipCode" placeholder="Zip Code" required
                    value="{{ old('address2', $userAddress->zip_code) }}" readonly>
            </div>
            {{-- <div class="col-12">
                <button type="submit" class="btn btn-primary">Sign in</button>
            </div> --}}

            <h1 class="my-5">Ordered Product</h1>
            <div class="col-md-6" style="display: flex;
            flex-direction: column;">
                <label for="productImages" class="form-label">Product Images</label>
                <div class="d-flex">
                    @foreach ($purchase->clothe->productImages as $productImages)
                        <img class="me-1" src="{{ asset($productImages->product_images) }}" alt="product_image"
                            width="100">
                    @endforeach
                </div>
            </div>
            <div class="col-md-6">
                <label for="productName" class="form-label">Product Name</label>
                <input type="text" class="form-control" id="productName" name="productName" placeholder="Product Name" required
                    value="{{ old('name', $purchase->clothe->name) }}" readonly>
            </div>
            {{-- <div class="col-md-6">
                <label for="inputEmail4" class="form-label">Product Category</label>
                <input type="email" class="form-control" id="inputEmail4"
                    value="{{ old('first_name', $purchase->clothe->name) }}" readonly>
            </div> --}}
            <div class="col-md-6">
                <label for="productQuantity" class="form-label">Product Quantity</label>
                <input type="text" class="form-control" id="productQuantity" name="productQuantity" value="{{ old('quantity', $purchase->quantity) }}"
                    readonly>
            </div>
            <div class="col-md-6">
                <label for="productPrice" class="form-label">Product Unit Price</label>
                <input type="text" class="form-control" id="productPrice" name="productPrice" placeholder="product unit price"
                    value="{{ old('price', $purchase->clothe->price) }}" readonly>
            </div>
            <div class="col-md-6">
                <label for="productTotalPrice" class="form-label">Total Price</label>
                <input type="email" class="form-control" id="productTotalPrice" name="productTotalPrice" placeholder="Total Price"
                    value="{{ old('total_price', $purchase->total_price) }}" readonly>
            </div>
            <div class="col-md-6">
                <label for="productColor" class="form-label">Product Color</label>
                <input type="email" class="form-control" id="productColor" name="productColor"
                    value="{{ old('color', $purchase->color->color) }}" readonly>
            </div>
            <div class="col-md-6">
                <label for="productSize" class="form-label">Product Size</label>
                <input type="email" class="form-control" id="productSize" name="productSize"
                    value="{{ old('size', $purchase->size->size) }}" readonly>
            </div>
            <div class="col-md-12">
                <label for="productLink" class="form-label">Product Link</label>
                <input type="email" class="form-control" id="productLink" name="productLink" value="{{ url($link) }}" readonly>
            </div>
        </div>

        <form class="row g-3 mt-5" action="{{ route('orderStatus.update', $purchase->id) }}" method="POST">
            @csrf
            <div class="col-md-6">
                <label for="productState" class="form-label">Order Status</label>
                <select id="productState" class="form-select" name="order_status" required>
                    <option selected value="{{ $purchase->order_status }}">{{ $purchase->order_status }}</option>
                    <hr>
                    <option value="Pending">Pending</option>
                    <option value="Shipped">Shipped</option>
                    <option value="Delivered">Delivered</option>
                </select>
            </div>

            <div class="button my-5 d-flex align-items-center">
                <button type="submit" class="btn btn-primary me-3">Change Order Status</button>
                <a href="" class="btn btn-danger">Cancel Order</a>
            </div>
        </form>
    </div>
@endsection
