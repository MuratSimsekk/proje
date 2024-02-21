<?php
include("php/baglanti.php");

// Formdan gönderilen verileri alın
$ID = $_POST['ID'];
$adsoyad = $_POST['ADSOYAD'];
$eposta = $_POST['EPOSTA'];
$hakkinda = $_POST['HAKKINDA'];
$kadi = $_POST['KADI'];
$sifre = $_POST['SIFRE'];

// Güncelleme sorgusu
$guncelleSorgu = "UPDATE kullanicilar SET ADSOYAD='$adsoyad', EPOSTA='$eposta', HAKKINDA='$hakkinda', KADI='$kadi', SIFRE='$sifre' WHERE ID='$ID'";

// Sorguyu çalıştır ve sonucu kontrol et
if ($baglanti->query($guncelleSorgu) === TRUE) {
    echo "Kullanıcı başarıyla güncellendi";
} else {
    echo "Güncelleme hatası: " . $baglanti->error;
}

// Veritabanı bağlantısını kapat
$baglanti->close();
?>
