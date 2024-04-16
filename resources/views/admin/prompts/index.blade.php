@extends('admin.layout')

@section('title')
Admin | Prompts
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
                    <h1>All Prompts</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Prompts</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <h3 class="text-center pt-3">Prompts written by Admin</h3>
                        <div class="card-header d-flex justify-content-end align-items-center">
                            <a href="{{ route('prompts.prompt_create') }}" class="btn btn-primary "><i class="fas fa-plus-circle"></i>&nbsp;Create Prompt</a>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="prompts-table" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Prompt Type</th>
                                            <th>Request</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($prompts as $prompt)
                                        <tr>
                                            <td class=" col-1">{{ $prompt->id }}</td>
                                            <td class="col-5">{{ $prompt->prompt_type }}</td>
                                            <td class="">{{ $prompt->request }}</td>
                                            <td>
                                                <div class="d-flex gap-5 ">
                                                    <a href="{{ route('prompts.prompt_edit', $prompt->id) }}" class="btn btn-sm btn-primary mr-5 d-flex align-items-center"><i class="fas fa-edit"></i>&nbsp;Edit</a>
                                                    <form action="{{ route('prompts.prompt_destroy', $prompt->id) }}" method="POST" style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger d-flex align-items-center"><i class="fas fa-trash"></i>&nbsp;Delete</button>
                                                    </form>
                                                </div>
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
        </div>
    </section>
</div>
@endsection