<?php
include 'config.php'; // Pastikan koneksi database

date_default_timezone_set("Asia/Jakarta");

if(isset($_POST['proses'])){

    // Periksa apakah input tersedia sebelum mengaksesnya
    $nm_pasien = isset($_POST['nm_pasien']) ? mysqli_real_escape_string($conn, $_POST['nm_pasien']) : '';
    $tgl = date("Y-m-d");

    // Pastikan pasien mengisi nama
    if(empty($nm_pasien)){
        die("Nama pasien harus diisi!");
    }

    // Simpan data ke tabel konsultasi
    $sql = "INSERT INTO konsultasi (tanggal, nm_pasien) VALUES ('$tgl', '$nm_pasien')";
    if ($conn->query($sql) === TRUE) {
        $id_konsultasi = $conn->insert_id; // Ambil ID konsultasi terbaru

        // Cek apakah ada gejala yang dipilih
        if (!empty($_POST['id_gejala'])) {
            $id_gejala = $_POST['id_gejala'];

            // Simpan data ke tabel detail_konsultasi
            foreach ($id_gejala as $id_g) {
                $id_g = mysqli_real_escape_string($conn, $id_g);
                $conn->query("INSERT INTO detail_konsultasi (id_konsultasi, id_gejala) VALUES ('$id_konsultasi', '$id_g')")
                or die("Error: " . $conn->error);
            }
        }

        // Proses analisis penyakit
        $sql = "SELECT * FROM penyakit";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            $id_penyakit = $row['id_penyakit'];
            $jyes = 0;

            // Jumlah gejala dalam basis aturan
            $sql2 = "SELECT COUNT(id_penyakit) AS jml_gejala FROM basis_aturan 
                     INNER JOIN detail_basis_aturan ON basis_aturan.id_aturan = detail_basis_aturan.id_aturan
                     WHERE id_penyakit = '$id_penyakit'";
            $result2 = $conn->query($sql2);
            $row2 = $result2->fetch_assoc();
            $jml_gejala = $row2['jml_gejala'];

            // Cek gejala pasien dengan basis aturan
            $sql3 = "SELECT id_gejala FROM basis_aturan 
                     INNER JOIN detail_basis_aturan ON basis_aturan.id_aturan = detail_basis_aturan.id_aturan
                     WHERE id_penyakit = '$id_penyakit'";
            $result3 = $conn->query($sql3);
            while ($row3 = $result3->fetch_assoc()) {
                $id_gejalane = $row3['id_gejala'];
                $sql4 = "SELECT id_gejala FROM detail_konsultasi 
                         WHERE id_konsultasi = '$id_konsultasi' AND id_gejala = '$id_gejalane'";
                $result4 = $conn->query($sql4);
                if ($result4->num_rows > 0) {
                    $jyes++;
                }
            }

            // Hitung persentase kecocokan
            $peluang = ($jml_gejala > 0) ? round(($jyes / $jml_gejala) * 100, 2) : 0;

            // Simpan hasil analisis jika ada kecocokan
            if ($peluang > 0) {
                $conn->query("INSERT INTO detail_penyakit (id_konsultasi, id_penyakit, presentase) 
                              VALUES ('$id_konsultasi', '$id_penyakit', '$peluang')")
                or die("Error: " . $conn->error);
            }
        }

        // Redirect ke halaman hasil
        header("Location:?page=konsultasi&action=hasil&id_konsultasi=$id_konsultasi");
        exit();
    } else {
        die("Error: " . $conn->error);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konsultasi Gejala Pasien</title>
    <link rel="stylesheet" href="style.css"> <!-- CSS eksternal -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container pt-3">
    <div class="card border-dark">
        <div class="card-header bg-dark text-white">
            <strong>Konsultasi Gejala Pasien</strong>
        </div>
        <div class="card-body">
            <form action="" method="POST" name="Form" onsubmit="return validasiForm()">
                <div class="mb-3">
                    <label class="form-label">Nama Pasien</label>
                    <input type="text" class="form-control" name="nm_pasien" maxlength="50" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Pilih Gejala Berikut:</label>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th width="30px"></th>
                                <th width="30px">No.</th>
                                <th width="200px">Nama Gejala</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $sql = "SELECT * FROM gejala ORDER BY nm_gejala ASC";
                            $result = $conn->query($sql);
                            while ($row = $result->fetch_assoc()) {
                            ?>
                                <tr>
                                    <td>
                                        <input type="checkbox" class="check-item" name="id_gejala[]" value="<?php echo $row['id_gejala']; ?>"/>
                                    </td>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo htmlspecialchars($row['nm_gejala']); ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>

                <button type="submit" class="btn btn-primary" name="proses">Kirim</button>
            </form>
        </div>
    </div>
</div>

<script>
    function validasiForm() {
        var checkbox = document.getElementsByName("id_gejala[]");
        var isChecked = false;

        for (var i = 0; i < checkbox.length; i++) {
            if (checkbox[i].checked) {
                isChecked = true;
                break;
            }
        }

        if (!isChecked) {
            alert('Pilih setidaknya satu gejala!');
            return false;
        }
        return true;
    }
</script>

</body>
</html>
