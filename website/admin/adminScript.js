let delButtons = document.getElementsByClassName("delUser");

for (var i = 0; i < delButtons.length; i++) {
    delButtons[i].addEventListener('click', deleteUser, false);
}