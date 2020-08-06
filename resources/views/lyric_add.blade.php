<div class="modal-header bg-success text-light border-0">
    <h5 class="modal-title">Buat lirik baru</h5>
    <button type="button" class="close btn-success" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true" class="text-light">&times;</span>
    </button>
</div>
<div class="modal-body">
    <form action="" method="POST" class="form needs-validation" novalidate>
        @csrf
        <input type="text" name="id" value="{{ $id }}" hidden>
        <div class="form-row">
            <label for="language">{{ __('Bahasa') }}</label>
            <input id="language" type="text" class="form-control @error('language') is-invalid @enderror" name="language" required>
            @error('language')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-row d-flex flex-column my-3">
            <label for="addRow">{{ __('Isi Lirik') }}</label>
            <button id="addRow" type="button" class="btn btn-success" onclick="addRows();">Tambah baris baru</button>
        </div>
        <div id="rowParent">
            <div id="itemRow_1" class="form-row mb-3">
                <label for="language" class="col-md-2 col-form-label text-md-center">1</label>
                <div class="col-md-8">
                    <input id="lyric_content" type="text" class="form-control @error('lyric_content') is-invalid @enderror" name="lyric_content" required>
                    @error('lyric_content')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <button id="deleteRow" id-parent="itemRow_1" type="button" class="btn btn-danger col-md-2 mt-2 mt-md-0" onclick="deleteRows(this);">Hapus</button>
            </div>
        </div>
    </form>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batalkan</button>
    <button type="submit" class="btn btn-success">Tambah lirik</button>
</div>

<script>
    const addRows = () => {
        parentChild = document.querySelector("#rowParent");
        let countChild = parentChild.childElementCount + 1;
        itemChild = `
            <div id="itemRow_${countChild}" class="form-row mb-3">
                <label for="language" class="col-md-2 col-form-label text-md-center">${countChild}</label>
                <div class="col-md-8">
                    <input id="lyric_content" type="text" class="form-control @error('lyric_content') is-invalid @enderror" name="lyric_content" required>
                    @error('lyric_content')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <button id="deleteRow" id-parent="itemRow_${countChild}" type="button" class="btn btn-danger col-md-2 mt-2 mt-md-0" onclick="deleteRows(this);">Hapus</button>
            </div>
        `;
    
        appendChild(parentChild, itemChild);
    };

    const deleteRows = (button) => {
        parentChild = document.querySelector("#rowParent");
        let removeElement = parentChild.querySelector("#" + button.getAttribute("id-parent"));
        parentChild.removeChild(removeElement);
        updateNumber();
    };

    const updateNumber = () => {
        parentChild = document.querySelector("#rowParent");
        let labelNumber = parentChild.querySelectorAll("label");
        for(let i=0; i < labelNumber.length; i++) {
            labelNumber[i].innerText = i+1;
        }
    };

</script>