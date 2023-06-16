@extends('frontenduser::layouts.master')

@section('content')
    <!--================Breadcrumb Area =================-->
    <section class="breadcrumb_area">
        <div class="overlay bg-parallax" style="background: url({{asset('../../image/accommodation_banner.jpg')}}) !important;" data-stellar-ratio="0.8" data-stellar-vertical-offset="0"
             data-background=""></div>
        <div class="container">
            <div class="page-cover text-center">
                <h2 class="page-cover-tittle">Take a look into our wonderful accommodation</h2>
                <ol class="breadcrumb">
                    <li><a href="{{asset('/')}}">Home</a></li>
                    <li class="active">Accommodation</li>
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
                                                       placeholder="Arrival Date"/>
                                                <span class="input-group-addon">
                                                        <i class="fa fa-calendar" aria-hidden="true"></i>
                                                    </span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class='input-group date'>
                                                <input type='date' name="check_out" class="form-control"
                                                       placeholder="Departure Date"/>
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
                                                       placeholder="No of Adults"/>
                                                <span class="input-group-addon">
                                                        <i class="fa fa-calendar" aria-hidden="true"></i>
                                                    </span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class='input-group date'>
                                                <input type='number' name="no_of_children" class="form-control"
                                                       placeholder="No of Children"/>
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
                                                       placeholder="No of Rooms"/>
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
                <h2 class="title_color">Accommodation</h2>
                <p>We have all and cool suites and Deluxe rooms for your, Affordable and customisable to your desire.</p>
            </div>
            <div class="row accomodation_two">
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
            </div>
        </div>
    </section>
    <!--================ Accomodation Area  =================-->
@endsection
