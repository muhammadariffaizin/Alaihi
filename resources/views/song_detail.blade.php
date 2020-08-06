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
                    <a href="" class="btn btn-link text-success">Edit</a>
                    <a href="" class="btn btn-link text-success">Hapus</a>
                </div>
                <div class="list-group list-group-flush">
                    <div class="list-group-item">
                        <a href="{{ url('/song', $songs->id) }}" class="h1 text-success">{{ $songs->name }}</a>
                        <p class="h5">{{ $songs->name_alias }}</p>
                        <p>{{ $songs->description }}</p>
                    </div>
                    <div class="list-group-item">
                        @if($lyrics->count() > 0)
                            <h4 class="d-flex justify-content-between align-items-center mb-3">
                                <span class="text-muted">Versi sholawat yang tersedia</span>
                                <span class="badge badge-success badge-pill">{{ $lyrics->count() }}</span>
                            </h4>
                            @foreach($lyrics as $key => $lyric)
                                <div class="card border-success my-3">
                                    <div class="card-header">
                                        <h4 class="card-title">{{ $lyric->version }}</h4>
                                        <p class="card-text">{{ $lyric->description }}</p>
                                        <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link text-success active" id="add-tab_{{ $key+1 }}" data-toggle="tab" href="#add_{{ $key+1 }}" role="tab" aria-controls="add" aria-selected="true">Tambah</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="card-body tab-content">
                                        <div class="tab-pane fade show active" id="add_{{ $key+1 }}" role="tabpanel" aria-labelledby="add-tab_{{ $key+1 }}">
                                            <a id="addLyric" href="#" class="btn btn-success" data-toggle="modal" data-target="#pageModal" data-url="{{ route('sub_lyric.index',['id'=>$lyric->id]) }}">Tambahkan lirik</a>
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
    window.addEventListener('load', () => {
        const sendElement = document.querySelectorAll('#addLyric');
        const modalElement = document.querySelector('#pageModalContent');
        const failedModal = `<p class="h3 p-4 text-center">Ada yang salah, silahkan coba lagi...</p>`;
        load_modal(sendElement, modalElement, failedModal);
    });
    window.addEventListener('load', () => {
        const callModal = document.querySelectorAll('#addLyric');
        callModal.forEach((item) => {
            item.addEventListener('click', (e) => {
                e.preventDefault();

                const url = item.getAttribute('data-url');
                console.log(url);

                <!-- const ModalItem = new ModalPopup(); -->
            });
        });
    });
@endpush
