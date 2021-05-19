let expandAreas = document.getElementsByClassName("expand-area");

function rowClick(event, expandArea) {
    let hiddenArea = expandArea.parentElement.parentElement.nextElementSibling;

    if (hiddenArea.classList.contains("tbody-hidden")) {
        for (let i = 0; i < expandAreas.length; i++) {
            expandAreas[i].parentElement.parentElement.nextElementSibling.classList.add("tbody-hidden");
        }
        hiddenArea.classList.remove("tbody-hidden");
    } else {
        hiddenArea.classList.add("tbody-hidden");
    }
}

for (let i = 0; i < expandAreas.length; i++) {
    expandAreas[i].addEventListener("click", (e) => {
        rowClick(e, expandAreas[i])
    });
}

let addRowButtons = document.getElementsByClassName("add-row");

function addRowButtonClick(event, button) {
    let newNode = button.parentElement.parentElement.previousSibling.cloneNode(true);
    button.parentElement.parentElement.parentElement.insertBefore(newNode, button.parentElement.parentElement);
}

for (let i = 0; i < addRowButtons.length; i++) {
    addRowButtons[i].addEventListener("click", (e) => {
        addRowButtonClick(e, addRowButtons[i])
    });
}

function submitForm() {
    let form = document.getElementById("editForm");
    let therapyNames = form.getElementsByClassName("therapy-names");
    for (let i = 0; i < therapyNames.length; i++) {
        let descriptions = therapyNames[i].parentElement.parentElement.parentElement.nextElementSibling.childNodes;

        for (let i = 0; i < descriptions.length; i++) {
            console.log(descriptions[i])
        }
    }
}

