@extends('userProfile')
@section('content')
    <div class="container">
        <form>
            <div class="row">
                <div class="mb-3 col-6">
                    <label for="exampleInputEmail1" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                        value="{{ old('first_name', auth()->user()->first_name) }}">
                    {{-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> --}}
                </div>
                <div class="mb-3 col-6">
                    <label for="exampleInputPassword1" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="exampleInputPassword1"
                        value="{{ old('last_name', auth()->user()->second_name) }}">
                </div>

                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Email</label>
                    <input type="email" class="form-control" id="exampleInputPassword1"
                        value="{{ old('eemail', auth()->user()->email) }}">
                </div>
                {{-- <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1">
                </div> --}}
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
