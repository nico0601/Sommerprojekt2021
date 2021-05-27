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
                '        <td><input class="table-input therapy-names" type="text" value="' + therapy.therapie_name + '"></td>\n' +
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
                htmlText += '<tr>\n' +
                    '<td colspan="2"><textarea class="table-input">' + description.beschreibung + '</textarea></td>\n' +
                    '</tr>'
            }
            concatDescr = concatDescr.substr(0, concatDescr.length - 2)
            console.log(concatDescr);

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
    let html = '<tr>\n' +
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
        output[therapyNames[i].value] = [];

        let descriptions = therapyNames[i].parentElement.parentElement.parentElement.nextElementSibling.childNodes;

        for (let j = 0; j < descriptions.length; j++) {
            if (descriptions[j].nodeName === "TR" && descriptions[j].classList.contains("description-row")) {
                output[therapyNames[i].value].push(descriptions[j].getElementsByTagName("textarea")[0].value);
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
    httpRequest.open('POST', '/api/therapy.php?id=1');
    httpRequest.send('fragment=' + escape(JSON.stringify(output)));

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

