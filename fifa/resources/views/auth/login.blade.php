<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="{{asset('css/home.css')}}">

    <!-- Custom styles for this template-->
    <link href="{{asset('css/sb-admin-2.css')}}" rel="stylesheet">
    </head>
    <body>

    <section class="section-login shadow">
        <!-- <div class="logo-box">
            <a class="navbar-brand" href="#" class="logo"><img src="{{ asset('/images/logo-fifa-2.png') }}"></a>
        </div> -->

        <div class="login-register-box rounded">
            <div class="box-header">
                <div class="d-flex justify-content-center align-items-center">
                    <div class="login-tab p-4 text-center">
                        <h3 class="heading-login">Login</h3>
                    </div>

                    <a href="/register">
                        <div class="register-tab p-4 text-center">
                            <h3 class="heading-register">Register</h3>
                        </div>
                    </a>
                </div>
            </div>

            <div class="box-content">
                <div class="logo-mobile text-center mb-5">
                    <a href="{{route('welcome')}}"><img src="{{asset('/images/logo-fifa-2.png')}}" width="120"></a>
                </div>

                <div id="login-form" class="tab-pane active">
                    <form method="POST" action="{{ route('login') }}">
                    @csrf
                        <div class="form-group">
                            <input id="username" type="username" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus placeholder="Username">

                            @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Parola">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-10 offset-md-4">
                                <button type="submit" class="btn btn-standard">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Ai uitat parola?') }}
                                    </a>
                                @endif
                            </div>
                        </div>

                        <hr>

                        <p class="text-center">Inca nu ai un cont? <a href="/register">Register</a></p>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>
</html>

