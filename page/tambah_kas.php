<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">
                    <i class="fas fa-plus-circle text-success mr-2"></i> Tambah Transaksi Kas
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="index.php"><i class="fas fa-home"></i> Home</a></li>
                    <li class="breadcrumb-item"><a href="index.php?page=kas">Data Kas</a></li>
                    <li class="breadcrumb-item active">Tambah Transaksi</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<?php
if(isset($_POST['simpan'])){
    $tanggal = mysqli_real_escape_string($koneksi, $_POST['tanggal']);
    $jenis_transaksi = mysqli_real_escape_string($koneksi, $_POST['jenis_transaksi']);
    $kategori = mysqli_real_escape_string($koneksi, $_POST['kategori']);
    $keterangan = mysqli_real_escape_string($koneksi, $_POST['keterangan']);
    $jumlah = mysqli_real_escape_string($koneksi, $_POST['jumlah']);
    
    // Ambil saldo terakhir
    $query_saldo = mysqli_query($koneksi, "SELECT saldo FROM kas_masjid ORDER BY id_kas DESC LIMIT 1");
    $data_saldo = mysqli_fetch_array($query_saldo);
    $saldo_terakhir = $data_saldo['saldo'] ?? 0;
    
    // Hitung saldo baru
    if($jenis_transaksi == 'pemasukan'){
        $saldo_baru = $saldo_terakhir + $jumlah;
    } else {
        $saldo_baru = $saldo_terakhir - $jumlah;
    }
    
    $query = mysqli_query($koneksi, "INSERT INTO kas_masjid 
                                     (tanggal, jenis_transaksi, kategori, keterangan, jumlah, saldo) 
                                     VALUES 
                                     ('$tanggal', '$jenis_transaksi', '$kategori', '$keterangan', '$jumlah', '$saldo_baru')");
    if($query){
        echo '
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle mr-2"></i> Transaksi kas berhasil ditambahkan!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <meta http-equiv="refresh" content="1;url=index.php?page=kas">
        ';
    } else {
        echo '
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle mr-2"></i> Gagal menambahkan transaksi!
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
        <div class="card card-outline card-success">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-plus mr-2"></i> Form Tambah Transaksi Kas
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
                                       value="<?= date('Y-m-d'); ?>" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="jenis_transaksi">
                                    <i class="fas fa-exchange-alt text-primary mr-1"></i> Jenis Transaksi
                                </label>
                                <select name="jenis_transaksi" id="jenis_transaksi" class="form-control" required>
                                    <option value="">-- Pilih Jenis --</option>
                                    <option value="pemasukan" class="text-success">Pemasukan</option>
                                    <option value="pengeluaran" class="text-danger">Pengeluaran</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="kategori">
                                    <i class="fas fa-tag text-primary mr-1"></i> Kategori
                                </label>
                                <select name="kategori" id="kategori" class="form-control" required>
                                    <option value="">-- Pilih Kategori --</option>
                                    <optgroup label="Pemasukan">
                                        <option value="Donasi">Donasi</option>
                                        <option value="Infaq">Infaq</option>
                                        <option value="Sedekah">Sedekah</option>
                                        <option value="Zakat">Zakat</option>
                                        <option value="Sumbangan">Sumbangan</option>
                                    </optgroup>
                                    <optgroup label="Pengeluaran">
                                        <option value="Konsumsi">Konsumsi</option>
                                        <option value="Perawatan">Perawatan</option>
                                        <option value="Kegiatan">Kegiatan</option>
                                        <option value="Gaji">Gaji</option>
                                        <option value="Pembangunan">Pembangunan</option>
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
                                       placeholder="Keterangan transaksi" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="jumlah">
                                    <i class="fas fa-money-bill text-primary mr-1"></i> Jumlah (Rp)
                                </label>
                                <input type="number" name="jumlah" id="jumlah" class="form-control" 
                                       placeholder="Contoh: 1000000" min="1" required>
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
                        <a href="index.php?page=kas" class="btn btn-danger">
                            <i class="fas fa-times mr-1"></i> Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>