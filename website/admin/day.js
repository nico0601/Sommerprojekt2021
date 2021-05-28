let day = document.getElementById('day')
let date = document.getElementById('date')
date.addEventListener('change', getDay, false)

function getDay(event) {

    let xmlhttp = new XMLHttpRequest()

    xmlhttp.onreadystatechange = function () {
        if (this.readyState === 4 && xmlhttp.status === 200) {
            day.value = this.responseText
        }
    }

    xmlhttp.open('get', 'day.php?date=' + event.target.value, true)
    xmlhttp.send()
}