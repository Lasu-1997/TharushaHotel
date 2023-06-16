@extends('frontenduser::layouts.master')

@section('content')
    <!--================Breadcrumb Area =================-->
    <section class="breadcrumb_area">
        <div class="overlay bg-parallax" style="background: url({{asset('../../image/gallery_banner.jpg')}}) !important;background-repeat: no-repeat" data-stellar-ratio="0.8" data-stellar-vertical-offset="0"
             data-background=""></div>
        <div class="container">
            <div class="page-cover text-center">
                <h2 class="page-cover-tittle">Gallery</h2>
                <ol class="breadcrumb">
                    <li><a href="{{asset('/')}}">Home</a></li>
                    <li class="active">Gallery</li>
                </ol>
            </div>
        </div>
    </section>
    <!--================Breadcrumb Area =================-->

    <!--================Breadcrumb Area =================-->
    <section class="gallery_area section_gap">
        <div class="container">
            <div class="section_title text-center">
                <h2 class="title_color">Saffron Snaps & Clicks</h2>
                <p>Take a look at our hotel in action</p>
            </div>
            <div class="row imageGallery1" id="gallery">
                @foreach($images as $image)
                    <div class="col-md-3 gallery_item">
                        <div class="gallery_img">
                            <img src="{{asset($image->path)}}" alt="">
                            <div class="hover">
                                <a class="light" href="{{asset($image->path)}}"><i class="fa fa-expand"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!--================Breadcrumb Area =================-->
@endsection
