<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Saffron | Login</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{asset('admin/assets/vendors/mdi/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/assets/vendors/css/vendor.bundle.base.css')}}">
    <!-- endinject -->
    <link rel="stylesheet" href="{{asset('admin/assets/css/style.css')}}">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{asset('admin/assets/images/favicon.png')}}"/>
</head>
<body>
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="row w-100 m-0">
            <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
                <div class="card col-lg-4 mx-auto">
                    <div class="card-body px-5 py-5">
                        <h3 class="card-title text-left mb-3">Register</h3>
                        <x-jet-validation-errors class="mb-4"/>

                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div>
                                <x-jet-label for="name" value="{{ __('Name') }}"/>
                                <x-jet-input id="name" class="block mt-1 w-full form-control p_input" type="text" name="name"
                                             :value="old('name')" required autofocus autocomplete="name"/>
                            </div>

                            <div class="mt-4">
                                <x-jet-label for="email" value="{{ __('Email') }}"/>
                                <x-jet-input id="email" class="block mt-1 w-full form-control p_input" type="email" name="email"
                                             :value="old('email')" required/>
                            </div>

                            <div class="mt-4">
                                <x-jet-label for="password" value="{{ __('Password') }}"/>
                                <x-jet-input id="password" class="block mt-1 w-full form-control p_input" type="password" name="password"
                                             required autocomplete="new-password"/>
                            </div>

                            <div class="mt-4">
                                <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}"/>
                                <x-jet-input id="password_confirmation" class="block mt-1 w-full form-control p_input" type="password"
                                             name="password_confirmation" required autocomplete="new-password"/>
                            </div>

                            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                                <div class="mt-4">
                                    <x-jet-label for="terms">
                                        <div class="flex items-center">
                                            <x-jet-checkbox name="terms" id="terms" required/>

                                            <div class="ml-2">
                                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-white">'.__('Terms of Service').'</a>',
                                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-white">'.__('Privacy Policy').'</a>',
                                                ]) !!}
                                            </div>
                                        </div>
                                    </x-jet-label>
                                </div>
                            @endif

                            <div class="flex items-center justify-end mt-4">
                                <x-jet-button class="btn btn-primary btn-block enter-btn" style="color: white !important;">
                                    {{ __('Register') }}
                                </x-jet-button>
                            </div>
                            <a class="underline text-sm text-gray-600 hover:text-white" href="{{ route('login') }}">
                                {{ __('Already registered?') }}
                            </a>
                        </form>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- row ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
<!-- plugins:js -->
<script src="{{asset('admin/assets/vendors/js/vendor.bundle.base.js')}}"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="{{asset('admin/assets/js/off-canvas.js')}}"></script>
<script src="{{asset('admin/assets/js/hoverable-collapse.js')}}"></script>
<script src="{{asset('admin/assets/js/misc.js')}}"></script>
<script src="{{asset('admin/assets/js/settings.js')}}"></script>
<script src="{{asset('admin/assets/js/todolist.js')}}"></script>
<!-- endinject -->
</body>
</html>
