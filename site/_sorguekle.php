<?php

include("../admin/php/baglanti.php");


//Kullanıcı EKleme

$KUL_ADI = $_POST['KUL_ADI'];
$EMAIL = $_POST['EMAIL'];
$SIFRE = $_POST['SIFRE'];
if ($_POST['KUL_ADI']) {


$sql = "INSERT INTO uyeler (KUL_ADI,EMAIL,SIFRE) VALUES ('$KUL_ADI','$EMAIL','$SIFRE')";
if ($baglanti->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $baglanti->error;
}
}


//Bakiye ekleme
$CUZDAN_ISMI = $_POST['CUZDAN_ISMI'];
$BAKIYE_TUTAR = $_POST['BAKIYE_TUTAR'];
$DOVIZ_TURU= $_POST['DOVIZ_TURU'];
if ($_POST['CUZDAN_ISMI']) {


$sql = "INSERT INTO cuzdan (CUZDAN_ISMI,BAKIYE_TUTAR,DOVIZ_TURU) VALUES ('$CUZDAN_ISMI','$BAKIYE_TUTAR','$DOVIZ_TURU')";
if ($baglanti->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $baglanti->error;
}
}

$baglanti->close();

 ?>
