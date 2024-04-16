<!-- resources/views/prompts/create.blade.php -->

@extends('admin.layout')

@section('title', 'Create Prompt')

@section('content')

<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid  mt-5">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h1 class=" fw-bold">Create Prompt</h1>
                        </div>

                        <div class="card-body">
                            <form action="{{ route('prompts.prompt_store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="prompt_type">Prompt Type</label>
                                    <input type="text" class="form-control" id="prompt_type" name="prompt_type" required>
                                </div>
                                <div class="form-group">
                                    <label for="request">Prompt Text</label>
                                    <textarea class="form-control" id="request" name="request" rows="10" required></textarea>
                                </div>
                                <!-- Add more input fields as needed -->

                                <div class="text-center">
                                    <button type="button" class="btn btn-secondary" onclick="window.history.back();">
                                        <i class="fas fa-arrow-left mr-1"></i> Go Back
                                    </button>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-plus-circle mr-1"></i> Create
                                    </button>
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