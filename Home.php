<!DOCTYPE html>
<?php 
  session_start(); 

  if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: Home.php");
  }
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="stylesheet.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


  <meta charset="utf-8">
        <title>Leagues</title>
    </head>
<body>
    
<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">EUROPEAN SOCCER LEAGUES</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="Home.php">Home<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">News</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Leagues
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="Premiere.php">Premier</a>
          <a class="dropdown-item" href="Laliga.php">La Liga</a>
          <a class="dropdown-item" href="Seriea.php">Serie A</a>
          <a class="dropdown-item" href="Bundesliga.php">Bundesliga</a>
          <a class="dropdown-item" href="Ligue1.php">Ligue 1</a>
        </div>
      </li>
    </ul>
  </div>
    <ul class="nav navbar-nav navbar-right">
      <?php  if (isset($_SESSION['username'])) : ?>
          <a class="navbar-brand" href="#">Welcome <strong><?php echo $_SESSION['username']; ?></strong></a>
        <?php endif ?>
        <?php  if (isset($_SESSION['username'])) : ?>
      <li class="nav-item">
          <a class="nav-link" href="Home.php?logout='1'">logout</a>
      </li>
        <?php endif ?>
      <?php if(!isset($_SESSION['success'])) : ?>
      <li class="nav-item">
        <a class="nav-link" href="login.php">Login</a>
      </li>
      <?php endif ?>
    </ul>
</nav>



<div class="container-fluid">
  <div class="row">
    <div class="col-md-2 bg-dark text-white"></div>
    <div class="col-md-8 col-md-offset-2">
      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img class="d-block w-100" src="https://fcbarcelona-static-files.s3.amazonaws.com/fcbarcelona/photo/2018/09/21/bb29cbe2-e2a6-450b-9134-0ded29c89f37/10-MESSI-JOC.jpg" alt="First slide" style="width:100%;height:20%">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="https://s2.reutersmedia.net/resources/r/?m=02&d=20180210&t=2&i=1230209269&w=1200&r=LYNXMPEE190N4" alt="Second slide" style="width:100%;height:40%">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="https://bloximages.chicago2.vip.townnews.com/news-herald.com/content/tncms/assets/v3/editorial/9/cc/9cc5899c-e79f-5d98-b0da-1a61b4b68fab/5bb3910ccd5a2.image.jpg?resize=1200%2C750" alt="Third slide" style="width:100%;height:60%">
          </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
    </div>
    <div class="col-md-2 bg-dark text-white"></div>
  </div>
</div>


<div class="content">
    <!-- notification message -->
    <?php if (!isset($_SESSION['success'])) : ?>
      <div class="error success" >
        <h3>
          <?php 
          ?>
        </h3>
      </div>
    <?php endif ?>

    <!-- logged in user information -->
    
</div>



<div class="container-fluid">
  <div class="row">
    <dir class="col-md-8">
      <table class="table">
        <thead class="thead-light">
<?php
      include "credentials.php";
      $servername = "localhost";
      $dbname = "S19_350_Team_Green";
      $connection = mysqli_connect($servername, $username, $password, $dbname);
        if (!$connection){
          echo "MySQL database connection failed.<br>";
        }
      $sql_select = "SELECT name, country, numberOfTeams, yearFounded, avgValue FROM leagues;";
      $result = mysqli_query($connection, $sql_select);
      $size = mysqli_num_rows($result);

      if ($size > 0){
        echo '<tr><th scope="col">Name</th><th scope="col">Country</th><th scope="col">Number of Teams</th><th scope="col">Year Founded</th><th scope="col">Average Value of Club(USD)</th></tr></thead><tbody>';
        while($row = mysqli_fetch_assoc($result)){
          echo '<tr>';
            echo '<td>' . $row["name"] . '</td><td>' . $row["country"] . '</td><td>' . $row["numberOfTeams"] . '</td><td>' . $row["yearFounded"] . '</td><td>' . $row["avgValue"] . '</td>';
          echo '</tr>';
        }
      }
?>
        </tbody>
      </table>
    </dir>
  </div>
</div>








   <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
  </body>
</html> 