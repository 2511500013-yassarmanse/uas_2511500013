<?php
    session_start();
    require_once("config/koneksi.php");
    if(isset($_SESSION['username'])) {
  ?>    
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Starter</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index.php" class="nav-link">Home</a>
      </li>
    </ul>

    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="logout.php">
          <i class="fas fa-sign-out-alt"></i> Logout
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="index.php" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Sistem Masjid</span>
    </a>

    <div class="sidebar">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?= $_SESSION['username']; ?></a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          
          <!-- Dashboard -->
          <li class="nav-item">
            <a href="index.php" class="nav-link <?= ($page == 'dashboard' || $page == '') ? 'active' : ''; ?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>
          </li>
          
          <!-- Menu Master Data -->
          <li class="nav-item menu-open">
            <a href="#" class="nav-link <?= in_array($page, ['jamaah', 'pengurus', 'pemateri', 'kegiatan', 'kas']) ? 'active' : ''; ?>">
              <i class="nav-icon fas fa-database"></i>
              <p>
                Master Data
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?page=jamaah" class="nav-link <?= ($page == 'jamaah') ? 'active' : ''; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Jamaah</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?page=pengurus" class="nav-link <?= ($page == 'pengurus') ? 'active' : ''; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pengurus</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?page=pemateri" class="nav-link <?= ($page == 'pemateri') ? 'active' : ''; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pemateri</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?page=kegiatan" class="nav-link <?= ($page == 'kegiatan') ? 'active' : ''; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Kegiatan Keagamaan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?page=kas" class="nav-link <?= ($page == 'kas') ? 'active' : ''; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Kas Masjid</p>
                </a>
              </li>
            </ul>
          </li>

          <!-- Logout -->
          <li class="nav-item">
            <a href="logout.php" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>Logout</p>
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </aside>

  <!-- Content Wrapper -->
  <div class="content-wrapper">
    <div class="content">
      <div class="container-fluid">
        <?php
        // Ambil halaman dari URL
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        } else { 
            $page = "dashboard";
        }
        
        // Load halaman yang diminta
        if ($page == "dashboard") {
            include "page/dashboard.php";
        } elseif ($page == "jamaah") {
            include "page/jamaah.php";
        } elseif ($page == "pengurus") {
            include "page/pengurus.php";
        } elseif ($page == "pemateri") {
            include "page/pemateri.php";
        } elseif ($page == "kegiatan") {
            include "page/kegiatan.php";
        } elseif ($page == "kas") {
            include "page/kas.php";
        } elseif (file_exists("page/$page.php")) {
            include "page/$page.php";
        } else {
            echo '
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle mr-2"></i> 
                Halaman <strong>' . $page . '</strong> tidak ditemukan!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            ';
        }
        ?>
      </div>
    </div>
  </div>

  <footer class="main-footer">
    <strong>Copyright &copy; 2024 Sistem Informasi Masjid.</strong> All rights reserved.
  </footer>
</div>

<!-- REQUIRED SCRIPTS -->
<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="dist/js/adminlte.min.js"></script>
<!-- DataTables -->
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
</body>
</html>
<?php
    } else {
       echo "<meta http-equiv='refresh' content='0 url=login.php'>";
    }
?>