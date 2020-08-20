@extends('admin.layout')

@section('modal-content')
<p class="h3 p-4 text-center">Memuat..</p>
@endsection

@section('content')
@includeIf ('components.alert')
<div class="px-4 pt-4 pb-2">
    <h1 class="h4">Selamat Datang!</h1>
    <p>{{ Auth::user()->name }}</p>
</div>
<div class="container">
    <div class="row justify-content-center mb-3">
        <div class="col-md-4 mb-4">
            <div class="card mb-3 border-0 shadow h-100">
                <div class="d-flex justify-content-left flex-md-wrap flex-lg-nowrap">
                    <div class="rounded bg-success border-0 shadow text-light card-icon">
                        <i class="fas fa-3x fa-save p-4"></i>
                    </div>
                    <div class="card-header bg-transparent border-0 pt-4 pl-0 pl-md-4 h5">
                            {{ __('Statistik Sholawat') }}
                    </div>
                </div>
                <div class="card-body">
                    <div class="list-group row list-group-flush">
                        <div class="list-group-item d-flex justify-content-between">
                            <span class="h1">{{ $songs->total() }}</span>
                            <span class="pl-3 text-muted text-right">Sholawat Tersedia</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8 mb-4">
            <div class="card mb-3 border-0 shadow h-100">
                <div class="d-flex justify-content-left flex-md-wrap flex-lg-nowrap">
                    <div class="rounded bg-success border-0 shadow text-light card-icon">
                        <i class="fas fa-3x fa-crosshairs p-4"></i>
                    </div>
                    <div class="card-header bg-transparent border-0 pt-4 pl-0 pl-md-4 h5">
                            {{ __('Target Data Sholawat') }}
                    </div>
                </div>
                <div class="card-body d-flex flex-column justify-content-around">
                    <span>Jumlah data sholawat yang tersedia dibandingkan dengan target yang telah ditetapkan</span>
                    <div class="progress mt-2">
                        <div class="progress-bar bg-success" role="progressbar" style="width: {{ $songs->total() }}%" aria-valuenow="{{ $songs->total() }}" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <span>{{ $songs->total() }} dari 100</span>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-8 mb-3">
            <div class="card mb-3 border-0 shadow">
                <div class="card-header bg-transparent border-0 px-4 pt-4 h5">
                    <div class="d-flex justify-content-between align-items-center p-0">
                        {{ __('Sholawat Terbaru') }}
                        @if($songs->total() > 3)
                            <small><a href="{{ route('song.list') }}" class="text-sm text-success">lihat selengkapnya</a></small>
                        @endif
                    </div>
                </div>

                <div class="card-body pt-0">
                    @if($songs->count() > 0)
                    <div class="list-group list-group-flush">
                        @foreach($songs as $song)
                        <div class="list-group-item row d-flex flex-row">
                            <div class="col-sm-9 px-0">
                                <a href="{{ route('song.index',['id'=>$song->id]) }}"
                                    class="h5 text-success"><strong>{{ $song->name }}</strong></a>
                                <p class="mb-0 text-description">{{ $song->description }}</p>
                            </div>
                            <div class="col-sm-3 px-0 text-right justify-content-center align-self-center">
                                <h3 class="@if($song->lyric->count() > 0) text-success @else text-danger @endif">
                                    {{ $song->lyric->count() }}</h3>
                                <span>Versi lirik</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <p class="h4 text-center">Tidak ada data sholawat</p>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-lg-4 mb-3">
            <div class="card mb-3 border-0 shadow">
                <div class="card-header bg-transparent border-0 px-4 pt-4 h5">{{ __('Genre Tersedia') }}</div>

                <div class="card-body pt-0">
                    @if($genres->count() > 0)
                    <div class="list-group list-group-flush ">
                        @foreach($genres as $key => $genre)
                        <div class="list-group-item row d-flex flex-row">
                            <div class="col-sm-8 px-0">
                                <a id="genre_edit" 
                                   href="#" 
                                   class="h5 text-success"
                                   data-toggle="modal" 
                                   data-target="#pageModal" 
                                   data-id="{{ $key+1 }}"
                                   data-url="{{ route('genre.edit',['id'=>$genre->id]) }}"
                                   data-title="Edit Genre {{ $genre->name }}"
                                   ><strong>{{ $genre->name }}</strong></a>
                                <p class="mb-0 text-description">{{ $genre->description }}</p>
                            </div>
                            <div class="col-sm-4 px-0 text-right justify-content-center align-self-center">
                                <h3 class="@if($genre->song->count() > 0) text-success @else text-danger @endif">
                                    {{ $genre->song->count() }}</h3>
                                <span>Data sholawat</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <p class="h4 text-center">Tidak ada data genre</p>
                    @endif
                </div>
            </div>
            <div class="card mb-3 border-0 shadow">
                <div class="card-header bg-transparent border-0 px-4 pt-4 h5">{{ __('Tambahkan Data Genre Baru') }}
                </div>
                <div class="card-body">
                    <form action="{{ route('genre.create') }}" method="POST" class="form needs-validation" novalidate>
                        @csrf
                        <div class="form-row">
                            <div class="col-12 mb-3">
                                <label for="name">Nama</label>
                                <input name="name" type="text" class="form-control" id="name" required>
                                <div class="invalid-feedback">
                                    Harus diisi.
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-12 mb-3">
                                <label for="description">Deskripsi</label>
                                <textarea name="description" class="form-control" id="description" rows="2"
                                    required></textarea>
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

@push('scripts_after')
    let ModalHandler_Genre = new ModalGenre();

    window.addEventListener('load', () => {
        const modal_element = document.querySelector('#pageModalContent');
        const failed_modal = `<p class="h3 p-4 text-center">Ada yang salah, silahkan coba lagi...</p>`;
        
        const modal_genre_call = document.querySelectorAll('#genre_edit');

        modal_genre_call.forEach((item) => {
            item.addEventListener('click', (e) => {
                e.preventDefault();

                const id = item.getAttribute('data-id');
                const url = item.getAttribute('data-url');
                const title = item.getAttribute('data-title');

                ModalHandler_Genre.init(id, url, title, modal_element, failed_modal);
            });
        });
    });
@endpush