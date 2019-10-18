document.getElementById('currentYear').innerHTML = new Date().getFullYear();

document.getElementById('lastUpdated').innerHTML = "Last Updated: " + document.lastModified;

function toggleMenu() {
    document.getElementById("navList")[0].classList.toggle("responsive");
}