@extends('layout.app')

@section('title', 'Bulk Email')
@section('headscripts')
    <script src="https://cdn.tiny.cloud/1/l4ruu4apnzjdffee1u2db72k3fcdqjcsm3koezv3kavbjmvn/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>
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
                            <a class="nav-link" aria-current="page" href="home">Template</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="javascript:void(0)">Bulk Email</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <div class="row p-5">
        <div class="col-8">
            <h5 class="fw-bold">Send Bulk Email</h5>
            @if ($errors->any())
                <div class="alert alert-danger w-100">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="/send-mail" method="post">
                @csrf
                <div class="input-group mb-3">
                    <div class="w-100">
                        <label for="templatename">Template Name <span class="text-danger">*</span></label>
                        <select id='template' class="form-select" aria-label="Default select example">
                            <option>Select Template</option>
                            @forelse ($templates as $template)
                                <option data-subject='{{ $template->subject }}' data-body='{{ $template->body }}'
                                    value="{{ $template->id }}">{{ $template->name }}</option>
                            @empty
                                <option selected>No Template Found</option>
                            @endforelse

                        </select>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <div class="w-100">
                        <label for="subject">Subject <span class="text-danger">*</span></label>
                        <input type="text" id="subject" name="subject" class="form-control"
                            placeholder="Enter Subject">
                    </div>
                </div>
                <div class="input-group mb-3">
                    <div class="w-100">
                        <label for="body">Body <span class="text-danger">*</span></label>
                        <textarea id="body" name="body" class="form-control w-100" placeholder="Enter Body"></textarea>
                    </div>
                </div>
                <button class="btn btn-primary">Send Mail</button>
            </form>
        </div>
        <div class="col-4">
            <ul class="list-group" id="subject-variables">
            </ul>
            <ul class="list-group" id="body-variables">
            </ul>
        </div>
    </div>
@endsection

@section('bodyscripts')
    <script>
        tinymce.init({
            selector: 'textarea',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
        });

        $(function() {
            $("#template").change(function() {
                const subject = $('#template option:selected').data('subject');
                const body = $('#template option:selected').data('body');
                $("#subject").val(subject)
                $("#body").val(body)
                tinymce.activeEditor.setContent(body);
                let subjectVariables = subject.match(/[^{}]+(?=})/g);
                let bodyVariables = body.match(/[^{}]+(?=})/g);
                subjectVariables = [...new Set(subjectVariables)];
                bodyVariables = [...new Set(bodyVariables)];
                $("#subject-variables").html()
                $('<h6 class="px-3">Subject Variables</h6>').insertBefore("#subject-variables");
                $("#body-variables").html()
                $('<h6 class="px-3">Body Variables</h6>').insertBefore("#body-variables");

                subjectVariables.forEach(item => {
                    if (item != '$userName') {
                        $("#subject-variables").append(`
                            <li class="list-group-item border-0"><input onchange='setSubjectVariables(this)' class='form-control' type='text' placeholder='{${item}}' name='{${item}}'></li>
                        `)
                    }
                })
                bodyVariables.forEach(item => {
                    if (item != '$userName') {
                        $("#body-variables").append(`
                        <li class="list-group-item border-0"><input onchange='setBodyVariables(this)' class='form-control' type='text' placeholder='{${item}}' name='{${item}}'></li>
                    `)
                    }
                })

            })
        })

        function setBodyVariables(ele) {
            const name = $(ele).attr('name');
            var myContent = tinymce.activeEditor.getContent();
            myContent = myContent.replaceAll(name, ele.value);
            tinymce.activeEditor.setContent(myContent);

        }

        function setSubjectVariables(ele) {
            const name = $(ele).attr('name');
            var myContent = $("#subject").val();
            myContent = myContent.replaceAll(name, ele.value);
            $("#subject").val(myContent);

        }
    </script>
@endsection
