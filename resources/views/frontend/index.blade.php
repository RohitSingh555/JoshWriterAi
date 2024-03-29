<!DOCTYPE html>

<html lang="en">



<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Josh Writer AI | Home</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <link rel="icon" type="image/x-icon" href="{{ asset('frontend/images/logo.png') }}">

    <link rel="stylesheet" href="{{ asset('admin') }}/plugins/fontawesome-free/css/all.min.css">

    <meta property="og:title" content="Josh Writer Ai">

    <meta property="og:description" content="Create your social media posts with (Josh Writer Ai)">

    <meta property="og:image" content="{{ env('APP_URL') }}/frontend/images/logo.png">

    <meta property="og:url" content="{{ route('Home') }}">

    <meta property="og:type" content="website">

    <meta property="og:site_name" content="Josh Writer Ai">
    
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

            <a class="navbar-brand" href="#"><img src="{{ asset('frontend/images/logo.png') }}"

                    alt=""></a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"

                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation"

                style="background: white">

                <span class="navbar-toggler-icon"></span>

            </button>

            <div class="collapse navbar-collapse" id="navbarNavDropdown" style="justify-content: end;">

                <ul class="navbar-nav">

                    <!--<li class="nav-item">-->

                    <!--    <a class="nav-link active" aria-current="page" href="{{ route('Home') }}"-->

                    <!--        style="color: white;     padding: 5px 50px 0px 0px;">HOME</a>-->

                    <!--</li>-->

                    <!--<li class="nav-item">-->

                    <!--    <a class="nav-link active" aria-current="page" href="#"-->

                    <!--        style="color: white;    padding: 5px 50px 0px 0px;">FEATURES</a>-->

                    <!--</li>-->

                    <!--<li class="nav-item">-->

                    <!--    <a class="nav-link active" aria-current="page" href="#"-->

                    <!--        style="color: white;     padding: 5px 50px 0px 0px;">Pricing</a>-->

                    </li>

                    <li class="nav-item">

                        <a class="nav-link active" aria-current="page"

                            style="color: white;     padding: 5px 50px 0px 0px;">

                            <img src="{{ asset('frontend/images/user.png') }}" alt="">

                        </a>

                    </li>

                    <li class="nav-item">

                        <a class="nav-link active" aria-current="page" href="{{ route('logout') }}"

                            style="color: white; padding: 5px 50px 0px 0px;"><i class="nav-icon fas fa-power-off"

                                style="font-size: 27px;" title="Logout"></i></a>

                    </li>

                </ul>

            </div>

        </div>

    </nav>

    <p style="color: white; text-align: center;">Hi {{ Auth::user()->name }}, Welcome to our Josh Writer AI</p>

    <section>

        <div class="container">

            <div class="row">

                <div class="col-lg-3">

                    <div class="card">

                        <div class="card-body">

                            <h5 class="card-title"><img src="{{ asset('frontend/images/prompt.png') }}" alt=""

                                    style="margin-top: -2px;"> <span>PROMPTS</span></h5>

                            <hr>

                            @if ($name == 'social-media-ad-copy-creation')

                                <a href="{{ route('CreatePost', 'social-media-ad-copy-creation') }}"

                                    style="text-decoration: none; color:#23D4C4;">

                                    <h5 class="card-title"><img src="{{ asset('frontend/images/social.png') }}"

                                            alt="" style="margin-top: -2px;"> <span

                                            class="highlight-text">Social

                                            Media Ad Copy

                                            Creation</span></h5>

                                </a>

                            @else

                                <a href="{{ route('CreatePost', 'social-media-ad-copy-creation') }}"

                                    style="text-decoration: none; color:black;">

                                    <h5 class="card-title"><img src="{{ asset('frontend/images/social.png') }}"

                                            alt="" style="margin-top: -2px;"> <span

                                            class="highlight-text">Social

                                            Media Ad Copy

                                            Creation</span></h5>

                                </a>

                            @endif

                            @if ($name == 'email-copy-creation')

                                <a href="{{ route('CreatePost', 'email-copy-creation') }}"

                                    style="text-decoration: none; color:#23D4C4;">

                                    <h5 class="card-title"><img src="{{ asset('frontend/images/mail.png') }}"

                                            alt="" style="margin-top: -2px;"> <span

                                            class="highlight-text">Email

                                            Copy

                                            Creation</span>

                                    </h5>

                                </a>

                            @else

                                <a href="{{ route('CreatePost', 'email-copy-creation') }}"

                                    style="text-decoration: none; color:black;">

                                    <h5 class="card-title"><img src="{{ asset('frontend/images/mail.png') }}"

                                            alt="" style="margin-top: -2px;"> <span

                                            class="highlight-text">Email

                                            Copy

                                            Creation</span>

                                    </h5>

                                </a>

                            @endif

                            @if ($name == 'history')

                                <a href="{{ route('history') }}" style="text-decoration: none; color:#23D4C4;">

                                    <h5 class="card-title"><i class="fas fa-history"></i> <span

                                            class="highlight-text">

                                            History</span>

                                    </h5>

                                </a>

                            @else

                                <a href="{{ route('history') }}" style="text-decoration: none; color:black;">

                                    <h5 class="card-title"><i class="fas fa-history"></i> <span

                                            class="highlight-text">

                                            History</span>

                                    </h5>

                                </a>

                            @endif

                        </div>

                    </div>

                </div>

                <div class="col-lg-9">

                    <div class="card" style="background: #22D4C4;margin-bottom: 60px;">

                        <div class="card-body">

                            @if ($name == 'social-media-ad-copy-creation')

                                <h5 class="card-title" style="text-align: center">Create a social media post</h5>

                                <!--<h6 class="card-subtitle mb-2 text-muted" style="text-align: center">(WITH IMAGES)-->

                                </h6>

                            @endif

                            @if ($name == 'email-copy-creation')

                                <h5 class="card-title" style="text-align: center">Email Copy Creation</h5>

                            @endif



                            <div class="container">

                                <hr>

                                <form action="{{ route('GetPost') }}" method="GET">

                                    @csrf

                                    <div class="row">

                                        <div class="col-lg-12">

                                            <label style="font-weight: 600">Business/Brand Name*</label>

                                            <input type="text" class="form-control"

                                                placeholder="Type Here Your Business Name/Brand Name Here"

                                                style="margin-top: 20px;" name="brand" required>

                                            <div class="row">

                                                <div class="col-6">

                                                    <p>Example: Gucci</p>

                                                </div>

                                                <div class="col-6">

                                                    <p style="text-align: end; font-weight: 500; color: red;"><span

                                                            id="brandCharCount">50</span> / 50</p>

                                                </div>

                                            </div>







                                        </div>

                                        <div class="col-lg-12" style="margin-top: 20px;">

                                            <label style="font-weight: 600">Write Short Description Of

                                                Product/Service*</label>

                                            <textarea id="desc_brand" name="desc_brand" cols="30" rows="7" class="form-control"

                                                placeholder="Type Here A Short Description About Your Brand" required></textarea>

                                            <div class="row">

                                                <div class="col-6">

                                                    <p>Example: Gucci is a best perfume maker </p>

                                                </div>

                                                <div class="col-6">

                                                    <p style="text-align: end; font-weight: 500; color: red;"><span

                                                            id="descBrandCharCount">350</span> / 350

                                                    </p>

                                                </div>

                                            </div>





                                        </div>

                                        <div class="col-lg-12" style="margin-top: 20px;">

                                            <label style="font-weight: 600">Provide bullet points of what makes your

                                                product/service better than others*</label>

                                            <textarea type="text" name="better_brand" id="" cols="30" rows="6" class="form-control"

                                                placeholder="1. Type Here Bullet Points" required></textarea>

                                            <div class="row">

                                                <div class="col-6">

                                                    <p>Example: 1: Gucci is a best perfume maker </p>

                                                </div>

                                                <div class="col-6">

                                                    <p style="text-align: end; font-weight: 500; color: red;"><span

                                                            id="betterBrandCharCount">100</span> /

                                                        100</p>

                                                </div>

                                            </div>







                                        </div>

                                        @if ($name == 'email-copy-creation')

                                            <input type="text" hidden name="type" value="email-copy-creation">

                                        @endif

                                        @if ($name == 'social-media-ad-copy-creation')

                                            <input type="text" hidden name="type"

                                                value="social-media-ad-copy-creation">

                                        @endif

                                        @if ($name == 'email-copy-creation')

                                            <label style="font-weight: 600">Promotion - Is this a limited time or offer

                                                ends on

                                                date?*</label>

                                            <div class="row">

                                                <div class="col-lg-4" style="margin-top: 20px; margin-bottom: 20px;">

                                                    <select id="dateType" class="form-control" name="date_type"

                                                        required>

                                                        <option value="">Select</option>

                                                        <option value="Limited">Limited</option>

                                                        <option value="EndOfDate">End Of Date</option>

                                                    </select>

                                                </div>

                                                <div class="col-lg-4" style="margin-top: 20px; margin-bottom: 20px;">

                                                    <div id="dateField" style="display: none;">

                                                        <input type="date" class="form-control" name="end_date">

                                                    </div>

                                                </div>

                                            </div>

                                        @endif

                                        {{-- <label style="font-weight: 600">How Many Variations You Want?*</label>

                                        <div class="col-lg-4" style="margin-top: 20px;    margin-bottom: 20px;">

                                            <select id="" class="form-control" name="variations" required>

                                                <option value="">Select</option>

                                                <option value="1">1 Variation</option>

                                                <option value="2">2 Variation</option>

                                                <option value="3">3 Variation</option>

                                            </select>

                                        </div> --}}

                                        <label style="font-weight: 600">Please Select The Language*</label>

                                        <div class="col-lg-4" style="margin-top: 20px;    margin-bottom: 20px;">

                                            <select id="" class="form-control" name="lang" required>

                                                <option value="">Select</option>

                                                <option value="English">English</option>

                                                <option value="Spanish">Spanish</option>

                                            </select>

                                        </div>

                                    </div>

                                    <div class="row">

                                        <div class="col-12" style="    text-align: center;">

                                            <button type="submit" class="btn btn-success"

                                                style="background: #151B3B;

                                                padding: 10px 30px 14px 30px;">Generate</button>

                                            <p style="color: rgba(105, 105, 105, 1); margin-top: 10px">Please note it

                                                could take few moments to generate results.</p>

                                        </div>

                                    </div>

                                </form>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>



    <script>

        // Get the input fields and character count display elements by their IDs

        const brandInput = document.querySelector('input[name="brand"]');

        const brandCharCount = document.getElementById('brandCharCount');



        const descBrandTextarea = document.getElementById('desc_brand');

        const descBrandCharCount = document.getElementById('descBrandCharCount');



        const betterBrandTextarea = document.querySelector('textarea[name="better_brand"]');

        const betterBrandCharCount = document.getElementById('betterBrandCharCount');



        // Initialize character count displays

        brandCharCount.textContent = 50;

        descBrandCharCount.textContent = 350;

        betterBrandCharCount.textContent = 100;



        // Add input event listeners to update character counts and enforce the maxlength

        brandInput.addEventListener('input', function() {

            const remainingChars = 50 - brandInput.value.length;

            brandCharCount.textContent = remainingChars;



            if (remainingChars < 0) {

                brandInput.value = brandInput.value.slice(0, 50);

                brandCharCount.textContent = 0;

            }

        });



        descBrandTextarea.addEventListener('input', function() {

            const remainingChars = 350 - descBrandTextarea.value.length;

            descBrandCharCount.textContent = remainingChars;



            if (remainingChars < 0) {

                descBrandTextarea.value = descBrandTextarea.value.slice(0, 350);

                descBrandCharCount.textContent = 0;

            }

        });



        betterBrandTextarea.addEventListener('input', function() {

            const remainingChars = 100 - betterBrandTextarea.value.length;

            betterBrandCharCount.textContent = remainingChars;



            if (remainingChars < 0) {

                betterBrandTextarea.value = betterBrandTextarea.value.slice(0, 100);

                betterBrandCharCount.textContent = 0;

            }

        });

    </script>

    <script>

        $(document).ready(function() {

            $(".card-title").click(function() {

                $(".highlight-text").removeClass("highlighted");

                $(this).find(".highlight-text").addClass("highlighted");

            });

        });

    </script>

    <script>

        @if (Session::has('error'))

            toastr.options = {

                "closeButton": true,

                "progressBar": true

            }

            toastr.error("{{ session('error') }}");

        @endif

    </script>

    <script>

        @if (Session::has('success'))

            toastr.options = {

                "closeButton": true,

                "progressBar": true

            }

            toastr.success("{{ session('success') }}");

        @endif

    </script>

    <script>

        const dateTypeSelect = document.getElementById('dateType');

        const dateField = document.getElementById('dateField');



        dateTypeSelect.addEventListener('change', function() {

            if (dateTypeSelect.value === 'EndOfDate') {

                dateField.style.display = 'block';

            } else {

                dateField.style.display = 'none';

            }

        });

    </script>

</body>



</html>

