let erfolgreich = document.getElementById('erfolgreich')
let fehlgeschlagen = document.getElementById('fehlgeschlagen')

if (erfolgreich !== null) {
    setTimeout(() => erfolgreich.style.opacity = "0", 5000);
}else if (fehlgeschlagen !== null) {
    setTimeout(() => fehlgeschlagen.style.opacity = "0", 5000)
}