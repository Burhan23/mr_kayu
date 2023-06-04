<?php
include 'function.php';


$select = new Select();

$pengrajin = $select->selectUsersByID($_REQUEST['id_pengrajin']);
$investor = $select->selectUsersByID($_REQUEST['id_investor']);


?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Invalid</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" 
    rel="stylesheet" 
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" 
    crossorigin="anonymous">
    <!--Stylesheet-->
    <link rel="stylesheet" href="css/invalid.css" media="screen">
  </head>
  <body>
    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    <section class="container">
    <div class="left-half">
    <article>
    <form>
    <h2 style="text-align:center">Data Diri Pengrajin</h2>
      <label for="">Name Pengrajin : </label>
      <input type="text" name="name" readonly value="<?php echo $pengrajin['fname'] ?>"> 
      <label for="">Email Pengrajin : </label>
      <input type="text" name="email" readonly value="<?php echo $pengrajin['email'] ?>"> 
      <label for="">NIK Pengrajin : </label>
      <input type="text" name="email" readonly value="<?php echo $pengrajin['nik'] ?>">
      <br>
      <a href="proses.php?id=<?php echo $_REQUEST['id'] ?>&aksi=mou_invalid&opsi=p" class="btn btn-danger btn-lg"  name="submit">Invalid Pengrajin</a>
    </form>
    </article>
  </div>
  <div class="right-half">
    <article>
    <form>
      <h2 style="text-align:center">Data Diri Investor</h2>
      <label for="">Name Investor : </label>
      <input type="text" name="name" readonly value="<?php echo $investor['fname'] ?>"> 
      <label for="">Email Investor : </label>
      <input type="text" name="email" readonly value="<?php echo $investor['email'] ?>"> 
      <label for="">NIK Investor : </label>
      <input type="text" name="email" readonly value="<?php echo $investor['nik'] ?>"> 
      <br>
      <a href="proses.php?id=<?php echo $_REQUEST['id'] ?>&aksi=mou_invalid&opsi=i" class="btn btn-danger btn-lg"  name="submit">Invalid Investor</a>
    </form>
    </article>
  </div>
  <article>
  <a href="proses.php?id=<?php echo $_REQUEST['id'] ?>&aksi=mou_invalid&opsi=ip" class="btn btn-secondary btn-lg" style="width:15%;"  name="submit">Invalid Keduanya</a>
  <br>
  <a href="list_mou.php" class="btn btn-primary btn-sm" style="width:15%;"  name="submit"><--Kembali</a>
  </article>
    </section>
    <br> <br>
  </body>
</html>
