<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="{{ asset('assets/admin/cards.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/custom.css') }}">

    <title>Document</title>
</head>

<body>
    <div class="container">
        <div class="dash-cards px-5 py-5" style="width: 100%; position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);">
            <div class="dash-card dash-card--fb" style="width: 40%;min-width: 30rem;margin: auto;">
                <form class="admin_login" action="{{ route('admin.postLogin') }}" method="post">
                    @csrf
                    <div class="admin_login-screen">
                        <div class="app-title">
                            <h1>Admin Login</h1>
                        </div>
                        <div class="admin_login-form">
                            <div class="control-group">
                                <input type="text" class="login-field" name="email" value="{{ old('email') }}" placeholder="Email" id="login-name">
                                <label class="login-field-icon fui-user" for="login-name"></label>
                                <span class="text-danger">
                                    @error('email')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="control-group">
                                <input type="password" class="login-field" name="password" value="" placeholder="Password" id="login-pass">
                                <label class="login-field-icon fui-lock" for="login-pass"></label>
                                <span class="text-danger">
                                    @error('password')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <button type="submit" class="btn btn-primary btn-large btn-block mb-3">login</button>
                            <!-- <a class="login-link" href="#">Lost your password?</a> -->
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>