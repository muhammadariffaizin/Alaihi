@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mb-3">
            @if(session('error'))
            <div class="card mb-3 border-0 shadow">
                <div class="card-header bg-danger text-light" role="alert">
                    {{ session('error') }}
                    <button type="button" class="close text-light" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            @endif

            <div class="card mb-3 border-0 shadow">
                <div class="card-header bg-success text-light">{{ __('Daftar Lirik Tersedia') }}</div>

                <div class="card-body">
                    @if($songs->count() > 0)
                        <div class="list-group list-group-flush">
                        @foreach($songs as $song)
                            <div class="list-group-item">
                                <a href="{{ route('song.index',['id'=>$song->id]) }}" class="h5 text-success">{{ $song->name }}</a>
                                <p class="h6">{{ $song->name_alias }}</p>
                                <p>{{ $song->description }}</p>
                            </div>
                        @endforeach
                        </div>
                    @else
                        <p class="h4 text-center">Tidak ada data sholawat</p>
                    @endif
                </div>
            </div>
            <div class="card mb-3 border-0 shadow">
                <div class="card-header bg-success text-light">{{ __('Tambahkan Data Sholawat Baru') }}</div>
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
                                <input type="text" class="form-control" id="name_alias" name="name_alias" required>
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
                                <textarea name="description" class="form-control" id="description" rows="2" required></textarea>
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
        <div class="col-md-4 mb-3">
            <div class="list-group list-group-flush sticky-top sticky-margin">
                <div class="list-group-item pt-0">
                    <div class="card mb-3 border-0 shadow">
                        <div class="card-header bg-success text-light">{{ __('Daftar Genre Tersedia') }}</div>

                        <div class="card-body">
                            @if($genres->count() > 0)
                                <div class="list-group list-group-flush">
                                @foreach($genres as $genre)
                                    <div class="list-group-item">
                                        <a href="{{ route('genre.index',['id'=>$genre->id]) }}" class="h5 text-success">{{ $genre->name }}</a>
                                        <p>{{ $genre->description }}</p>
                                    </div>
                                @endforeach
                                </div>
                            @else
                                <p class="h4 text-center">Tidak ada data genre</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="list-group-item">
                    <p class="h3 mb-3">Tambahkan genre</p>
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
</div>
@endsection
