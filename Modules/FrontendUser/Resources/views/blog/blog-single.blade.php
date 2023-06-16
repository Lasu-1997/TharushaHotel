@extends('frontenduser::layouts.master')

@section('content')
    <!--================Breadcrumb Area =================-->
    <section class="breadcrumb_area blog_banner_two">
        <div class="overlay bg-parallax" data-stellar-ratio="0.8" data-stellar-vertical-offset="0"
             data-background=""></div>
        <div class="container">
            <div class="page-cover text-center">
                <h2 class="page-cover-tittle f_48">{{$blog->title}}</h2>
                <ol class="breadcrumb">
                    <li><a href="{{asset('/')}}">Home</a></li>
                    <li><a href="{{asset('/blog')}}">Blog</a></li>
                    <li class="active">{{$blog->title}}</li>
                </ol>
            </div>
        </div>
    </section>
    <!--================Breadcrumb Area =================-->

    <!--================blog Area =================-->
    <section class="blog_area single-post-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 posts-list">
                    <div class="single-post row">
                        <div class="col-lg-12">
                            <div class="feature-img">
                                @if($blog->images->count() > 0)
                                    <img class="img-fluid" src="{{'/'.$blog->images[0]->path}}" alt="">
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-3  col-md-3">
                            <div class="blog_info text-right">
                                <ul class="blog_meta list_style">
                                    <li><a href="#">{{$blog->user->name}}<i class="lnr lnr-user"></i></a></li>
                                    <li><a href="#">
                                            {{date('d M Y', strtotime($blog->created_at))}}
                                            <i class="lnr lnr-calendar-full"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-9 blog_details">
                            <h2>{{$blog->title}}</h2>
                            <p class="excert">
                                {!! $blog->description !!}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="blog_right_sidebar">
                        <aside class="single_sidebar_widget author_widget">
                            <img class="author_img rounded-circle" src="image/blog/author.png" alt="">
                            <h4>{{$blog->user->name}}</h4>
                            <p>{{$blog->user->email}}</p>
                            <p>Boot camps have its supporters andit sdetractors. Some people do not understand why you
                                should have to spend money on boot camp when you can get. Boot camps have itssuppor ters
                                andits detractors.</p>
                        </aside>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================blog Area =================-->

@endsection
