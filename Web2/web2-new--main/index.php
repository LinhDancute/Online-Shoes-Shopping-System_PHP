<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>


  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>



  <script src="https://kit.fontawesome.com/1d92659247.js" crossorigin="anonymous"></script>
  <link rel='stylesheet' href="style.css">
  <link rel='stylesheet' href="web/detail.css">
  <link rel='stylesheet' href="web/header.css">

  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <script src="https://kit.fontawesome.com/1d92659247.js" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" referrerpolicy="no-referrer" />


  <script src="web/magnify.js"></script>
</head>

<body>
  <?php
  session_start();
  ?>
  <header>
    <?php
    require('header.php')
    ?>


  </header>
  <?php
  require('body.php')
  ?>
  <?php
  require('footer.php')
  ?>

  <script src="header.js"></script>
  <script src="web/userweb.js"></script>
</body>

</html>i