<?php 

// Menghubungkan ke database
include 'config.php';

// Mengambil id parameter
$id_konsultasi = $_GET['id'] ?? '';

// Pastikan ID konsultasi tidak kosong
if (empty($id_konsultasi)) {
    echo "ID Konsultasi tidak valid!";
    exit;
}

// Ambil data konsultasi
$sql = "SELECT * FROM konsultasi WHERE id_konsultasi='$id_konsultasi'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if (!$row) {
    echo "Data konsultasi tidak ditemukan!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Konsultasi</title>
    <link rel="stylesheet" href="stylee.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container pt-2">
    <div class="card border-dark">
        <div class="card-header bg-dark text-white border-dark">
            <strong>Hasil Konsultasi</strong>
        </div>
        <div class="card-body">
            <form action="" method="POST">
                <div class="form-group">
                    <label for="nama">Nama Pasien</label>
                    <input type="text" class="form-control" value="<?php echo htmlspecialchars($row['nm_pasien']); ?>" readonly>
                </div>

                <!-- Tabel Gejala -->
                <label for="">Gejala-Gejala Penyakit</label>
                <table class="table table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th width="40px">No.</th>
                            <th width="700px" class="text-start">Nama Gejala</th> <!-- Tambahkan class text-start -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $sql = "SELECT g.nm_gejala 
                                FROM detail_konsultasi dk
                                INNER JOIN gejala g ON dk.id_gejala = g.id_gejala
                                WHERE dk.id_konsultasi = '$id_konsultasi'";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while ($data = $result->fetch_assoc()) {
                                echo "<tr>
                                        <td>{$no}</td>
                                        <td class='text-start'>" . htmlspecialchars($data['nm_gejala']) . "</td> <!-- Tambahkan text-start -->
                                      </tr>";
                                $no++;
                            }
                        } else {
                            echo "<tr><td colspan='2' class='text-center'>Tidak ada gejala</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>

                <!-- Tabel Hasil Konsultasi Penyakit -->
                <label for="">Hasil Konsultasi Penyakit:</label>
                <table class="table table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th width="40px">No.</th>
                            <th width="150px" class="text-start">Nama Penyakit</th> <!-- Tambahkan class text-start -->
                            <th width="100px">Presentase</th>
                            <th width="400px" class="text-start">Solusi</th> <!-- Tambahkan class text-start -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $sql = "SELECT p.nm_penyakit, p.solusi, dp.presentase 
                                FROM detail_penyakit dp
                                INNER JOIN penyakit p ON dp.id_penyakit = p.id_penyakit
                                WHERE dp.id_konsultasi = '$id_konsultasi'
                                ORDER BY dp.presentase DESC";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while ($data = $result->fetch_assoc()) {
                                echo "<tr>
                                        <td>{$no}</td>
                                        <td class='text-start'>" . htmlspecialchars($data['nm_penyakit']) . "</td> <!-- Tambahkan text-start -->
                                        <td>{$data['presentase']}%</td>
                                        <td class='text-start'>" . htmlspecialchars($data['solusi']) . "</td> <!-- Tambahkan text-start -->
                                      </tr>";
                                $no++;
                            }
                        } else {
                            echo "<tr><td colspan='4' class='text-center'>Tidak ada hasil konsultasi</td></tr>";
                        }
                        $conn->close();
                        ?>
                    </tbody>
                </table>

                <a class="btn btn-danger" href="?page=konsultasiadm">Kembali</a>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
