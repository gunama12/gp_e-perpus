<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="gp_e-perpus">
    <title>E-Perpus</title>
    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">
    <script src="<?php echo base_url(); ?>assets/js/jquery-3.2.1.min.js"></script>
  </head>

  <body>
    <!-- Static navbar -->
    <nav class="navbar navbar-default navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">E-Perpus</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#"><i class="glyphicon glyphicon-home"></i> Halaman Depan</a></li>
            <li><a href="#about">Info</a></li>
            <?php 
              if($this->ion_auth->logged_in()) {
                if($this->ion_auth->is_admin())  {
            ?>
            <li><a href="<?php echo base_url(); ?>pemesanan">Pemesanan</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Peminjaman<span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="<?php echo base_url(); ?>peminjaman">List Peminjaman</a></li>
                <li><a href="<?php echo base_url(); ?>peminjaman/pinjam_buku">Input Peminjaman</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Pengembalian<span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="<?php echo base_url(); ?>pengembalian">List Pegembalian</a></li>
                <li><a href="<?php echo base_url(); ?>pengembalian/form_pengembalian">Input Pengembalian</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Data Master<span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="<?php echo base_url(); ?>buku">Buku</a></li>
                <li><a href="<?php echo base_url(); ?>anggota">Anggota</a></li>
                <li><a href="<?php echo base_url(); ?>kategori">Kategori</a></li>
                <li><a href="<?php echo base_url(); ?>setting">Setting</a></li>
                <!-- <li class="divider"></li>
                <li class="dropdown-header">Transaksi</li>
                <li><a href="<?php echo base_url(); ?>peminjaman">Peminjaman</a></li>
                <li><a href="<?php echo base_url(); ?>pengembalian">Pengembalian</a></li> -->
              </ul>
            </li>
            <?php } else { ?>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Transaksi<span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="<?php echo base_url(); ?>pemesanan">Pemesanan</a></li>
                <li><a href="<?php echo base_url(); ?>peminjaman">Peminjaman</a></li>
                <li><a href="<?php echo base_url(); ?>pengembalian">Pengembalian</a></li>
              </ul>
            </li>
            <?php }
                }
            ?>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <?php if ($this->ion_auth->logged_in()) { ?>
            <li><a href="<?php echo base_url(); ?>auth/change_password">Hai, <?=$this->session->userdata['username']?></a></li>
            <li><a href="<?php echo base_url(); ?>auth/logout">Logout</a></li>
            <?php } else { ?>
            <li><a href="<?php echo base_url(); ?>auth/login">Login</a></li>
            <?php } ?>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>