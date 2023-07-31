@extends('frontend.user.masterPage')
@section('contentHome')
    @if(session('success'))
    <div class="alert alert-success">
    {{ session('success') }}
    </div>
    @endif 
    {{-- @if (!empty($email_verified_at)) --}}
    {{-- <p>Congrats Youre Loggedin</p> --}}
    
    {{-- @endif --}}
    {{-- @else --}}

        @if(session('verified'))
            <div class="alert alert-success">
            {{ session('verified') }}
            </div>
        @else
            @if (empty($email_verified_at) && empty(session('verified')))
            <p>Youre email is not verified</p>
            {{-- <p>{{ $user->id }}</p> --}}
            <p>To verify your email</p><a href="{{ route('email.verfiy', $id ) }}">Click here</a>
            @endif 
        @endif

    
@endsection
