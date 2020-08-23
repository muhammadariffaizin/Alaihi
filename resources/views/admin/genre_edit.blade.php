<form action="{{ route('genre.update') }}" method="POST" class="form needs-validation" novalidate>
    <div class="modal-body">
        @csrf
        <input type="text" name="id" value="{{ $id }}" hidden>
        <div class="form-row mb-3">
            <label for="version">{{ __('Nama') }}</label>
            <input id="version" type="text" class="form-control" name="version" value="{{ $genre->name }}" required>
            <div class="invalid-feedback">
                Harus diisi.
            </div>
        </div>
        <div class="form-row">
            <label for="description">{{ __('Deskripsi') }}</label>
            <textarea id="description" type="text" class="form-control" name="description" required>{{ $genre->description }}</textarea>
            <div class="invalid-feedback">
                Harus diisi.
            </div>
        </div>
        </div>
    </div>
    <div class="modal-footer justify-content-between">
        <a href="{{ route('genre.delete', ['id' => $id]) }}" class="btn btn-danger">Hapus genre</a>
        <div>
            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Batalkan</button>
            <button type="submit" class="btn btn-primary">Perbarui genre</button>
        </div>
    </div>
</form>
