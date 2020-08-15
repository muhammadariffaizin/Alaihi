@extends('user.layout')

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
    <div class="row justify-content-center">
        <div class="col-md-8 mb-3">
            <div class="card mb-3 border-0 shadow">
                <div class="card-header bg-success border-0 text-light">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    Halo user!
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
