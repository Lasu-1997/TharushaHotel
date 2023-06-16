@php use Carbon\Carbon; @endphp
@extends('systemcore::layouts.master')
@section('content')
    <div class="row ">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Blog Posts</h4>
                    @role('admin')
                    <a class="btn btn-success ml-auto" aria-expanded="false" href="{{asset('/admin-blog/create')}}">Create
                        New Post</a>
                    @endrole
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th> Title</th>
                                <th> Posted Date</th>
                                <th> Posted By</th>
                                <th> Status</th>
                                <th> Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($blog_posts as $blog_post)
                                <tr>
                                    <td> {{$blog_post->title}}</td>
                                    <td>
                                        {{Carbon::parse($blog_post->created_at)->format('d M Y')}}
                                    </td>
                                    <td> {{$blog_post->user->name}}</td>
                                    <td>
                                        @if($blog_post->is_published == 1)
                                            <label class="badge badge-outline-success">Published</label>
                                        @else
                                            <label class="badge badge-outline-warning">Draft</label>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="row">
                                            <a class="btn btn-primary btn-sm mr-2"
                                               href="/blog/{{$blog_post->slug}}">
                                                <i class="mdi mdi-eye text-lime-50 mr-0"></i>
                                            </a>
                                            <a class="btn btn-info btn-sm mr-2"
                                               href="/admin-blog/{{$blog_post->id}}/edit">
                                                <i class="mdi mdi-pencil text-lime-50 mr-0"></i>
                                            </a>
                                            <a class="btn btn-danger btn-sm mr-2"
                                               href="/admin-blog/{{$blog_post->id}}/delete">
                                                <i class="mdi mdi-trash-can text-lime-50 mr-0"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
