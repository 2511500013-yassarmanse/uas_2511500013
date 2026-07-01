<?php
include "config/koneksi.php";
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <?php if(isset($_SESSION['error'])): ?>
        <div class="alert alert-danger">
          <?= $_SESSION['error']; ?>
        </div>
        <?php unset($_SESSION['error']); ?>
      <?php endif; ?>

      <?php if(isset($_SESSION['success'])): ?>
        <div class="alert alert-success">
          <?= $_SESSION['success']; ?>
        </div>
        <?php unset($_SESSION['success']); ?>
      <?php endif; ?>

      <form method="POST">
        <div class="form-group">
          <input type="text" name="username" class="form-control" placeholder="Username" required>
        </div>
        <div class="form-group">
          <input type="password" name="password" class="form-control" placeholder="Password" required>
        </div>
        <button type="submit" name="login" class="btn btn-primary btn-block">Login</button>
      </form>
      
      <div class="mt-3 text-center">
        <small>Username: admin | Password: admin123</small>
      </div>
    </div>
  </div>
</div>

<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
if(isset($_POST['login'])){
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = mysqli_real_escape_string($koneksi, $_POST['password']);
    
    if(empty($username) || empty($password)){
        $_SESSION['error'] = "Username dan Password tidak boleh kosong!";
        header("location:login.php");
        exit();
    }
    
    // Coba login dengan 3 cara berbeda
    
    // Cara 1: MD5
    $sql1 = "SELECT * FROM users WHERE username='$username' AND password=MD5('$password')";
    $result1 = mysqli_query($koneksi, $sql1);
    
    // Cara 2: Plain Text
    $sql2 = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result2 = mysqli_query($koneksi, $sql2);
    
    if(mysqli_num_rows($result1) > 0){
        $data = mysqli_fetch_array($result1);
        $_SESSION['username'] = $data['username'];
        $_SESSION['level'] = $data['level'];
        $_SESSION['user_id'] = $data['id'];
        $_SESSION['success'] = "Login berhasil! Selamat datang " . $data['username'];
        header("location:index.php");
        exit();
    } elseif(mysqli_num_rows($result2) > 0){
        $data = mysqli_fetch_array($result2);
        $_SESSION['username'] = $data['username'];
        $_SESSION['level'] = $data['level'];
        $_SESSION['user_id'] = $data['id'];
        $_SESSION['success'] = "Login berhasil! Selamat datang " . $data['username'];
        header("location:index.php");
        exit();
    } else {
        $_SESSION['error'] = "Login gagal! Username atau password salah.";
        header("location:login.php");
        exit();
    }
}
?>