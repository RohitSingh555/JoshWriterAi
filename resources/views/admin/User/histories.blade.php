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
                        <h1>Histories DataTables</h1>
                    </div>
                </div>
            </div>
        </section>
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
                                                        href="{{ route('users.historyById', $history->id) }}">View</a>
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
@endsection
