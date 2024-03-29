<!DOCTYPE html>

<html lang="en">



<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Josh Writer AI | Forgot Password</title>

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('frontend/css/font-awesome/4.7.0/css/font-awesome.min.css') }}">

    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="icon" type="image/x-icon" href="{{ asset('frontend/images/logo.png') }}">

    <meta property="og:title" content="Josh Writer Ai | Forget Password">

    <meta property="og:description" content="(Josh Writer Ai) | Forget Password">

    <meta property="og:image" content="{{ env('APP_URL') }}/frontend/images/logo.png">

    <meta property="og:url" content="{{ route('ForgetPassword') }}">

    <meta property="og:type" content="website">

    <meta property="og:site_name" content="Josh Writer Ai">
    
    <meta name="csrf-token" content="{{ csrf_token() }}">


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

                                <h3 class="mb-3" style="font-weight: 600;"><b>Forgot Password</b></h3>

                                <p>Did you forget your password? Please enter your email to receive a code.</p>

                            </div>

                        </div>

                        <div class="row" style="margin-top: 25px;">

                            <hr>

                        </div>

                        <form action="{{ route('PostForgetPassword') }}" method="POST" class="signin-form">

                            @csrf

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

                            <div class="form-group mb-3">

                                <label for="email" class="label">E-mail</label>

                                <input type="email" id="email" class="form-control" placeholder="Enter your email"

                                    required style="box-shadow: 0px 0px 5px 1px #aaaa; background: none;"

                                    value="{{ old('email') }}" name="email">

                                @if ($errors->has('email'))

                                    <span class="text-danger">{{ $errors->first('email') }}</span>

                                @endif

                            </div>

                            <label class="checkbox-wrap checkbox-primary mb-0" style="color: black; margin-top: 25px;">

                                <input type="checkbox" id="robot" name="robot">

                                <span class="checkmark"></span>

                                I am not a robot

                                <br>



                                @if ($errors->has('robot'))

                                    <span class="text-danger">{{ $errors->first('robot') }}</span>

                                @endif

                            </label>

                            <div class="form-group" style="margin-top: 20px;">

                                <button type="submit" class="form-control btn btn-primary submit px-3">Send

                                    Code</button>

                            </div>

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

