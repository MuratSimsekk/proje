<?php
include("../admin/php/baglanti.php");




if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Form verilerini al
    $cuzdanId = $_POST['cuzdanId'];
    $yeniDovizTuru = $_POST['yeniDovizTuru'];

    // API'den güncel döviz kurlarını al
    $kur = simplexml_load_file("https://www.tcmb.gov.tr/kurlar/today.xml");
    $usdAlis = $usdSatis = $eurAlis = $eurSatis = "";

    foreach ($kur->Currency as $cur) {
        if ($cur["Kod"] == "USD") {
            $usdAlis  = (float) $cur->ForexBuying;
            $usdSatis = (float) $cur->ForexSelling;
        }

        if ($cur["Kod"] == "EUR") {
            $eurAlis  = (float) $cur->ForexBuying;
            $eurSatis = (float) $cur->ForexSelling;
        }
    }

    // Cüzdan bilgilerini veritabanından al
    $sql = "SELECT BAKIYE_TUTAR, DOVIZ_TURU, TLALIS, USDALIS, EURALIS FROM cuzdan WHERE ID='$cuzdanId'";
    $result = mysqli_query($baglanti, $sql);
    $row = mysqli_fetch_assoc($result);
    $bakiyeTutar = $row["BAKIYE_TUTAR"];
    $eskiDovizTuru = $row["DOVIZ_TURU"];
    $tlAlis = $row["TLALIS"];
    $usdAlisBefore = $row["USDALIS"];
    $eurAlisBefore = $row["EURALIS"];

    // Yeni döviz kuruyla bakiye tutarını güncelle
    switch ($yeniDovizTuru) {
        case 'USD':
            if ($eskiDovizTuru != 'USD') {
                $yenibakiyeTutar = $bakiyeTutar / $usdAlis;
                $usdAlisBefore = $usdAlis; // Yeni döviz alış fiyatını güncelle
            }
            break;
        case 'EUR':
            if ($eskiDovizTuru != 'EUR') {
                $yenibakiyeTutar = $bakiyeTutar / $eurAlis;
                $eurAlisBefore = $eurAlis; // Yeni döviz alış fiyatını güncelle
            }
            break;
        case 'TRY':
            // TL seçildiğinde döviz türünden TL'ye çevirme
            if ($eskiDovizTuru == 'USD') {
                $yenibakiyeTutar = $bakiyeTutar * $usdAlis;
                $usdAlisBefore = $usdAlis; // Yeni döviz alış fiyatını güncelle
            } elseif ($eskiDovizTuru == 'EUR') {
                $yenibakiyeTutar = $bakiyeTutar * $eurAlis;
                $eurAlisBefore = $eurAlis; // Yeni döviz alış fiyatını güncelle
            }
            break;
        default:
            $yenibakiyeTutar = $bakiyeTutar; // Döviz türü belirtilmemişse bakiye tutarını değiştirme
            break;


            
    }

    // Kar/Zarar hesaplama
    $karZarar = ($usdAlis - $usdAlisBefore) * $bakiyeTutar;
    
    // Veritabanında cuzdan tablosundaki bakiye tutarını ve döviz türünü güncelle
    $sqlUpdate = "UPDATE cuzdan SET BAKIYE_TUTAR='$yenibakiyeTutar', DOVIZ_TURU='$yeniDovizTuru', TLALIS='$tlAlis', USDALIS='$usdAlis', EURALIS='$eurAlis' WHERE ID='$cuzdanId'";
    if (mysqli_query($baglanti, $sqlUpdate)) {
        //echo "Bakiye tutarı başarıyla güncellendi. Kar/Zarar: $karZarar";
    } else {
        echo "Hata: " . $sqlUpdate . "<br>" . mysqli_error($baglanti);
    }

   
}





?>
<!doctype html>
<html class="no-js" lang="zxx">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>News HTML-5 Template </title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="manifest" href="site.webmanifest">
        <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
