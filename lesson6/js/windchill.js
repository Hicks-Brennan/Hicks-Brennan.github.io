var tempF = parseFloat(document.getElementsByClassName("high").textContent);
var speed = parseFloat(document.getElementsByClassName("wind").textContent);
var chill = windChill(tempF, speed);

function windChill(tempF, speed) {
    if (tempF > 50){
        return "N/A";
    } else if (speed < 3){
        return "N/A";
    } else {
    return 35.74 + (0.6215 * tempF) - (35.75 * Math.pow(speed, 0.16)) + (0.4275 * tempF * Math.pow(speed, 0.16));
  }
}

document.getElementById('outputDiv').innerHTML = chill;