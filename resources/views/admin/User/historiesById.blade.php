@extends('admin.layout')
@section('title')
    Admin | Histories
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
                <div class="row" style="justify-content: center">
                    <div class="col-8">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Histories DataTable</h3>
                            </div>
                            <div class="card-body">
                                <div class="card" style="margin-bottom: 60px;">
                                    <div class="card-body">
                                        @foreach ($results as $key => $value)
                                            <div class="row">
                                                <div class="col-lg-12" style="margin-top: 20px;">
                                                    <div class="row">
                                                        <div class="col-7">
                                                            <label style="font-weight: 600">Variation Copy
                                                                {{ $key + 1 }}</label>
                                                        </div>
                                                        <div class="col-5" style="text-align: end;">
                                                            <button class="btn btn-primary copy-button"
                                                                data-copy-text="{{ $value['choices'][0]['text'] }}"
                                                                style="padding: 3px 6px; background: #151B3B;"><i
                                                                    class="fas fa-copy"></i></button>
                                                            <div class="copy-message"
                                                                style="display: none;padding: 4px 6px;">
                                                                <i class="fas fa-check"></i> Copied to clipboard
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <textarea id="desc_brand_{{ $key }}" name="desc_brand" cols="30" rows="13" class="form-control"
                                                        style="margin-top: 20px; border-radius: 15px;" readonly>{{ $value['choices'][0]['text'] }}</textarea>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
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
@endsection
