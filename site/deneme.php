<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hava Durumu</title>
</head>
<body>
    <h1>Hava Durumu</h1>
    <button onclick="getLocation()">Konum İzni İste ve Hava Durumunu Göster</button>
    <div id="weatherInfo"></div>

    <script>
        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showWeather);
            } else {
                alert("Tarayıcınız konum servisini desteklemiyor.");
            }
        }

        function showWeather(position) {
            var latitude = position.coords.latitude;
            var longitude = position.coords.longitude;
            var apiKey = 'a9e7bd696a04a972d941c2a81efbec66'; // Buraya OpenWeatherMap API anahtarınızı yerleştirin
            var apiUrl = https://api.openweathermap.org/data/2.5/weather?lat=${latitude}&lon=${longitude}&appid=${apiKey}&units=metric;

            fetch(apiUrl)
                .then(response => response.json())
                .then(data => {
                    var weatherInfo = document.getElementById("weatherInfo");
                    weatherInfo.innerHTML = 
                        <h2>Bulunduğunuz Konum için Hava Durumu</h2>
                        <p>Şehir: ${data.name}</p>
                        <p>Sıcaklık: ${data.main.temp} °C</p>
                        <p>Hissedilen Sıcaklık: ${data.main.feels_like} °C</p>
                        <p>Hava Durumu: ${data.weather[0].description}</p>
                    ;
                })
                .catch(error => {
                    console.error('Hata:', error);
                });
        }
    </script>
</body>
</html>