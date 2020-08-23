'use strict';

import ModalPopup from './component/ModalPopup.js';
import validate from './control/validation.js';

window.addEventListener('load', () => {
    window.ModalHandler_Genre = new ModalPopup.ModalGenre();
    window.ModalHandler_Song = new ModalPopup.ModalSong();
    window.ModalHandler_Lyric = new ModalPopup.ModalLyric();
    window.ModalHandler_SubLyric = new ModalPopup.ModalSubLyric();
    window.ModalHandler_Confirm = new ModalPopup.ModalConfirm();

    validate.updateValidation();
}, false);

        
