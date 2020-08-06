'use strict';

window.addEventListener('load', () => {

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

}, false);


const load_modal = (elements, modal, failedMsg) => {
    elements.forEach((item) => {
        item.addEventListener('click', (e) => {
            e.preventDefault();

            let url = item.getAttribute('data-url');
            $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: 'html'
                })
                .done((data) => {
                    modal.innerHTML = ``;
                    
                    // modal.innerHTML += data;     cannot run the script in the middle
                    // used this to prevent script not running while appending html
                    let frag =  document.createRange().createContextualFragment(data); 
                    modal.appendChild(frag);
                })
                .fail(() => {
                    modal.innerHTML = failedMsg;
                });
        })
    });
}

const appendChild = (parentChild, itemChild, caller) => {
    parentChild.innerHTML += itemChild;
}

class ModalPopup {
    constructor(id, url) {
        this._id = id;
        this._url = url;
    }

    load() {

    }
}