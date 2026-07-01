<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">
                    <i class="fas fa-calendar-alt text-success mr-2"></i> Data Kegiatan Keagamaan
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="index.php"><i class="fas fa-home"></i> Home</a></li>
                    <li class="breadcrumb-item active">Data Kegiatan</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<?php
// Proses Hapus
if(isset($_GET['action']) && $_GET['action'] == "hapus") {
    $id = mysqli_real_escape_string($koneksi, $_GET['id']);
    $query = mysqli_query($koneksi, "DELETE FROM kegiatan_keagamaan WHERE id_kegiatan='$id'");
    if($query) {
        echo '
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle mr-2"></i> Data kegiatan berhasil dihapus!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <meta http-equiv="refresh" content="1;url=index.php?page=kegiatan">
        ';
    } else {
        echo '
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle mr-2"></i> Gagal menghapus data!
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
        <!-- Statistik Kegiatan -->
        <div class="row mb-3">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3><?php 
                            $query = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM kegiatan_keagamaan WHERE status='aktif'");
                            $result = mysqli_fetch_array($query);
                            echo $result['total'];
                        ?></h3>
                        <p>Kegiatan Aktif</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3><?php 
                            $query = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM kegiatan_keagamaan WHERE status='nonaktif'");
                            $result = mysqli_fetch_array($query);
                            echo $result['total'];
                        ?></h3>
                        <p>Kegiatan Nonaktif</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-times-circle"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3><?php 
                            $query = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM kegiatan_keagamaan");
                            $result = mysqli_fetch_array($query);
                            echo $result['total'];
                        ?></h3>
                        <p>Total Kegiatan</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-list"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3><?php 
                            $query = mysqli_query($koneksi, "SELECT COUNT(DISTINCT jenis_kegiatan) as total FROM kegiatan_keagamaan");
                            $result = mysqli_fetch_array($query);
                            echo $result['total'];
                        ?></h3>
                        <p>Jenis Kegiatan</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-tags"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabel Kegiatan -->
        <div class="card card-outline card-success">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-list mr-2"></i> Daftar Kegiatan Keagamaan
                </h3>
                <div class="card-tools">
                    <a href="index.php?page=tambah_kegiatan" class="btn btn-success btn-sm">
                        <i class="fas fa-plus mr-1"></i> Tambah Kegiatan
                    </a>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped table-hover" id="tableKegiatan">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="20%">Nama Kegiatan</th>
                            <th width="15%">Jenis</th>
                            <th width="10%">Hari</th>
                            <th width="15%">Waktu</th>
                            <th width="15%">Tempat</th>
                            <th width="10%">Status</th>
                            <th width="10%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 0;
                        $query = mysqli_query($koneksi, "SELECT * FROM kegiatan_keagamaan ORDER BY id_kegiatan DESC");
                        if(mysqli_num_rows($query) > 0) {
                            while($result = mysqli_fetch_array($query)) {
                                $no++;
                        ?>
                        <tr>
                            <td class="text-center"><?= $no; ?></td>
                            <td><?= $result['nama_kegiatan']; ?></td>
                            <td><span class="badge badge-primary"><?= $result['jenis_kegiatan']; ?></span></td>
                            <td><span class="badge badge-info"><?= $result['hari']; ?></span></td>
                            <td><?= date('H:i', strtotime($result['waktu_mulai'])); ?> - <?= date('H:i', strtotime($result['waktu_selesai'])); ?></td>
                            <td><?= $result['tempat']; ?></td>
                            <td>
                                <span class="badge <?= $result['status'] == 'aktif' ? 'badge-success' : 'badge-danger'; ?>">
                                    <?= $result['status']; ?>
                                </span>
                            </td>
                            <td class="text-center">
                                <a href="index.php?page=edit_kegiatan&id=<?= $result['id_kegiatan']; ?>" class="btn btn-warning btn-sm" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="javascript:void(0)" onclick="confirmDelete(<?= $result['id_kegiatan']; ?>, '<?= $result['nama_kegiatan']; ?>')" class="btn btn-danger btn-sm" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <?php 
                            }
                        } else {
                        ?>
                        <tr>
                            <td colspan="8" class="text-center text-muted">
                                <i class="fas fa-calendar-alt fa-3x d-block mb-3 text-success"></i>
                                <h5>Belum ada data kegiatan</h5>
                                <p class="mb-0">Silahkan tambah kegiatan pertama Anda</p>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Hapus -->
<div class="modal fade" id="modalHapus" tabindex="-1" role="dialog" aria-labelledby="modalHapusLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title text-white" id="modalHapusLabel">
                    <i class="fas fa-exclamation-triangle mr-2"></i> Konfirmasi Hapus
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus kegiatan ini?</p>
                <p id="hapusInfo" class="font-weight-bold text-danger"></p>
                <p class="text-muted small">Data yang dihapus tidak dapat dikembalikan!</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fas fa-times mr-1"></i> Batal
                </button>
                <a href="#" id="hapusLink" class="btn btn-danger">
                    <i class="fas fa-trash mr-1"></i> Ya, Hapus
                </a>
            </div>
        </div>
    </div>
</div>

<script>
function confirmDelete(id, nama) {
    document.getElementById('hapusInfo').innerHTML = 'Kegiatan: ' + nama;
    document.getElementById('hapusLink').href = 'index.php?page=kegiatan&action=hapus&id=' + id;
    $('#modalHapus').modal('show');
}

$(document).ready(function() {
    $('#tableKegiatan').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Indonesian.json"
        },
        "responsive": true,
        "lengthChange": true,
        "autoWidth": false,
        "pageLength": 10
    });
});
</script>