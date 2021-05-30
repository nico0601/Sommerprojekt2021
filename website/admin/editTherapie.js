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
                '        <td class="delete-col delete-offer">\n' +
                '            <span class="material-icons delete-icon">\n' +
                '            clear\n' +
                '            </span>\n' +
                '        </td>' +
                '        </tr>\n' +
                '        </tbody>\n' +
                '        <tbody class="description-container tbody-hidden ' + oddRow + '">\n';

            let concatDescr = "";
            for (const description of therapy.description) {
                concatDescr += description.beschreibung + ", ";
                htmlText += '<tr class="description-row">\n' +
                    '<td colspan="2"><textarea class="table-input" name="' + description.pk_beschreibungTh_id + '">' +
                    description.beschreibung + '</textarea></td>\n' +
                    '        <td class="delete-col delete-row">\n' +
                    '            <span class="material-icons delete-icon">\n' +
                    '            clear\n' +
                    '            </span>\n' +
                    '        </td>' +
                    '</tr>';
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
let changesExecution = [];

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

    let deleteRows = document.getElementsByClassName('delete-row');

    for (let i = 0; i < deleteRows.length; i++) {
        deleteRows[i].addEventListener("click", deleteRow);
    }

    let deleteOffers = document.getElementsByClassName('delete-offer');

    for (let i = 0; i < deleteOffers.length; i++) {
        deleteOffers[i].addEventListener("click", deleteOffer);
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
    let html = '<tr class="description-row ">' +
        '<td colspan="2"><textarea class="table-input"></textarea></td>\n' +
        '<td class="delete-col delete-row">\n' +
        '    <span class="material-icons delete-icon ">\n' +
        '    clear\n' +
        '    </span>\n' +
        '</td>' +
        '</tr>';

    let buttonRow = button.closest('tr');
    buttonRow.insertAdjacentHTML('beforebegin', html);
}

function deleteRow(event) {
    event.target.closest('tr').remove();

}

document.getElementById('add-offer').addEventListener("click", addOfferButtonClick);

function addOfferButtonClick(event) {
    let httpRequest = new XMLHttpRequest();
    httpRequest.onreadystatechange = putPostResp;
    httpRequest.open('POST', '/api/therapy.php');
    httpRequest.setRequestHeader('Content-Type', 'application/json');
    httpRequest.send();
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
    httpRequest.onreadystatechange = putPostResp;
    httpRequest.open('PUT', '/api/therapy.php');
    httpRequest.setRequestHeader('Content-Type', 'application/json');
    httpRequest.send(JSON.stringify(output));
}

function putPostResp(x) {
    if (x.target.readyState === 4) {
        if (x.target.status === 204) {
            location.reload();
        } else {
            document.querySelector('#result').innerHTML =
                '<pre>' + x.target.response + '</pre>';
        }
    }
}