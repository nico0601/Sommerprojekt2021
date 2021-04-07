let content = document.querySelectorAll('#content > div')

content.forEach(element => element.addEventListener('click', aufklappen, false))

function aufklappen(event) {
    let which = event.target.parentNode
    if (which.style.height == 'auto') {
        which.style.height = '121px'
    }else {
        which.style.height = 'auto'
    }
}