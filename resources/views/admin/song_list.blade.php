@extends('admin.layout')

@section('content')
@includeIf('components.alert')
<div class="px-4 pt-4 pb-2">
    <h1 class="h4">Daftar Sholawat yang Tersedia</h1>
    <p>Daftar sholawat yang tersedia berdasarkan waktu dibuat.</p>
</div>
<div class="container">
    <form id="form_search" class="form" action="{{ route('song.search') }}" method="GET">
        <div class="row justify-content-between align-items-center">
            <div class="col-md-8">
                <div class="input-group border-0 shadow mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text border-0 bg-primary text-light" id="searchaddon"><i class="fas fa-search"></i></span>
                    </div>
                    <input id="search" class="form-control border-0 ml-1" type="text" name="search" placeholder="Cari di sini.." aria-label="Search" aria-describedby="searchaddon">
                </div>
            </div>
        </div>
    </form>
    <p class="h6 mb-4">Menampilkan {{ $songs->firstItem() }} - {{ $songs->lastItem() }} dari {{ $songs->total() }}
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
                                    class="h5 text-primary"><strong>{{ $song->name }}</strong></a>
                                <p class="mb-0 text-description">{{ $song->description }}</p>
                            </div>
                            <div class="col-sm-3 px-0 text-right justify-content-center align-self-center">
                                <h3 class="@if($song->lyric->count() > 0) text-primary @else text-danger @endif">
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