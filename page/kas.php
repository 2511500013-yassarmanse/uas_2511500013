<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">
                    <i class="fas fa-money-bill-wave text-warning mr-2"></i> Data Kas Masjid
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="index.php"><i class="fas fa-home"></i> Home</a></li>
                    <li class="breadcrumb-item active">Data Kas</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<?php
// Proses Hapus
if(isset($_GET['action']) && $_GET['action'] == "hapus") {
    $id = mysqli_real_escape_string($koneksi, $_GET['id']);
    $query = mysqli_query($koneksi, "DELETE FROM kas_masjid WHERE id_kas='$id'");
    if($query) {
        echo '
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle mr-2"></i> Data kas berhasil dihapus!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <meta http-equiv="refresh" content="1;url=index.php?page=kas">
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
        <!-- Statistik Kas -->
        <div class="row mb-3">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>Rp <?php 
                            $query = mysqli_query($koneksi, "SELECT SUM(jumlah) as total FROM kas_masjid WHERE jenis_transaksi='pemasukan'");
                            $result = mysqli_fetch_array($query);
                            echo number_format($result['total'] ?? 0, 0, ',', '.');
                        ?></h3>
                        <p>Total Pemasukan</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-arrow-down"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>Rp <?php 
                            $query = mysqli_query($koneksi, "SELECT SUM(jumlah) as total FROM kas_masjid WHERE jenis_transaksi='pengeluaran'");
                            $result = mysqli_fetch_array($query);
                            echo number_format($result['total'] ?? 0, 0, ',', '.');
                        ?></h3>
                        <p>Total Pengeluaran</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-arrow-up"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>Rp <?php 
                            $query = mysqli_query($koneksi, "SELECT saldo FROM kas_masjid ORDER BY id_kas DESC LIMIT 1");
                            $result = mysqli_fetch_array($query);
                            echo number_format($result['saldo'] ?? 0, 0, ',', '.');
                        ?></h3>
                        <p>Saldo Saat Ini</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-wallet"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3><?php 
                            $query = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM kas_masjid");
                            $result = mysqli_fetch_array($query);
                            echo $result['total'];
                        ?></h3>
                        <p>Total Transaksi</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-exchange-alt"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabel Kas -->
        <div class="card card-outline card-warning">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-list mr-2"></i> Daftar Transaksi Kas Masjid
                </h3>
                <div class="card-tools">
                    <a href="index.php?page=tambah_kas" class="btn btn-warning btn-sm">
                        <i class="fas fa-plus mr-1"></i> Tambah Transaksi
                    </a>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped table-hover" id="tableKas">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="12%">Tanggal</th>
                            <th width="12%">Jenis</th>
                            <th width="15%">Kategori</th>
                            <th width="20%">Keterangan</th>
                            <th width="15%">Jumlah</th>
                            <th width="13%">Saldo</th>
                            <th width="8%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 0;
                        $query = mysqli_query($koneksi, "SELECT * FROM kas_masjid ORDER BY id_kas DESC");
                        if(mysqli_num_rows($query) > 0) {
                            while($result = mysqli_fetch_array($query)) {
                                $no++;
                        ?>
                        <tr>
                            <td class="text-center"><?= $no; ?></td>
                            <td><?= date('d-m-Y', strtotime($result['tanggal'])); ?></td>
                            <td>
                                <span class="badge <?= $result['jenis_transaksi'] == 'pemasukan' ? 'badge-success' : 'badge-danger'; ?>">
                                    <?= ucfirst($result['jenis_transaksi']); ?>
                                </span>
                            </td>
                            <td><?= $result['kategori']; ?></td>
                            <td><?= $result['keterangan']; ?></td>
                            <td class="text-right">
                                <span class="<?= $result['jenis_transaksi'] == 'pemasukan' ? 'text-success' : 'text-danger'; ?>">
                                    Rp <?= number_format($result['jumlah'], 0, ',', '.'); ?>
                                </span>
                            </td>
                            <td class="text-right">Rp <?= number_format($result['saldo'], 0, ',', '.'); ?></td>
                            <td class="text-center">
                                <a href="index.php?page=edit_kas&id=<?= $result['id_kas']; ?>" class="btn btn-warning btn-sm" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="javascript:void(0)" onclick="confirmDelete(<?= $result['id_kas']; ?>, '<?= $result['keterangan']; ?>')" class="btn btn-danger btn-sm" title="Hapus">
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
                                <i class="fas fa-money-bill-wave fa-3x d-block mb-3 text-warning"></i>
                                <h5>Belum ada transaksi kas</h5>
                                <p class="mb-0">Silahkan tambah transaksi pertama Anda</p>
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
                <p>Apakah Anda yakin ingin menghapus transaksi ini?</p>
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
function confirmDelete(id, keterangan) {
    document.getElementById('hapusInfo').innerHTML = 'Keterangan: ' + keterangan;
    document.getElementById('hapusLink').href = 'index.php?page=kas&action=hapus&id=' + id;
    $('#modalHapus').modal('show');
}

$(document).ready(function() {
    $('#tableKas').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Indonesian.json"
        },
        "responsive": true,
        "lengthChange": true,
        "autoWidth": false,
        "pageLength": 10,
        "order": [[0, 'desc']]
    });
});
</script>