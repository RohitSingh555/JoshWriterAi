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

    <p style="color: white; text-align: center;">Hi {{ Auth::user()->name }}, Welcome to our Magicana AI</p>

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

                                <h5 class="card-title"><i class="fas fa-solid fa-video"></i> <span class="highlight-text">UGC Video </span></h5>

                            </a>

                            @else

                            <a href="{{ route('CreatePost', 'ugc-video') }}" style="text-decoration: none; color:black;">

                                <h5 class="card-title"><i class="fas fa-solid fa-video"></i> <span class="highlight-text">UGC Video Creation</span></h5>

                            </a>

                            @endif

                            @if ($name == 'competitor-ad-ideas-and-concepts')

                            <a href="{{ route('CreatePost', 'competitor-ad-ideas-and-concepts') }}" style="text-decoration: none; color:#23D4C4;">

                                <h5 class="card-title"><i class="fas fa-solid fa-lightbulb"></i> <span class="highlight-text">Ad Ideas & Concepts Creation</span></h5>

                            </a>

                            @else

                            <a href="{{ route('CreatePost', 'competitor-ad-ideas-and-concepts') }}" style="text-decoration: none; color:black;">

                                <h5 class="card-title"><i class="fas fa-solid fa-lightbulb"></i><span class="highlight-text">Ad Ideas & Concepts Creation</span></h5>

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

                            <h6 class="card-subtitle mb-2 text-muted" style="text-align: center">(WITH IMAGES)

                            </h6>

                            @endif

                            @if ($name == 'email-copy-creation')

                            <h5 class="card-title" style="text-align: center">Email Copy Creation</h5>

                            @endif
                            @if ($name == 'competitor-ad-ideas-and-concepts')

                            <h5 class="card-title" style="text-align: center">Ad Ideas & Concepts Creation</h5>

                            @endif
                            @if ($name == 'ugc-video')

                            <h5 class="card-title" style="text-align: center">UGC Video Creation</h5>

                            @endif



                            <div class="container">

                                <hr>

                                @foreach ($results as $key => $value)

                                <div class="row">

                                    <div class="col-lg-12" style="margin-top: 20px;">

                                        <div class="row">

                                            <div class="col-7">

                                                <label style="font-weight: 600">Variation Copy

                                                    {{ $key + 1 }}</label>

                                            </div>

                                            <div class="col-5" style="text-align: end;">

                                                <button class="btn btn-primary copy-button" data-copy-text="{{ isset($value['choices'][0]['text']) ? $value['choices'][0]['text'] : $value['choices'][0]['message']['content'] }}" style="padding: 3px 6px; background: #151B3B;"><i class="fas fa-copy"></i></button>

                                                <div class="copy-message" style="display: none;padding: 4px 6px;">

                                                    <i class="fas fa-check"></i> Copied to clipboard

                                                </div>

                                            </div>

                                        </div>

                                        <div id="desc_brand_text" contenteditable="true" class="form-control" style="margin-top: 20px; border-radius: 15px; overflow-y: auto; min-height: 400px; max-height: 500px;">
                                            @if (isset($value['choices'][0]['text']))
                                            {!! nl2br(e($value['choices'][0]['text'])) !!}
                                            @else
                                            {!! nl2br(e($value['choices'][0]['message']['content'])) !!}
                                            @endif
                                        </div>



                                    </div>

                                </div>

                                @endforeach

                            </div>

                        </div>

                    </div>

                </div>

            </div>

    </section>

    <script>
        const copyButtons = document.querySelectorAll('.copy-button');



        copyButtons.forEach(button => {

            button.addEventListener('click', function() {

                const copyText = button.getAttribute('data-copy-text');

                const copyMessage = button

                    .nextElementSibling; // The adjacent div for displaying the message



                // Create a temporary textarea to preserve formatting

                const tempTextarea = document.createElement('textarea');

                tempTextarea.value = copyText;

                document.body.appendChild(tempTextarea);

                tempTextarea.select();

                document.execCommand('copy');

                document.body.removeChild(tempTextarea);



                button.style.display = 'none'; // Hide the button

                copyMessage.style.display = 'inline-block'; // Show the message



                setTimeout(() => {

                    button.style.display = 'inline-block'; // Show the button after 2 seconds

                    copyMessage.style.display = 'none'; // Hide the message after 2 seconds

                }, 2000); // 2000 milliseconds (2 seconds)

            });

        });
    </script>



    <script>
        $(document).ready(function() {

            // Add click event listener to each card title

            $(".card-title").click(function() {

                // Remove the "highlighted" class from all card titles

                $(".highlight-text").removeClass("highlighted");

                // Add the "highlighted" class to the text within the clicked card title

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
        function convertToClickableLinks(divId) {
            var div = document.getElementById(divId);
            var text = div.innerHTML;

            // Regular expression to identify URLs
            var urlRegex = /(https?:\/\/[^\s]+)/g;

            // Replace URLs with anchor tags
            var replacedText = text.replace(urlRegex, function(url) {
                return '<a href="' + url + '" target="_blank">' + url + '</a>';
            });

            // Update the content of the div with clickable links
            div.innerHTML = replacedText;
        }

        // Call the function to convert URLs to clickable links
        convertToClickableLinks('desc_brand_text');
    </script>

</body>



</html>