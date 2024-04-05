@extends('admin.layout')

@section('title')

    Admin | All Users

@endsection

@section('extra-heads')

    <link rel="stylesheet" href="{{ asset('admin') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">

    <link rel="stylesheet" href="{{ asset('admin') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">

    <link rel="stylesheet" href="{{ asset('admin') }}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <style>
        .toggle-student-checkbox{
            width: 2.5rem;
    height: 1.5rem;
    align-items: center;
        }
    </style>
@endsection

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <div class="container-fluid">

                <div class="row mb-2">

                    <div class="col-sm-6">

                        <h1>Users DataTables</h1>

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

                                <h3 class="card-title">All Users DataTable</h3>

                                <div class="card-body" style="text-align: end;">
                                <div class="d-flex align-items-center justify-content-end ">
    <div class="custom-file mr-2 w-25">
        <input type="file" class="custom-file-input" id="customFile" name="file" accept=".csv">
        <label class="custom-file-label text-left" for="customFile">Choose file</label>
    </div>

    <button type="submit" class="btn btn-primary ">Upload CSV</button>
    
    <button type="button" class="btn btn-primary ml-2" data-toggle="modal" data-target="#modal-default">
        Add New User
    </button>
</div>



                                </div>

                            </div>

                            <div class="card-body">

                                <table id="example1" class="table table-bordered table-striped">

                                    <thead>

                                        <tr>

                                            <th class="text-center">Id</th>

                                            <th class="text-center">Name</th>

                                            <th class="text-center">Email</th>

                                            <th class="text-center">Token Used</th>

                                            @if (Auth::user()->role == 'Admin')

                                                <th class="text-center">Available Token</th>

                                            @endif

                                            <th class="text-center">Last Login</th>

                                            <th class="text-center">Histories</th>

                                            <th class="text-center">Role</th>

                                            @if (Auth::user()->role == 'Admin')

                                                <th class="text-center">Action</th>

                                            @endif
                                            @if (Auth::user()->role == 'Admin')

                                                <th class="text-center">Is a Student</th>

                                            @endif

                                        </tr>

                                    </thead>

                                    @php

                                        $i = 1;

                                    @endphp

                                    <tbody>

                                        @foreach ($User as $User)

                                            <tr>

                                                <td class="text-center">{{ $i++ }}</td>

                                                <td class="text-center">{{ $User->name }}</td>

                                                <td class="text-center">{{ $User->email }}</td>

                                                <td class="text-center">{{ $User->used_tokens }}</td>

                                                @if ($User->role == 'Manager')

                                                    <td class="text-center">No updates</td>

                                                @else

                                                    @if (Auth::user()->role == 'Admin')

                                                        <td class="text-center">

                                                            <form action="{{ route('users.updateToken', $User->id) }}"

                                                                method="POST">

                                                                @csrf

                                                                <input type="number" name="lastTokens" id=""

                                                                    value="{{ $User->lastTokens }}">

                                                                <button class="btn btn-success">Update</button>

                                                            </form>

                                                        </td>

                                                    @endif

                                                @endif

                                                <td class="text-center">

                                                    {{ \Carbon\Carbon::parse($User->last_login)->diffForHumans() }}</td>

                                                @if ($User->role == 'Manager')

                                                    <td class="text-center">No updates</td>

                                                @else

                                                    <td class="text-center"><a

                                                            href="{{ route('users.histories', $User->id) }}">View</a></td>

                                                @endif

                                                <td class="text-center">{{ $User->role }}</td>

                                                @if (Auth::user()->role == 'Admin')

                                                    <td class="text-center">

                                                        <form method="POST"

                                                            action="{{ route('users.delete', $User->id) }}">

                                                            @csrf

                                                            <input name="_method" type="hidden" value="DELETE">

                                                            <button type="submit" class="btn btn-danger show_confirm"

                                                                data-toggle="tooltip" title='Delete'>Delete</button>

                                                        </form>

                                                    </td>
                                                    <td class="text-center">
                <input type="checkbox" class="toggle-student-checkbox" data-user-id="{{ $User->id }}" {{ $User->is_user_student=="true" ? 'checked' : '' }}>
            </td>

                                                @endif

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

    <div class="modal fade" id="modal-default">

        <div class="modal-dialog">

            <div class="modal-content">

                <div class="modal-header">

                    <h4 class="modal-title">New User</h4>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                        <span aria-hidden="true">&times;</span>

                    </button>

                </div>

                <div class="modal-body">

                    <form action="{{ route('users.store') }}" enctype="multipart/form-data" method="POST">

                        @csrf

                        <label for="name">Name</label>

                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name"

                            required>

                        <label for="name">Email</label>

                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email"

                            required>

                        <label for="name">Password</label>

                        <input type="password" class="form-control" id="password" name="password"

                            placeholder="Enter Password" required>

                        <label for="name">Role</label>

                        @if (Auth::user()->role == 'Admin')

                            <select name="role" id="" class="form-control" required>

                                <option value="">Select</option>

                                <option value="User">User</option>

                                <option value="Manager">Manager</option>

                            </select>

                        @else

                            <select name="role" id="" class="form-control" required>

                                <option value="">Select</option>

                                <option value="User" selected>User</option>

                            </select>

                        @endif

                        <div class="div" style="margin-top: 20px; ">

                            <button type="submit" class="btn btn-primary form-control">Save</button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

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
$(document).ready(function() {
    $('.toggle-student-checkbox').change(function() {
        var userId = $(this).data('user-id');
        var isChecked = $(this).is(':checked');
        var url = '{{ route("toggle.student") }}';

        $.ajax({
            url: url,
            type: 'POST',
            data: {
                userId: userId,
                isChecked: isChecked,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                swal({
                    title: "Success!",
                    text: "Student status toggled.",
                    icon: "success",
                    timer: 2000, 
                    showConfirmButton: false 
                });
                console.log(response);
            },
            error: function(xhr, status, error) {
                swal({
                    title: "Error",
                    text: "Toggle failed. Please try again later.",
                    icon: "error",
                    timer: 2000, 
                    showConfirmButton: false 
                });
                console.error(xhr.responseText);
            }
        });
    });
});


</script>


@endsection

