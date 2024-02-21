<?php
// Veritabanı bağlantısı ve diğer gerekli dosyaların dahil edilmesi
include '../admin/php/baglanti.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Form verilerini al
    $cuzdanIsmi = $_POST['cuzdanIsmi'];
    $bakiyeTutar = $_POST['bakiyeTutar'];
    $dovizTuru = $_POST['dovizTuru'];

    // Veritabanına ekle
    $sql = "INSERT INTO cuzdan (CUZDAN_ISMI, BAKIYE_TUTAR, DOVIZ_TURU) VALUES ('$cuzdanIsmi', '$bakiyeTutar', '$dovizTuru')";
    if (mysqli_query($baglanti, $sql)) {
        echo "Bakiye başarıyla eklendi.";
    } else {
        echo "Hata: " . $sql . "<br>" . mysqli_error($baglanti);
    }

    mysqli_close($baglanti);
}
?>
