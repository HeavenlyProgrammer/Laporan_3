<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penilaian Mahasiswa</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO"
        crossorigin="anonymous"></script>

    <style>
        body {
            background-color: #f8f9fa;
        }

        .card-header {
            background-color: #007bff;
            color: white;
        }

        .form-label {
            font-weight: bold;
        }

        .error-messages {
            margin-top: 15px;
        }

        .error-box {
            background-color: #dc3545;
            color: white;
            padding: 10px 15px;
            border-radius: 4px;
            font-size: 14px;
            margin-bottom: 8px;
            display: none;
        }

        .error-box.show {
            display: block;
        }

        .form-control.is-invalid {
            border-color: #dc3545;
        }

        .result-box {
            margin-top: 20px;
            border-radius: 5px;
            overflow: hidden;
        }

        .result-header {
            background-color: #dc3545;
            color: white;
            padding: 12px 20px;
            font-weight: bold;
            font-size: 14px;
        }

        .result-header.lulus {
            background-color: #28a745;
        }

        .result-body {
            background-color: white;
            padding: 20px 25px;
            border-left: 1px solid #dee2e6;
            border-right: 1px solid #dee2e6;
        }

        .nama-nim-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid #dee2e6;
        }

        .nama-section {
            font-size: 16px;
            font-weight: bold;
            color: #333;
        }

        .nim-section {
            font-size: 16px;
            font-weight: bold;
            color: #333;
        }

        .result-item {
            margin-bottom: 12px;
            font-size: 14px;
            color: #333;
        }

        .result-item strong {
            font-weight: 600;
        }

        .result-footer {
            background-color: #dc3545;
            padding: 0;
        }

        .result-footer.lulus {
            background-color: #28a745;
        }

        .btn-selesai {
            background-color: #dc3545;
            color: white;
            border: none;
            width: 100%;
            padding: 12px;
            font-weight: bold;
            border-radius: 0;
        }

        .btn-selesai:hover {
            background-color: #c82333;
            color: white;
        }

        .btn-selesai.lulus {
            background-color: #28a745;
        }

        .btn-selesai.lulus:hover {
            background-color: #218838;
            color: white;
        }
    </style>
</head>

