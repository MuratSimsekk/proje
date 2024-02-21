<?php
include("php/baglanti.php");

// Formdan gönderilen verileri alın
$ID = $_POST['ID'];
$BASLIK = $_POST['BASLIK'];
$ICERIK = $_POST['ICERIK']; 

// Güncelleme sorgusu
$guncelleSorgu = "UPDATE haberler SET BASLIK='$BASLIK', ICERIK='$ICERIK' WHERE ID='$ID'";

// Sorguyu çalıştır ve sonucu kontrol et
if ($baglanti->query($guncelleSorgu) === TRUE) {
    echo "Haber başarıyla güncellendi";
} else {
    echo "Güncelleme hatası: " . $baglanti->error;
}

// Veritabanı bağlantısını kapat
$baglanti->close();
?>
