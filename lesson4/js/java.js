document.getElementById('currentYear').innerHTML = new Date().getFullYear();

document.getElementById('lastUpdated').innerHTML = "Last Updated: " + document.lastModified;

function toggleMenu() {
    document.getElementByClass("navigation").classList.toggle("responsive");
}