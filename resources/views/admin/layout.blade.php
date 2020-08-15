@extends('layouts.dashboard')

@section('sidebar')
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link {{ (request()->route()->named('admin.home')) ? 'active' : '' }}" href="{{ route('admin.home') }}">
                            <i class="fas fa-fw fa-home"></i>
                            Beranda @if(request()->route()->named('admin.home')) <span class="sr-only">(current)</span> @endif
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ (request()->route()->named('song.list')) ? 'active' : '' }}" href="{{ route('song.list') }}">
                            <i class="fas fa-fw fa-praying-hands"></i>
                            Sholawat @if(request()->route()->named('song.list')) <span class="sr-only">(current)</span> @endif
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-fw fa-paper-plane"></i>
                            Permintaan 
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ (request()->route()->named('admin.settings')) ? 'active' : '' }}" href="{{ route('admin.settings') }}">
                            <i class="fas fa-fw fa-cog"></i>
                            Pengaturan @if(request()->route()->named('admin.settings')) <span class="sr-only">(current)</span> @endif
                        </a>
                    </li>
                </ul>

                <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                    <span>Antrian</span>
                    <a class="d-flex align-items-center text-muted" href="#" aria-label="Tambahkan antrian">
                        <i class="fas fa-lg fa-plus-circle"></i>
                    </a>
                </h6>
                <ul class="nav flex-column mb-2">
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-fw fa-file-alt"></i>
                            Proses permintaan
                        </a>
                    </li>
                </ul>
@endsection
