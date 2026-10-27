<?php
// Pengaturan zona waktu
date_default_timezone_set('Asia/Jakarta');

// =========================================================================
// SIMULASI DATA (Nantinya data ini diambil dari Database MySQL)
// =========================================================================
$namaPengguna = "Fulan";
$streakHariIni = 14; // Streak berturut-turut membaca
$waktuProduktif = "Ba'da Subuh"; 

// Data progres bacaan
$totalHalamanQuran = 604;
$halamanSudahDibaca = 412; // Posisi saat ini
$rataRataHalamanPerHari = 4; // Berdasarkan histori pengguna

// Data hari ini
$surahTerakhir = "Al-Ahzab";
$ayatTerakhir = 21;
$targetHarian = 4; // Halaman
$terbacaHariIni = 2; // Halaman

// =========================================================================
// LOGIKA PERHITUNGAN ANALITIK
// =========================================================================

// 1. Hitung persentase khatam keseluruhan
$persentaseKhatam = round(($halamanSudahDibaca / $totalHalamanQuran) * 100, 1);

// 2. Hitung estimasi hari menuju khatam
$sisaHalaman = $totalHalamanQuran - $halamanSudahDibaca;
$estimasiHari = ($rataRataHalamanPerHari > 0) ? ceil($sisaHalaman / $rataRataHalamanPerHari) : 0;
$estimasiTanggalKhatam = date('d M Y', strtotime("+$estimasiHari days"));

