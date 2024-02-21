
<?php
include("php/baglanti.php");

$kutuphane = mysqli_query("SELECT * FROM yazilar");

while ($cekilen_veri =fetch_assoc($kutuphane)){
  extract($cekilen_veri);

  echo "------------------------</br>";
  echo "Başlık: ".$BASLIK."</br>";
  echo "İçerik: ".$ICERIK."</br>";

}


?>
