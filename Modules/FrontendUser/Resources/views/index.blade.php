@extends('frontenduser::layouts.master')

@section('content')
    <!--================Banner Area =================-->
    <section class="banner_area">
        <div class="booking_table d_flex align-items-center">
            <div class="overlay bg-parallax" data-stellar-ratio="0.9" data-stellar-vertical-offset="0"
                 data-background=""></div>
            <div class="container">
                <div class="banner_content text-center">
                    <h6>Homely feeling infused with luxury and comfort</h6>
                    <h2>SAFFRON</h2>
                    <p>Only place in Galle that feels like home! Book your paradise destination now.</p>
                    <a href="{{asset('/accomodation')}}" class="btn theme_btn button_hover">Book Now</a>
                </div>
            </div>
        </div>
        <div class="hotel_booking_area position">
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
        </div>
    </section>
    <!--================Banner Area =================-->

    <!--================ Accomodation Area  =================-->
    <section class="accomodation_area section_gap">
        <div class="container">
            <div class="section_title text-center">
                <h2 class="title_color">Take a look into our Wonderful Accomodation </h2>
                <p>We have all and cool suites and Deluxe rooms for your, Affordable and customisable to your desire.</p>
            </div>
            <div class="row mb_30">
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

    <!--================ Facilities Area  =================-->
    <section class="facilities_area section_gap">
        <div class="overlay bg-parallax" data-stellar-ratio="0.8" data-stellar-vertical-offset="0" data-background="">
        </div>
        <div class="container">
            <div class="section_title text-center">
                <h2 class="title_w">Saffron Exclusive</h2>
                <p>Who are in extremely love with eco friendly system.</p>
            </div>
            <div class="row mb_30">
                <div class="col-lg-4 col-md-6">
                    <div class="facilities_item">
                        <h4 class="sec_h4"><i class="lnr lnr-user"></i>Our Staff</h4>
                        <p>We have well experienced and a super friendly staff that you can always relay on, We provide your needs and wants as per your request.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="facilities_item">
                        <h4 class="sec_h4"><i class="lnr lnr-apartment"></i>Rooms</h4>
                        <p>Fully maintained and quarantine stays for an affordable price.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="facilities_item">
                        <h4 class="sec_h4"><i class="lnr lnr-dinner"></i>Restaurant</h4>
                        <p>With over X Chefs, who are well qualified We guarantee our food meets and exceeds your expectations.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="facilities_item">
                        <h4 class="sec_h4"><i class="lnr lnr-car"></i>Rent a Car</h4>
                        <p>Usage of the Internet is becoming more common due to rapid advancement of technology and
                            power.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="facilities_item">
                        <h4 class="sec_h4"><i class="lnr lnr-construction"></i>Rooftop</h4>
                        <p>Our roof top is the perfect view area for a dreamy night, clear sky and the sea breeze is all you can feel and dream about.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="facilities_item">
                        <h4 class="sec_h4"><i class="lnr lnr-coffee-cup"></i>Bar</h4>
                        <p>Usage of the Internet is becoming more common due to rapid advancement of technology and
                            power.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================ Facilities Area  =================-->

    <!--================ About History Area  =================-->
    <section class="about_history_area section_gap">
        <div class="container">
            <div class="row">
                <div class="col-md-6 d_flex align-items-center">
                    <div class="about_content ">
                        <h2 class="title title_color">About Us <br>We’re Saffron</h2>
                        <p>{!! $site_preferences->about_us !!}</p>
                        <p style="margin-top: -30%">{!! $site_preferences->mission_vision !!}</p>
                        <a href="{{asset('/contact')}}" class="button_hover theme_btn_two" style="margin-top: -10%">Contact Us</a>
                    </div>
                </div>
                <div class="col-md-6">
                    <img class="img-fluid" src="{{asset('user/image/about_home_bg.jpg')}}" alt="img">
                </div>
            </div>
        </div>
    </section>
    <!--================ About History Area  =================-->
@endsection
