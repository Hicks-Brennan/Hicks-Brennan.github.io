function getwindChill() {

    var high = document.getElementById('high').innerHTML;
    var wind = document.getElementById('wind').innerHTML;
    var wchill = windChill(high, wind);
    
    document.getElementById('chill').innerHTML = wchill;
}

function windChill(high, wind){
    var t = high;
    var s = wind;
    var wchill = (35.74 + .6215 * t) - (35.75 * Math.pow(s, .16) + .4275 * t * Math.pow(s, .16));
    return wchill;
}   