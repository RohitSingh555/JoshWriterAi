<!DOCTYPE html>

<html lang="en">



<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Josh Writer AI | Signup</title>

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('frontend/css/font-awesome/4.7.0/css/font-awesome.min.css') }}">

    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="icon" type="image/x-icon" href="{{ asset('frontend/images/logo.png') }}">

    <meta property="og:title" content="Josh Writer Ai | Signup">

    <meta property="og:description" content="(Josh Writer Ai) | Signup">

    <meta property="og:image" content="{{ env('APP_URL') }}/frontend/images/logo.png">

    <meta property="og:url" content="{{ route('signup') }}">

    <meta property="og:type" content="website">

    <meta property="og:site_name" content="Josh Writer Ai">
    
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <style>

        .form-control {

            height: 35px !important;

        }



        .form-group {

            margin-bottom: 8px !important;

        }

    </style>

</head>



<body>

    <div class="container" style="max-width: 1800px;">

        <div class="row justify-content-center" style="margin-top: 70px; margin-bottom: 70px;">

            <div class="col-md-12 col-lg-10 col-xl-7">

                <div class="wrap d-md-flex" style="height: 600px; background-color: #ffffff;">

                    <div class="text-wrap text-center align-items-center order-md-last d-small-none">

                        <img src="{{ asset('frontend/images/1.jpeg') }}" alt=""

                            style="height: 100%; width: 100%;">

                    </div>

                    <div class="login-wrap" style="margin-top: auto; margin-bottom: auto;">

                        <div class="d-flex">

                            <div class="w-100">

                                <h3 class="mb-3" style="font-weight: 600;"><b>Sign up</b></h3>



                            </div>

                        </div>

                        <a href="{{ route('social.oauth', 'google') }}"><button type="submit"

                            class="form-control submit px-3"

                            style="background: #ffffff; color: black;  box-shadow: 0px 0px 5px 1px #aaaa;"><img

                                src="{{ asset('frontend/images/google.png') }}" alt=""

                                style="height: 25px;    margin-top: -2px;">Log

                            in with

                            Google</button></a>

                        <div class="row" style="margin-top: 25px;">

                            <div class="col-sm-4 col-md-4 col-lg-4">

                                <hr>

                            </div>

                            <div class="col-sm-4 col-md-4 col-lg-4">

                                <p>Or Sign up</p>

                            </div>

                            <div class="col-sm-4 col-md-4 col-lg-4">

                                <hr>

                            </div>

                        </div>

                        <form action="{{ route('RegisterUser') }}" method="POST" class="signin-form">

                            @if (Session::has('success'))

                                <div class="alert alert-success m-4" style="width: 90%;">

                                    {{ Session::get('success') }}

                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">

                                        <span aria-hidden="true">&times;</span>

                                    </button>

                                </div>

                            @endif

                            @if (Session::has('error'))

                                <div class="alert alert-danger m-4" style="width: 90%;">

                                    {{ Session::get('error') }}

                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">

                                        <span aria-hidden="true">&times;</span>

                                    </button>

                                </div>

                            @endif

                            @csrf

                            <div class="form-group">

                                <label class="label" for="name">Name</label>

                                <input type="text" name="name" class="form-control" placeholder="Enter your name"

                                    style="box-shadow: 0px 0px 5px 1px #aaaa; background: none;"

                                    value="{{ old('name') }}">

                                @if ($errors->has('name'))

                                    <span class="text-danger">{{ $errors->first('name') }}</span>

                                @endif

                            </div>

                            <div class="form-group">

                                <label class="label" for="email">E-mail</label>

                                <input type="text" name="email" class="form-control"

                                    placeholder="Enter your e-mail"

                                    style="box-shadow: 0px 0px 5px 1px #aaaa; background: none;"

                                    value="{{ old('email') }}">

                                @if ($errors->has('email'))

                                    <span class="text-danger">{{ $errors->first('email') }}</span>

                                @endif

                            </div>

                            <div class="form-group">

                                <label class="label" for="password">Password</label>

                                <input type="password" name="password" class="form-control"

                                    placeholder="Enter your password"

                                    style="box-shadow: 0px 0px 5px 1px #aaaa; background: none;">

                                @if ($errors->has('password'))

                                    <span class="text-danger">{{ $errors->first('password') }}</span>

                                @endif

                            </div>

                            <div class="form-group">

                                <label class="label" for="password_confirmation">Confirm Password</label>

                                <input type="password" name="password_confirmation" class="form-control"

                                    placeholder="Re-Enter your password"

                                    style="box-shadow: 0px 0px 5px 1px #aaaa; background: none;">

                                @if ($errors->has('password_confirmation'))

                                    <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>

                                @endif

                            </div>

                            <div class="form-group">

                                <button type="submit" class="form-control btn btn-primary submit px-3">Sign Up</button>

                            </div>

                            <p>Already have an account? <span><a href="{{ route('login') }}">Log in</a></span></p>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <script src="{{ asset('frontend/js/jquery.min.js') }}"></script>

    <script src="{{ asset('frontend/js/popper.js') }}"></script>

    <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>

    <script src="{{ asset('frontend/js/main.js') }}"></script>

</body>



</html>

