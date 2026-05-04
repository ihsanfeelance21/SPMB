<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Kelulusan PPDB</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #333;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
            font-size: 20px;
            text-transform: uppercase;
        }
        .header p {
            margin: 5px 0 0 0;
            font-size: 12px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table th, table td {
            border: 1px solid #999;
            padding: 8px;
            text-align: left;
        }
        table th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        .text-center {
            text-align: center;
        }
        .footer {
            margin-top: 50px;
            text-align: right;
        }
        .signature {
            display: inline-block;
            text-align: center;
        }
        .signature p {
            margin: 0 0 60px 0;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>DAFTAR CALON SISWA LOLOS SELEKSI</h1>
        <p>PENERIMAAN PESERTA DIDIK BARU (PPDB)</p>
        <p><strong><?= esc($settings['nama_sekolah'] ?? 'SEKOLAH') ?></strong></p>
        <p>TAHUN PELAJARAN <?= esc($settings['tahun_pelajaran'] ?? '') ?></p>
    </div>

    <table>
        <thead>
            <tr>
                <th class="text-center" width="5%">No</th>
                <th width="30%">Nama Lengkap</th>
                <th width="20%">No. Identitas</th>
                <th width="30%">Asal Sekolah</th>
                <th class="text-center" width="15%">Nilai Rapor</th>
            </tr>
        </thead>
        <tbody>
            <?php if(empty($pendaftar)): ?>
                <tr>
                    <td colspan="5" class="text-center">Belum ada data siswa yang lolos seleksi.</td>
                </tr>
            <?php else: ?>
                <?php $no = 1; foreach($pendaftar as $p): ?>
                <tr>
                    <td class="text-center"><?= $no++ ?></td>
                    <td><?= esc($p['nama_lengkap']) ?></td>
                    <td><?= esc($p['no_identitas']) ?></td>
                    <td><?= esc($p['asal_sekolah']) ?></td>
                    <td class="text-center"><?= esc($p['total_nilai']) ?></td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="footer">
        <div class="signature">
            <p>Ditetapkan pada: <?= date('d F Y') ?></p>
            <br>
            <p><strong>Panitia PPDB</strong></p>
        </div>
    </div>

</body>
</html>
