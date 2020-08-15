@extends('admin.layout')

@section('title')
<div class="px-4 pt-4 pb-2">
    <h1 class="h4">Daftar Sholawat yang Tersedia</h1>
    <p>Daftar sholawat yang tersedia berdasarkan waktu dibuat.</p>
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
    <form id="form_search" class="form" action="{{ route('song.search') }}" method="GET">
        <div class="row justify-content-between align-items-center">
            <div class="col-md-8">
                <div class="rounded bg-success border-0 shadow">
                    <input id="search" class="form-control border-0 ml-1" type="text" name="search" placeholder="Cari di sini.." aria-label="Search">
                </div>
            </div>
        </div>
    </form>
    <p class="h6 my-4">Menampilkan {{ $songs->firstItem() }} - {{ $songs->lastItem() }} dari {{ $songs->total() }}
            lirik sholawat</p>
    <div class="row justify-content-center">
        <div class="col mb-3">
            <div class="card mb-3 border-0 shadow">
                <div class="card-body pt-0">
                    @if($songs->count() > 0)
                    <div class="list-group list-group-flush pt-3">
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
    </div>
    <div class="row justify-content-center mt-4">{{ $songs->appends(request()->input())->links() }}</div>
</div>
@endsection