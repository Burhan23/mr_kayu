<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">    
    <title>Simple Navbar</title>
    <link href="css/navbar1.css" rel="stylesheet" type="text/css" />
  </head>
  <body>
    <nav class="nav">
      <a href="awaiting_invest.php" class="nav-link"><i class="bi bi-list-task"></i> List Investasimu</a>
      <a href="index_investor.php" class="nav-link"><i class="bi bi-currency-exchange"></i> Invest</a>
      <a href="deskripsi.php" class="nav-link"><i class="bi bi-journal-text"></i> Deskripsi</a>
      <a style="padding-left:auto; margin-left:auto">
      <a style="text-decoration:underline; color:blue" href="logout.php"  class="nav-link" onclick="return confirm('Apakah yakin ingin keluar?')"><i class="bi bi-box-arrow-left"></i> Logout</a>
      <a href="profile.php" class="nav-link"><i class="bi bi-person-circle"></i> Profile</a>
      </a>
    </nav>
    <script src="js/script.js"></script>
  </body>
</html>