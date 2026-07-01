<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">
                    <i class="fas fa-mosque text-success mr-2"></i>
                    <span id="greeting"></span>
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i> Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<style>
    .welcome-card {
        background: linear-gradient(135deg, #1a8a4a 0%, #2ecc71 100%);
        color: white;
        border-radius: 15px;
        padding: 30px;
        margin-bottom: 25px;
        box-shadow: 0 10px 30px rgba(26, 138, 74, 0.3);
    }
    .welcome-card h2 {
        font-weight: 700;
        margin-bottom: 5px;
    }
    .welcome-card p {
        opacity: 0.9;
        font-size: 16px;
    }
    .stat-card {
        border-radius: 12px;
        padding: 20px;
        transition: all 0.3s ease;
        border: none;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    }
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    }
    .stat-card .icon {
        font-size: 40px;
        opacity: 0.3;
        float: right;
    }
    .stat-card .number {
        font-size: 32px;
        font-weight: 700;
        margin-bottom: 5px;
    }
    .stat-card .label {
        font-size: 14px;
        opacity: 0.7;
        margin-bottom: 0;
    }
    .stat-card.bg-gradient-green {
        background: linear-gradient(135deg, #00b894, #00cec9);
        color: white;
    }
    .stat-card.bg-gradient-blue {
        background: linear-gradient(135deg, #0984e3, #74b9ff);
        color: white;
    }
    .stat-card.bg-gradient-orange {
        background: linear-gradient(135deg, #fdcb6e, #f39c12);
        color: white;
    }
    .stat-card.bg-gradient-red {
        background: linear-gradient(135deg, #e17055, #d63031);
        color: white;
    }
    .stat-card.bg-gradient-purple {
        background: linear-gradient(135deg, #6c5ce7, #a29bfe);
        color: white;
    }
    .stat-card.bg-gradient-pink {
        background: linear-gradient(135deg, #fd79a8, #e84393);
        color: white;
    }
    .quick-action {
        background: white;
        border-radius: 12px;
        padding: 20px;
        text-align: center;
        transition: all 0.3s ease;
        border: 1px solid #eee;
        cursor: pointer;
    }
    .quick-action:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        border-color: #2ecc71;
    }
    .quick-action i {
        font-size: 35px;
        margin-bottom: 10px;
        color: #2ecc71;
    }
    .quick-action h6 {
        font-weight: 600;
        margin-bottom: 5px;
    }
    .quick-action small {
        color: #999;
    }
    .activity-item {
        border-left: 3px solid #2ecc71;
        padding-left: 15px;
        margin-bottom: 15px;
    }
    .activity-item .time {
        font-size: 12px;
        color: #999;
    }
    .activity-item .title {
        font-weight: 600;
        margin-bottom: 2px;
    }
    .masjid-badge {
        display: inline-block;
        background: rgba(255,255,255,0.2);
        padding: 5px 15px;
        border-radius: 20px;
        font-size: 14px;
    }
</style>

<div class="container-fluid">
    <!-- Welcome Card -->
    <div class="welcome-card">
        <div class="row">
            <div class="col-md-8">
                <div class="masjid-badge">
                    <i class="fas fa-mosque mr-1"></i> Masjid Al-Hidayah
                </div>
                <h2 class="mt-2">
                    <i class="fas fa-hand-peace mr-2"></i> 
                    Selamat Datang di Website Kegiatan Masjid
                </h2>
                <p>
                    <i class="fas fa-calendar-alt mr-1"></i> 
                    <?= date('l, d F Y'); ?> | 
                    <i class="fas fa-clock mr-1"></i> 
                    <span id="clock"></span>
                </p>
                <p class="mb-0">
                    <i class="fas fa-user mr-1"></i> 
                    Anda login sebagai: <strong><?= $_SESSION['username']; ?></strong>
                </p>
            </div>
            <div class="col-md-4 text-right d-flex align-items-center justify-content-end">
                <div style="font-size: 80px; opacity: 0.3;">
                    <i class="fas fa-mosque"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="stat-card bg-gradient-green">
                <div class="icon"><i class="fas fa-users"></i></div>
                <div class="number">
                    <?php 
                        $query = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM jamaah");
                        $result = mysqli_fetch_array($query);
                        echo number_format($result['total']);
                    ?>
                </div>
                <p class="label"><i class="fas fa-user mr-1"></i> Total Jamaah</p>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="stat-card bg-gradient-blue">
                <div class="icon"><i class="fas fa-user-tie"></i></div>
                <div class="number">
                    <?php 
                        $query = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM pengurus WHERE status='aktif'");
                        $result = mysqli_fetch_array($query);
                        echo number_format($result['total']);
                    ?>
                </div>
                <p class="label"><i class="fas fa-check-circle mr-1"></i> Pengurus Aktif</p>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="stat-card bg-gradient-orange">
                <div class="icon"><i class="fas fa-calendar-check"></i></div>
                <div class="number">
                    <?php 
                        $query = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM kegiatan_keagamaan WHERE status='aktif'");
                        $result = mysqli_fetch_array($query);
                        echo number_format($result['total']);
                    ?>
                </div>
                <p class="label"><i class="fas fa-calendar mr-1"></i> Kegiatan Aktif</p>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="stat-card bg-gradient-red">
                <div class="icon"><i class="fas fa-money-bill-wave"></i></div>
                <div class="number">
                    Rp <?php 
                        $query = mysqli_query($koneksi, "SELECT saldo FROM kas_masjid ORDER BY id_kas DESC LIMIT 1");
                        $result = mysqli_fetch_array($query);
                        echo number_format($result['saldo'] ?? 0, 0, ',', '.');
                    ?>
                </div>
                <p class="label"><i class="fas fa-wallet mr-1"></i> Saldo Kas</p>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row mt-3">
        <div class="col-12">
            <h5 class="mb-3"><i class="fas fa-bolt text-warning mr-2"></i> Quick Actions</h5>
        </div>
        <div class="col-md-3 col-6">
            <a href="index.php?page=jamaah" class="quick-action d-block">
                <i class="fas fa-user-plus"></i>
                <h6>Kelola Jamaah</h6>
                <small>Tambah / Edit / Hapus</small>
            </a>
        </div>
        <div class="col-md-3 col-6">
            <a href="index.php?page=kegiatan" class="quick-action d-block">
                <i class="fas fa-plus-circle"></i>
                <h6>Kelola Kegiatan</h6>
                <small>Tambah / Edit / Hapus</small>
            </a>
        </div>
        <div class="col-md-3 col-6">
            <a href="index.php?page=pengurus" class="quick-action d-block">
                <i class="fas fa-user-cog"></i>
                <h6>Kelola Pengurus</h6>
                <small>Tambah / Edit / Hapus</small>
            </a>
        </div>
        <div class="col-md-3 col-6">
            <a href="index.php?page=kas" class="quick-action d-block">
                <i class="fas fa-coins"></i>
                <h6>Kelola Kas</h6>
                <small>Tambah / Edit / Hapus</small>
            </a>
        </div>
    </div>

    <!-- Recent Activities -->
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card card-success card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-calendar-alt text-success mr-2"></i>
                        Kegiatan Terbaru
                    </h3>
                    <div class="card-tools">
                        <a href="index.php?page=kegiatan" class="btn btn-sm btn-success">
                            <i class="fas fa-arrow-right"></i> Lihat Semua
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <?php
                    $query = mysqli_query($koneksi, "SELECT * FROM kegiatan_keagamaan WHERE status='aktif' ORDER BY id_kegiatan DESC LIMIT 5");
                    if(mysqli_num_rows($query) > 0){
                        while($row = mysqli_fetch_array($query)){
                    ?>
                    <div class="activity-item">
                        <div class="title">
                            <i class="fas fa-<?= $row['jenis_kegiatan'] == 'Pengajian' ? 'book-open' : ($row['jenis_kegiatan'] == 'Yasinan' ? 'quran' : 'microphone-alt'); ?> text-success mr-2"></i>
                            <?= $row['nama_kegiatan']; ?>
                            <span class="badge badge-success float-right"><?= $row['hari']; ?></span>
                        </div>
                        <div class="time">
                            <i class="far fa-clock mr-1"></i> 
                            <?= date('H:i', strtotime($row['waktu_mulai'])); ?> - 
                            <?= date('H:i', strtotime($row['waktu_selesai'])); ?>
                            <span class="ml-3">
                                <i class="fas fa-map-marker-alt mr-1"></i> <?= $row['tempat']; ?>
                            </span>
                        </div>
                    </div>
                    <?php 
                        }
                    } else {
                        echo '<p class="text-center text-muted my-3">Belum ada kegiatan terbaru</p>';
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card card-warning card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-money-bill-wave text-warning mr-2"></i>
                        Transaksi Kas Terbaru
                    </h3>
                    <div class="card-tools">
                        <a href="index.php?page=kas" class="btn btn-sm btn-warning">
                            <i class="fas fa-arrow-right"></i> Lihat Semua
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <?php
                    $query = mysqli_query($koneksi, "SELECT * FROM kas_masjid ORDER BY id_kas DESC LIMIT 5");
                    if(mysqli_num_rows($query) > 0){
                        while($row = mysqli_fetch_array($query)){
                    ?>
                    <div class="activity-item" style="border-left-color: <?= $row['jenis_transaksi'] == 'pemasukan' ? '#28a745' : '#dc3545'; ?>;">
                        <div class="title">
                            <i class="fas fa-<?= $row['jenis_transaksi'] == 'pemasukan' ? 'arrow-down' : 'arrow-up'; ?> 
                                <?= $row['jenis_transaksi'] == 'pemasukan' ? 'text-success' : 'text-danger'; ?> mr-2">
                            </i>
                            <?= $row['keterangan']; ?>
                            <span class="badge <?= $row['jenis_transaksi'] == 'pemasukan' ? 'badge-success' : 'badge-danger'; ?> float-right">
                                <?= $row['jenis_transaksi']; ?>
                            </span>
                        </div>
                        <div class="time">
                            <i class="far fa-calendar-alt mr-1"></i> 
                            <?= date('d F Y', strtotime($row['tanggal'])); ?>
                            <span class="ml-3">
                                <strong class="<?= $row['jenis_transaksi'] == 'pemasukan' ? 'text-success' : 'text-danger'; ?>">
                                    Rp <?= number_format($row['jumlah'], 0, ',', '.'); ?>
                                </strong>
                            </span>
                        </div>
                    </div>
                    <?php 
                        }
                    } else {
                        echo '<p class="text-center text-muted my-3">Belum ada transaksi kas</p>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Greeting based on time
function setGreeting() {
    var hour = new Date().getHours();
    var greeting;
    if (hour >= 5 && hour < 12) {
        greeting = "🌅 Selamat Pagi";
    } else if (hour >= 12 && hour < 15) {
        greeting = "☀️ Selamat Siang";
    } else if (hour >= 15 && hour < 18) {
        greeting = "🌤️ Selamat Sore";
    } else {
        greeting = "🌙 Selamat Malam";
    }
    document.getElementById('greeting').innerHTML = greeting + ', <?= $_SESSION['username']; ?>!';
}

// Real-time clock
function updateClock() {
    var now = new Date();
    var time = now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', second: '2-digit' });
    document.getElementById('clock').innerHTML = time;
}

setGreeting();
updateClock();
setInterval(updateClock, 1000);
</script>