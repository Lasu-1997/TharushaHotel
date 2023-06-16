@php use Carbon\Carbon; @endphp
@extends('systemcore::layouts.master')
@section('content')
    <div class="row ">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Bookings</h4>
                    @role('admin')
                    <a class="btn btn-success ml-auto" aria-expanded="false" href="{{asset('/admin-create-booking')}}">Create
                        Booking</a>
                    @endrole
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
                                            @if($booking->payment_status==="pending")
                                                <div class="badge badge-outline-danger">Not paid</div>
                                            @elseif($booking->payment_status==="paid")
                                                <div class="badge badge-outline-success">Paid</div>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="row justify-content-center">
                                                <a class="btn btn-primary btn-sm"
                                                   href="{{asset('/bookings/'.$booking->id)}}">
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
