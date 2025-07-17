import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    switch() {
        document.body.classList.toggle('dark-mode');
        document.button.classList.toggle('.btn-transparent');
    }
}