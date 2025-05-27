<!DOCTYPE html>
<html>
<head>
    <title>Kalender</title>
    <style>

        body{
            min-height: 90vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f8f9fa;
        }
        .calendar-canvas {
            width: 700px;
            height: 500px;
            margin: 0;
            background: #f8f9fa;
            border-radius: 16px;
            /* box-shadow: 0 4px 16px rgba(0,0,0,0.08); */
            padding: 30px;
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        table.calendar-table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        }
        .calendar-table th, .calendar-table td {
            width: 14.28%;
            height: 40px;
            text-align: center;
            font-size: 16px;
            border: 3px solid #333;
        }
        .calendar-table th {
            background:rgb(255, 255, 255);
            color: #fff;
            font-weight: bold;
            color: #333;
        }
        .calendar-table td {
            background: #f9f9f9;
        }
        /* .calendar-table td.today {
            background:rgb(255, 0, 0)
            color:rgb(255, 255, 255);
            font-weight: bold;
            border: 3px solid #333;
        } */

          .calendar-table td.same-date {
            background:rgb(255, 0, 0);
            color:rgb(255, 255, 255);
            font-weight: bold;
            border: 3px solid #333;
        }
        .calendar-nav {
            margin-bottom: 16px;
            font-size: 16px;
            
        }
        .calendar-nav a {
            color: #007bff;
            text-decoration: none;
            margin: 0 80px;
            font-weight: bold;
        }
        .calendar-nav a:hover {
            text-decoration: underline;
        }
        h2 {
            margin-bottom: 10px;
            color: #333;
            font-size: 30px;
            font-weight: bold;
        }
    </style>
</head>
<body>
<div class="calendar-canvas">
    <?php
    date_default_timezone_set('Asia/Jakarta');
    $bulan = isset($_GET['bulan']) ? intval($_GET['bulan']) : date('n');
    $tahun = isset($_GET['tahun']) ? intval($_GET['tahun']) : date('Y');

    // Navigasi bulan
    if ($bulan < 1) {
        $bulan = 12;
        $tahun--;
    }
    if ($bulan > 12) {
        $bulan = 1;
        $tahun++;
    }

    $nama_bulan = [
        "Januari", "Februari", "Maret", "April", "Mei", "Juni", 
        "Juli", "Agustus", "September", "Oktober", "November", "Desember"
    ];

    $jumlah_hari = date('t', strtotime("$tahun-$bulan-01"));
    $hari_pertama = date('w', strtotime("$tahun-$bulan-01"));

    // Tanggal hari ini
    $today = date('j');
    $this_month = date('n');
    $this_year = date('Y');
    // Simpan tanggal hari ini dalam format Y-m-d
    $tanggal_hari_ini = date('Y-m-d');
    ?>
    <h2>Kalender <?php echo $nama_bulan[$bulan-1]." ".$tahun; ?></h2>
    <div class="calendar-nav">
        <a href="?bulan=<?php echo $bulan-1; ?>&tahun=<?php echo $tahun; ?>">&laquo; Bulan Sebelumnya</a>
        <a href="?bulan=<?php echo $bulan+1; ?>&tahun=<?php echo $tahun; ?>">Bulan Berikutnya &raquo;</a>
    </div>
    <table class="calendar-table">
        <tr>
            <th>Minggu</th><th>Senin</th><th>Selasa</th><th>Rabu</th>
            <th>Kamis</th><th>Jum'at</th><th>Sabtu</th>
        </tr>
        <tr>
        <?php
        // Sel kosong sebelum tanggal 1
        for ($i = 0; $i < $hari_pertama; $i++) {
            echo "<td></td>";
        }
        // Tanggal-tanggal bulan ini
        for ($hari = 1; $hari <= $jumlah_hari; $hari++) {
            // Format tanggal yang sedang di-loop
            $tanggal_loop = sprintf('%04d-%02d-%02d', $tahun, $bulan, $hari);
            // Cek apakah ini tanggal hari ini (tepat hari, bulan, tahun)
            $is_today = ($tanggal_loop == $tanggal_hari_ini);
            // Cek apakah ini tanggal yang sama dengan hari ini (hanya tanggal)
            $is_same_date = ($hari == $today);

            // Tentukan kelas CSS
            $class = '';
            if ($is_today || $is_same_date) {
                $class = 'same-date';
            }
        

            echo "<td class='$class'>$hari</td>";
            // Pindah baris setiap Sabtu
            if (($hari + $hari_pertama) % 7 == 0 && $hari != $jumlah_hari) {
                echo "</tr><tr>";
            }
        }
        // Sel kosong setelah tanggal terakhir
        $last_cell = ($jumlah_hari + $hari_pertama) % 7;
        if ($last_cell != 0) {
            for ($i = $last_cell; $i < 7; $i++) {
                echo "<td></td>";
            }
        }
        ?>
        </tr>
    </table>
</div>
</body>
</html>