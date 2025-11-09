<?php

if(isset($_POST['simpan'])){
    $nm_penyakit=$_POST['nm_penyakit'];
    $keterangan=$_POST['keterangan'];
    $solusi=$_POST['solusi'];

	//proses simpan
        $sql = "INSERT INTO penyakit VALUES (Null,'$nm_penyakit','$keterangan','$solusi')";
        if ($conn->query($sql) === TRUE) {
            header("Location:?page=penyakit");
        }
    }
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Penyakit</title>
    <link rel="stylesheet" href="stylee.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container pt-4">
    <div class="row">
        <div class="col-sm-12">
            <form action="" method="POST">
                <div class="card border-dark">
                    <div class="card-header bg-dark text-white border-dark">
                        <strong>Tambah Data Penyakit</strong>
                    </div>
                    <div class="card-body">
                        <div class="form-group mb-3">
                            <label for="nm_penyakit">Nama Penyakit</label>
                            <input type="text" class="form-control" name="nm_penyakit" maxlength="50" placeholder="Masukkan Nama Penyakit" required>
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="keterangan">Keterangan</label>
                            <input type="text" class="form-control" name="keterangan" maxlength="200" placeholder="Masukkan Keterangan" required>
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="solusi">Solusi</label>
                            <input type="text" class="form-control" name="solusi" maxlength="200" placeholder="Masukkan Solusi" required>
                        </div>
                        
                        <button class="btn btn-primary" type="submit" name="simpan">Simpan</button>
                        <a class="btn btn-danger" href="?page=penyakit">Batal</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
