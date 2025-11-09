<?php
include 'config.php'; // Pastikan koneksi database

// Proses menyimpan data dari form
if(isset($_POST['simpan'])){
    $nm_penyakit = mysqli_real_escape_string($conn, $_POST['nm_penyakit']);
    
    // Validasi nama penyakit
    $sql = "SELECT id_penyakit FROM penyakit WHERE nm_penyakit = '$nm_penyakit'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $id_penyakit = $row['id_penyakit'];
        
        // Cek apakah basis aturan sudah ada
        $sql = "SELECT id_aturan FROM basis_aturan WHERE id_penyakit = '$id_penyakit'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            echo "<div class='alert alert-danger'>Data penyakit tersebut sudah ada dalam basis aturan.</div>";
        } else {
            // Simpan ke basis aturan
            $sql = "INSERT INTO basis_aturan (id_penyakit) VALUES ('$id_penyakit')";
            if ($conn->query($sql) === TRUE) {
                $id_aturan = $conn->insert_id;
                
                // Simpan detail basis aturan jika ada gejala yang dipilih
                if (isset($_POST['id_gejala']) && is_array($_POST['id_gejala'])) {
                    foreach ($_POST['id_gejala'] as $id_gejalane) {
                        $id_gejalane = mysqli_real_escape_string($conn, $id_gejalane);
                        $conn->query("INSERT INTO detail_basis_aturan (id_aturan, id_gejala) VALUES ('$id_aturan', '$id_gejalane')");
                    }
                }
                echo "<script>alert('Data berhasil disimpan!'); window.location.href='?page=aturan';</script>";
                exit;
            } else {
                echo "<div class='alert alert-danger'>Gagal menyimpan data!</div>";
            }
        }
    } else {
        echo "<div class='alert alert-danger'>Nama penyakit tidak ditemukan!</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Basis Aturan</title>
    <link rel="stylesheet" href="stylee.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container pt-2">
    <div class="card border-dark">
        <div class="card-header bg-dark text-white border-dark">
            <strong>Tambah Data Basis Aturan</strong>
        </div>
        <div class="card-body">
            <form action="" method="POST" name="Form" onsubmit="return validasiForm()">
                <div class="form-group">
                    <label for="nm_penyakit">Nama Penyakit</label>
                    <select class="form-control" name="nm_penyakit" required>
                        <option value="">Pilih Nama Penyakit</option>
                        <?php
                        $sql = "SELECT * FROM penyakit ORDER BY nm_penyakit ASC";
                        $result = $conn->query($sql);
                        while ($row = $result->fetch_assoc()) {
                            echo '<option value="'.$row['nm_penyakit'].'">'.$row['nm_penyakit'].'</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Pilih Gejala Berikut:</label>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th width="30px"></th>
                                <th width="30px">No.</th>
                                <th>Nama Gejala</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $sql = "SELECT * FROM gejala ORDER BY nm_gejala ASC";
                            $result = $conn->query($sql);
                            while ($row = $result->fetch_assoc()) {
                                echo '<tr>
                                    <td><input type="checkbox" name="id_gejala[]" value="'.$row['id_gejala'].'"></td>
                                    <td>'.$no++.'</td>
                                    <td>'.htmlspecialchars($row['nm_gejala']).'</td>
                                </tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <input class="btn btn-primary" type="submit" name="simpan" value="Simpan">
                <a class="btn btn-danger" href="?page=aturan">Batal</a>
            </form>
        </div>
    </div>
</div>
<script>
    function validasiForm() {
        var nm_penyakit = document.forms["Form"]["nm_penyakit"].value;
        if (nm_penyakit == "") {
            alert("Nama Penyakit Harus Dipilih");
            return false;
        }
        var checkbox = document.getElementsByName('id_gejala[]');
        var isChecked = Array.from(checkbox).some(cb => cb.checked);
        if (!isChecked) {
            alert('Pilih setidaknya satu gejala!');
            return false;
        }
        return true;
    }
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
