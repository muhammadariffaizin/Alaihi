@extends('layouts.master')

@section('body')
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-transparent">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Alaihi') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    @auth
                        @if(Auth::user()->is_admin == 1)
                        <li class="nav-item">
                            <a href="{{ route('admin.home') }}" class="nav-link">Home</a>
                        </li>
                        @else
                        <li class="nav-item">
                            <a href="{{ route('user.home') }}" class="nav-link">Home</a>
                        </li>
                        @endif
                    @else
                        <li class="nav-item">
                            <a href="{{ route('login') }}" class="nav-link">Login</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('register') }}" class="nav-link">Register</a>
                        </li>
                    @endauth
                </ul>
            </nav>
        </div>
    </nav>

    <div class="d-flex flex-column justify-content-center bg-primary vh-80 no-gutters">
        <div class="text-center text-light mx-4 mb-4">
            <div class="display-1">Alaihi</div>
            <h4 class="text-light">Cari lirik sholawatmu di sini dan <i>shollu 'alaih!</i></h4>
        </div>
        <div class="row no-gutters justify-content-center">
            <div class="col-8">
                <div class="input-group border-0 shadow-lg">
                    <div class="input-group-prepend" id="button_search">
                        <span class="input-group-text border-0 text-primary bg-transparent position-absolute h-100" id="searchaddon"><i class="fas fa-search"></i></span>
                    </div>
                    <input id="search" class="form-control-lg border-0 pl-5 w-100" type="text" name="search" placeholder="Cari sholawat di sini.." aria-label="Search" aria-describedby="searchaddon">
                </div>
            </div>
        </div>
    </div>
    <div class="row bg-primary no-gutters">
        <!--Waves Container-->
        <div class="w-100">
            <svg class="waves w-100" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
                <defs>
                    <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
                </defs>
                <g class="parallax">
                    <use xlink:href="#gentle-wave" x="48" y="0" fill="rgba(255,255,255,0.7)" />
                    <use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(255,255,255,0.5)" />
                    <use xlink:href="#gentle-wave" x="48" y="5" fill="rgba(255,255,255,0.3)" />
                    <use xlink:href="#gentle-wave" x="48" y="7" fill="#fff" />
                </g>
            </svg>
        </div>
        <!--Waves end-->
    </div>
    <div class="container pt-4">
        <div class="row">
            <div class="col-md-6 col-lg-3">
                <div class="card text-center">
                    <div class="card-body">
                        <i class="fas fa-3x fa-fw fa-plus"></i>
                        <h5 class="card-title">Keunggulan</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card text-center">
                    <div class="card-body">
                        <i class="fas fa-3x fa-fw fa-plus"></i>
                        <h5 class="card-title">Keunggulan</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
