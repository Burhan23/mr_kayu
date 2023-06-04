<?php
include "function.php";
$select = new Select();
$specify = new Specify();
$invest = new Invest();
$detail = $invest->getIDFromThisRow($_REQUEST['id']);
if(!empty($_SESSION["id"])){
    $user = $select->selectUserById($_SESSION["id"]);
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">    
    <link rel="stylesheet" href="css/mou.css" media="screen">
    <style></style>
    <title>Document</title>
</head>
<body style="text-align:center;width:auto;height:auto;">
<div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    <?php foreach ($detail as $mou) { 
        $pengrajin = $select->selectUserById($mou['id_pengrajin']);
        $investor = $select->selectUserById($mou['id_investor']);
        ?>
        <?php if ($_REQUEST['opsi'] == '2' or $_REQUEST['opsi'] == '3') { ?>
        <form action="proses.php?id=<?php echo $mou['id'] ?>&investor=<?php echo $investor['username'] ?>&pengrajin=<?php echo $pengrajin['username'] ?>&role=<?php echo $user['role'] ?>&aksi=mou" enctype="multipart/form-data" method="post">
        <?php } else { ?>
        <form action="proses.php?id=<?php echo $mou['id'] ?>&investor=<?php echo $investor['username'] ?>&pengrajin=<?php echo $pengrajin['username'] ?>&role=<?php echo $user['role'] ?>&aksi=mou_perbaikan&opsi=<?php echo $_REQUEST['opsi'] ?>" enctype="multipart/form-data" method="post">
        <?php } ?>
        <?php if ($user['role'] == 1) {?>
        <a class="btn btn-primary" href="approval_invest.php"><- Back</a>
        <?php }elseif($user['role'] == 2) { ?>
        <a class="btn btn-primary" href="awaiting_invest.php"><- Back</a>
        <?php } ?>
        <label>Surat Perjanjian MOU <a class="button" style="padding-left: 10px; padding-right:10px; color: blue;" onclick="JavaScript:window.location.href='download.php?file=<?php echo $mou['mou'] ?>';"><i style="color:blue" class="bi bi-download"></i>Download Disini</a></label>
        <?php if ($user['id'] == $mou['id_pengrajin']) { ?>
        <h3>Nama Investor : <?php echo $investor['fname'] ?></h3>
        <label>Perhatian Dalam mengirim MOU</label>
        <h3>- Harap isi pada bagian pihak kedua</h3>
        <h3>- Harap tanda tangan pada pihak kedua(bagian akhir dokumen)</h3>
        <?php } elseif($user['id'] == $mou['id_investor']) { ?>
        <h3>Nama Pengrajin : <?php echo $pengrajin['fname'] ?></h3>
        <label>Perhatian Dalam mengirim MOU</label>
        <h3>- Harap isi pada bagian pihak pertama</h3>
        <h3>- Harap tanda tangan pada pihak pertama(bagian akhir dokumen)</h3>
        <?php } ?>
        <label><i class="bi bi-upload"></i> Upload MOU yang telah disiapkan : <i class="bi bi-filetype-docx"></i><i class="bi bi-filetype-doc"></i></label>
        <input type="file" id="mou" name="mou" accept="docs,docx" required></input>
        <input type="submit" class="btn btn-primary" value="Simpan">
        </form>
    <?php } ?>
    </div>
</body>

</html>