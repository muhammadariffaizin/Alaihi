'use strict';

const updateValidation = () => {
    const forms = document.getElementsByClassName('needs-validation');
    
    const validation = Array.prototype.filter.call(forms, (form) => {
        form.addEventListener('submit', (event) => {
            if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        }, false);
    });

};

window.addEventListener('load', () => {
    updateValidation();
}, false);

class ModalPopup {
    init(id, url, title, modal, failedMsg) {
        this._id = id;
        this._url = url;
        this._title = title;
        this._modal = modal;
        this._failedMsg = failedMsg;
        this.load();
    }

    load() {
        $.ajax({
                url: this._url,
                type: 'GET',
                dataType: 'html'
            })
            .done((data) => {
                // add header
                this._modal.innerHTML = `
                <div class="modal-header bg-success text-light border-0">
                    <h5 class="modal-title">${ this._title }</h5>
                    <button type="button" class="close btn-success" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-light">&times;</span>
                    </button>
                </div>
                `;
                
                // modal.innerHTML += data;     cannot run the script in the middle
                // used this to prevent script not running while appending html
                let frag =  document.createRange().createContextualFragment(data); 
                this._modal.appendChild(frag);

                updateValidation();
            })
            .fail(() => {
                this._modal.innerHTML = this._failedMsg;
            });
    }
}

class ModalSubLyric extends ModalPopup {
    set parent(parentRow) {
        this._parentRow = parentRow;
    }

    addRows() {
        let countChild = this._parentRow.childElementCount + 1;
        let itemChild = `
            <div id="itemRow_${countChild}" class="form-row mb-3">
                <label for="language" class="col-md-2 col-form-label text-md-center">${countChild}</label>
                <div class="col-md-8">
                    <input id="lyric_content" type="text" class="form-control" name="lyric_content[]" required>
                    <div class="invalid-feedback">
                        Harus diisi.
                    </div>
                </div>
                <button id="deleteRow" id-parent="itemRow_${countChild}" type="button" class="btn btn-danger col-md-2 mt-2 mt-md-0" onclick="ModalHandler.deleteRows(this);">Hapus</button>
            </div>
        `;
    
        let frag =  document.createRange().createContextualFragment(itemChild); 
        this._parentRow.appendChild(frag);
    };

    deleteRows(button) {
        let removeElement = this._parentRow.querySelector("#" + button.getAttribute("id-parent"));
        this._parentRow.removeChild(removeElement);
        this.updateNumber();
    };

    updateNumber() {
        let labelNumber = this._parentRow.querySelectorAll("label");
        for(let i=0; i < labelNumber.length; i++) {
            labelNumber[i].innerText = i+1;
        }
    };
}