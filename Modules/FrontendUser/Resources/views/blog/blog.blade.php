@extends('frontenduser::layouts.master')

@section('content')
    <!--================Banner Area =================-->
    <section class="banner_area blog_banner d_flex align-items-center">
        <div class="overlay bg-parallax" data-stellar-ratio="0.9" data-stellar-vertical-offset="0"
             data-background=""></div>
        <div class="container">
            <div class="banner_content text-center">
                <h4>Saffron & Unawatuna</h4>
                <p>Sneak into the mythical and Magical destinations of Sri Lanka</p>
            </div>
        </div>
    </section>
    <!--================Banner Area =================-->

    <!--================blog Area =================-->
    <section class="blog_area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="blog_left_sidebar">
                        @foreach($blogs as $blog)
                            <article class="row blog_item">
                                <div class="col-md-3">
                                    <div class="blog_info text-right">
                                        <ul class="blog_meta list_style">
                                            <li><a href="#">{{$blog->user->name}}<i class="lnr lnr-user"></i></a></li>
                                            <li><a href="#">
                                                    {{date('d M Y', strtotime($blog->created_at))}}
                                                    <i class="lnr lnr-calendar-full"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="blog_post">
                                        @if($blog->images->count() > 0)
                                            <img src="{{$blog->images[0]->path}}" alt="">
                                        @endif
                                        <div class="blog_details">
                                            <a href="#"><h2>{{$blog->title}}</h2></a>
                                            <p>
                                                {!! substr($blog->description, 0, 300) !!}
                                            </p>
                                        </div>
                                            <a href="{{asset('/blog/'.$blog->slug)}}" class="view_btn button_hover">View More</a>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================blog Area =================-->
@endsection
