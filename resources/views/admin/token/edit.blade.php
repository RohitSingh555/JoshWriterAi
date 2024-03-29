@extends('admin.layout')
@section('title')
Admin | Edit ChatGPT Token
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
                    <h1>Edit ChatGPT Token</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Edit GPT Token</li>
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
                            <h3 class="card-title">Chat GPT Token</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('token.postEdit') }}" enctype="multipart/form-data" method="POST">
                                @csrf
                                <label for="token">Edit ChatGPT Token</label>
                                <input type="text" class="form-control" id="token" value="{{ $data->token }}" name="token" >
                                <label for="default_tokens" title="Default tokens used to save the tokens for all the users.">Default Tokens</label>
                                <input type="text" class="form-control" id="default_tokens" value="{{ $data->default_tokens }}" name="default_tokens" >
                                <label for="prompt_tokens" title="Prompt tokens are the tokens which is used to generate response from the api.">Output Tokens</label>
                                <input type="text" class="form-control" id="prompt_tokens" value="{{ $data->prompt_tokens }}" name="prompt_tokens" >

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
