<form action="{{ route('lyric.update') }}" method="POST" class="form needs-validation" novalidate>
    <div class="modal-body">
        @csrf
        <input type="text" name="id" value="{{ $id }}" hidden>
        <div class="form-row mb-3">
            <label for="version">{{ __('Versi') }}</label>
            <input id="version" type="text" class="form-control" name="version" value="{{ $lyric->version }}" required>
            <div class="invalid-feedback">
                Harus diisi.
            </div>
        </div>
        <div class="form-row">
            <label for="description">{{ __('Deskripsi') }}</label>
            <textarea id="description" type="text" class="form-control" name="description" required>{{ $lyric->description }}</textarea>
            <div class="invalid-feedback">
                Harus diisi.
            </div>
        </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary btn-light" data-dismiss="modal">Batalkan</button>
        <button type="submit" class="btn btn-success">Perbarui versi</button>
    </div>
</form>