<!-- slider -->
          <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Haber Slider</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .slider-container {
            width: 70%; /* Slider container genişliği */
            margin: auto; /* Ortala */
            margin-top: 50px; /* Üstten boşluk */
        }
        .sliderC {   
            padding: 50px;
            margin-left: 60px;
        }    

        /* İleri ve geri alma butonlarını resmin üzerine getir */
        .carousel-control-prev, .carousel-control-next {
            z-index: 5;
        }
        /* Haber başlığı fontunu düzenle ve rengini beyaz yap */
        .carousel-caption h1 {
            font-family: Arial, sans-serif; /* İstediğiniz bir fontu burada belirtebilirsiniz */
            color: white; /* Başlık rengi */
            font-weight: bold;
        }
        /* Kategori stilini ayarla */
        .carousel-caption p {
            background-color: red; 
            width: 100px;
            margin-left: 280px;/* Arka plan rengi */
            color: white; /* Yazı rengi */
            padding: 5px 10px; /* Kenar boşluğu */
            border-radius: 5px; /* Kenar yumuşatma */
    </style>
        <!-- CSS here -->
            <link rel="stylesheet" href="assets/css/bootstrap.min.css">
            <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
            <link rel="stylesheet" href="assets/css/ticker-style.css">
            <link rel="stylesheet" href="assets/css/flaticon.css">
            <link rel="stylesheet" href="assets/css/slicknav.css">
            <link rel="stylesheet" href="assets/css/animate.min.css">
            <link rel="stylesheet" href="assets/css/magnific-popup.css">
            <link rel="stylesheet" href="assets/css/fontawesome-all.min.css">
            <link rel="stylesheet" href="assets/css/themify-icons.css">
            <link rel="stylesheet" href="assets/css/slick.css">
            <link rel="stylesheet" href="assets/css/nice-select.css">
            <link rel="stylesheet" href="assets/css/style.css">
   </head>

   <body>
    <header>
        <!-- Header Start -->
       <div class="header-area">
            <div class="main-header ">
                <div class="header-top black-bg d-none d-md-block">
                   <div class="container">
                       <div class="col-xl-12">
                            <div class="row d-flex justify-content-between align-items-center">
                                <div class="header-info-left">
    <ul>     
        <li id="weatherInfo"><img src="assets/img/icon/header_icon1.png" alt=""></li>
        <li><img src="assets/img/icon/header_icon1.png" alt="">Tuesday, 18th June, 2019</li>
    </ul>
</div>
 <!-- Hava durumu api'den çekme -->
<script>

    document.addEventListener("DOMContentLoaded", getLocation);

    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showWeather, showError);
        } else {
            alert("Tarayıcınız konum servisini desteklemiyor.");
        }
    }

    function showWeather(position) {
        var latitude = position.coords.latitude;
        var longitude = position.coords.longitude;
        var apiKey = 'a9e7bd696a04a972d941c2a81efbec66'; // Buraya OpenWeatherMap API anahtarınızı yerleştirin
        var apiUrl = `https://api.openweathermap.org/data/2.5/weather?lat=${latitude}&lon=${longitude}&appid=${apiKey}&units=metric`;

        fetch(apiUrl)
            .then(response => response.json())
            .then(data => {
                var weatherInfo = document.getElementById("weatherInfo");
                weatherInfo.innerHTML = `
                    <img src="assets/img/icon/header_icon1.png" alt="">
                    ${data.main.temp} °C / 
                    ${data.weather[0].description}
                `;
            })
            .catch(error => {
                console.error('Hata:', error);
            });
    }

    function showError(error) {
        switch (error.code) {
            case error.PERMISSION_DENIED:
                alert("Konum izni verilmedi, sayfa konumu alamaz.");
                break;
            case error.POSITION_UNAVAILABLE:
                alert("Konum bilgisi kullanılamıyor.");
                break;
            case error.TIMEOUT:
                alert("Konum bilgisi alırken zaman aşımı.");
                break;
            case error.UNKNOWN_ERROR:
                alert("Bilinmeyen bir hata oluştu.");
                break;
        }
    }
</script>

                                <div class="header-info-right">
                                    <ul class="header-social">    
                                        <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                                       <li> <a href="#"><i class="fab fa-pinterest-p"></i></a></li>
                                    </ul>
                                </div>
  <!-- Header Giriş Yap Butonu -->
<button type="button" id="girisButton" class="btn btn-primary">
    Giriş Yap
</button>

