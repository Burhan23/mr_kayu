<?php
require 'function.php';

if(!empty($_SESSION["id"])){
  header("Location: index.php");
}

$login = new Login();

if(isset($_POST["submit"])){
  $result = $login->login($_POST['usernameemail'], $_POST['password']);

  if($result == 1){
    $_SESSION["login"] = true;
    $_SESSION["id"] = $login->idUser();
    $login->lastLogin($_SESSION["id"]);
    header("Location: dashboard.php");
  }
  if($result == 2){
    $_SESSION["login"] = true;
    $_SESSION["id"] = $login->idUser();
    $login->lastLogin($_SESSION["id"]);
    header("Location: index_pengrajin.php");
  }
  elseif($result == 3){
    $_SESSION["login"] = true;
    $_SESSION["id"] = $login->idUser();
    $login->lastLogin($_SESSION["id"]);
    header("Location: index_investor.php");
  }
  elseif($result == 10){
    echo
    "<script> alert('Data yang anda masukkan tidak valid'); </script>";
  }
  elseif($result == 100){
    echo
    "<script> alert('Data yang anda masukkan tidak valid'); </script>";
  }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <!--Stylesheet-->
    <link rel="stylesheet" href="css/login.css" media="screen">
  </head>
  <body>
    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    <form class="" action="" method="post" autocomplete="off">
      <h2>Login User</h2>
      <label for="">Username or Email : </label>
      <input type="text" name="usernameemail" required value="" placeholder="Username.." minlength="3" maxlength="50"> <br>
      <label for="">Password</label>
      <input type="password" name="password" required value="" placeholder="Password.." minlength="3" maxlength="8"><br>
      <button type="submit" name="submit">Login</button>
      <a>Belum Punya akun? <a href="registration.php">Registrasi disini</a></a>
      
    </form>
    <br>
    
  </body>
</html>
