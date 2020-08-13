@extends('layouts.master')

@section('body')
    <div class="flex-center position-ref full-height">
        @if (Route::has('login'))
            <div class="top-right links">
                @auth
                    @if(Auth::user()->is_admin == 1)
                    <a href="{{ route('admin.home') }}">Home</a>
                    @else
                    <a href="{{ route('user.home') }}">Home</a>
                    @endif
                @else
                    <a href="{{ route('login') }}">Login</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}">Register</a>
                    @endif
                @endauth
            </div>
        @endif

        <div class="content">
            <div class="title m-b-md">
                Alaihi
            </div>
        </div>
    </div>
@endsection