<!-- Giriş Yap Pop-up Modal -->
<div class="modal" id="girisModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Giriş Yap</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Giriş Formu -->
               <form class="login100-form validate-form" action="giris.php" method="post">
                    <div class="form-group">
                        <label for="kullaniciAdi">Kullanıcı Adı</label>
                        <input type="text" class="form-control" id="KUL_ADI" name="KUL_ADI" placeholder="Kullanıcı Adı">
                    </div>
                    <div class="form-group">
                        <label for="sifre">Şifre</label>
                        <input type="password" class="form-control" id="SIFRE" name="SIFRE"  placeholder="Şifre">
                    </div>
                     <button type="submit" class="btn btn-primary btn-block btn-flat">Giriş Yap</button>
                </form>
            </div>
            <div class="modal-footer">
                <!-- Hesap Oluştur Bağlantısı -->
                <p>Hesabınız yok mu? <a href="#" style="color:red;" id="uyeOlLink">Hesap Oluştur</a></p>
            </div>
        </div>
    </div>
</div>

 <!-- Üye Ol modal -->
<div class="modal" id="uyeOlModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Üye Ol</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Üye Ol Formu -->
               <form role="form" id="form" enctype="multipart/form-data" method="post" name="form">

                    <div class="form-group">
                        <label for="kulAdi">Kullanıcı Adı</label>
                        <input type="text" class="form-control" id="KUL_ADI" name="KUL_ADI"  placeholder="Kullanıcı Adı">
                    </div>
                    <div class="form-group">
                        <label for="email">E-Posta</label>
                        <input type="email" class="form-control" id="EMAIL" name="EMAIL" placeholder="E-Posta">
                    </div>
                    <div class="form-group">
                        <label for="sifreUyeOl">Şifre</label>
                        <input type="password" class="form-control" id="SIFRE" name="SIFRE" placeholder="Şifre">
                    </div>
                    <div class="card-footer">
           <button type="submit" class="btn btn-primary">Kaydet</button>
         </div>

                </form>
            </div>
        </div>
    </div>
</div>
<script>
// Giriş Yap Butonuna tıklandığında Giriş modalı aç
document.getElementById('girisButton').addEventListener('click', function() {
    document.getElementById('girisModal').style.display = 'block';
});

// Modal kapatma
var closeButtons = document.querySelectorAll('[data-dismiss="modal"]');
closeButtons.forEach(function(button) {
    button.addEventListener('click', function() {
        var modal = button.closest('.modal');
        modal.style.display = 'none';
    });
});

// Modal dışına tıklandığında kapatma
window.addEventListener('click', function(event) {
    var modals = document.querySelectorAll('.modal');
    modals.forEach(function(modal) {
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    });
});

// Form gönderildiğinde modalı kapat
document.getElementById('girisForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Sayfa yenilenmesini engelle
    var modal = document.getElementById('girisModal');
    modal.style.display = 'none';
    // Burada form verilerini işleyebilirsiniz
});

/////////
// Üye Ol Bağlantısına tıklandığında Üye ol modalı aç
document.getElementById('uyeOlLink').addEventListener('click', function() {
    document.getElementById('uyeOlModal').style.display = 'block';
});

// Modal kapatma
var closeButtons = document.querySelectorAll('[data-dismiss="modal"]');
closeButtons.forEach(function(button) {
    button.addEventListener('click', function() {
        var modal = button.closest('.modal');
        modal.style.display = 'none';
    });
});

// Modal dışına tıklandığında kapatma
window.addEventListener('click', function(event) {
    var modals = document.querySelectorAll('.modal');
    modals.forEach(function(modal) {
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    });
});

// Üye Ol Formunu gönderildiğinde modalı kapat
document.getElementById('uyeOlForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Sayfa yenilenmesini engelle
    var modal = document.getElementById('uyeOlModal');
    modal.style.display = 'none';
    // Burada üye ol form verilerini işleyebilirsiniz
});

