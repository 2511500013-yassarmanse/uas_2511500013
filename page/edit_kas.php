<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">
                    <i class="fas fa-edit text-warning mr-2"></i> Edit Transaksi Kas
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="index.php"><i class="fas fa-home"></i> Home</a></li>
                    <li class="breadcrumb-item"><a href="index.php?page=kas">Data Kas</a></li>
                    <li class="breadcrumb-item active">Edit Transaksi</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<?php
$id = mysqli_real_escape_string($koneksi, $_GET['id']);
$edit = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM kas_masjid WHERE id_kas='$id'"));

if(!$edit){
    echo '
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fas fa-exclamation-circle mr-2"></i> Data tidak ditemukan!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <meta http-equiv="refresh" content="1;url=index.php?page=kas">
    ';
    exit;
}

if(isset($_POST['simpan'])){
    $tanggal = mysqli_real_escape_string($koneksi, $_POST['tanggal']);
    $jenis_transaksi = mysqli_real_escape_string($koneksi, $_POST['jenis_transaksi']);
    $kategori = mysqli_real_escape_string($koneksi, $_POST['kategori']);
    $keterangan = mysqli_real_escape_string($koneksi, $_POST['keterangan']);
    $jumlah = mysqli_real_escape_string($koneksi, $_POST['jumlah']);
    
    // Ambil data transaksi yang diupdate
    $query_lama = mysqli_query($koneksi, "SELECT * FROM kas_masjid WHERE id_kas='$id'");
    $data_lama = mysqli_fetch_array($query_lama);
    
    // Ambil saldo terakhir sebelum transaksi ini
    $query_sebelum = mysqli_query($koneksi, "SELECT saldo FROM kas_masjid WHERE id_kas < '$id' ORDER BY id_kas DESC LIMIT 1");
    $data_sebelum = mysqli_fetch_array($query_sebelum);
    $saldo_sebelum = $data_sebelum['saldo'] ?? 0;
    
    // Hitung saldo baru
    if($jenis_transaksi == 'pemasukan'){
        $saldo_baru = $saldo_sebelum + $jumlah;
    } else {
        $saldo_baru = $saldo_sebelum - $jumlah;
    }
    
    $query = mysqli_query($koneksi, "UPDATE kas_masjid SET 
                                     tanggal='$tanggal', 
                                     jenis_transaksi='$jenis_transaksi', 
                                     kategori='$kategori', 
                                     keterangan='$keterangan', 
                                     jumlah='$jumlah', 
                                     saldo='$saldo_baru' 
                                     WHERE id_kas='$id'");
    if($query){
        // Update saldo untuk transaksi setelahnya
        $query_update = mysqli_query($koneksi, "SELECT * FROM kas_masjid WHERE id_kas > '$id' ORDER BY id_kas ASC");
        $saldo_berjalan = $saldo_baru;
        while($row = mysqli_fetch_array($query_update)){
            if($row['jenis_transaksi'] == 'pemasukan'){
                $saldo_berjalan += $row['jumlah'];
            } else {
                $saldo_berjalan -= $row['jumlah'];
            }
            mysqli_query($koneksi, "UPDATE kas_masjid SET saldo='$saldo_berjalan' WHERE id_kas='".$row['id_kas']."'");
        }
        
        echo '
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle mr-2"></i> Transaksi kas berhasil diupdate!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <meta http-equiv="refresh" content="1;url=index.php?page=kas">
        ';
    } else {
        echo '
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle mr-2"></i> Gagal mengupdate transaksi!
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
                    <i class="fas fa-edit mr-2"></i> Form Edit Transaksi Kas
                </h3>
                <div class="card-tools">
                    <a href="index.php?page=kas" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left mr-1"></i> Kembali
                    </a>
                </div>
            </div>
            <div class="card-body">
                <form method="POST" action="">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="tanggal">
                                    <i class="fas fa-calendar-alt text-primary mr-1"></i> Tanggal
                                </label>
                                <input type="date" name="tanggal" id="tanggal" class="form-control" 
                                       value="<?= $edit['tanggal']; ?>" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="jenis_transaksi">
                                    <i class="fas fa-exchange-alt text-primary mr-1"></i> Jenis Transaksi
                                </label>
                                <select name="jenis_transaksi" id="jenis_transaksi" class="form-control" required>
                                    <option value="pemasukan" <?= $edit['jenis_transaksi'] == 'pemasukan' ? 'selected' : ''; ?> class="text-success">Pemasukan</option>
                                    <option value="pengeluaran" <?= $edit['jenis_transaksi'] == 'pengeluaran' ? 'selected' : ''; ?> class="text-danger">Pengeluaran</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="kategori">
                                    <i class="fas fa-tag text-primary mr-1"></i> Kategori
                                </label>
                                <select name="kategori" id="kategori" class="form-control" required>
                                    <optgroup label="Pemasukan">
                                        <option value="Donasi" <?= $edit['kategori'] == 'Donasi' ? 'selected' : ''; ?>>Donasi</option>
                                        <option value="Infaq" <?= $edit['kategori'] == 'Infaq' ? 'selected' : ''; ?>>Infaq</option>
                                        <option value="Sedekah" <?= $edit['kategori'] == 'Sedekah' ? 'selected' : ''; ?>>Sedekah</option>
                                        <option value="Zakat" <?= $edit['kategori'] == 'Zakat' ? 'selected' : ''; ?>>Zakat</option>
                                        <option value="Sumbangan" <?= $edit['kategori'] == 'Sumbangan' ? 'selected' : ''; ?>>Sumbangan</option>
                                    </optgroup>
                                    <optgroup label="Pengeluaran">
                                        <option value="Konsumsi" <?= $edit['kategori'] == 'Konsumsi' ? 'selected' : ''; ?>>Konsumsi</option>
                                        <option value="Perawatan" <?= $edit['kategori'] == 'Perawatan' ? 'selected' : ''; ?>>Perawatan</option>
                                        <option value="Kegiatan" <?= $edit['kategori'] == 'Kegiatan' ? 'selected' : ''; ?>>Kegiatan</option>
                                        <option value="Gaji" <?= $edit['kategori'] == 'Gaji' ? 'selected' : ''; ?>>Gaji</option>
                                        <option value="Pembangunan" <?= $edit['kategori'] == 'Pembangunan' ? 'selected' : ''; ?>>Pembangunan</option>
                                    </optgroup>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="keterangan">
                                    <i class="fas fa-align-left text-primary mr-1"></i> Keterangan
                                </label>
                                <input type="text" name="keterangan" id="keterangan" class="form-control" 
                                       value="<?= $edit['keterangan']; ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="jumlah">
                                    <i class="fas fa-money-bill text-primary mr-1"></i> Jumlah (Rp)
                                </label>
                                <input type="number" name="jumlah" id="jumlah" class="form-control" 
                                       value="<?= $edit['jumlah']; ?>" min="1" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-3">
                        <button type="submit" name="simpan" class="btn btn-warning">
                            <i class="fas fa-save mr-1"></i> Update
                        </button>
                        <a href="index.php?page=kas" class="btn btn-danger">
                            <i class="fas fa-times mr-1"></i> Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>