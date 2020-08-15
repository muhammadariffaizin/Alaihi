@extends('layouts.master')

@section('body')
<nav class="navbar navbar-dark sticky-top bg-success flex-md-nowrap shadow">
    <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3"
        href="{{ route('welcome') }}">{{ config('app.name', 'Alaihi') }}</a>
    <button class="navbar-toggler d-md-none" type="button" data-toggle="collapse" data-target="#sidebarMenu"
        aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <ul class="navbar-nav ml-md-auto px-3">
        @auth
        <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }} <span class="caret"></span>
            </a>

            <div class="dropdown-menu dropdown-menu-right position-absolute" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </li>
        @endauth
    </ul>
</nav>

<div class="container-fluid">
    <div class="row">
        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
            <div class="sidebar-sticky pt-3">
                @yield('sidebar')
            </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4 py-4">
            @yield('title')
            @yield('content')
        </main>
    </div>

    <div id="modal">
        <div id="pageModal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog"
            aria-labelledby="pageModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div id="pageModalContent" class="modal-content border-0">
                    <div class="modal-header bg-success text-light border-0">
                        <h5 id="modal-title" class="modal-title">@yield('modal-title')</h5>
                        <button type="button" class="close bg-success" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" class="text-light">&times;</span>
                        </button>
                    </div>
                    <form action="@yield('modal-action')" method="POST" class="form">
                        @csrf
                        <div id="modal-content" class="modal-body">
                            @yield('modal-content')
                        </div>
                        <div class="modal-footer">
                            @yield('modal-footer')
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
@stack('script')
@endpush