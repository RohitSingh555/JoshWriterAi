<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Josh Writer AI - Accept a payment</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <link rel="icon" type="image/x-icon" href="{{ asset('frontend/images/logo.png') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://js.stripe.com/v3/"></script>
    <style>
        @media (min-width: 1400px) {
            .container {
                max-width: 1450px !important;
            }
        }
        @media (min-width: 320px) {
            .card {
                margin-top: 15px;
            }
        }
        .card {
            border-radius: 20px;
            border: none
        }
        .highlighted {
            color: #23D4C4;
        }
    </style>
</head>
<body style="background:#151B3B">
<nav class="navbar navbar-expand-lg navbar-light bg-light" style="background: #151B3B !important">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="{{ asset('frontend/images/logo.png') }}" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation" style="background: white">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown" style="justify-content: end;">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" style="color: white;padding: 5px 50px 0px 0px;">
                        <img src="{{ asset('frontend/images/user.png') }}" alt="">
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('logout') }}" style="color: white; padding: 5px 50px 0px 0px;">
                        <i class="nav-icon fas fa-power-off" style="font-size: 27px;" title="Logout"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-9 offset-3">
                <div class="card" style="background: #22D4C4;margin-bottom: 60px;">
                    <div class="card-body">
                        <!-- Display a payment form -->
                        <form id="payment-form">
                            <input type="hidden" id="secret" value="{{$clientSecret}}">
                            <input type="hidden" id="payment_success_url" value="{{$url}}">
                            <div class="d-flex justify-content-between py-3">
                                <h2 class="text-light text-bold">Amount: ${{Session::get('amount')}}</h2>
                                <h2 class="text-light text-bold">Tokens: {{Session::get('tokens')}}</h2>
                            </div>
                            <div id="payment-element">
                                <!--Stripe.js injects the Payment Element-->
                            </div>
                            <button class="btn btn-primary mt-5" id="submit">
                                <div class="spinner hidden" id="spinner"></div>
                                <span id="button-text">Pay now</span>
                            </button>
                            <a class="btn btn-danger mt-5" type="button" href="{{route('Home')}}">Cancel</a>
                            <div id="payment-message" class="hidden"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="{{ asset('frontend') }}/js/checkout.js"></script>
</body>
</html>