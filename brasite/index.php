<?php
  session_start();

    if (file_exists("./pgs/functions.php"))
    { require_once("./pgs/functions.php"); }
    else { die("functions.php does not exist."); }

    if (file_exists("./pgs/config.php"))
    { require_once("./pgs/config.php"); }
    else { die("config.php does not exist."); }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta name="description" content="<?php echo $Meta['Description']; ?>" />
  <meta name="keywords"    content="<?php echo $Meta['Keywords']; ?>" />
  <meta name="author"      content="<?php echo $Meta['Author']; ?>" />
  <meta name="revisit"     content="<?php echo $Meta['Revisit']; ?>" />
  <meta name="robots"      content="<?php echo $Meta['Robots']; ?>" />

  <meta http-equiv="content-type" content="text/html; charset=UTF-8" />

  <link rel="stylesheet" type="text/css" href="./css/layout.css">
  <link rel="stylesheet" type="text/css" href="./css/navbar.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> <!-- Load an icon library to show a hamburger menu (bars) on small screens -->
  <link rel="icon" type="image/vnd.microsoft.icon" href="./img/fav.ico">

  <?php
    if (!isset($_GET['show'])) $_GET['show'] = "";
  ?>

  <title>Buxton Radio Amateurs</title>

</head>

<body>

  <div id="header">
    <img src="./img/headline.png" class="headline">
    <img src="./img/banner.png" class="banner">
  </div>

  <div id="navbar">

    <div class="navbar">

      <div class="dropdown">
        <button class="dropbtn">About Us
          <i class="fa fa-caret-down"></i>
        </button>
        <div class="dropdown-content">
          <a href="#">About 1</a>
          <a href="#">About 2</a>
          <a href="#">About 3</a>
          <a href="#">About 4</a>
          <a href="#">About 5</a>
        </div>
      </div>

      <a href="#home">Membership</a>
      
      <a href="#home">HF / VHF</a>

      <div class="dropdown">
        <button class="dropbtn">About Us
          <i class="fa fa-caret-down"></i>
        </button>
        <div class="dropdown-content">
          <a href="#">Radio 1</a>
          <a href="#">Radio 2</a>
          <a href="#">Radio 3</a>
          <a href="#">Radio 4</a>
          <a href="#">Radio 5</a>
        </div>
      </div>

      <a href="#home">Buxton</a>

      <div class="dropdown">
        <button class="dropbtn">About Us
          <i class="fa fa-caret-down"></i>
        </button>
        <div class="dropdown-content">
          <a href="#">Club 1</a>
          <a href="#">Club 2</a>
          <a href="#">Club 3</a>
        </div>
      </div>

      <a href="#home">Gallery</a>
      
      <a href="xlx.buxton.radio" class="split">XLX178</a>

    </div>

  </div>

  <div id="main">

    <div id="content">

      <?php

        switch ($_GET['show']) {
          case 'club'      : require_once("./pgs/club.php"); break;
          case 'commitee'  : require_once("./pgs/commitee.php"); break;
          case 'commitee'  : require_once("./pgs/commitee.php"); break;
          case 'commitee'  : require_once("./pgs/commitee.php"); break;
          case 'commitee'  : require_once("./pgs/commitee.php"); break;
          case 'commitee'  : require_once("./pgs/commitee.php"); break;
          case 'commitee'  : require_once("./pgs/commitee.php"); break;
          case 'commitee'  : require_once("./pgs/commitee.php"); break;
          case 'commitee'  : require_once("./pgs/commitee.php"); break;
          case 'commitee'  : require_once("./pgs/commitee.php"); break;
          case 'commitee'  : require_once("./pgs/commitee.php"); break;
          case 'commitee'  : require_once("./pgs/commitee.php"); break;
          case 'commitee'  : require_once("./pgs/commitee.php"); break;
          case 'commitee'  : require_once("./pgs/commitee.php"); break;
          default          : require_once("./pgs/club.php");
        }

      ?>

    </div>

  </div>

  <div id="footer">
    <p>
      <b>
      &copy; 2024 by Buxton Radio Amateurs - All Rights Reserved - <a href="https://www.qrz.com/db/G4BUX">GX4BUX</a> & <a href="https://www.qrz.com/db/G8BUX">GX8BUX</a>
      </b>
    </p>
  </div>

</body>

</html>