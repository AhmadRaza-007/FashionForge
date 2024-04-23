<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!--    Bootstrap 5     -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!--    Font Awesome     -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>Document</title>
</head>
<style>
    .gradient-custom {
        /* fallback for old browsers */
        background: #6a11cb;

        /* Chrome 10-25, Safari 5.1-6 */
        background: -webkit-linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1));

        /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
        background: linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1))
        height: 100% !important;
    }
</style>

<body class="bg-dark">
    <section class="vh-100 gradient-custom" style="height: 100% !important;min-height: 100vh !important;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-dark text-white" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">

                            <form class="mb-md-5 mt-md-4 pb-5" action="{{ route('user.postSignup') }}" method="POST">
                                @csrf
                                <h2 class="fw-bold mb-2 text-uppercase">Sign Up</h2>
                                <p class="text-white-50 mb-5">Please enter desired fields to signup</p>
                                @error('*')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class=" d-flex justify-content-between">
                                    <div class="form-outline form-white mb-4 col-5">
                                        <label class="form-label" for="typeEmailX">First Name</label>
                                        <input type="text" name="first_name" id="typeEmailX"
                                            class="form-control form-control-lg" value="{{ old('first_name') }}" />
                                    </div>

                                    <div class="form-outline form-white mb-4 col-5">
                                        <label class="form-label" for="typeEmailX">Second Name</label>
                                        <input type="text" name="second_name" id="typeEmailX"
                                            class="form-control form-control-lg" value="{{ old('second_name') }}" />
                                    </div>
                                </div>

                                <div class="form-outline form-white mb-4">
                                    <label class="form-label" for="typeEmailX">Email</label>
                                    <input type="email" name="email" id="typeEmailX"
                                        class="form-control form-control-lg" value="{{ old('email') }}" />
                                </div>

                                <div class="form-outline form-white mb-4">
                                    <label class="form-label" for="typePasswordX">Password</label>
                                    <input type="password" name="password" id="typePasswordX"
                                        class="form-control form-control-lg" />
                                </div>

                                <div class="form-outline form-white mb-4">
                                    <label class="form-label" for="typeEmailX">Confirm Password</label>
                                    <input type="password" name="password_confirmation" id="typeEmailX"
                                        class="form-control form-control-lg" />
                                </div>

                                <p class="small mb-5 pb-lg-2"><a class="text-white-50" href="#!">Forgot
                                        password?</a></p>

                                <button class="btn btn-outline-light btn-lg px-5" type="submit">Sign Up</button>

                                {{-- <div class="d-flex justify-content-center text-center mt-4 pt-1">
                                    <a href="#!" class="text-white"><i class="fab fa-facebook-f fa-lg"></i></a>
                                    <a href="#!" class="text-white"><i
                                            class="fab fa-twitter fa-lg mx-4 px-2"></i></a>
                                    <a href="#!" class="text-white"><i class="fab fa-google fa-lg"></i></a>
                                </div> --}}

                            </form>

                            <div>
                                <p class="mb-0">Already have an account? <a href="{{ route('user.login') }}"
                                        class="text-white-50 fw-bold">Login</a>
                                </p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>
