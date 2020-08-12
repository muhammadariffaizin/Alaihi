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
                <div class="card-header bg-success text-light">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    Halo user!
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
