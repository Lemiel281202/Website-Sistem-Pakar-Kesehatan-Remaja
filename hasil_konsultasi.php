<?php 
// Pastikan sudah include file koneksi database
include 'config.php';

// Mengambil id_konsultasi dari URL
$id_konsultasi = $_GET['id_konsultasi'];

// Ambil data pasien dari tabel konsultasi
$sql = "SELECT * FROM konsultasi WHERE id_konsultasi='$id_konsultasi'";
$result = $conn->query($sql);
$row_pasien = $result->fetch_assoc();
?>

<!-- Tampilan hasil konsultasi -->
<div class="row">
    <div class="col-sm-12">
        <form action="" method="POST">
            <div class="card border-dark">
                <div class="card">
                    <div class="card-header bg-dark text-white border-dark">
                        <strong>Hasil Konsultasi</strong>
                    </div>
                    <div class="card-body">

                        <div class="form-group">
                            <label for="">Nama Pasien</label>
                            <input type="text" class="form-control" value="<?php echo $row_pasien['nm_pasien']; ?>" name="nama" readonly>
                        </div>

                        <!-- Tabel Gejala -->
                        <label for="">Gejala-Gejala Penyakit</label>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th width="40px">No.</th>
                                    <th width="700px">Nama Gejala</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                $sql = "SELECT gejala.nm_gejala FROM detail_konsultasi 
                                        INNER JOIN gejala ON detail_konsultasi.id_gejala = gejala.id_gejala 
                                        WHERE detail_konsultasi.id_konsultasi = '$id_konsultasi'";
                                $result = $conn->query($sql);
                                while ($row_gejala = $result->fetch_assoc()) {
                                    ?>
                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo $row_gejala['nm_gejala']; ?></td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>

                        <!-- Tabel Hasil Konsultasi Penyakit -->
                        <label for="">Hasil Konsultasi Penyakit :</label>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th width="40px">No.</th>
                                    <th width="150px">Nama Penyakit</th>
                                    <th width="100px">Presentase</th>
                                    <th width="400px">Solusi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                $sql = "SELECT penyakit.nm_penyakit, penyakit.solusi, detail_penyakit.presentase 
                                        FROM detail_penyakit 
                                        INNER JOIN penyakit ON detail_penyakit.id_penyakit = penyakit.id_penyakit 
                                        WHERE detail_penyakit.id_konsultasi = '$id_konsultasi'
                                        ORDER BY detail_penyakit.presentase DESC"; 

                                $result = $conn->query($sql);
                                while ($row_penyakit = $result->fetch_assoc()) {
                                    ?>
                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo $row_penyakit['nm_penyakit']; ?></td>
                                        <td><?php echo $row_penyakit['presentase'] . "%"; ?></td>
                                        <td><?php echo $row_penyakit['solusi']; ?></td>
                                    </tr>
                                    <?php
                                }
                                $conn->close();
                                ?>
                            </tbody>
                        </table>
                        
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
