let content = document.querySelectorAll('.contentHeading');

content.forEach(element => element.addEventListener('click', expandContent, false));

function expandContent(event) {
    let contentDetails = event.target.parentNode.querySelector('.description');

    if (contentDetails.classList.contains('hidden')) {
        contentDetails.classList.remove('hidden');
        contentDetails.scrollIntoView({behavior: "smooth", block: "start"})
    } else if (contentDetails.classList.contains('noHidden')) {
        contentDetails.classList.remove('noHidden');
        contentDetails.scrollIntoView({behavior: "smooth", block: "start"})
    } else {
        contentDetails.classList.add('hidden');
    }
}