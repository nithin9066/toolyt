@extends('layout.app')

@section('title', 'Home')
@section('headscripts')
<script src="https://cdn.tiny.cloud/1/l4ruu4apnzjdffee1u2db72k3fcdqjcsm3koezv3kavbjmvn/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
@endsection
@section('content')
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Toolyt</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="javascript:void(0)">Template</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="/bulk-email">Bulk Email</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <div class="p-5">
        <h5 class="fw-bold">Add Template</h5>
        @if ($errors->any())
            <div class="alert alert-danger w-100">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="/add-template" method="post">
            @csrf
            <div class="input-group mb-3">
                <div class="w-100">
                    <label for="templatename">Template Name <span class="text-danger">*</span></label>
                    <input type="text" id="templatename" name="templatename" class="form-control"
                        placeholder="Enter Template Name">
                </div>
            </div>
            <div class="input-group mb-3">
                <div class="w-100">
                    <label for="subject">Subject <span class="text-danger">*</span></label>
                    <input type="text" id="subject" name="subject" class="form-control" placeholder="Enter Subject">
                </div>
            </div>
            <div class="input-group mb-3">
                <div class="w-100">
                    <label for="body">Body <span class="text-danger">*</span></label>
                    <textarea id="body" name="body" class="form-control w-100" placeholder="Enter Body"></textarea>
                </div>
            </div>
            <button class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection

@section('bodyscripts')
<script>
    tinymce.init({
      selector: 'textarea',
      plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
      toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
    });
  </script>
@endsection
