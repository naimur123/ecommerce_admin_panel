@extends('frontend.masterPage')
@section('all')
<div class="container">
    <div class="row justify-content-center ">
        <div class="col-md-8">
            @if(session('error'))
                <div class="alert alert-danger">
                  {{ session('error') }}
                </div> 
            @endif
            <div class="card mt-2 mb-2 text-center">
                <div class="card-header"><strong>User Login</strong></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('user.login')}}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">Email Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email' ) }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        Remember Me
                                    </label>
                                </div>
                            </div>
                        </div> --}}

                        <div class="row">
                            <div class="col-md-8 offset-md-3 text-center">
                                <button type="submit" class="btn btn-outline-success">
                                    Login
                                </button>
                            </div>
                            <div class="col-md-8 offset-md-3 text-center mt-2">
                                <a class="btn btn-outline-primary" href="{{ route('register.google') }}" rule="button">
                                    <img src="https://upload.wikimedia.org/wikipedia/commons/5/53/Google_%22G%22_Logo.svg" width="25" /><span
                                      style="margin-left: 10px;"
                                      >Sign in with google</span
                                    >
                                  </a>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-8 offset-md-3 text-center">
                                <p>Don't have an account? simply register</p>
                                <a href="{{ route('user.register') }}" class="btn btn-outline-danger" rule="button">Register</a>
                            </div>
                        </div>
                    </form>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection