<!--Logout.php-->
<?php
include("php/baglanti.php");
//oturumu sonlandırıyoruz
session_start();
session_destroy();

//çerezi siliyoruz
setcookie("cerez", "", time()-3600);

//sayfayı yönlendiriyoruz
header("location:login.php");
?><!--Logout.php-->
