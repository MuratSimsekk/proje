


<?php

include("_header.php");
include("php/baglanti.php");
 ?>
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
     <div class="container-fluid">
       <div class="row mb-2">
         <div class="col-sm-6">
           <h1 class="m-0 text-dark">Haber İşlem Paneli</h1>
         </div><!-- /.col -->
         <div class="col-sm-6">
           <ol class="breadcrumb float-sm-right">
             <li class="breadcrumb-item"><a href="index.php">Anasayfa</a></li>
             <li class="breadcrumb-item active">HaberEkle</li>
           </ol>
         </div><!-- /.col -->
       </div><!-- /.row -->
     </div><!-- /.container-fluid -->
   </section>
   <!-- /.content-header -->
   <!-- Main content -->
   <section class="content">
     <div class="col-md-12">
       <!-- Small boxes (Stat box) -->
       <!-- Main row -->
         <div class="card card-primary">
           <div class="card-header">
             <h3 class="card-title">Haber Ekleme Paneli</h3>
           </div>
           <!-- /.card-header -->




<?php

if(isset($_POST['ICERIK'])) {

$BASLIK = $_POST['BASLIK'];
$ICERIK = $_POST['ICERIK'];

$KATEGORI=$_POST['KATEGORI'];



    $resim_adi = $_FILES['KAPAKRESMI']['name'];
    $resim_tmp = $_FILES['KAPAKRESMI']['tmp_name'];
    $resim_yolu = "../uploads/".$resim_adi;
    move_uploaded_file($resim_tmp, $resim_yolu);
   



$sql = "INSERT INTO haberler (BASLIK, ICERIK,KAPAKRESMI,KATEGORI) VALUES ('$BASLIK', '$ICERIK', '$resim_yolu','$KATEGORI')";
if ($baglanti->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $baglanti->error;
}
}

?>

           <!-- form start -->
           <form role="form" id="form" enctype="multipart/form-data" method="post">

             <?php
             $baglanti->select_db('habersite');

           $sql = $baglanti->query("SELECT KATEGORIADI FROM Kategoriler ");
             ?>
             <div class="card-body">
               <div class="form-group">
                 <label>Başlık</label>
                 <input type="text" class="form-control" id="" placeholder="Başlık" name="BASLIK">
               </div>
               <div class="form-group ">
                 <label>Kategori Seçiniz</label>
                 <select class="form-control" name="KATEGORI">
                   <option>Kategori Seçiniz</option>
                    <?php
                    while($sonuc = $sql->fetch_assoc()){

              echo '<option>'.$sonuc["KATEGORIADI"].'</option>';
                     }
                   ?>
                 </select>
                 <br/>

                 <!--resim ekle-->
                 <label>Dosya Seç</label>
                 <div class="form-group">
                    <input type="file" name="KAPAKRESMI" id="KAPAKRESMI" />
                    <img src="">
               </div>
                       <div class="mb-3">
                           <textarea class="textarea" placeholder="İçerik Yazınız.."
                                     style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"  name="ICERIK"></textarea>
                         </div>
                         <div class="form-check">
                 <label class="form-check-label" for="exampleCheck1">Yayınla</label>
               </div>
             </div>
             <!-- /.card-body -->

             <div class="card-footer">
               <button type="submit" class="btn btn-primary" name="submit" id="submit">Haber Ekle</button>
             </div>
           </form>
         </div>
     </div><!-- /.container-fluid -->
   </section>
   <!-- /.content -->
 </div>
 <!-- /.content-wrapper -->

<?php



include("footer.php");


 ?>

<!--
 <script>

 $('#form').submit(function(e) {
    e.preventDefault();
    $.ajax({
      url:"_sorguEkle.php",
      method:"post",
      data:$("form").serialize(),
      dataType:"text",
      success:function(strMessage){
        $("Message").text(strMessage);
        $("#form")[0].reset();
        alert("yazı Başarıyla Eklendi");
        location.reload();
      }
    });

  });
 </script>
-->
<script>
 $('#form').submit(function(e) {
  e.preventDefault();
  var formData = new FormData(this);
  $.ajax({
    url: "yaziEkle.php",
    method: "post",
    data: formData,
    dataType: "text",
    contentType: false,
    processData: false,
    success: function(strMessage) {
      $("#Message").text(strMessage);
      $("#form")[0].reset();
      alert("Yazı veya resim başarıyla eklendi");
      location.reload();
    }
  });
});

 </script>