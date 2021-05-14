let content = document.querySelectorAll('.contentHeading');

content.forEach(element => element.addEventListener('click', expandContent, false));

function expandContent(event) {
    let contentDetails = event.target.parentNode.querySelector('.description')
    let scroll = event.target.parentNode

    if (contentDetails.classList.contains('hidden')) {
        contentDetails.classList.remove('hidden');
        scroll.scrollIntoView({behavior: "smooth", block: "center"})
    } else if (contentDetails.classList.contains('noHidden')) {
        contentDetails.classList.remove('noHidden');
        contentDetails.classList.add('hidden');
        scroll.scrollIntoView({behavior: "smooth", block: "center"})
    } else {
        contentDetails.classList.add('hidden');
    }
}