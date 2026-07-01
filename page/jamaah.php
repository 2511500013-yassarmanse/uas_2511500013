<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">
                    <i class="fas fa-users text-primary mr-2"></i> Data Jamaah
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="index.php"><i class="fas fa-home"></i> Home</a></li>
                    <li class="breadcrumb-item active">Data Jamaah</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<?php
// Proses Hapus
if(isset($_GET['action']) && $_GET['action'] == "hapus") {
    $id = mysqli_real_escape_string($koneksi, $_GET['id']);
    $query = mysqli_query($koneksi, "DELETE FROM jamaah WHERE id_jamaah='$id'");
    if($query) {
        echo '
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle mr-2"></i> Data jamaah berhasil dihapus!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <meta http-equiv="refresh" content="1;url=index.php?page=jamaah">
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
        <!-- Statistik Jamaah -->
        <div class="row mb-3">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3><?php 
                            $query = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM jamaah WHERE status='aktif'");
                            $result = mysqli_fetch_array($query);
                            echo $result['total'];
                        ?></h3>
                        <p>Jamaah Aktif</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-user-check"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3><?php 
                            $query = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM jamaah WHERE status='nonaktif'");
                            $result = mysqli_fetch_array($query);
                            echo $result['total'];
                        ?></h3>
                        <p>Jamaah Nonaktif</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-user-times"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3><?php 
                            $query = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM jamaah WHERE jenis_kelamin='L'");
                            $result = mysqli_fetch_array($query);
                            echo $result['total'];
                        ?></h3>
                        <p>Jamaah Laki-laki</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-male"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3><?php 
                            $query = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM jamaah WHERE jenis_kelamin='P'");
                            $result = mysqli_fetch_array($query);
                            echo $result['total'];
                        ?></h3>
                        <p>Jamaah Perempuan</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-female"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabel Jamaah -->
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-list mr-2"></i> Daftar Jamaah Masjid
                </h3>
                <div class="card-tools">
                    <a href="index.php?page=tambah_jamaah" class="btn btn-primary btn-sm">
                        <i class="fas fa-user-plus mr-1"></i> Tambah Jamaah
                    </a>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped table-hover" id="tableJamaah">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="12%">NIA</th>
                            <th width="20%">Nama Jamaah</th>
                            <th width="8%">JK</th>
                            <th width="18%">Alamat</th>
                            <th width="10%">No Telp</th>
                            <th width="10%">Tgl Daftar</th>
                            <th width="8%">Status</th>
                            <th width="12%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 0;
                        $query = mysqli_query($koneksi, "SELECT * FROM jamaah ORDER BY id_jamaah DESC");
                        if(mysqli_num_rows($query) > 0) {
                            while($result = mysqli_fetch_array($query)) {
                                $no++;
                        ?>
                        <tr>
                            <td class="text-center"><?= $no; ?></td>
                            <td><span class="badge badge-info"><?= $result['nia']; ?></span></td>
                            <td><?= $result['nama_jamaah']; ?></td>
                            <td class="text-center">
                                <?php if($result['jenis_kelamin'] == 'L') { ?>
                                    <span class="badge badge-primary"><i class="fas fa-male"></i> L</span>
                                <?php } else { ?>
                                    <span class="badge badge-pink"><i class="fas fa-female"></i> P</span>
                                <?php } ?>
                            </td>
                            <td><?= $result['alamat']; ?></td>
                            <td><?= $result['no_telp']; ?></td>
                            <td><?= date('d-m-Y', strtotime($result['tanggal_daftar'])); ?></td>
                            <td>
                                <span class="badge <?= $result['status'] == 'aktif' ? 'badge-success' : 'badge-danger'; ?>">
                                    <?= $result['status']; ?>
                                </span>
                            </td>
                            <td class="text-center">
                                <a href="index.php?page=edit_jamaah&id=<?= $result['id_jamaah']; ?>" class="btn btn-warning btn-sm" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="javascript:void(0)" onclick="confirmDelete(<?= $result['id_jamaah']; ?>, '<?= $result['nama_jamaah']; ?>')" class="btn btn-danger btn-sm" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <?php 
                            }
                        } else {
                        ?>
                        <tr>
                            <td colspan="9" class="text-center text-muted">
                                <i class="fas fa-users fa-3x d-block mb-3 text-primary"></i>
                                <h5>Belum ada data jamaah</h5>
                                <p class="mb-0">Silahkan tambah jamaah pertama Anda</p>
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
                <p>Apakah Anda yakin ingin menghapus data jamaah ini?</p>
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
    document.getElementById('hapusLink').href = 'index.php?page=jamaah&action=hapus&id=' + id;
    $('#modalHapus').modal('show');
}

// DataTable
$(document).ready(function() {
    $('#tableJamaah').DataTable({
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

<style>
.badge-pink {
    background-color: #e83e8c;
    color: white;
}
</style>