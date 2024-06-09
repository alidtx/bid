<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="shortcut icon" href="{{ asset('images/icon-logo.png') }}">
    <title>Banglabid Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no"
    />


    <!-- Disable tap highlight on IE -->
    <meta name="msapplication-tap-highlight" content="no">
<style>


</style>
<link href="{{asset('css/main.css')}}" rel="stylesheet"></head>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<body>
<div class="app-container app-theme-white body-tabs-shadow">
        <div class="app-container">
            <div class="h-100">
                <div class="h-100 no-gutters row">
                    <div class="d-none d-lg-block col-lg-4">
                        <div class="slider-light">
                            <div class="slick-slider">
                                <div>
                                        <div class="position-relative h-100 d-flex justify-content-center align-items-center bg-white" tabindex="-1">
                                            <div class="slide-img-bg" style="opacity: 1;height: 300px;  background-image: url('{{asset('img/Banglabid.png')}}'); background-repeat:no-repeat; background-size:contain; background-position: center"></div>
                                            <div class="slider-content"><h3></h3>
                                                <p></p></div>
                                        </div>
                                </div>

                                {{-- <div>
                                    <div class="position-relative h-100 d-flex justify-content-center align-items-center bg-warning" tabindex="-1">
                                    <div class="slide-img-bg" style="background-image: url('{{asset('images/dashboard/logo-full.png')}}');"></div>
                                        <div class="slider-content"><h3>{{config('staticTexts.second_slider_title')}}</h3>
                                            <p>{{config('staticTexts.second_slider_subtitle')}}</p></div>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                    <div class="h-100 d-flex bg-white justify-content-center align-items-center col-md-12 col-lg-8">
                        <div class="mx-auto app-login-box col-sm-12 col-md-10 col-lg-9">
                            <div class="app-logo"></div>
                            <h4 class="mb-0">
                                <span class="d-block">Welcome</span>
                                <span>Banglabid Admin Panel</span></h4>
                            {{-- <h6 class="mt-3">No account? <a href="javascript:void(0);" class="text-primary">Sign up now</a></h6> --}}
                            <div class="divider row"></div>
                            <div>
                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf
                                    <div class="form-row">
                                        <div class="col-md-6">
                                            <div class="position-relative form-group">
                                                <label for="exampleEmail" class="">Email</label>
                                                <input name="email" id="exampleEmail" placeholder="Email here..." type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="position-relative form-group">
                                                <label for="examplePassword" class="">Password</label>

                                                <div class="input-group mb-3" id="show_hide_password">
                                                        <input  id="examplePassword" placeholder="Password here..." type="password"
                                                        class="form-control @error('password') is-invalid @enderror"
                                                        name="password"
                                                        required autocomplete="current-password aria-describedby="basic-addon2">
                                                        <div class="input-group-append">
                                                          <span class="input-group-text" id="basic-addon2">
                                                                <a href="" id="show-password" style="color:black"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                                          </span>
                                                        </div>
                                                </div>
                                                @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>
                                    {{-- <div class="position-relative form-check">

                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                                Keep me logged in
                                        </label>
                                    </div> --}}
                                    <div class="divider row"></div>
                                    <div class="d-flex align-items-center">
                                        <div class="ml-auto">
                                            {{-- <a href="javascript:void(0);" class="btn-lg btn btn-link">Recover Password</a> --}}
                                            @if (Route::has('password.request'))
                                            <a class="btn btn-link " href="{{ route('password.request') }}">
                                                {{ __('Forgot Your Password?') }}
                                            </a>
                                            @endif
                                            {{-- <button class="btn btn-primary btn-lg">Login to Dashboard</button> --}}
                                            <button class="ladda-button btn btn-primary btn-lg"
                                                data-style="zoom-out">
                                                <span class="ladda-label">Login to Dashboard
                                                </span>

                                                <span class="ladda-spinner">
                                                </span>
                                                <div class="ladda-progress" style="width: 0px;"></div>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
<script type="text/javascript" src="{{asset('js/main.js')}}"></script>
<script>

$(document).ready(function() {
    $("#show_hide_password a").on('click', function(event) {
        event.preventDefault();
        if($('#show_hide_password input').attr("type") == "text"){
            $('#show_hide_password input').attr('type', 'password');
            $('#show_hide_password i').addClass( "fa-eye" );
            $('#show_hide_password i').removeClass( "fa-eye-slash" );
        }else if($('#show_hide_password input').attr("type") == "password"){
            $('#show_hide_password input').attr('type', 'text');
            $('#show_hide_password i').removeClass( "fa-eye" );
            $('#show_hide_password i').addClass( "fa-eye-slash" );
        }
    });
});

</script>


</body>
</html>
