@extends('admin.layout')
@section('title')
Admin | Edit Offered Programs
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
                    <h1>Edit Offered Programs</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Edit Offered Programs</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row" style="justify-content: center;">
                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">All Offered Programs</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('offered.postEdit') }}" enctype="multipart/form-data" method="POST">
                                @csrf
                                <input type="text" name="id" value="{{ $id }}" hidden>
                                <label for="name">Edit Offered Programs name</label>
                                <input type="text" class="form-control" id="name" value="{{ $Programs->name }}" name="name" >
                                <label for="eligibility">Edit Offered Programs Eligibility</label>
                                <input type="text" class="form-control" id="eligibility" value="{{ $Programs->eligibility }}" name="eligibility" >
                                <label for="hours">Edit Offered Programs HOurs</label>
                                <input type="text" class="form-control" id="hours" value="{{ $Programs->hours }}" name="hours" >
                                <label for="duration">Edit Offered Programs Duration</label>
                                <input type="text" class="form-control" id="duration" value="{{ $Programs->duration }}" name="duration" >
                                <div class="div" style="margin-top: 20px; ">
                                    <button type="submit" class="btn btn-primary form-control">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
{{-- $table->string('eligibility')->nullable();
                        $table->string('hours')->nullable();
                        $table->string('duration')->nullable(); --}}
