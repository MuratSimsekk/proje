
<?php
include("php/baglanti.php");

if(isset($_GET['delete'])) {
  $ID = $_GET['delete'];

  // Yazıyı veritabanından silme işlemi gerçekleştirilir.
  $sil = "DELETE FROM ayar WHERE ID='$ID'";
  $result = mysqli_query($baglanti, $sil);

  // Silme işlemi başarılıysa yaziListele.php sayfasına yönlendirilir.
  if($result) {
    header("Location: Ayar.php");
  }
}
?>



<?php



include("_header.php");



include("php/baglanti.php");
if (isset($_FILES["fileToUpload"])) {
$target_dir = "../LogoImg/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($target_file)) {
  echo "Sorry, file already exists.";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
   echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"]));
    
    // save the image path to the database
    $image_path = $target_file;
   
    $sql = "INSERT INTO ayar (LOGO) VALUES ('$image_path')";
    mysqli_query($baglanti, $sql);
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}
}

/*

// Resim yükleme işlemi
if(isset($_POST['submit'])) {
    $resim_adi = $_FILES['resim']['name'];
    $resim_tmp = $_FILES['resim']['tmp_name'];
    $resim_yolu = "../uploads/".$resim_adi;
    move_uploaded_file($resim_tmp, $resim_yolu);

    // Veritabanına kaydetme
    $sql = "INSERT INTO siteayar (LOGO) VALUES ('$resim_yolu')";
    mysqli_query($baglanti, $sql);
}

*/

 ?>
<style type="text/css">
body {
  font-family: Arial, sans-serif;
  background-color: #f7f7f7;
}

h1 {
  text-align: center;
  margin-top: 30px;
}

form {
  max-width: 500px;
  margin: 0 auto;
  background-color: #fff;
  padding: 20px;
  border-radius: 5px;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
}

label {
  display: block;
  font-weight: bold;
  margin-bottom: 10px;
}

input[type="file"] {
  display: block;
  margin-bottom: 20px;
}

input[type="submit"] {
  background-color: #4CAF50;
  color: #fff;
  border: none;
  padding: 10px 20px;
  border-radius: 5px;
  cursor: pointer;
}
</style>

 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <div class="content-header">
     <div class="container-fluid">
       <div class="row mb-2">
         <div class="col-sm-6">
         </div><!-- /.col -->
         <div class="col-sm-6">
           <ol class="breadcrumb float-sm-right">
             <li class="breadcrumb-item"><a href="#">Anasayfa</a></li>
             <li class="breadcrumb-item active">LogoEkle</li>
           </ol>
         </div><!-- /.col -->
       </div><!-- /.row -->
     </div><!-- /.container-fluid -->
   </div>
   <!-- /.content-header -->

   <!-- Main content -->
   <section class="content">
     <div class="container-fluid">
       <!-- Small boxes (Stat box) -->




<form action="" method="post" enctype="multipart/form-data" name="form" id="form">
  <div class="card card-primary">
     <div class="card-header">
           <h3 class="card-title">Logo Ekleme Paneli</h3>
         </div>
    <div>
<br>
      <label for="logo" >Logo Seçin:</label>
     <input type="file" name="fileToUpload">
    </div>
    <div>
      <button type="submit" class="btn btn-primary" name="submit">Logo Yükle</button>
    </div>



<table class="table table-hover">
              <tr><br>
                <th>ID</th>
                <th>Logo</th>
              
              </tr>
              <?php


    $sql = $baglanti->query("SELECT * FROM ayar ORDER BY ID DESC ");

 // Sonuçları Alalım.
  while($sonuc = $sql->fetch_assoc()){
    $ID = $sonuc['ID']; // Veritabanından çektiğimiz id satırını $id olarak tanımlıyoruz.
    $LOGO = $sonuc['LOGO'];
    echo '<tr>';
      echo '<td>'.$sonuc["ID"].'</td>';
      echo '<td><img src="'.$sonuc['LOGO'].'"></td>';

     echo '<td>';

 
      echo '<a href="Ayar.php?delete='.$sonuc['ID'].'" class="btn btn-danger" name= "delete"><i class="fa fa-minus-circle" aria-hidden="true"></i></a>';
      echo '</td>';

      echo '</tr>';


  }
               ?>
             </table>





















  </form>


       <!-- Main row -->
       <div class="row">


         <!-- right col -->
       </div>
       <!-- /.row (main row) -->
     </div><!-- /.container-fluid -->
   </section>


   <!-- /.content -->
 </div>
 <!-- /.content-wrapper -->


<?php



include("footer.php");





 ?>

<script>

  $('#form').submit(function(e) {
    e.preventDefault();
    var formData = new FormData($(this)[0]);

    $.ajax({
      url: "Ayar.php",
      type: "POST",
      data: formData,
      contentType: false,
      processData: false,
      success: function(strMessage){
        $("Message").text(strMessage);
        $("#form")[0].reset();
        alert("Resim Başarıyla Eklendi");
        location.reload();
      }
    });

  });

</script>
