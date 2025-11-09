<!-- penapilan data berdasarkan basis aturan -->
<?php
    $id_aturan=$_GET['id'];

    $sql = "SELECT basis_aturan.id_aturan,basis_aturan.id_penyakit,penyakit.nm_penyakit
    FROM basis_aturan INNER JOIN penyakit ON basis_aturan.id_penyakit=penyakit.id_penyakit
    WHERE id_aturan ='$id_aturan'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    // proses update
    if(isset($_POST['update'])){
        $id_gejala=$_POST['id_gejala'];

    // prose simpan detail aturan
    if($id_gejala!=Null){
            $jumlah = count($id_gejala);
            $i=0;
            while ($i < $jumlah) {
                $id_gejalane = $id_gejala[$i];
                $sql = "INSERT INTO detail_basis_aturan VALUES ($id_aturan,'$id_gejalane')";
                mysqli_query($conn,$sql);
                $i++;
        }
    }
     header("Location:?page=aturan");    
    }
    
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Data Basis Aturan</title>
    <link rel="stylesheet" href="stylee.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container pt-2">
    <div class="card border-dark">
        <div class="card-header bg-dark text-white border-dark">
            <strong>Update Data Basis Aturan</strong>
        </div>
        <div class="card-body">
            <form action="" method="POST">
                <div class="form-group">
                    <label for="">Nama Penyakit</label>
                    <input type="text" name="nama_penyakit" class="form-control" value="<?php echo $row['nm_penyakit']; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="">Pilih Gejala Berikut :</label>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th width="30px"></th>
                                <th width="30px">No.</th>
                                <th width="200px">Nama Gejala</th>
                                <th width="30px"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $no = 1;
                                $sql = "SELECT * FROM gejala ORDER BY nm_gejala ASC";
                                $result = $conn->query($sql);
                                while ($row = $result->fetch_assoc()) {
                                    $id_gejala = $row['id_gejala'];
                                    $sql2 = "SELECT * FROM detail_basis_aturan WHERE id_aturan='$id_aturan' AND id_gejala='$id_gejala'";
                                    $result2 = $conn->query($sql2);
                                    if ($result2->num_rows > 0) {
                            ?>
                            <tr>
                                <td align="center"><input type="checkbox" class="check-item" disabled="disabled"></td>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $row['nm_gejala']; ?></td>
                                <td align="center">
                                    <a onclick="return confirm('Yakin menghapus data ini ?')" class="btn btn-danger" href="?page=aturan&action=hapus_gejala&id_aturan=<?php echo $id_aturan; ?>&id_gejala=<?php echo $id_gejala; ?>">
                                        <i class="fas fa-window-close"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php
                                } else {
                            ?>
                            <tr>
                                <td align="center"><input type="checkbox" class="check-item" name="id_gejala[]" value="<?php echo $row['id_gejala']; ?>"/></td>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $row['nm_gejala']; ?></td>
                                <td align="center">
                                    <i class="fas fa-window-close"></i>
                                </td>
                            </tr>
                            <?php
                                }
                            }
                            $conn->close();
                            ?>
                        </tbody>
                    </table>
                </div>
                <input class="btn btn-primary" type="submit" name="update" value="Update">
                <a class="btn btn-danger" href="?page=aturan">Batal</a>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
