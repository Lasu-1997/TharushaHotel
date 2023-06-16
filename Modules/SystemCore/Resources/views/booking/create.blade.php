@extends('systemcore::layouts.master')

@section('content')
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Create manual booking</h4>
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
                <form class="form-sample" method="POST" action="{{asset('/admin-store-booking')}}">
                    @csrf
                    <p class="card-description"> Guest Information </p>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Guest Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="guest_name" placeholder="Guest name"
                                           required/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">ID Type</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="id_type">
                                        <option>Passport</option>
                                        <option>NIC</option>
                                        <option>Driving Licence</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">ID Number</label>
                                <div class="col-sm-9">
                                    <input type="text" name="id_number" class="form-control"/>
                                </div>
                            </div>
                        </div>
                    </div>


                    <p class="card-description"> Contact Info </p>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Phone</label>
                                <div class="col-sm-9">
                                    <input type="text" name="guest_phone" class="form-control"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-9">
                                    <input type="email" name="guest_email" class="form-control"
                                           placeholder="Guest email"/>
                                </div>
                            </div>
                        </div>
                    </div>

                    <p class="card-description"> Booking Info </p>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Check In</label>
                                <div class="col-sm-9">
                                    <input type="date" name="check_in" class="form-control" placeholder="dd/mm/yyyy"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Check Out</label>
                                <div class="col-sm-9">
                                    <input type="date" name="check_out" class="form-control" placeholder="dd/mm/yyyy"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Room Type</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="room_category_id">
                                        @foreach($room_categories as $room_category)
                                            <option value="{{$room_category->id}}">{{$room_category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">No of Rooms</label>
                                <div class="col-sm-9">
                                    <input type="number" min="1" name="no_of_rooms" class="form-control"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">No of Adults</label>
                                <div class="col-sm-9">
                                    <input type="number" name="no_of_adults" min="1" class="form-control"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">No of Children</label>
                                <div class="col-sm-9">
                                    <input type="number" min="0" name="no_of_children" class="form-control"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Place Booking</button>
                    <button class="btn btn-dark">Cancel</button>
                </form>
            </div>
        </div>
    </div>
@endsection
