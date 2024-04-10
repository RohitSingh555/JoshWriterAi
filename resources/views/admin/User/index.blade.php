@extends('admin.layout')

@section('title')

Admin | All Users

@endsection

@section('extra-heads')

<link rel="stylesheet" href="{{ asset('admin') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">

<link rel="stylesheet" href="{{ asset('admin') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">

<link rel="stylesheet" href="{{ asset('admin') }}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
<style>
    .toggle-student-checkbox {
        width: 2.5rem;
        height: 1.5rem;
        align-items: center;
    }

    #uploadingOverlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(255, 255, 255, 0.5);
        z-index: 9999;
    }

    #uploadingSpinner {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .custom-input {
        height: 30px;
        padding: 0 5px;
        font-size: 15px;
    }

    table.table-bordered.dataTable tbody th,
    table.table-bordered.dataTable tbody td {

        vertical-align: middle;
    }

    .custom-button {
        height: 30px;
        padding: 0 10px;
        font-weight: 500;
        font-size: 15px;
    }

    .custom-button i {
        font-size: 12px !important;
    }

    .modal-body {
        padding: 20px;
    }

    .modal-body .form-label {
        font-weight: bold;
    }

    .modal-body .form-control {
        border-radius: 0;
    }

    .modal-body .btn-primary {
        border-radius: 0;
    }

    .modal-body select {
        border-radius: 0;
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

                            <div class="card-body p-0" style="text-align: end;">
                                <div class="d-flex align-items-center justify-content-end ">
                                    <form action="{{ route('upload.csv') }}" method="post" enctype="multipart/form-data" class="my-4" id="uploadForm">
                                        @csrf
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input text-left" id="customFile" name="file" accept=".csv">
                                                <label class="custom-file-label text-left" for="customFile">Choose CSV file</label>
                                            </div>
                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-primary" id="uploadButton">Upload</button>
                                            </div>
                                        </div>
                                    </form>


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

                                        <td class="text-center align-middle p-3">
                                            <form action="{{ route('users.updateToken', $User->id) }}" method="POST" class="d-flex align-items-center justify-content-center">
                                                @csrf
                                                <div class="input-group">
                                                    <input type="number" name="lastTokens" class="form-control mr-2 custom-input" value="{{ $User->lastTokens }}">
                                                    <button class="btn btn-success ms-4 custom-button"><i class="fas fa-edit mr-2"></i>Update</button>
                                                </div>
                                            </form>
                                        </td>

                                        @endif

                                        @endif

                                        <td class="text-center">

                                            {{ \Carbon\Carbon::parse($User->last_login)->diffForHumans() }}
                                        </td>

                                        @if ($User->role == 'Manager')

                                        <td class="text-center">No updates</td>

                                        @else

                                        <td class="text-center">
                                            <a href="{{ route('users.histories', $User->id) }}" class="btn btn-info custom-button d-flex align-items-center justify-content-center 3">
                                                <i class="fas fa-eye mr-2"></i> View
                                            </a>
                                        </td>


                                        @endif

                                        <td class="text-center">{{ $User->role }}</td>

                                        @if (Auth::user()->role == 'Admin')

                                        <td class="text-center">

                                            <form method="POST" action="{{ route('users.delete', $User->id) }}">

                                                @csrf

                                                <input name="_method" type="hidden" value="DELETE">

                                                <button type="submit" class="btn btn-danger show_confirm custom-button" data-toggle="tooltip" title='Delete'><i class="fas fa-trash-alt mr-2"></i> Delete</button>

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
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" required>
                    </div>
                    <div class="mb-3">
                        <label for="role" class="form-label">Role</label>
                        <select name="role" id="role" class="form-control" required>
                            <option value="">Select</option>
                            @if (Auth::user()->role == 'Admin')
                            <option value="User">User</option>
                            <option value="Manager">Manager</option>
                            @else
                            <option value="User" selected>User</option>
                            @endif
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="is_user_student" class="form-label">Is a Student?</label>
                        <select name="is_user_student" id="is_user_student" class="form-control" required>
                            <option value="">Select</option>
                            @if (Auth::user()->role == 'Admin')
                            <option value="true">True</option>
                            <option value="false">False</option>
                            @endif
                        </select>
                    </div>
                    <div class="mb-3">
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
<script>
    document.getElementById('uploadForm').addEventListener('submit', function() {
        document.getElementById('uploadingOverlay').style.display = 'block';
    });

    document.getElementById('customFile').addEventListener('change', function() {
        var fileName = this.files[0].name;
        var label = document.querySelector('.custom-file-label');
        label.innerHTML = fileName;
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const passwordFields = document.querySelectorAll('input[type="password"]');

        passwordFields.forEach((field) => {
            const icon = document.createElement("span");
            icon.classList.add("password-toggle", "far", "fa-eye");
            icon.style.position = "absolute";
            icon.style.right = "31px";
            icon.style.top = "46.5%";
            icon.style.transform = "translateY(-50%)";
            icon.style.cursor = "pointer";
            const wrapper = document.createElement("div");
            wrapper.classList.add("password-wrapper");
            field.parentNode.insertBefore(wrapper, field);
            wrapper.appendChild(field);
            wrapper.appendChild(icon);

            icon.addEventListener("click", () => {
                if (field.type === "password") {
                    field.type = "text";
                    icon.classList.remove("fa-eye");
                    icon.classList.add("fa-eye-slash");
                } else {
                    field.type = "password";
                    icon.classList.remove("fa-eye-slash");
                    icon.classList.add("fa-eye");
                }
            });
        });
    });
</script>
@endsection