</script>


                            </div>
                       </div>
                   </div>
                </div>
                <div class="header-mid d-none d-md-block">
                   <div class="container">
                        <div class="row d-flex align-items-center">
                            <!-- Logo -->
                            <div class="col-xl-3 col-lg-3 col-md-3">
                                <div class="logo" >  <?php
                    $Sql = $baglanti->query("SELECT * FROM ayar ORDER BY  ID DESC LIMIT 1 ");
                    while($sonuc = $Sql->fetch_assoc()){
                        echo'


                <img src="'.$sonuc['LOGO'].'" alt="" width="170px" height="100px" s>

                 ';
                         }
                           ?> 
                                </div>
                            </div>
                            <div class="col-xl-9 col-lg-9 col-md-9">
                                <div class="header-banner f-right ">
                                    <img src="assets/img/hero/header_card.jpg" alt="">
                                </div>
                            </div>
                        </div>
                   </div>
                </div>
               <div class="header-bottom header-sticky">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-xl-10 col-lg-10 col-md-12 header-flex">
                                <!-- sticky -->
                                    <div class="sticky-logo">
                                         <?php
                    $Sql = $baglanti->query("SELECT * FROM ayar ORDER BY  ID DESC LIMIT 1 ");
                    while($sonuc = $Sql->fetch_assoc()){
                        echo'


                <img src="'.$sonuc['LOGO'].'" alt="" width="170px" height="100px" s>

                 ';
                         }
                           ?> 
                                       
                                    </div>
                                <!-- Main-menu -->
                                <div class="main-menu d-none d-md-block">
                                    <nav>                  
                                        <ul id="navigation">    
                                            <li><a href="index.html">Home</a></li>
                                            <li><a href="categori.html">Category</a></li>
                                            <li><a href="about.html">About</a></li>
                                            <li><a href="latest_news.html">Latest News</a></li>
                                            <li><a href="contact.html">Contact</a></li>
                                            <li><a href="#">Pages</a>
                                                <ul class="submenu">
                                                    <li><a href="elements.html">Element</a></li>
                                                    <li><a href="blog.html">Blog</a></li>
                                                    <li><a href="single-blog.html">Blog Details</a></li>
                                                    <li><a href="details.html">Categori Details</a></li>
                                                </ul>
                                            </li>
    
                                        </ul>
                                    </nav>
                                </div>
                            </div>             
         <!-- Bakiye Ekle Butonu -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#bakiyeEkleModal">
    Bakiye Ekle
</button>

                            <!-- Mobile Menu -->
                            <div class="col-12">
                                <div class="mobile_menu d-block d-md-none"></div>
                            </div>

                        </div>
                    </div>
               </div>
            </div>

       </div>
        <!-- Header End -->
    </header>

    <main>
    <!-- Trending Area Start -->
   
    <!-- Trending Area End -->
    <!--   Weekly-News start -->
 
    </section>
    <!-- Whats New End -->
    <!--   Weekly2-News start -->
<div class="weekly2-news-area  weekly2-pading gray-bg">
    <?php
    $kur = simplexml_load_file("https://www.tcmb.gov.tr/kurlar/today.xml");

    $usdAlis = $usdSatis = $eurAlis = $eurSatis = "";

    foreach ($kur->Currency as $cur) {
        if ($cur["Kod"] == "USD") {
            $usdAlis  = $cur->ForexBuying;
            $usdSatis = $cur->ForexSelling;
        }

        if ($cur["Kod"] == "EUR") {
            $eurAlis  = $cur->ForexBuying;
            $eurSatis = $cur->ForexSelling;
        }
    }
    ?>

    <div class="row">
<div class="col-md-6"><!-- sol taraf-->



<!-- Bakiye Ekle Modal -->
<div class="modal fade" id="bakiyeEkleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Bakiye Ekle</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="bakiyeEkleForm" enctype="multipart/form-data" method="post" name="bakiyeEkleForm" >
                    <div class="form-group">
                        <label for="cuzdanIsmi">Cüzdan İsmi:</label>
                        <input type="text" class="form-control" id="cuzdanIsmi" name="cuzdanIsmi">
                    </div>
                    <div class="form-group">
                        <label for="bakiyeTutar">Bakiye Tutarı:</label>
                        <input type="number" class="form-control" id="bakiyeTutar" name="bakiyeTutar">
                    </div>
                    <div class="form-group">
                        <label for="dovizTuru">Döviz Türü:</label>
                        <select class="form-control" id="dovizTuru" name="dovizTuru">
                            <option value="USD">USD</option>
                            <option value="EUR">EUR</option>
                            <option value="TRY">TRY</option>
                            <!-- Diğer döviz türleri buraya eklenebilir -->
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Ekle</button>
                </form>
            </div>
        </div>
    </div>
</div>



