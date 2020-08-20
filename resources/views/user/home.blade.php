@extends('user.layout')

@section('content')
@includeIf('components.alert')
<div class="container">
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
