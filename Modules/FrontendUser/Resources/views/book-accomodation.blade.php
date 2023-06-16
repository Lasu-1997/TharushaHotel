@extends('frontenduser::layouts.master')

@section('content')
    <!--================Breadcrumb Area =================-->
    <section class="breadcrumb_area blog_banner_two">
        <div class="overlay bg-parallax" data-stellar-ratio="0.8" data-stellar-vertical-offset="0"
             data-background=""></div>
        <div class="container">
            <div class="page-cover text-center">
                <h2 class="page-cover-tittle f_48">Book {{$accomodation->name}}</h2>
            </div>
        </div>
    </section>
    <!--================Breadcrumb Area =================-->

    <!--================blog Area =================-->
    <section class="blog_area single-post-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 posts-list">
                    <div class="single-post row">
                        <div class="col-lg-12">
                            <div class="feature-img">
                                @foreach($accomodation->images as $image)
                                    <img class="img-fluid" src="{{asset($image->path)}}" alt="">
                                @endforeach
                            </div>
                        </div>
                        <div class="col-lg-3  col-md-3">
                            <div class="blog_info text-right">
                                <ul class="blog_meta list_style">
                                    @foreach($accomodation->roomCategoryFeatures as $feature)
                                        <li><a href="#">{{$feature->feature}}<i class="{{$feature->icon_keyword}}"></i></a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-9 blog_details">
                            <h2>{{$accomodation->name}}</h2>
                            <p>{{number_format($accomodation->charge_per_day,2)}}LKR/NIGHT</p>
                            <p class="excert">
                                {!! $accomodation->description !!}
                            </p>
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Place booking</h4>
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    @if (session('success'))
                                        <div class="alert alert-success">
                                            {{ session('success') }}
                                        </div>
                                    @endif
                                    <form class="form-sample" method="POST" action="{{asset('/accomodation/'.$accomodation->slug.'/book-accomodation')}}">
                                        @csrf
                                        <p class="card-description">Personal Information </p>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Name</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" name="guest_name" placeholder="Name"
                                                               required/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">ID Type</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control" name="id_type">
                                                            <option>Passport</option>
                                                            <option>NIC</option>
                                                            <option>Driving Licence</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">ID Number</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="id_number" placeholder="ID number" class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <p class="card-description"> Contact Info </p>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Phone</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="guest_phone" class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Email</label>
                                                    <div class="col-sm-9">
                                                        <input type="email" name="guest_email" class="form-control"
                                                               placeholder="Guest email"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <p class="card-description"> Booking Info </p>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Check In</label>
                                                    <div class="col-sm-9">
                                                        <input type="date" name="check_in" class="form-control" placeholder="dd/mm/yyyy"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Check Out</label>
                                                    <div class="col-sm-9">
                                                        <input type="date" name="check_out" class="form-control" placeholder="dd/mm/yyyy"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">No of Rooms</label>
                                                    <div class="col-sm-9">
                                                        <input type="number" min="1" name="no_of_rooms" class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">No of Adults</label>
                                                    <div class="col-sm-9">
                                                        <input type="number" name="no_of_adults" min="1" class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">No of Children</label>
                                                    <div class="col-sm-9">
                                                        <input type="number" min="0" name="no_of_children" class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary mr-2">Place Booking</button>
                                        <button class="btn btn-dark">Cancel</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================blog Area =================-->
@endsection

