<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">
                    <i class="fas fa-user-plus text-success mr-2"></i> Tambah Pengurus
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="index.php"><i class="fas fa-home"></i> Home</a></li>
                    <li class="breadcrumb-item"><a href="index.php?page=pengurus">Data Pengurus</a></li>
                    <li class="breadcrumb-item active">Tambah Pengurus</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<?php
if(isset($_POST['simpan'])){
    $nia = mysqli_real_escape_string($koneksi, $_POST['nia']);
    $jabatan = mysqli_real_escape_string($koneksi, $_POST['jabatan']);
    $periode_mulai = mysqli_real_escape_string($koneksi, $_POST['periode_mulai']);
    $periode_selesai = mysqli_real_escape_string($koneksi, $_POST['periode_selesai']);
    $status = mysqli_real_escape_string($koneksi, $_POST['status']);
    
    // Cek apakah NIA terdaftar sebagai jamaah
    $cek_jamaah = mysqli_query($koneksi, "SELECT * FROM jamaah WHERE nia='$nia'");
    if(mysqli_num_rows($cek_jamaah) == 0){
        echo '
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle mr-2"></i> NIA tidak terdaftar sebagai jamaah!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        ';
    } else {
        $query = mysqli_query($koneksi, "INSERT INTO pengurus (nia, jabatan, periode_mulai, periode_selesai, status) 
                                         VALUES ('$nia', '$jabatan', '$periode_mulai', '$periode_selesai', '$status')");
        if($query){
            echo '
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle mr-2"></i> Data pengurus berhasil ditambahkan!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <meta http-equiv="refresh" content="1;url=index.php?page=pengurus">
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
                    <i class="fas fa-user-plus mr-2"></i> Form Tambah Pengurus Masjid
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
                                <label for="nia">
                                    <i class="fas fa-id-card text-primary mr-1"></i> NIA (Nomor Induk Jamaah)
                                </label>
                                <select name="nia" id="nia" class="form-control" required>
                                    <option value="">-- Pilih Jamaah --</option>
                                    <?php
                                    $query = mysqli_query($koneksi, "SELECT * FROM jamaah WHERE status='aktif' ORDER BY nama_jamaah ASC");
                                    while($row = mysqli_fetch_array($query)){
                                        echo '<option value="'.$row['nia'].'">'.$row['nia'].' - '.$row['nama_jamaah'].'</option>';
                                    }
                                    ?>
                                </select>
                                <small class="text-muted">Pilih jamaah yang akan diangkat menjadi pengurus</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="jabatan">
                                    <i class="fas fa-user-tag text-primary mr-1"></i> Jabatan
                                </label>
                                <select name="jabatan" id="jabatan" class="form-control" required>
                                    <option value="">-- Pilih Jabatan --</option>
                                    <option value="Ketua">Ketua</option>
                                    <option value="Wakil Ketua">Wakil Ketua</option>
                                    <option value="Sekretaris">Sekretaris</option>
                                    <option value="Wakil Sekretaris">Wakil Sekretaris</option>
                                    <option value="Bendahara">Bendahara</option>
                                    <option value="Wakil Bendahara">Wakil Bendahara</option>
                                    <option value="Pengurus">Pengurus</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="periode_mulai">
                                    <i class="fas fa-calendar-alt text-primary mr-1"></i> Periode Mulai
                                </label>
                                <input type="date" name="periode_mulai" id="periode_mulai" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="periode_selesai">
                                    <i class="fas fa-calendar-alt text-primary mr-1"></i> Periode Selesai
                                </label>
                                <input type="date" name="periode_selesai" id="periode_selesai" class="form-control" required>
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
                        <a href="index.php?page=pengurus" class="btn btn-danger">
                            <i class="fas fa-times mr-1"></i> Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>