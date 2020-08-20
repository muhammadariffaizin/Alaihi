<script>
    ModalHandler_SubLyric.parent = document.querySelector("#rowParent");
</script>
<form action="{{ route('sublyric.update') }}" method="POST" class="form needs-validation" novalidate>
    <div class="modal-body">
        @csrf
        <input type="text" name="id" value="{{ $id }}" hidden>
        <div class="form-row">
            <label for="language">{{ __('Bahasa') }}</label>
            <input id="language" type="text" class="form-control" name="language" value="{{ $sublyric->lyric_language }}" required>
            <div class="invalid-feedback">
                Harus diisi.
            </div>
        </div>
        <div class="form-row d-flex flex-column my-3">
            <label for="addRow">{{ __('Isi Lirik') }}</label>
            <button id="addRow" type="button" class="btn btn-success" onclick="ModalHandler_SubLyric.addRows();">Tambah baris baru</button>
        </div>
        <div id="rowParent">
        @foreach(json_decode($sublyric->lyric_content) as $key => $lyricrow)
            <div id="itemRow_{{ $key+1 }}" class="form-row mb-3">
                <label for="language" class="col-md-2 col-form-label text-md-center">{{ $key+1 }}</label>
                <div class="col-md-8">
                    <input id="lyric_content" type="text" class="form-control" name="lyric_content[]" onpaste="ModalHandler_SubLyric.pasteMultiLine(this, event);" value="{{ $lyricrow }}" required>
                    <div class="invalid-feedback">
                        Harus diisi.
                    </div>
                </div>
                @if($key+1 > 1)
                <button id="deleteRow" id-parent="itemRow_{{ $key+1 }}" type="button" class="btn btn-danger col-md-2 mt-2 mt-md-0" onclick="ModalHandler_SubLyric.deleteRows(this);">Hapus</button>
                @endif
            </div>
        @endforeach
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary btn-light" data-dismiss="modal">Batalkan</button>
        <button type="submit" class="btn btn-success">Perbarui lirik</button>
    </div>
</form>
