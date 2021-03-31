<!DOCTYPE html>
<?php 
  session_start(); 

  if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: Home.php");
  }
      include "credentials.php";
      $servername = "localhost";
      $dbname = "S19_350_Team_Green";
      $connection = mysqli_connect($servername, $username, $password, $dbname);
?>
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="stylesheet.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <title>Premier League</title>
    </head>
<body>

<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">PREMIER LEAGUE</a>
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

<p style="margin-top: 62px;"></p>

<style>
  table, th, td { border-collapse: collapse; color: #000000;}
  th, td {
  padding: 10px;
  text-align: left;
   }
  th {text-decoration: underline;}  
  tr:nth-child(even) {background-color:#D3CFCF;}
  tr:nth-child(odd) {background-color:#547F96;}
</style>

<div class="container-fluid">
  <div class="row">
    <dir class="col-md-6">
<?php
echo "<table style='border: solid 0.5px black;'>";
echo "<tr><th>Name</th>
<th>Wins</th>
<th>Loses</th>
<th>Draws</th>
<th>PF</th>
<th>PA</th>
<th>Diff</th>
<th>Points</th>
</tr>";
class TableRows extends RecursiveIteratorIterator {
    function __construct($it) {
        parent::__construct($it, self::LEAVES_ONLY);
    }
    function current() {
        return "<td style='width: 60px;'>" . parent::current(). "</td>";
    }
    function beginChildren() {
        echo "<tr>";
    }
    function endChildren() {
        echo "</tr>" . "\n";
    }
}
$servername = "localhost";
$dbname = "S19_350_Team_Green";
include "credentials.php";
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT name, wins, loses, draws, PF, PA, diff, points FROM teams WHERE leagueID=1 ORDER BY points DESC");
    $stmt->execute();
    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
        echo $v;
    }
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
echo "</table>";
?>
</div>





<dir class="col-md-6">
<?php
echo "<table style='border: solid 0.5px black;'>";
echo "<tr><th style='border: solid 0.5px black'>Name</th>
<th style='border: solid 0.5px black'>Team</th>
<th style='border: solid 0.5px black'>Goals</th>
</tr>";
class TableRows2 extends RecursiveIteratorIterator {
    function __construct($it) {
        parent::__construct($it, self::LEAVES_ONLY);
    }
    function current() {
        return "<td style='width: 60px; border: solid 0.5px black'>" . parent::current(). "</td>";
    }
    function beginChildren() {
        echo "<tr>";
    }
    function endChildren() {
        echo "</tr>" . "\n";
    }
}
$servername = "localhost";
$dbname = "S19_350_Team_Green";
include "credentials.php";
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT name, team, goals FROM players WHERE 
			    leagueID=1;");
    $stmt->execute();
    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    foreach(new TableRows2(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
        echo $v;
    }
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
echo "</table>";
?>
</dir>
</dir>
</div>

<?php
  if(isset($_POST['add'])){
    $sql = "INSERT INTO players (name, team, goals, leagueID)
    VALUES ('".$_POST["name"]."','".$_POST["team"]."',".$_POST["goals"].",1);";
    if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
    } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    if (!$connection){
          echo "MySQL database connection failed.<br>";
        } else {
          echo "connected";
        }
  }
  if(isset($_POST['delete'])){
    $sql = "DELETE FROM players WHERE name = '" . $_POST["name"]. "';";
    if (mysqli_query($conn, $sql)) {
    echo "deleted";
    } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
  }

?>


<?php  if (isset($_SESSION['username'])) : ?>
<form action="Premiere.php" method="post"> 
    <label id="first"> Name:</label>
    <input type="text" name="name"><br/>

    <label id="first">Team:</label>
    <input type="text" name="team"><br/>

    <label id="first">Goals:</label>
    <input type="text" name="goals"><br/>

    <button type="submit" name="add">add</button><br/>
    <button type="submit" name="update">update</button><br/>
    <button type="submit" name="delete">delete</button><br/>

</form>
<?php endif ?>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>