<form action="{{ route('song.update') }}" method="POST" class="form needs-validation" novalidate>
    <div class="modal-body">
        @csrf
        <input type="text" name="id" value="{{ $id }}" hidden>
        <div class="form-row">
            <div class="col-12 mb-3">
                <label for="name">Judul sholawat</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $song->name }}" required>
                <div class="invalid-feedback">
                    Harus diisi.
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-6 mb-3">
                <label for="name_alias">Nama lain</label>
                <input type="text" class="form-control" id="name_alias" name="name_alias" value="{{ $song->name_alias }}">
                <div class="invalid-feedback">
                    Harus diisi.
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <label for="genre">Jenis</label>
                <select class="custom-select" id="genre" name="genre" required>
                    <option disabled value="">Pilih...</option>
                    @foreach($genres as $genre)
                    <option value="{{ $genre->id }}"{{ $song->genre_id == $genre->id ? ' selected' : '' }}>{{ $genre->name }}</option>
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
                <textarea name="description" class="form-control" id="description" rows="2" required>{{ $song->description }}</textarea>
                <div class="invalid-feedback">
                    Harus diisi.
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col-12 mb-3">
                <label for="source">Sumber</label>
                <textarea name="source" class="form-control" id="source" rows="3" required>{{ $song->source }}</textarea>
                <div class="invalid-feedback">
                    Harus diisi.
                </div>
            </div>
        </div>
    </div>
    
    <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary btn-light" data-dismiss="modal">Batalkan</button>
        <button type="submit" class="btn btn-success">Perbarui sholawat</button>
    </div>
</form>