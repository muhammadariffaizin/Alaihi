@extends('layouts.dashboard')

@section('sidebar')
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link {{ (request()->route()->named('user.home')) ? 'active' : '' }}" href="{{ route('user.home') }}">
                            <i class="fas fa-fw fa-home"></i>
                            Beranda @if(request()->route()->named('user.home')) <span class="sr-only">(current)</span> @endif
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-fw fa-cog"></i>
                            Pengaturan Akun
                        </a>
                    </li>
                </ul>

                <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                    <span>Saved reports</span>
                    <a class="d-flex align-items-center text-muted" href="#" aria-label="Add a new report">
                        <i class="fas fa-lg fa-plus-circle"></i>
                    </a>
                </h6>
                <ul class="nav flex-column mb-2">
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-fw fa-file-alt"></i>
                            Current month
                        </a>
                    </li>
                </ul>
@endsection

@section('title')
@yield('title')
@endsection

@section('content')
@yield('content')
@endsection

@section('modal-title')
@yield('modal-title')
@endsection

@section('modal-content')
@yield('modal-content')
@endsection

@section('modal-footer')
@yield('modal-footer')
@endsection

@push('script')
@yield('script')
@endpush