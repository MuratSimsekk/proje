
<?php

include("php/baglanti.php");




 ?>
<!-- Sidebar Menu -->
<nav class="mt-2">
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <!-- Add icons to the links using the .nav-icon class
         with font-awesome or any other icon font library -->

    <li class="nav-header">Site Ayarları</li>
<style>
    p {
        color: #d3d3d3;
    }
</style>
        <li class="nav-item has-treeview">
      <a href="Ayar.php" class="nav-link">
        <i class="nav-icon fas fa-book"></i>
        <p>
          Ayarlar
          <i class="fas fa-angle-left right"></i>
        </p>
      </a>
      
    </li>
    <li class="nav-item has-treeview">
      <a href="#" class="nav-link">
        <i class="nav-icon far fa fa-edit"></i>
        <p>
          Haberler
          <i class="fas fa-angle-left right"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="yaziEkle.php" class="nav-link">
          <i class="far fa fa-plus-circle nav-icon"></i>
            <p>Haber Ekle</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="YaziListele.php" class="nav-link">
            <i class="far fa fa-list nav-icon"></i>
            <p>Haber Listele</p>
          </a>
        </li>
      </ul>
    </li>

  <li class="nav-item has-treeview">
    <a href="#" class="nav-link">
    <i class="fa fa-cogs" aria-hidden="true"></i>
      <p>
        Kullanici Ayarları
        <i class="fas fa-angle-left right"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      <li class="nav-item">
        <a href="kullaniciEkle.php" class="nav-link">
          <i class="far fa fa-plus-circle nav-icon"></i>
          <p>Kullanıcı Ekle</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="kullaniciListele.php" class="nav-link">
          <i class="far fa fa-list nav-icon"></i>
          <p>Kullanıcı Listele</p>
        </a>
      </li>

    </ul>
  </li>


  </ul>
</nav>
