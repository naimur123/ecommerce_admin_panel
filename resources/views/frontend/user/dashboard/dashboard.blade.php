@extends('frontend.user.masterPage')
@section('content')
    @if (!empty($email_verified_at))
    <p>Congrats Youre Loggedin</p>
    @else
     <p>Youre email is not verified</p>
     {{-- <p>{{ $user->id }}</p> --}}
     <p>To verify your email</p><a href="{{ route('email.verfiy', $id ) }}">Click here</a>
    @endif
@endsection
