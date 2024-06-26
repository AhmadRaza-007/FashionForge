{{-- @extends('admin')
@section('content') --}}
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Source+Serif+Pro:400,600&display=swap" rel="stylesheet">

    <!-- <link rel="stylesheet" href="fonts/icomoon/style.css"> -->
    <link rel="stylesheet" href="{{ asset('assets/multiSelect/fonts/icomoon/style.css') }}">


    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets/multiSelect/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/multiSelect/css/bootstrap.min.css.map') }}">

    <!-- Style -->
    <link rel="stylesheet" href="{{ asset('assets/multiSelect/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/multiSelect/css/chosen.css') }}">

    <title>Multi Select #9</title>
</head>
<style>

</style>

<body>


    <div class="content">
        <h2 class="text-center">Multi-Select #9</h2>
        <div class="container text-left">
            <div class="row justify-content-center">
                <div class="col-md-5">
                    <select data-placeholder="Select Categories" class="chosen-select" tabindex="8" multiple>
                        <option>Design</option>
                        <option>HTML5</option>
                        <option>CSS3</option>
                        <option>jQuery</option>
                        <option>BS4</option>
                        <option>Bootstrap</option>
                        <option>WordPress</option>
                        <option>FrontEnd</option>
                    </select>
                </div>
            </div>
        </div>
    </div>



    <!-- <script src="js/jquery-3.3.1.min.js"></script> -->
    <script src="{{ asset('assets/multiSelect/js/jquery-3.3.1.min.js') }}"></script>
    <!-- <script src="js/popper.min.js"></script> -->
    <script src="{{ asset('assets/multiSelect/js/popper.min.js') }}"></script>
    <!-- <script src="js/bootstrap.min.js"></script> -->
    <script src="{{ asset('assets/multiSelect/js/bootstrap.min.js') }}"></script>
    <!-- <script src="js/chosen.jquery.min.js"></script> -->
    <script src="{{ asset('assets/multiSelect/js/chosen.jquery.min.js') }}"></script>

    <!-- <script src="js/main.js"></script> -->
    <script src="{{ asset('assets/multiSelect/js/main.js') }}"></script>
</body>

</html>
{{-- @endsection --}}
