<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">
                    <i class="fas fa-user-edit text-warning mr-2"></i> Edit Pengurus
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="index.php"><i class="fas fa-home"></i> Home</a></li>
                    <li class="breadcrumb-item"><a href="index.php?page=pengurus">Data Pengurus</a></li>
                    <li class="breadcrumb-item active">Edit Pengurus</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<?php
$id = mysqli_real_escape_string($koneksi, $_GET['id']);
$edit = mysqli_fetch_array(mysqli_query($koneksi, "
    SELECT p.*, j.nama_jamaah 
    FROM pengurus p 
    LEFT JOIN jamaah j ON p.nia = j.nia 
    WHERE p.id_pengurus='$id'
"));

if(!$edit){
    echo '
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fas fa-exclamation-circle mr-2"></i> Data tidak ditemukan!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <meta http-equiv="refresh" content="1;url=index.php?page=pengurus">
    ';
    exit;
}

if(isset($_POST['simpan'])){
    $jabatan = mysqli_real_escape_string($koneksi, $_POST['jabatan']);
    $periode_mulai = mysqli_real_escape_string($koneksi, $_POST['periode_mulai']);
    $periode_selesai = mysqli_real_escape_string($koneksi, $_POST['periode_selesai']);
    $status = mysqli_real_escape_string($koneksi, $_POST['status']);
    
    $query = mysqli_query($koneksi, "UPDATE pengurus SET 
                                     jabatan='$jabatan', 
                                     periode_mulai='$periode_mulai', 
                                     periode_selesai='$periode_selesai', 
                                     status='$status' 
                                     WHERE id_pengurus='$id'");
    if($query){
        echo '
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle mr-2"></i> Data pengurus berhasil diupdate!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <meta http-equiv="refresh" content="1;url=index.php?page=pengurus">
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
                    <i class="fas fa-user-edit mr-2"></i> Form Edit Pengurus
                </h3>
                <div class="card-tools">
                    <a href="index.php?page=pengurus" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left mr-1"></i> Kembali
                    </a>
                </div>
            </div>
            <div class="card-body">
                <form method="POST" action="">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>
                                    <i class="fas fa-id-card text-primary mr-1"></i> NIA
                                </label>
                                <input type="text" class="form-control" value="<?= $edit['nia']; ?>" readonly>
                                <small class="text-muted">NIA tidak dapat diubah</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>
                                    <i class="fas fa-user text-primary mr-1"></i> Nama Jamaah
                                </label>
                                <input type="text" class="form-control" value="<?= $edit['nama_jamaah']; ?>" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="jabatan">
                                    <i class="fas fa-user-tag text-primary mr-1"></i> Jabatan
                                </label>
                                <select name="jabatan" id="jabatan" class="form-control" required>
                                    <option value="Ketua" <?= $edit['jabatan'] == 'Ketua' ? 'selected' : ''; ?>>Ketua</option>
                                    <option value="Wakil Ketua" <?= $edit['jabatan'] == 'Wakil Ketua' ? 'selected' : ''; ?>>Wakil Ketua</option>
                                    <option value="Sekretaris" <?= $edit['jabatan'] == 'Sekretaris' ? 'selected' : ''; ?>>Sekretaris</option>
                                    <option value="Wakil Sekretaris" <?= $edit['jabatan'] == 'Wakil Sekretaris' ? 'selected' : ''; ?>>Wakil Sekretaris</option>
                                    <option value="Bendahara" <?= $edit['jabatan'] == 'Bendahara' ? 'selected' : ''; ?>>Bendahara</option>
                                    <option value="Wakil Bendahara" <?= $edit['jabatan'] == 'Wakil Bendahara' ? 'selected' : ''; ?>>Wakil Bendahara</option>
                                    <option value="Pengurus" <?= $edit['jabatan'] == 'Pengurus' ? 'selected' : ''; ?>>Pengurus</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="periode_mulai">
                                    <i class="fas fa-calendar-alt text-primary mr-1"></i> Periode Mulai
                                </label>
                                <input type="date" name="periode_mulai" id="periode_mulai" class="form-control" 
                                       value="<?= $edit['periode_mulai']; ?>" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="periode_selesai">
                                    <i class="fas fa-calendar-alt text-primary mr-1"></i> Periode Selesai
                                </label>
                                <input type="date" name="periode_selesai" id="periode_selesai" class="form-control" 
                                       value="<?= $edit['periode_selesai']; ?>" required>
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
                        <a href="index.php?page=pengurus" class="btn btn-danger">
                            <i class="fas fa-times mr-1"></i> Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>