@php use Carbon\Carbon; @endphp
@extends('systemcore::layouts.master')
@section('content')
    <div class="row ">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Users</h4>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th> Name</th>
                                <th> Email</th>
                                <th> Registered Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($users) > 0)
                                @foreach($users as $user)
                                    <tr>
                                        <td> {{$user->name}}</td>
                                        <td> {{$user->email}}</td>
                                        <td>
                                            {{Carbon::parse($user->created_at)->format('d-m-Y')}}
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
