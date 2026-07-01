<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">
                    <i class="fas fa-user-edit text-warning mr-2"></i> Edit Pemateri
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="index.php"><i class="fas fa-home"></i> Home</a></li>
                    <li class="breadcrumb-item"><a href="index.php?page=pemateri">Data Pemateri</a></li>
                    <li class="breadcrumb-item active">Edit Pemateri</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<?php
$id = mysqli_real_escape_string($koneksi, $_GET['id']);
$edit = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM pemateri WHERE id_pemateri='$id'"));

if(!$edit){
    echo '
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fas fa-exclamation-circle mr-2"></i> Data tidak ditemukan!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <meta http-equiv="refresh" content="1;url=index.php?page=pemateri">
    ';
    exit;
}

if(isset($_POST['simpan'])){
    $nama_pemateri = mysqli_real_escape_string($koneksi, $_POST['nama_pemateri']);
    $keahlian = mysqli_real_escape_string($koneksi, $_POST['keahlian']);
    $pengalaman = mysqli_real_escape_string($koneksi, $_POST['pengalaman']);
    $no_telp = mysqli_real_escape_string($koneksi, $_POST['no_telp']);
    $status = mysqli_real_escape_string($koneksi, $_POST['status']);
    
    $query = mysqli_query($koneksi, "UPDATE pemateri SET 
                                     nama_pemateri='$nama_pemateri', 
                                     keahlian='$keahlian', 
                                     pengalaman='$pengalaman', 
                                     no_telp='$no_telp', 
                                     status='$status' 
                                     WHERE id_pemateri='$id'");
    if($query){
        echo '
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle mr-2"></i> Data pemateri berhasil diupdate!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <meta http-equiv="refresh" content="1;url=index.php?page=pemateri">
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
                    <i class="fas fa-user-edit mr-2"></i> Form Edit Pemateri
                </h3>
                <div class="card-tools">
                    <a href="index.php?page=pemateri" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left mr-1"></i> Kembali
                    </a>
                </div>
            </div>
            <div class="card-body">
                <form method="POST" action="">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama_pemateri">
                                    <i class="fas fa-user text-primary mr-1"></i> Nama Pemateri
                                </label>
                                <input type="text" name="nama_pemateri" id="nama_pemateri" class="form-control" 
                                       value="<?= $edit['nama_pemateri']; ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="keahlian">
                                    <i class="fas fa-graduation-cap text-primary mr-1"></i> Keahlian
                                </label>
                                <select name="keahlian" id="keahlian" class="form-control" required>
                                    <option value="Tafsir Al-Quran" <?= $edit['keahlian'] == 'Tafsir Al-Quran' ? 'selected' : ''; ?>>Tafsir Al-Quran</option>
                                    <option value="Hadits" <?= $edit['keahlian'] == 'Hadits' ? 'selected' : ''; ?>>Hadits</option>
                                    <option value="Fiqih" <?= $edit['keahlian'] == 'Fiqih' ? 'selected' : ''; ?>>Fiqih</option>
                                    <option value="Tauhid" <?= $edit['keahlian'] == 'Tauhid' ? 'selected' : ''; ?>>Tauhid</option>
                                    <option value="Akhlak" <?= $edit['keahlian'] == 'Akhlak' ? 'selected' : ''; ?>>Akhlak</option>
                                    <option value="Tasawuf" <?= $edit['keahlian'] == 'Tasawuf' ? 'selected' : ''; ?>>Tasawuf</option>
                                    <option value="Dakwah" <?= $edit['keahlian'] == 'Dakwah' ? 'selected' : ''; ?>>Dakwah</option>
                                    <option value="Tahsin" <?= $edit['keahlian'] == 'Tahsin' ? 'selected' : ''; ?>>Tahsin</option>
                                    <option value="Tahfidz" <?= $edit['keahlian'] == 'Tahfidz' ? 'selected' : ''; ?>>Tahfidz</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="pengalaman">
                                    <i class="fas fa-briefcase text-primary mr-1"></i> Pengalaman
                                </label>
                                <input type="text" name="pengalaman" id="pengalaman" class="form-control" 
                                       value="<?= $edit['pengalaman']; ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="no_telp">
                                    <i class="fas fa-phone text-primary mr-1"></i> No Telepon
                                </label>
                                <input type="text" name="no_telp" id="no_telp" class="form-control" 
                                       value="<?= $edit['no_telp']; ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6">
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
                        <a href="index.php?page=pemateri" class="btn btn-danger">
                            <i class="fas fa-times mr-1"></i> Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>