// 3. Persentase target harian
$persentaseHarian = ($terbacaHariIni / $targetHarian) * 100;
if ($persentaseHarian > 100) $persentaseHarian = 100;

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mutaba'ah Yaumiyah Analytics</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
        }

        body {
            /* Tema Hijau Islami Modern */
            background-color: #0f766e;
            background: linear-gradient(135deg, #0f766e 0%, #047857 100%);
            min-height: 100vh;
            padding: 40px 20px;
            display: flex;
            justify-content: center;
            align-items: flex-start;
        }

        .container {
            max-width: 1100px;
            width: 100%;
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        /* Header Card */
        .header-card {
            background-color: #ffffff;
            border-radius: 16px;
            padding: 32px 20px;
            text-align: center;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header-text { text-align: left; }
        
        .header-title {
            font-size: 28px;
            font-weight: 800;
            color: #1e293b;
            margin-bottom: 8px;
        }

        .header-desc {
            font-size: 15px;
            color: #64748b;
        }

        .streak-badge {
            background-color: #fef3c7;
            color: #d97706;
            padding: 12px 24px;
            border-radius: 999px;
            font-weight: 700;
            font-size: 18px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* Grid Layout */
        .grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
        }

        @media (max-width: 900px) {
            .grid { grid-template-columns: 1fr; }
            .header-card { flex-direction: column; gap: 16px; text-align: center; }
            .header-text { text-align: center; }
        }

        /* Cards */
        .card {
            background-color: #ffffff;
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }

        .card-title {
            font-size: 18px;
            font-weight: 700;
            color: #1e293b;
            padding-bottom: 12px;
            border-bottom: 2px solid #e2e8f0;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            font-size: 14px;
            border-bottom: 1px dashed #f1f5f9;
        }
        .info-row:last-child { border-bottom: none; }

        .info-label { color: #64748b; font-weight: 500; }
        .info-value { color: #0f172a; font-weight: 700; text-align: right; }
        .highlight { color: #059669; }

        /* Progress Bar */
        .progress-wrapper { margin-top: 16px; }
        .progress-header {
            display: flex;
            justify-content: space-between;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 8px;
            color: #1e293b;
        }
        .progress-container {
            width: 100%;
            background-color: #e2e8f0;
            border-radius: 999px;
            height: 10px;
            overflow: hidden;
        }
        .progress-bar {
            height: 100%;
            background-color: #059669;
            border-radius: 999px;
            transition: width 1s ease-in-out;
        }

        /* Form Quick Log */
        .form-group {
            margin-bottom: 12px;
        }
        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #475569;
            margin-bottom: 4px;
        }
        .form-group input, .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font-size: 14px;
            outline: none;
            transition: border-color 0.2s;
        }
        .form-group input:focus, .form-group select:focus {
            border-color: #059669;
        }
        .btn-submit {
            width: 100%;
            background-color: #059669;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 8px;
            font-weight: 700;
            cursor: pointer;
            transition: background-color 0.2s;
            margin-top: 8px;
        }
        .btn-submit:hover {
            background-color: #047857;
        }
    </style>
</head>
<body>

<div class="container">
    <!-- Header: Menampilkan Sambutan & Streak -->
    <div class="header-card">
        <div class="header-text">
            <h1 class="header-title">Ahlan wa Sahlan, <?php echo htmlspecialchars($namaPengguna); ?>!</h1>
            <p class="header-desc">Hari yang indah untuk melanjutkan tilawahmu.</p>
        </div>
        <div class="streak-badge">
            🔥 <?php echo $streakHariIni; ?> Hari Streak
        </div>
    </div>

    <!-- 3 Column Cards -->
    <div class="grid">
        
        <!-- Card 1: Form Pencatatan Cepat (Quick Log) -->
        <div class="card">
            <h2 class="card-title">📝 Catat Progres (Quick Log)</h2>
            <form action="#" method="POST">
                <div class="form-group">
                    <label>Surah Terakhir</label>
                    <input type="text" name="surah" value="<?php echo htmlspecialchars($surahTerakhir); ?>" required>
                </div>
                <div class="form-group">
                    <label>Sampai Ayat</label>
                    <input type="number" name="ayat" value="<?php echo htmlspecialchars($ayatTerakhir); ?>" required>
                </div>
                <div class="form-group">
                    <label>Jumlah Halaman Dibaca Hari Ini</label>
                    <input type="number" name="halaman" placeholder="Misal: 2" required>
                </div>
                <button type="submit" class="btn-submit">Simpan Progres</button>
            </form>
        </div>

        <!-- Card 2: Progres Khatam & Estimasi -->
        <div class="card">
            <h2 class="card-title">📖 Perjalanan Khatam</h2>
            <div class="info-row">
                <span class="info-label">Total Dibaca</span>
                <span class="info-value"><?php echo $halamanSudahDibaca; ?> / <?php echo $totalHalamanQuran; ?> Hal</span>
            </div>
            
            <div class="progress-wrapper">
                <div class="progress-header">
                    <span>Progres Keseluruhan</span>
                    <span class="highlight"><?php echo $persentaseKhatam; ?>%</span>
                </div>
                <div class="progress-container">
                    <div class="progress-bar" style="width: <?php echo $persentaseKhatam; ?>%;"></div>
                </div>
            </div>

            <div style="margin-top: 24px; padding: 16px; background-color: #f0fdf4; border-radius: 8px; border-left: 4px solid #10b981;">
                <p style="font-size: 13px; color: #065f46; font-weight: 600; line-height: 1.5;">
                    💡 Berdasarkan rata-rata bacaanmu (<?php echo $rataRataHalamanPerHari; ?> hal/hari), kamu diperkirakan akan khatam pada:<br>
                    <span style="font-size: 16px; font-weight: 800; display: block; margin-top: 4px;">🎯 <?php echo $estimasiTanggalKhatam; ?></span>
                </p>
            </div>
        </div>

        <!-- Card 3: Analitik Harian -->
        <div class="card">
            <h2 class="card-title">📊 Analitik Harian</h2>
            
            <div class="info-row">
                <span class="info-label">Waktu Paling Produktif</span>
                <span class="info-value"><?php echo htmlspecialchars($waktuProduktif); ?></span>
            </div>
            <div class="info-row">
                <span class="info-label">Rata-rata Harian</span>
                <span class="info-value"><?php echo $rataRataHalamanPerHari; ?> Halaman</span>
            </div>

            <div class="progress-wrapper" style="margin-top: 24px;">
                <div class="progress-header">
                    <span>Target Hari Ini (<?php echo $targetHarian; ?> Hal)</span>
                    <span class="highlight"><?php echo $persentaseHarian; ?>%</span>
                </div>
                <div class="progress-container">
                    <!-- Progress bar harian -->
                    <div class="progress-bar" style="width: <?php echo $persentaseHarian; ?>%; background-color: <?php echo ($persentaseHarian >= 100) ? '#10b981' : '#f59e0b'; ?>;"></div>
                </div>
                <p style="font-size: 12px; color: #64748b; margin-top: 8px; text-align: right;">
                    Telah dibaca: <?php echo $terbacaHariIni; ?> halaman
                </p>
            </div>
        </div>

    </div>
</div>

</body>
</html>
