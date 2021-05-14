let weiter = document.getElementById('weiter')
let heading = document.getElementById('heading')
weiter.addEventListener('click', scrollen, false)

if (isMobileDevice()) {
    weiter.style.display = 'none'
} else {
    document.addEventListener('scroll', onscroll, false)
}


let slideIndex1 = 1
showDivs1(slideIndex1)

let slideIndex2 = 1
showDivs2(slideIndex2)

let left1 = document.getElementById("buttonLeft1")
let right1 = document.getElementById("buttonRight1")

let left2 = document.getElementById("buttonLeft2")
let right2 = document.getElementById("buttonRight2")

left1.addEventListener('click', minusDivs1, false)
right1.addEventListener('click', plusDivs1, false)

left2.addEventListener('click', minusDivs2, false)
right2.addEventListener('click', plusDivs2, false)


function onscroll() {
    let whenWeiter
    if (window.innerWidth <= 1000) {
        whenWeiter = 0
    } else if (window.innerWidth <= 1500) {
        whenWeiter = window.innerHeight / 5
    } else {
        whenWeiter = window.innerHeight / 3
    }

    console.log("Breite: " + window.innerWidth)
    console.log("Höhe: " + whenWeiter)

    if (weiter.style.display !== 'none' && document.scrollingElement.scrollTop >= whenWeiter) {
        weiter.style.display = 'none'
    } else if (weiter.style.display === 'none' && document.scrollingElement.scrollTop < whenWeiter) {
        weiter.style.display = 'block'
    }
}

function scrollen() {
    weiter.style.display = 'none'
    heading.scrollIntoView({behavior: "smooth", block: "start"})
}


function plusDivs1() {
    let x = document.querySelectorAll(".therapie")
    if (!(slideIndex1 + 1 > x.length)) {
        showDivs1(slideIndex1 += 1)
        left1.style.opacity = 1
        left1.style.cursor = 'pointer'
    }
    if (slideIndex1 + 1 > x.length) {
        right1.style.opacity = 0.3
        right1.style.cursor = 'auto'
    }
}

function plusDivs2() {
    let x = document.querySelectorAll(".training")
    if (!(slideIndex2 + 1 > x.length)) {
        showDivs2(slideIndex2 += 1)
        left2.style.opacity = 1
        left2.style.cursor = 'pointer'
    }
    if (slideIndex2 + 1 > x.length) {
        right2.style.opacity = 0.3
        right2.style.cursor = 'auto'
    }
}


function minusDivs1() {
    if (!(slideIndex1 - 1 <= 0)) {
        showDivs1(slideIndex1 -= 1)
        right1.style.opacity = 1
        right1.style.cursor = 'pointer'
    }
    if (slideIndex1 - 1 <= 0) {
        left1.style.opacity = 0.3
        left1.style.cursor = 'auto'
    }
}

function minusDivs2() {
    if (!(slideIndex2 - 1 <= 0)) {
        showDivs2(slideIndex2 -= 1)
        right2.style.opacity = 1
        right2.style.cursor = 'pointer'
    }
    if (slideIndex2 - 1 <= 0) {
        left2.style.opacity = 0.3
        left2.style.cursor = 'auto'
    }
}


function showDivs1(n) {
    let x = document.querySelectorAll(".therapie")

    for (let i = 0; i < x.length; i++) {
        x[i].style.display = 'none'
    }
    x[slideIndex1 - 1].style.display = 'block'
}

function showDivs2(n) {
    let x = document.querySelectorAll(".training")

    for (let i = 0; i < x.length; i++) {
        x[i].style.display = 'none'
    }
    x[slideIndex2 - 1].style.display = 'block'
}


function isMobileDevice() {
    return (typeof window.orientation !== "undefined") || (navigator.userAgent.indexOf('IEMobile') !== -1);
}


const observer = lozad(); // lazy loads elements with default selector as '.lozad'
observer.observe();