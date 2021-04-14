let dropdowns = document.querySelectorAll(".nav-element > .nav-dropdown");
dropdowns.forEach(element => {
    element.parentNode.addEventListener("mouseover", showDropdown);
    console.log(element);
});

function showDropdown(event) {
    let dropdownMenu = event.target.getElementsByClassName("nav-dropdown");

    console.log(dropdownMenu)
    console.log(event.target)
    dropdownMenu.classList.remove("hidden");
}