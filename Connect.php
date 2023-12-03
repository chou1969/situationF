<?php

$options = array(
  PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
  PDO::MYSQL_ATTR_INIT_COMMAND => "SET lc_time_names = 'fr_FR'",
  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
);
$servername = "127.0.0.1";
$dbname = "paie";
$basetraitement = "operations";
$user = "root";
$pass = "";
try {
  //la base des operations
  $db = new PDO("mysql:host=$servername;dbname=$basetraitement;charset=utf8", $user, $pass);
  // la base de la paie
  $dbco = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $user, $pass);
  // la base prime de rendement 

  // la base des rappels

  // autres 

  //............................................................................

} catch (PDOException $e) {
  echo "Erreur : " . $e->getMessage();
  die();
}