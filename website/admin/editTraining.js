// Create Logic
let table = document.getElementById('table');
let tHead = table.querySelector('thead');

let httpRequest = new XMLHttpRequest();
httpRequest.onreadystatechange = insertData;
httpRequest.open('GET', '/api/training.php');
httpRequest.send();

function insertData(x) {
    if (x.target.readyState === 4) {
        let responseJson = JSON.parse(x.target.response);

        let count = 0;
        for (const trainingId in responseJson) {
            if (!responseJson.hasOwnProperty(trainingId)) {
                continue;
            }

            console.log(responseJson[trainingId]);

            let training = responseJson[trainingId];

            let oddRow = "";
            if (count % 2 === 0) {
                oddRow = 'pure-table-odd'
            }
            count++;

            let htmlText = '<tbody class="' + oddRow + '">\n' +
                '        <tr>\n' +
                '        <td><input class="table-input training-names" maxlength="50" type="text" name="' + trainingId + '" value="' + training.training_name + '"></td>\n' +
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
            for (const description of training.description) {
                concatDescr += description.beschreibung + ", ";
                htmlText += '<tr class="description-row">\n' +
                    '<td colspan="2"><textarea class="table-input" maxlength="1000" name="' + description.pk_beschreibungtr_id + '">' +
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
                '        <td colspan="3">\n' +
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
let deleteList = [];

function afterDataInsert() {
    expandAreas = document.getElementsByClassName("expand-area");

    for (let i = 0; i < expandAreas.length; i++) {
        expandAreas[i].addEventListener("click", rowClick);
    }

    let addRowButtons = document.getElementsByClassName("add-row");

    for (let i = 0; i < addRowButtons.length; i++) {
        addRowButtons[i].addEventListener("click", addRowButtonClick);
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

function rowClick(event) {
    let hiddenArea = event.target.closest('tbody').nextElementSibling;

    if (hiddenArea.classList.contains("tbody-hidden")) {
        for (let i = 0; i < expandAreas.length; i++) {
            expandAreas[i].closest('tbody').nextElementSibling.classList.add("tbody-hidden");
        }
        hiddenArea.classList.remove("tbody-hidden");
    } else {
        hiddenArea.classList.add("tbody-hidden");
    }
}

function addRowButtonClick(event) {
    let html = '<tr class="description-row ">' +
        '<td colspan="2"><textarea class="table-input" maxlength="1000"></textarea></td>\n' +
        '<td class="delete-col delete-row">\n' +
        '    <span class="material-icons delete-icon ">\n' +
        '    clear\n' +
        '    </span>\n' +
        '</td>' +
        '</tr>';

    let buttonRow = event.target.closest('tr');
    buttonRow.insertAdjacentHTML('beforebegin', html);
}

function deleteRow(event) {
    let row = event.target.closest('tr');
    let descrId = row.querySelector('textarea').name;

    deleteList.push('/api/beschreibungTr.php?id=' + descrId);

    row.remove();

    console.log(deleteList);
}

function deleteOffer(event) {
    let body = event.target.closest('tbody');
    let descrId = body.querySelector('.training-names').name;

    deleteList.push('/api/training.php?id=' + descrId);

    body.nextElementSibling.remove();
    body.remove();

    console.log(deleteList);
}

document.getElementById('add-offer').addEventListener("click", addOfferButtonClick);

function addOfferButtonClick(event) {
    let httpRequest = new XMLHttpRequest();
    httpRequest.onreadystatechange = putPostResp;
    httpRequest.open('POST', '/api/training.php');
    httpRequest.setRequestHeader('Content-Type', 'application/json');
    httpRequest.send();
}

function submitForm() {
    let form = document.getElementById("editForm");
    let trainingNames = form.getElementsByClassName("training-names");

    let output = {};
    for (let i = 0; i < trainingNames.length; i++) {
        let trainingId = trainingNames[i].name;
        let trainingName = trainingNames[i].value;
        output[trainingId] = {
            training_name: trainingName,
            description: [],
        };

        let descriptions = trainingNames[i].closest('tbody').nextElementSibling.childNodes;

        for (let j = 0; j < descriptions.length; j++) {
            if (descriptions[j].nodeName === "TR" && descriptions[j].classList.contains("description-row")) {
                let textarea = descriptions[j].getElementsByTagName("textarea")[0];
                let descriptionData = {
                    pk_beschreibungTr_id: textarea.name,
                    beschreibung: textarea.value,
                };
                output[trainingId].description.push(descriptionData);
            }
        }
    }

    for (const deleteListKey of deleteList) {
        let httpRequest = new XMLHttpRequest();
        httpRequest.onreadystatechange = putPostResp;
        httpRequest.open('DELETE', deleteListKey);
        httpRequest.send()
    }

    console.log(output);

    let httpRequest = new XMLHttpRequest();
    httpRequest.onreadystatechange = putPostResp;
    httpRequest.open('PUT', '/api/training.php');
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