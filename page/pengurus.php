<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">
                    <i class="fas fa-user-tie text-primary mr-2"></i> Data Pengurus Masjid
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="index.php"><i class="fas fa-home"></i> Home</a></li>
                    <li class="breadcrumb-item active">Data Pengurus</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<?php
// Proses Hapus
if(isset($_GET['action']) && $_GET['action'] == "hapus") {
    $id = mysqli_real_escape_string($koneksi, $_GET['id']);
    $query = mysqli_query($koneksi, "DELETE FROM pengurus WHERE id_pengurus='$id'");
    if($query) {
        echo '
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle mr-2"></i> Data pengurus berhasil dihapus!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <meta http-equiv="refresh" content="1;url=index.php?page=pengurus">
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
        <!-- Statistik Pengurus -->
        <div class="row mb-3">
            <div class="col-lg-4 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3><?php 
                            $query = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM pengurus WHERE status='aktif'");
                            $result = mysqli_fetch_array($query);
                            echo $result['total'];
                        ?></h3>
                        <p>Pengurus Aktif</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-user-check"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-6">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3><?php 
                            $query = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM pengurus WHERE status='nonaktif'");
                            $result = mysqli_fetch_array($query);
                            echo $result['total'];
                        ?></h3>
                        <p>Pengurus Nonaktif</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-user-times"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3><?php 
                            $query = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM pengurus");
                            $result = mysqli_fetch_array($query);
                            echo $result['total'];
                        ?></h3>
                        <p>Total Pengurus</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabel Pengurus -->
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-list mr-2"></i> Daftar Pengurus Masjid
                </h3>
                <div class="card-tools">
                    <a href="index.php?page=tambah_pengurus" class="btn btn-primary btn-sm">
                        <i class="fas fa-user-plus mr-1"></i> Tambah Pengurus
                    </a>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped table-hover" id="tablePengurus">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="15%">NIA</th>
                            <th width="20%">Nama Jamaah</th>
                            <th width="20%">Jabatan</th>
                            <th width="15%">Periode</th>
                            <th width="10%">Status</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 0;
                        $query = mysqli_query($koneksi, "
                            SELECT p.*, j.nama_jamaah 
                            FROM pengurus p 
                            LEFT JOIN jamaah j ON p.nia = j.nia 
                            ORDER BY p.id_pengurus DESC
                        ");
                        if(mysqli_num_rows($query) > 0) {
                            while($result = mysqli_fetch_array($query)) {
                                $no++;
                        ?>
                        <tr>
                            <td class="text-center"><?= $no; ?></td>
                            <td><span class="badge badge-info"><?= $result['nia']; ?></span></td>
                            <td><?= $result['nama_jamaah']; ?></td>
                            <td><span class="badge badge-warning"><?= $result['jabatan']; ?></span></td>
                            <td>
                                <?= date('d-m-Y', strtotime($result['periode_mulai'])); ?> 
                                <i class="fas fa-arrow-right"></i> 
                                <?= date('d-m-Y', strtotime($result['periode_selesai'])); ?>
                            </td>
                            <td>
                                <span class="badge <?= $result['status'] == 'aktif' ? 'badge-success' : 'badge-danger'; ?>">
                                    <?= $result['status']; ?>
                                </span>
                            </td>
                            <td class="text-center">
                                <a href="index.php?page=edit_pengurus&id=<?= $result['id_pengurus']; ?>" class="btn btn-warning btn-sm" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="javascript:void(0)" onclick="confirmDelete(<?= $result['id_pengurus']; ?>, '<?= $result['nama_jamaah']; ?>')" class="btn btn-danger btn-sm" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <?php 
                            }
                        } else {
                        ?>
                        <tr>
                            <td colspan="7" class="text-center text-muted">
                                <i class="fas fa-user-tie fa-3x d-block mb-3 text-primary"></i>
                                <h5>Belum ada data pengurus</h5>
                                <p class="mb-0">Silahkan tambah pengurus pertama Anda</p>
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
                <p>Apakah Anda yakin ingin menghapus data pengurus ini?</p>
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
    document.getElementById('hapusInfo').innerHTML = 'Nama: ' + nama;
    document.getElementById('hapusLink').href = 'index.php?page=pengurus&action=hapus&id=' + id;
    $('#modalHapus').modal('show');
}

$(document).ready(function() {
    $('#tablePengurus').DataTable({
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