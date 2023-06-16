@extends('systemcore::layouts.master')

@section('content')
    <div class="row ">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Hold Dates</h4>
                    <a class="btn btn-success ml-auto" aria-expanded="false"
                       href="{{asset('/create-admin-hold-booking')}}">Create Hold</a>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th> Start date</th>
                                <th> End date</th>
                                <th> Description</th>
                                <th> Status</th>
                                <th> Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($booking_hold_dates)
                                @foreach($booking_hold_dates as $booking_hold_date)
                                    <tr>
                                        <td> {{$booking_hold_date->start_date}}</td>
                                        <td> {{$booking_hold_date->end_date}}</td>
                                        <td> {{$booking_hold_date->description}}</td>
                                        <td>
                                            <div class="badge badge-outline-warning">Hold</div>
                                        </td>
                                        <td>
                                            <div class="row">
                                                {{--                                        <a class="btn btn-primary btn-sm mr-2" href="#">--}}
                                                {{--                                            <i class="mdi mdi-eye text-lime-50 mr-0"></i>--}}
                                                {{--                                        </a>--}}
                                                <a class="btn btn-danger btn-sm"
                                                   href="/admin-remove-booking-hold/{{$booking_hold_date->id}}">
                                                    <i class="mdi mdi-trash-can text-lime-50 mr-0"></i>
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
