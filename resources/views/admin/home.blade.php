@extends('admin.layout')

@section('title')
<div class="px-4 pt-4 pb-2">
    <h1 class="h4">Selamat Datang!</h1>
    <p>{{ Auth::user()->name }}</p>
</div>
@endsection

@section('content')
<div class="container">
    @if(session('error'))
    <div class="alert alert-danger border-0 shadow" role="alert">
        {{ session('error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    @foreach($errors->all() as $error)
    <div class="alert alert-danger border-0 shadow" role="alert">
        {{ $error }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endforeach
    @if(session('success'))
    <div class="alert alert-success border-0 shadow" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    <div class="row justify-content-center mb-3">
        <div class="col-md-3 mb-3">
            <div class="card mb-3 border-0 shadow h-100">
                <div class="card-header bg-transparent border-0 px-4 pt-4 h5">
                    <div class="d-flex justify-content-between align-items-center p-0">
                        {{ __('Sholawat Tersedia') }}
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="d-flex justify-content-around align-items-center">
                        <div class="display-4">{{ $songs->total() }}</div>
                        <div class="d-flex flex-column align-items-start">
                            <span class="badge badge-success badge-pill">ditambahkan</span>
                            <span class="text-muted">Data Sholawat</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-9 mb-3">
            <div class="card mb-3 border-0 shadow h-100">
                <div class="card-header bg-transparent border-0 px-4 pt-4 h5">
                    <div class="d-flex justify-content-between align-items-center p-0">
                        {{ __('Target Data Sholawat') }}
                    </div>
                </div>
                <div class="card-body pt-0">
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
            <div class="card mb-3 border-0 shadow">
                <div class="card-header bg-transparent border-0 px-4 pt-4 h5">{{ __('Tambahkan Data Sholawat Baru') }}
                </div>
                <div class="card-body">
                    <form action="{{ route('song.create') }}" method="POST" class="form needs-validation" novalidate>
                        @csrf
                        <div class="form-row">
                            <div class="col-12 mb-3">
                                <label for="name">Judul sholawat</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                                <div class="invalid-feedback">
                                    Harus diisi.
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label for="name_alias">Nama lain</label>
                                <input type="text" class="form-control" id="name_alias" name="name_alias">
                                <div class="invalid-feedback">
                                    Harus diisi.
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="genre">Jenis</label>
                                <select class="custom-select" id="genre" name="genre" required>
                                    <option selected disabled value="">Pilih...</option>
                                    @foreach($genres as $genre)
                                    <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    Pilih salah satu.
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
                        <div class="form-row">
                            <div class="col-12 mb-3">
                                <label for="source">Sumber</label>
                                <textarea name="source" class="form-control" id="source" rows="3" required></textarea>
                                <div class="invalid-feedback">
                                    Harus diisi.
                                </div>
                            </div>
                        </div>

                        <button class="btn btn-success" type="submit">Tambahkan Sholawat</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-4 mb-3">
            <div class="card mb-3 border-0 shadow">
                <div class="card-header bg-transparent border-0 px-4 pt-4 h5">{{ __('Genre Tersedia') }}</div>

                <div class="card-body pt-0">
                    @if($genres->count() > 0)
                    <div class="list-group list-group-flush ">
                        @foreach($genres as $genre)
                        <div class="list-group-item row d-flex flex-row">
                            <div class="col-sm-8 px-0">
                                <a href="{{ route('genre.index',['id'=>$genre->id]) }}"
                                    class="h5 text-success"><strong>{{ $genre->name }}</strong></a>
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
