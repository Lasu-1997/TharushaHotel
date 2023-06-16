@php use Carbon\Carbon; @endphp
@extends('systemcore::layouts.master')

@section('content')
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Update blog post - {{$blog_post->title}}</h4>
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
                <form class="forms-sample mt-5" method="POST" action="{{asset("/admin-blog/$blog_post->id/update")}}"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Title :</label>
                        <div class="col-sm-9">
                            <input type="text" name="title" class="form-control"
                                   value="{{$blog_post->title}}"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Image :</label>
                        <div class="col-sm-9">
                            <input type="file" name="images[]" class="form-control"/>
                            <div class="row mt-2">
                                @if($blog_post->images->count() > 0)
                                    @foreach($blog_post->images as $image)
                                        <div class="col-md-3">
                                            <img width="60%" src="{{asset($image->path)}}"
                                                 class="img-fluid">
                                            <a href="{{asset("$image->id/delete_image")}}"
                                               class="btn btn-danger btn-circle btn-sm">
                                                <i class="mdi mdi-trash-can mr-0"></i>
                                            </a></img>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="col-md-12">
                                        <h5>No images found</h5>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Description :</label>
                                <div class="col-sm-9">
                                    <textarea type="date" name="description" class="form-control">
                                        {{$blog_post->description}}
                                    </textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="float-md-right">
                        <button type="submit" class="btn btn-primary mr-2">Update Post</button>
                        <a href="{{asset("/admin-blog/$blog_post->id/toggle_publish")}}" class="btn btn-success mr-2">
                            @if($blog_post->is_published)
                                Unpublish
                            @else
                                Publish
                            @endif
                        </a>
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
