<?php

include("php/baglanti.php");





//Menü Ekleme
$MENUADI = $_POST['MENUADI'];
$MENUSEC = $_POST['MENUSEC'];
$SAYFASEC = $_POST['SAYFASEC'];

if ($_POST['MENUADI']) {
$Sql = "INSERT INTO menular (MENUSEC,MENUADI,SAYFASEC) VALUES ('$MENUSEC', '$MENUADI','$SAYFASEC')";
if ($baglanti->query($Sql) === TRUE) {
    echo "Kategori Eklendi";
} else {
    echo "Error: " . $Sql . "<br>" . $baglanti->error;
}

}
//Kategori Ekleme
$KATEGORIADI = $_POST['KATEGORIADI'];
$sayfasec= $_POST['SAYFASEC'];
if ($_POST['KATEGORIADI']) {

$Sql = "INSERT INTO Kategoriler (KATEGORIADI,SAYFASEC) VALUES ('$KATEGORIADI','$sayfasec')";
if ($baglanti->query($Sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $Sql . "<br>" . $baglanti->error;
}

}

//Kullanıcı EKleme

$ADSOYAD = $_POST['ADSOYAD'];
$EPOSTA = $_POST['EPOSTA'];
$HAKKINDA = $_POST['HAKKINDA'];
$KADI = $_POST['KADI'];
$SIFRE = $_POST['SIFRE'];
if ($_POST['KADI']) {


$sql = "INSERT INTO kullanicilar (ADSOYAD,  EPOSTA, HAKKINDA,KADI, SIFRE) VALUES ('$ADSOYAD','$EPOSTA', '$HAKKINDA','$KADI','$SIFRE')";
if ($baglanti->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $baglanti->error;
}
}





$baglanti->close();




 ?>
