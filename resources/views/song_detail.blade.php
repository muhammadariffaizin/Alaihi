@extends('layouts.app')

@section('modal-content')
    <p class="h3 p-4 text-center">Memuat..</p>
@endsection

@section('content')
    <div class="container">
        <div class="row justifiy-content-center">
            <div class="col-md-8 mb-3">
                <div class="row ml-3">
                    <a href="{{ route('home') }}" class="btn btn-link text-success">Kembali ke halaman utama</a>
                    <a id="song_edit" 
                       href="#" 
                       class="btn btn-link text-success"
                       data-toggle="modal" 
                       data-target="#pageModal" 
                       data-id="1"
                       data-url="{{ route('song.edit', ['id'=>$id]) }}"
                       data-title="Edit Data Sholawat {{ $songs->name }}"
                       >Edit</a>
                    <a id="song_delete" 
                       href="{{ route('song.delete', ['id'=>$id]) }}" 
                       class="btn btn-link text-success"
                       >Hapus</a>
                </div>
                <div class="list-group list-group-flush">
                    <div class="list-group-item">
                        <a href="{{ url('/song', $songs->id) }}" class="h1 text-success">{{ $songs->name }}</a>
                        <p class="h5">{{ $songs->name_alias }}</p>
                        <p>{{ $songs->description }}</p>
                    </div>
                    <div class="list-group-item">
                        @if($lyrics->count() > 0)
                            <h5 class="d-flex justify-content-between align-items-center mb-3">
                                <span class="text-muted">Versi sholawat yang tersedia</span>
                                <span class="badge badge-success badge-pill">{{ $lyrics->count() }}</span>
                            </h5>
                            @foreach($lyrics as $key => $lyric)
                                <div class="card border-success my-3">
                                    <div class="card-header">
                                        <h4 class="d-flex justify-content-between align-items-center card-title">
                                            <span class="text-muted">{{ $lyric->version }}</span>
                                            <a class="btn bg-transparent rounded-pill text-muted" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fa fa-sm fa-ellipsis-v"></i>
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
                                                   href="{{ route('lyric.delete', ['id'=>$lyric->id]) }}"
                                                   >Hapus</a>
                                            </div>
                                        </h4>
                                        <p class="card-text">{{ $lyric->description }}</p>
                                        <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                                            @foreach($lyric->sublyric as $keysub => $sublyric)
                                                <li class="nav-item" role="presentation">
                                                    <a id="add-tab_{{ $key+1 }}_{{ $keysub+1 }}" 
                                                       href="#add_{{ $key+1 }}_{{ $keysub+1 }}" 
                                                       class="nav-link text-success{{ $keysub+1 === 1 ? ' active' : '' }}"
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
                                                   class="nav-link text-success{{ count($lyric->sublyric) === 0 ? ' active' : '' }}" 
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
                                                @foreach(json_decode($sublyric->lyric_content) as $content)
                                                    <p>{{ $content }}</p>
                                                @endforeach
                                                <a id="lyric_sub_edit" 
                                                   href="#" 
                                                   class="btn btn-link text-success"
                                                   data-toggle="modal" 
                                                   data-target="#pageModal" 
                                                   data-id="{{ $key+1 }}"
                                                   data-url="{{ route('sublyric.edit',['id'=>$sublyric->id]) }}"
                                                   data-title="Edit Lirik Versi {{ $lyric->version }}"
                                                   >Edit</a>
                                                <a id="lyric_sub_delete" 
                                                   href="{{ route('sublyric.delete', ['id'=>$sublyric->id]) }}" 
                                                   class="btn btn-link text-danger"
                                                   >Hapus</a>
                                            </div>
                                        @endforeach
                                        <div id="add_{{ $key+1 }}" 
                                             class="tab-pane fade show{{ count($lyric->sublyric) === 0 ? ' active' : '' }}" 
                                             role="tabpanel" 
                                             aria-labelledby="add-tab_{{ $key+1 }}">
                                            <a id="lyric_sub_add" 
                                               href="#" 
                                               class="btn btn-success" 
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
                <div class="list-group list-group-flush sticky-top sticky-margin">
                    <div class="list-group-item">
                        <p class="h3 mb-3">Tambahkan versi sholawat</p>
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
                            
                            <button class="btn btn-success" type="submit">Tambahkan versi</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    let ModalHandler_SubLyric = new ModalSubLyric();
    let ModalHandler_Lyric = new ModalLyric();
    
    window.addEventListener('load', () => {
        const modal_element = document.querySelector('#pageModalContent');
        const failed_modal = `<p class="h3 p-4 text-center">Ada yang salah, silahkan coba lagi...</p>`;
        
        const song_edit_call = document.querySelectorAll('#song_edit');
        const lyric_edit_call = document.querySelectorAll('#lyric_edit');
        const lyric_sub_add_call = document.querySelectorAll('#lyric_sub_add');
        const lyric_sub_edit_call = document.querySelectorAll('#lyric_sub_edit');

        lyric_sub_add_call.forEach((item) => {
            item.addEventListener('click', (e) => {
                e.preventDefault();

                const id = item.getAttribute('data-id');
                const url = item.getAttribute('data-url');
                const title = item.getAttribute('data-title');

                ModalHandler_SubLyric.init(id, url, title, modal_element, failed_modal);
            });
        });

        lyric_sub_edit_call.forEach((item) => {
            item.addEventListener('click', (e) => {
                e.preventDefault();

                const id = item.getAttribute('data-id');
                const url = item.getAttribute('data-url');
                const title = item.getAttribute('data-title');

                ModalHandler_SubLyric.init(id, url, title, modal_element, failed_modal);
            });
        });

        lyric_edit_call.forEach((item) => {
            item.addEventListener('click', (e) => {
                e.preventDefault();

                const id = item.getAttribute('data-id');
                const url = item.getAttribute('data-url');
                const title = item.getAttribute('data-title');

                ModalHandler_Lyric.init(id, url, title, modal_element, failed_modal);
            });
        });

        song_edit_call.forEach((item) => {
            item.addEventListener('click', (e) => {
                e.preventDefault();

                const id = item.getAttribute('data-id');
                const url = item.getAttribute('data-url');
                const title = item.getAttribute('data-title');

                ModalHandler_Lyric.init(id, url, title, modal_element, failed_modal);
            });
        });
    });
@endpush
