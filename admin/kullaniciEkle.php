
<?php

include("_header.php");

include("php/baglanti.php");

?>
 <div class="content-wrapper">

   <div class="content-header">
     <div class="container-fluid">
       <div class="row mb-2">
         <div class="col-sm-6">
           <h1 class="m-0 text-dark">Kullanıcı Ekle</h1>
         </div><!-- /.col -->
         <div class="col-sm-6">
           <ol class="breadcrumb float-sm-right">
             <li class="breadcrumb-item"><a href="#">Anasayfa</a></li>
             <li class="breadcrumb-item active">KullanıcıEkleme</li>
           </ol>
         </div><!-- /.col -->
       </div><!-- /.row -->
     </div><!-- /.container-fluid -->
   </div>


 <section class="content">
   <div class="col-md-12">
     <!-- Small boxes (Stat box) -->
     <!-- Main row -->
       <div class="card card-primary">
         <div class="card-header">
           <h3 class="card-title">Kullanici Ekleme Paneli</h3>
         </div>
           </div>
         <div class="card">
       <form role="form" id="form" enctype="multipart/form-data" method="post" name="form">
         <div class="row">
         <div class="col-md-6">
           <div class="form-group">
             <div class="card-body">
           <label>Ad Soyad</label>
            <input type="text" class="form-control" id="" placeholder="Ad Soyad Giriniz" name="ADSOYAD">
         </div>
         <div class="card-body">
           <label>E-posta</label>
           <input type="email" class="form-control" id="" placeholder="E posta Giriniz" name="EPOSTA">
         </div>
         <div class="card-body">
           <label>Hakkında</label>
          <textarea name="HAKKINDA" rows="4" class="form-control"></textarea>
         </div>
         <div class="card-body">
           <label>Kullanıcı Adı</label>
           <input type="text" class="form-control" id="" placeholder="Kullanıcı Adı Giriniz" name="KADI">
         </div>
         <div class="card-body">
           <label>Şifre</label>
           <input type="password" class="form-control" id="" placeholder="Şifre Giriniz" name="SIFRE">
         </div>
         <div class="card-footer">
           <button type="submit" class="btn btn-primary">Kaydet</button>
         </div>
         </div>
         </div>
         
       </form>
     </div>


</div>

 </section>
</div>



<?php

include("footer.php");



 ?>

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
        alert("Kullanıcı Başarıyla Eklendi");
        location.reload();
      }
    });

  });
 </script>
