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
        border: none
    }
    .highlighted {
        color: #23D4C4;
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
            <div class="col-lg-9 offset-3">
                <div class="card" style="background: #22D4C4;margin-bottom: 60px;">
                    <div class="card-body">
                        <form action="{{route('checkout')}}" method="POST">
                            <div class="row">
                                {{ csrf_field() }}
                                <div class="col-8">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="amount">Tokens:</label>
                                                <select onchange="handleChange(this)" class="form-control" id="amount" name="amount" required>
                                                    <option value="0" disabled selected>Please Select</option>
                                                    <option value="10">1000</option>
                                                    <option value="20">2000</option>
                                                    <option value="30">3000</option>
                                                    <option value="40">4000</option>
                                                </select>
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
                            <div class="col-12 mt-5">
                                <button class="btn btn-primary" type="submit">Pay Now</button>
                                <button class="btn btn-danger" type="button" onclick="history.back()">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    function handleChange(me){
        let amount = $(me).val();
        let tokens = me.options[me.selectedIndex].text;
        $('#amount_val').text('$'+(amount ? amount : 0));
        $('#token_val').val(tokens);
    }
    handleChange($('#amount')[0]);
</script>
</body>
</html>