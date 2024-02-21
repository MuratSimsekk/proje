<?php
//Veri tabanı ile bağlantıyı include komutu ile içe aktarıyoruz.
include("../admin/php/baglanti.php");
ob_start();
  session_start();
if($_POST['KUL_ADI'])
{

//Formumuzdan POST methodu ile aldığımız kullanıcı adı ve şifreyi değişkene atıyoruz.
$KUL_ADI = $_POST['KUL_ADI'];
$SIFRE = $_POST['SIFRE'];
//Forma girilen kullanıcı adını veri tabanımızda böyle bir kullanıcı var mı eşleştiriyoruz.
$sql = "SELECT * FROM uyeler WHERE KUL_ADI='$KUL_ADI' AND SIFRE='$SIFRE'";
$sonuc = $baglanti->query($sql);
if ($sonuc->num_rows > 0)
{
  //Eğer var ise BAŞARILI komutunu veriyoruz.
  $_SESSION["LOGIN"] = "true";
  $_SESSION["KUL_ADI"] =$KUL_ADI;
  $_SESSION["SIFRE"] =$SIFRE;
  header("Location:index.php");

}
else {
    if ($KUL_ADI=="" or $SIFRE=="") {
      echo "<center>Bu alanları boş bırakamazsınız.</center>";
    }
    else {
        echo "<center>Kullanıcı adı veya Şifreniz yanlış <br><a href=javascript:history.back(-1)>Geri Don</a></center>";
    }
}



}
ob_end_flush();

?>
