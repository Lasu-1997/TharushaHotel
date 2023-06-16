@php use Carbon\Carbon; @endphp
@extends('systemcore::layouts.master')

@section('content')
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Booking Details</h4>
                <p class="card-description">Booking placed by (Name) : {{$booking->user->name}} </p>
                <p class="card-description">Booking placed by (Email) : {{$booking->user->email}} </p>
                <form class="forms-sample mt-5">
                    <div class="form-group row">
                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Guest name :</label>
                        <div class="col-sm-9">
                            <label for="exampleInputUsername2" class="form-control">{{$booking->guest_name}}</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Guest email :</label>
                        <div class="col-sm-9">
                            <label for="exampleInputUsername2" class="form-control">{{$booking->guest_email}}</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Guest phone :</label>
                        <div class="col-sm-9">
                            <label for="exampleInputUsername2" class="form-control">{{$booking->guest_phone}}</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">{{$booking->id_type}} No.
                            :</label>
                        <div class="col-sm-9">
                            <label for="exampleInputUsername2" class="form-control">{{$booking->id_number}}</label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Room type :</label>
                        <div class="col-sm-9">
                            <label for="exampleInputUsername2"
                                   class="form-control">{{$booking->roomCategory->name}}</label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Check In :</label>
                        <div class="col-sm-9">
                            <label for="exampleInputUsername2"
                                   class="form-control">{{Carbon::parse($booking->check_in)->format('d M Y')}}</label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Check Out :</label>
                        <div class="col-sm-9">
                            <label for="exampleInputUsername2"
                                   class="form-control">{{Carbon::parse($booking->check_out)->format('d M Y')}}</label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">No of adults :</label>
                        <div class="col-sm-9">
                            <label for="exampleInputUsername2" class="form-control">{{$booking->no_of_adults}}</label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">No of children :</label>
                        <div class="col-sm-9">
                            <label for="exampleInputUsername2" class="form-control">{{$booking->no_of_children}}</label>
                        </div>
                    </div>
                    <div class="float-md-right">
                        <a href="{{asset('/bookings/'.$booking->id.'/admin-approve')}}" class="btn btn-primary mr-2">Approve</a>
                        @if($booking->payment_status==="pending")
                            <a href="{{asset('/bookings/'.$booking->id.'/admin-mark-as-paid')}}"
                               class="btn btn-success mr-2">Mark as paid</a>
                        @endif
                        <a href="{{asset('/bookings/'.$booking->id.'/admin-decline')}}" class="btn btn-dark">Decline</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
