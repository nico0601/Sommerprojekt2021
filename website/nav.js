function showDropdown(event) {
    let dropdownMenu = event.target.getElementsByClassName("nav-dropdown");

    console.log(dropdownMenu)
    console.log(event.target)
    dropdownMenu.classList.remove("hidden");
}

let dropdowns = document.querySelectorAll(".nav-element > .nav-dropdown");
dropdowns.forEach(element => {
    element.parentNode.addEventListener("mouseover", showDropdown);
    console.log(element);
});

// Mobile functionality

function expandMenu() {
    document.getElementsByTagName("nav")[0].classList.remove("nav-hidden");
    document.getElementById("page-no-nav").classList.add("page-no-nav-active");
}

function closeMenu() {
    document.getElementsByTagName("nav")[0].classList.add("nav-hidden");
    document.getElementById("page-no-nav").classList.remove("page-no-nav-active");
}

document.getElementById("nav-expand-icon-container").addEventListener("click", expandMenu);
document.getElementById("nav-close-icon-container").addEventListener("click", closeMenu);
document.getElementById("page-no-nav").addEventListener("click", closeMenu);
document.onkeydown = (keyDownEvent) => {
    if (keyDownEvent.key === 'Escape') {
        closeMenu()
    }
};