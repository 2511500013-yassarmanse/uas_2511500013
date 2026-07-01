<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">
                    <i class="fas fa-chalkboard-teacher text-primary mr-2"></i> Data Pemateri
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="index.php"><i class="fas fa-home"></i> Home</a></li>
                    <li class="breadcrumb-item active">Data Pemateri</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<?php
// Proses Hapus
if(isset($_GET['action']) && $_GET['action'] == "hapus") {
    $id = mysqli_real_escape_string($koneksi, $_GET['id']);
    $query = mysqli_query($koneksi, "DELETE FROM pemateri WHERE id_pemateri='$id'");
    if($query) {
        echo '
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle mr-2"></i> Data pemateri berhasil dihapus!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <meta http-equiv="refresh" content="1;url=index.php?page=pemateri">
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
        <!-- Statistik Pemateri -->
        <div class="row mb-3">
            <div class="col-lg-4 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3><?php 
                            $query = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM pemateri");
                            $result = mysqli_fetch_array($query);
                            echo $result['total'];
                        ?></h3>
                        <p>Total Pemateri</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3><?php 
                            $query = mysqli_query($koneksi, "SELECT COUNT(DISTINCT keahlian) as total FROM pemateri");
                            $result = mysqli_fetch_array($query);
                            echo $result['total'];
                        ?></h3>
                        <p>Bidang Keahlian</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-tags"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3><?php 
                            $query = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM pemateri WHERE status='aktif'");
                            $result = mysqli_fetch_array($query);
                            echo $result['total'];
                        ?></h3>
                        <p>Pemateri Aktif</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-user-check"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabel Pemateri -->
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-list mr-2"></i> Daftar Pemateri
                </h3>
                <div class="card-tools">
                    <a href="index.php?page=tambah_pemateri" class="btn btn-primary btn-sm">
                        <i class="fas fa-user-plus mr-1"></i> Tambah Pemateri
                    </a>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped table-hover" id="tablePemateri">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="20%">Nama Pemateri</th>
                            <th width="15%">Keahlian</th>
                            <th width="25%">Pengalaman</th>
                            <th width="15%">No Telepon</th>
                            <th width="10%">Status</th>
                            <th width="10%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 0;
                        $query = mysqli_query($koneksi, "SELECT * FROM pemateri ORDER BY id_pemateri DESC");
                        if(mysqli_num_rows($query) > 0) {
                            while($result = mysqli_fetch_array($query)) {
                                $no++;
                        ?>
                        <tr>
                            <td class="text-center"><?= $no; ?></td>
                            <td><strong><?= $result['nama_pemateri']; ?></strong></td>
                            <td><span class="badge badge-info"><?= $result['keahlian']; ?></span></td>
                            <td><?= $result['pengalaman']; ?></td>
                            <td><?= $result['no_telp']; ?></td>
                            <td>
                                <span class="badge <?= $result['status'] == 'aktif' ? 'badge-success' : 'badge-danger'; ?>">
                                    <?= $result['status']; ?>
                                </span>
                            </td>
                            <td class="text-center">
                                <a href="index.php?page=edit_pemateri&id=<?= $result['id_pemateri']; ?>" class="btn btn-warning btn-sm" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="javascript:void(0)" onclick="confirmDelete(<?= $result['id_pemateri']; ?>, '<?= $result['nama_pemateri']; ?>')" class="btn btn-danger btn-sm" title="Hapus">
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
                                <i class="fas fa-chalkboard-teacher fa-3x d-block mb-3 text-primary"></i>
                                <h5>Belum ada data pemateri</h5>
                                <p class="mb-0">Silahkan tambah pemateri pertama Anda</p>
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
                <p>Apakah Anda yakin ingin menghapus data pemateri ini?</p>
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
    document.getElementById('hapusLink').href = 'index.php?page=pemateri&action=hapus&id=' + id;
    $('#modalHapus').modal('show');
}

$(document).ready(function() {
    $('#tablePemateri').DataTable({
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