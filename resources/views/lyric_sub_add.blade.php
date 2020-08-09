<script>
    ModalHandler_SubLyric.parent = document.querySelector("#rowParent");
</script>
<form action="{{ route('sublyric.create') }}" method="POST" class="form needs-validation" novalidate>
    <div class="modal-body">
        @csrf
        <input type="text" name="id" value="{{ $id }}" hidden>
        <div class="form-row">
            <label for="language">{{ __('Bahasa') }}</label>
            <input id="language" type="text" class="form-control" name="language" required>
            <div class="invalid-feedback">
                Harus diisi.
            </div>
        </div>
        <div class="form-row d-flex flex-column my-3">
            <label for="addRow">{{ __('Isi Lirik') }}</label>
            <button id="addRow" type="button" class="btn btn-success" onclick="ModalHandler_SubLyric.addRows();">Tambah baris baru</button>
        </div>
        <div id="rowParent">
            <div id="itemRow_1" class="form-row mb-3">
                <label for="language" class="col-md-2 col-form-label text-md-center">1</label>
                <div class="col-md-8">
                    <input id="lyric_content" type="text" class="form-control" name="lyric_content[]" required>
                    <div class="invalid-feedback">
                        Harus diisi.
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary btn-light" data-dismiss="modal">Batalkan</button>
        <button type="submit" class="btn btn-success">Tambah lirik</button>
    </div>
</form>
