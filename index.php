<?php
session_start();
include "config.php";
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sistem pakar gejala penyakit pada remaja</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/datatables.min.css" />
    <link rel="stylesheet" href="assets/css/all.css" />
    <link rel="stylesheet" href="stylee.css">
  </head>

  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">
          <img src="images/beranda.png" alt="Avatar Logo" style="width:60px;" class="rounded-pill"> 
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="nav-link" href="index.php">Home</a>
            </li>

            <!-- seting akses dokter -->
            <?php 
                if($_SESSION['role']=="Dokter"){
                ?>
              <li class="nav-item">
                <a class="nav-link" href="?page=aturan">Basis Aturan</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="?page=konsultasiadm">Konsultasi</a>
              </li>
            <?php
            }elseif($_SESSION['role']=="Admin") {
            ?>
              <li class="nav-item">
                <a class="nav-link" href="?page=users">User</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="?page=gejala">Gejala</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="?page=penyakit">Penyakit</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="?page=aturan">Basis Aturan</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="?page=konsultasiadm">Konsultasi</a>
              </li>
            <?php
            }else{
            ?>
              <li class="nav-item">
                <a class="nav-link" href="?page=konsultasi">Konsultasi</a>
              </li>
            <?php
              }
            ?>
            <li class="nav-item">
              <a class="nav-link" href="?page=logout" class="action_btn">Logout</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <?php 
        if($_SESSION['status']!="y"){
            header("Location:login.php");
        }
    ?>

    <div class="container pt-2">
      <?php
        $page = isset($_GET['page']) ? $_GET['page'] : "";
        $action = isset($_GET['action']) ? $_GET['action'] : "";

        if ($page==""){
            include "home.php";
        } elseif ($page=="gejala"){
            if ($action==""){
                include "tampil_gejala.php";
            } elseif ($action=="tambah"){
                include "tambah_gejala.php";
            } elseif ($action=="update"){
                include "update_gejala.php";
            } else {
                include "hapus_gejala.php";
            }
        } elseif ($page=="penyakit"){
            if ($action==""){
                include "tampil_penyakit.php";
            } elseif ($action=="tambah"){
                include "tambah_penyakit.php";
            } elseif ($action=="update"){
                include "update_penyakit.php";
            } else {
                include "hapus_penyakit.php";
            }
        } elseif ($page=="aturan"){
            if ($action==""){
                include "tampil_aturan.php";
            } elseif ($action=="tambah"){
                include "tambah_aturan.php";
            } elseif ($action=="detail"){
                include "detail_aturan.php";
            } elseif ($action=="update"){
                include "update_aturan.php";
            } elseif ($action=="hapus_gejala"){
                include "hapus_detail_aturan.php";
            } else {
                include "hapus_aturan.php";
            }
        } elseif ($page=="konsultasi"){
            if ($action==""){
                include "tampil_konsultasi.php";
            } else {
                include "hasil_konsultasi.php";
            }
        } elseif ($page=="konsultasiadm"){
            if ($action==""){
                include "tampil_konsultasiadm.php";
            } else {
                include "detail_konsultasiadm.php";
            }
        } elseif ($page=="users"){
            if ($action==""){
                include "tampil_users.php";
            } elseif ($action=="tambah"){
                include "tambah_users.php";
            } elseif ($action=="update"){
                include "update_users.php";
            } else {
                include "hapus_users.php";
            }
        } else {
            include "logout.php";
        }
      ?>
    </div>

    <script src="assets/js/jquery-3.7.0.min.js"></script>
    <script src="assets/js/datatables.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/all.js"></script>
    <script>
      $(document).ready(function(){
        $('#myTable').DataTable();
      })
    </script>

    <script>
      $(function() {
        $('.chosen').chosen();
      });
    </script>
  </body>
</html>
