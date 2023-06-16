@php use Carbon\Carbon; @endphp
@extends('systemcore::layouts.master')

@section('content')
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">{{$room_category->name}} Images</h4>
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
                <div class="row">
                    @if($room_category->images->count() > 0)
                        @foreach($room_category->images as $image)
                            <div class="col-md-3">
                                <img width="60%" src="{{asset($image->path)}}"
                                     class="img-fluid">
                                <a href="{{asset('/room_category/'.$image->id.'/delete_image')}}"
                                   class="btn btn-danger btn-circle btn-sm">
                                    <i class="mdi mdi-trash-can mr-0"></i>
                                </a></img>
                            </div>
                        @endforeach
                    @else
                        <div class="col-md-12">
                            <h4>No images found</h4>
                        </div>
                    @endif
                </div>
                <form class="forms-sample mt-5" method="POST" action="{{asset("/room_category/$room_category->slug/update_images")}}"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <div class="col-sm-9">
                            <input type="file" min="0" name="images[]" class="form-control" multiple/>
                        </div>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary mr-2">Update Images</button>
                        <a onclick="redirectBack()" class="btn btn-dark">Back</a>
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
