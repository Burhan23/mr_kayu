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

<body style="background-image: url('../css/darkwood.png');background-size:cover; ">
    
    
    <div class="container">
    <h2 style="font-size:30px;text-align:center;color:burlywood">List Pembayaran</h2>
    <h3 style="font-size:30px;text-align:center;font-weight:bold;color:burlywood">Admin <?php echo $user["fname"]; ?></h1>
    <a href="logout.php">Logout</a>
    
    <div style="margin-top:20px;">
        <label style="font-size: 20px;">
            List Pembayaran
        </label>
            <table class="rwd-table">
                <thead>
                    <tr style="border-bottom: 5px;border:1px solid chocolate;">
                        <th scope="col">ID</th>
                        <th scope="col">Nama Investor</th>
                        <th scope="col">Email Investor</th>
                        <th scope="col">Jumlah dana</th>
                        <th scope="col">Email Pengrajin</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                
                <?php
                    $show = 0;
                    $pemberian = 'Pemberian';
                    $id_pembayaran = 1;
                        foreach ($detail_pembayaran as $info) {
                             if($info['status'] == '1' or $info['status'] == '2'){
                            $pengrajin = $select->selectUsersById($info['id_pengrajin']);
                            $investor = $select->selectUsersById($info['id_investor']);
                            $show = 1;
                    ?>
                        <tr style="border:1px solid chocolate;">
                            <td><?php echo $id_pembayaran++; ?></td>
                            <td><?php echo $investor['fname']; ?></td>
                            <td><?php echo $investor['email']?></td>
                            <td>Rp,-<?php echo $info['jumlah']?></td>
                            <td><?php echo $pengrajin['email']?></td>
                            <?php if ($info['status'] == '1') { ?>
                            <td>Menunggu di proses</td>
                            <td>
                                <a class="btn btn-primary btn-sm" href="bayar.php?id=<?php echo $info['id'] ?>&bukti=<?php echo $info['bukti'] ?>">Bukti Pembayaran</a>
                                <a class="btn btn-success btn-sm" href="detail_pembayaran.php?admin=<?php echo $user['id'] ?>&id_bayar=<?php echo $info['id'] ?>&id_invest=<?php echo $info['id_invest'] ?>&id_pengrajin=<?php echo $info['id_pengrajin'] ?>&id_investor=<?php echo $info['id_investor'] ?>&status=<?php echo $pemberian ?>&aksi=kirim" onclick="return confirm('Sudah di cek?')">Kirim ke User</a>
                            </td>
                            <?php } elseif ($info['status'] == '2') {?>
                            <td>Sudah di kirim</td>
                            <?php }} ?>
                </tr>
                            <?php } if ($show == 0) { ?>
                <tr>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                </tr>
                
                
                <?php }   ?>
                <tr>
                    <td></td>
                </tr>
                </tbody>
            </table>
        
        </div>
    </div>
</body>
</html>