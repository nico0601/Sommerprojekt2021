// Create Logic
let table = document.getElementById('table');
let tHead = table.querySelector('thead');

let httpRequest = new XMLHttpRequest();
httpRequest.onreadystatechange = insertData;
httpRequest.open('GET', '/api/therapy.php');
httpRequest.send();

function insertData(x) {
    if (x.target.readyState === 4) {
        let responseJson = JSON.parse(x.target.response);

        let count = 0;
        for (const therapyId in responseJson) {
            if (!responseJson.hasOwnProperty(therapyId)) {
                continue;
            }
            let therapy = responseJson[therapyId];

            let oddRow = "";
            if (count % 2 === 0) {
                oddRow = 'pure-table-odd'
            }
            count++;

            let htmlText = '<tbody class="' + oddRow + '">\n' +
                '        <tr>\n' +
                '        <td><input class="table-input therapy-names" type="text" name="' + therapyId + '" value="' + therapy.therapie_name + '"></td>\n' +
                '        <td class="expand-area">\n' +
                '            <div class="nowrap-container">\n' +
                '                <span class="nowrap-text">{{ concatDescription }}</span>\n' +
                '                <span class="material-icons expand-icon">expand_more</span>\n' +
                '            </div>\n' +
                '        </td>\n' +
                '        </tr>\n' +
                '        </tbody>\n' +
                '        <tbody class="description-container tbody-hidden ' + oddRow + '">\n';

            let concatDescr = "";
            for (const description of therapy.description) {
                concatDescr += description.beschreibung + ", ";
                htmlText += '<tr class="description-row">\n' +
                    '<td colspan="2"><textarea class="table-input" name="' + description.pk_beschreibungTh_id + '">'
                    + description.beschreibung + '</textarea></td>\n' +
                    '</tr>'
            }
            concatDescr = concatDescr.substr(0, concatDescr.length - 2)

            htmlText += '<tr>\n' +
                '        <td colspan="2">\n' +
                '            <button class="pure-button add-row" type="button">Add row</button>\n' +
                '        </td>\n' +
                '        </tr>\n' +
                '        </tbody>';

            htmlText = htmlText.replace('\{\{ concatDescription \}\}', concatDescr)
            tHead.insertAdjacentHTML('afterend', htmlText);
        }
        afterDataInsert();
    }
}


// User Input Logic

let expandAreas;

function afterDataInsert() {
    expandAreas = document.getElementsByClassName("expand-area");

    for (let i = 0; i < expandAreas.length; i++) {
        expandAreas[i].addEventListener("click", (e) => {
            rowClick(e, expandAreas[i])
        });
    }

    let addRowButtons = document.getElementsByClassName("add-row");

    for (let i = 0; i < addRowButtons.length; i++) {
        addRowButtons[i].addEventListener("click", (e) => {
            addRowButtonClick(e, addRowButtons[i])
        });
    }
}

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

function addRowButtonClick(event, button) {
    let newNode = button.parentElement.parentElement.previousSibling.cloneNode(true);
        '<td colspan="2"><textarea class="table-input"></textarea></td>\n' +
        '</tr>';

    let buttonRow = button.closest('tr');
    buttonRow.insertAdjacentHTML('beforebegin', html);
}

function submitForm() {
    let form = document.getElementById("editForm");
    let therapyNames = form.getElementsByClassName("therapy-names");

    let output = {};
    for (let i = 0; i < therapyNames.length; i++) {
        let therapyId = therapyNames[i].name;
        let therapyName = therapyNames[i].value;
        output[therapyId] = {
            therapie_name: therapyName,
            description: [],
        };

        let descriptions = therapyNames[i].closest('tbody').nextElementSibling.childNodes;

        for (let j = 0; j < descriptions.length; j++) {
            if (descriptions[j].nodeName === "TR" && descriptions[j].classList.contains("description-row")) {
                let textarea = descriptions[j].getElementsByTagName("textarea")[0];
                let descriptionData = {
                    pk_beschreibungTh_id: textarea.name,
                    beschreibung: textarea.value,
                };
                output[therapyId].description.push(descriptionData);
            }
        }
    }

    let httpRequest = new XMLHttpRequest();

    function test(x) {
        if (x.target.readyState === 4) {
            console.log(x.target);
            document.querySelector('#result').innerHTML =
                '<pre>' + x.target.response + '</pre>';
        }
    }

    httpRequest.onreadystatechange = test;
    httpRequest.open('PUT', '/api/therapy.php?id=1');
    httpRequest.setRequestHeader('Content-Type', 'application/json');
    httpRequest.send(JSON.stringify(output));

    // let hiddenForm = document.createElement("form");
    // hiddenForm.action = "/api/therapy.php";
    // hiddenForm.method = 'POST'
    //
    // let hiddenInput = document.createElement('input');
    // hiddenInput.type = 'hidden';
    // hiddenInput.name = 'fragment';
    // hiddenInput.value = JSON.stringify(output);
    // hiddenForm.appendChild(hiddenInput);
    //
    // document.body.appendChild(hiddenForm);
    // hiddenForm.submit();

}

function createElementFromHTML(htmlString) {
    let div = document.createElement('template');
    div.innerHTML = htmlString;

    console.log(div.innerText);

    return div.content.firstChild;
}