<?php
  $host = $_ENV['DB_HOST'];
  $db = $_ENV['DB_NAME'];
  $user = $_ENV['DB_USER'];
  $password = $_ENV['DB_PASSWORD'];

  try {
    $pdo = new PDO("mysql:host=$host;dbname=$db; charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch (PDOException $e) {
    die("Error de conexion1= " . $e->getMessage());
  }
?>