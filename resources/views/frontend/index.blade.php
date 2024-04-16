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

    .popup {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: #fff;
        border: 2px solid #22D4C4;
        padding: 40px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        z-index: 9999;
        display: none;
        font-weight: bold;
        color: #151B3B;
        font-size: 20px;
    }

    .popup.show {
        display: block;
    }

    .overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        /* Adjust the opacity as needed */
        z-index: 1000;
        /* Ensure the overlay is on top of everything */
        display: none;
        /* Initially hidden */
    }

    /* Style for the loader */
    .loader {
        position: fixed !important;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 1001;
        display: none;
    }
</style>



<body style="background:#151B3B">

    <nav class="navbar navbar-expand-lg navbar-light bg-light" style="background: #151B3B !important">

        <div class="container-fluid">


            <a class="navbar-brand" href="#"><img src="{{ asset('frontend/images/logo.png') }}" alt=""></a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation" style="background: white">

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
                    <li class="nav-item user-tokens fw-bold align-items-baseline d-flex px-4" style=" box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                        <span class="text-white me-2">
                            <span class="text-white"></span>
                            <i class="fas fa-coins text-white" style="font-size: 27px;" title="Tokens"></i>
                        </span>
                        <span class="tokens text-white font-weight-bold">{{ $user_last_tokens }} &nbsp;</span>
                        <a class="btn btn-sm" href="{{ route('purchase') }}" style=" border: 2px solid white;color: white; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2); font-weight:600;">
                            <i class="fas fa-plus"></i> &nbsp;Add Tokens
                        </a>
                    </li>




                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: white; padding: 5px 50px 0px 0px;">
                            <img style="width: 24px;" src="{{ asset('frontend/images/user.png') }}" alt="">
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#changePasswordModal">Change Password</a></li>
                        </ul>
                    </li>

                    <div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content" style="background-color: #22d4c4;">
                                <div class="modal-header">
                                    <h5 class="modal-title text-white" id="exampleModalLabel">Change Password</h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="changePasswordForm">
                                        <div class="mb-3">
                                            <label for="oldPassword" class="form-label text-white">Current Password</label>
                                            <input type="password" class="form-control" id="oldPassword" style="background-color: #fff;">
                                        </div>
                                        <div class="mb-3">
                                            <label for="newPassword" class="form-label text-white">New Password</label>
                                            <input type="password" class="form-control" id="newPassword" style="background-color: #fff;">
                                        </div>
                                        <div class="mb-3">
                                            <label for="repeatNewPassword" class="form-label text-white">Repeat New Password</label>
                                            <input type="password" class="form-control" id="repeatNewPassword" style="background-color: #fff;">
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="closeModalBtn">Close</button>
                                    <button type="button" class="btn btn-dark" id="saveChangesBtn">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>


                    <li class="nav-item">

                        <a class="nav-link active" aria-current="page" href="{{ route('logout') }}" style="color: white; padding: 5px 50px 0px 0px;"><i class="nav-icon fas fa-power-off" style="font-size: 27px;" title="Logout"></i></a>

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

                            <h5 class="card-title"><img src="{{ asset('frontend/images/prompt.png') }}" alt="" style="margin-top: -2px;"> <span>PROMPTS</span></h5>

                            <hr>

                            @if ($name == 'social-media-ad-copy-creation')

                            <a href="{{ route('CreatePost', 'social-media-ad-copy-creation') }}" style="text-decoration: none; color:#23D4C4;">

                                <h5 class="card-title"><img src="{{ asset('frontend/images/social.png') }}" alt="" style="margin-top: -2px;"> <span class="highlight-text">Social

                                        Media Ad Copy

                                        Creation</span></h5>

                            </a>

                            @else

                            <a href="{{ route('CreatePost', 'social-media-ad-copy-creation') }}" style="text-decoration: none; color:black;">

                                <h5 class="card-title"><img src="{{ asset('frontend/images/social.png') }}" alt="" style="margin-top: -2px;"> <span class="highlight-text">Social

                                        Media Ad Copy

                                        Creation</span></h5>

                            </a>

                            @endif

                            @if ($name == 'ugc-video')

                            <a href="{{ route('CreatePost', 'ugc-video') }}" style="text-decoration: none; color:#23D4C4;">

                                <h5 class="card-title"><i class="fas fa-solid fa-video"></i> <span class="highlight-text">UGC Video Creation</span></h5>

                            </a>

                            @else

                            <a href="{{ route('CreatePost', 'ugc-video') }}" style="text-decoration: none; color:black;">

                                <h5 class="card-title"><i class="fas fa-solid fa-video"></i> <span class="highlight-text">UGC Video Creation</span></h5>

                            </a>

                            @endif

                            @if ($name == 'competitor-ad-ideas-and-concepts')

                            <a href="{{ route('CreatePost', 'competitor-ad-ideas-and-concepts') }}" style="text-decoration: none; color:#23D4C4;">

                                <h5 class="card-title"><i class="fas fa-solid fa-lightbulb"></i> <span class="highlight-text">&nbsp;Ad Ideas & Concepts Creation</span></h5>

                            </a>

                            @else

                            <a href="{{ route('CreatePost', 'competitor-ad-ideas-and-concepts') }}" style="text-decoration: none; color:black;">

                                <h5 class="card-title"><i class="fas fa-solid fa-lightbulb"></i><span class="highlight-text">&nbsp;Ad Ideas & Concepts Creation</span></h5>

                            </a>

                            @endif

                            @if ($name == 'email-copy-creation')

                            <a href="{{ route('CreatePost', 'email-copy-creation') }}" style="text-decoration: none; color:#23D4C4;">

                                <h5 class="card-title"><img src="{{ asset('frontend/images/mail.png') }}" alt="" style="margin-top: -2px;"> <span class="highlight-text">Email

                                        Copy

                                        Creation</span>

                                </h5>

                            </a>

                            @else

                            <a href="{{ route('CreatePost', 'email-copy-creation') }}" style="text-decoration: none; color:black;">

                                <h5 class="card-title"><img src="{{ asset('frontend/images/mail.png') }}" alt="" style="margin-top: -2px;"> <span class="highlight-text">Email

                                        Copy

                                        Creation</span>

                                </h5>

                            </a>

                            @endif

                            @if ($name == 'history')

                            <a href="{{ route('history') }}" style="text-decoration: none; color:#23D4C4;">

                                <h5 class="card-title"><i class="fas fa-history"></i> <span class="highlight-text">

                                        History</span>

                                </h5>

                            </a>

                            @else

                            <a href="{{ route('history') }}" style="text-decoration: none; color:black;">

                                <h5 class="card-title"><i class="fas fa-history"></i> <span class="highlight-text">

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
                            @if ($name == 'ugc-video')

                            <h5 class="card-title" style="text-align: center">UGC Video Creation</h5>

                            @endif
                            @if ($name == 'competitor-ad-ideas-and-concepts')

                            <h5 class="card-title" style="text-align: center">Competitor Ad Ideas & Concepts Creation</h5>

                            @endif

                            <!-- Form -->





                            @if ($name == 'social-media-ad-copy-creation' or $name == 'email-copy-creation' or $name == 'ugc-video' or $name == 'competitor-ad-ideas-and-concepts')
                            <div class="container">

                                <hr>

                                <form action="{{ route('GetPost') }}" method="POST">

                                    @csrf

                                    <div class="row">

                                        <div class="col-lg-12">

                                            <label style="font-weight: 600">Business Name</label>

                                            <input required type="text" maxlength="50" class="form-control brand-input" placeholder="Type Here Your Business Name/Brand Name Here" style="margin-top: 20px;" name="brand" required>

                                            <div class="row">

                                                <div class="col-6">

                                                    <p>Example: Gucci</p>

                                                </div>

                                                <div class="col-6">

                                                    <p style="text-align: end; font-weight: 500; color: black;"><span class="brand-char-count">0</span> / 50</p>

                                                </div>

                                            </div>


                                        </div>

                                        <div class="col-lg-12" style="margin-top: 20px;">

                                            <label style="font-weight: 600">Please tell us about your business (What do you do?)</label>

                                            <textarea maxlength="350" id="desc_brand" name="desc_brand" cols="30" rows="7" class="form-control brand-input" placeholder="Type Here A Short Description About Your Brand" required></textarea>

                                            <div class="row">

                                                <div class="col-6">

                                                    <p>Example: Gucci is a best perfume maker </p>

                                                </div>

                                                <div class="col-6">

                                                    <p style="text-align: end; font-weight: 500; color: black;"><span class="brand-char-count">0</span> / 350

                                                    </p>

                                                </div>

                                            </div>





                                        </div>
                                        @if ($name != 'competitor-ad-ideas-and-concepts')
                                        <div class="col-lg-12" style="margin-top: 20px;">

                                            <label style="font-weight: 600"> What are the main value propositions of your business?
                                            </label>

                                            <textarea maxlength="100" type="text" name="better_brand" id="" cols="30" rows="6" class="form-control brand-input" placeholder="1. Type Here Bullet Points" required></textarea>

                                            <div class="row">

                                                <div class="col-6">

                                                    <p>Example: 1: Gucci is a best perfume maker </p>

                                                </div>

                                                <div class="col-6">

                                                    <p style="text-align: end; font-weight: 500; color: black;"><span class="brand-char-count">0</span> /

                                                        100</p>

                                                </div>

                                            </div>







                                        </div>
                                        @endif
                                        @if ($name != 'competitor-ad-ideas-and-concepts')
                                        <div class="col-lg-12" style="margin-top: 20px;">

                                            <label style="font-weight: 600"> Is there a promotion you are running? What are the details? Is it a limited quantity, or when does the offer expire? (If none write NA)
                                            </label>

                                            <textarea maxlength="100" type="text" name="promotion_details" id="" cols="30" rows="6" class="form-control brand-input" placeholder="Limited? or None?" required></textarea>

                                            <div class="row">

                                                <div class="col-6">

                                                    <p></p>

                                                </div>

                                                <div class="col-6">

                                                    <p style="text-align: end; font-weight: 500; color: black;"><span class="brand-char-count">0</span> /

                                                        100</p>

                                                </div>

                                            </div>


                                        </div>
                                        @endif
                                        @if ($name == 'email-copy-creation')

                                        <input type="text" hidden name="type" value="email-copy-creation">

                                        @endif

                                        @if ($name == 'social-media-ad-copy-creation')

                                        <input type="text" hidden name="type" value="social-media-ad-copy-creation">

                                        @endif
                                        @if ($name == 'competitor-ad-ideas-and-concepts')

                                        <input type="text" hidden name="type" value="competitor-ad-ideas-and-concepts">

                                        @endif
                                        @if ($name == 'ugc-video')

                                        <input type="text" hidden name="type" value="ugc-video">

                                        @endif

                                        @if ($name == 'email-copy-creation')

                                        <label style="font-weight: 600">Promotion - Is this a limited time or offer

                                            ends on

                                            date?*</label>

                                        <div class="row">

                                            <div class="col-lg-4" style="margin-top: 20px; margin-bottom: 20px;">

                                                <select id="dateType" class="form-control" name="date_type" required>

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

                                        <div class="col-12" style="text-align: center;">
                                            <button id="generateButton" type="submit" class="btn btn-success" style="background: #151B3B; padding: 10px 30px 14px 30px;">
                                                Generate
                                            </button>
                                            <p style="color: rgba(105, 105, 105, 1); margin-top: 10px">Please note it could take few moments to generate results.</p>
                                        </div>


                                    </div>

                                </form>

                            </div>
                            @endif
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

    <div class="overlay" id="overlay"></div>


    <div class="loader" id="loader">
        <img src="{{ asset('frontend/images/loader.gif') }}" alt="Loading..." style="width: 100px; height: 100px;">
    </div>


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
        @if(Session::has('error'))

        toastr.options = {

            "closeButton": true,

            "progressBar": true

        }

        toastr.error("{{ session('error') }}");

        @endif
    </script>

    <script>
        @if(Session::has('success'))

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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('changePasswordForm');
            const saveChangesBtn = document.getElementById('saveChangesBtn');
            const closeModalBtn = document.getElementById('closeModalBtn');

            saveChangesBtn.addEventListener('click', function() {
                const oldPassword = document.getElementById('oldPassword').value;
                const newPassword = document.getElementById('newPassword').value;
                const repeatNewPassword = document.getElementById('repeatNewPassword').value;
                var userEmail = "{{ Auth::user()->email }}";

                const formData = new FormData();
                formData.append('email', userEmail);
                formData.append('oldPassword', oldPassword);
                formData.append('newPassword', newPassword);
                formData.append('repeatNewPassword', repeatNewPassword);

                fetch('/change-password', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        const popup = document.createElement('div');
                        popup.classList.add('popup');
                        popup.textContent = data.success ? 'Password changed successfully. Please log in again.' : 'Failed to change password. Please try again.';
                        document.body.appendChild(popup);

                        popup.classList.add('show');

                        setTimeout(function() {
                            popup.classList.remove('show');
                            window.location.href = '/logout';
                        }, 2000);
                    })

                    .catch(error => {
                        console.error('Error:', error);
                    });
            });

            closeModalBtn.addEventListener('click', function() {
                $('#changePasswordModal').modal('hide');
            });
        });
    </script>
    <script>
        const brandInputs = document.querySelectorAll('.brand-input');

        brandInputs.forEach(function(input) {
            const charCountSpan = input.parentElement.querySelector('.brand-char-count');

            input.addEventListener('input', function() {
                const currentLength = this.value.length;
                charCountSpan.textContent = currentLength;
            });
        });

        document.getElementById('generateButton').addEventListener('click', function() {
            var button = document.getElementById('generateButton');
            var overlay = document.getElementById('overlay');
            var loader = document.getElementById('loader');


            overlay.style.display = 'block';
            loader.style.display = 'block';

            setTimeout(function() {
                button.disabled = false;

                overlay.style.display = 'none';
                loader.style.display = 'none';
                console.log('Button clicked and operation completed.');
            }, 50000);
        });
    </script>

</body>



</html>