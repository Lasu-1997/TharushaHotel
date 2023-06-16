@php use Carbon\Carbon; @endphp
@extends('systemcore::layouts.master')

@section('content')
    <div class="row col-md-12">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Update Room Category - {{$room_category->name}}</h4>
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
                    <form class="forms-sample mt-5" method="POST"
                          action="{{asset("/room_category/$room_category->slug/update")}}"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Room category :</label>
                            <div class="col-sm-9">
                                <input type="text" value="{{$room_category->name}}" name="name"
                                       class="form-control"
                                       placeholder="Room Category (EX:Stranded Deluxe)"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Num of rooms :</label>
                            <div class="col-sm-9">
                                <input type="number" value="{{$room_category->no_of_rooms}}" name="no_of_rooms"
                                       class="form-control"
                                       placeholder="Number of rooms in this category"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Num of adults :</label>
                            <div class="col-sm-9">
                                <input type="number" value="{{$room_category->no_of_adults}}" name="no_of_adults"
                                       class="form-control"
                                       placeholder="Number of adults per room"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Num of children :</label>
                            <div class="col-sm-9">
                                <input type="number" value="{{$room_category->no_of_children}}" name="no_of_children"
                                       class="form-control"
                                       placeholder="Number of children per room"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Charge per day :</label>
                            <div class="col-sm-9">
                                <input type="number" min="0" value="{{$room_category->charge_per_day}}"
                                       name="charge_per_day" class="form-control"
                                       placeholder="Charge per day"/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Description :</label>
                                    <div class="col-sm-9">
                                    <textarea type="date" name="description" class="form-control"
                                              placeholder="Description">{{$room_category->description}}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary mr-2">Update Category</button>
                            <a href="{{asset("/room_category/$room_category->slug/images")}}"
                               class="btn btn-success mr-2">Update Images</a>
                            <a onclick="redirectBack()" class="btn btn-dark">Decline</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Update Room Features - {{$room_category->name}}</h4>

                    <table class="table">
                        <thead>
                        <tr>
                            <th> Feature</th>
                            <th> Icon</th>
                            <th> Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($room_category->roomCategoryFeatures as $room_category_feature)
                            <tr>
                                <td> {{$room_category_feature->feature}}</td>
                                <td> <i class="{{$room_category_feature->icon_keyword}}"></i></td>
                                <td>
                                    <a href="/room_category/{{$room_category_feature->id}}/delete_feature"
                                       class="btn btn-danger mr-2">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <form class="forms-sample mt-5" method="POST"
                          action="{{asset("/room_category/$room_category->slug/add_feature")}}">
                        @csrf
                        <div class="form-group row">
                            <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Feature :</label>
                            <div class="col-sm-9">
                                <input type="text" min="0" name="feature" class="form-control"
                                       placeholder="Free Wifi"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Icon Keyword :</label>
                            <div class="col-sm-9">
                                <input type="text" min="0" name="icon_keyword" class="form-control"
                                       placeholder="lnr-home"/>
                                <small>Find Icon Keyword from <a href="{{asset('https://linearicons.com/free')}}" target="_blank">https://linearicons.com</a></small>
                            </div>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary mr-2">Add feature</button>
                        </div>
                    </form>
                </div>
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
            window.location.href = "{{asset('/room_category')}}";
        }
    </script>
@endsection
