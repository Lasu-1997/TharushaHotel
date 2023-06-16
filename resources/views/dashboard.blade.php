@php use Carbon\Carbon; @endphp
@extends('systemcore::layouts.master')

@section('content')
    @role('admin')
    <div class="row">
        <div class="col-sm-4 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h5>Total Bookings <small> (This month)</small></h5>
                    <div class="row">
                        <div class="col-8 col-sm-12 col-xl-8 my-auto">
                            <div class="d-flex d-sm-block d-md-flex align-items-center">
                                <h2 class="mb-0">{{$total_bookings_last_month}}</h2>
                            </div>
                        </div>
                        <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                            <i class="icon-lg mdi mdi-hotel text-warning ml-auto"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h5>Registered Users</h5>
                    <div class="row">
                        <div class="col-8 col-sm-12 col-xl-8 my-auto">
                            <div class="d-flex d-sm-block d-md-flex align-items-center">
                                <h2 class="mb-0">{{$users_count}}</h2>
                            </div>
                        </div>
                        <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                            <i class="icon-lg mdi mdi-account text-danger ml-auto"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h5>Unique Visitors</h5>
                    <div class="row">
                        <div class="col-8 col-sm-12 col-xl-8 my-auto">
                            <div class="d-flex d-sm-block d-md-flex align-items-center">
                                <h2 class="mb-0">{{$unique_visitors}}</h2>
                            </div>
                        </div>
                        <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                            <i class="icon-lg mdi mdi-account-badge text-success ml-auto"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endrole
    <div class="row ">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Latest Bookings</h4>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th> Name</th>
                                <th> Phone</th>
                                <th> Room Type</th>
                                <th> Check In</th>
                                <th> Check Out</th>
                                <th> Booked Date</th>
                                <th> Status</th>
                                <th> Payment Status</th>
                                <th> Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($bookings) > 0)
                                @foreach($bookings as $booking)
                                    <tr>
                                        <td> {{$booking->guest_name}}</td>
                                        <td> {{$booking->guest_phone}}</td>
                                        <td> {{$booking->roomCategory->name}}</td>
                                        <td>{{Carbon::parse($booking->check_in)->format('d M Y')}}</td>
                                        <td>{{Carbon::parse($booking->check_out)->format('d M Y')}}</td>
                                        <td>{{Carbon::parse($booking->created_at)->format('d M Y')}}</td>
                                        <td>
                                            @if($booking->status == 3)
                                                <label class="badge badge-outline-success">Approved</label>
                                            @elseif($booking->status == 2)
                                                <label class="badge badge-outline-danger">Canceled</label>
                                            @elseif($booking->status == 1)
                                                <label class="badge badge-outline-warning">Pending</label>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="badge badge-outline-danger">Not paid</div>
                                        </td>
                                        <td>
                                            <div class="row justify-content-center">
                                                <a class="btn btn-primary btn-sm" href="{{asset('/bookings/'.$booking->id)}}">
                                                    <i class="mdi mdi-eye text-lime-50 mr-0"></i>
                                                </a>
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
