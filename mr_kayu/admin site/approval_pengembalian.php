<?php
require 'function.php';
$bayar = new ListBayar();
$detail = $bayar->listBayar();


$select = new Select();

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
    <link rel="stylesheet" href="css/index.css">
    <style>a{min-width: 130px;} th{padding:10px;} td{padding: 10px;}</style>

    <title>Mr.Kayu:Home</title>
</head>
<?php include 'nav.php' ?>
<body style="background-image: url('../css/darkwood.png'); background-size:cover;">
    
    
    <div class="container">
    <h2 style="font-size:30px;text-align:center">Cek Pengembalian</h2>
    <h3 style="font-size:30px;text-align:center;font-weight:bold">Admin <?php echo $user["fname"]; ?></h1>

    <a href="logout.php">Logout</a>
    <div style="margin-top:20px;">
        <label style="font-size: 20px;">
            List Pembayaran
        </label>
            <table class="rwd-table">
                <thead>
                    <tr style="border-bottom: 5px;border:1px solid chocolate;">
                        <th scope="col">ID</th>
                        <th scope="col">Nama Pengrajin</th>
                        <th scope="col">Email Pengrajin</th>
                        <th scope="col">Jumlah dana</th>
                        <th scope="col">Email Investor</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $id = 1;
                    $show = 0;
                    $pengembalian = 'Pengembalian';
                        foreach ($detail as $akun) {
                             if($akun['status'] == '3' or $akun['status'] == '4'){
                            $pengrajin = $select->selectUsersById($akun['id_pengrajin']);
                            $investor = $select->selectUsersById($akun['id_investor']);
                            $show = 1;
                    ?>
                        <tr style="border:1px solid chocolate;">
                            <td><?php echo $id++; ?></td>
                            <td><?php echo $pengrajin['fname']; ?></td>
                            <td><?php echo $pengrajin['email']?></td>
                            <td>Rp,-<?php echo $akun['jumlah']?></td>
                            <td><?php echo $investor['email']?></td>
                            <?php if ($akun['status'] == '3') { ?>
                            <td>Menunggu di proses</td>
                            <td>
                                <a class="btn btn-primary btn-sm" href="bayar.php?id=<?php echo $akun['id'] ?>&bukti=<?php echo $akun['bukti'] ?>">Bukti Pembayaran</a>
                                <a class="btn btn-success btn-sm" href="detail_pembayaran.php?admin=<?php echo $user['id'] ?>&id_bayar=<?php echo $akun['id'] ?>&id_invest=<?php echo $akun['id_invest'] ?>&id_pengrajin=<?php echo $akun['id_pengrajin'] ?>&id_investor=<?php echo $akun['id_investor'] ?>&status=<?php echo $pengembalian ?>&aksi=kembalikan" onclick="return confirm('Sudah di cek?')">Kirim ke User</a>
                            </td>
                            <?php } else {?>
                            <td>Sudah di kirim</td>
                            <?php }?>
                        </tr>
                        
                    <?php
                             }}if($show == 0) {
                    ?>
                    <tr>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                    </tr>
                    <?php } ?>
                        <tr>
                            <td></td>
                        </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>