<!-- Döviz Türü Güncelleme Formu 
<form action="doviz_guncelle.php" method="post">
    <div class="form-group">
        <label for="cuzdanId">Cüzdan ID:</label>
        <input type="text" class="form-control" id="cuzdanId" name="cuzdanId">
    </div>
    <div class="form-group">
        <label for="yeniDovizTuru">Yeni Döviz Türü:</label>
        <select class="form-control" id="yeniDovizTuru" name="yeniDovizTuru">
            <option value="USD">USD</option>
            <option value="EUR">EUR</option>
            <option value="TRY">TRY</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Güncelle</button>
</form>

-->




<?php
// Veritabanındaki cuzdan tablosundan verileri al
$sql = "SELECT * FROM cuzdan";
$result = mysqli_query($baglanti, $sql);
?>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Cüzdan İsmi</th>
            <th>Bakiye Tutarı</th>
            <th>Döviz Türü</th>
            <th>Kar/Zarar</th> <!-- Yeni sütun -->
            <th>İşlemler</th> <!-- Yeni sütun -->
        </tr>
    </thead>
    <tbody>
        <?php
        // Veritabanından gelen verileri tabloya ekle
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row["ID"] . "</td>";
                echo "<td>" . $row["CUZDAN_ISMI"] . "</td>";
                echo "<td>" . $row["BAKIYE_TUTAR"] . "</td>";
                echo "<td>" . $row["DOVIZ_TURU"] . "</td>";
                
                // Kar/Zarar hesaplama
                $oncekiTutar = $row["BAKIYE_TUTAR"];
                $dovizTuru = $row["DOVIZ_TURU"];
                $yenibakiyeTutar = 0;
                switch ($dovizTuru) {
                    case 'USD':
                        $yenibakiyeTutar = $oncekiTutar / $usdAlis;
                        $karZarar = $usdAlis - $row['USDALIS'];
                        break;
                    case 'EUR':
                        $yenibakiyeTutar = $oncekiTutar / $eurAlis;
                        $karZarar = $eurAlis - $row['EURALIS'];
                        break;
                    case 'TRY':
                        $yenibakiyeTutar = $oncekiTutar;
                        $karZarar = 0; // TRY durumunda kar/zarar hesaplanmaz
                        break;
                    default:
                        $yenibakiyeTutar = $oncekiTutar;
                        $karZarar = 0; // Bilinmeyen durumda kar/zarar hesaplanmaz
                        break;
                }
                // Kar veya zarar durumuna göre işaret ekleme
                $isaret = ($karZarar >= 0) ? '+' : '-';
                $karZarar = abs($karZarar); // Negatifse mutlak değeri al
                echo "<td>" . $isaret . $karZarar . "</td>"; // Kar/Zarar sütunu

                echo "<td>";
                echo "<form action='index.php' method='post'>";
                echo "<input type='hidden' name='cuzdanId' value='" . $row["ID"] . "'>";
                echo "<select name='yeniDovizTuru' class='form-control'>";
                echo "<option value='USD'>USD</option>";
                echo "<option value='EUR'>EUR</option>";
                echo "<option value='TRY'>TRY</option>";
                echo "</select>";
                echo "<button type='submit' class='btn btn-primary'>Değiştir</button>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>Tabloda herhangi bir veri yok.</td></tr>";
        }
        ?>
    </tbody>
</table>





<?php
// ... önceki kodlar


// Cuzdan tablosundaki döviz türünü değiştirdiğinizde bakiye tutarını güncelle
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dovizTuru = isset($_POST['DOVIZ_TURU']); // Kullanıcının seçtiği döviz türü
    $cuzdanID = isset($_POST['ID']); // Cuzdan tablosundan alınan cuzdan ID
    $bakiyeTutar = isset($_POST['BAKIYE_TUTAR']); // Cuzdan tablosundan alınan bakiye tutarı
    $yenibakiyeTutar = 0;

    // Güncel döviz kuruna göre bakiye tutarını hesapla
    switch ($dovizTuru) {
        case 'USD':
            $yenibakiyeTutar = $bakiyeTutar / $usdAlis;
            break;
        case 'EUR':
            $yenibakiyeTutar = $bakiyeTutar / $eurAlis;
            break;
        // Diğer döviz türleri için gerekli işlemleri buraya ekleyin
        default:
            $yenibakiyeTutar = $bakiyeTutar; // Döviz türü belirtilmemişse bakiye tutarını değiştirme
            break;
    }

    // Veritabanında cuzdan tablosundaki bakiye tutarını güncelle
    $sql = "UPDATE cuzdan SET BAKIYE_TUTAR='$yenibakiyeTutar', DOVIZ_TURU='$dovizTuru' WHERE ID='$cuzdanID'";
    if (mysqli_query($baglanti, $sql)) {
        echo "Bakiye tutarı başarıyla güncellendi.";
    } else {
        echo "Hata: " . $sql . "<br>" . mysqli_error($baglanti);
    }
}
?>



