@extends('admin.layout')

@section('title')

Admin | All Histories

@endsection

@section('extra-heads')

<link rel="stylesheet" href="{{ asset('admin') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">

<link rel="stylesheet" href="{{ asset('admin') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">

<link rel="stylesheet" href="{{ asset('admin') }}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

@endsection

@section('content')

<div class="content-wrapper">

    <section class="content-header">

        <div class="container-fluid">

            <div class="row mb-2">

                <div class="col-sm-6">

                    <h1>All Histories DataTable</h1>

                </div>

            </div>

        </div>

    </section>

    <section class="content">

        <div class="container-fluid">

            <div class="row">

                <div class="col-12">

                    <div class="card">

                        <div class="card-body">

                            <table id="example1" class="table table-bordered table-striped">

                                <div class="d-flex justify-content-between py-3">
                                    <h3 class="card-title pr-3 text-left fw-bold ">User Table</h3>
                                    <div class="justify-content-end">
                                        <h3 class="card-title pr-3">Search by User:</h3>
                                        <select id="userFilter">
                                            <option value="">Select User</option>
                                            @foreach ($userEmails as $email)
                                            <option value="{{ $email }}">{{ $email }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <thead>

                                    <tr>

                                        <th class="text-center">Id</th>

                                        <!-- <th class="text-center">Type</th> -->

                                        <th class="text-center">Brand Name</th>

                                        <th class="text-center">Description</th>

                                        <th class="text-center">Bullet Points</th>

                                        <th class="text-center">Date</th>

                                        <th class="text-center">Language</th>

                                        <th class="text-center">View</th>

                                        <th class="text-center">User</th>



                                    </tr>

                                </thead>

                                @php

                                $i = 1;

                                @endphp

                                <tbody>

                                    @foreach ($histories as $history)

                                    <tr data-email=" @if (isset($history->prompt['email'])){{ $history->user->email }}@endif">

                                        <td class=" text-center">{{ $i++ }}</td>

                                        <!-- <td class="text-center">
                                            @if (isset($history->prompt['type']))
                                            {{ $history->prompt['type'] }}
                                            @endif
                                        </td> -->

                                        <td class="text-center">{{ $history->prompt['brand'] }}

                                        </td>

                                        <td class="text-center">
                                            @if (isset($history->prompt['desc_brand']))
                                            {{ $history->prompt['desc_brand'] }}
                                            @endif
                                        </td>

                                        <td class="text-center">

                                            @if (isset($history->prompt['better_brand']))
                                            {{ $history->prompt['better_brand'] }}
                                            @endif
                                        </td>


                                        <td class="text-center">
                                            {{ \Carbon\Carbon::parse($history->created_at)->diffForHumans() }}

                                            <!-- {{ isset($history->created_at) ? $history->created_at : 'null' }} -->

                                        </td>

                                        <td class="text-center">{{ $history->prompt['lang'] }}

                                        </td>

                                        <td class="text-center"><a href="{{ route('users.historyById', $history->id) }}">View</a>

                                        </td>
                                        <td class="text-center">
                                            <p>@if (isset($history->prompt['email'])){{ $history->user->email }}@endif</p>
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

@endsection

@section('extra-scripts')

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

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>

<script type="text/javascript">
    $('.show_confirm').click(function(event) {

        var form = $(this).closest("form");

        var name = $(this).data("name");

        event.preventDefault();

        swal({

                title: `Are you sure you want to delete this record?`,

                text: "If you delete this, it will be gone forever.",

                icon: "warning",

                buttons: true,

                dangerMode: true,

            })

            .then((willDelete) => {

                if (willDelete) {

                    form.submit();

                }

            });

    });
</script>
<script>
    document.getElementById('userFilter').addEventListener('change', function() {
        const selectedEmail = this.value;
        const historyRows = document.querySelectorAll('#example1 tbody tr');

        // Loop through each history row and show/hide based on the selected user email
        historyRows.forEach(row => {
            const rowEmail = row.getAttribute('data-email');
            if (!selectedEmail || rowEmail === selectedEmail) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
</script>


@endsection