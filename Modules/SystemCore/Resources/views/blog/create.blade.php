@php use Carbon\Carbon; @endphp
@extends('systemcore::layouts.master')

@section('content')
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Create new blog post</h4>
                @if ($errors->any())
                    <div class="alert alert-danger mt-3">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (session('success'))
                    <div class="alert alert-success mt-3">
                        {{ session('success') }}
                    </div>
                @endif
                <form class="forms-sample mt-5" method="POST" action="{{asset('/admin-blog/store')}}"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Title :</label>
                        <div class="col-sm-9">
                            <input type="text" name="title" class="form-control"
                                   placeholder="Here about tourism.."/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Image :</label>
                        <div class="col-sm-9">
                            <input type="file" name="images[]" class="form-control"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Description :</label>
                                <div class="col-sm-9">
                                    <textarea type="date" name="description" class="form-control"
                                              placeholder="The limit is sky..."></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Publish</label>
                        <div class="col-sm-4">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" name="is_published" id="is_published"> Publish </label>
                            </div>
                        </div>
                    </div>
                    <div class="float-md-right">
                        <button type="submit" class="btn btn-primary mr-2">Create Post</button>
                        <a href="" onclick="redirectBack()" class="btn btn-dark">Decline</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        tinymce.init({
            selector: 'textarea',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
        });

        function redirectBack() {
            window.history.back();
        }
    </script>
@endsection
