<?php
require 'function.php';
$list = new ListUser();
$bayar = new ListBayar();
$detail_pembayaran = $bayar->listBayar();
$detail_mou = $list->investasiUser();


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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <style>h1{margin: 20px;} a{min-width: 130px;} th{padding:10px; padding-top: 2px; padding-bottom: 2px;} td{padding: 10px;} h2{font-size: 15px;}</style>
    <?php include 'nav.php' ?>
    <title>Mr.Kayu:Home</title>
</head>

<body style="background-image: url('../css/darkwood.png'); background-size:cover;">
    
    
    <div class="container">
    <h2 style="font-size:30px;text-align:center">Cek Pemberian</h2>
    <h3 style="font-size:30px;text-align:center;font-weight:bold">Admin <?php echo $user["fname"]; ?></h1>

    <a href="logout.php">Logout</a>
    
    <div style="margin-top:20px;">
        <label style="font-size: 20px;">
            List MOU User
        </label>
            <table class="rwd-table">
                <thead>
                    <tr style="border-bottom: 5px;border:1px solid chocolate;">
                        <th scope="col">ID</th>
                        <th scope="col">Investor</th>
                        <th scope="col">Pengrajin</th>
                        <th scope="col">Jumlah Dana</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $id_mou = 1;
                    $show = 0;
                        foreach ($detail_mou as $akun) {
                             if($akun['status'] == '1' or $akun['status'] == '4' and $id_mou < 6){
                        $pengrajin = $select->selectUsersById($akun['id_pengrajin']);
                        $investor = $select->selectUsersById($akun['id_investor']);
                        $show = 1;
                        
                    ?>
                <tr style="border:1px solid chocolate;">
                    <td><?php echo $id_mou++ ?></td>
                    <td><?php echo $investor['fname'] ?><h2>(NIK : <?php echo $investor['nik'] ?>)</h2></td>
                    <td><?php echo $pengrajin['fname'] ?><h2>(NIK : <?php echo $investor['nik'] ?>)</h2></td>
                    <td>Rp,-<?php echo $akun['jumlah_dana'] ?></td>
                    <?php if($akun['status'] == '1') { ?>
                    <td>
                        <a class="btn btn-success" href="mou.php?id_invest=<?php echo $akun['id'] ?>">Kirim Mou</a>
                    </td>
                    <?php } elseif ($akun['status'] == '4') { ?>
                    <td>
                        <a class="btn btn-primary" href="bukti_mou.php?id_pengrajin=<?php echo $akun['id_pengrajin'] ?>&id_investor=<?php echo $akun['id_investor'] ?>&mou=<?php echo $akun['mou'] ?>">Cek MOU</a>
                        <a class="btn btn-success" href="proses.php?id=<?php echo $akun['id'] ?>&aksi=mou_valid" onclick="return confirm('Apa kamu sudah cek?')">Valid</a>
                        <a class="btn btn-danger" href="invalid.php?id=<?php echo $akun['id'] ?>&id_pengrajin=<?php echo $akun['id_pengrajin'] ?>&id_investor=<?php echo $akun['id_investor'] ?>">Invalid</a>
                    </td>
                    <?php } ?>
                </tr>
                    <?php }} if ($show == 0) { ?>
                    <a> (Tidak ada untuk saat ini) </a>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                </tr>
                <?php }  ?>
                <tr>
                    <td></td>
                </tr>
                </tbody>
            </table>
            </div>
    </div>
</body>
</html>