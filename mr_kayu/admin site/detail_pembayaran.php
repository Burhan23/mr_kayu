<?php
include 'db_conn.php';
$db = new database();

require 'function.php';

$select = new Select();
$pengrajin = $select->selectUsersById($_REQUEST['id_pengrajin']);
$investor = $select->selectUsersById($_REQUEST['id_investor']);

if(!empty($_SESSION["id"])){
    $user = $select->selectUserById($_SESSION["id"]);
  }
  else{
    header("Location: login.php");
  }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" 
    rel="stylesheet" 
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" 
    crossorigin="anonymous">
    <link rel="stylesheet" href="../css/add.css">
    <title>Add akun</title>
</head>
<body style="background-image: url('../css/form2.png'); background-size:cover;" runat="server">
    <div class="container">
        <h1>
            Upload Bukti Pembayaran Admin
        </h1>
        <form action="proses.php?admin=<?php echo $user['id'] ?>&id_bayar=<?php echo $_REQUEST['id_bayar'] ?>&id_invest=<?php echo $_REQUEST['id_invest'] ?>&id_pengrajin=<?php echo $_REQUEST['id_pengrajin'] ?>&id_investor=<?php echo $_REQUEST['id_investor'] ?>&status=<?php echo $_REQUEST['status'] ?>&aksi=<?php echo $_REQUEST['aksi'] ?>" enctype="multipart/form-data" method="post">
            <div class="mb-3">
                <label style="font-weight: bold;" class="form-label">Status : <?php echo $_REQUEST['status'] ?></label>
            </div>
            <div class="mb-3">
                <label for="nama_product" class="form-label">Nama Pengrajin</label>
                <input type="text" class="form-control" id="nama_product" name="nama_product" readonly value="<?php echo $pengrajin['fname'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="nama_product" class="form-label">Nama Investor</label>
                <input type="text" class="form-control" id="nama_product" name="nama_product" readonly value="<?php echo $investor['fname'] ?>" required>
            </div>
            <label for="deskripsi" class="form-label">Upload Foto Bukti Pembayaran :</label>
            <div>
                <img style="min-width:300px;min-height:300px; max-width:600px; max-height:400px; "id="gambar" src="#" alt=" "/>
            </div>
            <div class="center" style="justify-content:center">
                <input style="color:white" accept="image/*" type='file' id="filegambar" name="bukti" />
            </div>
            <br>
            <input type="submit" class="btn btn-primary" value="Simpan">
        </form>

    </div>

    <script src="../js/image-upload.js"></script>
</body>
</html>