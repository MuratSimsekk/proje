<?php
//Veri tabanı ile bağlantıyı include komutu ile içe aktarıyoruz.
include("php/baglanti.php");
ob_start();
  session_start();
if($_POST['KADI'])
{

//Formumuzdan POST methodu ile aldığımız kullanıcı adı ve şifreyi değişkene atıyoruz.
$KADI = $_POST['KADI'];
$SIFRE = $_POST['SIFRE'];
//Forma girilen kullanıcı adını veri tabanımızda böyle bir kullanıcı var mı eşleştiriyoruz.
$sql = "SELECT * FROM kullanicilar WHERE KADI='$KADI' AND SIFRE='$SIFRE'";
$sonuc = $baglanti->query($sql);
if ($sonuc->num_rows > 0)
{
  //Eğer var ise BAŞARILI komutunu veriyoruz.
  $_SESSION["LOGIN"] = "true";
  $_SESSION["KADI"] =$KADI;
  $_SESSION["SIFRE"] =$SIFRE;
  header("Location:index.php");

}
else {
    if ($KADI=="" or $SIFRE=="") {
      echo "<center>Bu alanları boş bırakamazsınız.</center>";
    }
    else {
        echo "<center>Kullanıcı adı veya Şifreniz yanlış <br><a href=javascript:history.back(-1)>Geri Don</a></center>";
    }
}



}
ob_end_flush();

?>
