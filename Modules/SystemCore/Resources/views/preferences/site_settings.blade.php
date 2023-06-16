@extends('systemcore::layouts.master')

@section('content')
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Site Preferences</h4>
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
                <form class="form-sample" method="POST" action="{{asset('/site_preferences')}}">
                    @csrf
                    <p class="card-description"> About Section</p>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">About Us</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" name="about_us" placeholder="About us">
                                        {{$site_preference->about_us}}
                                    </textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Mission and Vision</label>
                                <div class="col-sm-9">
                                    <textarea type="text" class="form-control" name="mission_vision" placeholder="Our mission is...">
                                        {{$site_preference->mission_vision}}
                                    </textarea>
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
                                    <input type="text" placeholder="Contactable Number" name="contact_phone" value="{{$site_preference->phone }}" class="form-control"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-9">
                                    <input type="email" name="contact_email" class="form-control"
                                           placeholder="Site email" value="{{$site_preference->email}}"/>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Address Line 1</label>
                                <div class="col-sm-9">
                                    <input type="text" value="{{$site_preference->address_line_1}}" name="address_line_1" class="form-control"/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Address Line 2</label>
                                <div class="col-sm-9">
                                    <input type="text" value="{{$site_preference->address_line_2}}" name="address_line_2" class="form-control"/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Address Line 3</label>
                                <div class="col-sm-9">
                                    <input type="text" value="{{$site_preference->address_line_3}}" name="address_line_3" class="form-control"/>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary mr-2">Update</button>
                    <button class="btn btn-dark">Cancel</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        tinymce.init({
            selector: 'textarea',
            plugins: 'wordcount',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
        });
    </script>
@endsection
