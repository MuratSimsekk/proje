<?php

include("_header.php");
include("php/baglanti.php");

$ID = $_GET['ID'];

$Sql = $baglanti->query("SELECT * FROM kullanicilar WHERE ID='$ID'");
$okukulaniciCek = $Sql->fetch_assoc();

?>
<?php
$baglanti->select_db('habersite');
?>
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Kullanıcı Güncelle</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="index.php">Anasayfa</a></li>
            <li class="breadcrumb-item active">KullanıcıListele</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <section class="content">
    <div class="col-md-12">
      <!-- Small boxes (Stat box) -->
      <!-- Main row -->
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Kullanıcı Güncelleme Paneli</h3>
        </div>

        <div class="card">
          <form role="form" id="form" enctype="multipart/form-data" method="post" name="form">
            <input type="hidden" name="ID" value="<?php echo $okukulaniciCek['ID']; ?>">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <div class="card-body">
                    <label>Ad Soyad</label>
                    <input type="text" class="form-control" value="<?php echo $okukulaniciCek['ADSOYAD']; ?>" name="ADSOYAD">
                  </div>

                  <div class="card-body">
                    <label>E-posta</label>
                    <input type="email" class="form-control" value="<?php echo $okukulaniciCek['EPOSTA']; ?>" name="EPOSTA">
                  </div>

                  <div class="card-body">
                    <label>Hakkında</label>
                    <textarea name="HAKKINDA" rows="4" class="form-control"><?php echo $okukulaniciCek['HAKKINDA']; ?></textarea>
                  </div>
                  <div class="card-body">
                    <label>Kullanıcı Adı</label>
                    <input type="text" class="form-control" value="<?php echo $okukulaniciCek['KADI']; ?>" name="KADI">
                  </div>
                  <div class="card-body">
                    <label>Şifre</label>
                    <input type="text" class="form-control" value="<?php echo $okukulaniciCek['SIFRE']; ?>" name="SIFRE">
                  </div>
                </div>
              </div>
            </div>

        </div>
        <div class="card-footer">
          <button type="submit" class="btn btn-primary" name="kul_guncelle">Kaydet</button>
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
      url: "_sorguGuncelle.php",
      method: "post",
      data: $("form").serialize(),
      dataType: "text",
      success: function(strMessage) {
        $("Message").text(strMessage);
        $("#form")[0].reset();
        alert("Kullanıcı Başarıyla Güncellendi");
        location.reload();
      }
    });
  });
</script>
