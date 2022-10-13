import api from "./api/api.js";

function createFileCard(fileName) {
    const parent = document.createElement("div");
    const h1 = document.createElement("h1");
    const h1Text = document.createTextNode(fileName);
    const deleteIcon = document.createElement("button")

    deleteIcon.className = 'delete-button'
    deleteIcon.setAttribute('data-file-name', fileName)
    deleteIcon.innerText = "Delete"
    h1.appendChild(h1Text);

    // Append to child
    parent.appendChild(h1);
    parent.appendChild(deleteIcon)

    parent.className = 'file'
    parent.addEventListener("click", function (e) {
        console.log($(this))
    })
    return parent;
}

function rerender() {
    fetch("/files/get", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
    }).then(response => {
        return response.json();
    })
        .then((data) => {
            const parent = $("#files")
            // Removes all elements
            $(".file").remove()
            data.files.forEach((element, index) => {
                parent.append(createFileCard(element))
            })
        });
}

window.setInterval(function () {
}, 3000);


window.onload = function () {

    const files = $('#files');

    $('.delete-button').on("click", function (event) {
        event.preventDefault();
        const that = $(this);
        let filename = that.data('file-name');

        const data = {
            'filename': filename
        }

        fetch("/files/delete", {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        })
            .then(() => {
                rerender();
            }).catch((err) => {
            console.log(err)
        })
    })


    files.hover(function () {
        this.focus();
    }).keydown(function (e) {
        if (e.key === 'Backspace') {
            $('#command-line > .text').text($('#command-line > .text').text().slice(0, -1));
        } else if (e.key === 'Enter') {
            fetch("/files/execute", {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    'command': $('#command-line > .text').text()
                })
            })
                .then(() => {
                    rerender();
                }).catch((err) => {
                console.log(err)
            })
        } else {
            $('#command-line > .text').text($('#command-line > .text').text() + e.key);
        }
    })


    files.bind("contextmenu", function (e) {

        $("#context-menu").remove();

        if ($("#context-menu").length > 1) {
            return false;
        }
        let top = e.pageY - 10;
        let left = e.pageX - 10;

        const menu = $('<div/>', {
            id: 'context-menu',
            "css": {
                position: 'absolute',
                top: top + "px",
                left: left + "px"
            }
        });

        menu.mouseleave(function () {
            menu.remove();
        })


        files.append(menu)

        return false;
    });

}