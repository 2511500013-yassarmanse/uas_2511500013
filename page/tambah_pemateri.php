<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">
                    <i class="fas fa-user-plus text-success mr-2"></i> Tambah Pemateri
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="index.php"><i class="fas fa-home"></i> Home</a></li>
                    <li class="breadcrumb-item"><a href="index.php?page=pemateri">Data Pemateri</a></li>
                    <li class="breadcrumb-item active">Tambah Pemateri</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<?php
if(isset($_POST['simpan'])){
    $nama_pemateri = mysqli_real_escape_string($koneksi, $_POST['nama_pemateri']);
    $keahlian = mysqli_real_escape_string($koneksi, $_POST['keahlian']);
    $pengalaman = mysqli_real_escape_string($koneksi, $_POST['pengalaman']);
    $no_telp = mysqli_real_escape_string($koneksi, $_POST['no_telp']);
    $status = mysqli_real_escape_string($koneksi, $_POST['status']);
    
    $query = mysqli_query($koneksi, "INSERT INTO pemateri 
                                     (nama_pemateri, keahlian, pengalaman, no_telp, status) 
                                     VALUES 
                                     ('$nama_pemateri', '$keahlian', '$pengalaman', '$no_telp', '$status')");
    if($query){
        echo '
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle mr-2"></i> Data pemateri berhasil ditambahkan!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <meta http-equiv="refresh" content="1;url=index.php?page=pemateri">
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
                    <i class="fas fa-user-plus mr-2"></i> Form Tambah Pemateri
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
                                       placeholder="Nama lengkap pemateri" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="keahlian">
                                    <i class="fas fa-graduation-cap text-primary mr-1"></i> Keahlian
                                </label>
                                <select name="keahlian" id="keahlian" class="form-control" required>
                                    <option value="">-- Pilih Keahlian --</option>
                                    <option value="Tafsir Al-Quran">Tafsir Al-Quran</option>
                                    <option value="Hadits">Hadits</option>
                                    <option value="Fiqih">Fiqih</option>
                                    <option value="Tauhid">Tauhid</option>
                                    <option value="Akhlak">Akhlak</option>
                                    <option value="Tasawuf">Tasawuf</option>
                                    <option value="Dakwah">Dakwah</option>
                                    <option value="Tahsin">Tahsin</option>
                                    <option value="Tahfidz">Tahfidz</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="pengalaman">
                                    <i class="fas fa-briefcase text-primary mr-1"></i> Pengalaman
                                </label>
                                <input type="text" name="pengalaman" id="pengalaman" class="form-control" 
                                       placeholder="Contoh: 10 tahun mengajar" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="no_telp">
                                    <i class="fas fa-phone text-primary mr-1"></i> No Telepon
                                </label>
                                <input type="text" name="no_telp" id="no_telp" class="form-control" 
                                       placeholder="Contoh: 081234567890" required>
                            </div>
                        </div>
                        <div class="col-md-6">
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
                        <a href="index.php?page=pemateri" class="btn btn-danger">
                            <i class="fas fa-times mr-1"></i> Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>