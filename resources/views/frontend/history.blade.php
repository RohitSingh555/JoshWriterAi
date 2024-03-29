<!DOCTYPE html>

<html lang="en">



<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Josh Writer AI | History</title>

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

    <link rel="stylesheet" href="{{ asset('admin') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">

    <link rel="stylesheet" href="{{ asset('admin') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">

    <link rel="stylesheet" href="{{ asset('admin') }}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

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

                    <!--</li>-->

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

                    <section class="content">

                        <div class="container-fluid">

                            <div class="row">

                                <div class="col-12">

                                    <div class="card">

                                        <div class="card-header">

                                            <h3 class="card-title">All Histories DataTable</h3>

                                        </div>

                                        <div class="card-body">

                                            <table id="example1" class="table table-bordered table-striped">

                                                <thead>

                                                    <tr>

                                                        <th class="text-center">Id</th>

                                                        <th class="text-center">Type</th>

                                                        <th class="text-center">Brand Name</th>

                                                        <th class="text-center">Description</th>

                                                        <th class="text-center">Bullet Points</th>

                                                        <th class="text-center">Promotion Type</th>

                                                        <th class="text-center">Date</th>

                                                        <th class="text-center">Language</th>

                                                        <th class="text-center">View</th>



                                                    </tr>

                                                </thead>

                                                @php

                                                    $i = 1;

                                                @endphp

                                                <tbody>

                                                    @foreach ($history as $history)

                                                        <tr>

                                                            <td class="text-center">{{ $i++ }}</td>

                                                            <td class="text-center">{{ $history->prompt['type'] }}

                                                            </td>

                                                            <td class="text-center">{{ $history->prompt['brand'] }}

                                                            </td>

                                                            <td class="text-center">

                                                                {{ $history->prompt['desc_brand'] }}</td>

                                                            <td class="text-center">

                                                                {{ $history->prompt['better_brand'] }}</td>

                                                            <td class="text-center">

                                                                {{ isset($history->prompt['date_type']) ? $history->prompt['date_type'] : 'null' }}

                                                            </td>

                                                            <td class="text-center">

                                                                {{ isset($history->prompt['end_date']) ? $history->prompt['end_date'] : 'null' }}

                                                            </td>

                                                            <td class="text-center">{{ $history->prompt['lang'] }}

                                                            </td>

                                                            <td class="text-center"><a

                                                                    href="{{ route('historyByID', $history->id) }}">View</a>

                                                            </td>

                                                        </tr>

                                                    @endforeach

                                                </tbody>

                                            </table>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </section>

                </div>

            </div>

        </div>

    </section>

    <script src="{{ asset('admin') }}/plugins/datatables/jquery.dataTables.min.js"></script>

    <script src="{{ asset('admin') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>

    <script src="{{ asset('admin') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>

    <script src="{{ asset('admin') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

    <script src="{{ asset('admin') }}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>

    <script src="{{ asset('admin') }}/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>

    <script src="{{ asset('admin') }}/plugins/datatables-buttons/js/buttons.html5.min.js"></script>

    <script src="{{ asset('admin') }}/plugins/datatables-buttons/js/buttons.print.min.js"></script>

    <script src="{{ asset('admin') }}/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

    <script>

        $(function() {

            $("#example1").DataTable({

                "responsive": true,

                "lengthChange": false,

                "autoWidth": false,

                "buttons": ["copy", "csv", "excel", "pdf", "print"]

            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

            $('#example2').DataTable({

                "paging": true,

                "lengthChange": false,

                "searching": false,

                "ordering": true,

                "info": true,

                "autoWidth": false,

                "responsive": true,

            });

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

</body>



</html>

