<?php
include "function.php";
$select = new Select();
$specify = new Specify();
$detail = $specify->dataInvest($_REQUEST['id_invest']);
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
    <link rel="stylesheet" href="../css/mou.css" media="screen">
    <title>Document</title>
</head>
<body style="text-align:center;width:auto;height:auto;">
    <div class="background">
            <div class="shape"></div>
            <div class="shape"></div>
    </div>
    <?php foreach ($detail as $mou) { 
        $pengrajin = $select->selectUsersById($mou['id_pengrajin']);
        $investor = $select->selectUsersById($mou['id_investor']);
        ?>
        <form action="proses.php?id=<?php echo $mou['id'] ?>&investor=<?php echo $investor['username'] ?>&aksi=mou" enctype="multipart/form-data" method="post">
        <a class="btn btn-primary" href="list_mou.php"><- Back</a>
        <label>Perhatian Dalam mengirim MOU</label>
        <h3>Nama Investor : <?php echo $investor['fname'] ?></h3>
        <h3>NIK Investor : <?php echo $investor['nik'] ?></h3>
        <br>
        <h3>Nama Pengrajin : <?php echo $pengrajin['fname'] ?></h3>
        <h3>NIK Pengrajin : <?php echo $pengrajin['nik']?></h3>
        <h3>Nominal Pemberian : Rp,-<?php echo $mou['jumlah_dana'] ?></h3>
        <label>Jika belum memiliki format MOU <a class="" style="padding-left: 10px; padding-right:10px;" onclick="JavaScript:window.location.href='download.php?file=SURAT_PERJANJIAN_INVESTASI.docx';">Download Disini</a></label>
        <label>Upload MOU yang telah disiapkan</label>
        <input type="file" id="mou" name="mou" accept="docs,docx" required>
        <input type="submit" class="btn btn-primary" value="Simpan">
        </form>
    <?php } ?>
    </div>
</body>

</html>