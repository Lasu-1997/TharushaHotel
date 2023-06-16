@php use Carbon\Carbon; @endphp
@extends('systemcore::layouts.master')
@section('content')
    <div class="row ">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Room Categories</h4>
                    @role('admin')
                    <a class="btn btn-success ml-auto" aria-expanded="false" href="{{asset('/room_category/create')}}">Create
                        Room Category</a>
                    @endrole
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th> Category Name</th>
                                <th> No of rooms</th>
                                <th> Charge/Day</th>
                                <th> Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($room_categories) > 0)
                                @foreach($room_categories as $room_category)
                                    <tr>
                                        <td> {{$room_category->name}}</td>
                                        <td> {{$room_category->no_of_rooms}}</td>
                                        <td> {{number_format($room_category->charge_per_day,2)}}LKR</td>
                                        <td>
                                            <div class="row mr-auto ml-auto">
                                                <a class="btn btn-primary btn-sm mr-2"
                                                   href="{{asset('/room_category/'.$room_category->slug.'/edit')}}">
                                                    <i class="mdi mdi-pencil text-lime-50 mr-0"></i>
                                                </a>
                                                <button class="btn btn-danger btn-sm"
                                                   href="{{asset('/room_category/'.$room_category->id.'/delete')}}">
                                                    <i class="mdi mdi-trash-can text-lime-50 mr-0"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
