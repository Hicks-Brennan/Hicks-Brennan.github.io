document.getElementById('currentYear').innerHTML = new Date().getFullYear();

document.getElementById('lastUpdated').innerHTML = "Last Updated: " + document.lastModified;

function toggleMenu() {
    document.getElementsByClassName("navList")[0].classList.toggle("responsive");
}