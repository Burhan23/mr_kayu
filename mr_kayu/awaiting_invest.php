<?php
require 'function.php';
$send = new Send();

$invest = new Invest();
$select = new Select();
$specify = new Specify();
$date = new Date();

if(!empty($_SESSION["id"])){
  $user = $select->selectUserById($_SESSION["id"]);
  $detail = $invest->getFromThisRowAsInvestor($user['id']);
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
    <link rel="stylesheet" href="css/index2.css">
    <style>a{min-width: 130px;} th{padding:10px;} td{padding: 10px;}</style>

    <title>Mr.Kayu:Home</title>
</head>
<?php include 'nav_investor.php' ?>
<body style="background-image: url('css/darkbrown2.png'); background-size:cover;">
    
    
    <div class="container">
    <h1 style="font-weight:bold">List Investasimu</h1>
    <h1><?php echo $user["username"]; ?></h1>
    <div style="margin-top:20px;">
        <label style="font-size: 20px;">
            Daftar Investasi yang kamu ajukan
        </label>
        <a style="float:right">
        <label style="font-size: 20px;">
            Customer Service : https:/wa.me/0820213
        </label>
    </a>
            <table class="rwd-table">
                <thead>
                    <tr style="border-bottom: 5px;">
                        <th scope="col">ID</th>
                        <th scope="col">Nama Pengrajin</th>
                        <th scope="col">NIK Pengrajin</th>
                        <th scope="col">Dana yang di invest</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $id = 1;
                    $show = 0;
                        foreach ($detail as $akun) {
                    $pengrajin = $select->selectUserById($akun['id_pengrajin']);
                    $tanggal = $date->tanggalIndonesia($akun['tanggal_pengembalian']);
                    $show = 1;
                    ?>
                        <tr style="border:1px solid green;">
                            <td><?php echo $id++; ?></td>
                            <td><?php echo $pengrajin['fname']; ?></td>
                            <td><?php echo $pengrajin['nik'] ?></td>
                            <td><?php echo $akun['jumlah_dana']?></td>
                            <td><?php echo $akun['status_investor']?> <?php if ($akun['status'] == '7') { echo $tanggal;}?></td>
                            <?php if($akun['status'] == '2' or $akun['status'] == '4.0' or $akun['status'] == '4.2') { ?>
                            <td>    
                                <a class="btn btn-primary btn-sm" href="mou.php?id=<?php echo $akun['id'] ?>&opsi=<?php echo $akun['status'] ?>">Isi MOU</a>
                            </td>
                            <?php } elseif($akun['status'] == '5'){ ?>
                            <td>
                                <a class="btn btn-primary btn-sm" href="bayar_investasi.php?id=<?php echo $akun['id'] ?>">Bayar Investasi</a>
                                
                            </td>
                            <?php } ?>
                        </tr>
                    <?php
                        } if ($show==0) {
                    ?>
                    <tr>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>