<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Josh Writer AI | Payment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <link rel="icon" type="image/x-icon" href="{{ asset('frontend/images/logo.png') }}">
    <link rel="stylesheet" href="{{ asset('admin') }}/plugins/fontawesome-free/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
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
        background-color: #121212;
        color: #FBFBFB;
        border: 2px solid #23D4C4;
        padding-bottom: 20px;
    }

    .highlighted {
        color: #23D4C4;
    }

    .form-group label {
        color: #FBFBFB;
    }

    .form-control {
        background-color: #1f1f1f;
        color: #FBFBFB;
        border-color: #23D4C4;
    }

    .form-control:focus {
        background-color: #121212;
        color: #FBFBFB;
        border-color: #23D4C4;
    }

    .btn-primary {
        background-color: #23D4C4;
        border-color: #23D4C4;
    }

    .btn-primary:hover {
        background-color: #1AAE9E;
        border-color: #1AAE9E;
    }

    .btn-danger {
        background-color: #F44336;
        border-color: #F44336;
    }

    .btn-danger:hover {
        background-color: #D32F2F;
        border-color: #D32F2F;
    }

    .text-bold {
        font-weight: bold;
    }

    .increment-btn,
    .decrement-btn {
        background-color: #23D4C4;
        color: #fff;
        border: none;
        border-radius: 50%;
        width: 60px;
        /* Increase button size */
        height: 60px;
        /* Increase button size */
        cursor: pointer;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 24px;
        /* Adjust font size */
    }

    .increment-btn:hover,
    .decrement-btn:hover {
        background-color: #1AAE9E;
    }
</style>

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
                <div class="col-lg-8 mx-auto">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{route('checkout')}}" method="POST">
                                <div class="row">
                                    {{ csrf_field() }}
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-12 d-flex align-content-center">
                                                <div class="form-group d-flex align-content-center flex-column w-100 align-items-center gap-5 p-lg-5">
                                                    <h1>Buy Tokens</h1>
                                                    <label for="amount"><i class="fas fa-coins text-white" style="font-size: 100px;" title="Tokens"></i></label>
                                                    <div class="input-group px-5">
                                                        <button class="decrement-btn" type="button" onclick="decrementToken()">-</button>
                                                        <select class="form-control text-center fw-bold" style="font-size:25px" onchange="handleSelect()" id="amount" name="amount" required>
                                                            <option value="0" disabled selected>0</option>
                                                            <option value="1">1000</option>
                                                            <option value="2">2000</option>
                                                            <option value="3">3000</option>
                                                            <option value="4">4000</option>
                                                            <option value="5">5000</option>
                                                            <option value="6">6000</option>
                                                            <option value="7">7000</option>
                                                            <option value="8">8000</option>
                                                            <option value="9">9000</option>
                                                            <option value="10">10000</option>
                                                            <option value="50">50000</option>
                                                            <option value="100">100000</option>
                                                        </select>
                                                        <button class="increment-btn" type="button" onclick="incrementToken()">+</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 pt-5">
                                        <div class="d-flex flex-column align-items-center">
                                            <h2 class="text-light text-bold">Amount</h2>
                                            <h2 class="text-light text-bold" id="amount_val">$50</h2>
                                            <input id="token_val" type="hidden" name="tokens">
                                        </div>
                                    </div>
                                </div>
                                <div id="card-errors" role="alert"></div>
                                <div class="col-12 mt-5 d-flex justify-content-around w-100">
                                    <button class="btn px-5 fw-bold " style="color:black;background-color:#FBFBFB;" type="button" onclick="history.back()">Cancel</button>
                                    <button class="btn btn-primary px-5 fw-bold " type="submit">Make Payment &nbsp; <i class="nav-icon fas fa-arrow-right" title="Logout"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        let tokenAmount = 0;

        function incrementToken() {
            const select = document.getElementById("amount");
            const selectedIndex = select.selectedIndex;

            if (selectedIndex < select.options.length - 1) {
                select.selectedIndex = selectedIndex + 1;
                handleChange(select);
            }
        }

        function decrementToken() {
            const select = document.getElementById("amount");
            const selectedIndex = select.selectedIndex;

            if (selectedIndex > 0) {
                select.selectedIndex = selectedIndex - 1;
                handleChange(select);
            }
        }

        function handleSelect() {
            const amount = document.getElementById("amount");
            const selectedIndex = amount.selectedIndex;

            if (selectedIndex > 0) {
                amount.selectedIndex = selectedIndex * 1;
                handleChange(amount);
            }
        }

        function handleChange(me) {
            let amount = $(me).val();
            let tokens = me.options[me.selectedIndex].text;
            tokenAmount = parseInt(tokens);
            $('#amount_val').text('$' + (amount ? amount * 1 : 0));
            $('#token_val').val(tokenAmount * 1);
        }

        handleChange($('#amount')[0]);
    </script>
</body>

</html>