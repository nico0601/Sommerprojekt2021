let content = document.querySelectorAll('.contentHeading');

content.forEach(element => element.addEventListener('click', expandContent, false));

function expandContent(event) {
    let contentDetails = event.target.parentNode.querySelector('.description');

    if (contentDetails.classList.contains('unhidden')) {
        contentDetails.classList.remove('unhidden');
    } else {
        contentDetails.classList.add('unhidden');
    }
}