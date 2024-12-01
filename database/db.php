<?php

$host = "localhost";
$user = "root";
$pwd = "";
$dbname = "jangando";


$conn = mysqli_connect($host, $user, $pwd, $dbname);

if (mysqli_connect_error()) {
  echo "<p classe='error'>Connexion a la base de donnée echoué : " . mysqli_connect_error() . "</p>";
  exit();
}
