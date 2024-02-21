<?php



$hostadresi        =	"localhost";
$kullaniciadi      =	"root";
$sifre             =	"";
$veritabani        =	"proje";

$baglanti = mysqli_connect($hostadresi,$kullaniciadi,$sifre,$veritabani);
if (mysqli_connect_errno())
{
    echo "MySQL bağlantısı başarısız: " . mysqli_connect_error();

}

$AnaSayfa = "http://localhost/habersite/index.php";

$baglanti->set_charset("utf8");
$baglanti->query('SET NAMES utf8');




 ?>
