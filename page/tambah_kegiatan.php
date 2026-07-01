<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">
                    <i class="fas fa-plus-circle text-success mr-2"></i> Tambah Kegiatan Keagamaan
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="index.php"><i class="fas fa-home"></i> Home</a></li>
                    <li class="breadcrumb-item"><a href="index.php?page=kegiatan">Data Kegiatan</a></li>
                    <li class="breadcrumb-item active">Tambah Kegiatan</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<?php
if(isset($_POST['simpan'])){
    $nama_kegiatan = mysqli_real_escape_string($koneksi, $_POST['nama_kegiatan']);
    $deskripsi = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);
    $jenis_kegiatan = mysqli_real_escape_string($koneksi, $_POST['jenis_kegiatan']);
    $hari = mysqli_real_escape_string($koneksi, $_POST['hari']);
    $waktu_mulai = mysqli_real_escape_string($koneksi, $_POST['waktu_mulai']);
    $waktu_selesai = mysqli_real_escape_string($koneksi, $_POST['waktu_selesai']);
    $tempat = mysqli_real_escape_string($koneksi, $_POST['tempat']);
    $penanggung_jawab = mysqli_real_escape_string($koneksi, $_POST['penanggung_jawab']);
    $status = mysqli_real_escape_string($koneksi, $_POST['status']);
    
    $query = mysqli_query($koneksi, "INSERT INTO kegiatan_keagamaan 
                                     (nama_kegiatan, deskripsi, jenis_kegiatan, hari, waktu_mulai, waktu_selesai, tempat, penanggung_jawab, status) 
                                     VALUES 
                                     ('$nama_kegiatan', '$deskripsi', '$jenis_kegiatan', '$hari', '$waktu_mulai', '$waktu_selesai', '$tempat', '$penanggung_jawab', '$status')");
    if($query){
        echo '
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle mr-2"></i> Data kegiatan berhasil ditambahkan!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <meta http-equiv="refresh" content="1;url=index.php?page=kegiatan">
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
?>

<div class="content">
    <div class="container-fluid">
        <div class="card card-outline card-success">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-plus mr-2"></i> Form Tambah Kegiatan
                </h3>
                <div class="card-tools">
                    <a href="index.php?page=kegiatan" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left mr-1"></i> Kembali
                    </a>
                </div>
            </div>
            <div class="card-body">
                <form method="POST" action="">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama_kegiatan">
                                    <i class="fas fa-calendar text-primary mr-1"></i> Nama Kegiatan
                                </label>
                                <input type="text" name="nama_kegiatan" id="nama_kegiatan" class="form-control" 
                                       placeholder="Contoh: Pengajian Rutin" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="jenis_kegiatan">
                                    <i class="fas fa-tag text-primary mr-1"></i> Jenis Kegiatan
                                </label>
                                <select name="jenis_kegiatan" id="jenis_kegiatan" class="form-control" required>
                                    <option value="">-- Pilih Jenis --</option>
                                    <option value="Pengajian">Pengajian</option>
                                    <option value="Yasinan">Yasinan</option>
                                    <option value="Kajian">Kajian</option>
                                    <option value="Shalat">Shalat</option>
                                    <option value="Pengajian Anak">Pengajian Anak</option>
                                    <option value="Tadarus">Tadarus</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="deskripsi">
                                    <i class="fas fa-align-left text-primary mr-1"></i> Deskripsi
                                </label>
                                <textarea name="deskripsi" id="deskripsi" class="form-control" rows="2" 
                                          placeholder="Deskripsi kegiatan"></textarea>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="hari">
                                    <i class="fas fa-calendar-day text-primary mr-1"></i> Hari
                                </label>
                                <select name="hari" id="hari" class="form-control" required>
                                    <option value="Senin">Senin</option>
                                    <option value="Selasa">Selasa</option>
                                    <option value="Rabu">Rabu</option>
                                    <option value="Kamis">Kamis</option>
                                    <option value="Jumat">Jumat</option>
                                    <option value="Sabtu">Sabtu</option>
                                    <option value="Minggu">Minggu</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="waktu_mulai">
                                    <i class="fas fa-clock text-primary mr-1"></i> Waktu Mulai
                                </label>
                                <input type="time" name="waktu_mulai" id="waktu_mulai" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="waktu_selesai">
                                    <i class="fas fa-clock text-primary mr-1"></i> Waktu Selesai
                                </label>
                                <input type="time" name="waktu_selesai" id="waktu_selesai" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-3">
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
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tempat">
                                    <i class="fas fa-map-marker-alt text-primary mr-1"></i> Tempat
                                </label>
                                <input type="text" name="tempat" id="tempat" class="form-control" 
                                       placeholder="Contoh: Masjid Al-Hidayah" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="penanggung_jawab">
                                    <i class="fas fa-user text-primary mr-1"></i> Penanggung Jawab
                                </label>
                                <input type="text" name="penanggung_jawab" id="penanggung_jawab" class="form-control" 
                                       placeholder="Nama penanggung jawab">
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
                        <a href="index.php?page=kegiatan" class="btn btn-danger">
                            <i class="fas fa-times mr-1"></i> Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>