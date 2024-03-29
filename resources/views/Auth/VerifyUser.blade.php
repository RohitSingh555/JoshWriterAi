<!DOCTYPE html>

<html lang="en">



<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Josh Writer AI | Verify User</title>

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('frontend/css/font-awesome/4.7.0/css/font-awesome.min.css') }}">

    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="icon" type="image/x-icon" href="{{ asset('frontend/images/logo.png') }}">

    <meta property="og:title" content="Josh Writer Ai | Verify Account">

    <meta property="og:description" content="(Josh Writer Ai) | Verify Account">

    <meta property="og:image" content="{{ env('APP_URL') }}/frontend/images/logo.png">

    <meta property="og:url" content="{{ route('VerifyUser') }}">

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



        /* Center text horizontally and vertically in the input boxes */

        input[type="text"] {

            text-align: center;

            /* Center text horizontally */

            line-height: 2em;

            /* Center text vertically based on input height */

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

                                <h3 class="mb-3" style="font-weight: 600;"><b>Account Verification</b></h3>

                                <p>Hello <b>{{ Auth::user()->name }}</b>, We have sent a verification code to your

                                    email. Please check your email. If you haven't received a code, you can request a

                                    resend code. Thank you!</p>

                            </div>

                        </div>

                        <form action="{{ route('PostVerifyUser') }}" method="POST" class="signin-form">

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

                                <label class="label" for="code">Code</label>

                                <input type="text" id="digit1" name="digit1" pattern="[0-9]" size="1"

                                    maxlength="1" inputmode="none" oninput="moveToNextInput(this)" required

                                    style="width: 30px;">

                                <input type="text" id="digit2" name="digit2" pattern="[0-9]" size="1"

                                    maxlength="1" inputmode="none" oninput="moveToNextInput(this)"required

                                    style="width: 30px;">

                                <input type="text" id="digit3" name="digit3" pattern="[0-9]" size="1"

                                    maxlength="1" inputmode="none"oninput="moveToNextInput(this)"required

                                    style="width: 30px;">

                                <input type="text" id="digit4" name="digit4" pattern="[0-9]" size="1"

                                    maxlength="1" inputmode="none"oninput="moveToNextInput(this)"required

                                    style="width: 30px;">

                                <input type="text" id="digit5" name="digit5" pattern="[0-9]" size="1"

                                    maxlength="1" inputmode="none"oninput="moveToNextInput(this)"required

                                    style="width: 30px;">

                                <input type="text" id="digit6" name="digit6" pattern="[0-9]" size="1"

                                    maxlength="1" inputmode="none"oninput="moveToNextInput(this)"required

                                    style="width: 30px;">

                            </div>

                            <p>Enter 6 digit code that you have received in your email.</p>

                            <div class="form-group">

                                <button type="submit"

                                    class="form-control btn btn-primary submit px-3">Verify</button>

                            </div>

                            <p>Dont received a code? <span><a href="{{ route('ResendCode') }}">Resend</a></span></p>

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

    <script>

        function moveToNextInput(inputElement) {

            if (inputElement.value.length >= 1) {

                var nextInputId = parseInt(inputElement.id.replace("digit", "")) + 1;

                if (nextInputId <= 6) {

                    var nextInput = document.getElementById("digit" + nextInputId);

                    if (nextInput) {

                        nextInput.focus();

                    }

                }

            }

        }

    </script>

</body>



</html>