</div>
        <div class="col-md-6">
    

    <!-- Bakiye Ekleme Modal -->
  

            <h3>Kur Bilgileri Tablosu</h3>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Döviz Cinsi</th>
                        <th>Alış</th>
                        <th>Satış</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>USD</td>
                        <td><?php echo $usdAlis; ?></td>
                        <td><?php echo $usdSatis; ?></td>
                    </tr>
                    <tr>
                        <td>EUR</td>
                        <td><?php echo $eurAlis; ?></td>
                        <td><?php echo $eurSatis; ?></td>
                    </tr>
                    <!-- Diğer dövizler buraya eklenebilir -->
                </tbody>
            </table>

     <div class="modal fade" id="bakiyeModal" tabindex="-1" role="dialog" aria-labelledby="bakiyeModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="bakiyeModalLabel">Bakiye Ekle</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">


                    <!-- Bakiye Ekleme Formu -->
                 <form role="form" id="form1" enctype="multipart/form-data" method="post" name="form1">
                        <div class="form-group">
                            <label for="bakiyeIsim">Bakiye İsmi</label>
                            <input type="text" class="form-control" id="CUZDAN_ISMI" name="CUZDAN_ISMI" placeholder="Bakiye İsmi">
                        </div>
                        <div class="form-group">
                            <label for="bakiyeTutar">Bakiye Tutarı</label>
                            <input type="number" class="form-control" id="BAKIYE_TUTAR" name="BAKIYE_TUTAR" placeholder="Bakiye Tutarı">
                        </div>
                        <div class="form-group">
                            <label for="DOVIZ_TURU">Döviz Türü</label><br>
                            <select class="form-control" id="DOVIZ_TURU" name="DOVIZ_TURU">
                                <option value="TL">TL</option>
                                <option value="USD">USD</option>
                                <option value="EUR">EUR</option>
                                <!-- Diğer para birimleri buraya eklenebilir -->
                            </select>
                        </div><br><br>
                        <button type="submit" class="btn btn-primary">Bakiye Ekle</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
 </div>
        </div>
    </div>
