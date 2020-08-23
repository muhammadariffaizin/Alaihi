@extends('admin.layout')

@section('modal-content')
<p class="h3 p-4 text-center">Memuat..</p>
@endsection

@section('content')
    @includeIf('components.alert')
    <div class="container">
        <div class="row justifiy-content-center">
            <div class="col-md-8 mb-3">
                <div class="row ml-3 justify-content-between">
                    <a href="{{ session('url.intended') }}" class="btn btn-outline-primary border-0 rounded-pill">
                        <i class="fas fa-fw fa-arrow-left"></i>
                    </a>
                    <div>
                        <a id="song_edit" 
                           href="#" 
                           class="btn btn-outline-primary border-0 rounded-pill"
                           data-toggle="modal" 
                           data-target="#pageModal" 
                           data-id="1"
                           data-url="{{ route('song.edit', ['id'=>$id]) }}"
                           data-title="Edit Data Sholawat {{ $songs->name }}"
                           >
                           <i class="fas fa-fw fa-pen"></i>
                        </a>
                        <a id="song_delete" 
                           href="#" 
                           data-id="1" 
                           data-toggle="modal" 
                           data-target="#pageModal" 
                           data-dest="{{ route('song.delete', ['id'=>$id]) }}"
                           data-title="Konfirmasi Hapus Data Sholawat"
                           data-message="Apakah Anda yakin ingin menghapus data sholawat ini?"
                           class="btn btn-outline-danger border-0 rounded-pill"
                           >
                           <i class="fas fa-fw fa-trash-alt"></i>
                        </a>
                    </div>
                </div>
                <div class="list-group list-group-flush">
                    <div class="list-group-item">
                        <a href="{{ route('song.index',['id'=>$songs->id]) }}" class="h1 text-primary">{{ $songs->name }}</a>
                        <div class="d-flex justify-content-between align-items-start">
                            <p class="h5">{{ $songs->name_alias }}</p>
                            <small class="text-black-50">diperbarui {{ Carbon\Carbon::parse($songs->updated_at)->diffForHumans() }}</small>
                        </div>
                        <p>{{ $songs->description }}</p>
                    </div>
                    <div class="list-group-item">
                        @if($lyrics->count() > 0)
                            <h5 class="d-flex justify-content-between align-items-center mb-3">
                                <span class="text-muted">Versi sholawat yang tersedia</span>
                                <span class="badge badge-primary badge-pill">{{ $lyrics->count() }}</span>
                            </h5>
                            @foreach($lyrics as $key => $lyric)
                                <div class="card my-3 border-0 shadow">
                                    <div class="card-header bg-primary">
                                        <h4 class="d-flex justify-content-between align-items-center card-title">
                                            <span class="text-light">{{ $lyric->version }}</span>
                                            <a class="text-light pr-1" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <small>
                                                    <i class="fa fa-sm fa-ellipsis-v"></i>
                                                </small>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                                                <a id="lyric_edit" 
                                                   href="#"
                                                   class="dropdown-item" 
                                                   data-toggle="modal" 
                                                   data-target="#pageModal" 
                                                   data-id="{{ $key+1 }}"
                                                   data-url="{{ route('lyric.edit', ['id'=>$lyric->id]) }}"
                                                   data-title="Edit Versi Sholawat {{ $lyric->version }}"
                                                   >Edit</a>
                                                <a class="dropdown-item" 
                                                   href="{{ route('lyric.duplicate', ['id'=>$lyric->id]) }}"
                                                   >Duplikat</a>
                                                <a id="lyric_delete" 
                                                   href="#"
                                                   class="dropdown-item" 
                                                   data-id="{{ $lyric->id }}" 
                                                   data-toggle="modal" 
                                                   data-target="#pageModal" 
                                                   data-dest="{{ route('lyric.delete', ['id'=>$lyric->id]) }}"
                                                   data-title="Konfirmasi Hapus Data Versi Sholawat"
                                                   data-message="Apakah Anda yakin ingin menghapus data versi sholawat ini?"
                                                   >Hapus</a>
                                            </div>
                                        </h4>
                                        <p class="card-text text-light">{{ $lyric->description }}</p>
                                        <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                                            @foreach($lyric->sublyric as $keysub => $sublyric)
                                                <li class="nav-item" role="presentation">
                                                    <a id="add-tab_{{ $key+1 }}_{{ $keysub+1 }}" 
                                                       href="#add_{{ $key+1 }}_{{ $keysub+1 }}" 
                                                       class="nav-link text-light{{ $keysub+1 === 1 ? ' active' : '' }}"
                                                       role="tab" 
                                                       data-toggle="tab" 
                                                       aria-controls="add" 
                                                       aria-selected="true"
                                                       >{{ $sublyric->lyric_language }}</a>
                                                </li>
                                            @endforeach
                                            <li class="nav-item" role="presentation">
                                                <a id="add-tab_{{ $key+1 }}" 
                                                   href="#add_{{ $key+1 }}" 
                                                   class="nav-link text-light{{ count($lyric->sublyric) === 0 ? ' active' : '' }}" 
                                                   role="tab" 
                                                   data-toggle="tab" 
                                                   aria-controls="add" 
                                                   aria-selected="true"
                                                   ><i class="fa fa-sm fa-plus"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="card-body tab-content">
                                        @foreach($lyric->sublyric as $keysub => $sublyric)
                                            <div id="add_{{ $key+1 }}_{{ $keysub+1 }}" 
                                                class="tab-pane fade show{{ $keysub+1 === 1 ? ' active' : '' }}" 
                                                role="tabpanel" 
                                                aria-labelledby="add-tab_{{ $key+1 }}_{{ $keysub+1 }}">
                                                <p class="text-black-50 text-right">diperbarui {{ Carbon\Carbon::parse($sublyric->updated_at)->diffForHumans() }}</p>
                                                <div class="{{ $sublyric->lyric_language == 'Arab' ? 'arabic-font' : '' }}">
                                                    @foreach(json_decode($sublyric->lyric_content) as $content)
                                                    <p>{{ $content }}</p>
                                                    @endforeach
                                                </div>
                                                <a id="lyric_sub_edit" 
                                                   href="#" 
                                                   class="btn btn-outline-primary border-0 rounded-pill"
                                                   data-toggle="modal" 
                                                   data-target="#pageModal" 
                                                   data-id="{{ $key+1 }}"
                                                   data-url="{{ route('sublyric.edit',['id'=>$sublyric->id]) }}"
                                                   data-title="Edit Lirik Versi {{ $lyric->version }}"
                                                   ><i class="fas fa-fw fa-sm fa-pen"></i></a>
                                                <a id="lyric_sub_delete" 
                                                   href="#" 
                                                   class="btn btn-outline-danger border-0 rounded-pill"
                                                   data-id="{{ $lyric->id }}_{{ $sublyric->id }}" 
                                                   data-toggle="modal" 
                                                   data-target="#pageModal" 
                                                   data-dest="{{ route('sublyric.delete', ['id'=>$sublyric->id]) }}"
                                                   data-title="Komfirmasi Hapus Data Lirik Sholawat"
                                                   data-message="Apakah Anda yakin ingin menghapus data lirik sholawat ini?"
                                                   ><i class="fas fa-fw fa-sm fa-trash-alt"></i></a>
                                            </div>
                                        @endforeach
                                        <div id="add_{{ $key+1 }}" 
                                             class="tab-pane fade show{{ count($lyric->sublyric) === 0 ? ' active' : '' }}" 
                                             role="tabpanel" 
                                             aria-labelledby="add-tab_{{ $key+1 }}">
                                            <a id="lyric_sub_add" 
                                               href="#" 
                                               class="btn btn-primary" 
                                               data-toggle="modal" 
                                               data-target="#pageModal" 
                                               data-id="{{ $key+1 }}" 
                                               data-url="{{ route('sublyric.index',['id'=>$lyric->id]) }}" 
                                               data-title="Buat Lirik Baru untuk Versi {{ $lyric->version }}"
                                            >Tambahkan lirik</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p class="h4 text-center">Tidak ada data versi sholawat</p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card mb-3 border-0 shadow sticky-top sticky-margin">
                    <div class="card-header bg-transparent border-0 px-4 pt-4 h5">Tambahkan versi sholawat</div>
                    <div class="card-body">
                        <form action="{{ route('lyric.create') }}" method="POST" class="form needs-validation" novalidate>
                            @csrf
                            <input type="text" name="id" value="{{ $songs->id }}" hidden>
                            <div class="form-row">
                                <div class="col-12 mb-3">
                                    <label for="version">Versi</label>
                                    <input name="version" type="text" class="form-control" id="version" required>
                                    <div class="invalid-feedback">
                                        Harus diisi.
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-12 mb-3">
                                    <label for="description">Deskripsi</label>
                                    <textarea name="description" class="form-control" id="description" rows="2" required></textarea>
                                    <div class="invalid-feedback">
                                        Harus diisi.
                                    </div>
                                </div>
                            </div>
                            
                            <button class="btn btn-primary" type="submit">Tambahkan versi</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts_after')
    
    window.addEventListener('load', () => {
        const modal_element = document.querySelector('#pageModalContent');
        const failed_modal = `<p class="h3 p-4 text-center">Ada yang salah, silahkan coba lagi...</p>`;
        
        const modal_sub_call = document.querySelectorAll('#lyric_sub_add, #lyric_sub_edit');
        const modal_lyric_call = document.querySelectorAll('#lyric_edit');
        const modal_song_call = document.querySelectorAll('#song_edit');
        const modal_confirm_call = document.querySelectorAll('#song_delete, #lyric_delete, #lyric_sub_delete');

        modal_confirm_call.forEach((item) => {
            item.addEventListener('click', (e) => {
                e.preventDefault();

                const id = item.getAttribute('data-id');
                const title = item.getAttribute('data-title');
                const dest = item.getAttribute('data-dest');
                const message = '<p class=" pt-3 text-center">' + item.getAttribute('data-message') + '</p>';

                ModalHandler_Confirm.init(id, title, modal_element, message, dest);
            })
        });
        
        modal_sub_call.forEach((item) => {
            item.addEventListener('click', (e) => {
                e.preventDefault();

                const id = item.getAttribute('data-id');
                const url = item.getAttribute('data-url');
                const title = item.getAttribute('data-title');

                ModalHandler_SubLyric.init(id, url, title, modal_element, failed_modal);
            });
        });

        modal_lyric_call.forEach((item) => {
            item.addEventListener('click', (e) => {
                e.preventDefault();

                const id = item.getAttribute('data-id');
                const url = item.getAttribute('data-url');
                const title = item.getAttribute('data-title');

                ModalHandler_Lyric.init(id, url, title, modal_element, failed_modal);
            });
        });

        modal_song_call.forEach((item) => {
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
