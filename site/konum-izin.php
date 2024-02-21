<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konum İzni</title>
</head>
<body>
    <h2>Konum İzni</h2>
    <p>Bu web sitesinin konumunu kullanmak için lütfen konum izni verin.</p>
    <button onclick="getLocation()">Konum İzni Ver</button>

    <script>
        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            } else {
                alert("Tarayıcınız konum hizmetini desteklemiyor.");
            }
        }

        function showPosition(position) {
            // Konum bilgilerini alarak, ana sayfaya konum parametreleriyle yönlendirme yap
            var latitude = position.coords.latitude;
            var longitude = position.coords.longitude;
            window.location = "/proje/site/index.php?lat=" + latitude + "&lon=" + longitude;
        }
    </script>
</body>
</html>
