const apiURL = "https://api.openweathermap.org/data/2.5/weather?id=5585010&units=imperial&APPID=43d3aa19f1bf7785b8ffa9aa69a74209";
fetch(apiURL)
  .then((response) => response.json())
  .then((jsObject) => {
    console.log(jsObject);
    document.getElementById('current').textContent = jsObject.weather[0].main;
    document.getElementById('temperature').textContent = jsObject.main.temp;
    document.getElementById('humidity').textContent = jsObject.main.humidity;
    document.getElementById('wind').textContent = jsObject.wind.speed;



    var tempF = parseFloat(document.getElementById("temperature").textContent);
    var speed = parseFloat(document.getElementById("wind").textContent);
    var chill = windChill(tempF, speed);

    function windChill(tempF, speed) {
        if (tempF > 50){
            return "N/A";
        } else if (speed < 3){
            return "N/A";
        } else {
        return Math.round(35.74 + (0.6215 * tempF) - (35.75 * Math.pow(speed, 0.16)) + (0.4275 * tempF * Math.pow(speed, 0.16))) + "&#xb0; F";
    }
    }

    document.getElementById('outputDiv').innerHTML = chill


  });

const apiURLforecast = "https://api.openweathermap.org/data/2.5/forecast?id=5585010&units=imperial&APPID=43d3aa19f1bf7785b8ffa9aa69a74209";
fetch(apiURLforecast)
    .then((response) => response.json())
    .then((jsObject) => {
        console.log(jsObject);

        var count = 1;

        jsObject.list.forEach(getData);

        function getData(item){
            
            if (item.dt_txt.includes("18:00:00")) {
                document.getElementById('day' + count).setAttribute('src', 'https://openweathermap.org/img/w/' + item.weather[0].icon + '.png');  
                document.getElementById('day' + count).setAttribute('alt', item.weather[0].description + ' icon');
                document.getElementById('day' + count + 'temp').textContent = item.main.temp_max.toFixed(0);
                count++;
            }
        } 

    });

    var d = new Date();
    var weekday = new Array(14);
    weekday[0] = "Sun";
    weekday[1] = "Mon";
    weekday[2] = "Tue";
    weekday[3] = "Wed";
    weekday[4] = "Thu";
    weekday[5] = "Fri";
    weekday[6] = "Sat";
    weekday[7] = "Sun";
    weekday[8] = "Mon";
    weekday[9] = "Tue";
    weekday[10] = "Wed";
    weekday[11] = "Thu";
    weekday[12] = "Fri";
    weekday[13] = "Sat";
  
    var one = weekday[d.getDay() + 1];
    var two = weekday[d.getDay() + 2];
    var thr = weekday[d.getDay() + 3];
    var fou = weekday[d.getDay() + 4];
    var fiv = weekday[d.getDay() + 5];
    document.getElementById("weekday1").textContent = one;
    document.getElementById("weekday2").textContent = two;
    document.getElementById("weekday3").textContent = thr;
    document.getElementById("weekday4").textContent = fou;
    document.getElementById("weekday5").textContent = fiv;