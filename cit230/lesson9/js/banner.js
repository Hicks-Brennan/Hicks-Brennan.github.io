window.onload = function() {
    var x = document.getElementById("friday");
    var y = new this.Date();
    if (y.getDay() == 5) {
        x.style.display = "block";
    } 
    else {
        x.style.display = "none";
    }
}