@extends('frontenduser::layouts.master')

@section('content')
    <!--================Breadcrumb Area =================-->
    <section class="breadcrumb_area blog_banner_two">
        <div class="overlay bg-parallax" data-stellar-ratio="0.8" data-stellar-vertical-offset="0"
             data-background=""></div>
        <div class="container">
            <div class="page-cover text-center">
                <h2 class="page-cover-tittle f_48">Accomodation Details page</h2>
                <ol class="breadcrumb">
                    <li class="active">{{$accomodation->name}}</li>
                </ol>
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
                            <a href="{{asset('/accomodation/'.$accomodation->slug.'/book-accomodation')}}" type="button"
                               class="book_now_btn button_hover mt-5">Book this property</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================blog Area =================-->
@endsection

