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

class ModalSong extends ModalPopup {
    
}

class ModalLyric extends ModalPopup {
    
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
                    <input id="lyric_content_${countChild}" type="text" class="form-control" name="lyric_content[]" onpaste="ModalHandler_SubLyric.pasteMultiLine(this, event);" required>
                    <div class="invalid-feedback">
                        Harus diisi.
                    </div>
                </div>
                <button id="deleteRow" id-parent="itemRow_${countChild}" type="button" class="btn btn-danger col-md-2 mt-2 mt-md-0" onclick="ModalHandler_SubLyric.deleteRows(this);">Hapus</button>
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
            labelNumber[i].id = `lyric_content_${i+1}`;
        }
    };

    pasteMultiLine(el, event) {
        const oldValue = el.value;
        const clipData = event.clipboardData || window.clipboardData || event.originalEvent.clipboardData;
        const pastedData = clipData.getData('Text');
        const arrayData = pastedData.split('\n');
        let currentParentNode = el.parentNode.parentNode;
        let siblings = [];
        while(currentParentNode = currentParentNode.nextElementSibling) {
            siblings.push(currentParentNode.querySelector('input'));
        }
        siblings.forEach((item, index) => {
            if(arrayData[index+1] !== undefined) {
                item.value = arrayData[index+1];
            }
        });
        setTimeout(() => {
            el.value = oldValue + arrayData[0];
        }, 4);
    }
}