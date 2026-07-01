<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">
                    <i class="fas fa-user-plus text-success mr-2"></i> Tambah Jamaah
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="index.php"><i class="fas fa-home"></i> Home</a></li>
                    <li class="breadcrumb-item"><a href="index.php?page=jamaah">Data Jamaah</a></li>
                    <li class="breadcrumb-item active">Tambah Jamaah</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<?php
if(isset($_POST['simpan'])){
    $nia = mysqli_real_escape_string($koneksi, $_POST['nia']);
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);
    $no_telp = mysqli_real_escape_string($koneksi, $_POST['no_telp']);
    $jk = mysqli_real_escape_string($koneksi, $_POST['jk']);
    $tgl_daftar = mysqli_real_escape_string($koneksi, $_POST['tgl_daftar']);
    $status = mysqli_real_escape_string($koneksi, $_POST['status']);
    
    // Cek NIA sudah ada
    $cek = mysqli_query($koneksi, "SELECT * FROM jamaah WHERE nia='$nia'");
    if(mysqli_num_rows($cek) > 0){
        echo '
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle mr-2"></i> NIA sudah terdaftar!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        ';
    } else {
        $query = mysqli_query($koneksi, "INSERT INTO jamaah (nia, nama_jamaah, alamat, no_telp, jenis_kelamin, tanggal_daftar, status) 
                                         VALUES ('$nia', '$nama', '$alamat', '$no_telp', '$jk', '$tgl_daftar', '$status')");
        if($query){
            echo '
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle mr-2"></i> Data jamaah berhasil ditambahkan!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <meta http-equiv="refresh" content="1;url=index.php?page=jamaah">
            ';
        } else {
            echo '
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle mr-2"></i> Gagal menambahkan data!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            ';
        }
    }
}
?>

<div class="content">
    <div class="container-fluid">
        <div class="card card-outline card-success">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-user-plus mr-2"></i> Form Tambah Jamaah Masjid
                </h3>
                <div class="card-tools">
                    <a href="index.php?page=jamaah" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left mr-1"></i> Kembali
                    </a>
                </div>
            </div>
            <div class="card-body">
                <form method="POST" action="">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nia">
                                    <i class="fas fa-id-card text-primary mr-1"></i> NIA (Nomor Induk Jamaah)
                                </label>
                                <input type="text" name="nia" id="nia" class="form-control" 
                                       placeholder="Contoh: J001" required>
                                <small class="text-muted">NIA harus unik</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama">
                                    <i class="fas fa-user text-primary mr-1"></i> Nama Lengkap
                                </label>
                                <input type="text" name="nama" id="nama" class="form-control" 
                                       placeholder="Nama lengkap jamaah" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="alamat">
                                    <i class="fas fa-home text-primary mr-1"></i> Alamat
                                </label>
                                <textarea name="alamat" id="alamat" class="form-control" 
                                          placeholder="Alamat lengkap" rows="2"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="no_telp">
                                    <i class="fas fa-phone text-primary mr-1"></i> No Telepon
                                </label>
                                <input type="text" name="no_telp" id="no_telp" class="form-control" 
                                       placeholder="Contoh: 081234567890">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="jk">
                                    <i class="fas fa-venus-mars text-primary mr-1"></i> Jenis Kelamin
                                </label>
                                <select name="jk" id="jk" class="form-control" required>
                                    <option value="L">Laki-laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="tgl_daftar">
                                    <i class="fas fa-calendar-alt text-primary mr-1"></i> Tanggal Daftar
                                </label>
                                <input type="date" name="tgl_daftar" id="tgl_daftar" class="form-control" 
                                       value="<?= date('Y-m-d'); ?>" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="status">
                                    <i class="fas fa-check-circle text-primary mr-1"></i> Status
                                </label>
                                <select name="status" id="status" class="form-control">
                                    <option value="aktif">Aktif</option>
                                    <option value="nonaktif">Nonaktif</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-3">
                        <button type="submit" name="simpan" class="btn btn-success">
                            <i class="fas fa-save mr-1"></i> Simpan
                        </button>
                        <button type="reset" class="btn btn-secondary">
                            <i class="fas fa-undo mr-1"></i> Reset
                        </button>
                        <a href="index.php?page=jamaah" class="btn btn-danger">
                            <i class="fas fa-times mr-1"></i> Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>