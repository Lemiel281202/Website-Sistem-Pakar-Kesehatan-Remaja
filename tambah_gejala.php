<?php

if(isset($_POST['simpan'])){
    $nm_gejala=$_POST['nm_gejala'];

	//proses simpan
        $sql = "INSERT INTO gejala VALUES (Null,'$nm_gejala')";
        if ($conn->query($sql) === TRUE) {
            header("Location:?page=gejala");
        }
    }
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Gejala</title>
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
                        <strong>Tambah Data Gejala</strong>
                    </div>
                    <div class="card-body">
                        <div class="form-group mb-3">
                            <label for="nm_gejala">Nama Gejala</label>
                            <input type="text" class="form-control" name="nm_gejala" maxlength="200" required>
                        </div>
                        
                        <button class="btn btn-primary" type="submit" name="simpan">Simpan</button>
                        <a class="btn btn-danger" href="?page=gejala">Batal</a>
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
