@php use Carbon\Carbon; @endphp
@extends('systemcore::layouts.master')

@section('content')
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Create new room category</h4>
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
                <form class="forms-sample mt-5" method="POST" action="{{asset('/room_category/store')}}"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Room category :</label>
                        <div class="col-sm-9">
                            <input type="text" name="name" class="form-control"
                                   placeholder="Room Category (EX:Stranded Deluxe)"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Num of rooms :</label>
                        <div class="col-sm-9">
                            <input type="number" name="no_of_rooms" class="form-control"
                                   placeholder="Number of rooms in this category"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Num of adults :</label>
                        <div class="col-sm-9">
                            <input type="number" name="no_of_adults" class="form-control"
                                   placeholder="Number of adults per room"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Num of children :</label>
                        <div class="col-sm-9">
                            <input type="number" name="no_of_children" class="form-control"
                                   placeholder="Number of children per room"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Charge per day :</label>
                        <div class="col-sm-9">
                            <input type="number" min="0" name="charge_per_day" class="form-control"
                                   placeholder="Charge per day"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Description :</label>
                                <div class="col-sm-9">
                                    <textarea type="date" name="description" class="form-control"
                                              placeholder="Description"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary mr-2">Add Category</button>
                        <a href="" class="btn btn-dark">Decline</a>
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
    </script>
@endsection
