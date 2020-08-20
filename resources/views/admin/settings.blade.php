@extends('admin.layout')

@section('content')
@includeIf('components.alert')
<div class="px-4 pt-4 pb-2">
    <h1 class="h4">Pengaturan</h1>
</div>
<div class="container">
    <div class="row">
        <div class="col-lg-6 mb-3">
            <div class="card mb-3 border-0 shadow">
                <div class="card-header bg-transparent border-0 px-4 pt-4 h5">{{ __('Edit Profil Akun') }}</div>
                <div class="card-body">
                    <form action="{{ route('admin.update') }}" method="POST" class="form needs-validation" novalidate>
                        @csrf
                        <input type="text" name="id" value="{{ Auth::user()->id }}" hidden>
                        <div class="form-row">
                            <div class="col-12 mb-3">
                                <label for="name">Nama</label>
                                <input name="name" type="text" class="form-control" id="name" value="{{ Auth::user()->name }}" required>
                                <div class="invalid-feedback">
                                    Harus diisi.
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-12 mb-3">
                                <label for="email">Email</label>
                                <input name="email" type="email" class="form-control" id="email" value="{{ Auth::user()->email }}" required>
                                <div class="invalid-feedback">
                                    Harus diisi.
                                </div>
                            </div>
                        </div>
                        
                        <button class="btn btn-success" type="submit">Perbarui Profil</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-6 mb-3">
            <div class="card mb-3 border-0 shadow">
                <div class="card-header bg-transparent border-0 px-4 pt-4 h5">{{ __('Perbarui Sandi') }}</div>
                <div class="card-body">
                    <form action="{{ route('admin.password') }}" method="POST" class="form needs-validation" novalidate>
                        @csrf
                        <input type="text" name="id" value="{{ Auth::user()->id }}" hidden>
                        <div class="form-row">
                            <div class="col-12 mb-3">
                                <label for="old_password">Sandi Lama</label>
                                <input name="old_password" type="password" class="form-control" id="old_password" required>
                                <div class="invalid-feedback">
                                    Harus diisi.
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-12 mb-3">
                                <label for="new_password">Sandi Baru</label>
                                <input name="new_password" type="password" class="form-control" id="new_password" required>
                                <div class="invalid-feedback">
                                    Harus diisi.
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-12 mb-3">
                                <label for="new_confirm_password">Ulangi Sandi Baru</label>
                                <input name="new_confirm_password" type="password" class="form-control" id="new_confirm_password" required>
                                <div class="invalid-feedback">
                                    Harus diisi.
                                </div>
                            </div>
                        </div>
                        
                        <button class="btn btn-success" type="submit">Perbarui Sandi</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection