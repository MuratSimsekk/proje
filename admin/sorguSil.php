<?php
include("_header.php");

include("php/baglanti.php");

if (isset($_GET['ID'])) {
  $ID = $_GET['ID'];
  
  // Güvenli sorgu için prepared statement kullanımı
  if ($baglanti) {
    $stmt = $baglanti->prepare("DELETE FROM kullanicilar WHERE ID = ?");
    $stmt->bind_param("i", $ID);
    $stmt->execute();
    
    // Sorgu sonucunu kontrol et
    if ($stmt->affected_rows > 0) {
      echo "Kullanıcı silindi.";
    } else {
      echo "Kullanıcı silinirken bir hata oluştu.";
    }
    
    $stmt->close();
  } else {
    echo "Veritabanı bağlantısı başarısız.";
  }
}
 header("Location: kullaniciListele.php");
?>
