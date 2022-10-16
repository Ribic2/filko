class File extends HTMLElement {
    constructor() {
        super();

        let wrapper = document.createElement('div');
        wrapper.style.height = "50px"
        wrapper.style.width = "50px";
        wrapper.innerHTML = "test"
        this.append(wrapper)
    }
}

customElements.define('folder-element', File);

