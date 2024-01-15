@extends('app')
@section('content')

    <head>
        <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Arvo'>
    </head>
    <style>
        /*======================
            404 page
        =======================*/


        .page_404 {
            padding: 40px 0;
            background: #fff;
            font-family: 'Arvo', serif;
        }

        .page_404 img {
            width: 100%;
        }

        .four_zero_four_bg {

            background-image: url(https://cdn.dribbble.com/users/285475/screenshots/2083086/dribbble_1.gif);
            height: 400px;
            background-position: center;
            background-repeat: no-repeat
        }


        .four_zero_four_bg h1 {
            font-size: 80px;
            text-align: center
        }

        .four_zero_four_bg h3 {
            font-size: 80px;
            text-align: center
        }

        .link_404 {
            color: #fff !important;
            padding: 10px 20px;
            background: #39ac31;
            margin: 20px 0;
            display: inline-block;
        }

        .contant_box_404 {
            margin-top: -50px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
    </style>

    <section class="page_404">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 mt-5">
                    <div class="col-sm-10 col-sm-offset-1 m-auto my-5">
                        <div class="four_zero_four_bg">
                            <h1 class="text-center ">404</h1>


                        </div>

                        <div class="contant_box_404">
                            <h3 class="h2">
                                Look like you're lost
                            </h3>

                            <p>the page you are looking for not avaible!</p>

                            <a href="{{ route('user.homeSection') }}" class="link_404">Go to Home</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection