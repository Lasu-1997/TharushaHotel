@extends('frontenduser::layouts.master')

@section('content')
    <!--================Breadcrumb Area =================-->
    <section class="breadcrumb_area">
        <div class="overlay bg-parallax" data-stellar-ratio="0.8" data-stellar-vertical-offset="0"
             data-background=""></div>
        <div class="container">
            <div class="page-cover text-center">
                <h2 class="page-cover-tittle">Accomodation</h2>
                <ol class="breadcrumb">
                    <li><a href="index.html">Home</a></li>
                    <li class="active">Accomodation</li>
                </ol>
            </div>
        </div>
    </section>
    <!--================Breadcrumb Area =================-->

    <!--================Booking Tabel Area =================-->
    <section class="hotel_booking_area mt-5">
        <div class="container">
            <div class="hotel_booking_table">
                <div class="col-md-3">
                    <h2>Book<br> Your Room</h2>
                </div>
                <div class="col-md-9">
                    <form method="POST" action="{{asset('/check-availability')}}">
                        @csrf
                        <div class="boking_table">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="book_tabel_item">
                                        <div class="form-group">
                                            <div class='input-group date'>
                                                <input type='date' name="check_in" class="form-control"
                                                       placeholder="Arrival Date" value="{{$search_data['check_in']}}"/>
                                                <span class="input-group-addon">
                                                        <i class="fa fa-calendar" aria-hidden="true"></i>
                                                    </span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class='input-group date'>
                                                <input type='date' name="check_out" class="form-control"
                                                       placeholder="Check out Date" value="{{$search_data['check_out']}}"/>
                                                <span class="input-group-addon">
                                                        <i class="fa fa-calendar" aria-hidden="true"></i>
                                                    </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="book_tabel_item">
                                        <div class="form-group">
                                            <div class='input-group date'>
                                                <input type='number' name="no_of_adults" class="form-control"
                                                       placeholder="No of Adults" value="{{$search_data['no_of_adults']}}"/>
                                                <span class="input-group-addon">
                                                        <i class="fa fa-calendar" aria-hidden="true"></i>
                                                    </span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class='input-group date'>
                                                <input type='number' name="no_of_children" class="form-control"
                                                       placeholder="No of Children" value="{{$search_data['no_of_children']}}"/>
                                                <span class="input-group-addon">
                                                        <i class="fa fa-calendar" aria-hidden="true"></i>
                                                    </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="book_tabel_item">
                                        <div class="form-group">
                                            <div class='input-group date'>
                                                <input type='number' name="no_of_rooms" class="form-control"
                                                       placeholder="No of Rooms" value="{{$search_data['no_of_rooms']}}"/>
                                                <span class="input-group-addon">
                                                        <i class="fa fa-calendar" aria-hidden="true"></i>
                                                    </span>
                                            </div>
                                        </div>
                                        <button type="submit" class="book_now_btn button_hover">CHECK AVAILABILITY
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!--================Booking Table Area  =================-->
    <!--================ Accomodation Area  =================-->
    <section class="accomodation_area section_gap">
        <div class="container">
            <div class="section_title text-center">
                <h2 class="title_color">Available Accommodation</h2>
                <p>Following rooms are available in our property on selected criteria</p>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="row accomodation_two">
                @if(count($room_categories) > 0)
                    @foreach($room_categories as $room_category)
                        <div class="col-lg-3 col-sm-6">
                            <div class="accomodation_item text-center">
                                <div class="hotel_img">
                                    <img src="{{asset($room_category->images[0]->path)}}" alt="">
                                    <a href="{{asset('/accomodation/'.$room_category->slug)}}" class="btn theme_btn button_hover">Book Now</a>
                                </div>
                                <a href="{{asset('/accomodation/'.$room_category->slug)}}"><h4 class="sec_h4">{{$room_category->name}}</h4></a>
                                <h5>{{number_format($room_category->charge_per_day,2)}}LKR<small>/night</small></h5>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-lg-12 col-sm-12">
                        <div class="accomodation_item text-center">
                            <h4 class="sec_h4">Sorry! No rooms available on selected days.</h4>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
    <!--================ Accomodation Area  =================-->
@endsection
