class File extends HTMLElement {
    constructor() {
        super();

        const isSingleFile = this.getAttribute('data-is-single-file');
        const parentFile = this.getAttribute('data-parent-file');
        const childrenFile = this.getAttribute('data-children-files');
        const template = document.createElement('template');

        let title = document.createElement('h1');
        title.innerHTML = parentFile;

        this.className = 'border-b-4 border-indigo-500'

        window.addEventListener('DOMContentLoaded', (event) => {
            if (childrenFile.length > 0 && isSingleFile) {
                for (const childFile of JSON.parse(childrenFile)) {
                    let child = document.createElement('folder-element');
                    template.append(child)
                }
            }

            this.append(template)
        });

        this.append(title);
    }
}

customElements.define('folder-element', File);

