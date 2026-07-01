<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">
                    <i class="fas fa-user-edit text-warning mr-2"></i> Edit Jamaah
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="index.php"><i class="fas fa-home"></i> Home</a></li>
                    <li class="breadcrumb-item"><a href="index.php?page=jamaah">Data Jamaah</a></li>
                    <li class="breadcrumb-item active">Edit Jamaah</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<?php
$id = mysqli_real_escape_string($koneksi, $_GET['id']);
$edit = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM jamaah WHERE id_jamaah='$id'"));

if(!$edit){
    echo '
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fas fa-exclamation-circle mr-2"></i> Data tidak ditemukan!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <meta http-equiv="refresh" content="1;url=index.php?page=jamaah">
    ';
    exit;
}

if(isset($_POST['simpan'])){
    $nia = mysqli_real_escape_string($koneksi, $_POST['nia']);
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);
    $no_telp = mysqli_real_escape_string($koneksi, $_POST['no_telp']);
    $jk = mysqli_real_escape_string($koneksi, $_POST['jk']);
    $status = mysqli_real_escape_string($koneksi, $_POST['status']);
    
    $query = mysqli_query($koneksi, "UPDATE jamaah SET 
                                     nia='$nia', 
                                     nama_jamaah='$nama', 
                                     alamat='$alamat', 
                                     no_telp='$no_telp', 
                                     jenis_kelamin='$jk', 
                                     status='$status' 
                                     WHERE id_jamaah='$id'");
    if($query){
        echo '
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle mr-2"></i> Data jamaah berhasil diupdate!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <meta http-equiv="refresh" content="1;url=index.php?page=jamaah">
        ';
    } else {
        echo '
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle mr-2"></i> Gagal mengupdate data!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        ';
    }
}
?>

<div class="content">
    <div class="container-fluid">
        <div class="card card-outline card-warning">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-user-edit mr-2"></i> Form Edit Jamaah
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
                                    <i class="fas fa-id-card text-primary mr-1"></i> NIA
                                </label>
                                <input type="text" name="nia" id="nia" class="form-control" 
                                       value="<?= $edit['nia']; ?>" readonly>
                                <small class="text-muted">NIA tidak dapat diubah</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama">
                                    <i class="fas fa-user text-primary mr-1"></i> Nama Lengkap
                                </label>
                                <input type="text" name="nama" id="nama" class="form-control" 
                                       value="<?= $edit['nama_jamaah']; ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="alamat">
                                    <i class="fas fa-home text-primary mr-1"></i> Alamat
                                </label>
                                <textarea name="alamat" id="alamat" class="form-control" rows="2"><?= $edit['alamat']; ?></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="no_telp">
                                    <i class="fas fa-phone text-primary mr-1"></i> No Telepon
                                </label>
                                <input type="text" name="no_telp" id="no_telp" class="form-control" 
                                       value="<?= $edit['no_telp']; ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="jk">
                                    <i class="fas fa-venus-mars text-primary mr-1"></i> Jenis Kelamin
                                </label>
                                <select name="jk" id="jk" class="form-control" required>
                                    <option value="L" <?= $edit['jenis_kelamin'] == 'L' ? 'selected' : ''; ?>>Laki-laki</option>
                                    <option value="P" <?= $edit['jenis_kelamin'] == 'P' ? 'selected' : ''; ?>>Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="status">
                                    <i class="fas fa-check-circle text-primary mr-1"></i> Status
                                </label>
                                <select name="status" id="status" class="form-control">
                                    <option value="aktif" <?= $edit['status'] == 'aktif' ? 'selected' : ''; ?>>Aktif</option>
                                    <option value="nonaktif" <?= $edit['status'] == 'nonaktif' ? 'selected' : ''; ?>>Nonaktif</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-3">
                        <button type="submit" name="simpan" class="btn btn-warning">
                            <i class="fas fa-save mr-1"></i> Update
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