<body>
    <div class="container mt-4 mb-5 px-5">
        <div class="card shadow-sm">
            <div class="card-header text-center">
                <h1 class="h4 mb-0">Form Penilaian Mahasiswa</h1>
            </div>
            <div class="card-body">
                <form method="post" id="formPenilaian" novalidate>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Masukkan Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Agus">
                    </div>
                    <div class="mb-3">
                        <label for="nim" class="form-label">Masukkan NIM</label>
                        <input type="text" class="form-control" id="nim" name="nim" placeholder="202332xxx">
                    </div>
                    <div class="mb-3">
                        <label for="kehadiran" class="form-label">Nilai Kehadiran (10%)</label>
                        <input type="number" class="form-control" id="kehadiran" name="kehadiran" placeholder="Untuk Lulus minimal 70%" min="0" max="100">
                    </div>
                    <div class="mb-3">
                        <label for="tugas" class="form-label">Nilai Tugas (20%)</label>
                        <input type="number" class="form-control" id="tugas" name="tugas" placeholder="0 - 100" min="0" max="100">
                    </div>
                    <div class="mb-3">
                        <label for="uts" class="form-label">Nilai UTS (30%)</label>
                        <input type="number" class="form-control" id="uts" name="uts" placeholder="0 - 100" min="0" max="100">
                    </div>
                    <div class="mb-3">
                        <label for="uas" class="form-label">Nilai UAS (40%)</label>
                        <input type="number" class="form-control" id="uas" name="uas" placeholder="0 - 100" min="0" max="100">
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" name="proses" class="btn btn-primary">Proses</button>
                    </div>

                    <div id="globalAlert" class="alert alert-danger mt-3 d-none" role="alert"></div>

                    <!-- Error Messages Container -->
                    <div class="error-messages" id="errorContainer">
                        <div class="error-box" id="error-nama">Nama harus diisi!</div>
                        <div class="error-box" id="error-nim">NIM harus diisi!</div>
                        <div class="error-box" id="error-kehadiran">Nilai Kehadiran harus diisi!</div>
                        <div class="error-box" id="error-tugas">Nilai Tugas harus diisi!</div>
                        <div class="error-box" id="error-uts">Nilai UTS harus diisi!</div>
                        <div class="error-box" id="error-uas">Nilai UAS harus diisi!</div>
                    </div>

                    
                </form>

                <?php
                if(isset($_POST['proses'])) {
                    // Mengambil data dari form
                    $nama = htmlspecialchars($_POST['nama']);
                    $nim = htmlspecialchars($_POST['nim']);
                    $kehadiran = floatval($_POST['kehadiran']);
                    $tugas = floatval($_POST['tugas']);
                    $uts = floatval($_POST['uts']);
                    $uas = floatval($_POST['uas']);

                    // Hitung nilai akhir dengan bobot
                    $nilaiAkhir = ($kehadiran * 0.10) + ($tugas * 0.20) + ($uts * 0.30) + ($uas * 0.40);

                    // Perhitungan hasil grade
                    if($nilaiAkhir >= 85) {
                        $grade = 'A';
                    } elseif ($nilaiAkhir >= 70) {
                        $grade = 'B';
                    } elseif ($nilaiAkhir >= 65) {
                        $grade = 'C';
                    } elseif ($nilaiAkhir >= 50) {
                        $grade = 'D';
                    } else {
                        $grade = 'E';
                    }

                    // Penentuan lulus atau tidak
                    if($nilaiAkhir >= 60 && $kehadiran >= 70 && $tugas >= 40 && $uts >= 40 && $uas >= 40) {
                        $status = 'LULUS';
                        $statusClass = 'lulus';
                    } else {  
                        $status = 'TIDAK LULUS';
                        $statusClass = '';
                    }  
                ?>

                <div class="result-box">
                    <div class="result-header <?php echo $statusClass; ?>">
                        Hasil Penilaian
                    </div>
                    
                    <div class="result-body">
                        <div class="nama-nim-row">
                            <div class="nama-section">Nama: <?php echo $nama; ?></div>
                            <div class="nim-section">NIM: <?php echo $nim; ?></div>
                        </div>
                        
                        <div class="result-item">
                            <strong>Nilai Kehadiran:</strong> <?php echo $kehadiran; ?>%
                        </div>
                        
                        <div class="result-item">
                            <strong>Nilai Tugas:</strong> <?php echo $tugas; ?>
                        </div>
                        
                        <div class="result-item">
                            <strong>Nilai UTS:</strong> <?php echo $uts; ?>
                        </div>
                        
                        <div class="result-item">
                            <strong>Nilai UAS:</strong> <?php echo $uas; ?>
                        </div>
                        
                        <div class="result-item">
                            <strong>Nilai Akhir:</strong> <?php echo number_format($nilaiAkhir, 2); ?>
                        </div>
                        
                        <div class="result-item">
                            <strong>Grade:</strong> <?php echo $grade; ?>
                        </div>
                        
                        <div class="result-item">
                            <strong>Status:</strong> <?php echo $status; ?>
                        </div>
                    </div>

                    <div class="result-footer <?php echo $statusClass; ?>">
                        <button type="button" class="btn btn-selesai <?php echo $statusClass; ?>" onclick="location.reload()">
                            Selesai
                        </button>
                    </div>
                </div>

                <?php
                }
                ?>
            </div>
        </div>
    </div>

    <script>
    document.getElementById('formPenilaian').addEventListener('submit', function (e) {

        const nama = document.getElementById('nama').value.trim();
        const nim = document.getElementById('nim').value.trim();
        const kehadiran = document.getElementById('kehadiran').value.trim();
        const tugas = document.getElementById('tugas').value.trim();
        const uts = document.getElementById('uts').value.trim();
        const uas = document.getElementById('uas').value.trim();

        const alertBox = document.getElementById('globalAlert');
        alertBox.classList.add('d-none');
        alertBox.innerText = '';

        //  Kondisi 1: Isi nilai saja
        if ((kehadiran || tugas || uts || uas) && (!nama || !nim)) {
            e.preventDefault();
            alertBox.innerText = 'Kolom Nama dan NIM harus diisi!';
            alertBox.classList.remove('d-none');
            return;
        }

        //  Kondisi 2: Isi nama & NIM saja
        if ((nama && nim) && (!kehadiran || !tugas || !uts || !uas)) {
            e.preventDefault();
            alertBox.innerText = 'Semua kolom harus diisi!';
            alertBox.classList.remove('d-none');
            return;
        }

        //  Kondisi 3: Kosong semua
        if (!nama && !nim && !kehadiran && !tugas && !uts && !uas) {
            e.preventDefault();
            alertBox.innerText = 'Semua kolom harus diisi!';
            alertBox.classList.remove('d-none');
            return;
        }
    });
</script>

</body>
</html>