</div>







   
 <div class="slider-container">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <?php
            $sql = "SELECT * FROM haberler";
            $result = $baglanti->query($sql);
            $count = 0;
            while($row = $result->fetch_assoc()) {
                $active_class = ($count == 0) ? 'active' : ''; // İlk öğe için active class ekleyin
                echo '<li data-target="#carouselExampleIndicators" data-slide-to="'.$count.'" class="'.$active_class.'"></li>';
                $count++;
            }
            ?>
        </ol>
        <div class="carousel-inner">
            <?php
            $result = $baglanti->query($sql);
            $count = 0;
            while($row = $result->fetch_assoc()) {
                $active_class = ($count == 0) ? 'active' : ''; // İlk öğe için active class ekleyin
                echo '<div class="carousel-item '.$active_class.'">';
                echo '<img class="d-block w-100" src="'.$row["KAPAKRESMI"].'" alt="'.$row["BASLIK"].'" style="max-width: 600px; max-height: 400px; margin: auto;">';
                echo '<div class="carousel-caption d-none d-md-block">';
                echo '<h1>'.$row["BASLIK"].'</h1>';
                echo '<p>'.$row["KATEGORI"].'</p>';
                echo '</div>';
                echo '</div>';
                $count++;
            }
            ?>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

 <div class="weekly2-news-area  weekly2-pading gray-bg">
        
    </div>   
   <footer>
       <!-- Footer Start-->
       <div class="footer-area footer-padding fix">
            <div class="container">
                <div class="row d-flex justify-content-between">
                   
                   
                    
                    </div>
                </div>
            </div>
       <!-- footer-bottom aera -->
       <div class="footer-bottom-area">
           <div class="container">
               <div class="footer-border">
                    <div class="row d-flex align-items-center justify-content-between">
                        <div class="col-lg-6">
                            <div class="footer-copy-right">
                                <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
  Copyright MURAT ŞİMŞEK 2024 All rights reserved  <i class="ti-heart" aria-hidden="true"></i>
  <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                            </div>
                        </div>
                        
                    </div>
               </div>
           </div>
       </div>
       <!-- Footer End-->
   </footer>
   
    <!-- JS here -->
    
        <!-- All JS Custom Plugins Link Here here -->
        <script src="./assets/js/vendor/modernizr-3.5.0.min.js"></script>
        <!-- Jquery, Popper, Bootstrap -->
        <script src="./assets/js/vendor/jquery-1.12.4.min.js"></script>
        <script src="./assets/js/popper.min.js"></script>
        <script src="./assets/js/bootstrap.min.js"></script>
        <!-- Jquery Mobile Menu -->
        <script src="./assets/js/jquery.slicknav.min.js"></script>

        <!-- Jquery Slick , Owl-Carousel Plugins -->
        <script src="./assets/js/owl.carousel.min.js"></script>
        <script src="./assets/js/slick.min.js"></script>
        <!-- Date Picker -->
        <script src="./assets/js/gijgo.min.js"></script>
        <!-- One Page, Animated-HeadLin -->
        <script src="./assets/js/wow.min.js"></script>
        <script src="./assets/js/animated.headline.js"></script>
        <script src="./assets/js/jquery.magnific-popup.js"></script>

        <!-- Breaking New Pluging -->
        <script src="./assets/js/jquery.ticker.js"></script>
        <script src="./assets/js/site.js"></script>

        <!-- Scrollup, nice-select, sticky -->
        <script src="./assets/js/jquery.scrollUp.min.js"></script>
        <script src="./assets/js/jquery.nice-select.min.js"></script>
        <script src="./assets/js/jquery.sticky.js"></script>
        
        <!-- contact js -->
        <script src="./assets/js/contact.js"></script>
        <script src="./assets/js/jquery.form.js"></script>
        <script src="./assets/js/jquery.validate.min.js"></script>
        <script src="./assets/js/mail-script.js"></script>
        <script src="./assets/js/jquery.ajaxchimp.min.js"></script>
        
        <!-- Jquery Plugins, main Jquery -->    
        <script src="./assets/js/plugins.js"></script>
        <script src="./assets/js/main.js"></script>
        
    </body>
</html>

<script>

 $('#form').submit(function(e) {
    e.preventDefault();
    $.ajax({
      url:"_sorguekle.php",
      method:"post",
      data:$("form").serialize(),
      dataType:"text",
      success:function(strMessage){
        $("Message").text(strMessage);
        $("#form")[0].reset();
        alert("Kullanıcı Başarıyla Eklendi");
        location.reload();
      }
    });

  });
 </script>

<script>
  $(document).ready(function() {
    $('#bakiyeEkleForm').submit(function(e) {
      e.preventDefault();
      $.ajax({
        url: "bakiye_ekle.php",
        method: "post",
        data: $(this).serialize(),
        dataType: "text",
        success: function(strMessage) {
          $("#Message").text(strMessage);
          $('#bakiyeEkleForm')[0].reset();
          alert("Bakiye Başarıyla Eklendi");
          location.reload();
        }
      });
    });
  });
</script>

<script>
$('#form2').submit(function(e) {
    e.preventDefault();
    var formData = new FormData(this);
    var selectedOption = $("#doviz_secenekleri").val(); // Seçilen döviz türünü al

    // FormData nesnesine seçilen döviz türünü ekle
    formData.append("dovizTuru", selectedOption);

    $.ajax({
        url: "guncelle_doviz.php",
        method: "post",
        data: formData,
        dataType: "text",
        contentType: false,
        processData: false,
        success: function(strMessage) {
            $("#Message").text(strMessage);
            $("#form2")[0].reset();
            alert("Döviz türü başarıyla güncellendi");
            location.reload(); // Sayfayı yenile
        }
    });
});
</script>



