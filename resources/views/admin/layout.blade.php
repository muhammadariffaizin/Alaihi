@extends('layouts.dashboard')

@section('sidebar')
                <ul class="nav flex-column">
                    <li class="nav-item border-bottom mb-3">
                        <a id="song_add" 
                           href="#" 
                           class="btn btn-primary border-0 shadow rounded-pill mx-4 my-3"
                           data-toggle="modal" 
                           data-target="#pageModal" 
                           data-id="0"
                           data-url="{{ route('song.add') }}"
                           data-title="Tambahkan Data Sholawat Baru"
                           >
                           <i class="fas fa-fw fa-plus"></i>
                           Tambah Sholawat
                        </a>
                    </li>

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

@push('scripts_component')
    window.addEventListener('load', () => {
        const modal_element = document.querySelector('#pageModalContent');
        const failed_modal = `<p class="h3 p-4 text-center">Ada yang salah, silahkan coba lagi...</p>`;
        
        const modal_add_song_call = document.querySelectorAll('#song_add');
        
        modal_add_song_call.forEach((item) => {
            item.addEventListener('click', (e) => {
                e.preventDefault();

                const id = item.getAttribute('data-id');
                const url = item.getAttribute('data-url');
                const title = item.getAttribute('data-title');

                ModalHandler_Song.init(id, url, title, modal_element, failed_modal);
            });
        });
    });
@endpush